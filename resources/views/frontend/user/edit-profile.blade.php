@extends('frontend.layout')

@php $title = __('Edit Profile'); @endphp

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

  <!-- Start User Edit-Profile Section -->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="account-info">
                  <div class="title">
                    <h4>{{ __('Edit Your Profile') }}</h4>
                  </div>

                  <div class="edit-info-area">
                    <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="upload-img">
                        <div class="img-box">
                          <img class="user-photo lazyload" data-src="{{ is_null($authUser->image) ? asset('assets/img/profile.jpg') : asset('assets/img/users/' . $authUser->image) }}" alt="user image">
                        </div>

                        <div class="file-upload-area">
                          <div class="upload-file">
                            <input type="file" name="image" class="upload">
                            <span>{{ __('Upload') }}</span>
                          </div>
                        </div>
                      </div>
                      @error('image')
                        <p class="mb-3 text-danger">{{ $message }}</p>
                      @enderror
                      <p class="text-warning mb-3">{{ __('Image Size : 80x80') }}
                      </p>


                      <div class="row">
                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('First Name') }}"
                            name="first_name" value="{{ $authUser->first_name }}">
                          @error('first_name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('Last Name') }}" name="last_name"
                            value="{{ $authUser->last_name }}">
                          @error('last_name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>
                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('Username') }}" name="username"
                            value="{{ empty($authUser->username) ? $authUser->provider_id : $authUser->username }}">
                          @error('username')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="email" class="form-control" placeholder="{{ __('Email Address') }}"
                            value="{{ $authUser->email_address }}" readonly>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('Phone Number') }}"
                            name="phone_number" value="{{ $authUser->phone_number }}">
                          @error('phone_number')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('City') }}" name="city"
                            value="{{ $authUser->city }}">
                          @error('city')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('State') }}" name="state"
                            value="{{ $authUser->state }}">
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="{{ __('Country') }}" name="country"
                            value="{{ $authUser->country }}">
                          @error('country')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        <div class="col-lg-12 mb-4">
                          <textarea class="form-control" placeholder="{{ __('Address') }}" rows="2" name="address">{{ $authUser->address }}</textarea>
                          @error('address')
                            <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                        @php
                          $freelancerProfile = $authUser->freelancerProfile ?? null;
                        @endphp

                        @if($freelancerProfile)
                          <!-- Section Freelance Profile -->
                          <div class="col-lg-12 mb-4">
                            <hr style="margin: 30px 0; border-color: #E5E7EB;">
                            <h5 style="font-weight: 600; margin-bottom: 20px; color: #111827;">
                              <i class="fas fa-user-tie me-2" style="color: #4F46E5;"></i>
                              {{ __('Profil Freelance') }}
                            </h5>
                          </div>

                          <div class="col-lg-12 mb-4">
                            <label class="form-label">{{ __('Bio') }}</label>
                            <textarea class="form-control" placeholder="{{ __('Décrivez votre expertise et votre expérience...') }}" rows="4" name="freelancer_bio">{{ $freelancerProfile->bio }}</textarea>
                            @error('freelancer_bio')
                              <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                          </div>

                          <div class="col-lg-6 mb-4">
                            <label class="form-label">{{ __('Tarif horaire (€)') }}</label>
                            <input type="number" class="form-control" placeholder="50" name="freelancer_hourly_rate" 
                                   value="{{ $freelancerProfile->hourly_rate }}" 
                                   min="3" max="200" step="0.01">
                            @error('freelancer_hourly_rate')
                              <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                            <small class="text-muted">{{ __('Entre 3€ et 200€') }}</small>
                          </div>

                          <!-- Section Vidéo de présentation -->
                          <div class="col-lg-12 mb-4">
                            <hr style="margin: 20px 0; border-color: #E5E7EB;">
                            <h6 style="font-weight: 600; margin-bottom: 16px; color: #111827;">
                              <i class="fas fa-video me-2" style="color: #4F46E5;"></i>
                              {{ __('Vidéo de présentation') }}
                            </h6>
                            
                            @php
                              $hasVideo = !empty($freelancerProfile->video_thumbnail_url);
                            @endphp

                            @if($hasVideo)
                              <div class="mb-3">
                                <label class="form-label">{{ __('Miniature actuelle') }}</label>
                                <div class="thumb-preview" style="max-width: 400px;">
                                  <img src="{{ $freelancerProfile->video_thumbnail_url }}" 
                                       alt="Miniature vidéo" 
                                       class="uploaded-img" 
                                       id="video-thumbnail-preview"
                                       style="max-width: 100%; border-radius: 8px; aspect-ratio: 16/9; object-fit: cover;">
                                </div>
                              </div>
                            @endif

                            <!-- Upload d'image -->
                            <div class="mb-3">
                              <label class="form-label">{{ __('Uploader une miniature vidéo') }}</label>
                              <div class="file-upload-area">
                                <div class="upload-file">
                                  <input type="file" name="video_thumbnail_image" id="video_thumbnail_image" 
                                         class="upload" accept="image/jpeg,image/png,image/webp"
                                         onchange="previewVideoThumbnail(this)">
                                  <span>{{ __('Choisir une image') }}</span>
                                </div>
                              </div>
                              @error('video_thumbnail_image')
                                <p class="text-danger mt-1">{{ $message }}</p>
                              @enderror
                              <small class="text-muted d-block mt-1">
                                {{ __('Format 16:9 recommandé (ex: 1280×720px). Formats acceptés: JPG, PNG, WEBP.') }}
                              </small>
                            </div>

                            <!-- OU URL -->
                            <div class="mb-3">
                              <label class="form-label">{{ __('OU URL de la miniature vidéo') }}</label>
                              <input type="url" class="form-control" 
                                     placeholder="https://example.com/video-thumbnail.jpg" 
                                     name="video_thumbnail_url" 
                                     id="video_thumbnail_url"
                                     value="{{ $freelancerProfile->video_thumbnail_url }}">
                              @error('video_thumbnail_url')
                                <p class="text-danger mt-1">{{ $message }}</p>
                              @enderror
                              <small class="text-muted d-block mt-1">
                                {{ __('Si vous avez déjà hébergé votre image ailleurs, entrez son URL ici.') }}
                              </small>
                            </div>

                            @if(!$hasVideo && !empty($freelancerProfile->bio))
                              <div class="alert alert-warning" style="background: #FEF3C7; border-color: #FCD34D; color: #92400E; padding: 12px; border-radius: 8px; font-size: 13px;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ __('Pour un rendu plus professionnel, ajoutez une miniature à votre vidéo (format 16:9).') }}
                              </div>
                            @endif
                          </div>

                          <script>
                            function previewVideoThumbnail(input) {
                              if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                  let preview = document.getElementById('video-thumbnail-preview');
                                  if (!preview) {
                                    // Créer le preview si il n'existe pas
                                    const previewContainer = document.createElement('div');
                                    previewContainer.className = 'mb-3';
                                    previewContainer.innerHTML = `
                                      <label class="form-label">{{ __('Aperçu') }}</label>
                                      <div class="thumb-preview" style="max-width: 400px;">
                                        <img src="${e.target.result}" 
                                             alt="Aperçu miniature" 
                                             class="uploaded-img" 
                                             id="video-thumbnail-preview"
                                             style="max-width: 100%; border-radius: 8px; aspect-ratio: 16/9; object-fit: cover;">
                                      </div>
                                    `;
                                    input.closest('.mb-3').after(previewContainer);
                                  } else {
                                    preview.src = e.target.result;
                                  }
                                  // Vider le champ URL si on upload une image
                                  document.getElementById('video_thumbnail_url').value = '';
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                          </script>
                        @endif

                        <div class="col-lg-12">
                          <div class="form-button">
                            <button class="btn btn-md btn-primary radius-sm form-btn">{{ __('Submit') }}</button>
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
      </div>
    </div>
  </section>
  <!-- End User Edit-Profile Section -->
@endsection
