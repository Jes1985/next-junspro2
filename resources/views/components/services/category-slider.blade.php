@php
  // Déterminer l'univers depuis la route actuelle ou les paramètres
  $universe = 'at-home'; // Par défaut
  
  if (request()->route()->hasParameter('universe')) {
    $universe = request()->route('universe');
  } else {
    $currentRoute = request()->route()->getName();
    if (strpos($currentRoute, 'services.projects') !== false) {
      $universe = 'projects';
    } elseif (strpos($currentRoute, 'services.lessons') !== false) {
      $universe = 'lessons';
    } elseif (strpos($currentRoute, 'services.at-home') !== false) {
      $universe = 'at-home';
    } elseif (strpos($currentRoute, 'services.wellnesslive') !== false) {
      $universe = 'wellnesslive';
    } elseif (strpos($currentRoute, 'services.corporate') !== false) {
      $universe = 'corporate';
    } elseif (strpos($currentRoute, 'services.homeswap') !== false) {
      $universe = 'homeswap';
    }
  }
  
  // Récupérer la catégorie actuelle si on est sur une page de catégorie
  $currentCategory = null;
  if (request()->route()->hasParameter('category')) {
    $currentCategory = request()->route('category');
  }
@endphp

<div class="services-category-slider">
  <div class="services-category-slider__container">
    @if(isset($categories) && is_array($categories))
      @php
        // Détecter si c'est un tableau associatif (catégories groupées)
        $isGrouped = false;
        if (count($categories) > 0) {
          $firstKey = array_key_first($categories);
          $isGrouped = is_string($firstKey) && is_array($categories[$firstKey]);
        }
      @endphp
      
      @if($isGrouped)
        {{-- Catégories groupées (Junspro Ritual Motion) --}}
        @foreach($categories as $groupName => $groupCategories)
          @if(is_array($groupCategories))
            <div class="services-category-group">
              <span class="services-category-group__label">{{ $groupName }}</span>
              @foreach($groupCategories as $category)
                @if(is_string($category))
                  @php
                    $categorySlug = strtolower(str_replace([' ', '&'], ['-', ''], $category));
                    $categoryUrl = route('services.category', ['universe' => $universe, 'category' => $categorySlug]);
                    $isActive = $currentCategory === $categorySlug;
                  @endphp
                  <a href="{{ $categoryUrl }}" class="services-category-chip {{ $isActive ? 'active' : '' }}" data-category="{{ $category }}">
                    {{ $category }}
                  </a>
                @endif
              @endforeach
            </div>
          @endif
        @endforeach
      @else
        {{-- Catégories simples (liste plate) --}}
        @foreach($categories as $category)
          @if(is_string($category))
            @php
              // Générer le slug de la catégorie pour l'URL
              $categorySlug = strtolower(str_replace([' ', '&'], ['-', ''], $category));
              $categoryUrl = route('services.category', ['universe' => $universe, 'category' => $categorySlug]);
              $isActive = $currentCategory === $categorySlug;
            @endphp
            <a href="{{ $categoryUrl }}" class="services-category-chip {{ $isActive ? 'active' : '' }}" data-category="{{ $category }}">
              {{ $category }}
            </a>
          @endif
        @endforeach
      @endif
    @endif
  </div>
</div>

