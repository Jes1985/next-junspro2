@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <h1>Adresse e-mail</h1>
    <p>TODO: Gestion de l'adresse e-mail</p>
    <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="btn-premium btn-premium-secondary">
      Retour
    </a>
  </div>
@endsection

