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
                    <span class="badge {{ $subscription->status === 'active' ? 'badge-junspro' : ($subscription->status === 'paused' ? 'badge-warning' : 'badge-secondary') }}">
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
                        <td>{{ $session->start_at ? $session->start_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $session->duration_minutes ? number_format($session->duration_minutes / 60, 1) : 'N/A' }}h</td>
                        <td>{{ Str::limit($session->report_text ?? 'N/A', 50) }}</td>
                        <td>
                          <span class="badge {{ $session->status === 'validated' ? 'badge-junspro' : ($session->status === 'delivered' ? 'badge-info' : ($session->status === 'rectification_requested' ? 'badge-warning' : 'badge-secondary')) }}">
                            {{ ucfirst($session->status) }}
                          </span>
                        </td>
                        <td>
                          {{ $session->rectification_count ?? 0 }}/{{ $subscription->max_rectifications_per_delivery ?? 2 }}
                          @if($session->status === 'delivered' && ($session->rectification_count ?? 0) < ($subscription->max_rectifications_per_delivery ?? 2))
                            <br>
                            <button type="button" class="btn btn-sm btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#rectificationModal{{ $session->id }}">
                              <i class="fas fa-edit me-1"></i>{{ __('Demander rectification') }}
                            </button>
                          @endif
                        </td>
                      </tr>
                      
                      <!-- Modal rectification -->
                      <div class="modal fade" id="rectificationModal{{ $session->id }}" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{ __('Demander une rectification') }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('client.work-session.rectify', $session->id) }}" method="POST">
                              @csrf
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label class="form-label">{{ __('Raison de la rectification') }} *</label>
                                  <textarea name="reason" class="form-control" rows="4" required placeholder="{{ __('Expliquez ce qui doit être modifié...') }}"></textarea>
                                </div>
                                <div class="alert alert-info">
                                  <small>
                                    {{ __('Rectifications restantes') }} : {{ ($subscription->max_rectifications_per_delivery ?? 2) - ($session->rectification_count ?? 0) }}
                                  </small>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                                <button type="submit" class="btn btn-warning">{{ __('Demander la rectification') }}</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
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



