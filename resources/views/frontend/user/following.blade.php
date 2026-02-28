@extends('frontend.layout')

@php $title = __('Following'); @endphp

@section('style')
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow-lg: 0 25px 80px rgba(124,58,237,0.18);
    }

    .settings-sidebar {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      box-shadow: 0 8px 32px rgba(124,58,237,0.15);
      padding: 2rem 0;
      border: 1px solid rgba(124,58,237,0.12);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      min-width: 280px;
    }

    .settings-sidebar:hover {
      box-shadow: var(--card-shadow-lg);
      border-color: rgba(124,58,237,0.2);
    }

    .settings-sidebar-title {
      padding: 0 2rem 1.25rem 2rem;
      font-size: 0.8rem;
      font-weight: 800;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      border-bottom: 1.5px solid rgba(124,58,237,0.08);
      margin-bottom: 0.75rem;
    }

    .settings-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .settings-menu-item {
      margin: 0;
    }

    .settings-menu-item a {
      display: block;
      padding: 0.95rem 1.5rem;
      color: #4b5563;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 600;
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      border-left: 4px solid transparent;
      position: relative;
      overflow: visible;
      letter-spacing: 0.01em;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .settings-menu-item a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 4px;
      height: 0%;
      background: var(--junspro-gradient);
      transition: height 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .settings-menu-item a::after {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      right: 0;
      background: var(--junspro-gradient);
      opacity: 0;
      transition: opacity 0.25s;
      z-index: -1;
    }

    .settings-menu-item a:hover {
      color: var(--junspro-purple);
      padding-left: 2.3rem;
      background: rgba(124,58,237,0.06);
    }

    .settings-menu-item a:hover::before {
      height: 100%;
    }

    .settings-menu-item a.active {
      background: linear-gradient(135deg, rgba(124,58,237,0.12) 0%, rgba(78,70,229,0.08) 100%);
      color: var(--junspro-purple);
      font-weight: 800;
      border-left-color: var(--junspro-purple);
    }

    .settings-menu-item a.active::before {
      height: 100%;
    }

    @media (max-width: 768px) {
      .settings-sidebar {
        position: relative;
        margin-bottom: 2rem;
      }
    }

    /* === Dashboard Hero === */
    .dashboard-hero {
      background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%);
      border-radius: 40px;
      padding: 3rem 4rem;
      margin-bottom: 2rem;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
      flex-wrap: wrap;
      box-shadow: 0 32px 80px rgba(124, 58, 237, 0.3), inset 0 1px 1px rgba(255,255,255,0.2);
      position: relative;
      overflow: hidden;
    }
    .dashboard-hero::before {
      content: '';
      position: absolute;
      top: -40%; left: -5%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .dashboard-hero::after {
      content: '';
      position: absolute;
      bottom: -20%; right: -10%;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .dashboard-hero-content { flex: 1; position: relative; z-index: 2; }
    .dashboard-hero-title {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 0.5rem;
      color: white;
      line-height: 1.1;
      letter-spacing: -0.03em;
    }
    .dashboard-hero-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 0;
      font-weight: 300;
    }
  </style>
@endsection

@section('content')
@php
  $heroFirstName = Auth::guard('web')->user() ? explode(' ', trim(Auth::guard('web')->user()->name))[0] : 'vous';
@endphp
<div class="container" style="padding-top: 2rem; padding-bottom: 0;">
  <div class="dashboard-hero">
    <div class="dashboard-hero-content">
      <h1 class="dashboard-hero-title">Bonjour {{ $heroFirstName }} !</h1>
      <p class="dashboard-hero-subtitle">Bienvenue dans votre espace</p>
    </div>
  </div>
</div>

  <!--====== Start Service Wishlist Section ======-->
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
                    <h4>{{ __('Following') }}</h4>
                  </div>

                  <div class="main-info seller-area">
                    @if (count($followings) == 0)
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4>{{ __('No Data Found') . '!' }}</h4>
                        </div>
                      </div>
                    @else
                      {{-- Follwing will be goes here --}}
                      <div class="row">
                        @foreach ($followings as $following)
                          @if ($following->following_seller)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                              <div class="card card-center p-3 border mb-30">
                                <figure class="card-img mb-15">
                                  <a href="{{ route('frontend.seller.details', ['username' => $following->following_seller->username]) }}"
                                    target="_self" title="{{ __('Seller') }}">
                                    @if (!is_null($following->following_seller->photo))
                                      <img class="rounded-circle"
                                        src="{{ asset('assets/admin/img/seller-photo/' . $following->following_seller->photo) }}"
                                        alt="image">
                                    @else
                                      <img class="rounded-circle" src="{{ asset('assets/img/seller-blank-user.jpg') }}"
                                        alt="image">
                                    @endif
                                  </a>
                                </figure>
                                <div class="card-content">
                                  <div class="content-top">
                                    <div class="ratings mx-auto">
                                      <div class="rate bg-img"
                                        data-bg-img="{{ asset('assets/front/images/rate-star.png') }}">
                                        <div class="rating-icon bg-img"style="width: {{ SellerAvgRating(@$following->following_seller->id) * 20 }}%;"
                                          data-bg-img="{{ asset('assets/front/images/rate-star.png') }}"></div>
                                      </div>
                                      <span class="ratings-total">({{ SellerAvgRating(@$following->following_seller->id) }})</span>
                                    </div>
                                  </div>
                                  <h5 class="card-title mb-10">
                                    <a href="{{ route('frontend.seller.details', ['username' => $following->following_seller->username]) }}">{{ strlen($following->following_seller->username) > 20 ? mb_substr($following->following_seller->username, 0, 20, 'UTF-8') . '..' : $following->following_seller->username }}</a>
                                  </h5>
                                  <ul class="info-list mb-15 font-sm list-unstyled">
                                    @php
                                      $service_count = App\Models\ClientService\Service::where([['seller_id', $following->following_seller->id], ['service_status', 1]])->count();
                                    @endphp
                                    <li>{{ $service_count }} {{ $service_count > 1 ? __('Services') : __('Service') }}
                                    </li>
                                    <li>
                                      @php
                                        $follwers_count = App\Models\Follower::where('following_id', $following->following_seller->id)->count();
                                      @endphp

                                      {{ $follwers_count }} {{ __('Followers') }}
                                    </li>
                                  </ul>
                                  <a href="{{ route('frontend.seller.details', ['username' => $following->following_seller->username]) }}"
                                    target="_self" title="{{ $following->following_seller }}"
                                    class="main-btn text-center w-100">
                                    {{ __('View Profile') }}
                                  </a>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      {{ $followings->links() }}
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Wishlist Section ======-->
@endsection
