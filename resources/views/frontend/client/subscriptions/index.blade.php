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
                          <span class="badge badge-{{ $subscription->status === 'active' ? 'success' : ($subscription->status === 'paused' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($subscription->status) }}
                          </span>
                        </td>
                        <td>
                          <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="btn btn-sm btn-primary">
                            {{ __('Voir les livraisons') }}
                          </a>
                          @if($subscription->status === 'active')
                            <form action="{{ route('client.subscriptions.pause', $subscription->id) }}" method="POST" class="d-inline">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-warning">{{ __('Mettre en pause') }}</button>
                            </form>
                          @elseif($subscription->status === 'paused')
                            <form action="{{ route('client.subscriptions.resume', $subscription->id) }}" method="POST" class="d-inline">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-success">{{ __('Reprendre') }}</button>
                            </form>
                          @endif
                          <a href="{{ route('client.subscriptions.cancel', $subscription->id) }}" class="btn btn-sm btn-danger">
                            {{ __('Annuler') }}
                          </a>
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



