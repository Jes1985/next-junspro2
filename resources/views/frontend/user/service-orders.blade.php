@extends('frontend.layout')

@php $title = __('Service Orders'); @endphp

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
@include('frontend.client.partials.dashboard-nav')

  <!--====== Start Service Orders Section ======-->
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
                    <h4>{{ __('Order List') }}</h4>
                  </div>

                  <div class="main-info">
                    @if (count($orders) == 0)
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4>{{ __('No Order Found') . '!' }}</h4>
                        </div>
                      </div>
                    @else
                      <div class="main-table">
                        <div class="table-responsive">
                          <table id="user-datatable" class="table table-striped w-100">
                            <thead>
                              <tr>
                                <th>{{ __('Order Number') }}</th>
                                <th>{{ __('Service') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($orders as $order)
                                <tr>
                                  <td class="ps-3">{{ '#' . $order->order_number }}</td>
                                  <td class="ps-3">
                                    @php
                                      $title = @$order->serviceInfo->title;
                                      $slug = @$order->serviceInfo->slug;
                                    @endphp
                                    @if (!empty($slug))
                                      <a class="text-primary"
                                        href="{{ route('service_details', ['slug' => $slug, 'id' => $order->service_id]) }}"
                                        target="_blank">
                                        {{ strlen($title) > 75 ? mb_substr($title, 0, 75, 'UTF-8') . '...' : $title }}
                                      </a>
                                    @endif
                                  </td>
                                  <td class="ps-3">
                                    {{ date_format($order->created_at, 'M d, Y') }}
                                  </td>
                                  <td>
                                    @if ($order->order_status == 'pending' && $order->payment_status == 'completed')
                                      <form
                                        action="{{ route('user.service_order.confirm_order', ['id' => $order->id]) }}"
                                        method="post" class="completeForm">
                                        @csrf
                                        <select name="status" class="niceselect completeBtn">
                                          <option disabled @selected($order->order_status == 'pending') value="pending">
                                            {{ __('Pending') }}
                                          </option>
                                          <option value="completed">{{ __('Completed') }}
                                          </option>
                                        </select>
                                      </form>
                                    @else
                                      @if ($order->order_status == 'completed')
                                        <span
                                          class="completed {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}" style="color: #4F46E5;"><b>{{ __('Completed') }}</b></span>
                                      @elseif ($order->order_status == 'pending')
                                        <span
                                          class="rejected {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}"><b>{{ __('Pending') }}</b></span>
                                      @else
                                        <span
                                          class="rejected text-danger {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}"><b>{{ __('Rejected') }}</b></span>
                                      @endif
                                    @endif
                                  </td>
                                  <td class="ps-3">
                                    <div class="dropdown">
                                      <button class="btn btn-sm btn-primary rounded-1 dropdown-toggle dropdown_btn"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Select') }}
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item font-sm"
                                          href="{{ route('user.service_order.details', ['id' => $order->id]) }}">{{ __('Details') }}</a>
                                        @if ($order->payment_status == 'completed')
                                          @if (!is_null($order->seller_id))
                                            @php
                                              $liveChatStatus = App\Http\Helpers\SellerPermissionHelper::getPackageInfoByMembership($order->seller_membership_id);
                                            @endphp
                                            @if ($liveChatStatus == true)
                                              <a href="{{ route('user.service_order.message', ['id' => $order->id]) }}"
                                                class="dropdown-item font-sm">
                                                {{ __('Chat with Seller') }}
                                              </a>
                                            @endif
                                          @else
                                            <a href="{{ route('user.service_order.message', ['id' => $order->id]) }}"
                                              class="dropdown-item font-sm">
                                              {{ __('Chat with Seller') }}
                                            </a>
                                          @endif
                                        @endif

                                        @if ($order->raise_status == 1)
                                          <a href="{{ route('user.service_order.raise_request', ['id' => $order->id, 'status' => 0]) }}"
                                            class="dropdown-item font-sm">{{ __('Cancel Dispute') }}</a>
                                        @elseif ($order->raise_status == 2)
                                          <a href="#" class="dropdown-item font-sm">{{ __('Dispute Resolved') }}</a>
                                        @elseif ($order->raise_status == 3)
                                          <a href="#" class="dropdown-item font-sm">{{ __('Dispute Rejected') }}</a>
                                        @else
                                          <a href="{{ route('user.service_order.raise_request', ['id' => $order->id, 'status' => 1]) }}"
                                            class="dropdown-item font-sm">{{ __('Raise Dispute') }}</a>
                                        @endif
                                      </div>
                                    </div>


                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
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
  <!--====== End Service Orders Section ======-->
@endsection
