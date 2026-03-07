@extends('frontend.layout')

@section('pageHeading', __('Mon Espace Apporteur'))

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/front/css/affiliate-premium.css') }}?v={{ time() }}">
@endsection

@section('content')
@php
  $tierClass = match($affiliate->tier) {
      'elite' => 'aff-hero--elite',
      'club'  => 'aff-hero--club',
      default => '',
  };
  $tierIcons = [
      'ambassador' => '⭐',
      'elite'      => '⭐⭐',
      'club'       => '👑',
  ];
  $tierIcon = $tierIcons[$affiliate->tier] ?? '⭐';
  $totalAll  = $stats['pending_count'] + $stats['validated_count'] + $stats['paid_count'];
@endphp

<div class="aff-page-container">

  {{-- ─── Flash messages ──────────────────────────────────────── --}}
  @if(session('success') || session('info') || session('error'))
    <div class="aff-flash">
      @if(session('success'))
        <div class="aff-flash__inner aff-flash__inner--success">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @if(session('info'))
        <div class="aff-flash__inner aff-flash__inner--info">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ session('info') }}
        </div>
      @endif
      @if(session('error'))
        <div class="aff-flash__inner aff-flash__inner--error">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          {{ session('error') }}
        </div>
      @endif
    </div>
  @endif

  {{-- ─── HERO SECTION ──────────────────────────────────────── --}}
  <section class="aff-hero {{ $tierClass }}"
    x-data="{
      copied: false,
      copyLink() {
        const input = document.getElementById('aff-tracking-link');
        if (!input) return;
        navigator.clipboard.writeText(input.value).then(() => {
          this.copied = true;
          setTimeout(() => this.copied = false, 2500);
        });
      }
    }">
    <div class="aff-hero__container">

      {{-- Gauche : contenu principal --}}
      <div class="aff-hero__left">
        <div class="aff-hero__content">

          {{-- Badge palier --}}
          <div class="aff-tier-badge aff-tier-badge--{{ $affiliate->tier }}">
            {{ $tierIcon }} {{ $affiliate->tier_label }}
          </div>

          {{-- Titre --}}
          <h1 class="aff-hero__title">
            Bonjour, {{ $user->first_name ?? explode(' ', $user->name)[0] }} 👋
          </h1>
          <p class="aff-hero__subtitle">Votre espace apporteur d'affaires JunsPro</p>

          {{-- Lien de tracking copiable --}}
          <div class="aff-link-box">
            <input
              id="aff-tracking-link"
              class="aff-link-box__input"
              type="text"
              value="{{ $stats['tracking_link'] }}"
              readonly
              aria-label="Votre lien de parrainage"
            >
            <button
              type="button"
              class="aff-link-box__btn"
              :class="{ 'aff-link-box__btn--copied': copied }"
              @click="copyLink()"
              x-text="copied ? '✓ Copié !' : 'Copier'"
            >Copier</button>
          </div>

          {{-- Taux de commission --}}
          <div class="aff-commission-badge">
            <span class="aff-commission-badge__rate">{{ number_format($affiliate->commission_rate, 0) }}%</span>
            par conversion confirmée
            &nbsp;·&nbsp; jusqu'à {{ \App\Models\Affiliate::TIERS[$affiliate->tier]['duration_months'] }} mois/filleul
          </div>

        </div>
      </div>

      {{-- Droite : KPI Cards --}}
      <div class="aff-hero__right">
        <div class="aff-kpi-grid">
          <div class="aff-kpi-card">
            <div class="aff-kpi-label">Total gagné</div>
            <div class="aff-kpi-value">{{ number_format($stats['total_earned'], 2, ',', ' ') }}<small style="font-size:16px">€</small></div>
            <div class="aff-kpi-sub">toutes commissions</div>
          </div>
          <div class="aff-kpi-card">
            <div class="aff-kpi-label">En attente</div>
            <div class="aff-kpi-value">{{ number_format($stats['pending_payout'], 2, ',', ' ') }}<small style="font-size:16px">€</small></div>
            <div class="aff-kpi-sub">validation J+7</div>
          </div>
          <div class="aff-kpi-card">
            <div class="aff-kpi-label">Déjà payé</div>
            <div class="aff-kpi-value">{{ number_format($stats['paid_out'], 2, ',', ' ') }}<small style="font-size:16px">€</small></div>
            <div class="aff-kpi-sub">virements reçus</div>
          </div>
          <div class="aff-kpi-card">
            <div class="aff-kpi-label">Filleuls actifs</div>
            <div class="aff-kpi-value">{{ $stats['unique_referrals'] }}</div>
            <div class="aff-kpi-sub">{{ $stats['active_conversions'] }} conversion{{ $stats['active_conversions'] > 1 ? 's' : '' }}</div>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- ─── SECTIONS CONTENU ─────────────────────────────────── --}}
  <div class="aff-content-sections">

    {{-- ── Récapitulatif des paliers ──────────────────────── --}}
    <div class="aff-tier-banner">
      <div>
        <div class="aff-section-title" style="margin-bottom:0">Paliers de commission</div>
        <p style="font-size:14px;color:var(--aff-gray-500);margin:4px 0 0">Plus vous apportez de clients, plus votre taux augmente.</p>
      </div>
      <div class="aff-tier-banner__tiers">
        @foreach(\App\Models\Affiliate::TIERS as $key => $tier)
          <div class="aff-tier-pill aff-tier-pill--{{ $key }} {{ $affiliate->tier === $key ? 'aff-tier-pill--active' : '' }}">
            <span class="aff-tier-pill__icon">{{ ['ambassador'=>'⭐','elite'=>'⭐⭐','club'=>'👑'][$key] }}</span>
            <span class="aff-tier-pill__label">{{ $tier['label'] }}</span>
            <span class="aff-tier-pill__rate">{{ number_format($tier['rate'], 0) }}%</span>
            <span class="aff-tier-pill__dur">{{ $tier['duration_months'] }} mois · dès {{ $tier['min_conversions'] }} conv.</span>
          </div>
        @endforeach
      </div>
    </div>

    {{-- ── Progression vers le palier suivant ─────────────── --}}
    @if($stats['next_tier'])
      @php
        $barClass = $stats['next_tier'] === 'club' ? 'aff-progress-bar--club' : 'aff-progress-bar--elite';
        $pillClass = $stats['next_tier'] === 'club' ? 'aff-next-tier-pill--club' : '';
        $needed    = $stats['next_tier_min'] - $affiliate->active_conversions;
        $needed    = max(0, $needed);
      @endphp
      <div class="aff-progress-card">
        <div>
          <div class="aff-progress-card__label">
            Progression vers <strong>{{ $stats['next_tier_label'] }}</strong>
          </div>
          <div class="aff-progress-bar-wrap">
            <div class="aff-progress-bar {{ $barClass }}" style="width: {{ $stats['next_tier_progress'] }}%"></div>
          </div>
          <div class="aff-progress-card__meta">
            {{ $affiliate->active_conversions }} / {{ $stats['next_tier_min'] }} conversion{{ $stats['next_tier_min'] > 1 ? 's' : '' }} validées
            @if($needed > 0)
              — encore <strong>{{ $needed }}</strong> pour débloquer ce palier
            @else
              — palier débloqué ! 🎉
            @endif
          </div>
        </div>
        <div class="aff-next-tier-pill {{ $pillClass }}">
          <span>{{ ['elite'=>'⭐⭐','club'=>'👑'][$stats['next_tier']] ?? '' }}</span>
          <div>
            <div style="font-size:12px;font-weight:600;opacity:.7">{{ $stats['next_tier_label'] }}</div>
            <div class="aff-next-tier-pill__rate">{{ number_format(\App\Models\Affiliate::TIERS[$stats['next_tier']]['rate'], 0) }}%</div>
          </div>
        </div>
      </div>
    @endif

    {{-- ── Historique des conversions ──────────────────────── --}}
    <div class="aff-conv-card">
      <div class="aff-conv-card__header">
        <div style="padding: var(--aff-space-md) 0 0 0;">
          <div class="aff-section-title">Historique des commissions</div>
          <p class="aff-section-subtitle">Toutes vos conversions et leur statut en temps réel.</p>
        </div>
      </div>

      {{-- Tabs --}}
      <div class="aff-tabs">
        <a href="{{ route('affiliate.dashboard', ['status' => 'all']) }}"
           class="aff-tab {{ $status === 'all' ? 'active' : '' }}">
          Toutes
          <span class="aff-tab__badge">{{ $totalAll }}</span>
        </a>
        <a href="{{ route('affiliate.dashboard', ['status' => 'pending']) }}"
           class="aff-tab {{ $status === 'pending' ? 'active' : '' }}">
          En attente
          <span class="aff-tab__badge">{{ $stats['pending_count'] }}</span>
        </a>
        <a href="{{ route('affiliate.dashboard', ['status' => 'validated']) }}"
           class="aff-tab {{ $status === 'validated' ? 'active' : '' }}">
          Validées
          <span class="aff-tab__badge">{{ $stats['validated_count'] }}</span>
        </a>
        <a href="{{ route('affiliate.dashboard', ['status' => 'paid']) }}"
           class="aff-tab {{ $status === 'paid' ? 'active' : '' }}">
          Payées
          <span class="aff-tab__badge">{{ $stats['paid_count'] }}</span>
        </a>
      </div>

      {{-- Table --}}
      <div class="aff-table-wrap">
        @if($conversions->count() > 0)
          <table class="aff-table">
            <thead>
              <tr>
                <th>Filleul</th>
                <th>Source</th>
                <th>Montant transaction</th>
                <th>Commission</th>
                <th>Statut</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($conversions as $conversion)
                <tr>
                  <td>
                    @if($conversion->referredUser)
                      @if($conversion->referredUser->first_name)
                        {{ $conversion->referredUser->first_name }}
                        {{ substr($conversion->referredUser->last_name ?? '', 0, 1) }}.
                      @else
                        {{ substr($conversion->referredUser->email ?? $conversion->referredUser->email_address ?? '?', 0, 2) }}***
                      @endif
                    @else
                      <span style="color:var(--aff-gray-400)">—</span>
                    @endif
                  </td>
                  <td>
                    <span class="aff-source-tag">
                      {{ \App\Models\AffiliateConversion::SOURCE_LABELS[$conversion->source_type] ?? ucfirst($conversion->source_type) }}
                    </span>
                  </td>
                  <td class="aff-amount">
                    {{ number_format($conversion->transaction_amount, 2, ',', ' ') }}&nbsp;€
                  </td>
                  <td class="aff-amount {{ $conversion->status === 'pending' ? 'aff-amount--pending' : '' }}">
                    +{{ number_format($conversion->commission_amount, 2, ',', ' ') }}&nbsp;€
                    <span style="font-size:11px;color:var(--aff-gray-500);font-weight:400">
                      ({{ number_format($conversion->commission_rate, 0) }}%)
                    </span>
                  </td>
                  <td>
                    <span class="aff-status aff-status--{{ $conversion->status }}">
                      {{ $conversion->status_label }}
                    </span>
                  </td>
                  <td style="color:var(--aff-gray-500);font-size:13px">
                    {{ $conversion->created_at->format('d/m/Y') }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          @if($conversions->hasMorePages())
            <div class="aff-pagination">
              <a href="{{ $conversions->nextPageUrl() }}" class="aff-btn-secondary">
                Voir plus
              </a>
            </div>
          @endif

        @else
          <div class="aff-empty">
            <div class="aff-empty__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="64" height="64">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 8v4"/>
                <path d="M12 16h.01"/>
              </svg>
            </div>
            <h3 class="aff-empty__title">Aucune commission pour le moment</h3>
            <p class="aff-empty__text">
              Partagez votre lien de parrainage — vos commissions apparaîtront ici dès qu'un filleul réalise une transaction.
            </p>
          </div>
        @endif
      </div>
    </div>

    {{-- ── Coordonnées bancaires ────────────────────────────── --}}
    <div class="aff-bank-card">
      <div class="aff-bank-card__header">
        <div class="aff-bank-card__icon">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="6" width="20" height="12" rx="2"/>
            <path d="M2 10h20"/>
          </svg>
        </div>
        <div>
          <div class="aff-section-title" style="margin-bottom:0">Coordonnées bancaires</div>
          <p style="font-size:14px;color:var(--aff-gray-500);margin:4px 0 0">
            Renseignez votre IBAN pour recevoir vos virements de commission.
          </p>
        </div>
      </div>

      <div class="aff-bank-card__body">

        {{-- Si IBAN déjà enregistré --}}
        @if($affiliate->iban)
          <div class="aff-bank-already">
            <svg class="aff-bank-already__icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span>IBAN enregistré : <strong>{{ substr($affiliate->iban, 0, 4) }}•••• •••• ••••{{ substr($affiliate->iban, -4) }}</strong></span>
          </div>
        @endif

        <form
          action="{{ route('affiliate.api.bank-info') }}"
          method="POST"
          x-data="{ loading: false }"
          @submit.prevent="
            loading = true;
            fetch($el.action, {
              method: 'POST',
              headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json' },
              body: new FormData($el)
            })
            .then(r => r.json())
            .then(data => {
              loading = false;
              if (data.success) window.location.reload();
              else alert(data.message || 'Erreur lors de la sauvegarde.');
            })
            .catch(() => { loading = false; alert('Erreur réseau.'); })
          "
        >
          @csrf
          <div class="aff-form-grid">
            <div class="aff-form-group aff-form-grid--full">
              <label class="aff-form-label" for="iban">IBAN *</label>
              <input
                id="iban"
                name="iban"
                type="text"
                class="aff-form-input"
                placeholder="FR76 XXXX XXXX XXXX XXXX XXXX XXX"
                value="{{ old('iban', $affiliate->iban ?? '') }}"
                maxlength="34"
                autocomplete="off"
                spellcheck="false"
              >
              <span class="aff-form-hint">Format international IBAN sans espaces (ex: FR7630004028370000057020010)</span>
            </div>
            <div class="aff-form-group">
              <label class="aff-form-label" for="bic">BIC / SWIFT</label>
              <input
                id="bic"
                name="bic"
                type="text"
                class="aff-form-input"
                placeholder="BNPAFRPP"
                value="{{ old('bic', $affiliate->bic ?? '') }}"
                maxlength="11"
                autocomplete="off"
              >
            </div>
            <div class="aff-form-group">
              <label class="aff-form-label" for="bank_name">Nom de la banque</label>
              <input
                id="bank_name"
                name="bank_name"
                type="text"
                class="aff-form-input"
                placeholder="BNP Paribas, Crédit Agricole..."
                value="{{ old('bank_name', $affiliate->bank_name ?? '') }}"
              >
            </div>
            <div class="aff-form-group aff-form-grid--full">
              <label class="aff-form-label" for="account_holder">Titulaire du compte *</label>
              <input
                id="account_holder"
                name="account_holder"
                type="text"
                class="aff-form-input"
                placeholder="Prénom NOM (exactement comme sur votre RIB)"
                value="{{ old('account_holder', $affiliate->account_holder ?? '') }}"
              >
            </div>
          </div>

          <div style="margin-top: var(--aff-space-md)">
            <button type="submit" class="aff-btn-primary" :disabled="loading">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
              </svg>
              <span x-text="loading ? 'Enregistrement...' : 'Enregistrer mes coordonnées'">Enregistrer mes coordonnées</span>
            </button>
          </div>

        </form>
      </div>
    </div>

  </div>{{-- /aff-content-sections --}}
</div>{{-- /aff-page-container --}}
@endsection

@section('script')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
