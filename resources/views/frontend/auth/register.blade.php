<!DOCTYPE html>
<html lang="{{ $currentLanguageInfo->code ?? 'fr' }}" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Inscription | {{ $websiteInfo->website_title ?? 'Junspro' }}</title>
  <link rel="shortcut icon" href="{{ asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png')) }}" type="image/x-icon">
  
  {{-- CSS Auth Moderne --}}
  <link rel="stylesheet" href="{{ asset('assets/front/css/auth-modern.css') }}">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow-x: hidden;
    }
  </style>
</head>
<body style="margin: 0; padding: 0;">
  @php
    $role = request()->get('role', 'client'); // 'client' ou 'freelance'
  @endphp

  @include('frontend.auth.auth-modal', [
    'role' => $role,
    'mode' => 'register',
    'isModal' => false,
    'websiteInfo' => $websiteInfo ?? null,
    'googleEnabled' => $googleEnabled ?? false,
    'facebookEnabled' => $facebookEnabled ?? false
  ])
</body>
</html>

