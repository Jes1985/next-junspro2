<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\BasicSettings\Basic;
use App\Models\BasicSettings\BasicExtends;
use App\Models\Blog\Post;
use App\Models\ClientService\ServiceContent;
use App\Models\HomePage\CtaSectionInfo;
use App\Models\HomePage\Partner;
use App\Models\HomePage\Section;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    $themeVersion = Basic::query()->pluck('theme_version')->first();
    $secInfo = Section::query()->first();
    $queryResult['secInfo'] = $secInfo;

    $misc = new MiscellaneousController();

    $language = $misc->getLanguage();
    $queryResult['languageId'] = $language;
    $queryResult['seoInfo'] = $language->seoInfo()->select('meta_keyword_home', 'meta_description_home')->first();

    // Source unique : config Univers → Domaines (hero hub) - identique à ServicesController
    $hubConfig = config('services_universes', []);
    $hubUniversesList = $hubConfig['universes'] ?? [];
    $hubDomainsByUniverse = $hubConfig['domains_by_universe'] ?? [];
    $queryResult['hubUniverses'] = collect($hubUniversesList)->map(fn ($label, $slug) => ['slug' => $slug, 'label' => $label])->values()->all();
    $queryResult['hubUniverseDomains'] = $hubDomainsByUniverse;

    if ($themeVersion == 1 || $themeVersion == 2 || $themeVersion == 3) {
      $queryResult['heroImg'] = Basic::query()->pluck('hero_static_img', 'hero_video_url')->first();
      $queryResult['heroVideoUrl'] = Basic::query()->pluck('hero_video_url')->first();
      $queryResult['heroInfo'] = $language->heroStatic()->first();
      $queryResult['heroBgImg'] = Basic::query()->pluck('hero_bg_img')->first();
    } else {
      $queryResult['heroInfo'] = $language->heroStatic()->first();
    }

    // Catégories avec mise en avant de "Luxe & Premium" (is_premium = true)
    $queryResult['categories'] = $language->serviceCategory()
      ->where('status', 1)
      ->orderByRaw('is_premium DESC, serial_number ASC')
      ->limit(8)
      ->get();

    if ($secInfo->about_section_status == 1) {
      $queryResult['aboutInfo'] = DB::table('basic_settings')->select('about_section_image', 'about_section_video_link')->first();

      $queryResult['aboutData'] = $language->aboutSection()->first();
    }

    $queryResult['secTitle'] = $language->sectionTitle()->first();

    if ($secInfo->features_section_status == 1) {
      $queryResult['featureBgImg'] = Basic::query()->pluck('feature_bg_img')->first();
      $queryResult['allFeature'] = $language->feature()->orderByDesc('id')->get();
    }
    $service_setings = Basic::select('is_service')->first();
    $queryResult['service_setings'] = $service_setings;
    if ($secInfo->featured_services_section_status == 1 && $service_setings->is_service == 1) {
      $categories = $language->serviceCategory()->where('status', 1)->where('is_featured', 'yes')->orderBy('serial_number', 'asc')->get();

      $categories->map(function ($category) {
        $category['serviceContent'] = ServiceContent::query()->whereHas('service', function (Builder $query) {

          $query->where('service_status', '=', 1)
            ->where('is_featured', '=', 'yes')
            ->join('memberships', 'services.seller_id', '=', 'memberships.seller_id')
            ->join('sellers', 'services.seller_id', '=', 'sellers.id')
            ->where([
              ['memberships.status', '=', 1],
              ['memberships.start_date', '<=', Carbon::now()->format('Y-m-d')],
              ['memberships.expire_date', '>=', Carbon::now()->format('Y-m-d')],
              ['sellers.status', '=', 1],
            ]);
        })
          ->where('service_category_id', '=', $category->id)
          ->get();
      });

      $queryResult['featuredCategories'] = $categories;
    }

    $queryResult['currencyInfo'] = $this->getCurrencyInfo();

    // Section Freelancers highlight (Junspro V2) - Pour le slider hero
    try {
      // Récupérer tous les freelances valides (sans dépendre des colonnes qui n'existent peut-être pas)
      $queryResult['heroFreelancers'] = \App\Models\FreelancerProfile::query()
        ->with(['user'])
        ->whereNotNull('hourly_rate')
        ->whereBetween('hourly_rate', [10, 299])
        ->orderByDesc('reliability_score')
        ->limit(12)
        ->get();
      
      // Essayer d'ajouter les super/verified freelances en premier si les colonnes existent
      try {
        $superFreelances = \App\Models\FreelancerProfile::query()
          ->with(['user'])
          ->whereHas('user', function ($q) {
            $q->where(function($subQ) {
              $subQ->where('is_super_freelancer', true)
                   ->orWhere('is_verified_freelancer', true);
            });
          })
          ->whereNotNull('hourly_rate')
          ->whereBetween('hourly_rate', [10, 299])
          ->orderByDesc('reliability_score')
          ->limit(12)
          ->get();
        
        if ($superFreelances->count() > 0) {
          // Fusionner en mettant les super freelances en premier
          $otherFreelances = $queryResult['heroFreelancers']->whereNotIn('id', $superFreelances->pluck('id'));
          $queryResult['heroFreelancers'] = $superFreelances->merge($otherFreelances)->take(12);
        }
      } catch (\Exception $e) {
        // Les colonnes n'existent pas encore, on continue avec la requête de base
      }
      
      // Freelancers pour la section highlight (plus bas) - 9 freelances pour le slider
      // Prioriser ceux qui ont une photo (user->image) pour afficher des photos dans le slider
      $queryResult['highlightedFreelancers'] = $queryResult['heroFreelancers']
        ->sortByDesc(function ($f) {
          return !empty(trim((string) (optional($f->user)->image ?? '')));
        })
        ->values()
        ->take(9);
    } catch (\Exception $e) {
      // Si aucune donnée ou erreur, retourner une collection vide
      $queryResult['heroFreelancers'] = collect([]);
      $queryResult['highlightedFreelancers'] = collect([]);
    }

    if ($secInfo->testimonials_section_status == 1) {
      $queryResult['testimonialBgImg'] = Basic::query()->pluck('testimonial_bg_img')->first();
    }
    $queryResult['testimonials'] = $language->testimonial()->orderByDesc('id')->get();

    if ($secInfo->blog_section_status == 1) {
      $queryResult['posts'] = Post::query()->join('post_informations', 'posts.id', '=', 'post_informations.post_id')
        ->join('blog_categories', 'blog_categories.id', '=', 'post_informations.blog_category_id')
        ->where('post_informations.language_id', '=', $language->id)
        ->select('posts.id', 'posts.image', 'blog_categories.name as categoryName', 'blog_categories.slug as categorySlug', 'post_informations.title', 'post_informations.slug', 'post_informations.author', 'post_informations.content', 'posts.created_at')
        ->orderBy('posts.created_at', 'desc')
        ->limit(3)
        ->get();
    }

    if ($secInfo->partners_section_status == 1) {
      $queryResult['partners'] = Partner::query()->orderByDesc('id')->get();
    }

    if ($secInfo->cta_section_status == 1) {
      $queryResult['ctaSectionInfo'] = CtaSectionInfo::where('language_id', $language->id)->first();
      $queryResult['ctaBgImg'] = Basic::query()->pluck('cta_bg_img')->first();
    }
    $queryResult['BasicExtends'] = BasicExtends::where('language_id', $language->id)->first();

    // Définir les univers pour la section "Nos Rituels"
    $queryResult['universes'] = [
      [
        'title' => 'Projets et Consulting',
        'url' => route('services.projects')
      ],
      [
        'title' => 'Cours',
        'url' => route('services.lessons')
      ],
      [
        'title' => 'Services at Home',
        'url' => route('services.at-home')
      ],
      [
        'title' => 'WellnessLive',
        'url' => route('services.wellnesslive')
      ],
      [
        'title' => 'Échanges de logement',
        'url' => route('services.homeswap')
      ],
      [
        'title' => 'Bien-être en entreprise',
        'url' => route('services.corporate')
      ]
    ];

    // Définir les Rituels populaires par univers pour la section "Les univers les plus populaires"
    $queryResult['popularRituals'] = [
      // Projets et Consulting (Violet/Bleu)
      [
        'name' => 'Marketing Digital',
        'universe' => 'Projets et Consulting',
        'universeIndex' => 0,
        'url' => route('services.projects', ['search' => 'Marketing Digital']),
        'icon' => 'megaphone',
        'colorGradient' => 'linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%)',
        'borderColor' => 'rgba(139, 92, 246, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ],
      [
        'name' => 'Programmation et tech',
        'universe' => 'Projets et Consulting',
        'universeIndex' => 0,
        'url' => route('services.projects', ['search' => 'Programmation']),
        'icon' => 'code',
        'colorGradient' => 'linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%)',
        'borderColor' => 'rgba(139, 92, 246, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ],
      [
        'name' => 'Vidéo et animation',
        'universe' => 'Projets et Consulting',
        'universeIndex' => 0,
        'url' => route('services.projects', ['search' => 'Vidéo']),
        'icon' => 'video',
        'colorGradient' => 'linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%)',
        'borderColor' => 'rgba(139, 92, 246, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ],
      [
        'name' => 'Coaching et Formations',
        'universe' => 'Projets et Consulting',
        'universeIndex' => 0,
        'url' => route('services.projects', ['search' => 'Community manager']),
        'icon' => 'users',
        'colorGradient' => 'linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%)',
        'borderColor' => 'rgba(139, 92, 246, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ],
      // Cours (Bleu/Cyan)
      [
        'name' => 'Anglais',
        'universe' => 'Cours',
        'universeIndex' => 1,
        'url' => route('services.lessons', ['search' => 'anglais']),
        'icon' => 'book',
        'colorGradient' => 'linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%)',
        'borderColor' => 'rgba(6, 182, 212, 0.3)',
        'hoverBorderColor' => 'rgba(6, 182, 212, 0.4)'
      ],
      [
        'name' => 'Maths',
        'universe' => 'Cours',
        'universeIndex' => 1,
        'url' => route('services.lessons', ['search' => 'maths']),
        'icon' => 'calculator',
        'colorGradient' => 'linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%)',
        'borderColor' => 'rgba(6, 182, 212, 0.3)',
        'hoverBorderColor' => 'rgba(6, 182, 212, 0.4)'
      ],
      // WellnessLive (Orange/Rouge)
      [
        'name' => 'Pilates',
        'universe' => 'WellnessLive',
        'universeIndex' => 3,
        'url' => route('services.wellnesslive', ['search' => 'Pilates']),
        'icon' => 'dumbbell',
        'colorGradient' => 'linear-gradient(135deg, #F97316 0%, #EA580C 50%, #DC2626 100%)',
        'borderColor' => 'rgba(251, 146, 60, 0.3)',
        'hoverBorderColor' => 'rgba(234, 88, 12, 0.4)'
      ],
      [
        'name' => 'Bodysculpt',
        'universe' => 'WellnessLive',
        'universeIndex' => 3,
        'url' => route('services.wellnesslive', ['search' => 'Bodysculpt']),
        'icon' => 'fire',
        'colorGradient' => 'linear-gradient(135deg, #F97316 0%, #EA580C 50%, #DC2626 100%)',
        'borderColor' => 'rgba(251, 146, 60, 0.3)',
        'hoverBorderColor' => 'rgba(234, 88, 12, 0.4)'
      ],
      // Services at Home (Jaune/Orange)
      [
        'name' => 'Ménage et Repassage',
        'universe' => 'Services at Home',
        'universeIndex' => 2,
        'url' => route('services.at-home', ['search' => 'ménage']),
        'icon' => 'broom',
        'colorGradient' => 'linear-gradient(135deg, #FBBF24 0%, #FB923C 50%, #2563EB 100%)',
        'borderColor' => 'rgba(251, 191, 36, 0.3)',
        'hoverBorderColor' => 'rgba(251, 191, 36, 0.4)'
      ],
      [
        'name' => 'Garde d\'Enfants',
        'universe' => 'Services at Home',
        'universeIndex' => 2,
        'url' => route('services.at-home', ['search' => 'garde enfants']),
        'icon' => 'baby',
        'colorGradient' => 'linear-gradient(135deg, #FBBF24 0%, #FB923C 50%, #2563EB 100%)',
        'borderColor' => 'rgba(251, 191, 36, 0.3)',
        'hoverBorderColor' => 'rgba(251, 191, 36, 0.4)'
      ],
      // Bien-être en entreprise (Jaune/Vert)
      [
        'name' => 'Matinée/ Après-Midi Souffle et Elan',
        'universe' => 'Bien-être en entreprise',
        'universeIndex' => 5,
        'url' => route('services.corporate', ['search' => 'souffle elan']),
        'icon' => 'wind',
        'colorGradient' => 'linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%)',
        'borderColor' => 'rgba(251, 191, 36, 0.3)',
        'hoverBorderColor' => 'rgba(132, 204, 22, 0.4)'
      ],
      [
        'name' => 'Journée Souffle et Focus',
        'universe' => 'Bien-être en entreprise',
        'universeIndex' => 5,
        'url' => route('services.corporate', ['search' => 'souffle focus']),
        'icon' => 'brain',
        'colorGradient' => 'linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%)',
        'borderColor' => 'rgba(251, 191, 36, 0.3)',
        'hoverBorderColor' => 'rgba(132, 204, 22, 0.4)'
      ],
      [
        'name' => 'Week-end / Séminaire Evasion et Cohésion',
        'universe' => 'Bien-être en entreprise',
        'universeIndex' => 5,
        'url' => route('services.corporate', ['search' => 'evasion cohesion']),
        'icon' => 'users',
        'colorGradient' => 'linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%)',
        'borderColor' => 'rgba(251, 191, 36, 0.3)',
        'hoverBorderColor' => 'rgba(132, 204, 22, 0.4)'
      ],
      // Échanges de logement (Rose/Bleu)
      [
        'name' => 'Malte - Sliema',
        'universe' => 'Échanges de logement',
        'universeIndex' => 4,
        'url' => route('services.homeswap', ['search' => 'Malte Sliema']),
        'icon' => 'home',
        'colorGradient' => 'linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%)',
        'borderColor' => 'rgba(236, 72, 153, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ],
      [
        'name' => 'France - Lyon',
        'universe' => 'Échanges de logement',
        'universeIndex' => 4,
        'url' => route('services.homeswap', ['search' => 'Lyon']),
        'icon' => 'home',
        'colorGradient' => 'linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%)',
        'borderColor' => 'rgba(236, 72, 153, 0.3)',
        'hoverBorderColor' => 'rgba(37, 99, 235, 0.4)'
      ]
    ];

    if ($themeVersion == 1) {
      return view('frontend.home.index-v1', $queryResult);
    } else if ($themeVersion == 2) {
      return view('frontend.home.index-v2', $queryResult);
    } else if ($themeVersion == 3) {
      return view('frontend.home.index-v3', $queryResult);
    }
    
    // Par défaut, utiliser la version 3 (la plus récente)
    return view('frontend.home.index-v3', $queryResult);
  }

  public function cover()
  {
    return view('frontend.home.cover');
  }

}
