@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <h1>Paramètres Freelance</h1>
    <p>Page principale des paramètres (TODO: rediriger vers le dashboard avec tab=settings)</p>
    <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="btn-premium btn-premium-primary">
      Retour au dashboard
    </a>
  </div>
@endsection

