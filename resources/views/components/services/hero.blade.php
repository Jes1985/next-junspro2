@php
  // Chercher une image hero pour cette page
  $heroImagePath = null;
  $heroImageExists = false;
  
  // Déterminer le nom de l'image selon la page
  $imageName = 'services-hero';
  if (isset($imageNameOverride)) {
    $imageName = $imageNameOverride;
  } elseif (isset($title)) {
    // Générer un nom basé sur le titre
    $imageName = 'services-' . strtolower(str_replace([' ', 'é', 'è', 'ê', 'à', 'ô'], ['-', 'e', 'e', 'e', 'a', 'o'], $title));
    $imageName = preg_replace('/[^a-z0-9-]/', '', $imageName);
  }
  
  // Emplacements possibles pour l'image hero
  $possiblePaths = [
    public_path("images/{$imageName}.png"),
    public_path("images/{$imageName}.jpg"),
    public_path("images/{$imageName}.jpeg"),
    public_path("images/{$imageName}.webp"),
    public_path("assets/img/{$imageName}.png"),
    public_path("assets/img/{$imageName}.jpg"),
    public_path("assets/img/{$imageName}.jpeg"),
    public_path("assets/img/{$imageName}.webp"),
  ];
  
  foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
      $heroImageExists = true;
      $relativePath = str_replace(public_path(), '', $path);
      $heroImagePath = str_replace('\\', '/', $relativePath);
      if (!str_starts_with($heroImagePath, '/')) {
        $heroImagePath = '/' . $heroImagePath;
      }
      break;
    }
  }
  
  // Si une image est fournie directement, l'utiliser en priorité
  if (isset($image) && $image) {
    $heroImagePath = $image;
    $heroImageExists = true;
  }
@endphp

<div class="services-hero">
  <div class="services-hero__image-wrapper">
    @if($heroImageExists && $heroImagePath)
      <img src="{{ $heroImagePath }}" alt="{{ $title ?? '' }}" class="services-hero__image">
    @else
      <div class="services-hero__placeholder"></div>
    @endif
  </div>
  <div class="services-hero__content">
    <h1 class="services-hero__title">{{ $title }}</h1>
    @if(isset($subtitle))
      <h2 class="services-hero__subtitle">{{ $subtitle }}</h2>
    @endif
    @if(isset($micro))
      <p class="services-hero__micro">{{ $micro }}</p>
    @endif
    @if(isset($cta))
      <div class="services-hero__cta">
        @if(is_array($cta) && isset($cta[0]))
          {{-- CTA multiples (tableau de boutons) --}}
          @foreach($cta as $button)
            @if(is_array($button))
              <a href="{{ $button['url'] ?? '#' }}" class="services-hero__btn services-hero__btn--{{ $button['variant'] ?? 'primary' }}">
                {{ $button['text'] ?? 'Voir plus' }}
              </a>
            @endif
          @endforeach
        @elseif(is_array($cta) && isset($cta['url']))
          {{-- CTA unique (objet) --}}
          <a href="{{ $cta['url'] }}" class="services-hero__btn services-hero__btn--primary">
            {{ $cta['text'] ?? 'Voir plus' }}
          </a>
        @endif
      </div>
    @endif
    @if(isset($searchPlaceholder))
      <div class="services-hero__search">
        <form action="{{ route('services.projects') }}" method="GET" class="services-hero__search-form">
          <input type="text" name="q" placeholder="{{ $searchPlaceholder }}" class="services-hero__search-input">
          <button type="submit" class="services-hero__search-btn">
            <i class="far fa-search"></i>
          </button>
        </form>
      </div>
    @endif
  </div>
</div>

