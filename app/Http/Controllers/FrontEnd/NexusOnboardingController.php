<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NexusOnboardingController extends Controller
{
    // ─── Constantes ───────────────────────────────────────────────────────────

    private const SESSION_KEY = 'nexus_onboarding';

    /**
     * Lit les données NEXUS — BDD en source de vérité (identique au profil freelance
     * qui lit toujours depuis FreelancerProfile), session uniquement comme cache.
     */
    private function getSession(): array
    {
        $user = Auth::guard('web')->user();

        if ($user && Schema::hasColumn('users', 'nexus_onboarding')) {
            // Forcer une relecture fraîche depuis la BDD (évite le cache du modèle Eloquent)
            $user->refresh();
            $dbData = is_array($user->nexus_onboarding) ? $user->nexus_onboarding : [];
            if (!empty($dbData)) {
                // Synchroniser le cache session avec la BDD
                session([self::SESSION_KEY => $dbData]);
                return $dbData;
            }
        }

        // Fallback : session (premier remplissage avant première soumission)
        return session(self::SESSION_KEY, []);
    }

    /**
     * Sauvegarde en session ET en BDD (identique au FreelancerProfile->save())
     * Ce point unique de sauvegarde évite toute duplication dans les Store().
     */
    private function putSession(array $data): void
    {
        // 1) Cache session
        $sessionExisting = session(self::SESSION_KEY, []);
        $merged = array_merge($sessionExisting, $data);
        session([self::SESSION_KEY => $merged]);

        // 2) Persistance BDD — source de vérité
        $user = Auth::guard('web')->user();
        if ($user && Schema::hasColumn('users', 'nexus_onboarding')) {
            $dbExisting = is_array($user->nexus_onboarding) ? $user->nexus_onboarding : [];
            $user->nexus_onboarding = array_merge($dbExisting, $data);
            $user->save();
        }
    }

    // ─── Autosave silencieux (AJAX) ─────────────────────────────────────────
    /**
     * Appelé en AJAX à chaque modification d'un champ.
     * Fusionne les données dans nexus_onboarding (session + BDD).
     * Ne touche jamais aux champs fichiers (gérés par les soumissions normales).
     */
    public function autosave(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            \Log::warning('[NX-autosave] 401 – utilisateur non authentifié');
            return response()->json(['ok' => false, 'reason' => 'unauthenticated'], 401);
        }

        // Champs filesystem exclus
        $excluded = ['_token', 'photo', 'video_thumbnail', 'property_photos', 'property_photos[]'];
        $incoming = $request->except($excluded);

        \Log::info('[NX-autosave] user=' . $user->id . ' data=' . json_encode($incoming));

        if (empty($incoming)) {
            return response()->json(['ok' => true]);
        }

        // putSession() gère session + BDD en un seul appel
        $this->putSession($incoming);

        return response()->json(['ok' => true, 'saved' => array_keys($incoming)]);
    }

    // ─── Step 1 : Mon identité NEXUS ──────────────────────────────────────────

    public function step1(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        // getSession() lit toujours la BDD en priorité (source de vérité)
        $saved = $this->getSession();

        // Pré-remplir depuis le profil ou la session
        $data = [
            'first_name'   => old('first_name', $saved['first_name'] ?? $user->first_name ?? ''),
            'last_name'    => old('last_name', $saved['last_name'] ?? $user->last_name ?? ''),
            'contact_email' => old('contact_email', $saved['contact_email'] ?? $user->email ?? ''),            'bio'          => old('bio', $saved['bio'] ?? ''),
            'country'      => old('country', $saved['country'] ?? $user->country_code ?? ''),
            'city'         => old('city', $saved['city'] ?? $user->address ?? ''),
            'photo_url'    => $user->image ? asset('storage/img/users/' . $user->image) : null,
        ];

        return view('nexus.onboarding.step1', compact('user', 'data'));
    }

    public function step1Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'bio'        => 'required|string|min:30|max:1000',
            'country'    => 'required|string|max:8',
            'city'       => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required'  => 'Le nom est obligatoire.',
            'bio.required'        => 'Votre présentation est obligatoire.',
            'bio.min'             => 'Votre présentation doit comporter au moins 30 caractères.',
            'country.required'    => 'Le pays est obligatoire.',
            'city.required'       => 'La ville est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Sauvegarder photo si fournie
        $photoUrl = null;
        if ($request->hasFile('photo')) {
            if ($user->image && Storage::disk('public')->exists('img/users/' . $user->image)) {
                Storage::disk('public')->delete('img/users/' . $user->image);
            }
            $photo    = $request->file('photo');
            $filename = 'nexus_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/users', $filename, 'public');
            $user->image = $filename;
            $user->save();
            $photoUrl = $filename;
        }

        // putSession() sauvegarde en session ET en BDD en un seul appel
        $this->putSession([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'contact_email' => $request->contact_email,
            'bio'           => $request->bio,
            'country'       => $request->country,
            'city'          => $request->city,
            'photo'         => $photoUrl ?? ($user->image ?? null),
        ]);

        return redirect()->route('nexus.onboarding.step2');
    }

    // ─── Step 2 : Mon bien d'échange ──────────────────────────────────────────

    public function step2(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        // getSession() lit toujours la BDD en priorité (source de vérité)
        $saved = $this->getSession();
        \Log::info('[NX-step2] GET — saved keys: ' . implode(', ', array_keys($saved)) . ' | user=' . $user->id);
        \Log::info('[NX-step2] frequency=' . json_encode($saved['frequency'] ?? 'NON_DÉFINI') . ' | stay_duration=' . json_encode($saved['stay_duration'] ?? 'NON_DÉFINI') . ' | flexibility=' . json_encode($saved['flexibility'] ?? 'NON_DÉFINI') . ' | city=' . ($saved['city'] ?? 'NON_DÉFINI'));
        // 'recurrence' est le nom interne, 'frequency' est le nom du champ HTML
        if (!$request->isMethod('POST')) {
            // Lire nexus_offer (filtres homeswap) depuis la BDD — cast array, pas de json_decode nécessaire
            $offerData = [];
            if (Schema::hasColumn('users', 'nexus_offer') && !empty($user->nexus_offer)) {
                $raw = $user->nexus_offer;
                // Gérer les deux cas : cast array (correct) ou ancienne valeur double-encodée (legacy)
                $offerData = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
            }
            if (empty($offerData)) {
                $offerData = session('nexus_offer', []);
            }

            // $saved (nexus_onboarding, mis à jour par autosave) prend priorité sur
            // $offerData (nexus_offer, dernier submit du formulaire complet).
            // Alias pour les clés différentes entre HTML forms names et storage keys
            $aliases = [];
            // recurrence (clé interne) → frequency (nom du champ HTML)
            if (!isset($saved['frequency']) && !empty($saved['recurrence'])) {
                $aliases['frequency'] = $saved['recurrence'];
            }
            // min_notice_days (step2Store) → min_delay (nom du champ HTML)
            if (!isset($saved['min_delay']) && !empty($saved['min_notice_days'])) {
                $aliases['min_delay'] = $saved['min_notice_days'];
            }
            // date_from/date_to (step2Store) → start_date/end_date (noms des champs HTML)
            if (!isset($saved['start_date']) && !empty($saved['date_from'])) {
                $aliases['start_date'] = $saved['date_from'];
            }
            if (!isset($saved['end_date']) && !empty($saved['date_to'])) {
                $aliases['end_date'] = $saved['date_to'];
            }
            // availability_periods : normalise array → JSON string pour que le blade puisse json_decode()
            if (isset($saved['availability_periods']) && is_array($saved['availability_periods'])) {
                $saved['availability_periods'] = json_encode($saved['availability_periods']);
            }
            $request->merge(array_merge($offerData, $saved, $aliases));
        }

        $data = [
            'property_type'     => old('property_type', $saved['property_type'] ?? ''),
            'property_title'    => old('property_title', $saved['property_title'] ?? ''),
            'property_desc'     => old('property_desc', $saved['property_desc'] ?? ''),
            'property_surface'  => old('property_surface', $saved['property_surface'] ?? ''),
            'property_capacity' => old('property_capacity', $saved['property_capacity'] ?? ''),
            'property_features' => old('property_features', $saved['property_features'] ?? []),
            'video_url'         => old('video_url', $saved['video_url'] ?? ''),
            'video_thumbnail'   => $saved['video_thumbnail'] ?? null,
            'property_photos'   => $saved['property_photos'] ?? [],
        ];

        $propertyTypes = [
            ['slug' => 'logement',   'label' => 'Logement',         'icon' => '🏠', 'desc' => 'Appartement, maison, villa...'],
            ['slug' => 'bureau',     'label' => 'Espace Pro',        'icon' => '🏢', 'desc' => 'Bureau, coworking, studio...'],
            ['slug' => 'pedagogique','label' => 'Espace Pédagogique','icon' => '📚', 'desc' => 'Salle de cours, labo, atelier...'],
            ['slug' => 'wellness',   'label' => 'Espace Bien-Être',  'icon' => '🧘', 'desc' => 'Studio yoga, salle détente...'],
            ['slug' => 'evenement',  'label' => 'Salle d\'Événement','icon' => '🎪', 'desc' => 'Salle de conférence, galerie...'],
            ['slug' => 'autre',      'label' => 'Autre',            'icon' => '✨', 'desc' => 'Un bien unique...'],
        ];

        $features = [
            'wifi'        => 'Wi-Fi haut débit',
            'cuisine'     => 'Cuisine équipée',
            'parking'     => 'Parking',
            'salle_bain'  => 'Salle de bain privée',
            'terrasse'    => 'Terrasse / Jardin',
            'clim'        => 'Climatisation / Chauffage',
            'tv'          => 'TV / Home cinema',
            'bureau'      => 'Bureau de travail',
            'accessibilite' => 'Accessibilité PMR',
            'animaux'     => 'Animaux acceptés',
            'non_fumeur'  => 'Non-fumeur',
            'securite'    => 'Sécurisé / Badge',
        ];

        return view('nexus.onboarding.step2', compact('user', 'data', 'propertyTypes', 'features', 'saved'));
    }

    public function step2Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        $validator = Validator::make($request->all(), [
            // ── Bien d'échange (requis) ──────────────────────────────────────
            'property_type'     => 'required|string|max:64',
            'property_title'    => 'required|string|max:255',
            'property_desc'     => 'required|string|min:30|max:2000',
            'property_surface'  => 'nullable|integer|min:5|max:9999',
            'property_capacity' => 'required|integer|min:1|max:500',
            'property_features' => 'nullable|array',
            'video_url'         => 'nullable|url|max:500',
            'video_thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            // ── Photos du bien ───────────────────────────────────────────────
            'property_photos'   => 'nullable|array|max:6',
            'property_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8192',
            // ── Langues (accordion, optionnel) ───────────────────────────────
            'languages'              => 'nullable|array',
            'languages.*.language'   => 'nullable|string|max:100',
            'languages.*.level'      => 'nullable|string|in:native,fluent,C2,C1,B2,B1,A2,A1',
            'target_countries'       => 'nullable|array',
            'target_countries.*'     => 'nullable|string|max:8',
            // ── Disponibilités (accordion, optionnel) ────────────────────────
            'stay_duration'   => 'nullable|array',
            'stay_duration.*' => 'nullable|string|in:court,moyen,long,flexible',
            'flexibility'     => 'nullable|array',
            'flexibility.*'   => 'nullable|string|in:flexible,peu_flexible,pas_flexible',
            'frequency'       => 'nullable|array',
            'frequency.*'     => 'nullable|string|in:ponctuel,regulier,permanent',
            'date_from'       => 'nullable|date|after_or_equal:today',
            'date_to'         => 'nullable|date|after:date_from',
            'min_notice_days' => 'nullable|integer|min:0|max:90',
            // ── Critères (accordion, optionnel) ──────────────────────────────
            'offer_skills'      => 'nullable|array',
            'offer_skills.*'    => 'nullable|string|max:64',
            'seek_skills'       => 'nullable|array',
            'seek_skills.*'     => 'nullable|string|max:64',
            'preferred_contact' => 'nullable|string|in:message,video,phone',
            'exchange_note'     => 'nullable|string|max:1000',
            'exchange_rules'    => 'nullable|array',
        ], [
            'property_type.required'     => 'Choisissez un type de bien.',
            'property_title.required'    => 'Le titre de votre bien est obligatoire.',
            'property_desc.required'     => 'Décrivez votre bien en quelques mots.',
            'property_desc.min'          => 'La description doit comporter au moins 30 caractères.',
            'property_capacity.required' => 'La capacité est obligatoire.',
            'property_capacity.min'      => 'La capacité minimum est 1 personne.',
            'video_url.url'              => 'L\'URL de la vidéo doit être valide (YouTube ou Vimeo).',
            'video_thumbnail.image'      => 'La miniature doit être une image.',
            'video_thumbnail.mimes'      => 'Format accepté : JPG, PNG, WEBP.',
            'video_thumbnail.max'        => 'La miniature ne doit pas dépasser 5 Mo.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Filtrer les lignes de langue vides
        $languages = array_values(array_filter(
            $request->languages ?? [],
            fn ($l) => !empty($l['language'] ?? '')
        ));

        $step2Data = [
            // Bien d'échange
            'property_type'     => $request->property_type,
            'property_title'    => $request->property_title,
            'property_desc'     => $request->property_desc,
            'property_surface'  => $request->property_surface,
            'property_capacity' => $request->property_capacity,
            'property_features' => $request->property_features ?? [],
            'video_url'         => $request->video_url,
            'video_thumbnail'   => $this->saveVideoThumbnail($request, $user),
            'property_photos'   => $this->savePropertyPhotos($request, $user),
            // Langues
            'languages'         => $languages,
            'target_countries'  => $request->target_countries ?? [],
            'open_worldwide'    => $request->boolean('open_worldwide'),
            // Critères (dans le form principal)
            'offer_skills'      => $request->offer_skills ?? [],
            'seek_skills'       => $request->seek_skills ?? [],
            'exchange_rules'    => $request->exchange_rules ?? [],
            'preferred_contact' => $request->preferred_contact ?? 'message',
            'exchange_note'     => $request->exchange_note,
        ];

        // ── Champs du preplyFiltersForm (homeswap-filters) ──────────────────────
        // Ces champs sont dans un formulaire SÉPARÉ (preplyFiltersForm), non soumis
        // avec le POST step2.store. L'autosave les a déjà enregistrés en BDD.
        // On les relit depuis $saved pour ne JAMAIS les écraser par null/[].
        $saved = $this->getSession();

        // Filtres localisation
        if ($request->has('country') || !empty($saved['country'])) {
            $step2Data['country'] = $request->country ?? $saved['country'] ?? null;
        } elseif (!empty($saved['country'])) {
            $step2Data['country'] = $saved['country'];
        }
        if ($request->has('city') || !empty($saved['city'])) {
            $step2Data['city'] = $request->city ?? $saved['city'] ?? null;
        }

        // Disponibilités
        $reqFlexibility = array_values(array_filter($request->flexibility ?? []));
        $step2Data['flexibility'] = !empty($reqFlexibility) ? $reqFlexibility : ($saved['flexibility'] ?? []);

        $reqStayDuration = array_values(array_filter($request->stay_duration ?? []));
        $step2Data['stay_duration'] = !empty($reqStayDuration) ? $reqStayDuration : ($saved['stay_duration'] ?? []);

        $reqFrequency = array_values(array_filter($request->frequency ?? []));
        // !empty() au lieu de ?? pour éviter que [] (tableau vide) bloque le fallback
        $savedFreq = !empty($saved['frequency']) ? $saved['frequency'] : (!empty($saved['recurrence']) ? $saved['recurrence'] : []);
        $step2Data['frequency']  = !empty($reqFrequency) ? $reqFrequency : $savedFreq;
        $step2Data['recurrence'] = $step2Data['frequency'];

        // !empty() pour les dates : évite que "" (chaîne vide) bloque le fallback (même modèle que stay_duration)
        $reqStartDate = !empty($request->start_date) ? $request->start_date : (!empty($request->date_from) ? $request->date_from : null);
        $savedStart   = !empty($saved['start_date']) ? $saved['start_date'] : (!empty($saved['date_from']) ? $saved['date_from'] : null);
        $step2Data['start_date'] = $reqStartDate ?: $savedStart;
        $step2Data['date_from']  = $step2Data['start_date'];

        $reqEndDate = !empty($request->end_date) ? $request->end_date : (!empty($request->date_to) ? $request->date_to : null);
        $savedEnd   = !empty($saved['end_date']) ? $saved['end_date'] : (!empty($saved['date_to']) ? $saved['date_to'] : null);
        $step2Data['end_date'] = $reqEndDate ?: $savedEnd;
        $step2Data['date_to']  = $step2Data['end_date'];

        // availability_periods : normalise array → JSON string, puis fallback !empty (même modèle que stay_duration)
        $reqPeriods = $request->availability_periods ?? null;
        if (is_array($reqPeriods)) $reqPeriods = json_encode($reqPeriods);
        $savedPeriods = $saved['availability_periods'] ?? '[]';
        if (is_array($savedPeriods)) $savedPeriods = json_encode($savedPeriods);
        $step2Data['availability_periods'] = ($reqPeriods && $reqPeriods !== '[]') ? $reqPeriods
            : (($savedPeriods && $savedPeriods !== '[]') ? $savedPeriods : '[]');

        $reqMinDelay = $request->min_delay ?? $request->min_notice_days ?? null;
        $step2Data['min_delay']       = $reqMinDelay ?? ($saved['min_delay'] ?? $saved['min_notice_days'] ?? 7);
        $step2Data['min_notice_days'] = $step2Data['min_delay'];

        // Autres filtres homeswap éventuellement autosauvegardés
        foreach (['specialization', 'trip_purpose', 'date_text', 'other_languages', 'mother_tongue',
                  'property_amenities', 'nexus_domain'] as $filterKey) {
            if (!isset($step2Data[$filterKey]) && isset($saved[$filterKey])) {
                $step2Data[$filterKey] = $saved[$filterKey];
            }
        }

        // putSession() sauvegarde en session ET en BDD en un seul appel
        $this->putSession($step2Data);

        return redirect()->route('nexus.onboarding.step3');
    }

    // ─── Step 3 : Récap & Activation ─────────────────────────────────────────

    public function step3(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        // getSession() lit toujours la BDD en priorité (source de vérité)
        $saved = $this->getSession();

        // Vérifier que les étapes précédentes sont complètes
        if (empty($saved['first_name']) || empty($saved['property_type'])) {
            return redirect()->route('nexus.onboarding.step1')
                ->with('info', 'Veuillez compléter toutes les étapes pour activer votre profil NEXUS.');
        }

        $data = [
            'languages'       => old('languages', $saved['languages'] ?? [['language' => '', 'level' => 'native']]),
            'open_worldwide'  => old('open_worldwide', $saved['open_worldwide'] ?? false),
            'target_countries'=> old('target_countries', $saved['target_countries'] ?? []),
        ];

        // Lecture nexus_offer : BDD en source de vérité (même logique que nexus_onboarding)
        $offer = [];
        if (Schema::hasColumn('users', 'nexus_offer') && !empty($user->nexus_offer)) {
            $decoded = is_array($user->nexus_offer) ? $user->nexus_offer : json_decode($user->nexus_offer, true);
            if (is_array($decoded)) {
                $offer = $decoded;
            }
        }
        if (empty($offer)) {
            $offer = session('nexus_offer', []);
        }

        return view('nexus.onboarding.step3', compact('user', 'saved', 'data', 'offer'));
    }

    public function step3Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        $validator = Validator::make($request->all(), [
            'accept_terms' => 'required|accepted',
        ], [
            'accept_terms.required' => 'Vous devez accepter la charte NEXUS.',
            'accept_terms.accepted' => 'Vous devez accepter la charte NEXUS.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Sauvegarder le profil NEXUS complet
        $saved = $this->getSession();
        $saved['activated_at'] = now()->toISOString();
        $saved['accept_terms'] = true;

        // Mettre à jour l'utilisateur
        $user->first_name = $saved['first_name'] ?? $user->first_name;
        $user->last_name  = $saved['last_name'] ?? $user->last_name;
        if (!empty($saved['contact_email'])) {
            // contact_email stocké dans nexus_offer uniquement
        }

        if (Schema::hasColumn('users', 'nexus_offer')) {
            $user->nexus_offer = json_encode($saved, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        $user->save();

        // Vider la session onboarding
        session()->forget(self::SESSION_KEY);

        return redirect()->route('nexus.onboarding.complete')
            ->with('success', 'Votre profil NEXUS est maintenant actif !');
    }

    // ─── Steps 4/5/6 : Redirigent vers step2 (fusion) ───────────────────────

    public function step4(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        return redirect()->route('nexus.onboarding.step2');
    }

    public function step4Store(Request $request)
    {
        return redirect()->route('nexus.onboarding.step2');
    }

    public function step5(Request $request)
    {
        return redirect()->route('nexus.onboarding.step2');
    }

    public function step5Store(Request $request)
    {
        return redirect()->route('nexus.onboarding.step2');
    }

    /** @deprecated step6 intégré dans step3 */
    public function __step5StoreOld(Request $request)
    {
        // Ancien code step5Store conservé pour référence
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        return redirect()->route('nexus.onboarding.step2');
    }

    public function step6(Request $request)
    {
        return redirect()->route('nexus.onboarding.step3');
    }

    public function step6Store(Request $request)
    {
        return redirect()->route('nexus.onboarding.step3');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function saveVideoThumbnail(Request $request, $user): ?string
    {
        // Conserver la miniature existante si pas de nouveau fichier
        $existing = $this->getSession()['video_thumbnail'] ?? null;

        if (!$request->hasFile('video_thumbnail')) {
            return $existing;
        }

        // Supprimer l'ancienne miniature si elle existe
        if ($existing && Storage::disk('public')->exists('img/nexus-thumbnails/' . $existing)) {
            Storage::disk('public')->delete('img/nexus-thumbnails/' . $existing);
        }

        $file     = $request->file('video_thumbnail');
        $filename = 'nexus_thumb_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('img/nexus-thumbnails', $filename, 'public');

        return $filename;
    }

    private function savePropertyPhotos(Request $request, $user): array
    {
        $existing    = $this->getSession()['property_photos'] ?? [];
        $hasNewFiles = $request->hasFile('property_photos');

        // Si property_photos_keep absent et pas de nouveaux fichiers → comportement legacy (sans JS)
        if (!$request->has('property_photos_keep') && !$hasNewFiles) {
            return $existing;
        }

        // Lire la liste des filenames BDD à conserver (envoyée par JS, même modèle que miniature vidéo)
        $keep = $existing; // par défaut tout conserver
        if ($request->has('property_photos_keep')) {
            $decoded = json_decode($request->input('property_photos_keep', '[]'), true);
            $keep    = is_array($decoded) ? $decoded : $existing;
        }

        // Supprimer uniquement les photos existantes non conservées
        foreach ($existing as $oldFile) {
            if ($oldFile && !in_array($oldFile, $keep)
                && Storage::disk('public')->exists('img/nexus-photos/' . $oldFile)) {
                Storage::disk('public')->delete('img/nexus-photos/' . $oldFile);
            }
        }

        // Sauvegarder les nouveaux fichiers
        $newFiles = [];
        if ($hasNewFiles) {
            foreach ($request->file('property_photos') as $index => $file) {
                if (!$file || !$file->isValid()) continue;
                $filename = 'nexus_photo_' . $user->id . '_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img/nexus-photos', $filename, 'public');
                $newFiles[] = $filename;
            }
        }

        // Photos conservées + nouvelles (existantes en premier, nouvelles ensuite)
        return array_values(array_merge($keep, $newFiles));
    }

    // ─── Complete ──────────────────────────────────────────────────────────────

    public function complete()
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('user.login');
        }

        return view('nexus.onboarding.complete', compact('user'));
    }
}
