<div class="services-universe-conversation">
  @foreach($universes as $index => $universe)
    <div class="services-universe-bubble" data-index="{{ $index }}">
      <div class="services-universe-bubble__tail"></div>
      <div class="services-universe-bubble__content">
        <div class="services-universe-bubble__header">
          <h3 class="services-universe-bubble__title">{{ $universe['title'] }}</h3>
          <div class="services-universe-bubble__emoji-wrapper">
            <span class="services-universe-bubble__emoji">
              @if($index == 0)💡
              @elseif($index == 1)🎓
              @elseif($index == 2)🏠
              @elseif($index == 3)🏃
              @elseif($index == 4)🛋️
              @elseif($index == 5)🌍
              @else💬
              @endif
            </span>
          </div>
        </div>
        <p class="services-universe-bubble__baseline">{{ $universe['baseline'] }}</p>
        <p class="services-universe-bubble__text">{{ $universe['text'] }}</p>
        <a href="{{ $universe['url'] }}" class="services-universe-bubble__cta">
          {{ $universe['cta'] }}
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  @endforeach
</div>

