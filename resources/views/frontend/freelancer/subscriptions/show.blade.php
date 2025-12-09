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
              <h4>{{ __('Abonnement avec') }} {{ $subscription->client->user->name ?? 'N/A' }}</h4>
            </div>

            <!-- Formulaire d'enregistrement de session -->
            @if($subscription->status === 'active')
              <div class="card mb-30">
                <div class="card-body">
                  <h5 class="mb-20">{{ __('Enregistrer une session de travail (50 min travail + 10 min rapport)') }}</h5>
                  
                  <form action="{{ route('freelancer.subscriptions.work-session', $subscription->id) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                      <div class="col-md-6 mb-15">
                        <label>{{ __('Date') }} *</label>
                        <input type="date" name="work_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                      </div>
                      <div class="col-md-3 mb-15">
                        <label>{{ __('Heure début') }}</label>
                        <input type="time" name="start_time" class="form-control">
                      </div>
                      <div class="col-md-3 mb-15">
                        <label>{{ __('Heure fin') }}</label>
                        <input type="time" name="end_time" class="form-control">
                      </div>
                    </div>

                    <div class="mb-15">
                      <label>{{ __('Heures passées') }} * (ex: 1.0 pour 1h = 50 min travail + 10 min rapport)</label>
                      <input type="number" name="hours_spent" class="form-control" step="0.5" min="0.5" max="8" value="1.0" required>
                      <small class="text-muted">{{ __('1h = 50 min de travail + 10 min de rapport détaillé') }}</small>
                    </div>

                    <div class="mb-15">
                      <label>{{ __('Résumé du travail effectué (rapport)') }} * (min 20 caractères)</label>
                      <textarea name="work_summary" class="form-control" rows="5" minlength="20" required placeholder="{{ __('Décrivez le travail effectué pendant cette session (50 min) et le rapport (10 min)...') }}"></textarea>
                    </div>

                    <div class="mb-15">
                      <label>{{ __('Pièces jointes (optionnel)') }}</label>
                      <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                      <small class="text-muted">{{ __('Formats acceptés : PDF, DOC, DOCX, JPG, PNG') }}</small>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Enregistrer la session') }}</button>
                  </form>
                </div>
              </div>
            @endif

            <!-- Liste des sessions -->
            <div class="title mb-30">
              <h5>{{ __('Sessions de travail enregistrées') }}</h5>
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
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($workSessions as $session)
                      <tr>
                        <td>{{ $session->work_date ? \Carbon\Carbon::parse($session->work_date)->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $session->hours_spent ?? $session->duration_minutes / 60 }}h</td>
                        <td>{{ Str::limit($session->work_summary ?? $session->report_text ?? 'N/A', 50) }}</td>
                        <td>
                          <span class="badge {{ $session->status === 'validated' ? 'badge-junspro' : ($session->status === 'delivered' ? 'badge-info' : 'badge-warning') }}">
                            {{ ucfirst($session->status) }}
                          </span>
                        </td>
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
                {{ __('Aucune session enregistrée pour le moment.') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



