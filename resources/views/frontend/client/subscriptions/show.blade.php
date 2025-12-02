@extends('frontend.layout')

@section('pageHeading')
  {{ __('Détails de l\'abonnement') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Détails de l\'abonnement')])

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Abonnement avec') }} {{ $subscription->freelancer->user->name ?? 'N/A' }}</h4>
            </div>

            <div class="card mb-30">
              <div class="card-body">
                <h5>{{ __('Informations de l\'abonnement') }}</h5>
                <ul class="list-unstyled">
                  <li><strong>{{ __('Heures par semaine') }}:</strong> {{ $subscription->hours_per_week }}h</li>
                  <li><strong>{{ __('Prix de base (4 semaines') }}:</strong> {{ number_format($subscription->price_base, 2, ',', ' ') }} €</li>
                  <li><strong>{{ __('Heures restantes') }}:</strong> {{ $subscription->hours_remaining }}h</li>
                  <li><strong>{{ __('Statut') }}:</strong> 
                    <span class="badge badge-{{ $subscription->status === 'active' ? 'success' : ($subscription->status === 'paused' ? 'warning' : 'secondary') }}">
                      {{ ucfirst($subscription->status) }}
                    </span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="title mb-30">
              <h5>{{ __('Livraisons (Sessions de travail)') }}</h5>
            </div>

            @if($workSessions->count() > 0)
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{ __('Date') }}</th>
                      <th>{{ __('Heures') }}</th>
                      <th>{{ __('Résumé') }}</th>
                      <th>{{ __('Statut') }}</th>
                      <th>{{ __('Rectifications') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($workSessions as $session)
                      <tr>
                        <td>{{ $session->work_date ? \Carbon\Carbon::parse($session->work_date)->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $session->hours_spent ?? $session->duration_minutes / 60 }}h</td>
                        <td>{{ Str::limit($session->work_summary ?? $session->report_text ?? 'N/A', 50) }}</td>
                        <td>
                          <span class="badge badge-{{ $session->status === 'validated' ? 'success' : ($session->status === 'delivered' ? 'info' : 'warning') }}">
                            {{ ucfirst($session->status) }}
                          </span>
                        </td>
                        <td>{{ $session->rectification_count ?? 0 }}/{{ $subscription->max_rectifications_per_delivery ?? 2 }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="mt-30">
                {{ $workSessions->links() }}
              </div>
            @else
              <div class="alert alert-info">
                {{ __('Aucune livraison pour le moment.') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



