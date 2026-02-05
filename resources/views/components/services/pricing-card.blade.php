<div class="services-pricing-card">
  <h3 class="services-pricing-card__title">{{ $title }}</h3>
  @if(isset($subtext))
    <p class="services-pricing-card__subtext">{{ $subtext }}</p>
  @endif
  @if(isset($cta))
    <a href="{{ $cta['url'] }}" class="services-pricing-card__cta">{{ $cta['text'] }}</a>
  @endif
</div>

