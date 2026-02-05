@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/front/css/services-pages.css') }}">
@endsection

@section('content')
  <div class="services-page-wrapper">
    <!-- Hero Section -->
    <x-services.hero
      :title="$title"
      :subtitle="$subtitle ?? null"
      :micro="$micro ?? null"
      :cta="$cta ?? null"
    />

    <div class="container">
      <!-- Breadcrumb Navigation -->
      <div class="services-category-breadcrumb">
        <a href="{{ route('services') }}" class="services-breadcrumb-link">Services</a>
        <span class="services-breadcrumb-separator">/</span>
        <a href="{{ $universeInfo['url'] }}" class="services-breadcrumb-link">{{ $universeInfo['title'] }}</a>
        <span class="services-breadcrumb-separator">/</span>
        <span class="services-breadcrumb-current">{{ $categoryName }}</span>
      </div>

      <!-- Category Slider -->
      <section class="services-page-categories">
        <x-services.category-slider :categories="$categories" />
      </section>

      <!-- Results Section -->
      <section id="results" class="services-page-results">
        <h2 class="services-results-title">Services {{ $categoryName }}</h2>
        <p class="services-results-subtitle">Découvrez nos prestations {{ strtolower($categoryName) }} de qualité</p>
        
        <x-services.result-grid :results="$results" />
      </section>
    </div>
  </div>
@endsection

