@php
  $currencyInfo = $currencyInfo ?? (object)['base_currency_symbol_position' => 'right', 'base_currency_symbol' => '€'];
  $position = $currencyInfo->base_currency_symbol_position ?? 'right';
  $symbol = $currencyInfo->base_currency_symbol ?? '€';
  $languageId = $languageId ?? 1;
  
  if ($service->seller_id != 0) {
    $seller = App\Models\Seller::where('id', $service->seller_id)->first();
  } else {
    $admin = App\Models\Admin::first();
    $seller = null;
  }
  
  $currentMinPackagePrice = $service->package()->where('language_id', $languageId)->min('current_price');
  $previousPackagePrice = $service->package()->where('language_id', $languageId)->min('previous_price');
  $reviewCount = $service->reviewCount ?? $service->review()->count() ?? 0;
@endphp

<div class="service-card-premium">
  <!-- Image du service -->
  <div class="service-card-image-wrapper">
    <a href="{{ route('service_details', ['slug' => $service->slug, 'id' => $service->id]) }}" 
       class="service-image-link" title="{{ $service->title }}">
      <img class="service-image lazyload" 
           src="{{ asset('assets/front/images/placeholder.png') }}"
           data-src="{{ asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image) }}"
           alt="{{ $service->title }}">
    </a>
    <a href="{{ route('service.update_wishlist', ['slug' => $service->slug]) }}"
       class="service-wishlist-icon" 
       data-tooltip="tooltip" 
       data-bs-placement="top"
       title="{{ @$service->wishlisted == true ? __('Remove from wishlist') : __('Save to Wishlist') }}">
      @auth('web')
        <i class="fas fa-heart {{ @$service->wishlisted == true ? 'wishlist-active' : '' }}"></i>
      @endauth
      @guest('web')
        <i class="fas fa-heart"></i>
      @endguest
    </a>
  </div>

  <!-- Contenu de la carte -->
  <div class="service-card-body">
    <!-- Titre -->
    <h3 class="service-card-title">
      <a href="{{ route('service_details', ['slug' => $service->slug, 'id' => $service->id]) }}">
        {{ strlen($service->title) > 60 ? mb_substr($service->title, 0, 60, 'UTF-8') . '...' : $service->title }}
      </a>
    </h3>

    <!-- Freelance info -->
    <div class="service-freelancer-info">
      @if ($seller)
        <a href="{{ route('frontend.seller.details', ['username' => $seller->username]) }}" class="freelancer-link">
          @if (!is_null($seller->photo))
            <img class="freelancer-avatar" 
                 src="{{ asset('assets/admin/img/seller-photo/' . $seller->photo) }}"
                 alt="{{ $seller->username }}">
          @else
            <div class="freelancer-avatar-initials">
              {{ strtoupper(mb_substr($seller->username, 0, 2, 'UTF-8')) }}
            </div>
          @endif
          <div class="freelancer-details">
            <span class="freelancer-name">{{ strlen($seller->username) > 18 ? mb_substr($seller->username, 0, 18, 'UTF-8') . '..' : $seller->username }}</span>
            @if (@$seller->seller_info && @$seller->seller_info->country)
              <span class="freelancer-location">{{ $seller->seller_info->country }}</span>
            @endif
          </div>
        </a>
      @elseif ($admin)
        <a href="{{ route('frontend.seller.details', ['username' => $admin->username, 'admin' => true]) }}" class="freelancer-link">
          @if (!empty($admin->image))
            <img class="freelancer-avatar" 
                 src="{{ asset('assets/img/admins/' . $admin->image) }}"
                 alt="{{ $admin->username }}">
          @else
            <div class="freelancer-avatar-initials">
              {{ strtoupper(mb_substr($admin->username, 0, 2, 'UTF-8')) }}
            </div>
          @endif
          <div class="freelancer-details">
            <span class="freelancer-name">{{ strlen($admin->username) > 18 ? mb_substr($admin->username, 0, 18, 'UTF-8') . '..' : $admin->username }}</span>
          </div>
        </a>
      @endif
    </div>

    <!-- Rating -->
    <div class="service-rating">
      <div class="rating-stars">
        <div class="star-background" data-bg-img="{{ asset('assets/front/images/rate-star-md.png') }}">
          <div class="star-fill" style="width: {{ ($service->average_rating ?? 0) * 20 }}%"></div>
        </div>
        <span class="rating-text">
          <strong>{{ number_format($service->average_rating ?? 0, 1) }}</strong>
          <span class="rating-count">({{ $reviewCount }})</span>
        </span>
      </div>
    </div>

    <!-- Prix -->
    <div class="service-card-footer">
      @if ($service->quote_btn_status == 1)
        <span class="price-label">{{ __('Sur devis') }}</span>
      @else
        <div class="price-info">
          <span class="price-label">{{ __('À partir de') }}</span>
          <span class="price-value">
            {{ $position == 'left' ? $symbol : '' }}{{ is_null($currentMinPackagePrice) ? formatPrice('0.00') : formatPrice($currentMinPackagePrice) }}{{ $position == 'right' ? $symbol : '' }}
          </span>
          @if ($previousPackagePrice)
            <span class="price-old">{{ $position == 'left' ? $symbol : '' }}{{ formatPrice($previousPackagePrice) }}{{ $position == 'right' ? $symbol : '' }}</span>
          @endif
        </div>
      @endif
    </div>
  </div>
