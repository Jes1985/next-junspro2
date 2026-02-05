@extends('frontend.layout')

@section('content')
  <div style="padding: 2rem; text-align: center;">
    <h1>Test Page Messages</h1>
    <p>Si vous voyez ce message, la route fonctionne !</p>
    <a href="{{ route('user.messages.index') }}">Aller à la page Messages complète</a>
  </div>
@endsection
