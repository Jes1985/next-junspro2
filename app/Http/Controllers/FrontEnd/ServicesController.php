<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Détecte l'univers à partir d'un mot-clé de recherche
     * 
     * @param string $keyword
     * @return array ['universe' => 'projects|lessons|at-home|wellnesslive|corporate|homeswap', 'confidence' => 0-100]
     */
    private function detectUniverseFromKeyword($keyword)
    {
        $keyword = mb_strtolower(trim($keyword));
        
        // Mapping des mots-clés vers les univers avec scores de confiance
        $mappings = [
            // Projets et Consulting
            'projects' => [
                'keywords' => [
                    'marketing digital', 'marketing', 'seo', 'référencement', 'publicité en ligne', 'réseaux sociaux',
                    'développement web', 'développement mobile', 'programmation', 'tech', 'e-commerce', 'api', 'backend', 'devops',
                    'graphisme', 'design', 'logo', 'illustration', 'ui/ux', 'ui', 'ux',
                    'vidéo', 'animation', 'montage', 'motion design',
                    'rédaction', 'traduction', 'copywriting',
                    'business', 'conseil stratégique', 'business plan', 'étude de marché',
                    'musique', 'audio', 'mixage', 'mastering',
                    'finance', 'comptabilité', 'gestion financière', 'conseil fiscal',
                    'photographie', 'photo',
                    'community manager', 'community management',
                    'services ia', 'chatbots', 'automatisation ia', 'ia',
                    'data', 'big data', 'machine learning', 'business intelligence',
                    'consultation', 'consultation juridique', 'consultation rh', 'consultation marketing',
                    'coaching professionnel', 'formation professionnelle',
                ],
                'confidence' => 100
            ],
            // Cours
            'lessons' => [
                'keywords' => [
                    'anglais', 'français', 'espagnol', 'allemand', 'italien', 'portugais', 'arabe', 'russe', 'chinois', 'japonais', 'coréen',
                    'ielts', 'toefl', 'toeic', 'cambridge', 'delf', 'dalf', 'dele', 'goethe',
                    'mathématiques', 'maths', 'physique', 'chimie', 'biologie', 'histoire', 'géographie',
                    'soutien scolaire', 'aide aux devoirs',
                    'économie', 'statistiques', 'droit', 'sciences sociales', 'philosophie', 'méthodologie',
                    'bureautique', 'excel', 'word', 'no-code', 'cybersécurité',
                    'communication pro', 'présentations', 'entretiens', 'cv', 'linkedin',
                    'prise de parole', 'leadership', 'confiance en soi', 'gestion du stress',
                ],
                'confidence' => 100
            ],
            // Services at Home
            'at-home' => [
                'keywords' => [
                    'beauté', 'massage', 'relaxation', 'ménage', 'repassage',
                    'coaching sportif', 'bien-être', 'amma assis', 'do-in', 'accompagnement familial',
                ],
                'confidence' => 100
            ],
            // WellnessLive / Ritual Motion
            'wellnesslive' => [
                'keywords' => [
                    'pilates', 'yoga', 'bodybalance', 'bodysculpt', 'bodycombat', 'bodyattack',
                    'boxing', 'cross training', 'hiit', 'cardio', 'zumba',
                    'stretching', 'ritual flow', 'ritual reset',
                    'lesmills', 'well circuit', 'wellrun',
                ],
                'confidence' => 100
            ],
            // Bien-être en entreprise
            'corporate' => [
                'keywords' => [
                    'bien-être en entreprise', 'entreprise', 'corporate', 'séances', 'conférences', 'ateliers',
                ],
                'confidence' => 100
            ],
            // Échanges de logement
            'homeswap' => [
                'keywords' => [
                    'échanges de logement', 'homeswap', 'logement', 'chambre', 'appartement', 'maison', 'penthouse',
                ],
                'confidence' => 100
            ],
        ];
        
        $bestMatch = null;
        $bestScore = 0;
        
        foreach ($mappings as $universe => $data) {
            foreach ($data['keywords'] as $mappedKeyword) {
                // Correspondance exacte
                if ($keyword === mb_strtolower($mappedKeyword)) {
                    return ['universe' => $universe, 'confidence' => 100];
                }
                // Correspondance partielle (le mot-clé contient le mot mappé ou vice versa)
                if (strpos($keyword, mb_strtolower($mappedKeyword)) !== false || 
                    strpos(mb_strtolower($mappedKeyword), $keyword) !== false) {
                    $score = $data['confidence'];
                    if ($score > $bestScore) {
                        $bestScore = $score;
                        $bestMatch = $universe;
                    }
                }
            }
        }
        
        return $bestMatch ? ['universe' => $bestMatch, 'confidence' => $bestScore] : null;
    }

    /**
     * Construit la requête de base pour les freelances.
     * Filtre status optionnel : si la colonne existe, on ne garde que les utilisateurs actifs (status=1).
     */
    private function getBaseFreelancersQuery()
    {
        return FreelancerProfile::with('user')
            ->whereHas('user', function($q) {
                if (Schema::hasColumn('users', 'status')) {
                    $q->where('status', 1);
                }
            });
    }

    /**
     * Affiche la page HUB /services
     */
    public function index(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['seoInfo'] = $language->seoInfo()->select('meta_keyword_home', 'meta_description_home')->first();
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();

        // Source unique : config Univers → Domaines (hero hub)
        $hubConfig = config('services_universes', []);
        $hubUniversesList = $hubConfig['universes'] ?? [];
        $hubDomainsByUniverse = $hubConfig['domains_by_universe'] ?? [];
        $hubRoutes = $hubConfig['routes'] ?? [];
        $queryResult['hubUniverses'] = collect($hubUniversesList)->map(fn ($label, $slug) => ['slug' => $slug, 'label' => $label])->values()->all();
        $queryResult['hubUniverseDomains'] = $hubDomainsByUniverse;

        // Si recherche depuis le hero (universe choisi) : redirection vers la page univers avec les paramètres
        if ($request->filled('universe') && isset($hubRoutes[$request->universe])) {
            $routeName = $hubRoutes[$request->universe];
            $params = [];
            if ($request->filled('specialization')) {
                $params['category'] = $request->specialization;
            }
            if ($request->filled('search')) {
                $params['search'] = $request->search;
            }
            if ($request->filled('country')) {
                $params['country'] = $request->country;
            }
            if ($request->filled('city')) {
                $params['city'] = $request->city;
            }
            return redirect()->route($routeName, $params);
        }
        
        // Définir les univers pour le composant (grille des univers)
        $queryResult['universes'] = [
            [
                'title' => 'Projets et Consulting',
                'baseline' => 'De "j\'ai une idée" à "c\'est réalisé".',
                'text' => 'Brief clair, exécution rapide, livrables propres. Vous gardez le cap, on avance.',
                'cta' => 'Réserver un rituel d\'essai',
                'url' => route('services.projects')
            ],
            [
                'title' => 'Cours et Tutorat',
                'baseline' => 'Apprendre avec quelqu\'un qui vous suit vraiment.',
                'text' => 'Objectifs simples, méthode adaptée, progression visible — à votre rythme.',
                'cta' => 'Trouver un freelance',
                'url' => route('services.lessons')
            ],
            [
                'title' => 'Rituals Services',
                'baseline' => 'Le Rituel vient à vous, tout simplement.',
                'text' => 'Beauté, bien-être, récupération… Réservez un Rituel et profitez.',
                'cta' => 'Réserver un rituel d\'essai',
                'url' => route('services.at-home')
            ],
            [
                'title' => 'Ritual Motion',
                'baseline' => 'Live maintenant. Replay quand vous voulez.',
                'text' => '1-1, groupe ou VOD premium — même énergie, même régularité.',
                'cta' => 'Réserver un rituel d\'essai',
                'url' => route('services.wellnesslive')
            ],
            [
                'title' => 'Échanges de logement',
                'baseline' => 'Voyager autrement, en toute confiance.',
                'text' => 'Court, moyen ou long : trouvez le bon échange, dans la bonne ville, au bon moment.',
                'cta' => 'Réserver un rituel d\'essai',
                'url' => route('services.homeswap')
            ],
            [
                'title' => 'Présence',
                'baseline' => 'Prendre soin des équipes, avec des formats adaptés.',
                'text' => 'Séances, ateliers, conférences : une expérience simple, claire, efficace.',
                'cta' => 'Réserver un rituel d\'essai',
                'url' => route('services.corporate')
            ]
        ];
        
        return view('services.index', $queryResult);
    }

    /**
     * Affiche la page /services/projects
     */
    public function projects(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Taxonomie V2 (Malt-inspired) — 11 domaines + spécialisations pro, max ~6 par domaine
        $queryResult['categories'] = [
            ['slug' => 'strategie-conseil', 'label' => 'Stratégie & Conseil', 'description' => 'Vision, structuration et décisions à fort enjeu.'],
            ['slug' => 'marketing-croissance', 'label' => 'Marketing & Croissance', 'description' => 'Positionnement, acquisition et développement durable.'],
            ['slug' => 'tech-produits-digitaux', 'label' => 'Tech & Produits digitaux', 'description' => 'Conception, évolution et performance des solutions digitales.'],
            ['slug' => 'creation-image-marque', 'label' => 'Création & Image de marque', 'description' => 'Identité, narration et impact de marque.'],
            ['slug' => 'formation-accompagnement', 'label' => 'Formation & Accompagnement', 'description' => 'Accompagnement stratégique et transmission ciblée.'],
            ['slug' => 'gestion-projet-produit', 'label' => 'Gestion de projet & Produit', 'description' => 'Pilotage, delivery et coordination produit.'],
            ['slug' => 'data-ia', 'label' => 'Data & IA', 'description' => 'Analyse, modèles et IA appliquée au business.'],
            ['slug' => 'cybersecurite-it', 'label' => 'Cybersécurité & IT', 'description' => 'Sécurité, systèmes et fiabilité des environnements.'],
            ['slug' => 'design-creation', 'label' => 'Design & Création', 'description' => 'Expérience, interfaces et identités visuelles.'],
            ['slug' => 'photo-video-motion', 'label' => 'Photo / Vidéo / Motion', 'description' => 'Production, narration et contenus audiovisuels.'],
            ['slug' => 'redaction-communication', 'label' => 'Rédaction & Communication', 'description' => 'Contenus, éditorial et communication de marque.'],
        ];
        $queryResult['domainSpecializations'] = [
            'strategie-conseil' => [
                ['consultants_strategie', 'Consultants en stratégie'],
                ['consultants_communication', 'Consultants en communication'],
                ['business_developers', 'Business developers'],
                ['consultants_organisation_transformation', 'Consultants organisation & transformation'],
                ['consultants_finance_modelisation', 'Consultants finance & modélisation'],
            ],
            'marketing-croissance' => [
                ['consultants_marketing', 'Consultants marketing'],
                ['consultants_webmarketing', 'Consultants webmarketing'],
                ['consultants_analytics', 'Consultants analytics'],
                ['consultants_seo', 'Consultants SEO'],
                ['crm_email_marketing', 'CRM & Email marketing'],
                ['acquisition_visibilite', 'Acquisition & visibilité'],
            ],
            'tech-produits-digitaux' => [
                ['developpeurs_backend', 'Développeurs Back-End'],
                ['developpeurs_frontend', 'Développeurs Front-End'],
                ['developpeurs_fullstack', 'Développeurs Full-Stack'],
                ['developpeurs_mobile', 'Développeurs mobile (iOS / Android)'],
                ['devops_cloud', 'DevOps & Cloud'],
                ['qa_tests', 'QA / Tests'],
            ],
            'creation-image-marque' => [
                ['brand_designers', 'Brand designers'],
                ['directeurs_artistiques', 'Directeurs artistiques'],
                ['graphistes', 'Graphistes'],
                ['ux_designers', 'UX designers'],
                ['ui_designers', 'UI designers'],
                ['webdesigners', 'Webdesigners'],
            ],
            'formation-accompagnement' => [
                ['coaching_professionnel', 'Coaching professionnel'],
                ['formation_business', 'Formation business (dirigeants & équipes)'],
                ['mentorat_strategique', 'Mentorat stratégique'],
                ['accompagnement_dirigeants', 'Accompagnement dirigeants'],
            ],
            'gestion-projet-produit' => [
                ['chefs_de_projet', 'Chefs de projet'],
                ['product_managers', 'Product managers'],
                ['coachs_agiles', 'Coachs agiles'],
                ['scrum_masters', 'Scrum masters'],
                ['pmo', 'PMO'],
            ],
            'data-ia' => [
                ['data_analysts_bi', 'Data analysts / BI'],
                ['data_scientists', 'Data scientists'],
                ['data_engineers', 'Data engineers'],
                ['machine_learning_engineers', 'Machine Learning engineers'],
                ['ia_appliquee_business', 'IA appliquée (cas d\'usage business)'],
            ],
            'cybersecurite-it' => [
                ['experts_cybersecurite', 'Experts cybersécurité'],
                ['administrateurs_systemes_reseaux', 'Administrateurs systèmes & réseaux'],
                ['administrateurs_base_donnees', 'Administrateurs base de données'],
                ['support_it_helpdesk', 'Support IT / Helpdesk'],
                ['gouvernance_conformite', 'Gouvernance & conformité'],
            ],
            'design-creation' => [
                ['ux_designers', 'UX designers'],
                ['ui_designers', 'UI designers'],
                ['webdesigners', 'Webdesigners'],
                ['graphistes', 'Graphistes'],
                ['directeurs_artistiques', 'Directeurs artistiques'],
                ['brand_designers', 'Brand designers'],
            ],
            'photo-video-motion' => [
                ['photographes', 'Photographes'],
                ['realisateurs', 'Réalisateurs'],
                ['motion_designers', 'Motion designers'],
                ['monteurs_video', 'Monteurs vidéo'],
                ['sound_designers', 'Sound designers'],
            ],
            'redaction-communication' => [
                ['community_managers', 'Community managers'],
                ['concepteurs_redacteurs', 'Concepteurs-rédacteurs'],
                ['responsables_editoriaux', 'Responsables éditoriaux'],
                ['charges_relations_presse', 'Chargés de relations presse'],
                ['strategie_contenu', 'Stratégie de contenu'],
            ],
        ];

        // Mapping slug → mots-clés pour le filtre category (recherche dans bio, profile_title, specialization)
        $domainKeywordMap = [
            'strategie-conseil' => ['stratégie', 'conseil', 'vision', 'structuration', 'décisions', 'enjeu'],
            'marketing-croissance' => ['marketing', 'croissance', 'positionnement', 'acquisition', 'développement durable'],
            'tech-produits-digitaux' => ['tech', 'digital', 'produit', 'conception', 'développement', 'performance'],
            'creation-image-marque' => ['création', 'identité', 'marque', 'narration', 'branding', 'design'],
            'formation-accompagnement' => ['formation', 'accompagnement', 'compétence', 'mentorat', 'montée en compétence'],
            'gestion-projet-produit' => ['projet', 'produit', 'pilotage', 'delivery', 'agile', 'scrum', 'pmo'],
            'data-ia' => ['data', 'ia', 'intelligence artificielle', 'analytics', 'machine learning', 'bi'],
            'cybersecurite-it' => ['cybersécurité', 'sécurité', 'systèmes', 'réseaux', 'it', 'infrastructure'],
            'design-creation' => ['design', 'ux', 'ui', 'interface', 'expérience utilisateur', 'graphisme'],
            'photo-video-motion' => ['photo', 'vidéo', 'motion', 'production', 'audiovisuel', 'montage'],
            'redaction-communication' => ['rédaction', 'communication', 'éditorial', 'contenu', 'community', 'pr'],
        ];
        
        // Récupérer les freelances/professeurs avec leurs données
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        // Appliquer les filtres si présents
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        // Gérer le filtre de prix (format price_range ou price_min/price_max)
        // Note: Pour projects, on ne filtre pas par price_range côté serveur pour permettre l'estimation côté client
        if ($request->has('price_min')) {
            $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
        }
        
        if ($request->has('price_max')) {
            $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
        }
        
        // Filtre "Super profs uniquement" (super_only=1)
        if ($request->has('super_only') && $request->super_only == '1') {
            $freelancersQuery->whereHas('user', function($q) {
                $q->where('is_super_freelancer', 1);
            });
        }
        
        // Filtre "Professeurs qualifiés uniquement" (qualified_only=1)
        if ($request->has('qualified_only') && $request->qualified_only == '1') {
            $freelancersQuery->where(function($q) {
                $q->where('is_verified', 1)
                  ->orWhereNotNull('certifications')
                  ->where('certifications', '!=', '[]');
            });
        }
        
        // Filtre "Le freelance parle" (teacher_speaks)
        if ($request->has('teacher_speaks')) {
            $selectedLanguages = $request->input('teacher_speaks', []);
            
            // Normaliser : peut être un tableau ou une chaîne
            if (!is_array($selectedLanguages)) {
                // Si c'est une chaîne avec des virgules, la diviser
                if (is_string($selectedLanguages) && strpos($selectedLanguages, ',') !== false) {
                    $selectedLanguages = array_filter(array_map('trim', explode(',', $selectedLanguages)));
                } else {
                    $selectedLanguages = [$selectedLanguages];
                }
            }
            
            // Filtrer les valeurs vides
            $selectedLanguages = array_filter($selectedLanguages, function($lang) {
                return !empty($lang) && $lang !== '';
            });
            
            if (!empty($selectedLanguages)) {
                $nativeOnly = $request->has('native_only') && $request->native_only == '1';
                
                // Normaliser les codes de langue (en minuscules)
                $selectedLanguages = array_map('strtolower', $selectedLanguages);
                
                // Vérifier si la table freelancer_languages existe et contient des données
                try {
                    $hasLanguageTable = Schema::hasTable('freelancer_languages');
                    $languageTableCount = $hasLanguageTable ? DB::table('freelancer_languages')->count() : 0;
                    
                    if ($hasLanguageTable && $languageTableCount > 0) {
                        // Utiliser la table freelancer_languages (nouveau système)
                        $freelancersQuery->whereHas('languages', function($q) use ($selectedLanguages, $nativeOnly) {
                            $q->whereIn('language_code', $selectedLanguages);
                            
                            // Si "Natif uniquement" est activé, filtrer par niveau native
                            if ($nativeOnly) {
                                $q->where('level', 'native');
                            }
                        });
                    } else {
                        // Fallback : utiliser le champ JSON languages (ancien système)
                        $freelancersQuery->where(function($q) use ($selectedLanguages, $nativeOnly) {
                            foreach ($selectedLanguages as $langCode) {
                                $q->orWhere(function($subQ) use ($langCode, $nativeOnly) {
                                    // Chercher dans le JSON : {"code": "en", "level": "native"} ou ["en"] ou "en"
                                    $subQ->whereJsonContains('languages', $langCode)
                                         ->orWhere('languages', 'like', '%"' . $langCode . '"%')
                                         ->orWhere('languages', 'like', '%' . $langCode . '%');
                                    
                                    // Si "Natif uniquement", vérifier aussi le niveau
                                    if ($nativeOnly) {
                                        $subQ->where(function($nativeQ) use ($langCode) {
                                            $nativeQ->whereJsonContains('languages', ['code' => $langCode, 'level' => 'native'])
                                                    ->orWhere('languages', 'like', '%"code":"' . $langCode . '","level":"native"%')
                                                    ->orWhere('languages', 'like', '%"code":"' . $langCode . '","level":"Natif"%');
                                        });
                                    }
                                });
                            }
                        });
                    }
                } catch (\Exception $e) {
                    // En cas d'erreur, utiliser le fallback JSON
                    $freelancersQuery->where(function($q) use ($selectedLanguages) {
                        foreach ($selectedLanguages as $langCode) {
                            $q->orWhere('languages', 'like', '%' . $langCode . '%');
                        }
                    });
                }
            }
        }
        
        // Filtre par pays (country)
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        
        // Filtre par ville (city) - nécessite un pays sélectionné
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }
        
        // Filtre par mode d'intervention (mode[])
        if ($request->has('mode') && is_array($request->mode)) {
            $modes = $request->mode;
            if (in_array('hybrid', $modes)) {
                // Hybride : freelancers qui peuvent travailler en ligne ET en présentiel
                $freelancersQuery->where('can_online', true)->where('can_onsite', true);
            } elseif (in_array('online', $modes) && !in_array('onsite', $modes)) {
                // En ligne uniquement
                $freelancersQuery->where('can_online', true);
            } elseif (in_array('onsite', $modes) && !in_array('online', $modes)) {
                // En présentiel uniquement
                $freelancersQuery->where('can_onsite', true);
            }
            // Si les deux sont sélectionnés (online + onsite), pas de filtre restrictif
        }

        // Filtre par catégorie/domaine (V1 : 5 slugs → recherche par mots-clés)
        if ($request->has('category') && $request->category) {
            $category = strtolower(trim($request->category));
            if (isset($domainKeywordMap[$category])) {
                $keywords = $domainKeywordMap[$category];
                $freelancersQuery->where(function($q) use ($keywords) {
                    foreach ($keywords as $kw) {
                        $q->orWhere('bio', 'like', '%' . $kw . '%')
                          ->orWhere('profile_title', 'like', '%' . $kw . '%')
                          ->orWhere('specialization', 'like', '%' . $kw . '%');
                    }
                });
            }
        }

        // Filtre Spécialisation (V1 : lié au domaine, slugs premium)
        if ($request->has('specialization') && $request->specialization) {
            $spec = $request->specialization;
            $freelancersQuery->where(function($q) use ($spec) {
                $q->where('specialization', 'like', '%' . $spec . '%')
                  ->orWhere('profile_title', 'like', '%' . $spec . '%')
                  ->orWhere('bio', 'like', '%' . $spec . '%');
            });
        }
        
        // Récupérer les freelances
        $freelancers = $freelancersQuery->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->paginate(20);
        
        $queryResult['freelancers'] = $freelancers;
        $queryResult['filters'] = $request->only(['search', 'price_min', 'price_max', 'category', 'specialization', 'country', 'city', 'availability', 'price_range', 'super_only', 'qualified_only', 'teacher_speaks', 'native_only', 'mode', 'experience_level']);
        $queryResult['hasNoResults'] = $freelancers->isEmpty() && ($request->has('country') || $request->has('city'));
        
        return view('services.projects', $queryResult);
    }

    /**
     * Affiche la page /services/lessons
     */
    public function lessons(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Catégories et sous-catégories pour les cours — 6 domaines premium (signature Junspro, micro-descriptions dans level-2-filters)
        $queryResult['categories'] = [
            'Langues' => [
                'Anglais', 'Français', 'Espagnol', 'Allemand', 'Italien', 'Portugais', 'Arabe', 'Russe', 'Chinois (Mandarin)', 'Japonais', 'Coréen', 'Turc', 'Néerlandais', 'Polonais', 'Ukrainien', 'Grec', 'Hébreu', 'Suédois', 'Norvégien', 'Tchèque', 'Thaï', 'Vietnamien', 'Indonésien', 'Autres langues'
            ],
            'Certifications' => [
                'IELTS', 'TOEFL', 'TOEIC', 'Cambridge (A2–C2)', 'DELF', 'DALF', 'DELE', 'Goethe-Zertifikat', 'SAT', 'ACT', 'GMAT', 'Autres certifications'
            ],
            'Soutien scolaire' => [
                'Mathématiques', 'Français', 'Anglais scolaire', 'Physique', 'Chimie', 'Biologie', 'Histoire', 'Géographie', 'Aide aux devoirs', 'Économie', 'Finance', 'Comptabilité'
            ],
            'Études & supérieur' => [
                'Statistiques', 'Droit (bases)', 'Sciences sociales', 'Philosophie', 'Méthodologie (mémoire/dissertation)'
            ],
            'Tech & outils' => [
                'Programmation (Python/JS/Java…)', 'Développement Web', 'Data / IA (initiation)', 'Bureautique (Excel/Word)', 'No-code', 'Cybersécurité (bases)'
            ],
            'Carrière & soft skills' => [
                'Communication pro', 'Présentations', 'Entretiens d\'embauche', 'CV / LinkedIn', 'Gestion de projet'
            ]
        ];
        
        // Micro-descriptions des domaines Cours & Tutorat (dropdown Domaine — titre + sous-texte)
        $queryResult['categoryDescriptions'] = [
            'langues' => 'Expression, compréhension et fluidité pour progresser vite.',
            'certifications' => 'Préparation structurée aux examens et objectifs de score.',
            'soutien-scolaire' => 'Méthode, confiance et progression du primaire au lycée.',
            'etudes-superieur' => 'Méthodologie, rédaction et réussite universitaire.',
            'tech-outils' => 'Compétences numériques pratiques : outils, code, data, IA.',
            'carriere-soft-skills' => 'CV, entretiens, communication et compétences professionnelles.',
        ];
        
        // Objectifs de cours
        $queryResult['lessonGoals'] = [
            'conversation_beginner' => 'Conversation (Débutant)',
            'conversation_intermediate' => 'Conversation (Intermédiaire)',
            'conversation_advanced' => 'Conversation (Avancé)',
            'business' => 'Business',
            'exams' => 'Examens',
            'kids' => 'Enfants',
            'travel' => 'Voyage'
        ];
        
        // Récupérer les freelances/professeurs avec leurs données
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        // Appliquer les filtres si présents
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filtre par catégorie/sous-catégorie (domaine) — accepte sous-catégorie, slug de sous-catégorie, slug de domaine (bloc Projects) et specialization
        $categoryToUse = ($request->has('specialization') && $request->specialization) ? strtolower($request->specialization) : (($request->has('category') && $request->category) ? strtolower($request->category) : null);
        if ($categoryToUse) {
            $allSubcategories = collect($queryResult['categories'])->flatten()->map(function($sub) {
                return strtolower($sub);
            })->toArray();
            $subToSearch = null;
            if (in_array($categoryToUse, $allSubcategories)) {
                $subToSearch = $categoryToUse;
            } else {
                foreach (collect($queryResult['categories'])->flatten() as $sub) {
                    if (strtolower(\Illuminate\Support\Str::slug($sub)) === $categoryToUse) {
                        $subToSearch = strtolower($sub);
                        break;
                    }
                }
            }
            if ($subToSearch) {
                $freelancersQuery->where(function($q) use ($subToSearch) {
                    $q->where('bio', 'like', "%{$subToSearch}%")
                      ->orWhere('profile_title', 'like', "%{$subToSearch}%")
                      ->orWhere('specialization', 'like', "%{$subToSearch}%")
                      ->orWhereJsonContains('skills', $subToSearch);
                });
            } else {
                foreach ($queryResult['categories'] as $dom => $subs) {
                    if (strtolower(\Illuminate\Support\Str::slug($dom)) === $categoryToUse) {
                        $terms = array_map('strtolower', (array) $subs);
                        $freelancersQuery->where(function($q) use ($terms) {
                            foreach ($terms as $t) {
                                $q->orWhere(function($q2) use ($t) {
                                    $q2->where('bio', 'like', "%{$t}%")
                                       ->orWhere('profile_title', 'like', "%{$t}%")
                                       ->orWhere('specialization', 'like', "%{$t}%")
                                       ->orWhereJsonContains('skills', $t);
                                });
                            }
                        });
                        break;
                    }
                }
            }
        }
        
        // Filtre par objectif du cours (lesson_goal)
        if ($request->has('lesson_goal') && $request->lesson_goal) {
            $lessonGoal = $request->lesson_goal;
            // Mapper les objectifs vers des mots-clés à chercher
            $goalKeywords = [
                'conversation_beginner' => ['débutant', 'beginner', 'niveau 1', 'niveau a1', 'niveau a2'],
                'conversation_intermediate' => ['intermédiaire', 'intermediate', 'niveau 2', 'niveau b1', 'niveau b2'],
                'conversation_advanced' => ['avancé', 'advanced', 'niveau 3', 'niveau c1', 'niveau c2'],
                'business' => ['business', 'professionnel', 'professionnel', 'entreprise', 'corporate'],
                'exams' => ['examen', 'exam', 'test', 'ielts', 'toefl', 'delf', 'dalf', 'certification'],
                'kids' => ['enfant', 'kid', 'jeune', 'adolescent', 'scolaire'],
                'travel' => ['voyage', 'travel', 'tourisme', 'vacances']
            ];
            
            if (isset($goalKeywords[$lessonGoal])) {
                $keywords = $goalKeywords[$lessonGoal];
                $freelancersQuery->where(function($q) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $q->orWhere('bio', 'like', "%{$keyword}%")
                          ->orWhere('profile_title', 'like', "%{$keyword}%")
                          ->orWhere('specialization', 'like', "%{$keyword}%");
                    }
                });
            }
        }
        
        // Filtre par pays (country) — hero Pays + Ville (identique HomeSwap)
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        
        // Filtre par ville (city) — prioritaire si présent
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }
        
        // Gérer le filtre de prix (format price_range ou price_min/price_max)
        if ($request->has('price_range') && $request->price_range) {
            $range = $request->price_range;
            if ($range == '0-20') {
                $freelancersQuery->whereBetween('hourly_rate', [0, 20]);
            } elseif ($range == '20-30') {
                $freelancersQuery->whereBetween('hourly_rate', [20, 30]);
            } elseif ($range == '30-40') {
                $freelancersQuery->whereBetween('hourly_rate', [30, 40]);
            } elseif ($range == '40+') {
                $freelancersQuery->where('hourly_rate', '>=', 40);
            }
        } else {
            if ($request->has('price_min')) {
                $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
            }
            
            if ($request->has('price_max')) {
                $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
            }
        }
        
        // Filtre "Super freelances uniquement" (super_only=1) : note ≥ 4,5/5 et au moins 3 avis vérifiés
        if ($request->has('super_only') && $request->super_only == '1') {
            $freelancersQuery->where('reliability_score', '>=', 90); // 90/20 = 4,5/5
        }
        
        // Filtre "Freelances qualifiés uniquement" (qualified_only=1) : diplômes, certifications ou attestations vérifiés
        if ($request->has('qualified_only') && $request->qualified_only == '1') {
            $freelancersQuery->where(function($q) {
                $q->where('is_verified', 1)
                  ->orWhere(function($q2) {
                      $q2->whereNotNull('certifications')->where('certifications', '!=', '[]');
                  });
            });
        }
        
        // Filtre "Nouveau Talent" (new_only=1) : inscrits depuis moins d'1 mois ou encore peu notés (< 3 avis)
        if ($request->has('new_only') && $request->new_only == '1') {
            $freelancersQuery->where('freelancer_profiles.created_at', '>=', now()->subMonth());
        }
        
        // Récupérer les freelances (27 par page pour afficher toutes les cartes attendues)
        $freelancers = $freelancersQuery->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->paginate(27);
        
        $queryResult['freelancers'] = $freelancers;
        $queryResult['filters'] = $request->only(['search', 'price_min', 'price_max', 'category', 'specialization', 'country', 'city', 'availability', 'lesson_goal', 'super_only', 'qualified_only', 'new_only']);
        
        return view('services.lessons', $queryResult);
    }

    /**
     * Affiche la page /services/at-home (système de filtres identique à lessons)
     */
    public function atHome(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Catégories hiérarchiques (même format que lessons) — services à domicile
        $queryResult['categories'] = [
            'Beauté & soins' => [
                'Beauté', 'Coiffure', 'Manucure', 'Soins du visage', 'Épilation', 'Maquillage'
            ],
            'Massage & relaxation' => [
                'Massage & relaxation', 'Amma assis', 'Do-In', 'Réflexologie', 'Relaxation'
            ],
            'Ménage & repassage' => [
                'Ménage', 'Repassage', 'Ménage & repassage', 'Entretien du domicile'
            ],
            'Bien-être & sport' => [
                'Coaching sportif', 'Bien-être', 'Yoga à domicile', 'Pilates', 'Stretching'
            ],
            'Accompagnement' => [
                'Accompagnement familial', 'Garde d\'enfants', 'Aide à la personne'
            ],
        ];
        // Micro-descriptions des domaines Rituals Services (dropdown Domaine — titre + sous-texte)
        $queryResult['categoryDescriptions'] = [
            'beaute-soins' => 'Beauté à domicile, gestes précis et finition impeccable.',
            'massage-relaxation' => 'Relâchement profond, récupération et sérénité sur-mesure.',
            'menage-repassage' => 'Intérieur net, détails soignés, service discret et fiable.',
            'bien-etre-sport' => 'Énergie, mobilité, équilibre : un accompagnement juste et progressif.',
            'accompagnement' => 'Soutien du quotidien, présence fiable et organisation sans charge mentale.',
        ];
        $queryResult['lessonGoals'] = [];
        
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        $categoryToUse = ($request->has('specialization') && $request->specialization) ? strtolower($request->specialization) : (($request->has('category') && $request->category) ? strtolower($request->category) : null);
        if ($categoryToUse) {
            $allSubcategories = collect($queryResult['categories'])->flatten()->map(function($sub) {
                return strtolower($sub);
            })->toArray();
            $subToSearch = null;
            if (in_array($categoryToUse, $allSubcategories)) {
                $subToSearch = $categoryToUse;
            } else {
                foreach (collect($queryResult['categories'])->flatten() as $sub) {
                    if (strtolower(\Illuminate\Support\Str::slug($sub)) === $categoryToUse) {
                        $subToSearch = strtolower($sub);
                        break;
                    }
                }
            }
            if ($subToSearch) {
                $freelancersQuery->where(function($q) use ($subToSearch) {
                    $q->where('bio', 'like', "%{$subToSearch}%")
                      ->orWhere('profile_title', 'like', "%{$subToSearch}%")
                      ->orWhere('specialization', 'like', "%{$subToSearch}%")
                      ->orWhereJsonContains('skills', $subToSearch);
                });
            } else {
                foreach ($queryResult['categories'] as $dom => $subs) {
                    if (strtolower(\Illuminate\Support\Str::slug($dom)) === $categoryToUse) {
                        $terms = array_map('strtolower', (array) $subs);
                        $freelancersQuery->where(function($q) use ($terms) {
                            foreach ($terms as $t) {
                                $q->orWhere(function($q2) use ($t) {
                                    $q2->where('bio', 'like', "%{$t}%")
                                       ->orWhere('profile_title', 'like', "%{$t}%")
                                       ->orWhere('specialization', 'like', "%{$t}%")
                                       ->orWhereJsonContains('skills', $t);
                                });
                            }
                        });
                        break;
                    }
                }
            }
        }
        
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }
        
        if ($request->has('price_range') && $request->price_range) {
            $range = $request->price_range;
            if ($range == '0-20') {
                $freelancersQuery->whereBetween('hourly_rate', [0, 20]);
            } elseif ($range == '20-30') {
                $freelancersQuery->whereBetween('hourly_rate', [20, 30]);
            } elseif ($range == '30-40') {
                $freelancersQuery->whereBetween('hourly_rate', [30, 40]);
            } elseif ($range == '40+') {
                $freelancersQuery->where('hourly_rate', '>=', 40);
            }
        } else {
            if ($request->has('price_min')) {
                $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
            }
            if ($request->has('price_max')) {
                $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
            }
        }
        
        if ($request->has('super_only') && $request->super_only == '1') {
            $freelancersQuery->where('reliability_score', '>=', 90);
        }
        if ($request->has('qualified_only') && $request->qualified_only == '1') {
            $freelancersQuery->where(function($q) {
                $q->where('is_verified', 1)
                  ->orWhere(function($q2) {
                      $q2->whereNotNull('certifications')->where('certifications', '!=', '[]');
                  });
            });
        }
        if ($request->has('new_only') && $request->new_only == '1') {
            $freelancersQuery->where('freelancer_profiles.created_at', '>=', now()->subMonth());
        }
        
        $sort = $request->get('sort', 'favorites');
        if ($sort === 'price_asc') {
            $freelancersQuery->orderBy('hourly_rate', 'asc')->orderBy('reliability_score', 'desc');
        } elseif ($sort === 'price_desc') {
            $freelancersQuery->orderBy('hourly_rate', 'desc')->orderBy('reliability_score', 'desc');
        } elseif ($sort === 'rating') {
            $freelancersQuery->orderBy('reliability_score', 'desc')->orderBy('hourly_rate', 'asc');
        } else {
            $freelancersQuery->orderBy('reliability_score', 'desc')->orderBy('hourly_rate', 'asc');
        }
        $freelancers = $freelancersQuery->paginate(27);
        
        $queryResult['freelancers'] = $freelancers;
