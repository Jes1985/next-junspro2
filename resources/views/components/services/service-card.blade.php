<div class="services-service-card">
  @if(isset($image) && $image)
    <div class="services-service-card__image-wrapper">
      <img src="{{ $image }}" alt="{{ $title }}" class="services-service-card__image">
    </div>
  @endif
  <div class="services-service-card__content">
    <h3 class="services-service-card__title">{{ $title }}</h3>
    @if(isset($description))
      <p class="services-service-card__description">{{ $description }}</p>
    @endif
    @if(isset($badges))
      <div class="services-service-card__badges">
        @if(is_array($badges))
          @foreach($badges as $badge)
            <span class="services-service-card__badge">{{ $badge }}</span>
          @endforeach
        @else
          <span class="services-service-card__badge">{{ $badges }}</span>
        @endif
      </div>
    @endif
    @if(isset($price))
      <div class="services-service-card__price">{{ $price }}</div>
    @endif
    @if(isset($cta))
      <a href="{{ $cta['url'] ?? '#' }}" class="services-service-card__cta">
        {{ $cta['text'] ?? 'Voir plus' }}
      </a>
    @endif
  </div>
</div>

