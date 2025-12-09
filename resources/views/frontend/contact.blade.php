@extends('frontend.layout')

@section('pageHeading')
    @if (!empty($pageHeading))
        {{ $pageHeading->contact_page_title }}
    @endif
@endsection

@section('metaKeywords')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_keyword_contact }}
    @endif
@endsection

@section('metaDescription')
    @if (!empty($seoInfo))
        {{ $seoInfo->meta_description_contact }}
    @endif
@endsection

@section('style')
  <style>
    /* En-tête avec dégradé - Même style que la page d'accueil - Spécificité maximale */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      position: relative;
      z-index: 1000 !important;
    }

    /* Main navbar avec dégradé */
    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
    }

    /* Assurer la visibilité des liens de navigation sur fond sombre - Spécificité maximale */
    body .header-area .nav-link,
    html body .header-area .nav-link,
    body .header-area .main-navbar .nav-link,
    html body .header-area .main-navbar .nav-link,
    body .header-area .navbar-nav .nav-link,
    html body .header-area .navbar-nav .nav-link,
    body .header-area .navbar-nav .nav-item .nav-link,
    html body .header-area .navbar-nav .nav-item .nav-link,
    body .header-area .main-navbar .navbar-nav .nav-link,
    html body .header-area .main-navbar .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.95) !important;
    }

    body .header-area .nav-link:hover,
    body .header-area .nav-link.active,
    html body .header-area .nav-link:hover,
    html body .header-area .nav-link.active,
    body .header-area .navbar-nav .nav-link:hover,
    body .header-area .navbar-nav .nav-link.active,
    html body .header-area .navbar-nav .nav-link:hover,
    html body .header-area .navbar-nav .nav-link.active {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    /* Forcer la couleur blanche pour tous les textes de navigation */
    body .header-area .navbar-nav a,
    html body .header-area .navbar-nav a,
    body .header-area .main-navbar a.nav-link,
    html body .header-area .main-navbar a.nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
    }

    /* Logo blanc sur fond sombre - Spécificité maximale */
    body .header-area .junspro-logo,
    html body .header-area .junspro-logo,
    body .header-area .junspro-logo-text,
    html body .header-area .junspro-logo-text {
      background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 50%, #c7d2fe 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      color: #ffffff !important; /* Fallback */
    }

    /* Icônes et boutons blancs sur fond sombre */
    body .header-area .more-option .item button,
    html body .header-area .more-option .item button,
    body .header-area .more-option .item .btn-search,
    html body .header-area .more-option .item .btn-search,
    body .header-area .more-option .item .btn-outline,
    html body .header-area .more-option .item .btn-outline,
    body .header-area button,
    html body .header-area button {
      color: rgba(255, 255, 255, 0.9) !important;
    }

    body .header-area .more-option .item button:hover,
    html body .header-area .more-option .item button:hover,
    body .header-area .more-option .item .btn-search:hover,
    html body .header-area .more-option .item .btn-search:hover {
      color: #ffffff !important;
    }

    /* Menu toggle button blanc */
    body .header-area .menu-toggler span,
    html body .header-area .menu-toggler span {
      background-color: rgba(255, 255, 255, 0.9) !important;
    }

    /* Force l'application du dégradé avec JavaScript si nécessaire */
    @media screen {
      body .header-area,
      html body .header-area {
        background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
        background-color: transparent !important;
      }
    }

    /* Hero Contact Premium - Même style que les autres pages */
    .contact-hero-premium {
      background: linear-gradient(135deg, #020617 0%, #111827 30%, #1d2a6d 70%, #5b21b6 100%);
      position: relative;
      overflow: hidden;
      padding: 120px 0 90px;
      margin-top: 0;
      min-height: 60vh;
      display: flex;
      align-items: center;
      z-index: 1;
    }

    body .contact-hero-premium {
      margin-top: 0 !important;
      padding-top: 120px !important;
    }

    /* Textures abstraites */
    .contact-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.12) 0%, transparent 50%),
        linear-gradient(135deg, rgba(65, 105, 225, 0.08) 0%, transparent 50%);
      z-index: 1;
      pointer-events: none;
    }

    /* Gradient transparent pour lisibilité du texte */
    .contact-hero-premium::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 55%;
      height: 100%;
      background: linear-gradient(to right, rgba(2, 6, 23, 0.4) 0%, transparent 100%);
      z-index: 1;
    }

    .contact-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .contact-hero-content {
      text-align: center;
      color: white;
    }

    .contact-hero-title {
      font-size: 3.8rem;
      font-weight: 400;
      color: #FFFFFF;
      line-height: 1.2;
      margin-bottom: 2rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      display: block;
      letter-spacing: -0.02em;
      max-width: 100%;
      width: 100%;
    }

    .contact-hero-title .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      margin-bottom: 0.75rem;
      white-space: nowrap;
    }

    .contact-hero-title .hero-title-line-1 .highlight {
      font-weight: 600;
      background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 50%, #C084FC 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: #60A5FA;
      display: inline-block;
    }

    .contact-hero-title .hero-title-line-2 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      white-space: nowrap;
    }

    .contact-hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 2.5rem;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      font-weight: 400;
      line-height: 1.6;
      max-width: 90%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    /* Ajustement de l'espacement de la section contact */
    .contact-informatoin {
      padding-top: 60px !important;
    }

    /* Responsive */
    @media (max-width: 1199px) {
      .contact-hero-premium {
        padding: 130px 0 90px !important;
      }

      .contact-hero-title {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 991px) {
      .contact-hero-premium {
        padding: 80px 0 60px !important;
      }

      .contact-hero-title {
        font-size: 2.25rem;
      }
    }

    @media (max-width: 768px) {
      .contact-hero-premium {
        padding: 100px 0 70px !important;
        min-height: auto;
      }

      .contact-hero-title {
        font-size: 2rem;
      }

      .contact-hero-subtitle {
        font-size: 1rem;
      }
    }

    @media (max-width: 575px) {
      .contact-hero-premium {
        padding: 80px 0 60px !important;
      }

      .contact-hero-title {
        font-size: 2rem;
        line-height: 1.2;
      }

      .contact-hero-subtitle {
        font-size: 1rem;
      }
    }
  </style>
@endsection

@php
    $title = $pageHeading->contact_page_title ?? __('No Page Title Found');
@endphp
@section('content')
  <!-- Hero Contact Premium -->
  <section class="contact-hero-premium">
    <div class="contact-hero-container">
      <div class="contact-hero-content">
        <h1 class="contact-hero-title">
          <span class="hero-title-line-1">{{ __('Restons en') }} <span class="highlight">{{ __('contact') }}</span></span>
          <span class="hero-title-line-2">{{ __('pour vos projets') }}</span>
        </h1>
        <p class="contact-hero-subtitle">
          {{ __('Une question ? Un projet ? Notre équipe est là pour vous accompagner.') }}
        </p>
      </div>
    </div>
  </section>

    <!--====== Start Contact Information Section ======-->
    <div class="contact-informatoin pt-100 pb-60">
        <div class="container">
          <div class="row gx-xl-5 justify-content-between">
            <div class="col-lg-7">
              <div class="contact-wrapper mb-40">
                  <div class="section-title mb-30">
                      <h2 class="title">{{ __('Get In Touch') }}</h2>
                  </div>

                  <div class="contact-form">
                    <form action="{{ route('contact.send_mail') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-20">
                                    <input name="name" type="text" class="form-control"
                                        placeholder="{{ __('Enter Your Full Name') }}">
                                </div>
                                @error('name')
                                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-20">
                                    <input name="email" type="email" class="form-control"
                                        placeholder="{{ __('Enter Your Email Address') }}">
                                </div>
                                @error('email')
                                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-20">
                                    <input name="subject" type="text" class="form-control"
                                        placeholder="{{ __('Enter Email Subject') }}">
                                </div>
                                @error('subject')
                                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-20">
                                    <textarea name="message" class="form-control" placeholder="{{ __('Write Your Message') }}"></textarea>
                                </div>
                                @error('message')
                                    <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($info->google_recaptcha_status == 1)
                                <div class="col-lg-12">
                                    <div class="form-group mb-20 mb-20">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <p class="mt-2 mb-0 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="col">
                                <button class="btn btn-lg btn-primary radius-sm">{{ __('Send Message') }}</button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="information-wrapper pb-10">
                <div class="section-title mb-20">
                  <h3 class="title">{{ __('Contact Info') }}</h3>
                </div>
                @if (!empty($info->address))
                <div class="information-item mb-30">
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>

                    <div class="info">
                        <p>{{ $info->address }}</p>
                    </div>
                </div>
                @endif

                @if (!empty($info->contact_number))
                <div class="information-item mb-30">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>

                    <div class="info">
                        <p><a href="tel:+{{ $info->contact_number }}">{{ $info->contact_number }}</a></p>
                    </div>
                </div>
                @endif

                @if (!empty($info->email_address))
                <div class="information-item mb-30">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="info">
                        <p><a href="mailto:{{ $info->email_address }}">{{ $info->email_address }}</a></p>
                    </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
    <!--====== End Contact Information Section ======-->

    <!--====== Start Contact Section ======-->
    {{-- <div class="contact-area pb-100">
        <div class="container">
          @if (!empty($info->latitude) && !empty($info->longitude))
              <div class="map-box">
                  <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0"
                      marginwidth="0"
                      src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $info->latitude }},%20{{ $info->longitude }}+({{ $websiteInfo->website_title }})&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
              </div>
          @endif
        </div>
    </div> --}}
    <!--====== End Contact Section ======-->