$queryResult['filters'] = $request->only(['search', 'price_min', 'price_max', 'category', 'specialization', 'country', 'city', 'availability', 'mission_type', 'super_only', 'qualified_only', 'new_only', 'sort', 'sector']);

        return view('services.at-home', $queryResult);
    }

    /**
     * Affiche la page /services/wellnesslive (Junspro Ritual Motion — système de filtres identique à lessons)
     */
    public function wellnesslive(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Catégories hiérarchiques Ritual Motion — version finale premium (4 domaines × 6 spécialisations max)
        $queryResult['categories'] = [
            'Cardio-Training' => [
                'Boxing', 'Cross Training', 'HIIT Cardio', 'HIIT Force', 'Step', 'Self-Défense'
            ],
            'Renforcement Musculaire' => [
                'Pilates', 'Pilates (petits matériels)', 'Pilates Ball', 'TRX', 'Cuisses-Abdos-Fessiers (CAF)', 'Abdos & Fessiers (AF)'
            ],
            'Bien-Etre' => [
                'Stretching', 'Ritual Flow', 'Ritual Récup\'', 'Yoga', 'Yoga Énergie', 'Yoga Anti-stress'
            ],
            'Danse' => [
                'Zumba', 'Hip-Hop', 'Afro Move', 'Dance Workout', 'Aérien (Pole Dance • Tissu • Cerceau)', 'Dance HIIT'
            ]
        ];
        // Micro-descriptions des domaines Ritual Motion (dropdown Domaine — titre + sous-texte)
        $queryResult['categoryDescriptions'] = [
            'cardio-training' => 'Endurance, énergie et intensité maîtrisée pour progresser séance après séance.',
            'renforcement-musculaire' => 'Force, tonus et posture : un travail précis, efficace et évolutif.',
            'bien-etre' => 'Mobilité, respiration et équilibre : retrouver un corps léger et aligné.',
            'danse' => 'Rythme, expression et fluidité : bouger avec grâce et confiance.',
        ];
        $queryResult['lessonGoals'] = [];
        
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        $categoryToUse = ($request->has('specialization') && $request->specialization) ? strtolower($request->specialization) : (($request->has('category') && $request->category) ? strtolower($request->category) : null);
        if ($categoryToUse) {
            $allSubcategories = collect($queryResult['categories'])->flatten()->map(function($sub) {
                return strtolower($sub);
            })->toArray();
            $subToSearch = null;
            if (in_array($categoryToUse, $allSubcategories)) {
                $subToSearch = $categoryToUse;
            } else {
                foreach (collect($queryResult['categories'])->flatten() as $sub) {
                    if (strtolower(\Illuminate\Support\Str::slug($sub)) === $categoryToUse) {
                        $subToSearch = strtolower($sub);
                        break;
                    }
                }
            }
            if ($subToSearch) {
                $freelancersQuery->where(function($q) use ($subToSearch) {
                    $q->where('bio', 'like', "%{$subToSearch}%")
                      ->orWhere('profile_title', 'like', "%{$subToSearch}%")
                      ->orWhere('specialization', 'like', "%{$subToSearch}%")
                      ->orWhereJsonContains('skills', $subToSearch);
                });
            } else {
                foreach ($queryResult['categories'] as $dom => $subs) {
                    if (strtolower(\Illuminate\Support\Str::slug($dom)) === $categoryToUse) {
                        $terms = array_map('strtolower', (array) $subs);
                        $freelancersQuery->where(function($q) use ($terms) {
                            foreach ($terms as $t) {
                                $q->orWhere(function($q2) use ($t) {
                                    $q2->where('bio', 'like', "%{$t}%")
                                       ->orWhere('profile_title', 'like', "%{$t}%")
                                       ->orWhere('specialization', 'like', "%{$t}%")
                                       ->orWhereJsonContains('skills', $t);
                                });
                            }
                        });
                        break;
                    }
                }
            }
        }
        
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }
        
        if ($request->has('price_range') && $request->price_range) {
            $range = $request->price_range;
            if ($range == '0-20') {
                $freelancersQuery->whereBetween('hourly_rate', [0, 20]);
            } elseif ($range == '20-30') {
                $freelancersQuery->whereBetween('hourly_rate', [20, 30]);
            } elseif ($range == '30-40') {
                $freelancersQuery->whereBetween('hourly_rate', [30, 40]);
            } elseif ($range == '40+') {
                $freelancersQuery->where('hourly_rate', '>=', 40);
            }
        } else {
            if ($request->has('price_min')) {
                $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
            }
            if ($request->has('price_max')) {
                $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
            }
        }
        
        if ($request->has('super_only') && $request->super_only == '1') {
            $freelancersQuery->where('reliability_score', '>=', 90);
        }
        if ($request->has('qualified_only') && $request->qualified_only == '1') {
            $freelancersQuery->where(function($q) {
                $q->where('is_verified', 1)
                  ->orWhere(function($q2) {
                      $q2->whereNotNull('certifications')->where('certifications', '!=', '[]');
                  });
            });
        }
        if ($request->has('new_only') && $request->new_only == '1') {
            $freelancersQuery->where('freelancer_profiles.created_at', '>=', now()->subMonth());
        }
        
        $sort = $request->get('sort', 'favorites');
        if ($sort === 'price_asc') {
            $freelancersQuery->orderBy('hourly_rate', 'asc')->orderBy('reliability_score', 'desc');
        } elseif ($sort === 'price_desc') {
            $freelancersQuery->orderBy('hourly_rate', 'desc')->orderBy('reliability_score', 'desc');
        } elseif ($sort === 'rating') {
            $freelancersQuery->orderBy('reliability_score', 'desc')->orderBy('hourly_rate', 'asc');
        } else {
            $freelancersQuery->orderBy('reliability_score', 'desc')->orderBy('hourly_rate', 'asc');
        }
        $freelancers = $freelancersQuery->paginate(27);
        
        $queryResult['freelancers'] = $freelancers;
