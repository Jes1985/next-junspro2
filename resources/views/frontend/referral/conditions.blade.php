@extends('frontend.layout')

@section('pageHeading', __('Conditions du parrainage'))

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/front/css/referral-premium.css') }}?v={{ time() }}">
@endsection

@section('content')
  <div class="referral-conditions-container">
    <div class="referral-conditions-content">
      <h1 class="referral-conditions-title">{{ __('Conditions du programme de parrainage') }}</h1>
      
      <div class="referral-conditions-section">
        <h2>{{ __('Éligibilité') }}</h2>
        <p>{{ __('Pour bénéficier du programme de parrainage :') }}</p>
        <ul>
          <li>{{ __('Le filleul doit effectuer sa première réservation éligible d\'un montant minimum de :amount€', ['amount' => $config['min_eligible_amount']]) }}</li>
          <li>{{ __('La première prestation doit être confirmée (payée et non annulée/non remboursée)') }}</li>
          <li>{{ __('Un utilisateur ne peut être parrainé qu\'une seule fois') }}</li>
          <li>{{ __('L\'auto-parrainage est strictement interdit') }}</li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2>{{ __('Récompenses') }}</h2>
        <p><strong>{{ __('Pour le parrain :') }}</strong></p>
        <ul>
          <li>{{ __('Vous recevez :amount€ de crédit Junspro après confirmation de la première prestation de votre filleul', ['amount' => $config['reward_amount']]) }}</li>
          <li>{{ __('Le crédit est ajouté à votre solde et appliqué automatiquement lors du paiement de vos prochains cours') }}</li>
          <li>{{ __('Le délai d\'attribution peut prendre jusqu\'à :hours heures pour vérification', ['hours' => $config['cooldown_hours']]) }}</li>
        </ul>
        
        <p><strong>{{ __('Pour le filleul :') }}</strong></p>
        <ul>
          <li>{{ __('Vous bénéficiez de :benefit_label sur votre première réservation éligible', ['benefit_label' => $config['benefit_label']]) }}</li>
          <li>{{ __('L\'avantage s\'applique automatiquement au checkout pour les réservations d\'au moins :amount€', ['amount' => $config['min_eligible_amount']]) }}</li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2>{{ __('Anti-abus') }}</h2>
        <ul>
          <li>{{ __('Un filleul ne peut avoir qu\'un seul parrain') }}</li>
          <li>{{ __('L\'auto-parrainage est strictement interdit et entraînera l\'annulation du parrainage') }}</li>
          <li>{{ __('Si la première réservation est annulée ou remboursée, la récompense ne peut pas être accordée') }}</li>
          <li>{{ __('La récompense sera déclenchée dès qu\'une première prestation éligible est confirmée') }}</li>
        </ul>
      </div>

      <div class="referral-conditions-section">
        <h2>{{ __('Plafond mensuel') }}</h2>
        <p>{{ __('Le montant total des récompenses est plafonné à :amount€ par mois et par parrain.', ['amount' => $config['monthly_cap']]) }}</p>
        <p>{{ __('Si le plafond est atteint, les nouvelles récompenses seront reportées au mois suivant.') }}</p>
      </div>

      <div class="referral-conditions-section">
        <h2>{{ __('Support') }}</h2>
        <p>{{ __('Pour toute question concernant le programme de parrainage, contactez notre support avec l\'email du proche invité ou une capture d\'écran.') }}</p>
        <p><a href="{{ route('contact') }}" class="referral-link">{{ __('Contacter le support') }}</a></p>
      </div>
    </div>
  </div>
@endsection

