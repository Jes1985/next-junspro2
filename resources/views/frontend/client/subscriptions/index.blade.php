@extends('frontend.layout')

@section('pageHeading')
  {{ __('Mes Abonnements') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Mes Abonnements')])

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Mes Abonnements Junspro') }}</h4>
            </div>

            @if($subscriptions->count() > 0)
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{ __('Freelance') }}</th>
                      <th>{{ __('Heures/semaine') }}</th>
                      <th>{{ __('Prix 4 semaines') }}</th>
                      <th>{{ __('Statut') }}</th>
                      <th>{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($subscriptions as $subscription)
                      <tr>
                        <td>
                          <strong>{{ $subscription->freelancer->user->name ?? 'N/A' }}</strong>
                        </td>
                        <td>{{ $subscription->hours_per_week }}h</td>
                        <td>{{ number_format($subscription->price_base, 2, ',', ' ') }} €</td>
                        <td>
                          <span class="badge {{ $subscription->status === 'active' ? 'badge-junspro' : ($subscription->status === 'paused' ? 'badge-warning' : 'badge-secondary') }}">
                            {{ ucfirst($subscription->status) }}
                          </span>
                        </td>
                        <td>
                          <div class="btn-group-vertical btn-group-sm" role="group">
                            <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="btn btn-primary mb-1">
                              <i class="fas fa-eye me-1"></i>{{ __('Voir les livraisons') }}
                            </a>
                            @if($subscription->can_transfer ?? true)
                              <a href="{{ route('client.subscriptions.transfer', $subscription->id) }}" class="btn btn-info mb-1">
                                <i class="fas fa-exchange-alt me-1"></i>{{ __('Transférer vers un autre freelance') }}
                              </a>
                            @endif
                            @if($subscription->status === 'active')
                              <form action="{{ route('client.subscriptions.pause', $subscription->id) }}" method="POST" class="d-inline mb-1">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100">
                                  <i class="fas fa-pause me-1"></i>{{ __('Mettre en pause') }}
                                </button>
                              </form>
                            @elseif($subscription->status === 'paused')
                              <form action="{{ route('client.subscriptions.resume', $subscription->id) }}" method="POST" class="d-inline mb-1">
                                @csrf
                                <button type="submit" class="btn btn-success w-100" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none; color: #ffffff;">
                                  <i class="fas fa-play me-1"></i>{{ __('Reprendre') }}
                                </button>
                              </form>
                            @endif
                            <a href="{{ route('client.subscriptions.cancel', $subscription->id) }}" class="btn btn-danger">
                              <i class="fas fa-times-circle me-1"></i>{{ __('Annuler mon abonnement') }}
                            </a>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                {{ $subscriptions->links() }}
              </div>
            @else
              <div class="alert alert-info">
                {{ __('Vous n\'avez aucun abonnement actif.') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



