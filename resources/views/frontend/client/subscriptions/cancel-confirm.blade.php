@extends('frontend.layout')

@section('pageHeading')
  {{ __('Confirmer l\'annulation') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb ?? [], 'title' => __('Confirmer l\'annulation')])

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Confirmer l\'annulation de votre abonnement') }}</h4>
            </div>

            <!-- Étape 2 : Confirmation avec raison -->
            <div class="card mb-30">
              <div class="card-body">
                <h5 class="mb-20">{{ __('Votre abonnement sera arrêté. Plus aucun débit ni nouvelle livraison programmée.') }}</h5>
                
                <p class="text-muted mb-20">
                  <strong>{{ __('Raison') }}:</strong> {{ $reason ?? 'Non spécifiée' }}
                </p>

                <!-- Étape 3 : Dernière offre -->
                <form action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="action" value="final_cancel">
                  <input type="hidden" name="reason" value="{{ $reason ?? '' }}">
                  
                  <div class="mb-20">
                    <a href="{{ route('explore') }}" class="btn btn-lg btn-primary w-100 mb-10">
                      {{ __('Trouver un autre freelance') }}
                    </a>
                  </div>

                  <div class="mb-20">
                    <a href="{{ route('client.subscriptions.index') }}" class="btn btn-lg btn-success w-100 mb-10">
                      {{ __('Garder mon abonnement') }}
                    </a>
                  </div>

                  <hr>

                  <div class="mb-20">
                    <button type="submit" class="btn btn-lg btn-danger w-100 mb-10">
                      {{ __('Annuler définitivement mon abonnement') }}
                    </button>
                    <p class="text-muted small text-center">{{ __('Cette action est irréversible.') }}</p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



