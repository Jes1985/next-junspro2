@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <h1>Notifications</h1>
    <p>TODO: Gestion des notifications</p>
    <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="btn-premium btn-premium-secondary">
      Retour
    </a>
  </div>
@endsection

