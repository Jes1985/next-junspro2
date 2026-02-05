@extends('frontend.layout')

@section('style')
  <style>
    body { background: #F5F3FF; }
    .junspro-blog-hero { background-image: url('{{ asset('assets/img/blog-hero.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 0; min-height: 650px; position: relative; overflow: hidden; display: flex; align-items: center; }
    .junspro-blog-hero-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 2; }
    .junspro-blog-hero-content { text-align: center; }
    .junspro-blog-hero-title { font-size: 3.5rem; font-weight: 700; color: #111827; line-height: 1.2; margin: 0 0 2rem 0; letter-spacing: -0.02em; }
    .junspro-blog-hero-cta { display: inline-block; padding: 16px 32px; background: white; color: #1e40af; font-weight: 600; font-size: 1.1rem; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .junspro-blog-hero-cta:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); color: #4c1d95; }
    .junspro-blog-filters { background: white; padding: 2rem 0; border-bottom: 1px solid #E5E7EB; }
    .junspro-blog-filters-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-filter-form { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end; }
    .junspro-filter-group { display: flex; flex-direction: column; gap: 0.5rem; }
    .junspro-filter-label { font-size: 0.9rem; font-weight: 600; color: #374151; }
    .junspro-filter-input, .junspro-filter-select { padding: 10px 14px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 0.95rem; color: #111827; background: white; transition: all 0.3s ease; }
    .junspro-filter-input:focus, .junspro-filter-select:focus { outline: none; border-color: #4F46E5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
    .junspro-filter-submit { padding: 10px 24px; background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; white-space: nowrap; }
    .junspro-filter-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .junspro-rubriques-section { padding: 80px 0; background: #F5F3FF; }
    .junspro-rubriques-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-rubrique-block { margin-bottom: 4rem; }
    .junspro-rubrique-block:last-child { margin-bottom: 0; }
    .junspro-rubrique-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; }
    .junspro-rubrique-title { font-size: 2rem; font-weight: 700; color: #111827; margin: 0; }
    .junspro-rubrique-block:first-child .junspro-rubrique-title { margin-bottom: 4rem; }
    .junspro-rubrique-block:last-child .junspro-rubrique-title { margin-bottom: 4rem; }
    .junspro-rubrique-voir-tous { padding: 10px 20px; border: 1.5px solid rgba(75, 44, 235, 0.2); border-radius: 8px; color: #4B2CEB; font-weight: 600; text-decoration: none; transition: all 0.3s ease; background: white; }
    .junspro-rubrique-voir-tous:hover { background: #4B2CEB; color: white; border-color: #4B2CEB; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(75, 44, 235, 0.3); }
    .junspro-rubrique-plateforme-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; }
    .junspro-rubrique-card { background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06); border: 1px solid rgba(17, 24, 39, 0.08); transition: all 0.3s ease; text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }
    .junspro-rubrique-card:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(17, 24, 39, 0.1); border-color: rgba(75, 44, 235, 0.15); }
    .junspro-rubrique-card-media { width: 100%; flex: 0 0 50%; min-height: 200px; max-height: 250px; position: relative; overflow: hidden; background: #F9FAFB; }
    .junspro-rubrique-card-image { width: 100%; height: 100%; object-fit: cover; }
    .junspro-rubrique-card-image-placeholder { width: 100%; height: 100%; position: relative; background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(249, 250, 251, 0.95) 50%, rgba(255, 255, 255, 0.98) 100%); border-bottom: 1px solid rgba(17, 24, 39, 0.08); overflow: hidden; }
    .junspro-rubrique-card-image-placeholder::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle at 2px 2px, rgba(17, 24, 39, 0.015) 1px, transparent 0); background-size: 24px 24px; opacity: 0.4; }
    .junspro-rubrique-card-image-placeholder::after { content: '📄'; position: absolute; bottom: 12px; right: 12px; opacity: 0.2; font-size: 1.5rem; }
    .junspro-rubrique-card-content { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between; min-height: 0; }
    .junspro-rubrique-card-meta { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; font-size: 0.85rem; font-weight: 500; }
    .junspro-rubrique-card-meta i { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .junspro-rubrique-card-meta span { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .junspro-rubrique-card-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 0.75rem; line-height: 1.4; }
    .junspro-rubrique-card-excerpt { font-size: 0.95rem; color: #6B7280; line-height: 1.6; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .junspro-rubrique-card-link { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; font-size: 0.9rem; text-decoration: none; display: inline-block; transition: background-position 0.3s ease; }
    .junspro-rubrique-card-link:hover { background-position: 100% 0; }
    .junspro-rubrique-text-item { margin-bottom: 1.5rem; }
    .junspro-rubrique-text-item:last-child { margin-bottom: 0; }
    .junspro-rubrique-text-title { font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; line-height: 1.4; }
    .junspro-rubrique-text-excerpt { font-size: 0.95rem; color: #6B7280; line-height: 1.6; margin-bottom: 0.75rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .junspro-rubrique-text-link { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: background-position 0.3s ease; }
    .junspro-rubrique-text-link:hover { background-position: 100% 0; }
    .junspro-rubrique-parutions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .junspro-rubrique-informer-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .junspro-rubrique-informer-left { display: flex; flex-direction: column; gap: 1.5rem; }
    .junspro-cta-section { padding: 80px 0; background: #F5F3FF; border-top: 1px solid rgba(17, 24, 39, 0.08); }
    .junspro-cta-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-cta-card { background: white; border-radius: 24px; padding: 3rem; box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06); text-align: center; }
    .junspro-cta-title { font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 1rem; }
    .junspro-cta-subtitle { font-size: 1.1rem; color: #6B7280; margin-bottom: 2rem; }
    .junspro-cta-buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .junspro-cta-btn-primary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 14px 28px; background: #4B2CEB; color: white; font-weight: 600; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; }
    .junspro-cta-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(75, 44, 235, 0.3); }
    .junspro-cta-btn-secondary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 14px 28px; background: white; color: #4B2CEB; border: 1.5px solid #4B2CEB; font-weight: 600; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; }
    .junspro-cta-btn-secondary:hover { background: #F5F3FF; }
    .junspro-blog-pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; padding: 60px 0; background: #F5F3FF; }
    .junspro-pagination-link { padding: 8px 14px; border: 1.5px solid rgba(17, 24, 39, 0.08); border-radius: 8px; text-decoration: none; color: #374151; font-weight: 500; transition: all 0.3s ease; background: white; }
    .junspro-pagination-link:hover { border-color: #4B2CEB; color: #4B2CEB; background: #F5F3FF; }
    .junspro-pagination-link.active { background: #4B2CEB; color: white; border-color: #4B2CEB; }
    .junspro-pagination-link.disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; }
    @media (min-width: 1024px) { .junspro-rubrique-parutions-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 1023px) and (min-width: 769px) { .junspro-rubrique-parutions-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .junspro-blog-hero-title { font-size: 2.25rem; } .junspro-filter-form { grid-template-columns: 1fr; } .junspro-rubrique-plateforme-grid { grid-template-columns: 1fr; } .junspro-rubrique-parutions-grid { grid-template-columns: 1fr; } .junspro-rubrique-informer-grid { grid-template-columns: 1fr; } .junspro-cta-buttons { flex-direction: column; } }
  </style>
@endsection

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->blog_page_title ?? 'Blog' }}
  @else
    Blog
  @endif
@endsection

@section('content')
  <section class="junspro-blog-hero">
    <div class="junspro-blog-hero-container">
      <div class="junspro-blog-hero-content">
        <h1 class="junspro-blog-hero-title">Bienvenue sur notre Blog</h1>
        <a href="#blog-content" class="junspro-blog-hero-cta">Consulter nos articles</a>
      </div>
    </div>
  </section>

  <section class="junspro-blog-filters">
    <div class="junspro-blog-filters-container">
      <form method="GET" action="{{ route('blog') }}" class="junspro-filter-form">
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-title">Recherche par titre</label>
          <input type="text" id="filter-title" name="title" class="junspro-filter-input" placeholder="Titre de l'article..." value="{{ $filters['title'] ?? '' }}">
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-univers">Univers</label>
          <select id="filter-univers" name="univers" class="junspro-filter-select">
            <option value="">Tous les univers</option>
            <option value="projects" {{ ($filters['univers'] ?? '') === 'projects' ? 'selected' : '' }}>Projets et Consulting</option>
            <option value="lessons" {{ ($filters['univers'] ?? '') === 'lessons' ? 'selected' : '' }}>Cours et Tutorat</option>
            <option value="at-home" {{ ($filters['univers'] ?? '') === 'at-home' ? 'selected' : '' }}>Service à Domicile</option>
            <option value="homeswap" {{ ($filters['univers'] ?? '') === 'homeswap' ? 'selected' : '' }}>Échange de Logement</option>
            <option value="wellnesslive" {{ ($filters['univers'] ?? '') === 'wellnesslive' ? 'selected' : '' }}>WellnessLive</option>
            <option value="pause-souffle" {{ ($filters['univers'] ?? '') === 'pause-souffle' ? 'selected' : '' }}>Pause Souffle</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-duree">Durée de l'article</label>
          <select id="filter-duree" name="duree" class="junspro-filter-select">
            <option value="">Toutes les durées</option>
            <option value="2" {{ ($filters['duree'] ?? '') === '2' ? 'selected' : '' }}>2 minutes</option>
            <option value="3-5" {{ ($filters['duree'] ?? '') === '3-5' ? 'selected' : '' }}>3-5 minutes</option>
            <option value="6-10" {{ ($filters['duree'] ?? '') === '6-10' ? 'selected' : '' }}>6-10 minutes</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-categorie">Catégorie</label>
          <select id="filter-categorie" name="categorie" class="junspro-filter-select">
            <option value="">Toutes les catégories</option>
            <option value="guides" {{ ($filters['categorie'] ?? '') === 'guides' ? 'selected' : '' }}>Guides & tutoriels</option>
            <option value="conseils-clients" {{ ($filters['categorie'] ?? '') === 'conseils-clients' ? 'selected' : '' }}>Conseils clients</option>
            <option value="conseils-prestataires" {{ ($filters['categorie'] ?? '') === 'conseils-prestataires' ? 'selected' : '' }}>Conseils prestataires</option>
            <option value="methodes" {{ ($filters['categorie'] ?? '') === 'methodes' ? 'selected' : '' }}>Méthodes & organisation</option>
            <option value="qualite" {{ ($filters['categorie'] ?? '') === 'qualite' ? 'selected' : '' }}>Qualité & confiance</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-rubrique">Rubrique</label>
          <select id="filter-rubrique" name="rubrique" class="junspro-filter-select">
            <option value="">Toutes les rubriques</option>
            <option value="plateforme" {{ ($filters['rubrique'] ?? '') === 'plateforme' ? 'selected' : '' }}>Mieux connaître la plateforme</option>
            <option value="parutions" {{ ($filters['rubrique'] ?? '') === 'parutions' ? 'selected' : '' }}>Nos nouvelles parutions</option>
            <option value="informer" {{ ($filters['rubrique'] ?? '') === 'informer' ? 'selected' : '' }}>S'informer et se former</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <button type="submit" class="junspro-filter-submit">Filtrer</button>
        </div>
      </form>
    </div>
  </section>

  @php
    $items = collect($posts->items());
    // Filtrer l'article "Test" et les articles avec titre "Test"
    $items = $items->filter(function($item) {
      $title = strtolower(trim($item->title ?? ''));
      return $title !== 'test' && !str_starts_with($title, 'article exemple');
    });
    
    $placeholderDurations = [2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 4, 8, 6];
    $placeholders = collect(range(1, 13))->map(function($i) use ($placeholderDurations) {
      return (object)[
        'id' => 999999 + $i,
        'title' => "Article exemple {$i}",
        'slug' => '#',
        'excerpt' => "Texte de démonstration pour prévisualiser la mise en page et la structure des articles du blog.",
        'reading_minutes' => $placeholderDurations[$i - 1] ?? 2,
        'image' => null,
        'categoryName' => 'Exemple',
        'is_placeholder' => true,
      ];
    });
    // Garantir que le premier article réel est en première position
    $firstReal = $items->first();
    $restItems = $items->slice(1);
    $itemsComplete = collect();
    if ($firstReal) {
      $itemsComplete = $itemsComplete->push($firstReal);
    }
    $itemsComplete = $itemsComplete->concat($restItems)->concat($placeholders)->take(13);
    
    $s1_main = $itemsComplete->slice(0, 2);
    $s1_list = $itemsComplete->slice(2, 3);
    $s2_grid = $itemsComplete->slice(5, 4);
    $s3_list = $itemsComplete->slice(9, 3);
    $s3_featured = $itemsComplete->slice(12, 1)->first();
  @endphp

  <section class="junspro-rubriques-section" id="blog-content">
    <div class="junspro-rubriques-container">
      {{-- Section 1: Mieux connaître la plateforme --}}
      <div class="junspro-rubrique-block">
        <h2 class="junspro-rubrique-title">Mieux connaître la plateforme</h2>
        <div class="junspro-rubrique-plateforme-grid">
          @foreach($s1_main as $post)
            <a href="{{ ($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" class="junspro-rubrique-card">
              <div class="junspro-rubrique-card-media">
                @if(!empty($post->image) && !($post->is_placeholder ?? false))
                  <img src="{{ asset('assets/img/posts/' . $post->image) }}" alt="{{ $post->title }}" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
                @else
                  <div class="junspro-rubrique-card-image-placeholder"></div>
                @endif
              </div>
              <div class="junspro-rubrique-card-content">
                <div class="junspro-rubrique-card-meta">
                  <i class="fas fa-clock"></i>
                  <span>{{ $post->reading_minutes ?? 2 }}min</span>
                </div>
                <h3 class="junspro-rubrique-card-title">{{ $post->title }}</h3>
                <p class="junspro-rubrique-card-excerpt">{{ Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 120) }}</p>
                <span class="junspro-rubrique-card-link">Lire l'article <i class="fas fa-arrow-right"></i></span>
              </div>
            </a>
          @endforeach
          <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($s1_list as $post)
              <div class="junspro-rubrique-text-item">
                <a href="{{ ($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" style="text-decoration: none; color: inherit;">
                  <h3 class="junspro-rubrique-text-title">{{ $post->title }}</h3>
                  <p class="junspro-rubrique-text-excerpt">{{ Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 100) }}</p>
                  <span class="junspro-rubrique-text-link">Lire cet article de {{ $post->reading_minutes ?? 2 }}mn</span>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Section 2: Nos nouvelles parutions --}}
      <div class="junspro-rubrique-block">
        <div class="junspro-rubrique-header">
          <h2 class="junspro-rubrique-title">Nos nouvelles parutions</h2>
          <a href="{{ route('blog', ['rubrique' => 'parutions']) }}" class="junspro-rubrique-voir-tous">Voir tous les articles</a>
        </div>
        <div class="junspro-rubrique-parutions-grid">
          @foreach($s2_grid as $post)
            <a href="{{ ($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" class="junspro-rubrique-card">
              <div class="junspro-rubrique-card-media">
                @if(!empty($post->image) && !($post->is_placeholder ?? false))
                  <img src="{{ asset('assets/img/posts/' . $post->image) }}" alt="{{ $post->title }}" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
                @else
                  <div class="junspro-rubrique-card-image-placeholder"></div>
                @endif
              </div>
              <div class="junspro-rubrique-card-content">
                <div class="junspro-rubrique-card-meta">
                  <i class="fas fa-clock"></i>
                  <span>{{ $post->reading_minutes ?? 2 }}min</span>
                </div>
                <h3 class="junspro-rubrique-card-title">{{ $post->title }}</h3>
                <p class="junspro-rubrique-card-excerpt">{{ Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 120) }}</p>
                <span class="junspro-rubrique-card-link">Lire cet article de {{ $post->reading_minutes ?? 2 }}mn</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Section 3: S'informer et se former --}}
      <div class="junspro-rubrique-block">
        <h2 class="junspro-rubrique-title">S'informer et se former</h2>
        <div class="junspro-rubrique-informer-grid">
          <div class="junspro-rubrique-informer-left">
            @foreach($s3_list as $post)
              <div class="junspro-rubrique-text-item">
                <a href="{{ ($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" style="text-decoration: none; color: inherit;">
                  <h3 class="junspro-rubrique-text-title">{{ $post->title }}</h3>
                  <p class="junspro-rubrique-text-excerpt">{{ Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 100) }}</p>
                  <span class="junspro-rubrique-text-link">Lire cet article de {{ $post->reading_minutes ?? 2 }}mn</span>
                </a>
              </div>
            @endforeach
          </div>
          <div>
            @if($s3_featured)
              <a href="{{ ($s3_featured->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $s3_featured->slug, 'id' => $s3_featured->id]) }}" class="junspro-rubrique-card">
                <div class="junspro-rubrique-card-media">
                  @if(!empty($s3_featured->image) && !($s3_featured->is_placeholder ?? false))
                    <img src="{{ asset('assets/img/posts/' . $s3_featured->image) }}" alt="{{ $s3_featured->title }}" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
                  @else
                    <div class="junspro-rubrique-card-image-placeholder"></div>
                  @endif
                </div>
                <div class="junspro-rubrique-card-content">
                  <div class="junspro-rubrique-card-meta">
                    <i class="fas fa-clock"></i>
                    <span>{{ $s3_featured->reading_minutes ?? 2 }}min</span>
                  </div>
                  <h3 class="junspro-rubrique-card-title">{{ $s3_featured->title }}</h3>
                  <p class="junspro-rubrique-card-excerpt">{{ Str::limit(strip_tags($s3_featured->content ?? $s3_featured->excerpt ?? ''), 120) }}</p>
                  <span class="junspro-rubrique-card-link">Lire cet article de {{ $s3_featured->reading_minutes ?? 2 }}mn</span>
                </div>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA Section --}}
  <section class="junspro-cta-section">
    <div class="junspro-cta-container">
      <div class="junspro-cta-card">
        <h2 class="junspro-cta-title">Prêt à passer à l'action ?</h2>
        <p class="junspro-cta-subtitle">Déposez votre mission ou trouvez le freelance idéal pour votre projet.</p>
        <div class="junspro-cta-buttons">
          <a href="{{ route('mission.form') }}" class="junspro-cta-btn-primary">
            <i class="fas fa-paper-plane"></i>
            Déposer une mission
          </a>
          <a href="{{ route('services') }}" class="junspro-cta-btn-secondary">
            <i class="fas fa-search"></i>
            Trouver un freelance
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- Pagination --}}
  <div class="junspro-blog-pagination">
    @if($posts->onFirstPage())
      <span class="junspro-pagination-link disabled">&lt;</span>
    @else
      <a href="{{ $posts->previousPageUrl() }}" class="junspro-pagination-link">&lt;</a>
    @endif
    @foreach(range(1, $posts->lastPage()) as $page)
      @if($page == $posts->currentPage())
        <span class="junspro-pagination-link active">{{ $page }}</span>
      @else
        <a href="{{ $posts->url($page) }}" class="junspro-pagination-link">{{ $page }}</a>
      @endif
    @endforeach
    @if($posts->hasMorePages())
      <a href="{{ $posts->nextPageUrl() }}" class="junspro-pagination-link">&gt;</a>
    @else
      <span class="junspro-pagination-link disabled">&gt;</span>
    @endif
  </div>
@endsection

@section('script')
  <script>
    document.querySelector('.junspro-blog-hero-cta')?.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('blog-content')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    // Scroller vers les résultats après soumission des filtres
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const hasFilters = urlParams.has('title') || urlParams.has('univers') || urlParams.has('duree') || 
                         urlParams.has('categorie') || urlParams.has('rubrique');
      
      if (hasFilters) {
        setTimeout(function() {
          document.getElementById('blog-content')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
      }
    });
  </script>
@endsection