@endsection

@section('script')
  <script>
    // Forcer l'application du dégradé sur l'en-tête après le chargement
    (function() {
      function applyHeaderGradient() {
        const gradient = 'linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%)';
        
        // Cibler tous les éléments de l'en-tête
        const headerArea = document.querySelector('.header-area');
        const mainNavbar = document.querySelector('.header-area .main-navbar');
        const mainResponsiveNav = document.querySelector('.header-area .main-responsive-nav');
        const navbar = document.querySelector('.header-area .main-navbar .navbar');
        const containerFluid = document.querySelector('.header-area .main-navbar .container-fluid');
        const navbarCollapse = document.querySelector('.header-area .navbar-collapse');
        
        // Appliquer le dégradé à tous les éléments
        [headerArea, mainNavbar, mainResponsiveNav, navbar, containerFluid, navbarCollapse].forEach(function(element) {
          if (element) {
            element.style.setProperty('background', gradient, 'important');
            element.style.setProperty('background-color', 'transparent', 'important');
            element.style.setProperty('background-image', gradient, 'important');
            // Supprimer tout fond blanc
            element.style.removeProperty('background-color');
            element.style.setProperty('background', gradient, 'important');
          }
        });
        
        // Forcer la couleur blanche sur tous les liens de navigation
        const navLinks = document.querySelectorAll('.header-area .nav-link, .header-area .navbar-nav a, .header-area .main-navbar a, .header-area .navbar-nav .nav-item a');
        navLinks.forEach(function(link) {
          if (link) {
            // Forcer le blanc directement
            link.style.setProperty('color', 'rgba(255, 255, 255, 0.95)', 'important');
            link.style.setProperty('-webkit-text-fill-color', 'rgba(255, 255, 255, 0.95)', 'important');
          }
        });
        
        // Forcer aussi sur les éléments actifs
        const activeLinks = document.querySelectorAll('.header-area .nav-link.active, .header-area .navbar-nav .nav-link.active');
        activeLinks.forEach(function(link) {
          if (link) {
            link.style.setProperty('color', '#ffffff', 'important');
            link.style.setProperty('-webkit-text-fill-color', '#ffffff', 'important');
          }
        });
      }
      
      // Appliquer immédiatement
      applyHeaderGradient();
      
      // Réappliquer après le chargement complet
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          applyHeaderGradient();
          setTimeout(applyHeaderGradient, 50);
          setTimeout(applyHeaderGradient, 200);
          setTimeout(applyHeaderGradient, 500);
        });
      } else {
        applyHeaderGradient();
        setTimeout(applyHeaderGradient, 50);
        setTimeout(applyHeaderGradient, 200);
        setTimeout(applyHeaderGradient, 500);
      }
      
      // Observer les changements de style pour réappliquer si nécessaire
      const observer = new MutationObserver(function(mutations) {
        let shouldReapply = false;
        mutations.forEach(function(mutation) {
          if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
            shouldReapply = true;
          }
        });
        if (shouldReapply) {
          setTimeout(applyHeaderGradient, 10);
        }
      });
      
      // Observer les changements sur l'en-tête
      const headerArea = document.querySelector('.header-area');
      if (headerArea) {
        observer.observe(headerArea, {
          attributes: true,
          attributeFilter: ['style', 'class']
        });
      }
      
      // Réappliquer périodiquement pour garantir l'application
      setInterval(applyHeaderGradient, 1000);
    })();
  </script>
@endsection
