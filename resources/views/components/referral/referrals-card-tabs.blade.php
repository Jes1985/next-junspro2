<section id="referrals-section" class="referral-referrals-section">
  <div class="referral-referrals-container">
    <h2 class="referral-section-title">{{ __('Vos parrainages') }}</h2>
    <p class="referral-section-subtitle">
      {{ __('Suivez vos invitations, vos crédits en attente et ceux déjà obtenus.') }}
    </p>

    <div class="referral-stats-card">
      <div class="referral-stat-item">
        <div class="referral-stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
        <div class="referral-stat-content">
          <div class="referral-stat-label">{{ __('En attente') }}</div>
          <div class="referral-stat-value">{{ number_format($stats['pending_total'], 2, ',', ' ') }}€</div>
        </div>
      </div>
      <div class="referral-stat-item">
        <div class="referral-stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="referral-stat-content">
          <div class="referral-stat-label">{{ __('Crédit obtenu') }}</div>
          <div class="referral-stat-value">{{ number_format($stats['earned_total'], 2, ',', ' ') }}€</div>
        </div>
      </div>
    </div>

    <div class="referral-tabs-wrapper">
      <div class="referral-tabs">
        <button 
          class="referral-tab {{ $status === 'all' || $status === 'pending' ? 'active' : '' }}"
          onclick="window.location.href='{{ route('referral.index', ['status' => 'pending']) }}'"
        >
          {{ __('En cours') }}
        </button>
        <button 
          class="referral-tab {{ $status === 'completed' ? 'active' : '' }}"
          onclick="window.location.href='{{ route('referral.index', ['status' => 'completed']) }}'"
        >
          {{ __('Complété') }}
        </button>
      </div>

      <div class="referral-tab-content">
        @if($referrals->count() > 0)
          <div class="referral-list">
            @foreach($referrals as $referral)
              <div class="referral-item">
                <div class="referral-item-info">
                  <div class="referral-item-name">
                    @if($referral->referred->first_name)
                      {{ $referral->referred->first_name }}
                    @else
                      {{ substr($referral->referred->email_address ?? $referral->referred->email, 0, 1) }}***@{{ substr(strrchr($referral->referred->email_address ?? $referral->referred->email, '@'), 1) }}
                    @endif
                  </div>
                  <div class="referral-item-date">
                    {{ $referral->created_at->format('d/m/Y') }}
                  </div>
                </div>
                <div class="referral-item-status">
                  @if($referral->status === 'pending')
                    <span class="referral-status-badge pending">{{ __('En attente') }}</span>
                  @elseif($referral->status === 'completed')
                    <span class="referral-status-badge completed">{{ __('Complété') }}</span>
                  @endif
                </div>
                <div class="referral-item-reward">
                  @if($referral->status === 'completed')
                    <strong>{{ number_format($referral->reward_amount, 2, ',', ' ') }}€</strong>
                  @else
                    <span class="referral-reward-pending">{{ __('En attente') }}</span>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

          @if($referrals->hasMorePages())
            <div class="referral-pagination">
              <a href="{{ $referrals->nextPageUrl() }}" class="referral-btn-secondary">
                {{ __('Voir plus') }}
              </a>
            </div>
          @endif
        @else
          <div class="referral-empty-state">
            <div class="referral-empty-icon">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 8v4"></path>
                <path d="M12 16h.01"></path>
              </svg>
            </div>
            <h3 class="referral-empty-title">{{ __('Aucun parrainage pour le moment') }}</h3>
            <p class="referral-empty-text">
              {{ __('Partagez votre lien : vos parrainages apparaîtront ici dès que vos proches s\'inscrivent et réservent.') }}
            </p>
            <button 
              type="button"
              class="referral-btn-primary"
              onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
            >
              {{ __('Inviter des amis') }}
            </button>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

