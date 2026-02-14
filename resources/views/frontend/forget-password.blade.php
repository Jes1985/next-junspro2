@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->forget_password_page_title }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_customer_forget_password }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_customer_forget_password }}
  @endif
@endsection

@php
  $title = $pageHeading->forget_password_page_title ?? __('No Page Title Found');
@endphp

@section('style')
{{-- Styles scopés .page-forget-password uniquement — aucune fuite sur les autres pages --}}
<style>
  /* ========== Variables Junspro (scopées) ========== */
  .page-forget-password {
    --jf-primary: #7c3aed;
    --jf-primary-light: #8b5cf6;
    --jf-primary-dark: #6d28d9;
    --jf-blue: #2563eb;
    --jf-primary-rgb: 124, 58, 237;
    --jf-shadow: 0 8px 32px rgba(124, 58, 237, 0.12);
    --jf-shadow-hover: 0 12px 40px rgba(124, 58, 237, 0.18);
    --jf-ring: 0 0 0 3px rgba(124, 58, 237, 0.2);
  }

  /* ========== Hero premium (remplace le bandeau image) ========== */
  .page-forget-password__hero {
    position: relative;
    padding: 4rem 1.5rem 5rem;
    background: linear-gradient(165deg, #a78bfa 0%, #8b5cf6 28%, #7c3aed 50%, #6d28d9 72%, #4f46e5 100%);
    overflow: hidden;
  }
  .page-forget-password__hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    opacity: 0.04;
    pointer-events: none;
  }
  .page-forget-password__hero-inner {
    position: relative;
    z-index: 1;
    max-width: 640px;
    margin: 0 auto;
    text-align: center;
  }
  .page-forget-password__title {
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    font-weight: 700;
    color: #fff;
    margin: 0 0 0.75rem;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    letter-spacing: -0.02em;
  }
  .page-forget-password__hero-inner::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: min(400px, 80vw);
    height: 200px;
    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.14) 0%, transparent 70%);
    pointer-events: none;
  }
  .page-forget-password__breadcrumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.9);
  }
  .page-forget-password__breadcrumb a {
    color: rgba(255, 255, 255, 0.95);
    text-decoration: none;
  }
  .page-forget-password__breadcrumb a:hover {
    text-decoration: underline;
  }
  .page-forget-password__breadcrumb .sep {
    opacity: 0.7;
  }

  /* ========== Section formulaire ========== */
  .page-forget-password__form-section {
    padding: 2.5rem 1.5rem 4rem;
  }
  .page-forget-password__card {
    max-width: 440px;
    margin: -2rem auto 0;
    padding: 2.25rem 2rem;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(196, 181, 253, 0.25);
    border-radius: 20px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
    animation: jf-card-enter 0.5s ease-out 1 forwards;
  }
  .page-forget-password__card:hover {
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.7) inset;
  }
  @keyframes jf-card-enter {
    from {
      opacity: 0;
      transform: translateY(8px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  @media (prefers-reduced-motion: reduce) {
    .page-forget-password__card {
      animation: none;
    }
  }
  .page-forget-password__help {
    font-size: 0.9375rem;
    color: #64748b;
    line-height: 1.55;
    margin: 0 0 1.5rem;
  }
  .page-forget-password__card .form-group {
    margin-bottom: 1.5rem;
  }
  .page-forget-password__card .form-group:last-of-type {
    margin-bottom: 1.25rem;
  }
  .page-forget-password__card label {
    display: block;
    font-size: 0.9375rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
  }
  .page-forget-password__card .form-control {
    width: 100%;
    height: 52px;
    padding: 0 1.25rem;
    font-size: 1rem;
    color: #1e293b;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }
  .page-forget-password__card .form-control::placeholder {
    color: #94a3b8;
  }
  .page-forget-password__card .form-control:focus {
    outline: none;
    border-color: var(--jf-primary);
    box-shadow: var(--jf-ring);
  }
  .page-forget-password__card .form-control:focus-visible {
    outline: none;
    box-shadow: var(--jf-ring);
  }
  .page-forget-password__card .form-control.has-error {
    border-color: #dc2626;
  }
  .page-forget-password__card .text-danger {
    font-size: 0.875rem;
    color: #dc2626;
    margin-top: 0.5rem;
  }
  .page-forget-password__card .main-btn {
    width: 100%;
    height: 52px;
    padding: 0 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #2563eb 100%);
    border: none;
    border-radius: 14px;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);
  }
  .page-forget-password__card .main-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
  }
  .page-forget-password__card .main-btn:focus-visible {
    outline: 2px solid var(--jf-primary);
    outline-offset: 2px;
  }
  .page-forget-password__links {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1.75rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f1f5f9;
  }
  .page-forget-password__links a {
    font-size: 0.9375rem;
    color: var(--jf-primary);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .page-forget-password__links a:hover {
    color: var(--jf-primary-dark);
    text-decoration: underline;
  }
  .page-forget-password__links a:focus-visible {
    outline: 2px solid var(--jf-primary);
    outline-offset: 2px;
    border-radius: 4px;
  }

  /* ========== Responsive ========== */
  @media (max-width: 640px) {
    .page-forget-password__hero {
      padding: 3rem 1rem 4rem;
    }
    .page-forget-password__form-section {
      padding: 2rem 1rem 3rem;
    }
    .page-forget-password__card {
      margin: -1.5rem 0 0;
      padding: 1.75rem 1.25rem;
      border-radius: 18px;
    }
    .page-forget-password__card .main-btn {
      width: 100%;
    }
  }
</style>
@endsection

@section('content')
<div class="page-forget-password">
  {{-- Hero premium (remplace le bandeau image template) --}}
  <section class="page-forget-password__hero" aria-labelledby="forget-title">
    <div class="page-forget-password__hero-inner">
      <h1 id="forget-title" class="page-forget-password__title">{{ $title }}</h1>
      <nav class="page-forget-password__breadcrumb" aria-label="{{ __('Breadcrumb') }}">
        <a href="{{ route('index') }}">{{ __('Home') }}</a>
        <span class="sep" aria-hidden="true">›</span>
        <span>{{ $title }}</span>
      </nav>
    </div>
  </section>

  {{-- Carte formulaire premium --}}
  <section class="page-forget-password__form-section">
    <div class="page-forget-password__card">
      <p class="page-forget-password__help">
        Entrez votre email, nous vous envoyons un lien de réinitialisation.
      </p>
      <form action="{{ route('user.send_forget_password_mail') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="forget-email">{{ __('Email Address') }} *</label>
          <input
            type="email"
            id="forget-email"
            class="form-control {{ $errors->has('email_address') ? 'has-error' : '' }}"
            name="email_address"
            value="{{ old('email_address') }}"
            placeholder="ex: vous@exemple.com"
            autocomplete="email"
            aria-invalid="{{ $errors->has('email_address') ? 'true' : 'false' }}"
            aria-describedby="{{ $errors->has('email_address') ? 'forget-email-error' : '' }}"
          >
          @error('email_address')
            <p id="forget-email-error" class="text-danger" role="alert">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <button type="submit" class="main-btn">{{ __('Proceed') }}</button>
        </div>
      </form>
      <div class="page-forget-password__links">
        <a href="{{ route('user.login') }}">Retour à la connexion</a>
        <a href="{{ route('user.signup') }}">Créer un compte</a>
        <a href="{{ route('contact') }}">Besoin d'aide ? Nous contacter</a>
      </div>
    </div>
  </section>
</div>
@endsection
