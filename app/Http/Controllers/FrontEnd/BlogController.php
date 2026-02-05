<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Basic;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class BlogController extends Controller
{
  public function index(Request $request)
  {
    try {
      [$languageId, $language] = $this->resolveLanguage();
    } catch (\Throwable $e) {
      [$languageId, $language] = [null, null];
    }

    $baseQuery = Post::query()
      ->join('post_informations', 'posts.id', '=', 'post_informations.post_id')
      ->join('blog_categories', 'blog_categories.id', '=', 'post_informations.blog_category_id')
      ->when($languageId, fn($q) => $q->where('post_informations.language_id', '=', $languageId))
      ->select(
        'posts.id',
        'posts.image',
        'posts.created_at',
        'post_informations.title',
        'post_informations.slug',
        'post_informations.author',
        'post_informations.content',
        'post_informations.meta_keywords',
        'blog_categories.name as categoryName',
        'blog_categories.slug as categorySlug'
      )
      ->orderByDesc('posts.created_at');

    $title = trim((string) $request->query('title', ''));
    if ($title !== '') {
      $baseQuery->where('post_informations.title', 'like', '%' . $title . '%');
    }

    $postsRaw = $baseQuery->get();

    $universFilter = (string) $request->query('univers', '');
    $durationFilter = (string) $request->query('duree', '');
    $themeFilter = (string) $request->query('categorie', '');
    $rubriqueFilter = (string) $request->query('rubrique', '');

    $posts = $postsRaw->map(function ($row) {
      $plain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $row->content)));
      $words = $plain === '' ? 0 : str_word_count($plain);
      $minutes = max(2, (int) ceil($words / 200));

      $row->reading_minutes = $minutes;
      $row->duration_bucket = $this->bucketizeReadingTime($minutes);
      $row->univers_key = $this->detectUniverseKeyFromText($row->title . ' ' . $row->categoryName . ' ' . $plain);
      $row->theme_key = $this->detectThemeKeyFromText($row->title . ' ' . $row->categoryName . ' ' . $plain);
      $row->rubrique_key = $this->detectRubriqueKeyFromText($row->title . ' ' . $row->categoryName . ' ' . $plain);

      return $row;
    });

    $posts = $posts->filter(function ($row) use ($universFilter, $durationFilter, $themeFilter, $rubriqueFilter) {
      if ($universFilter !== '' && $row->univers_key !== $universFilter) return false;
      if ($durationFilter !== '' && $row->duration_bucket !== $durationFilter) return false;
      if ($themeFilter !== '' && $row->theme_key !== $themeFilter) return false;
      if ($rubriqueFilter !== '' && $row->rubrique_key !== $rubriqueFilter) return false;
      return true;
    })->values();

    $paginator = $this->paginateCollection(
      $posts,
      (int) $request->query('page', 1),
      13,
      $request->url(),
      $request->query()
    );

    $categories = collect([]);
    $totalPost = 0;
    if ($languageId && Schema::hasTable('blog_categories') && Schema::hasTable('post_informations') && Schema::hasTable('posts')) {
      $totalPost = (int) Post::query()
        ->join('post_informations', 'posts.id', '=', 'post_informations.post_id')
        ->where('post_informations.language_id', '=', $languageId)
        ->count();

      $categories = BlogCategory::query()
        ->where('language_id', '=', $languageId)
        ->where('status', '=', 1)
        ->orderBy('serial_number')
        ->get()
        ->map(function ($cat) use ($languageId) {
          $cat->postCount = (int) $cat->postInfo()->where('language_id', '=', $languageId)->count();
          return $cat;
        });
    }

    try {
      return view('frontend.blog.posts', [
        'posts' => $paginator,
        'categories' => $categories,
        'totalPost' => $totalPost,
        'pageHeading' => optional($language)->pageName()->select('blog_page_title')->first(),
        'filters' => [
          'univers' => $universFilter,
          'duree' => $durationFilter,
          'categorie' => $themeFilter,
          'rubrique' => $rubriqueFilter,
          'title' => $title,
        ],
      ]);
    } catch (\Throwable $e) {
      \Log::error('BlogController@index error: ' . $e->getMessage(), [
        'trace' => $e->getTraceAsString()
      ]);
      throw $e;
    }
  }

  public function show(Request $request, string $slug, int $id)
  {
    try {
      [$languageId, $language] = $this->resolveLanguage();
    } catch (\Throwable $e) {
      [$languageId, $language] = [null, null];
    }

    try {
      $selectFields = [
        'posts.id',
        'posts.image',
        'posts.created_at',
        'post_informations.title',
        'post_informations.slug',
        'post_informations.author',
        'post_informations.content',
        'post_informations.meta_keywords',
        'post_informations.meta_description',
        'blog_categories.name as categoryName',
        'blog_categories.slug as categorySlug'
      ];
      
      // Ajouter cover_image si la colonne existe
      if (Schema::hasColumn('posts', 'cover_image')) {
        $selectFields[] = 'posts.cover_image';
      }
      
      $details = Post::query()
        ->join('post_informations', 'posts.id', '=', 'post_informations.post_id')
        ->join('blog_categories', 'blog_categories.id', '=', 'post_informations.blog_category_id')
        ->when($languageId, fn($q) => $q->where('post_informations.language_id', '=', $languageId))
        ->where(function($q) use ($id, $slug) {
          $q->where('posts.id', '=', $id)
            ->orWhere('post_informations.slug', '=', $slug);
        })
        ->select($selectFields)
        ->firstOrFail();
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      abort(404, 'Article non trouvé');
    }

    $disqusInfo = Basic::query()->select('disqus_status', 'disqus_short_name')->first();

    $categories = collect([]);
    $totalPost = 0;
    if ($languageId && Schema::hasTable('blog_categories') && Schema::hasTable('post_informations') && Schema::hasTable('posts')) {
      $totalPost = (int) Post::query()
        ->join('post_informations', 'posts.id', '=', 'post_informations.post_id')
        ->where('post_informations.language_id', '=', $languageId)
        ->count();

      $categories = BlogCategory::query()
        ->where('language_id', '=', $languageId)
        ->where('status', '=', 1)
        ->orderBy('serial_number')
        ->get()
        ->map(function ($cat) use ($languageId) {
          $cat->postCount = (int) $cat->postInfo()->where('language_id', '=', $languageId)->count();
          return $cat;
        });
    }

    return view('frontend.blog.post-details', [
      'details' => $details,
      'categories' => $categories,
      'totalPost' => $totalPost,
      'pageHeading' => optional($language)->pageName()->select('post_details_page_title')->first(),
      'disqusInfo' => $disqusInfo,
    ]);
  }

  private function resolveLanguage(): array
  {
    try {
      if (Schema::hasTable('languages')) {
        $language = Language::query()->where('code', '=', app()->getLocale())->first();
        if (!$language) $language = Language::query()->where('is_default', '=', 1)->first();
        return [$language?->id, $language];
      }
    } catch (\Throwable $e) {
      // ignore
    }
    return [null, null];
  }

  private function paginateCollection(Collection $items, int $page, int $perPage, string $path, array $query): LengthAwarePaginator
  {
    $page = max(1, $page);
    $total = $items->count();
    $results = $items->slice(($page - 1) * $perPage, $perPage)->values();
    return new LengthAwarePaginator($results, $total, $perPage, $page, ['path' => $path, 'query' => $query]);
  }

  private function bucketizeReadingTime(int $minutes): string
  {
    if ($minutes <= 2) return '2';
    if ($minutes <= 5) return '3-5';
    return '6-10';
  }

  private function detectUniverseKeyFromText(string $text): string
  {
    $t = mb_strtolower($text);
    if (str_contains($t, 'échange') || str_contains($t, 'echange') || str_contains($t, 'logement') || str_contains($t, 'homeswap')) return 'homeswap';
    if (str_contains($t, 'cours') || str_contains($t, 'tutorat') || str_contains($t, 'formation') || str_contains($t, 'anglais') || str_contains($t, 'math') || str_contains($t, 'coaching')) return 'lessons';
    if (str_contains($t, 'domicile') || str_contains($t, 'ménage') || str_contains($t, 'menage') || str_contains($t, 'garde') || str_contains($t, 'enfant')) return 'at-home';
    if (str_contains($t, 'wellness') || str_contains($t, 'pilates') || str_contains($t, 'yoga') || str_contains($t, 'fitness')) return 'wellnesslive';
    if (str_contains($t, 'pause') || str_contains($t, 'souffle') || str_contains($t, 'cohésion') || str_contains($t, 'cohesion') || str_contains($t, 'séminaire') || str_contains($t, 'seminaire')) return 'pause-souffle';
    if (str_contains($t, 'projet') || str_contains($t, 'consulting') || str_contains($t, 'marketing') || str_contains($t, 'digital') || str_contains($t, 'strategie') || str_contains($t, 'tech') || str_contains($t, 'dev')) return 'projects';
    return 'projects';
  }

  private function detectThemeKeyFromText(string $text): string
  {
    $t = mb_strtolower($text);
    if (str_contains($t, 'guide') || str_contains($t, 'tutoriel') || str_contains($t, 'comment')) return 'guides';
    if (str_contains($t, 'client') || str_contains($t, 'réserver') || str_contains($t, 'reserver') || str_contains($t, 'comparer') || str_contains($t, 'choisir')) return 'conseils-clients';
    if (str_contains($t, 'prestataire') || str_contains($t, 'profil') || str_contains($t, 'offre') || str_contains($t, 'tarif') || str_contains($t, 'visibilité') || str_contains($t, 'visibilite')) return 'conseils-prestataires';
    if (str_contains($t, 'méthode') || str_contains($t, 'methode') || str_contains($t, 'organisation') || str_contains($t, 'process') || str_contains($t, 'productivité') || str_contains($t, 'productivite')) return 'methodes';
    if (str_contains($t, 'qualité') || str_contains($t, 'qualite') || str_contains($t, 'confiance') || str_contains($t, 'avis') || str_contains($t, 'sécurité') || str_contains($t, 'securite')) return 'qualite';
    return 'guides';
  }

  private function detectRubriqueKeyFromText(string $text): string
  {
    $t = mb_strtolower($text);
    if (str_contains($t, 'plateforme') || str_contains($t, 'fonctionnement') || str_contains($t, 'compte') || str_contains($t, 'paiement') || str_contains($t, 'abonnement')) return 'plateforme';
    if (str_contains($t, 'nouvelle') || str_contains($t, 'parution') || str_contains($t, 'release') || str_contains($t, 'update')) return 'parutions';
    if (str_contains($t, 'se former') || str_contains($t, 'formation') || str_contains($t, 'apprendre') || str_contains($t, 's’informer') || str_contains($t, "s'informer")) return 'informer';
    return 'parutions';
  }
}

