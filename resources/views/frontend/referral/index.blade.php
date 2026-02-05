@extends('frontend.layout')

@section('pageHeading', __('Parrainage'))

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/front/css/referral-premium.css') }}?v={{ time() }}">
@endsection

@section('content')
  <div class="referral-page-container">
    {{-- Hero Split Section --}}
    @include('components.referral.hero-split', [
      'config' => $config,
      'referralCode' => $referralCode,
      'openInvite' => $openInvite ?? false
    ])

    {{-- Vos parrainages Section --}}
    @include('components.referral.referrals-card-tabs', [
      'stats' => $stats,
      'referrals' => $referrals,
      'status' => $status
    ])

    {{-- Comment ça marche Section --}}
    @include('components.referral.how-it-works', ['config' => $config])

    {{-- Pourquoi Junspro est premium Section --}}
    @include('components.referral.premium-why-junspro')

    {{-- FAQ Section --}}
    @include('components.referral.faq-accordion', ['config' => $config])

    {{-- Bandeau Entreprise --}}
    @include('components.referral.company-banner')

    {{-- Sticky CTA --}}
    @include('components.referral.sticky-invite-bar', [
      'referralCode' => $referralCode
    ])
  </div>

  {{-- Modales --}}
  @include('components.referral.invite-modal', [
    'referralCode' => $referralCode,
    'config' => $config
  ])
  @include('components.referral.company-recommend-modal')
@endsection

@section('script')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="{{ asset('assets/js/referral/inviteModal.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/referral/companyRecommendModal.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/referral/stickyBar.js') }}?v={{ time() }}"></script>
  
  @if($openInvite ?? false)
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          window.dispatchEvent(new CustomEvent('openInviteModal'));
        }, 300);
      });
    </script>
  @endif
@endsection

