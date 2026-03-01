@extends('frontend.layout')

@php $title = __('Service Order Details'); @endphp

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

  <!--====== Start Service Order Details ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="order-details">
                  <div class="title">
                    <h4>{{ __('Details') }}</h4>
                  </div>

                  <div class="view-order-page">
                    <div class="order-info-area">
                      <div class="row align-items-center">
                        <div class="col-lg-8">
                          <div class="order-info">
                            <h3>{{ __('Order') . ': #' . $orderInfo->order_number }}</h3>
                            <p>{{ __('Order Date') . ': ' . date_format($orderInfo->created_at, 'M d, Y') }}</p>
                          </div>
                        </div>

                        @if (!is_null($orderInfo->invoice))
                          @php
                            $slug = @$serviceInfo->slug;
                            $date = $orderInfo->created_at->toDateString();
                          @endphp

                          <div class="col-lg-4">
                            <div class="download">
                              <a href="{{ asset('assets/file/invoices/service/' . $orderInfo->invoice) }}"
                                download="{{ $slug . '-' . $date . '.pdf' }}" class="btn btn-lg btn-primary radius-sm">
                                <i class="fas fa-download"></i> {{ __('Invoice') }}
                              </a>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="billing-add-area mb-0">
                    @php
                      $position = $orderInfo->currency_symbol_position;
                      $symbol = $orderInfo->currency_symbol;
                    @endphp

                    <div class="row">
                      <div class="col-md-6">
                        <div class="main-info">
                          <h5>{{ __('Information') }}</h5>
                          <ul class="list list-unstyled">
                            <li>
                              <p><span>{{ __('Name') . ':' }}</span>{{ $orderInfo->name }}</p>
                            </li>

                            <li>
                              <p><span>{{ __('Email') . ':' }}</span>{{ $orderInfo->email_address }}</p>
                            </li>
                            @php $informations = json_decode($orderInfo->informations); @endphp

                            @if (!is_null($informations))
                              @foreach ($informations as $key => $information)
                                @php
                                  $str = preg_replace('/_/', ' ', $key);
                                  $label = mb_convert_case($str, MB_CASE_TITLE);
                                @endphp

                                @if ($information->type == 8)
                                  <li>
                                    <p>
                                      <span>{{ __($label) . ':' }}</span>
                                      <a href="{{ asset('assets/file/zip-files/' . $information->value) }}" download
                                        class="btn btn-sm btn-primary rounded-1">
                                        {{ __('Download') }}
                                      </a>
                                    </p>
                                  </li>
                                @elseif ($information->type == 4)
                                  <li>
                                    <p>
                                      <span>{{ __($label) . ':' }}</span>

                                      @php
                                        $checkboxValues = $information->value;
                                        $allCheckboxOptions = '';
                                        $lastElement = end($checkboxValues);

                                        foreach ($checkboxValues as $value) {
                                            if ($value == $lastElement) {
                                                $allCheckboxOptions .= $value;
                                            } else {
                                                $allCheckboxOptions .= $value . ', ';
                                            }
                                        }
                                      @endphp

                                      {{ $allCheckboxOptions }}
                                    </p>
                                  </li>
                                @elseif ($information->type == 5)
                                  <li>
                                    <p>
                                      <span>{{ __($label) . ':' }}</span>
                                      <button type="button" class="btn btn-sm btn-primary rounded-1"
                                        data-bs-toggle="modal" data-bs-target="#textAreaModal-{{ $key }}">
                                        {{ __('Show') }}
                                      </button>
                                    </p>
                                  </li>

                                  @includeIf('frontend.user.textarea-data')
                                @else
                                  <li>
                                    <p><span>{{ __($label) . ':' }}</span>{{ $information->value }}</p>
                                  </li>
                                @endif
                              @endforeach
                            @endif
                          </ul>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="main-info">
                          <h5>{{ __('Order Information') }}</h5>
                          <ul class="list list-unstyled">
                            <li>
                              <p><span>{{ __('Service') . ':' }}</span>{{ @$serviceInfo->title }}</p>
                            </li>

                            @if (!is_null($packageTitle))
                              <li>
                                <p><span>{{ __('Package') . ':' }}</span>{{ $packageTitle }}
                                  ({{ $position == 'left' ? $symbol : '' }}{{ formatPrice(number_format($orderInfo->package_price, 2)) }}{{ $position == 'right' ? $symbol : '' }})
                                </p>
                              </li>
                            @endif

                            @if (!is_null($orderInfo->addons))
                              @php $addons = json_decode($orderInfo->addons); @endphp

                              <li>
                                <span class="d-block">{{ __('Addons') . ':' }}</span>
                                <div class="ps-3">
                                  @php
                                    $addonTotal = 0;
                                  @endphp
                                  @foreach ($addons as $addon)
                                    @php
                                      $addonId = $addon->id;

                                      $serviceAddon = \App\Models\ClientService\ServiceAddon::query()->find($addonId);
                                    @endphp

                                    <span>
                                      {{ $loop->iteration . '.' }} {{ $serviceAddon->name }}
                                      ({{ $position == 'left' ? $symbol : '' }}{{ formatPrice($addon->price) }}{{ $position == 'right' ? $symbol : '' }})
                                    </span>
                                    <br>
                                    @php
                                      $addonTotal = $addonTotal + $addon->price;
                                    @endphp
                                  @endforeach
                                </div>
                                <hr class="mt-1 mb-1">
                                <p>
                                  <span>{{ __('Total' . ':') }}</span>
                                  {{ $position == 'left' ? $symbol : '' }}{{ formatPrice($addonTotal) }}{{ $position == 'right' ? $symbol : '' }}
                                </p>
                              </li>
                            @endif
                            <li>
                              <p>
                                <span>{{ __('Tax') }} ({{ $orderInfo->tax_percentage . '%' }}) :
                                </span>{{ $position == 'left' ? $symbol : '' }}{{ formatPrice(number_format($orderInfo->tax, 2)) }}{{ $position == 'right' ? $symbol : '' }}
                              </p>
                            </li>

                            @if (is_null($orderInfo->grand_total))
                              <li>
                                <p><span>{{ __('Total') . ':' }}</span>{{ __('Price Requested') }}</p>
                              </li>
                            @else
                              <li>
                                <p>
                                  <span>{{ __('Total') . ':' }}</span>{{ $position == 'left' ? $symbol : '' }}{{ formatPrice(number_format($orderInfo->grand_total, 2)) }}{{ $position == 'right' ? $symbol : '' }}
                                </p>
                              </li>
                            @endif

                            @if (!is_null($orderInfo->payment_method))
                              <li>
                                <p><span>{{ __('Paid via') . ':' }}</span>{{ $orderInfo->payment_method }}</p>
                              </li>
                            @endif

                            <li>
                              <p><span>{{ __('Payment Status') . ':' }}</span>
                                @if ($orderInfo->payment_status == 'completed')
                                  <span class="badge px-2 py-1" style="background: rgba(79, 70, 229, 0.12); color: #4F46E5;">{{ __('Completed') }}</span>
                                @elseif ($orderInfo->payment_status == 'pending')
                                  <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                @else
                                  <span class="badge bg-danger px-2 py-1">{{ __('Rejected') }}</span>
                                @endif
                              </p>
                            </li>

                            <li>
                              <p><span>{{ __('Order Status') . ':' }}</span>
                                @if ($orderInfo->order_status == 'pending')
                                  <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                @elseif ($orderInfo->order_status == 'completed')
                                  <span class="badge px-2 py-1" style="background: rgba(79, 70, 229, 0.12); color: #4F46E5;">{{ __('Completed') }}</span>
                                @else
                                  <span class="badge bg-danger px-2 py-1">{{ __('Rejected') }}</span>
                                @endif
                              </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Order Details ======-->
@endsection
