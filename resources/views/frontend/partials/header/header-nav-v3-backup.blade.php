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
                <span class="junspro-logo-text">JUNSPRO</span>
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
          <ul id="mainMenu" class="navbar-nav mobile-item ms-auto">
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
              <div class="language">
                <form action="{{ route('change_language') }}" method="GET">
                  <select class="niceselect" name="lang_code" onchange="this.form.submit()">
                    @foreach ($allLanguageInfos as $languageInfo)
                      <option value="{{ $languageInfo->code }}" @selected($languageInfo->code == $currentLanguageInfo->code)>
                        {{ $languageInfo->name }}
                      </option>
                    @endforeach
                  </select>
                </form>
              </div>
            </div>
          @endif
          {{-- Menu Freelance (affiché uniquement si connecté en tant que seller) --}}
          @auth('seller')
          <div class="item">
            <div class="dropdown">
                <button class="user-menu-btn dropdown-toggle" type="button"
                  data-bs-toggle="dropdown" aria-expanded="false" style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);">
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
              <button class="user-menu-btn dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
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
                    <a class="dropdown-item" href="{{ route('referral.index') }}">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                      </svg>
                      <span>{{ __('Parrainage') }}</span>
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
