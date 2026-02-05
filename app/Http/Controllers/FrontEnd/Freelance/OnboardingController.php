<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    /**
     * Afficher la page "Devenir freelance" (landing page premium)
     */
    public function start()
    {
        return view('frontend.freelance.become');
    }

    /**
     * Étape 1 : À propos - Informations de base
     */
    public function step1(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        // Vérifier que l'utilisateur a un profil freelance, sinon le créer
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            // Créer le profil freelance s'il n'existe pas
            $freelancerProfile = FreelancerProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'hourly_rate' => 0,
                    'reliability_score' => 100,
                    'wellness_plan' => 'none',
                    'is_verified' => false,
                ]
            );
        }

        // Récupérer les données existantes
        $services = $freelancerProfile->skills ?? [];
        $languages = $freelancerProfile->languages ?? [];
        
        // Si pas de langues, initialiser avec une langue vide
        if (empty($languages) || !is_array($languages)) {
            $languages = [['language' => '', 'level' => 'native']];
        }

        // Structure des catégories et sous-catégories de services
        $serviceCategories = $this->getServiceCategories();
        
        // Extraire le code pays et le numéro du téléphone si existant
        $phoneCountryCode = '+33';
        $phoneNumber = '';
        if (!empty($user->phone_number)) {
            // Si le téléphone contient un code pays (format: +33 6 12 34 56 78)
            if (preg_match('/^(\+\d{1,4})\s*(.+)$/', $user->phone_number, $matches)) {
                $phoneCountryCode = $matches[1];
                $phoneNumber = $matches[2];
            } else {
                $phoneNumber = $user->phone_number;
            }
        }
        
        $data = [
            'first_name' => $user->first_name ?? old('first_name', ''),
            'last_name' => $user->last_name ?? old('last_name', ''),
            'birth_country' => $user->country_code ?? old('birth_country', ''),
            'address' => $user->address ?? old('address', ''),
            'postal_code' => $user->postal_code ?? old('postal_code', '10001'),
            'phone' => old('phone', $phoneNumber),
            'phone_country_code' => old('phone_country_code', $phoneCountryCode),
            'age_confirmation' => old('age_confirmation', false),
            'services' => old('services', $services),
            'languages' => old('languages', $languages),
        ];

        return view('frontend.freelance.onboarding.step1', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
            'serviceCategories' => $serviceCategories,
        ]);
    }

    /**
     * Sauvegarder l'étape 1
     */
    public function step1Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_country' => 'required|string|max:3',
            'services' => 'required|array|min:1',
            'services.*' => 'string|max:255',
            'languages' => 'required|array|min:1',
            'languages.*.language' => 'required|string|max:255',
            'languages.*.level' => 'required|string|in:native,fluent,intermediate,beginner',
            'phone' => 'nullable|string|max:20',
            'phone_country_code' => 'nullable|string|max:10',
            'age_confirmation' => 'required|accepted',
            'identity_document' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ], [
            'first_name.required' => __('Le prénom est obligatoire.'),
            'last_name.required' => __('Le nom est obligatoire.'),
            'birth_country.required' => __('Le pays de naissance est obligatoire.'),
            'services.required' => __('Vous devez sélectionner au moins un service.'),
            'languages.required' => __('Vous devez ajouter au moins une langue.'),
            'age_confirmation.required' => __('Vous devez confirmer avoir plus de 18 ans.'),
            'age_confirmation.accepted' => __('Vous devez confirmer avoir plus de 18 ans.'),
            'identity_document.required' => __('La pièce d\'identité est obligatoire.'),
            'identity_document.file' => __('Le fichier de pièce d\'identité est invalide.'),
            'identity_document.mimes' => __('La pièce d\'identité doit être au format JPEG, JPG, PNG ou PDF.'),
            'identity_document.max' => __('La pièce d\'identité ne doit pas dépasser 5 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mettre à jour l'utilisateur
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country_code = $request->birth_country;
        $user->address = $request->address;
        $user->postal_code = $request->postal_code ?? '10001';
        
        // Mettre à jour le téléphone si fourni
        if ($request->filled('phone')) {
            $phoneNumber = ($request->phone_country_code ?? '+33') . ' ' . $request->phone;
            $user->phone_number = $phoneNumber;
        }
        
        $user->save();

        // Gérer l'upload de la pièce d'identité
        $identityDocumentPath = null;
        if ($request->hasFile('identity_document')) {
            $file = $request->file('identity_document');
            $filename = 'identity_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $identityDocumentPath = $file->storeAs('identity_documents', $filename, 'public');
        }

        // Mettre à jour le profil freelance
        $freelancerProfile = FreelancerProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'hourly_rate' => 0,
                'reliability_score' => 100,
                'wellness_plan' => 'none',
                'is_verified' => false,
            ]
        );
        $freelancerProfile->skills = $request->services;
        $freelancerProfile->languages = $request->languages;
        if ($identityDocumentPath) {
            $freelancerProfile->identity_document = $identityDocumentPath;
        }
        $freelancerProfile->save();

        return redirect()->route('freelance.onboarding.step2')
            ->with('success', __('Étape 1 enregistrée avec succès.'));
    }

    /**
     * Obtenir les catégories et sous-catégories de services
     */
    private function getServiceCategories()
    {
        // Déterminer la langue (français par défaut)
        $locale = Session::get('currentLocaleCode', 'fr');
        $isEnglish = $locale === 'en' || $locale === 'english';

        if ($isEnglish) {
            return [
                [
                    'name' => 'GRAPHICS & DESIGN',
                    'icon' => '🎨',
                    'subcategories' => [
                        'Logo Design', 'Brand Identity', 'Web Design', 'UI/UX Design',
                        'Print Design', 'Packaging Design', 'Illustration', 'Icon Design'
                    ]
                ],
                [
                    'name' => 'DIGITAL MARKETING',
                    'icon' => '📢',
                    'subcategories' => [
                        'Social Media Marketing', 'SEO', 'Content Marketing', 'Email Marketing',
                        'PPC Advertising', 'Influencer Marketing', 'Marketing Strategy', 'Analytics'
                    ]
                ],
                [
                    'name' => 'PROGRAMMING & TECH',
                    'icon' => '💻',
                    'subcategories' => [
                        'Web Development', 'Mobile Development', 'Desktop Development',
                        'Game Development', 'E-commerce Development', 'API Development',
                        'DevOps', 'QA & Testing'
                    ]
                ],
                [
                    'name' => 'VIDEO & ANIMATION',
                    'icon' => '🎬',
                    'subcategories' => [
                        'Video Editing', 'Animation', 'Motion Graphics', 'Video Production',
                        'Video Marketing', '3D Animation', 'Visual Effects', 'Video Transcription'
                    ]
                ],
                [
                    'name' => 'WRITING & TRANSLATION',
                    'icon' => '✍️',
                    'subcategories' => [
                        'Content Writing', 'Copywriting', 'Translation', 'Proofreading',
                        'Technical Writing', 'Creative Writing', 'Blog Writing', 'Resume Writing'
                    ]
                ],
                [
                    'name' => 'MUSIC & AUDIO',
                    'icon' => '🎵',
                    'subcategories' => [
                        'Music Production', 'Voice Over', 'Audio Editing', 'Sound Design',
                        'Mixing & Mastering', 'Podcast Production', 'Jingles', 'Audio Transcription'
                    ]
                ],
                [
                    'name' => 'BUSINESS',
                    'icon' => '💼',
                    'subcategories' => [
                        'Business Consulting', 'Financial Consulting', 'Legal Consulting',
                        'Virtual Assistant', 'Data Entry', 'Project Management', 'Business Plans',
                        'Market Research'
                    ]
                ],
                [
                    'name' => 'LIFESTYLE',
                    'icon' => '⭐',
                    'subcategories' => [
                        'Life Coaching', 'Fitness', 'Nutrition', 'Beauty', 'Fashion',
                        'Travel Planning', 'Event Planning', 'Personal Styling'
                    ]
                ],
                [
                    'name' => 'DATA & ANALYTICS',
                    'icon' => '📊',
                    'subcategories' => [
                        'Data Analysis', 'Data Visualization', 'Data Entry', 'Data Science',
                        'Machine Learning', 'Business Intelligence', 'Excel', 'Database Management'
                    ]
                ],
                [
                    'name' => 'ENGINEERING & ARCHITECTURE',
                    'icon' => '🏗️',
                    'subcategories' => [
                        'Architecture', 'Engineering', 'CAD', '3D Modeling', 'Structural Engineering',
                        'Electrical Engineering', 'Mechanical Engineering', 'Interior Design'
                    ]
                ],
                [
                    'name' => 'AI SERVICES',
                    'icon' => '🤖',
                    'subcategories' => [
                        'AI Chatbots', 'AI Consulting', 'Machine Learning', 'Natural Language Processing',
                        'Computer Vision', 'AI Integration', 'AI Training', 'AI Strategy'
                    ]
                ],
                [
                    'name' => 'PHOTOGRAPHY',
                    'icon' => '📷',
                    'subcategories' => [
                        'Product Photography', 'Portrait Photography', 'Event Photography',
                        'Real Estate Photography', 'Photo Editing', 'Photo Retouching',
                        'Drone Photography', 'Food Photography'
                    ]
                ],
                [
                    'name' => 'TRADING',
                    'icon' => '📈',
                    'subcategories' => [
                        'Forex Trading', 'Stock Trading', 'Cryptocurrency Trading',
                        'Trading Strategy', 'Market Analysis', 'Investment Consulting'
                    ]
                ]
            ];
        } else {
            // Français
            return [
                [
                    'name' => 'GRAPHISME & DESIGN',
                    'icon' => '🎨',
                    'subcategories' => [
                        'Création de logo', 'Identité de marque', 'Design web', 'Design UI/UX',
                        'Design print', 'Design d\'emballage', 'Illustration', 'Design d\'icônes'
                    ]
                ],
                [
                    'name' => 'MARKETING DIGITAL',
                    'icon' => '📢',
                    'subcategories' => [
                        'Marketing des réseaux sociaux', 'SEO', 'Marketing de contenu', 'Email marketing',
                        'Publicité PPC', 'Marketing d\'influence', 'Stratégie marketing', 'Analytique'
                    ]
                ],
                [
                    'name' => 'PROGRAMMATION & TECH',
                    'icon' => '💻',
                    'subcategories' => [
                        'Développement Web', 'Développement Mobile', 'Développement Desktop',
                        'Développement de jeux', 'Développement E-commerce', 'Développement API',
                        'DevOps', 'QA & Tests'
                    ]
                ],
                [
                    'name' => 'VIDÉO & ANIMATION',
                    'icon' => '🎬',
                    'subcategories' => [
                        'Montage vidéo', 'Animation', 'Motion design', 'Production vidéo',
                        'Marketing vidéo', 'Animation 3D', 'Effets visuels', 'Transcription vidéo'
                    ]
                ],
                [
                    'name' => 'RÉDACTION & TRADUCTION',
                    'icon' => '✍️',
                    'subcategories' => [
                        'Rédaction de contenu', 'Rédaction publicitaire', 'Traduction', 'Correction',
                        'Rédaction technique', 'Rédaction créative', 'Rédaction de blog', 'Rédaction de CV'
                    ]
                ],
                [
                    'name' => 'MUSIQUE & AUDIO',
                    'icon' => '🎵',
                    'subcategories' => [
                        'Production musicale', 'Voix off', 'Montage audio', 'Design sonore',
                        'Mixage & Mastering', 'Production de podcast', 'Jingles', 'Transcription audio'
                    ]
                ],
                [
                    'name' => 'BUSINESS',
                    'icon' => '💼',
                    'subcategories' => [
                        'Conseil en affaires', 'Conseil financier', 'Conseil juridique',
                        'Assistant virtuel', 'Saisie de données', 'Gestion de projet', 'Plans d\'affaires',
                        'Étude de marché'
                    ]
                ],
                [
                    'name' => 'STYLE DE VIE',
                    'icon' => '⭐',
                    'subcategories' => [
                        'Coaching de vie', 'Fitness', 'Nutrition', 'Beauté', 'Mode',
                        'Planification de voyage', 'Organisation d\'événements', 'Styling personnel'
                    ]
                ],
                [
                    'name' => 'DONNÉES & ANALYSE',
                    'icon' => '📊',
                    'subcategories' => [
                        'Analyse de données', 'Visualisation de données', 'Saisie de données', 'Science des données',
                        'Machine Learning', 'Business Intelligence', 'Excel', 'Gestion de base de données'
                    ]
                ],
                [
                    'name' => 'INGÉNIERIE & ARCHITECTURE',
                    'icon' => '🏗️',
                    'subcategories' => [
                        'Architecture', 'Ingénierie', 'CAO', 'Modélisation 3D', 'Ingénierie structurelle',
                        'Ingénierie électrique', 'Ingénierie mécanique', 'Design d\'intérieur'
                    ]
                ],
                [
                    'name' => 'SERVICES IA',
                    'icon' => '🤖',
                    'subcategories' => [
                        'Chatbots IA', 'Conseil IA', 'Machine Learning', 'Traitement du langage naturel',
                        'Vision par ordinateur', 'Intégration IA', 'Formation IA', 'Stratégie IA'
                    ]
                ],
                [
                    'name' => 'PHOTOGRAPHIE',
                    'icon' => '📷',
                    'subcategories' => [
                        'Photographie de produit', 'Photographie portrait', 'Photographie d\'événement',
                        'Photographie immobilière', 'Retouche photo', 'Édition photo',
                        'Photographie par drone', 'Photographie culinaire'
                    ]
                ],
                [
                    'name' => 'TRADING',
                    'icon' => '📈',
                    'subcategories' => [
                        'Trading Forex', 'Trading d\'actions', 'Trading de cryptomonnaies',
                        'Stratégie de trading', 'Analyse de marché', 'Conseil en investissement'
                    ]
                ]
            ];
        }
    }

    /**
     * Étape 2 : Photo de profil
     */
    public function step2(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        return view('frontend.freelance.onboarding.step2', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
        ]);
    }

    /**
     * Sauvegarder l'étape 2 (photo de profil)
     */
    public function step2Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        // Vérifier si l'utilisateur a déjà une photo
        $hasExistingPhoto = !empty($user->image);
        
        $validator = Validator::make($request->all(), [
            'photo' => $hasExistingPhoto ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120' : 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ], [
            'photo.required' => __('Veuillez sélectionner une photo.'),
            'photo.image' => __('Le fichier doit être une image.'),
            'photo.mimes' => __('Le format de l\'image doit être JPG, PNG ou WEBP.'),
            'photo.max' => __('L\'image ne doit pas dépasser 5 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Sauvegarder la nouvelle photo si fournie
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->image && Storage::disk('public')->exists('img/users/' . $user->image)) {
                Storage::disk('public')->delete('img/users/' . $user->image);
            }

            // Sauvegarder la nouvelle photo
            $photo = $request->file('photo');
            $filename = 'freelance_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/users', $filename, 'public');

            // Mettre à jour l'utilisateur
            $user->image = $filename;
            $user->save();
        }

        // Rediriger vers l'étape 3 (Certifications)
        return redirect()->route('freelance.onboarding.step3')
            ->with('success', __('Photo de profil enregistrée avec succès.'));
    }

    /**
     * Étape 3 : Certifications
     */
    public function step3(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer les certifications existantes
        $certifications = $freelancerProfile->certifications ?? [];
        if (empty($certifications) || !is_array($certifications)) {
            $certifications = [];
        }

        $data = [
            'certifications' => old('certifications', $certifications),
            'no_certificate' => old('no_certificate', empty($certifications)),
        ];

        return view('frontend.freelance.onboarding.step3', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 3 (Certifications)
     */
    public function step3Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Si l'utilisateur n'a pas de certificat, on passe directement à l'étape suivante
        if ($request->has('no_certificate') && $request->no_certificate == '1') {
            $freelancerProfile->certifications = [];
            $freelancerProfile->save();
            
        // Rediriger vers l'étape 4 (Formation)
        return redirect()->route('freelance.onboarding.step4')
                ->with('success', __('Informations enregistrées avec succès.'));
        }

        // Validation des certifications
        $validator = Validator::make($request->all(), [
            'certifications' => 'required|array|min:1',
            'certifications.*.subject' => 'required|string|max:255',
            'certifications.*.name' => 'required|string|max:255',
            'certifications.*.description' => 'required|string|max:2000',
            'certificate_file.*' => 'nullable|image|mimes:jpeg,png,jpg|max:20480', // 20MB max
        ], [
            'certifications.required' => __('Vous devez ajouter au moins une certification ou cocher "Je n\'ai pas de certification".'),
            'certifications.min' => __('Vous devez ajouter au moins une certification ou cocher "Je n\'ai pas de certification".'),
            'certifications.*.subject.required' => __('Le domaine de compétences est obligatoire.'),
            'certifications.*.name.required' => __('Le nom de la certification est obligatoire.'),
            'certifications.*.description.required' => __('La description est obligatoire.'),
            'certificate_file.*.image' => __('Le fichier doit être une image.'),
            'certificate_file.*.mimes' => __('Le format de l\'image doit être JPG ou PNG.'),
            'certificate_file.*.max' => __('L\'image ne doit pas dépasser 20 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder les certifications
        $certifications = [];
        foreach ($request->certifications as $cert) {
            $certifications[] = [
                'subject' => $cert['subject'],
                'name' => $cert['name'],
                'description' => $cert['description'],
            ];
        }
        $freelancerProfile->certifications = $certifications;

        // Sauvegarder les fichiers de certificats si fournis
        if ($request->hasFile('certificate_file')) {
            $certificateFiles = [];
            foreach ($request->file('certificate_file') as $file) {
                $filename = 'certificate_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img/certificates', $filename, 'public');
                $certificateFiles[] = $filename;
            }
            // Stocker les noms de fichiers dans le profil (vous pouvez créer une colonne dédiée si nécessaire)
            $freelancerProfile->certificate_files = $certificateFiles;
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 4 (Formation)
        return redirect()->route('freelance.onboarding.step4')
            ->with('success', __('Certifications enregistrées avec succès.'));
    }

    /**
     * Étape 4 : Formation
     */
    public function step4(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'university' => old('university', $freelancerProfile->university ?? ''),
            'degree' => old('degree', $freelancerProfile->degree ?? ''),
            'degree_type' => old('degree_type', $freelancerProfile->degree_type ?? ''),
            'specialization' => old('specialization', $freelancerProfile->specialization ?? ''),
            'study_start_year' => old('study_start_year', $freelancerProfile->study_start_year ?? ''),
            'study_end_year' => old('study_end_year', $freelancerProfile->study_end_year ?? ''),
            'no_degree' => old('no_degree', $freelancerProfile->no_degree ?? false),
            'diploma_files' => $freelancerProfile->diploma_files ?? [],
        ];

        return view('frontend.freelance.onboarding.step4', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 4 (Formation)
     */
    public function step4Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Si l'utilisateur n'a pas de diplôme, on passe directement à l'étape suivante
        if (($request->has('no_degree') && $request->no_degree == '1') || ($request->has('no_degree_submitted') && $request->no_degree_submitted == '1')) {
            $freelancerProfile->no_degree = true;
            $freelancerProfile->university = null;
            $freelancerProfile->degree = null;
            $freelancerProfile->degree_type = null;
            $freelancerProfile->specialization = null;
            $freelancerProfile->study_start_year = null;
            $freelancerProfile->study_end_year = null;
            $freelancerProfile->diploma_files = null;
            $freelancerProfile->save();
            
            // Rediriger vers l'étape 5 (Description)
            return redirect()->route('freelance.onboarding.step5')
                ->with('success', __('Informations enregistrées avec succès.'));
        }

        // Validation des champs de formation
        $validator = Validator::make($request->all(), [
            'university' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'degree_type' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'study_start_year' => 'required|integer|min:1950|max:' . date('Y'),
            'study_end_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'diploma_file.*' => 'nullable|image|mimes:jpeg,png,jpg|max:20480', // 20MB max
        ], [
            'university.required' => __('Le nom de l\'université ou établissement est obligatoire.'),
            'degree.required' => __('Le nom du diplôme est obligatoire.'),
            'degree_type.required' => __('Le type de diplôme est obligatoire.'),
            'study_start_year.required' => __('L\'année de début d\'études est obligatoire.'),
            'study_start_year.integer' => __('L\'année de début doit être un nombre.'),
            'study_start_year.min' => __('L\'année de début doit être supérieure à 1950.'),
            'study_start_year.max' => __('L\'année de début ne peut pas être dans le futur.'),
            'study_end_year.integer' => __('L\'année de fin doit être un nombre.'),
            'study_end_year.min' => __('L\'année de fin doit être supérieure à 1950.'),
            'diploma_file.*.image' => __('Le fichier doit être une image.'),
            'diploma_file.*.mimes' => __('Le format de l\'image doit être JPG ou PNG.'),
            'diploma_file.*.max' => __('L\'image ne doit pas dépasser 20 Mo.'),
        ]);

        // Validation supplémentaire : année de fin >= année de début (seulement si pas de diplôme n'est pas coché)
        if (!$hasNoDegree && $request->filled('study_end_year') && $request->filled('study_start_year')) {
            if ($request->study_end_year < $request->study_start_year) {
                $validator->errors()->add('study_end_year', __('L\'année de fin doit être supérieure ou égale à l\'année de début.'));
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder les informations de formation
        if (!$hasNoDegree) {
            $freelancerProfile->university = $request->university;
            $freelancerProfile->degree = $request->degree;
            $freelancerProfile->degree_type = $request->degree_type;
            $freelancerProfile->specialization = $request->specialization;
            $freelancerProfile->study_start_year = $request->study_start_year;
            $freelancerProfile->study_end_year = $request->study_end_year;
            $freelancerProfile->no_degree = false;
        }

        // Sauvegarder les fichiers de diplômes si fournis
        if ($request->hasFile('diploma_file')) {
            $diplomaFiles = $freelancerProfile->diploma_files ?? [];
            foreach ($request->file('diploma_file') as $file) {
                $filename = 'diploma_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img/diplomas', $filename, 'public');
                $diplomaFiles[] = $filename;
            }
            $freelancerProfile->diploma_files = $diplomaFiles;
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 5 (Description)
        return redirect()->route('freelance.onboarding.step5')
            ->with('success', __('Informations de formation enregistrées avec succès.'));
    }

    /**
     * Étape 5 : Description du profil
     */
    public function step5(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'bio' => old('bio', $freelancerProfile->bio ?? ''),
        ];

        return view('frontend.freelance.onboarding.step5', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 5 (Description du profil)
     */
    public function step5Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'bio' => 'required|string|min:100|max:5000',
        ], [
            'bio.required' => __('La description professionnelle est obligatoire.'),
            'bio.min' => __('La description professionnelle doit contenir au moins 100 caractères.'),
            'bio.max' => __('La description professionnelle ne doit pas dépasser 5000 caractères.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder la description professionnelle
        $freelancerProfile->bio = $request->bio;

        $freelancerProfile->save();

        // Rediriger vers l'étape 6 (Vidéo)
        return redirect()->route('freelance.onboarding.step6')
            ->with('success', __('Description du profil enregistrée avec succès.'));
    }

    /**
     * Étape 6 : Vidéo de présentation
     */
    public function step6(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'video_url' => old('video_url', $freelancerProfile->video_url ?? ''),
            'video_thumbnail_url' => old('video_thumbnail_url', $freelancerProfile->video_thumbnail_url ?? ''),
        ];

        return view('frontend.freelance.onboarding.step6', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 6 (Vidéo de présentation)
     */
    public function step6Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'video_url' => 'nullable|url|max:500',
            'video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ], [
            'video_url.url' => __('L\'URL de la vidéo doit être valide.'),
            'video_url.max' => __('L\'URL de la vidéo ne doit pas dépasser 500 caractères.'),
            'video_thumbnail.image' => __('Le fichier doit être une image.'),
            'video_thumbnail.mimes' => __('Le format de l\'image doit être JPG, PNG ou WEBP.'),
            'video_thumbnail.max' => __('L\'image ne doit pas dépasser 5 Mo.'),
        ]);

        // Note: La vidéo est optionnelle pour permettre de passer à l'étape suivante
        // L'utilisateur peut ajouter sa vidéo plus tard

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder l'URL de la vidéo si fournie
        if ($request->filled('video_url')) {
            $freelancerProfile->video_url = $request->video_url;
        }

        // Sauvegarder la miniature vidéo si fournie
        if ($request->hasFile('video_thumbnail')) {
            // Supprimer l'ancienne miniature si elle existe
            if ($freelancerProfile->video_thumbnail_url && Storage::disk('public')->exists('img/video-thumbnails/' . $freelancerProfile->video_thumbnail_url)) {
                Storage::disk('public')->delete('img/video-thumbnails/' . $freelancerProfile->video_thumbnail_url);
            }

            // Sauvegarder la nouvelle miniature
            $thumbnail = $request->file('video_thumbnail');
            $filename = 'video_thumbnail_' . $user->id . '_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('img/video-thumbnails', $filename, 'public');
            $freelancerProfile->video_thumbnail_url = asset('storage/img/video-thumbnails/' . $filename);
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 7 (Disponibilité)
        return redirect()->route('freelance.onboarding.step7')
            ->with('success', __('Vidéo de présentation enregistrée avec succès.'));
    }

    /**
     * Étape 7 : Disponibilité
     */
    public function step7(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer les données existantes
        $timezone = old('timezone', $freelancerProfile->timezone ?? $user->timezone ?? '');
        $availability = old('availability', $user->availability ?? []);

        // Si availability est une chaîne JSON, la décoder
        if (is_string($availability)) {
            $availability = json_decode($availability, true) ?? [];
        }

        $data = [
            'timezone' => $timezone,
            'availability' => $availability,
        ];

        return view('frontend.freelance.onboarding.step7', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 7 (Disponibilité)
     */
    public function step7Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Déterminer le fuseau horaire à utiliser
        $timezoneToUse = null;
        if ($request->timezone_confirmed == '1') {
            // Si "Oui" est sélectionné, utiliser le fuseau horaire détecté (par défaut)
            $timezoneToUse = old('timezone', $freelancerProfile->timezone ?? $user->timezone ?? 'Europe/Paris');
        } else {
            // Si "Non" est sélectionné, utiliser celui choisi dans le dropdown
            $timezoneToUse = $request->timezone;
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'timezone' => $request->timezone_confirmed == '0' ? 'required|string|max:64' : 'nullable|string|max:64',
            'timezone_confirmed' => 'required|in:0,1',
            'availability' => 'required|array',
            'availability.*.enabled' => 'sometimes|boolean',
            'availability.*.slots' => 'required_if:availability.*.enabled,1|array|min:1',
            'availability.*.slots.*.from' => 'required_with:availability.*.slots|date_format:H:i',
            'availability.*.slots.*.to' => 'required_with:availability.*.slots|date_format:H:i|after:availability.*.slots.*.from',
        ], [
            'timezone.required' => __('Le fuseau horaire est obligatoire.'),
            'availability.required' => __('Veuillez définir au moins un jour de disponibilité.'),
            'availability.*.slots.required_if' => __('Veuillez définir au moins un créneau horaire pour les jours sélectionnés.'),
            'availability.*.slots.*.from.required_with' => __('L\'heure de début est obligatoire.'),
            'availability.*.slots.*.to.required_with' => __('L\'heure de fin est obligatoire.'),
            'availability.*.slots.*.to.after' => __('L\'heure de fin doit être postérieure à l\'heure de début.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Nettoyer les données de disponibilité (ne garder que les jours activés)
        $availability = [];
        foreach ($request->availability as $dayKey => $dayData) {
            if (isset($dayData['enabled']) && $dayData['enabled'] == '1') {
                $slots = [];
                if (isset($dayData['slots']) && is_array($dayData['slots'])) {
                    foreach ($dayData['slots'] as $slot) {
                        if (isset($slot['from']) && isset($slot['to']) && $slot['from'] < $slot['to']) {
                            $slots[] = [
                                'from' => $slot['from'],
                                'to' => $slot['to'],
                            ];
                        }
                    }
                }
                if (!empty($slots)) {
                    $availability[$dayKey] = [
                        'enabled' => true,
                        'slots' => $slots,
                    ];
                }
            }
        }

        // Vérifier qu'au moins un jour est défini
        if (empty($availability)) {
            return redirect()->back()
                ->withErrors(['availability' => __('Veuillez définir au moins un jour de disponibilité avec des créneaux horaires valides.')])
                ->withInput();
        }

        // Sauvegarder le fuseau horaire dans le profil freelance
        $freelancerProfile->timezone = $timezoneToUse;
        $freelancerProfile->save();

        // Sauvegarder la disponibilité dans l'utilisateur
        $user->timezone = $timezoneToUse;
        $user->availability = $availability;
        $user->save();

        // Rediriger vers l'étape 8 (Tarif)
        return redirect()->route('freelance.onboarding.step8')
            ->with('success', __('Disponibilités enregistrées avec succès.'));
    }

    /**
     * Étape 8 : Tarif
     */
    public function step8(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer le tarif et les données bancaires existantes
        $hourlyRate = old('hourly_rate', $freelancerProfile->hourly_rate ?? 0);
        $bankIban = old('bank_iban', $freelancerProfile->bank_iban ?? '');
        $bankAccountHolder = old('bank_account_holder', $freelancerProfile->bank_account_holder ?? '');

        // Formater l'IBAN pour l'affichage (ajouter des espaces tous les 4 caractères)
        if (!empty($bankIban)) {
            $bankIbanFormatted = '';
            $bankIbanClean = str_replace(' ', '', $bankIban);
            for ($i = 0; $i < strlen($bankIbanClean); $i++) {
                if ($i > 0 && $i % 4 === 0) {
                    $bankIbanFormatted .= ' ';
                }
                $bankIbanFormatted .= $bankIbanClean[$i];
            }
            $bankIban = $bankIbanFormatted;
        }

        $data = [
            'hourly_rate' => $hourlyRate,
            'bank_iban' => $bankIban,
            'bank_account_holder' => $bankAccountHolder,
        ];

        return view('frontend.freelance.onboarding.step8', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 8 (Tarif) et terminer l'inscription
     */
    public function step8Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Vérifier que la pièce d'identité a été téléchargée
        if (empty($freelancerProfile->identity_document)) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Vous devez d\'abord télécharger votre pièce d\'identité à l\'étape 1.'));
        }

        // Nettoyer l'IBAN avant validation (retirer les espaces)
        $ibanClean = strtoupper(str_replace(' ', '', $request->bank_iban ?? ''));
        
        // Validation
        $validator = Validator::make([
            'hourly_rate' => $request->hourly_rate,
            'bank_iban' => $ibanClean,
            'bank_account_holder' => $request->bank_account_holder,
        ], [
            'hourly_rate' => 'required|numeric|min:5|max:1000',
            'bank_iban' => 'required|string|regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{10,30}$/',
            'bank_account_holder' => 'required|string|max:255|min:2',
        ], [
            'hourly_rate.required' => __('Le tarif est obligatoire.'),
            'hourly_rate.numeric' => __('Le tarif doit être un nombre.'),
            'hourly_rate.min' => __('Le tarif minimum est de 5€ par séance.'),
            'hourly_rate.max' => __('Le tarif maximum est de 1000€ par séance.'),
            'bank_iban.required' => __('L\'IBAN est obligatoire.'),
            'bank_iban.regex' => __('L\'IBAN doit être au format valide (ex: FR76 1234 5678 9012 3456 7890 123).'),
            'bank_account_holder.required' => __('Le nom du titulaire du compte est obligatoire.'),
            'bank_account_holder.min' => __('Le nom du titulaire doit contenir au moins 2 caractères.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder le tarif et les coordonnées bancaires
        $freelancerProfile->hourly_rate = $request->hourly_rate;
        $freelancerProfile->bank_iban = $ibanClean; // Utiliser l'IBAN déjà nettoyé
        $freelancerProfile->bank_account_holder = $request->bank_account_holder;
        $freelancerProfile->save();

        // Marquer l'utilisateur comme freelance
        $user->is_freelancer = true;
        $user->save();

        // Rediriger vers une page de confirmation ou le dashboard
        return redirect()->route('freelance.onboarding.complete')
            ->with('success', __('Félicitations ! Votre profil freelance a été créé avec succès.'));
    }

    /**
     * Page de confirmation après l'inscription
     */
    public function complete()
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login');
        }

        return view('frontend.freelance.onboarding.complete', [
            'user' => $user,
        ]);
    }

    /**
     * Modifier l'email à la dernière étape
     */
    public function updateEmail(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users,email_address,' . $user->id . '|max:255',
        ], [
            'email.required' => __('L\'adresse e-mail est obligatoire.'),
            'email.email' => __('L\'adresse e-mail doit être valide.'),
            'email.unique' => __('Cette adresse e-mail est déjà utilisée.'),
            'email.max' => __('L\'adresse e-mail ne doit pas dépasser 255 caractères.'),
        ]);

        if ($validator->fails()) {
            return redirect()->route('freelance.onboarding.complete')
                ->withErrors($validator)
                ->withInput();
        }

        // Mettre à jour l'email
        $oldEmail = $user->email_address;
        $user->email_address = $request->email;
        $user->email_verified = 0; // Réinitialiser la vérification
        $user->verification_token = md5(Str::random(20) . $user->username . $user->email_address);
        $user->save();

        // Envoyer un nouvel email de vérification
        $websiteTitle = \App\Models\BasicSettings\Basic::query()->pluck('website_title')->first();
        $mailTemplate = \App\Models\MailTemplate::query()->where('mail_type', '=', 'verify_email')->first();
        
        if ($mailTemplate) {
            $mailData['subject'] = $mailTemplate->mail_subject;
            $mailBody = $mailTemplate->mail_body;

            $link = '<a href=' . url("user/signup-verify/" . $user->verification_token) . '>Click Here</a>';

            $mailBody = str_replace('{username}', $user->username, $mailBody);
            $mailBody = str_replace('{verification_link}', $link, $mailBody);
            $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

            $mailData['body'] = $mailBody;
            $mailData['recipient'] = $request->email;

            \App\Helpers\BasicMailer::sendMail($mailData);
        }

        return redirect()->route('freelance.onboarding.complete')
            ->with('success', __('Votre adresse e-mail a été modifiée avec succès. Un nouvel email de vérification a été envoyé à votre nouvelle adresse.'));
    }
}