</div>

<style>
  /* Carte Service Premium */
  .service-card-premium {
    background: var(--premium-bg);
    border-radius: 24px;
    overflow: hidden;
    border: 1.5px solid var(--premium-border);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
  }
  
  .service-card-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    transform: scaleX(0);
    transition: transform 0.4s ease;
    z-index: 1;
  }

  .service-card-premium:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
    border-color: #1e40af;
  }
  
  .service-card-premium:hover::before {
    transform: scaleX(1);
  }

  .service-card-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* Ratio 16:9 */
    overflow: hidden;
    background: var(--premium-bg-light);
  }

  .service-image-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: block;
  }

  .service-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .service-card-premium:hover .service-image {
    transform: scale(1.08);
  }

  .service-wishlist-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--premium-text-light);
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 2;
  }

  .service-wishlist-icon:hover {
    background: white;
    color: #ef4444;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .service-wishlist-icon .wishlist-active {
    color: #ef4444;
  }

  .service-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .service-card-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--premium-text);
    margin: 0 0 12px 0;
    line-height: 1.4;
    min-height: 44px;
  }

  .service-card-title a {
    color: var(--premium-text);
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .service-card-title a:hover {
    color: #1e40af;
  }

  .service-freelancer-info {
    margin-bottom: 12px;
  }

  .freelancer-link {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    transition: opacity 0.2s ease;
  }

  .freelancer-link:hover {
    opacity: 0.8;
  }

  .freelancer-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }

  .freelancer-avatar-initials {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--premium-gradient);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    flex-shrink: 0;
  }

  .freelancer-details {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .freelancer-name {
    font-size: 14px;
    font-weight: 500;
    color: var(--premium-text);
    line-height: 1.3;
  }

  .freelancer-location {
    font-size: 12px;
    color: var(--premium-text-light);
  }

  .service-rating {
    margin-bottom: 16px;
  }

  .rating-stars {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .star-background {
    width: 80px;
    height: 14px;
    position: relative;
    background: url("data:image/svg+xml,%3Csvg width='80' height='14' viewBox='0 0 80 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 0L8.5 5H14L9.75 8L11.25 13L7 10L2.75 13L4.25 8L0 5H5.5L7 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M23 0L24.5 5H30L25.75 8L27.25 13L23 10L18.75 13L20.25 8L16 5H21.5L23 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M39 0L40.5 5H46L41.75 8L43.25 13L39 10L34.75 13L36.25 8L32 5H37.5L39 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M55 0L56.5 5H62L57.75 8L59.25 13L55 10L50.75 13L52.25 8L48 5H53.5L55 0Z' fill='%23E5E7EB'/%3E%3Cpath d='M71 0L72.5 5H78L73.75 8L75.25 13L71 10L66.75 13L68.25 8L64 5H69.5L71 0Z' fill='%23E5E7EB'/%3E%3C/svg%3E") no-repeat;
    background-size: contain;
  }

  .star-fill {
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='14' viewBox='0 0 80 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 0L8.5 5H14L9.75 8L11.25 13L7 10L2.75 13L4.25 8L0 5H5.5L7 0Z' fill='%23FBBF24'/%3E%3Cpath d='M23 0L24.5 5H30L25.75 8L27.25 13L23 10L18.75 13L20.25 8L16 5H21.5L23 0Z' fill='%23FBBF24'/%3E%3Cpath d='M39 0L40.5 5H46L41.75 8L43.25 13L39 10L34.75 13L36.25 8L32 5H37.5L39 0Z' fill='%23FBBF24'/%3E%3Cpath d='M55 0L56.5 5H62L57.75 8L59.25 13L55 10L50.75 13L52.25 8L48 5H53.5L55 0Z' fill='%23FBBF24'/%3E%3Cpath d='M71 0L72.5 5H78L73.75 8L75.25 13L71 10L66.75 13L68.25 8L64 5H69.5L71 0Z' fill='%23FBBF24'/%3E%3C/svg%3E") no-repeat;
    background-size: contain;
    overflow: hidden;
  }

  .rating-text {
    font-size: 13px;
    color: var(--premium-text-medium);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .rating-text strong {
    color: var(--premium-text);
    font-weight: 600;
  }

  .rating-count {
    color: var(--premium-text-light);
  }

  .service-card-footer {
    margin-top: auto;
    padding-top: 16px;
    border-top: 1px solid var(--premium-border);
  }

  .price-label {
    display: block;
    font-size: 12px;
    color: var(--premium-text-light);
    margin-bottom: 4px;
  }

  .price-info {
    display: flex;
    align-items: baseline;
    gap: 6px;
    flex-wrap: wrap;
  }

  .price-value {
    font-size: 20px;
    font-weight: 700;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
  }

  .price-old {
    font-size: 14px;
    color: var(--premium-text-light);
    text-decoration: line-through;
  }
</style>

