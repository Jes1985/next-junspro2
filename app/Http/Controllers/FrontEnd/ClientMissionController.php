<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Services\StripeService;
use App\Services\CalendlyService;
use App\Services\ZoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ClientMissionController extends Controller
{
    protected $stripeService;
    protected $calendlyService;
    protected $zoomService;

    public function __construct(
        StripeService $stripeService,
        CalendlyService $calendlyService,
        ZoomService $zoomService
    ) {
        $this->stripeService = $stripeService;
        $this->calendlyService = $calendlyService;
        $this->zoomService = $zoomService;
    }

    /**
     * Affiche le formulaire de soumission de mission
     */
    public function showForm()
    {
        return view('frontend.client.mission-form');
    }

    /**
     * Traite la soumission du formulaire
     */
    public function submit(Request $request)
    {
        // HOME_SWAP_VALUE: valeur backend pour "Échange de logement"
        $HOME_SWAP_VALUE = 'echange-logement';
        $isHomeSwap = $request->input('univers_slug') === $HOME_SWAP_VALUE;
        
        // Budget: required pour tous sauf HomeSwap (nullable pour HomeSwap)
        $budgetRule = $isHomeSwap ? 'nullable|numeric|min:0' : 'required|numeric|min:0';
        
        // Validation de base
        $baseRules = [
            // Champs existants (conservés)
            'client_nom' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_telephone' => 'nullable|string|max:20',
            'description_mission' => 'required|string',
            'budget' => $budgetRule,
            'offre' => 'required|in:Accompagnement,Mise_en_relation,Aucune',
            'fichier_joint' => 'nullable|file|max:10240', // 10MB max
            // Nouveaux champs
            'univers_slug' => 'required|string|in:projets-consulting,cours-mentorat,service-domicile,echange-logement,wellnesslive,pause-souffle',
            'about_you' => 'nullable|string|max:2000',
            'details' => 'nullable|array',
            'preferred_contact' => 'nullable|string|in:email,whatsapp,call',
            'language' => 'nullable|string|in:fr,en,it',
            'location_mode' => 'nullable|string|in:remote,hybrid,onsite',
        ];
        
        // Ajouter validation conditionnelle selon l'univers
        $universSlug = $request->input('univers_slug');
        $universRules = $this->getUniversValidationRules($universSlug);
        $allRules = array_merge($baseRules, $universRules);
        
        $validated = $request->validate($allRules);

        // Déterminer le bonus automatiquement selon le budget (sauf pour HomeSwap)
        $bonus = 'Aucun';
        if (!$isHomeSwap && isset($validated['budget']) && $validated['budget'] > 0) {
            $bonus = Mission::determineBonus($validated['budget']);
        }

        // Calculer le montant à payer selon l'offre (même logique pour HomeSwap)
        $montant = 0;
        if ($validated['offre'] === 'Accompagnement') {
            $montant = 99.00;
        } elseif ($validated['offre'] === 'Mise_en_relation') {
            $montant = 9.99;
        }
        // Si aucune offre, pas de paiement immédiat

        // Gérer le fichier joint si présent
        $fichierPath = null;
        if ($request->hasFile('fichier_joint')) {
            $fichierPath = $request->file('fichier_joint')->store('missions', 'public');
        }

        // Préparer les détails depuis les champs details[...]
        $details = [];
        if ($request->has('details') && is_array($request->input('details'))) {
            $details = $request->input('details');
            // Filtrer les valeurs vides pour nettoyer le JSON
            $details = array_filter($details, function($value) {
                if (is_array($value)) {
                    $filtered = array_filter($value);
                    return !empty($filtered);
                }
                return $value !== null && $value !== '';
            });
        }

        // Créer la mission en base
        $mission = Mission::create([
            'client_nom' => $validated['client_nom'],
            'client_email' => $validated['client_email'],
            'client_telephone' => $validated['client_telephone'],
            'univers_slug' => $validated['univers_slug'],
            'about_you' => $validated['about_you'] ?? null,
            'details' => !empty($details) ? $details : null,
            'preferred_contact' => $validated['preferred_contact'] ?? null,
            'language' => $validated['language'] ?? null,
            'location_mode' => $validated['location_mode'] ?? null,
            'description_mission' => $validated['description_mission'],
            'budget' => $isHomeSwap ? null : ($validated['budget'] ?? 0),
            'offre' => $validated['offre'],
            'bonus' => $bonus,
            'fichier_joint' => $fichierPath,
            'statut' => $montant > 0 ? 'En_attente' : 'Paiement_valide',
        ]);

        // Si un paiement est requis, rediriger vers Stripe
        if ($montant > 0) {
            $session = $this->stripeService->createCheckoutSession($montant, $mission->id_mission);
            return redirect($session->url);
        }

        // Si pas de paiement mais bonus, créer Calendly
        if ($bonus !== 'Aucun' && $montant === 0) {
            $this->handleBonusWithoutPayment($mission);
        }

        return redirect()->route('mission.success', ['id' => $mission->id_mission]);
    }

    /**
     * Webhook Stripe pour traiter le paiement
     */
    public function stripeWebhook(Request $request)
    {
        $payload = $request->all();
        $event = $this->stripeService->handleWebhook($payload);

        if ($event && $event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $missionId = $session->metadata->mission_id ?? null;

            if ($missionId) {
                $mission = Mission::find($missionId);
                if ($mission) {
                    $mission->update([
                        'statut' => 'Paiement_valide',
                        'stripe_payment_id' => $session->id,
                    ]);

                    // Gérer selon le type d'offre
                    if ($mission->offre === 'Accompagnement') {
                        $this->handleAccompagnement($mission);
                    } elseif ($mission->offre === 'Mise_en_relation') {
                        $this->handleMiseEnRelation($mission);
                    }

                    // Gérer les bonus si nécessaire
                    if ($mission->bonus !== 'Aucun') {
                        $this->handleBonus($mission);
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Gère l'accompagnement complet
     */
    protected function handleAccompagnement(Mission $mission)
    {
        // Créer le lien Calendly
        $calendlyLink = $this->calendlyService->createEventLink($mission);
        
        $mission->update([
            'calendly_link' => $calendlyLink,
        ]);

        // Envoyer l'email avec le lien Calendly
        Mail::to($mission->client_email)->send(
            new \App\Mail\AccompagnementConfirmation($mission)
        );
    }

    /**
     * Gère la mise en relation simple
     */
    protected function handleMiseEnRelation(Mission $mission)
    {
        // Pas de Calendly/Zoom pour la mise en relation simple
        // Juste enregistrer et notifier l'admin
        Mail::to($mission->client_email)->send(
            new \App\Mail\MiseEnRelationConfirmation($mission)
        );
    }

    /**
     * Gère le bonus bien-être
     */
    protected function handleBonus(Mission $mission)
    {
        if (!$mission->calendly_link) {
            $calendlyLink = $this->calendlyService->createEventLink($mission);
            $mission->update(['calendly_link' => $calendlyLink]);
        }

        Mail::to($mission->client_email)->send(
            new \App\Mail\BonusBienEtre($mission)
        );
    }

    /**
     * Gère le bonus sans paiement (cas 3)
     */
    protected function handleBonusWithoutPayment(Mission $mission)
    {
        $calendlyLink = $this->calendlyService->createEventLink($mission);
        $mission->update([
            'calendly_link' => $calendlyLink,
            'statut' => 'Paiement_valide',
        ]);

        Mail::to($mission->client_email)->send(
            new \App\Mail\BonusBienEtre($mission)
        );
    }

    /**
     * Callback Calendly quand un RDV est confirmé
     */
    public function calendlyCallback(Request $request)
    {
        $eventUri = $request->input('event');
        $missionId = $request->input('mission_id');

        $mission = Mission::find($missionId);
        if (!$mission) {
            return response()->json(['error' => 'Mission not found'], 404);
        }

        // Récupérer les détails de l'événement Calendly
        $event = $this->calendlyService->getEvent($eventUri);
        
        if ($event) {
            // Créer la réunion Zoom
            $zoomMeeting = $this->zoomService->createMeeting($mission);
            
            $mission->update([
                'calendly_event_id' => $event['id'],
                'zoom_meeting_id' => $zoomMeeting['id'],
                'zoom_link' => $zoomMeeting['join_url'],
                'date_rdv' => $event['start_time'],
                'statut' => 'RDV_planifie',
            ]);

            // Envoyer l'email avec le lien Zoom
            Mail::to($mission->client_email)->send(
                new \App\Mail\RdvConfirme($mission)
            );
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Page de succès après paiement Stripe
     */
    public function stripeSuccess(Request $request)
    {
        // Gérer le cas HomeSwap (abonnement)
        if ($request->input('type') === 'homeswap') {
            return redirect()->route('user.settings.subscription')
                ->with('success', __('Votre abonnement HomeSwap a été activé avec succès !'));
        }
        
        $missionId = $request->input('mission_id');
        $mission = Mission::findOrFail($missionId);
        return view('frontend.client.mission-success', compact('mission'));
    }

    /**
     * Page d'annulation Stripe
     */
    public function stripeCancel()
    {
        return view('frontend.client.mission-cancel');
    }

    /**
     * Page de succès
     */
    public function success($id)
    {
        $mission = Mission::findOrFail($id);
        return view('frontend.client.mission-success', compact('mission'));
    }

    /**
     * Créer une session Stripe Checkout pour l'abonnement HomeSwap
     */
    public function homeSwapCheckout(Request $request)
    {
        $user = auth()->guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login')
                ->with('warning', __('Vous devez être connecté pour vous abonner à HomeSwap.'));
        }

        try {
            $session = $this->stripeService->createHomeSwapCheckoutSession($user->id);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur création checkout HomeSwap: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', __('Erreur lors de la création de la session de paiement. Veuillez réessayer.'));
        }
    }
    
    /**
     * Retourne les règles de validation conditionnelles selon l'univers
     */
    protected function getUniversValidationRules($universSlug)
    {
        $rules = [];
        
        switch ($universSlug) {
            case 'projets-consulting':
                $rules = [
                    'details.domain' => 'nullable|in:strategie,marketing,design,dev,ops,finance,autre',
                    'details.deliverables' => 'nullable|array',
                    'details.deliverables.*' => 'nullable|in:audit,plan,maquettes,texte,dev,automatisation,autre',
                    'details.scope_in' => 'nullable|string|max:500',
                    'details.scope_out' => 'nullable|string|max:500',
                    'details.decision_maker' => 'nullable|in:yes,no',
                    'details.tools' => 'nullable|string|max:255',
                ];
                break;
                
            case 'cours-mentorat':
                $rules = [
                    'details.topic' => 'nullable|string|max:255',
                    'details.level' => 'nullable|in:debutant,intermediaire,avance',
                    'details.goal' => 'nullable|in:examen,projet,remise-a-niveau,confiance,autre',
                    'details.rhythm' => 'nullable|in:1x,2x,sur-mesure',
                    'details.format' => 'nullable|in:visio,presentiel,mixte',
                    'details.availability' => 'nullable|string|max:500',
                ];
                break;
                
            case 'service-domicile':
                $rules = [
                    'details.service_type' => 'nullable|in:menage,garde,aide,beaute,massage,bricolage,autre',
                    'details.postal_city' => 'nullable|string|max:255',
                    'details.frequency' => 'nullable|in:ponctuel,hebdo,mensuel',
                    'details.constraints' => 'nullable|string|max:500',
                    'details.verified_required' => 'nullable|in:yes,no',
                ];
                break;
                
            case 'echange-logement':
                $rules = [
                    'details.exchange_type' => 'nullable|in:simultane,non-simultane,points',
                    'details.destinations' => 'nullable|string|max:500',
                    'details.dates_text' => 'nullable|string|max:255',
                    'details.flexibility' => 'nullable|in:yes,no',
                    'details.travelers_adults' => 'nullable|integer|min:0|max:20',
                    'details.travelers_children' => 'nullable|integer|min:0|max:20',
                    'details.essentials' => 'nullable|array',
                    'details.essentials.*' => 'nullable|in:wifi,bureau,cuisine,lave-linge,lit-bebe,autre',
                    'details.house_rules' => 'nullable|string|max:1000',
                    'details.checkin' => 'nullable|string|max:255',
                ];
                break;
                
            case 'wellnesslive':
                $rules = [
                    'details.objective' => 'nullable|in:forme,mobilite,energie,reprise,autre',
                    'details.class_types' => 'nullable|array',
                    'details.class_types.*' => 'nullable|in:fitness,yoga,pilates,renfo,danse,autre',
                    'details.level' => 'nullable|in:debutant,intermediaire,avance',
                    'details.frequency' => 'nullable|in:2-semaine,4-semaine,illimite',
                    'details.content_pref' => 'nullable|in:live-only,live+vod',
                    'details.equipment' => 'nullable|string|max:500',
                    'details.subscription_budget' => 'nullable|in:lt20,20-39,40-79,80plus',
                ];
                break;
                
            case 'pause-souffle':
                $rules = [
                    'details.situation' => 'nullable|in:dirigeant,salarie,parent,freelance,transition',
                    'details.intention' => 'nullable|in:clarte,energie,decisions,equilibre,sens',
                    'details.energy' => 'nullable|integer|min:0|max:10',
                    'details.clarity' => 'nullable|integer|min:0|max:10',
                    'details.stress' => 'nullable|integer|min:0|max:10',
                    'details.protect' => 'nullable|array',
                    'details.protect.*' => 'nullable|in:temps,sante,famille,foi,projet,autre',
                    'details.vision' => 'nullable|string|max:2000',
                    'details.coaching_style' => 'nullable|in:structure,doux,mixte',
                    'details.spiritual' => 'nullable|in:oui,non,je-ne-sais-pas',
                ];
                break;
        }
        
        return $rules;
    }
}

