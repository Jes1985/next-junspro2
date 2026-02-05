@extends('frontend.layout')

@php $title = __('Edit Profile'); @endphp

@section('pageHeading')
  {{ $title }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])

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
