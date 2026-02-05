@php
  $sellerInfo = \App\Models\SellerInfo::where('seller_id', $seller->id)->first();
  $avgRating = SellerAvgRating($seller->id);
  $orderCount = \App\Models\ClientService\ServiceOrder::where([['seller_id', $seller->id], ['order_status', 'completed']])->count();
@endphp

<div class="freelancer-card-compact">
  <div class="freelancer-card-compact-content">
    <div class="freelancer-card-compact-left">
      @if (!is_null($seller->photo))
        <img class="freelancer-card-compact-photo" 
             src="{{ asset('assets/admin/img/seller-photo/' . $seller->photo) }}" 
             alt="{{ $seller->username }}">
      @else
        <img class="freelancer-card-compact-photo" 
             src="{{ asset('assets/img/seller-blank-user.jpg') }}" 
             alt="{{ $seller->username }}">
      @endif
    </div>
    <div class="freelancer-card-compact-center">
      <h4 class="freelancer-card-compact-name">
        <a href="{{ route('frontend.seller.details', ['username' => $seller->username]) }}" target="_self">
          {{ $sellerInfo && $sellerInfo->name ? $sellerInfo->name : $seller->username }}
        </a>
      </h4>
      @if ($sellerInfo && $sellerInfo->designation)
        <p class="freelancer-card-compact-specialty">{{ $sellerInfo->designation }}</p>
      @endif
      <div class="freelancer-card-compact-rating">
        <span class="rating-stars">
          @for ($i = 0; $i < 5; $i++)
            <span class="star {{ $i < floor($avgRating) ? 'filled' : '' }}">⭐</span>
          @endfor
        </span>
        <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
      </div>
    </div>
    <div class="freelancer-card-compact-right">
      <a href="{{ route('frontend.seller.details', ['username' => $seller->username]) }}" 
         class="freelancer-card-compact-cta" target="_self">
        {{ __('Voir le profil') }}
      </a>
    </div>
  </div>
</div>

<style>
.freelancer-card-compact {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  transition: all 0.3s;
}

.freelancer-card-compact:hover {
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
  transform: translateY(-2px);
}

.freelancer-card-compact-content {
  display: flex;
  align-items: center;
  gap: 16px;
}

.freelancer-card-compact-left {
  flex-shrink: 0;
}

.freelancer-card-compact-photo {
  width: 60px;
  height: 60px;
  border-radius: 12px;
  object-fit: cover;
  border: 2px solid var(--junspro-gray-200);
}

.freelancer-card-compact-center {
  flex: 1;
  min-width: 0;
}

.freelancer-card-compact-name {
  font-size: 16px;
  font-weight: 600;
  color: var(--junspro-gray-900);
  margin-bottom: 4px;
}

.freelancer-card-compact-name a {
  color: inherit;
  text-decoration: none;
}

.freelancer-card-compact-name a:hover {
  color: var(--junspro-primary);
}

.freelancer-card-compact-specialty {
  font-size: 13px;
  color: var(--junspro-gray-600);
  margin-bottom: 8px;
}

.freelancer-card-compact-rating {
  display: flex;
  align-items: center;
  gap: 6px;
}

.rating-stars {
  display: flex;
  gap: 2px;
}

.rating-stars .star {
  font-size: 12px;
}

.rating-value {
  font-size: 13px;
  font-weight: 600;
  color: var(--junspro-gray-700);
}

.freelancer-card-compact-right {
  flex-shrink: 0;
}

.freelancer-card-compact-cta {
  padding: 8px 16px;
  background: var(--junspro-primary);
  color: white;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s;
  display: inline-block;
}

.freelancer-card-compact-cta:hover {
  background: var(--junspro-primary-dark);
  transform: translateY(-1px);
}
</style>




