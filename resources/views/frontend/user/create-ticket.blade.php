@extends('frontend.layout')

@php $title = __('Create Ticket'); @endphp

@section('pageHeading')
  {{ $title }}
@endsection

@section('style')
<style>
  .page-hero-banner { background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%); border-radius: 40px; padding: 3rem 4rem; margin-bottom: 2rem; color: white; position: relative; overflow: hidden; box-shadow: 0 32px 80px rgba(124,58,237,0.3), inset 0 1px 1px rgba(255,255,255,0.2); display: flex; justify-content: space-between; align-items: center; gap: 2rem; }
  .page-hero-banner::before { content: ''; position: absolute; top: -40%; left: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
  .page-hero-banner::after { content: ''; position: absolute; bottom: -20%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
  .page-hero-title { font-size: 2.5rem; font-weight: 900; margin-bottom: 0.5rem; color: white; line-height: 1.1; letter-spacing: -0.03em; position: relative; z-index: 2; }
  .page-hero-subtitle { font-size: 1.1rem; opacity: 0.9; margin-bottom: 0; font-weight: 300; color: white; position: relative; z-index: 2; }
  .hero-text-content { flex: 1; position: relative; z-index: 2; }
  .hero-search-btn { background: white; color: #7c3aed; border-radius: 50px; padding: 0.85rem 1.8rem; font-weight: 600; font-size: 0.95rem; text-decoration: none !important; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; position: relative; z-index: 2; flex-shrink: 0; transition: background 0.2s, color 0.2s; }
  .hero-search-btn:hover { background: #f5f3ff; color: #6d28d9; text-decoration: none !important; }
</style>
@endsection

@section('content')
@php $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous'; @endphp
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 0;">
  @include('frontend.client.partials.dashboard-nav')
  <div class="page-hero-banner">
    <div class="hero-text-content">
      <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
      <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
    </div>
    <a href="/services" class="hero-search-btn"><i class="fas fa-search"></i> Trouver un freelance</a>
  </div>
</div>

  <!--====== Start Support Tickets Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-40">
            <div class="account-info">
              <div class="title">
                <h4>{{ __('Create New Ticket') }}</h4>

                <a href="{{ route('user.support_tickets') }}" class="btn btn-md btn-primary radius-sm icon-start">
                  <i
                    class="{{ $currentLanguageInfo->direction == 0 ? 'fas fa-chevron-left' : 'fas fa-chevron-right' }}"></i> {{ __('Back') }}
                </a>
              </div>

              <div class="edit-info-area support-ticket-area">
                <form action="{{ route('user.support_tickets.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <input type="text" class="form-control" placeholder="{{ __('Enter Subject') }}"
                        name="subject" value="{{ old('subject') ?? '' }}">
                      @error('subject')
                        <p class="text-danger mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-lg-12 mb-4">
                      <textarea class="form-control summernote" placeholder="{{ __('Enter Message') }}" name="message" data-height="220">{{ old('message') ?? '' }}</textarea>
                      @error('message')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-lg-12 mb-3">
                      <div class="form-group mb-1">
                        <label for="formFile" class="form-label">{{ __('Choose File') }}</label>
                        <input type="file" class="form-control size-md w-100" id="formFile" name="attachment"
                          data-url="{{ route('user.support_tickets.store_temp_file') }}">
                      </div>
                      <div class="progress mt-3 mb-1 d-none">
                        <div class="progress-bar mdf_w34322" role="progressbar"></div>
                      </div>
                      <small id="attachment-info">{{ '*' . __('Upload only .zip file') . '. ' . __('Max file size is 20 MB') . '.' }}</small>
                      @error('attachment')
                        <p class="text-danger mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="col-lg-12">
                      <div class="form-button">
                        <button class="btn btn-md btn-primary radius-sm">{{ __('Submit') }}</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Support Tickets Section ======-->
@endsection
