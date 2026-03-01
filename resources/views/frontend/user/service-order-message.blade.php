@extends('frontend.layout')
@section('pageHeading')
  {{ __('Message') }}
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
@php $heroFirstName = Auth::guard('web')->user() ? explode(' ', trim(Auth::guard('web')->user()->name))[0] : 'vous'; @endphp
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
  <!--====== Start Live Chat ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div id="reload-div">
            <div class="message-wrapper mb-40">
              <h4 class="mb-3">
                {{ '#' . $order->order_number }} - <a
                  href="{{ route('service_details', ['slug' => $serviceInfo->slug, 'id' => $serviceInfo->service_id]) }}"
                  class="link_22422"
                  target="_blank">{{ strlen($serviceInfo->title) > 35 ? mb_substr($serviceInfo->title, 0, 35, 'UTF-8') . '...' : $serviceInfo->title }}</a>
              </h4>
              <div class="row">
                <div class="col-lg-12">
                  <div class="chat-wrapper-area">
                    <div class="chat-wrapper">
                      @if (count($messages) > 0)
                        @foreach ($messages as $msgInfo)
                          @if ($msgInfo->person_type == 'user')
                            <div class="chat-card mb-15">
                              <div class="chat-text">
                                <div class="content mb-15">
                                  @if (!empty($msgInfo->message))
                                    <p>{!! nl2br($msgInfo->message) !!}</p>
                                  @else
                                    {{-- check whether the uploaded file is image or not --}}
                                    @php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    @endphp

                                    @if ($isImg == true)
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                      <br>
                                      <img src="{{ asset('assets/file/message-files/' . $unqName) }}" alt="image"
                                        width="150">
                                    @else
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                    @endif
                                  @endif
                                </div>
                              </div>

                              <div class="thumb">
                                <img
                                  src="{{ empty($msgInfo->user->image) ? asset('assets/img/users/profile.jpeg') : asset('assets/img/users/' . $msgInfo->user->image) }}"
                                  alt="user">
                              </div>
                            </div>
                          @elseif ($msgInfo->person_type == 'seller')
                            <div class="chat-card reply-chat mb-15">
                              <div class="thumb">
                                <img
                                  src="{{ empty($msgInfo->seller->photo) ? asset('assets/img/users/profile.jpeg') : asset('assets/admin/img/seller-photo/' . $msgInfo->seller->photo) }}"
                                  alt="admin">
                              </div>

                              <div class="chat-text">
                                <div class="content mb-15">
                                  @if (!empty($msgInfo->message))
                                    <p>{!! nl2br($msgInfo->message) !!}</p>
                                  @else
                                    {{-- check whether the uploaded file is image or not --}}
                                    @php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    @endphp

                                    @if ($isImg == true)
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                      <br>
                                      <img src="{{ asset('assets/file/message-files/' . $unqName) }}" alt="image"
                                        width="150">
                                    @else
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          @else
                            <div class="chat-card reply-chat mb-15">
                              <div class="thumb">
                                <img
                                  src="{{ empty($msgInfo->admin->image) ? asset('assets/img/users/profile.jpeg') : asset('assets/img/admins/' . $msgInfo->admin->image) }}"
                                  alt="admin">
                              </div>

                              <div class="chat-text">
                                <div class="content mb-15">
                                  @if (!empty($msgInfo->message))
                                    <p>{!! nl2br($msgInfo->message) !!}</p>
                                  @else
                                    {{-- check whether the uploaded file is image or not --}}
                                    @php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    @endphp

                                    @if ($isImg == true)
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                      <br>
                                      <img src="{{ asset('assets/file/message-files/' . $unqName) }}" alt="image"
                                        width="150">
                                    @else
                                      <a href="{{ asset('assets/file/message-files/' . $unqName) }}"
                                        download="{{ $orgName }}">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span>{{ $orgName }}
                                      </a>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @endif
                    </div>

                    <div class="chat-bottom">
                      <form action="{{ route('user.service_order.store_message', ['id' => $order->id]) }}" method="POST"
                        id="msg-form" autocomplete="off">
                        @csrf
                        <div class="chat-input-group">
                          <label class="helper-form">
                            <input type="file" name="attachment" id="attachment" class="mdf_display_none">
                            <i class="far fa-paperclip"></i>

                            <div class="helper-text">
                              <h6 class="mb-2">{{ __('Allow file types') }}</h6>
                              <ul class="helper-list">
                                <li>{{ __('.jpg') }},
                                  {{ __('.jpeg') }},
                                  {{ __('.png') }},
                                  {{ __('.rar') }},
                                  {{ __('.zip') }},
                                  {{ __('.txt') }},
                                  {{ __('.doc') }},
                                  {{ __('.docx') }},
                                  {{ __('.pdf') }}</li>
                              </ul>
                            </div>
                          </label>

                          <input type="text" name="msg" placeholder="{{ __('Type a message') . '...' }}"
                            autocomplete="off">

                          <div class="chat-send-button">
                            <button type="submit" id="chat-send-button"><i class="far fa-paper-plane"></i></button>
                          </div>
                        </div>

                      </form>
                      <div class="progress mt-2 d-none">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <p class="mt-4 text-danger" id="msg-err"></p>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Live Chat ======-->
@endsection

@section('script')
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

  <script>
    let pusherKey = '{{ $bs->pusher_key }}';
    let pusherCluster = '{{ $bs->pusher_cluster }}';
  </script>
  <script type="text/javascript" src="{{ asset('assets/js/message.js') }}"></script>
@endsection
