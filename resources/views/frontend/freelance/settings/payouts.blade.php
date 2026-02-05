@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <h1>Versements</h1>
    <p>TODO: Gestion des versements (RIB/IBAN, préférences de paiement)</p>
    <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="btn-premium btn-premium-secondary">
      Retour
    </a>
  </div>
@endsection

