@extends('frontend.layout')

@php $title = __('Support Tickets'); @endphp

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
  </style>
@endsection

@section('pageHeading')
  {{ $title }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])

  <!--====== Start Support Tickets Section ======-->
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
                    <h4>{{ __('Ticket List') }}</h4>

                    <a href="{{ route('user.support_tickets.create') }}" class="btn btn-md btn-primary rounded-1">{{ __('New Ticket') }}</a>
                  </div>

                  <div class="main-info">
                    @if (count($tickets) == 0)
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4>{{ __('No Ticket Found') . '!' }}</h4>
                        </div>
                      </div>
                    @else
                      <div class="main-table">
                        <div class="table-responsive">
                          <table id="user-datatable" class="table table-striped w-100">
                            <thead>
                              <tr>
                                <th>{{ __('Ticket ID') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($tickets as $ticket)
                                <tr>
                                  <td class="{{ $currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3' }}">
                                    {{ '#' . $ticket->id }}
                                  </td>
                                  <td class="{{ $currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3' }}">
                                    {{ strlen($ticket->subject) > 60 ? mb_substr($ticket->subject, 0, 60, 'UTF-8') . '...' : $ticket->subject }}
                                  </td>
                                  <td>
                                    @if ($ticket->status == 'pending')
                                      <span class="pending {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}">{{ __('Pending') }}</span>
                                    @elseif ($ticket->status == 'open')
                                      <span class="open {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}">{{ __('Open') }}</span>
                                    @else
                                      <span class="closed {{ $currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2' }}">{{ __('Closed') }}</span>
                                    @endif
                                  </td>
                                  <td class="{{ $currentLanguageInfo->direction == 1 ? 'pe-3' : 'ps-3' }}">
                                    <a href="{{ route('user.support_ticket.conversation', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary rounded-1">
                                      {{ __('Conversation') }}
                                    </a>
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
  <!--====== End Support Tickets Section ======-->
@endsection
