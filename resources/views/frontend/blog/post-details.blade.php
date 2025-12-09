@extends('frontend.layout')
@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <style>
    /* Blog Post Hero Premium */
    .blog-post-hero-premium {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      padding: 120px 0 80px;
      position: relative;
      overflow: hidden;
    }
    
    .blog-post-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(96, 165, 250, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(167, 139, 250, 0.12) 0%, transparent 50%);
      opacity: 0.6;
      z-index: 1;
    }
    
    .blog-post-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }
    
    .blog-post-hero-content {
      text-align: center;
      color: white;
    }
    
    .blog-post-breadcrumb {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 2rem;
      font-size: 0.9rem;
    }
    
    .breadcrumb-link {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .breadcrumb-link:hover {
      color: white;
    }
    
    .breadcrumb-separator {
      color: rgba(255, 255, 255, 0.6);
    }
    
    .breadcrumb-current {
      color: rgba(255, 255, 255, 0.8);
    }
    
    .blog-post-hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      color: white;
      line-height: 1.2;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      margin: 0;
      letter-spacing: -0.02em;
    }
    
    /* Blog Details Section Premium */
    .blog-details-section-premium {
      padding: 80px 0;
      background: #F9FAFB;
    }
    
    .blog-post-card-premium {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      border: 1.5px solid #F3F4F6;
      margin-bottom: 2rem;
    }
    
    .blog-post-image-wrapper {
      width: 100%;
      height: 400px;
      overflow: hidden;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      position: relative;
    }
    
    .blog-post-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .blog-post-card-premium:hover .blog-post-image {
      transform: scale(1.05);
    }
    
    .blog-post-image-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      font-size: 4rem;
    }
    
    .blog-post-content {
      padding: 2.5rem;
    }
    
    .blog-post-meta-premium {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      color: #6B7280;
    }
    
    .meta-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .meta-item i {
      color: #9CA3AF;
      font-size: 0.85rem;
    }
    
    .meta-separator {
      color: #D1D5DB;
    }
    
    .blog-post-title-premium {
      font-size: 2.5rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 2rem;
      line-height: 1.3;
      letter-spacing: -0.02em;
    }
    
    .blog-post-body {
      margin-bottom: 2.5rem;
    }
    
    .blog-post-body .summernote-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #374151;
    }
    
    .blog-post-body .summernote-content p {
      margin-bottom: 1.5rem;
    }
    
    .blog-post-body .summernote-content h1,
    .blog-post-body .summernote-content h2,
    .blog-post-body .summernote-content h3 {
      color: #111827;
      font-weight: 700;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }
    
    .blog-share-premium {
      padding-top: 2rem;
      border-top: 1px solid #E5E7EB;
      display: flex;
      align-items: center;
      gap: 1.5rem;
      flex-wrap: wrap;
    }
    
    .share-label {
      font-weight: 600;
      color: #111827;
      font-size: 0.95rem;
    }
    
    .share-buttons {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }
    
    .share-btn {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 10px 18px;
      border-radius: 12px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
      border: 1.5px solid transparent;
    }
    
    .share-facebook {
      background: #F0F4FF;
      color: #1877F2;
      border-color: #E0E7FF;
    }
    
    .share-facebook:hover {
      background: #1877F2;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
    }
    
    .share-twitter {
      background: #F0F9FF;
      color: #1DA1F2;
      border-color: #E0F2FE;
    }
    
    .share-twitter:hover {
      background: #1DA1F2;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(29, 161, 242, 0.3);
    }
    
    .share-linkedin {
      background: #F0F4FF;
      color: #0A66C2;
      border-color: #E0E7FF;
    }
    
    .share-linkedin:hover {
      background: #0A66C2;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(10, 102, 194, 0.3);
    }
    
    .disqus-container-premium {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      border: 1.5px solid #F3F4F6;
      margin-top: 2rem;
    }
    
    @media (max-width: 768px) {
      .blog-post-hero-title {
        font-size: 2.25rem;
      }
      
      .blog-post-image-wrapper {
        height: 250px;
      }
      
      .blog-post-content {
        padding: 1.5rem;
      }
      
      .blog-post-title-premium {
        font-size: 1.75rem;
      }
      
      .blog-share-premium {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
@endsection

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ @$details->title }}
  @endif
@endsection

@section('metaKeywords')
  {{ $details->meta_keywords }}
@endsection

@section('metaDescription')
  {{ $details->meta_description }}
@endsection

@section('content')
  <!-- Hero Section Premium -->
  <section class="blog-post-hero-premium">
    <div class="blog-post-hero-container">
      <div class="blog-post-hero-content">
        <nav class="blog-post-breadcrumb">
          <a href="{{ route('index') }}" class="breadcrumb-link">{{ __('Accueil') }}</a>
          <span class="breadcrumb-separator">|</span>
          <span class="breadcrumb-current">{{ __('Détails du Post') }}</span>
        </nav>
        <h1 class="blog-post-hero-title">{{ @$details->title }}</h1>
      </div>
    </div>
  </section>

  <!-- Blog Details Section Premium -->
  <section class="blog-details-section-premium">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <article class="blog-post-card-premium">
            <div class="blog-post-image-wrapper">
              @if (!empty($details->image))
                <img data-src="{{ asset('assets/img/posts/' . $details->image) }}" 
                     alt="{{ $details->title }}" 
                     class="blog-post-image lazyload"
                     onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
              @else
                <div class="blog-post-image-placeholder">
                  <i class="fas fa-newspaper"></i>
                </div>
              @endif
            </div>
            
            <div class="blog-post-content">
              <div class="blog-post-meta-premium">
                <span class="meta-item">
                  <i class="fas fa-calendar-alt"></i>
                  <span>{{ date_format($details->created_at, 'd M Y') }}</span>
                </span>
                <span class="meta-separator">•</span>
                <span class="meta-item">
                  <i class="fas fa-folder"></i>
                  <span>{{ $details->categoryName }}</span>
                </span>
              </div>

              <h2 class="blog-post-title-premium">{{ $details->title }}</h2>
              
              <div class="blog-post-body">
                <div class="summernote-content">{!! replaceBaseUrl($details->content, 'summernote') !!}</div>
              </div>

              <div class="blog-share-premium">
                <span class="share-label">{{ __('Partager') }} :</span>
                <div class="share-buttons">
                  <a href="//www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                    class="share-btn share-facebook" target="_blank" rel="noopener">
                    <i class="fab fa-facebook-f"></i>
                    <span>{{ __('Facebook') }}</span>
                  </a>
                  <a href="//twitter.com/intent/tweet?text={{ urlencode($details->title) }}&amp;url={{ urlencode(url()->current()) }}"
                    class="share-btn share-twitter" target="_blank" rel="noopener">
                    <i class="fab fa-twitter"></i>
                    <span>{{ __('Twitter') }}</span>
                  </a>
                  <a href="//www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ urlencode($details->title) }}"
                    class="share-btn share-linkedin" target="_blank" rel="noopener">
                    <i class="fab fa-linkedin-in"></i>
                    <span>{{ __('LinkedIn') }}</span>
                  </a>
                </div>
              </div>
            </div>
          </article>

          @if ($disqusInfo->disqus_status == 1)
            <div id="disqus_thread" class="disqus-container-premium"></div>
          @endif
        </div>

        @includeIf('frontend.blog.side-bar')
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
    const shortName = '{{ $disqusInfo->disqus_short_name }}';
  </script>
@endsection