$queryResult['filters'] = $request->only(['search', 'price_min', 'price_max', 'category', 'specialization', 'country', 'city', 'availability', 'mission_type', 'super_only', 'qualified_only', 'new_only', 'sort', 'sector']);

        return view('services.wellnesslive', $queryResult);
    }

    /**
     * Affiche la page /services/corporate
     */
    public function corporate(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Domaines "Présence" avec intentions courtes (pour dropdown) et descriptions longues (pour encart)
        $queryResult['categories'] = [
            [
                'slug' => 'experiences-bien-etre-serinite',
                'label' => 'Expériences Bien-Être & Sérénité',
                'description' => 'Apaiser et créer des temps de respiration.'
            ],
            [
                'slug' => 'team-building-cohesion-qvt',
                'label' => 'Team Building & Cohésion (QVT)',
                'description' => 'Renforcer la cohésion et la coopération.'
            ],
            [
                'slug' => 'evenements-vie-celebrations',
                'label' => 'Événements de Vie & Célébrations',
                'description' => 'Marquer les moments clés de la vie.'
            ],
            [
                'slug' => 'vitalite-experiences-immersives',
                'label' => 'Vitalité & Expériences Immersives',
                'description' => 'Soutenir l\'énergie et la vitalité.'
            ],
            [
                'slug' => 'intervenants-experts-experience-humaine',
                'label' => 'Intervenants & Experts en Expérience Humaine',
                'description' => 'Mobiliser des expertises humaines.'
            ],
            [
                'slug' => 'partenaires-logistique-evenementielle',
                'label' => 'Partenaires & Logistique Événementielle',
                'description' => 'S\'appuyer sur des partenaires fiables.'
            ]
        ];
        // Spécialisations par domaine — même structure que /services/projects (hero Domaine + Spécialisation + Filtres avancés)
        $queryResult['domainSpecializations'] = [
            'pause-souffle' => [
                ['clarte_priorites', 'Clarté & priorités'],
                ['transition_vie', 'Transition de vie'],
                ['equilibre_charge_mentale', 'Équilibre & charge mentale'],
                ['rythme_discipline_douce', 'Rythme & discipline douce'],
                ['leadership_decision', 'Leadership & décision'],
                ['dimension_spirituelle', 'Dimension spirituelle'],
            ],
            'experiences-bien-etre-serinite' => [
                ['massage_amma_entreprise', 'Massage amma assis (entreprise)'],
                ['massage_amma_evenement', 'Massage amma assis (événement)'],
                ['journee_bien_etre_entreprise', 'Journée bien-être en entreprise'],
                ['pauses_bien_etre_site', 'Pauses bien-être sur site'],
                ['espace_bien_etre_evenementiel', 'Espace bien-être événementiel'],
            ],
            'team-building-cohesion-qvt' => [
                ['team_building_presentiel', 'Team building en présentiel'],
                ['journee_qvt', 'Journée QVT'],
                ['cohesion_equipe', 'Cohésion d\'équipe'],
                ['seminaire_entreprise', 'Séminaire d\'entreprise'],
                ['temps_collectifs_encadres', 'Temps collectifs encadrés'],
            ],
            'evenements-vie-celebrations' => [
                ['evjf', 'EVJF'],
                ['evg', 'EVG'],
                ['preparation_mariage', 'Préparation mariage'],
                ['anniversaire', 'Anniversaire'],
                ['evenement_familial_prive', 'Événement familial privé'],
            ],
            'vitalite-experiences-immersives' => [
                ['journee_vitalite', 'Journée vitalité'],
                ['pilates_groupe', 'Pilates en groupe'],
                ['yoga_groupe', 'Yoga en groupe'],
                ['atelier_posture_prevention', 'Atelier posture & prévention'],
                ['programme_vitalite', 'Programme vitalité'],
            ],
            'intervenants-experts-experience-humaine' => [
                ['praticien_massage_amma', 'Praticien massage amma'],
                ['professeur_pilates', 'Professeur Pilates'],
                ['professeur_yoga', 'Professeur yoga'],
                ['animateur_ateliers', 'Animateur d\'ateliers'],
                ['conferencier', 'Conférencier'],
                ['accompagnement_sagesse_vie', 'Accompagnement en sagesse de vie'],
            ],
            'partenaires-logistique-evenementielle' => [
                ['location_salle', 'Location de salle'],
                ['traiteur_evenementiel', 'Traiteur événementiel'],
                ['personnel_evenementiel', 'Personnel événementiel'],
                ['son_audiovisuel', 'Son & audiovisuel'],
                ['decoration_evenementielle', 'Décoration événementielle'],
                ['direction_projet_evenementiel', 'Direction de projet événementiel'],
            ],
        ];
        // Mapping slug domaine → termes pour filtre category (recherche dans bio, profile_title, specialization)
        $domainKeywordMap = [
            'pause-souffle' => ['pause souffle', 'clarté', 'priorités', 'discernement', 'transition', 'équilibre', 'charge mentale', 'rythme', 'discipline', 'leadership', 'décision', 'spirituel'],
            'experiences-bien-etre-serinite' => ['bien-être', 'sérénité', 'respiration', 'amma', 'massage', 'entreprise'],
            'team-building-cohesion-qvt' => ['team building', 'cohésion', 'qvt', 'séminaire', 'équipe'],
            'evenements-vie-celebrations' => ['événement', 'célébration', 'evjf', 'evg', 'mariage', 'anniversaire'],
            'vitalite-experiences-immersives' => ['vitalité', 'pilates', 'yoga', 'posture', 'prévention'],
            'intervenants-experts-experience-humaine' => ['intervenant', 'expert', 'amma', 'pilates', 'yoga', 'atelier', 'conférencier', 'sagesse'],
            'partenaires-logistique-evenementielle' => ['salle', 'traiteur', 'événementiel', 'son', 'audiovisuel', 'décoration', 'projet événementiel'],
        ];
        
        // Récupérer les freelances/professeurs avec leurs données
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        // Appliquer les filtres si présents
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        // Gérer le filtre de prix
        if ($request->has('price_range') && $request->price_range) {
            $range = $request->price_range;
            if ($range == '0-20') {
                $freelancersQuery->whereBetween('hourly_rate', [0, 20]);
            } elseif ($range == '20-30') {
                $freelancersQuery->whereBetween('hourly_rate', [20, 30]);
            } elseif ($range == '30-40') {
                $freelancersQuery->whereBetween('hourly_rate', [30, 40]);
            } elseif ($range == '40+') {
                $freelancersQuery->where('hourly_rate', '>=', 40);
            }
        } else {
            if ($request->has('price_min')) {
                $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
            }
            
            if ($request->has('price_max')) {
                $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
            }
        }
        
        // Filtre par pays (country) — hero Pays + Ville (identique HomeSwap)
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        // Filtre par ville (city)
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }

        // Filtre par catégorie/domaine (même logique que /services/projects)
        if ($request->has('category') && $request->category) {
            $category = strtolower(trim($request->category));
            if (isset($domainKeywordMap[$category])) {
                $keywords = $domainKeywordMap[$category];
                $freelancersQuery->where(function($q) use ($keywords) {
                    foreach ($keywords as $kw) {
                        $q->orWhere('bio', 'like', '%' . $kw . '%')
                          ->orWhere('profile_title', 'like', '%' . $kw . '%')
                          ->orWhere('specialization', 'like', '%' . $kw . '%');
                    }
                });
            }
        }

        // Filtre Spécialisation (même logique que /services/projects)
        if ($request->has('specialization') && $request->specialization) {
            $spec = $request->specialization;
            $freelancersQuery->where(function($q) use ($spec) {
                $q->where('specialization', 'like', '%' . $spec . '%')
                  ->orWhere('profile_title', 'like', '%' . $spec . '%')
                  ->orWhere('bio', 'like', '%' . $spec . '%');
            });
        }

        // Récupérer les freelances
        $freelancers = $freelancersQuery->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->paginate(20);
        
        $queryResult['freelancers'] = $freelancers;
        $queryResult['filters'] = $request->only(['search', 'price_min', 'price_max', 'category', 'specialization', 'country', 'city', 'availability']);
        
        return view('services.corporate', $queryResult);
    }

    /**
     * Affiche la page /services/homeswap
     */
    public function homeswap(Request $request)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        
        // Catégories au format Domaine/Spécialisation (comme Projects)
        // Domaine : Type de logement
        // Spécialisations : Chambre, Studio, Appartement, Maison, Penthouse, Autre
        $queryResult['categories'] = [
            ['slug' => 'type-de-logement', 'label' => 'Type de logement', 'description' => 'Choisissez le type de logement qui correspond à votre recherche.'],
        ];
        
        // Vérifier si l'utilisateur a un abonnement HomeSwap actif
        $queryResult['hasHomeSwapSubscription'] = $this->hasHomeSwapSubscription();
        $queryResult['isAuthenticated'] = \Illuminate\Support\Facades\Auth::guard('web')->check();
        
        // Récupérer les freelances/professeurs avec leurs données
        $freelancersQuery = $this->getBaseFreelancersQuery();
        
        // Appliquer les filtres si présents
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $freelancersQuery->where(function($q) use ($search) {
                $q->where('bio', 'like', "%{$search}%")
                  ->orWhere('profile_title', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where(DB::raw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))"), 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
        
        // Gérer le filtre de prix
        if ($request->has('price_range') && $request->price_range) {
            $range = $request->price_range;
            if ($range == '0-20') {
                $freelancersQuery->whereBetween('hourly_rate', [0, 20]);
            } elseif ($range == '20-30') {
                $freelancersQuery->whereBetween('hourly_rate', [20, 30]);
            } elseif ($range == '30-40') {
                $freelancersQuery->whereBetween('hourly_rate', [30, 40]);
            } elseif ($range == '40+') {
                $freelancersQuery->where('hourly_rate', '>=', 40);
            }
        } else {
            if ($request->has('price_min')) {
                $freelancersQuery->where('hourly_rate', '>=', $request->price_min);
            }
            
            if ($request->has('price_max')) {
                $freelancersQuery->where('hourly_rate', '<=', $request->price_max);
            }
        }
        
        // Filtre par pays (country) — même logique que page Projet
        if ($request->has('country') && $request->country) {
            $country = $request->country;
            $freelancersQuery->whereHas('user', function($userQ) use ($country) {
                $userQ->where('country_code', $country)
                      ->orWhere('country', 'like', "%{$country}%");
            });
        }
        // Filtre par ville (city)
        if ($request->has('city') && $request->city) {
            $city = $request->city;
            $freelancersQuery->whereHas('user', function($userQ) use ($city) {
                $userQ->where('city', 'like', "%{$city}%");
            });
        }

        // Appliquer les filtres HomeSwap spécifiques
        // Note: Ces filtres nécessiteront une table dédiée aux logements pour un filtrage complet
        // Pour l'instant, on capture les paramètres pour les passer à la vue
        
        // Filtres de dates
        if ($request->has('start_date') && $request->start_date) {
            // TODO: Filtrer par date de disponibilité du logement
        }
        
        if ($request->has('end_date') && $request->end_date) {
            // TODO: Filtrer par date de disponibilité du logement
        }
        
        // Filtre type de logement
        if ($request->has('accommodation_type') && $request->accommodation_type) {
            // TODO: Filtrer par type de logement (chambre, studio, appartement, etc.)
        }
        
        // Filtres caractéristiques
        if ($request->has('bedrooms') && $request->bedrooms) {
            // TODO: Filtrer par nombre de chambres
        }
        
        if ($request->has('bathrooms') && $request->bathrooms) {
            // TODO: Filtrer par nombre de salles de bain
        }
        
        if ($request->has('adults') && $request->adults) {
            // TODO: Filtrer par nombre d'adultes
        }
        
        if ($request->has('children') && $request->children) {
            // TODO: Filtrer par nombre d'enfants
        }
        
        if ($request->has('capacity') && $request->capacity) {
            // TODO: Filtrer par capacité d'accueil
        }
        
        // Filtres équipements (array)
        if ($request->has('equipment') && is_array($request->equipment)) {
            // TODO: Filtrer par équipements disponibles
        }
        
        // Filtres espaces extérieurs (array)
        if ($request->has('outdoor') && is_array($request->outdoor)) {
            // TODO: Filtrer par espaces extérieurs
        }
        
        // Filtres règles & préférences (array)
        if ($request->has('rules') && is_array($request->rules)) {
            // TODO: Filtrer par règles et préférences
        }
        
        // Filtres objectif du séjour (array)
        if ($request->has('trip_purpose') && is_array($request->trip_purpose)) {
            // TODO: Filtrer par objectif du séjour
        }
        
        // Filtres type d'échange (array)
        if ($request->has('exchange_type') && is_array($request->exchange_type)) {
            // TODO: Filtrer par type d'échange
        }
        
        // Récupérer les freelances
        $freelancers = $freelancersQuery->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->paginate(20);
        
        $queryResult['freelancers'] = $freelancers;
        
        // Capturer tous les filtres HomeSwap pour les passer à la vue
        $queryResult['filters'] = $request->only([
            'search',
            'start_date', 
            'end_date', 
            'date_text',
            'date_flexible',
            'date_fixed',
            'trip_purpose',
            'trip_purpose_other',
            'exchange_type',
            'accommodation_type',
            'bedrooms',
            'bathrooms',
            'adults',
            'children',
            'capacity',
            'equipment',
            'outdoor',
            'rules',
            'price_min', 
            'price_max', 
            'category', 
            'country',
            'city', 
            'availability'
        ]);
        
        return view('services.homeswap', $queryResult);
    }

    /**
     * Vérifie si l'utilisateur connecté a un abonnement HomeSwap actif
     */
    private function hasHomeSwapSubscription(): bool
    {
        $user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        
        if (!$user || !$user->clientProfile) {
            return false;
        }
        
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            // Récupérer tous les abonnements Stripe actifs de l'utilisateur
            $customerId = $user->stripe_id ?? null;
            if (!$customerId) {
                // Chercher par email
                $customers = \Stripe\Customer::all([
                    'email' => $user->email_address,
                    'limit' => 1
                ]);
                if ($customers->data) {
                    $customerId = $customers->data[0]->id;
                } else {
                    return false;
                }
            }
            
            // Récupérer les abonnements actifs
            $subscriptions = \Stripe\Subscription::all([
                'customer' => $customerId,
                'status' => 'active',
                'limit' => 100
            ]);
            
            // Vérifier si un abonnement a la metadata type=homeswap_subscription
            foreach ($subscriptions->data as $subscription) {
                $checkoutSession = null;
                try {
                    // Récupérer la session checkout pour vérifier les metadata
                    $sessions = \Stripe\Checkout\Session::all([
                        'subscription' => $subscription->id,
                        'limit' => 1
                    ]);
                    if ($sessions->data) {
                        $checkoutSession = $sessions->data[0];
                    }
                } catch (\Exception $e) {
                    // Ignorer les erreurs
                }
                
                // Vérifier les metadata de la session ou de l'abonnement
                $metadata = $checkoutSession->metadata ?? $subscription->metadata ?? [];
                if (isset($metadata['type']) && $metadata['type'] === 'homeswap_subscription') {
                    return true;
                }
                
                // Vérifier aussi le nom du produit
                if ($subscription->items->data) {
                    foreach ($subscription->items->data as $item) {
                        $product = $item->price->product ?? null;
                        if ($product && is_string($product)) {
                            $productObj = \Stripe\Product::retrieve($product);
                            if (stripos($productObj->name ?? '', 'homeswap') !== false) {
                                return true;
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur vérification abonnement HomeSwap: ' . $e->getMessage());
            // En cas d'erreur, retourner false pour ne pas bloquer l'accès
            return false;
        }
        
        return false;
    }

    /**
     * Affiche une page de catégorie spécifique
     * Ex: /services/at-home/beaute
     */
    public function category(Request $request, $universe, $category)
    {
        $misc = new MiscellaneousController();
        $language = $misc->getLanguage();
        
        $queryResult['languageId'] = $language;
        $queryResult['breadcrumb'] = $misc->getBreadcrumb();
        $queryResult['universe'] = $universe;
        $queryResult['category'] = $category;
        
        // Définir les informations de l'univers parent
        $universes = [
            'projects' => [
                'title' => 'Projets',
                'url' => route('services.projects'),
                'categories' => [
                    'Graphisme & Design', 'Marketing', 'Développement & Tech',
                    'Rédaction & Traduction', 'Vidéo & Animation', 'Business',
                    'Musique & Audio', 'Data/IA'
                ]
            ],
            'lessons' => [
                'title' => 'Cours',
                'url' => route('services.lessons'),
                'categories' => ['Langues', 'Scolaire', 'Pro', 'Musique', 'Coaching']
            ],
            'at-home' => [
                'title' => 'Services at Home',
                'url' => route('services.at-home'),
                'categories' => [
                    'Beauté', 'Massage & relaxation', 'Ménage & repassage',
                    'Coaching sportif', 'Bien-être', 'Amma assis', 'Do-In',
                    'Accompagnement familial'
                ]
            ],
            'wellnesslive' => [
                'title' => 'WellnessLive',
                'url' => route('services.wellnesslive'),
                'categories' => []
            ],
            'corporate' => [
                'title' => 'Bien-être en entreprise',
                'url' => route('services.corporate'),
                'categories' => ['Séances', 'Conférences', 'Ateliers']
            ],
            'homeswap' => [
                'title' => 'Échanges de logement',
                'url' => route('services.homeswap'),
                'categories' => [
                    'Chambre', 'Appartement', 'Maison', 'Penthouse',
                    'Courte durée', 'Moyenne durée', 'Longue durée',
                    'Famille', 'Étudiant'
                ]
            ]
        ];
        
        if (!isset($universes[$universe])) {
            abort(404, 'Univers non trouvé');
        }
        
        $universeInfo = $universes[$universe];
        $queryResult['universeInfo'] = $universeInfo;
        
        // Normaliser le nom de la catégorie (slug -> nom)
        $categorySlug = str_replace('-', ' ', $category);
        $categoryName = ucwords($categorySlug);
        
        // Vérifier si la catégorie existe dans l'univers
        if (!empty($universeInfo['categories']) && !in_array($categoryName, $universeInfo['categories'])) {
            // Essayer de trouver une correspondance partielle
            $found = false;
            foreach ($universeInfo['categories'] as $cat) {
                if (strtolower(str_replace([' ', '&'], ['-', ''], $cat)) === $category) {
                    $categoryName = $cat;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                abort(404, 'Catégorie non trouvée');
            }
        }
        
        $queryResult['categoryName'] = $categoryName;
        
        // Définir les textes du hero selon la catégorie
        $categoryHeroTexts = $this->getCategoryHeroTexts($universe, $categoryName);
        $queryResult['title'] = $categoryHeroTexts['title'];
        $queryResult['subtitle'] = $categoryHeroTexts['subtitle'];
        $queryResult['micro'] = $categoryHeroTexts['micro'];
        $queryResult['cta'] = $categoryHeroTexts['cta'];
        
        // Catégories pour la barre horizontale (toutes les catégories de l'univers)
        $queryResult['categories'] = $universeInfo['categories'];
        
        // Résultats démo pour cette catégorie
        $queryResult['results'] = $this->getCategoryResults($universe, $categoryName);
        
        return view('services.category', $queryResult);
    }
    
    /**
     * Retourne les textes du hero pour une catégorie
     */
    private function getCategoryHeroTexts($universe, $categoryName)
    {
        $texts = [
            'projects' => [
                'Graphisme & Design' => [
                    'title' => 'Graphisme & Design',
                    'subtitle' => 'Des créations visuelles qui marquent.',
                    'micro' => 'Logos, identités de marque, designs web et print. Des visuels qui parlent et qui convertissent.',
                    'cta' => ['text' => 'Voir les freelances', 'url' => '#results', 'variant' => 'primary']
                ],
                'Marketing' => [
                    'title' => 'Marketing',
                    'subtitle' => 'Boostez votre visibilité et vos ventes.',
                    'micro' => 'Stratégie digitale, SEO, réseaux sociaux, publicité. Des résultats mesurables.',
                    'cta' => ['text' => 'Voir les freelances', 'url' => '#results', 'variant' => 'primary']
                ],
                'Développement & Tech' => [
                    'title' => 'Développement & Tech',
                    'subtitle' => 'Des solutions techniques solides.',
                    'micro' => 'Sites web, applications mobiles, APIs, intégrations. Du code propre et performant.',
                    'cta' => ['text' => 'Voir les freelances', 'url' => '#results', 'variant' => 'primary']
                ]
            ],
            'at-home' => [
                'Beauté' => [
                    'title' => 'Beauté',
                    'subtitle' => 'Prenez soin de vous, chez vous.',
                    'micro' => 'Soins du visage, maquillage, épilation, manucure. Des prestations premium à domicile.',
                    'cta' => ['text' => 'Réserver un soin', 'url' => '#results', 'variant' => 'primary']
                ],
                'Massage & relaxation' => [
                    'title' => 'Massage & relaxation',
                    'subtitle' => 'Détente totale, à votre domicile.',
                    'micro' => 'Massages thérapeutiques, relaxants, sportifs. Un moment de bien-être rien que pour vous.',
                    'cta' => ['text' => 'Réserver un massage', 'url' => '#results', 'variant' => 'primary']
                ],
                'Ménage & repassage' => [
                    'title' => 'Ménage & repassage',
                    'subtitle' => 'Votre domicile impeccable, sans effort.',
                    'micro' => 'Ménage complet, repassage, rangement. Des prestations régulières ou ponctuelles.',
                    'cta' => ['text' => 'Réserver un service', 'url' => '#results', 'variant' => 'primary']
                ],
                'Coaching sportif' => [
                    'title' => 'Coaching sportif',
                    'subtitle' => 'Votre coach personnel, à domicile.',
                    'micro' => 'Séances personnalisées, programmes sur mesure, suivi régulier. Atteignez vos objectifs.',
                    'cta' => ['text' => 'Réserver un coach', 'url' => '#results', 'variant' => 'primary']
                ],
                'Bien-être' => [
                    'title' => 'Bien-être',
                    'subtitle' => 'Prenez soin de votre équilibre.',
                    'micro' => 'Yoga, méditation, sophrologie, réflexologie. Des pratiques pour votre bien-être quotidien.',
                    'cta' => ['text' => 'Réserver une séance', 'url' => '#results', 'variant' => 'primary']
                ],
                'Amma assis' => [
                    'title' => 'Amma assis',
                    'subtitle' => 'Détente express, en entreprise ou à domicile.',
                    'micro' => 'Massage assis de 15 à 30 minutes. Parfait pour une pause bien-être rapide.',
                    'cta' => ['text' => 'Réserver un Amma', 'url' => '#results', 'variant' => 'primary']
                ],
                'Do-In' => [
                    'title' => 'Do-In',
                    'subtitle' => 'Auto-massage et énergie vitale.',
                    'micro' => 'Techniques d\'auto-massage japonaises pour stimuler votre énergie et votre vitalité.',
                    'cta' => ['text' => 'Réserver une séance', 'url' => '#results', 'variant' => 'primary']
                ],
                'Accompagnement familial' => [
                    'title' => 'Accompagnement familial',
                    'subtitle' => 'Soutien et accompagnement pour toute la famille.',
                    'micro' => 'Aide à domicile, garde d\'enfants, soutien scolaire, accompagnement personnes âgées.',
                    'cta' => ['text' => 'Voir les services', 'url' => '#results', 'variant' => 'primary']
                ]
            ],
            'lessons' => [
                'Langues' => [
                    'title' => 'Cours de langues',
                    'subtitle' => 'Parlez couramment, naturellement.',
                    'micro' => 'Anglais, espagnol, allemand, italien... Apprenez avec des professeurs natifs.',
                    'cta' => ['text' => 'Trouver un professeur', 'url' => '#results', 'variant' => 'primary']
                ],
                'Scolaire' => [
                    'title' => 'Soutien scolaire',
                    'subtitle' => 'Des progrès visibles, rapidement.',
                    'micro' => 'Mathématiques, français, sciences... Du primaire au lycée, progressez à votre rythme.',
                    'cta' => ['text' => 'Trouver un professeur', 'url' => '#results', 'variant' => 'primary']
                ],
                'Pro' => [
                    'title' => 'Formation professionnelle',
                    'subtitle' => 'Développez vos compétences professionnelles.',
                    'micro' => 'Bureautique, management, communication, langues professionnelles.',
                    'cta' => ['text' => 'Voir les formations', 'url' => '#results', 'variant' => 'primary']
                ],
                'Musique' => [
                    'title' => 'Cours de musique',
                    'subtitle' => 'Apprenez la musique avec passion.',
                    'micro' => 'Piano, guitare, violon, chant... Des cours adaptés à votre niveau.',
                    'cta' => ['text' => 'Trouver un professeur', 'url' => '#results', 'variant' => 'primary']
                ],
                'Coaching' => [
                    'title' => 'Coaching',
                    'subtitle' => 'Atteignez vos objectifs personnels et professionnels.',
                    'micro' => 'Coaching de vie, professionnel, sportif. Un accompagnement personnalisé.',
                    'cta' => ['text' => 'Trouver un coach', 'url' => '#results', 'variant' => 'primary']
                ]
            ]
        ];
        
        // Retourner les textes par défaut si la catégorie n'est pas définie
        if (isset($texts[$universe][$categoryName])) {
            return $texts[$universe][$categoryName];
        }
        
        return [
            'title' => $categoryName,
            'subtitle' => 'Découvrez nos services ' . strtolower($categoryName),
            'micro' => 'Des prestations de qualité pour répondre à vos besoins.',
            'cta' => ['text' => 'Voir les services', 'url' => '#results', 'variant' => 'primary']
        ];
    }
    
    /**
     * Retourne les résultats démo pour une catégorie
     */
    private function getCategoryResults($universe, $categoryName)
    {
        // Résultats génériques par défaut
        $defaultResults = [
            [
                'title' => 'Service ' . $categoryName . ' premium',
                'description' => 'Une prestation de qualité pour répondre à vos besoins spécifiques.',
                'badges' => ['Premium'],
                'price' => 'Sur devis'
            ],
            [
                'title' => 'Service ' . $categoryName . ' standard',
                'description' => 'Une solution adaptée à vos besoins.',
                'badges' => ['Standard'],
                'price' => 'Sur devis'
            ],
            [
                'title' => 'Service ' . $categoryName . ' express',
                'description' => 'Une prestation rapide et efficace.',
                'badges' => ['Express'],
                'price' => 'Sur devis'
            ]
        ];
        
        // Résultats spécifiques par catégorie
        $specificResults = [
            'at-home' => [
                'Beauté' => [
                    [
                        'title' => 'Soin du visage premium',
                        'description' => 'Soin complet avec produits haut de gamme',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '80€'
                    ],
                    [
                        'title' => 'Maquillage professionnel',
                        'description' => 'Maquillage pour événement ou quotidien',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '60€'
                    ],
                    [
                        'title' => 'Épilation définitive',
                        'description' => 'Technique douce et efficace',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '90€'
                    ]
                ],
                'Massage & relaxation' => [
                    [
                        'title' => 'Massage relaxant complet',
                        'description' => 'Massage thérapeutique pour détente totale',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '70€'
                    ],
                    [
                        'title' => 'Massage sportif',
                        'description' => 'Récupération musculaire après effort',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '75€'
                    ],
                    [
                        'title' => 'Massage aux pierres chaudes',
                        'description' => 'Détente profonde avec pierres volcaniques',
                        'badges' => ['À domicile', 'Créneau'],
                        'price' => '85€'
                    ]
                ]
            ]
        ];
        
        if (isset($specificResults[$universe][$categoryName])) {
            return $specificResults[$universe][$categoryName];
        }
        
        return $defaultResults;
    }
}

