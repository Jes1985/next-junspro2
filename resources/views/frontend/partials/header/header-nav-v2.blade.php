<!-- Header-area start -->
<header class="header-area header_v1" data-aos="fade-down">
  <!-- Start mobile menu -->
  <div class="mobile-menu">
    <div class="container">
      <div class="mobile-menu-wrapper"></div>
    </div>
  </div>
  <!-- End mobile menu -->
  <div class="main-responsive-nav">
    <div class="container">
      <!-- Mobile Logo -->
        <div class="logo">
        <a href="{{ route('index') }}" class="junspro-logo" target="_self" title="Junspro">
          <span class="junspro-logo-top">
            <span class="junspro-logo-text-wrapper">
              <span class="junspro-logo-text">JUNSPRO</span>
              <span class="junspro-logo-line"></span>
            </span>
            <img src="{{ asset('assets/img/logo.png') }}?v={{ time() }}" class="junspro-logo-icon" alt="Junspro">
          </span>
          </a>
        </div>
      <!-- Menu toggle button -->
      <button class="menu-toggler" type="button">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>

  <div class="main-navbar">
    <div class="container-fluid px-xl-5">
      <nav class="navbar navbar-expand-lg">
        <!-- Logo -->
        <a class="navbar-brand junspro-logo-brand" href="{{ route('index') }}" target="_self" title="Junspro">
          <span class="junspro-logo">
            <span class="junspro-logo-top">
              <span class="junspro-logo-text-wrapper">
                <span class="junspro-logo-text"><span class="junspro-j">J</span>UNSPR<span class="junspro-o">O</span></span>
                <span class="junspro-logo-line"></span>
              </span>
              <span class="brand-icon-wrapper">
                <img src="{{ asset('assets/img/logo.png') }}?v={{ time() }}" class="junspro-logo-icon" alt="Junspro">
              </span>
            </span>
          </span>
        </a>
        <!-- Navigation items -->
        <div class="collapse navbar-collapse">
          <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
            @php $menuDatas = json_decode($menuInfos); @endphp

            @foreach ($menuDatas as $menuData)
              @php 
                // Filtrer les éléments redondants
                if (isset($menuData->type) && ($menuData->type == 'home' || $menuData->type == 'contact')) {
                  continue;
                }
                $href = get_href($menuData); 
              @endphp
              @if (!property_exists($menuData, 'children'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ $href }}">{{ str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $menuData->text) }}</a>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link toggle" href="{{ $href }}">{{ str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $menuData->text) }}<i
                      class="fal fa-plus"></i></a>
                  <ul class="menu-dropdown">
                    @php $childMenuDatas = $menuData->children; @endphp

                    @foreach ($childMenuDatas as $childMenuData)
                      @php 
                        // Filtrer les éléments redondants dans les sous-menus
                        if (isset($childMenuData->type) && ($childMenuData->type == 'home' || $childMenuData->type == 'contact')) {
                          continue;
                        }
                        $child_href = get_href($childMenuData); 
                      @endphp
                      <li class="nav-item">
                        <a class="nav-link" href="{{ $child_href }}">{{ str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $childMenuData->text) }}</a>
                      </li>
                    @endforeach
                  </ul>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
        <div class="more-option mobile-item">
          {{-- Capsule Pause Souffle (discret) --}}
          <div class="item pause-souffle-header-capsule-item">
            @include('frontend.components.pause-souffle.header-capsule-premium')
          </div>
          @if ($basicInfo->is_language == 1)
            <div class="item">
              <div class="lang-switcher-luxury">
                <button class="lang-trigger" type="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-globe lang-globe-icon"></i>
                  <span class="lang-current-code">{{ strtoupper($currentLanguageInfo->code) }}</span>
                  <i class="fas fa-chevron-down lang-chevron-icon"></i>
                </button>
                <div class="lang-panel">
                  @foreach ($allLanguageInfos as $languageInfo)
                    @php $langFlag = $languageInfo->code === 'fr' ? '🇫🇷' : ($languageInfo->code === 'en' ? '🇬🇧' : '🌐'); @endphp
                    @if ($languageInfo->code == $currentLanguageInfo->code)
                      <div class="lang-panel-item lang-panel-item--active">
                        <span class="lang-flag">{{ $langFlag }}</span>
                        <span class="lang-name">{{ $languageInfo->name }}</span>
                        <i class="fas fa-check lang-check-icon"></i>
                      </div>
                    @else
                      <form method="GET" action="{{ route('change_language') }}" style="margin:0;padding:0;">
                        <input type="hidden" name="lang_code" value="{{ $languageInfo->code }}">
                        <button type="submit" class="lang-panel-item">
                          <span class="lang-flag">{{ $langFlag }}</span>
                          <span class="lang-name">{{ $languageInfo->name }}</span>
                        </button>
                      </form>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          @endif
          <div class="item">
            <a href="#searchBox" class="btn-search btn-icon rounded-1" target="_self" aria-label="Search Form"
              title="{{ __('Search Form') }}" data-effect="mfp-zoom-in">
              <i class="far fa-search"></i>
            </a>
            <div id="searchBox" class="search-box mx-auto mfp-with-anim mfp-hide mt-30">
              <form action="{{ route('services') }}" method="GET">
                <div class="input-inline p-1 border radius-sm">
                  <input class="form-control border-0 color-light" placeholder="{{ __('Search Service') . '...' }}"
                    type="text" name="keyword">
                  <button class="btn-icon radius-sm" type="submit" aria-label="button">
                    <i class="far fa-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
          {{-- Menu Freelance (affiché uniquement si connecté en tant que seller) --}}
          @auth('seller')
          <div class="item">
            <div class="dropdown">
                <button class="user-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false" style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);">
                  @if(Auth::guard('seller')->user()->photo)
                    <img src="{{ asset('assets/admin/img/seller-photo/' . Auth::guard('seller')->user()->photo) }}" 
                         alt="Freelance">
                  @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  @endif
              </button>
                <ul class="dropdown-menu dropdown-menu-end user-menu-premium">
                  <li>
                    <a class="dropdown-item" href="{{ route('seller.dashboard') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                      </svg>
                      <span>{{ __('Dashboard') }}</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('seller.logout') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                      </svg>
                      <span>{{ __('Logout') }}</span>
                    </a>
                  </li>
              </ul>
            </div>
          </div>
          @endauth

          {{-- Menu Client --}}
          <div class="item">
            <div class="dropdown">
              <button class="user-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                @auth('web')
                  @if(Auth::guard('web')->user()->image)
                    <img src="{{ asset('assets/img/users/' . Auth::guard('web')->user()->image) }}" 
                         alt="User"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  @endif
                @else
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                @endauth
              </button>
              <ul class="dropdown-menu dropdown-menu-end user-menu-premium">
                @guest('web')
                  <li>
                    <a class="dropdown-item" href="{{ route('user.login') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                      </svg>
                      <span>{{ __('Connexion') }}</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('user.signup') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" y1="8" x2="19" y2="14"></line>
                        <line x1="22" y1="11" x2="16" y2="11"></line>
                      </svg>
                      <span>{{ __('Inscription') }}</span>
                    </a>
                  </li>
                @endguest
                @auth('web')
                  <li>
                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                      </svg>
                      <span>{{ __('Dashboard') }}</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('user.logout') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                      </svg>
                      <span>{{ __('Logout') }}</span>
                    </a>
                  </li>
                @endauth
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>

</header>
<!-- Header-area end -->
