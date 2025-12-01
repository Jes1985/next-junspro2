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
        $validated = $request->validate([
            'client_nom' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_telephone' => 'nullable|string|max:20',
            'description_mission' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'offre' => 'required|in:Accompagnement,Mise_en_relation,Aucune',
            'fichier_joint' => 'nullable|file|max:10240', // 10MB max
        ]);

        // Déterminer le bonus automatiquement selon le budget
        $bonus = Mission::determineBonus($validated['budget']);

        // Calculer le montant à payer selon l'offre
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

        // Créer la mission en base
        $mission = Mission::create([
            'client_nom' => $validated['client_nom'],
            'client_email' => $validated['client_email'],
            'client_telephone' => $validated['client_telephone'],
            'description_mission' => $validated['description_mission'],
            'budget' => $validated['budget'],
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
}

