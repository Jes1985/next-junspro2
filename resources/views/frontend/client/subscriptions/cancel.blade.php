@extends('frontend.layout')

@section('pageHeading')
  {{ __('Annuler mon abonnement') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Annuler mon abonnement')])

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Annuler mon abonnement') }}</h4>
            </div>

            <!-- Étape 1 : Alternatives proposées -->
            <div class="card mb-30">
              <div class="card-body">
                <h5 class="mb-20">{{ __('Votre projet est important. Voyons si on peut adapter votre abonnement.') }}</h5>
                
                <form action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}" method="POST">
                  @csrf
                  
                  <div class="mb-20">
                    <button type="submit" name="action" value="pause" class="btn btn-lg btn-primary w-100 mb-10">
                      {{ __('Mettre en pause mon abonnement') }}
                    </button>
                    <p class="text-muted small">{{ __('Vous pourrez le reprendre à tout moment.') }}</p>
                  </div>

                  <div class="mb-20">
                    <button type="submit" name="action" value="change_freelancer" class="btn btn-lg btn-secondary w-100 mb-10">
                      {{ __('Changer de freelance') }}
                    </button>
                    <p class="text-muted small">{{ __('Transférer votre projet vers un autre freelance.') }}</p>
                  </div>

                  <div class="mb-20">
                    <button type="submit" name="action" value="modify_formula" class="btn btn-lg btn-info w-100 mb-10">
                      {{ __('Modifier ma formule') }}
                    </button>
                    <p class="text-muted small">{{ __('Ajuster le nombre d\'heures par semaine.') }}</p>
                  </div>

                  <hr>

                  <div class="mb-20">
                    <button type="submit" name="action" value="confirm_cancel" class="btn btn-lg btn-danger w-100 mb-10">
                      {{ __('Continuer l\'annulation') }}
                    </button>
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



