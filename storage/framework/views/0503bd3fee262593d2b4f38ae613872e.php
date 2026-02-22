<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    /* Service Details Hero Premium */
    .service-details-hero-premium {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      padding: 120px 0 80px;
      position: relative;
      overflow: hidden;
    }
    
    .service-details-hero-premium::before {
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
    
    .service-details-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }
    
    .service-details-hero-content {
      text-align: center;
      color: white;
    }
    
    .service-details-breadcrumb {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 2rem;
      font-size: 0.9rem;
    }
    
    .service-details-breadcrumb a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .service-details-breadcrumb a:hover {
      color: white;
    }
    
    .service-details-breadcrumb .separator {
      color: rgba(255, 255, 255, 0.6);
    }
    
    .service-details-breadcrumb .current {
      color: rgba(255, 255, 255, 0.8);
    }
    
    .service-details-hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      color: white;
      line-height: 1.2;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      margin: 0;
      letter-spacing: -0.02em;
    }
    
    /* Service Details Section Premium */
    .gig-details-section {
      padding: 80px 0;
      background: #F9FAFB;
    }
    
    .gig-details-wrapper {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      border: 1.5px solid #F3F4F6;
      margin-bottom: 2rem;
    }
    
    /* Slider Premium */
    .gig-slider-wrap {
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 2rem;
    }
    
    .gigs-big-slider .single-item img {
      border-radius: 20px;
      width: 100%;
      height: 500px;
      object-fit: cover;
    }
    
    /* Buttons Premium */
    .group-btn {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }
    
    .wishlist-link,
    .video-popup,
    .btn-outline {
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      border: 1.5px solid #E5E7EB;
      background: white;
      color: #6B7280;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .wishlist-link:hover,
    .video-popup:hover,
    .btn-outline:hover {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }
    
    .wishlist-link i {
      color: #ef4444;
    }
    
    .wishlist-link:hover i {
      color: white;
    }
    
    /* Service Title Premium */
    .service-title-wrap {
      padding: 2rem 0;
      border-bottom: 1px solid #E5E7EB;
      margin-bottom: 2rem;
    }
    
    .service-title h3 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1.5rem;
      line-height: 1.3;
      letter-spacing: -0.02em;
    }
    
    .service-category {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
    }
    
    .category-tag {
      display: inline-block;
      padding: 6px 14px;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      color: #1e40af;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }
    
    .category-tag:hover {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      transform: translateY(-2px);
    }
    
    .ratings {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    /* Tabs Premium */
    .description-tabs {
      margin-bottom: 2rem;
    }
    
    .description-tabs .nav-tabs {
      border-bottom: 2px solid #E5E7EB;
      display: flex;
      gap: 0.5rem;
    }
    
    .description-tabs .nav-link {
      padding: 14px 24px;
      border: none;
      border-radius: 12px 12px 0 0;
      background: transparent;
      color: #6B7280;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      position: relative;
      margin-bottom: -2px;
    }
    
    .description-tabs .nav-link:hover {
      color: #1e40af;
      background: rgba(30, 64, 175, 0.05);
    }
    
    .description-tabs .nav-link.active {
      color: #1e40af;
      background: white;
      border-bottom: 3px solid;
      border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
    }
    
    .tab-content {
      padding: 2rem 0;
    }
    
    .summernote-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #374151;
    }
    
    .summernote-content p {
      margin-bottom: 1.5rem;
    }
    
    /* Reviews Premium */
    .gigs-review-area {
      padding: 1.5rem 0;
    }
    
    .review_user {
      display: flex;
      gap: 1.5rem;
      padding: 1.5rem;
      background: #F9FAFB;
      border-radius: 16px;
      margin-bottom: 1.5rem;
      border: 1px solid #E5E7EB;
    }
    
    .review_user .image {
      flex-shrink: 0;
    }
    
    .review_user .image img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    .review_user .content {
      flex: 1;
    }
    
    .review_user .rating {
      list-style: none;
      padding: 0;
      margin: 0 0 0.5rem 0;
      display: flex;
      gap: 0.25rem;
    }
    
    .review_user .rating i {
      color: #FBBF24;
      font-size: 0.9rem;
    }
    
    .review_user .content span {
      color: #6B7280;
      font-size: 0.9rem;
      margin-bottom: 0.75rem;
      display: block;
    }
    
    .review_user .content p {
      color: #374151;
      margin: 0;
      line-height: 1.6;
    }
    
    /* FAQ Premium */
    .faq-wrapper .accordion-item {
      border: 1.5px solid #E5E7EB;
      border-radius: 12px;
      margin-bottom: 1rem;
      overflow: hidden;
    }
    
    .faq-wrapper .accordion-button {
      background: white;
      color: #111827;
      font-weight: 600;
      padding: 1.25rem;
      border: none;
      box-shadow: none;
    }
    
    .faq-wrapper .accordion-button:not(.collapsed) {
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%);
      color: #1e40af;
    }
    
    .faq-wrapper .accordion-button::after {
      background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%231e40af' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
    }
    
    .faq-wrapper .accordion-body {
      padding: 1.25rem;
      color: #374151;
      line-height: 1.7;
    }
    
    /* Sidebar Premium */
    .gigs-sidebar {
      position: sticky;
      top: 120px;
    }
    
    .packages-widgets,
    .seller-widgets {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      border: 1.5px solid #F3F4F6;
      margin-bottom: 2rem;
    }
    
    .packages-tabs .nav-tabs {
      border-bottom: 2px solid #E5E7EB;
      display: flex;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }
    
    .packages-tabs .nav-link {
      padding: 10px 16px;
      border: none;
      border-radius: 10px 10px 0 0;
      background: transparent;
      color: #6B7280;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      margin-bottom: -2px;
    }
    
    .packages-tabs .nav-link:hover {
      color: #1e40af;
      background: rgba(30, 64, 175, 0.05);
    }
    
    .packages-tabs .nav-link.active {
      color: #1e40af;
      background: white;
      border-bottom: 3px solid;
      border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
    }
    
    .packages-content h3 {
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #E5E7EB;
    }
    
    .packages-content .title {
      font-size: 1rem;
      font-weight: 600;
      color: #6B7280;
    }
    
    .packages-content .price {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .packages-content .pre-price {
      font-size: 1.25rem;
      color: #9CA3AF;
      text-decoration: line-through;
      margin-left: 0.5rem;
    }
    
    .packages-footer .btn-primary {
      width: 100%;
      padding: 14px 24px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }
    
    .packages-footer .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
    }
    
    .seller-widgets .title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid;
      border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
    }
    
    .seller {
      display: flex;
      gap: 1rem;
      align-items: center;
      margin-bottom: 1.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #E5E7EB;
    }
    
    .seller-img img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #E5E7EB;
      transition: all 0.3s ease;
    }
    
    .seller-img:hover img {
      border-color: #1e40af;
      transform: scale(1.05);
    }
    
    .seller-info h6 a {
      color: #111827;
      text-decoration: none;
      font-weight: 700;
      font-size: 1.1rem;
      transition: color 0.3s ease;
    }
    
    .seller-info h6 a:hover {
      color: #1e40af;
    }
    
    .toggle-list {
      list-style: none;
      padding: 0;
      margin: 0 0 1.5rem 0;
    }
    
    .toggle-list li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #F3F4F6;
    }
    
    .toggle-list li:last-child {
      border-bottom: none;
    }
    
    .toggle-list .first {
      color: #6B7280;
      font-size: 0.95rem;
    }
    
    .toggle-list .last {
      color: #111827;
      font-weight: 600;
    }
    
    .seller-widgets .btn-primary {
      width: 100%;
      padding: 14px 24px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }
    
    .seller-widgets .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
    }
    
    .skills .skill a {
      display: inline-block;
      padding: 8px 16px;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      color: #1e40af;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      margin: 0.25rem;
      transition: all 0.3s ease;
    }
    
    .skills .skill a:hover {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      transform: translateY(-2px);
    }
    
    @media (max-width: 991px) {
      .gigs-sidebar {
        position: static;
        margin-top: 2rem;
      }
      
      .service-details-hero-title {
        font-size: 2.25rem;
      }
      
      .gig-details-wrapper {
        padding: 1.5rem;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php
  $title = $pageHeading->service_details_page_title ?? __('Service Details');
?>
<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e(@$details->title); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($details->meta_keywords); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e($details->meta_description); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Service Details Hero Premium -->
  <section class="service-details-hero-premium">
    <div class="service-details-hero-container">
      <div class="service-details-hero-content">
        <nav class="service-details-breadcrumb">
          <a href="<?php echo e(route('index')); ?>"><?php echo e(__('Accueil')); ?></a>
          <span class="separator">|</span>
          <span class="current"><?php echo e(__('Détails du Service')); ?></span>
        </nav>
        <h1 class="service-details-hero-title"><?php echo e($details->title); ?></h1>
      </div>
    </div>
  </section>

  <!-- Service Details Section Premium -->
  <section class="gig-details-section">
    <div class="container">
      <div class="row gx-xl-5">
        <div class="col-lg-8">
          <div class="gig-details-wrapper">

            <div class="gig-slider-wrap mb-30">
              <div class="gigs-big-slider">
                <?php $sldImgs = json_decode($details->slider_images); ?>
                <?php $__currentLoopData = $sldImgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="single-item">
                    <a href="<?php echo e(asset('assets/img/services/slider-images/' . $img)); ?>" class="service-slider-image">
                      <img data-src="<?php echo e(asset('assets/img/services/slider-images/' . $img)); ?>" alt="image"
                        class="lazyload">
                    </a>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <div class="gigs-thumbs-slider">
                <?php $__currentLoopData = $sldImgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="single-item">
                    <img data-src="<?php echo e(asset('assets/img/services/slider-images/' . $img)); ?>" alt="image"
                      class="lazyload">
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

            <!-- Action Buttons Premium -->
            <div class="group-btn mb-40 justify-content-center">
              <a href="<?php echo e(route('service.update_wishlist', ['slug' => $details->slug])); ?>"
                class="wishlist-link" data-element_type="button">
                <i class="fas fa-heart"></i>
                <span>
                  <?php if(auth()->guard('web')->check()): ?>
                    <?php if($wishlisted == true): ?>
                      <?php echo e(__('Retirer de la liste')); ?>

                    <?php else: ?>
                      <?php echo e(__('Ajouter à la liste de souhaits')); ?>

                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if(auth()->guard('web')->guest()): ?>
                    <?php echo e(__('Ajouter à la liste de souhaits')); ?>

                  <?php endif; ?>
                </span>
              </a>
              <?php if(!is_null($details->video_preview_link)): ?>
                <a href="<?php echo e($details->video_preview_link); ?>"
                  class="video-popup">
                  <i class="fas fa-video"></i> 
                  <span><?php echo e(__('Aperçu vidéo')); ?></span>
                </a>
              <?php endif; ?>
              <?php if(!is_null($details->live_demo_link)): ?>
                <a href="<?php echo e($details->live_demo_link); ?>" class="btn-outline" target="_blank">
                  <i class="fas fa-external-link-alt"></i> 
                  <span><?php echo e(__('Démo en direct')); ?></span>
                </a>
              <?php endif; ?>
            </div>

            <div class="service-title-wrap mb-40">
              <div class="service-title">
                <h3 class="mb-15"><?php echo e($details->title); ?></h3>
              </div>

              <div class="service-category pt-15 border-top justify-content-lg-between">
                <?php if($details->category_name): ?>
                  <div>
                    <span class="text-muted" style="font-size: 0.9rem; margin-right: 0.5rem;"><?php echo e(__('Catégorie')); ?> :</span>
                    <div class="categories" style="display: inline-flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                      <a class="category-tag" href="<?php echo e(route('services', ['category' => $details->category_name])); ?>">
                        <?php echo e($details->category_name); ?>

                      </a>
                      <?php if($details->category_name && $details->sub_category_name): ?>
                        <i class="fas fa-chevron-right" style="color: #9CA3AF; font-size: 0.75rem;"></i>
                        <a class="category-tag"
                          href="<?php echo e(route('services', ['category' => $details->category_name, 'subcategory' => $details->sub_category_name])); ?>">
                          <?php echo e($details->sub_category_name); ?>

                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="ratings size-md" style="display: flex; align-items: center; gap: 0.75rem;">
                  <span class="text-muted" style="font-size: 0.9rem;"><?php echo e(__('Évaluation')); ?> :</span>
                  <div class="rate bg-img" data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>" style="width: 100px; height: 18px; position: relative;">
                    <div class="rating-icon bg-img" style="width: <?php echo e($details->average_rating * 20); ?>%; height: 100%; position: absolute; top: 0; left: 0;"
                      data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>"></div>
                  </div>
                  <?php
                    $reviewCount = $details->review()->count();
                  ?>
                  <span class="ratings-total" style="color: #6B7280; font-size: 0.9rem;">(<?php echo e($reviewCount); ?>)</span>
                </div>
              </div>
            </div>

            <div class="description-wrap">
              <div class="description-tabs">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" data-bs-toggle="tab"
                      data-bs-target="#description"><?php echo e(__('Description')); ?></button>
                  </li>
                  <li class="nav-item">
                    <button type="button"class="nav-link" data-bs-toggle="tab"
                      data-bs-target="#reviews"><?php echo e(__('Reviews')); ?></button>
                  </li>
                  <li class="nav-item">
                    <button type="button"class="nav-link" data-bs-toggle="tab"
                      data-bs-target="#faq"><?php echo e(__('FAQ')); ?></button>
                  </li>
                </ul>
              </div>

              <div class="tab-content">
                <div class="tab-pane show active" id="description">
                  <div class="content-box summernote-content">
                    <?php echo replaceBaseUrl($details->description, 'summernote'); ?>

                  </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                  <div class="gigs-review-area">
                    <?php if(count($reviews) == 0): ?>
                      <h5 class="mb-25"><?php echo e(__('This service has no review yet') . '!'); ?></h5>
                    <?php else: ?>
                      <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="review_user">
                          <div class="image">
                            <?php if(empty($review->user->image)): ?>
                              <img data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image" class="lazyload">
                            <?php else: ?>
                              <img data-src="<?php echo e(asset('assets/img/users/' . $review->user->image)); ?>" alt="image"
                                class="lazyload">
                            <?php endif; ?>
                          </div>

                          <div class="content">
                            <ul class="rating">
                              <?php for($i = 0; $i < $review->rating; $i++): ?>
                                <li><i class="fas fa-star"></i></li>
                              <?php endfor; ?>
                            </ul>

                            <?php
                              $username = $review->user->username;
                              $date = date_format($review->created_at, 'F d, Y');
                            ?>

                            <span><span><?php echo e($username == '' ? __('User') : $username); ?></span><?php echo e(' – ' . $date); ?></span>
                            <p><?php echo e($review->comment); ?></p>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(auth()->guard('web')->guest()): ?>
                      <a href="<?php echo e(route('user.login')); ?>" class="btn btn-lg btn-primary radius-sm"><?php echo e(__('Login')); ?></a>
                    <?php endif; ?>

                    <?php if(auth()->guard('web')->check()): ?>
                      <div class="review_form">
                        <form action="<?php echo e(route('service.store_review', ['id' => $details->id])); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                          <div class="form-group">
                            <label><?php echo e(__('Rating') . '*'); ?></label>
                            <ul class="rating">
                              <li class="review-value review-1" data-ratingVal="1">
                                <span class="fas fa-star"></span>
                              </li>

                              <li class="review-value review-2" data-ratingVal="2">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                              </li>

                              <li class="review-value review-3" data-ratingVal="3">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                              </li>

                              <li class="review-value review-4" data-ratingVal="4">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                              </li>

                              <li class="review-value review-5" data-ratingVal="5">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                              </li>
                            </ul>
                          </div>

                          <input type="hidden" id="rating-id" name="rating">

                          <div class="form-group">
                            <label><?php echo e(__('Comment')); ?></label>
                            <textarea class="form-control" name="comment" placeholder="<?php echo e(__('Write your comment here') . '...'); ?>"><?php echo e(old('comment')); ?></textarea>
                          </div>

                          <div class="form_button">
                            <button type="submit" class="btn btn-lg btn-primary radius-sm" style="background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); border: none; padding: 12px 24px; border-radius: 12px; color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3); transition: all 0.3s ease;">
                              <?php echo e(__('Soumettre')); ?>

                            </button>
                          </div>
                        </form>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="tab-pane fade" id="faq">
                  <?php if(count($faqs) == 0): ?>
                    <h4 class="text-center mt-5"><?php echo e(__('No FAQ Found') . '!'); ?></h4>
                  <?php else: ?>
                    <div class="faq-wrapper">
                      <div class="accordion" id="accordionExample">
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="accordion-item border radius-md mb-20">
                            <h6 class="accordion-header" id="<?php echo e('heading-' . $faq->id); ?>">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="<?php echo e('#collapse-' . $faq->id); ?>"
                                aria-expanded="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                                aria-controls="<?php echo e('collapse-' . $faq->id); ?>">
                                <?php echo e($faq->question); ?>

                              </button>
                            </h6>
                            <div id="<?php echo e('collapse-' . $faq->id); ?>"
                              class="accordion-collapse collapse <?php echo e($loop->first ? 'show' : ''); ?>"
                              aria-labelledby="<?php echo e('heading-' . $faq->id); ?>" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                <p><?php echo e($faq->answer); ?></p>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <?php if($details->quote_btn_status == 1): ?>
            <form action="<?php echo e(route('service.payment_form.check', ['slug' => $details->slug, 'id' => $details->id])); ?>"
              method="GET">
              <input type="hidden" name="form_id" value="<?php echo e($details->form_id); ?>">
              <input type="hidden" name="quote_btn_status" value="<?php echo e($details->quote_btn_status); ?>">
              <button type="submit" class="btn btn-lg btn-primary radius-sm mb-4 w-100" style="background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); border: none; padding: 14px 24px; border-radius: 12px; color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3); transition: all 0.3s ease;">
                <i class="fas fa-calendar-plus"></i> <?php echo e(__('Demander un devis')); ?>

              </button>
            </form>
          <?php else: ?>
            <div class="gigs-sidebar pb-10">
              <?php if(count($packages) == 0): ?>
                <div class="alert alert-danger text-center" role="alert">
                  <?php echo e(__('No Package Available') . '!'); ?>

                </div>
              <?php else: ?>
                <div class="packages-widgets mb-40">
                  <div class="packages-tabs">
                    <ul class="nav nav-tabs">
                      <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                          <button type="button" class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>"
                            data-bs-toggle="tab" data-bs-target="<?php echo e('#package-' . $package->id); ?>">
                            <?php echo e($package->name); ?>

                          </button>
                        </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>

                  <div class="tab-content">
                    <?php
                      $position = $currencyInfo->base_currency_symbol_position;
                      $symbol = $currencyInfo->base_currency_symbol;
                    ?>

                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="tab-pane <?php echo e($loop->first ? 'active show' : ''); ?> fade"
                        id="<?php echo e('package-' . $package->id); ?>">
                        <div class="packages-content-wrap">

                          <form id="<?php echo e('package-form-' . $package->id); ?>"
                            action="<?php echo e(route('service.payment_form', ['slug' => $details->slug, 'id' => $details->id])); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                            <input type="hidden" name="form_id" value="<?php echo e($details->form_id); ?>">
                            <input type="hidden" name="quote_btn_status" value="<?php echo e($details->quote_btn_status); ?>">
                            <div class="packages-content">
                              <h3>
                                <span class="title"><?php echo e(__('Price')); ?></span>
                                <span class="price"><?php echo e($position == 'left' ? $symbol : ''); ?>

                                  <span id="<?php echo e('package-' . $package->id . '-price'); ?>">
                                    <?php echo e(formatPrice($package->current_price)); ?>

                                  </span><?php echo e($position == 'right' ? $symbol : ''); ?>

                                  <?php if(!empty($package->previous_price)): ?>
                                    <span class="pre-price">
                                      <?php echo e($position == 'left' ? $symbol : ''); ?>

                                      <span id="<?php echo e('package-' . $package->id . '-prev_price'); ?>">
                                        <?php echo e(formatPrice($package->previous_price)); ?>

                                      </span><?php echo e($position == 'right' ? $symbol : ''); ?>

                                    </span>
                                  <?php endif; ?>
                                </span>
                              </h3>

                              <?php if(!empty($package->delivery_time) || !empty($package->number_of_revision)): ?>
                                <span class="additional-info">
                                  <?php if(!empty($package->delivery_time)): ?>
                                    <span class="delivery"><i class="far fa-clock"></i><?php echo e($package->delivery_time); ?>

                                      <?php echo e($package->delivery_time > 1 ? __('Days Delivery') : __('Day Delivery')); ?></span>
                                  <?php endif; ?>
                                  <?php if(!empty($package->number_of_revision)): ?>
                                    <span class="revisions"><i
                                        class="far fa-sync-alt"></i><?php echo e($package->number_of_revision); ?>

                                      <?php echo e($package->number_of_revision > 1 ? __('Revisions') : __('Revision')); ?></span>
                                  <?php endif; ?>
                                </span>
                              <?php endif; ?>
                              <?php $features = explode(PHP_EOL, $package->features); ?>
                              <ul class="features list-unstyled mt-10">
                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li class="feature check-icon"><?php echo e($feature); ?>

                                  </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                              <?php if(count($addons) > 0): ?>
                                <h3 class="title mb-2"><span class="title"><?php echo e(__('Addons')); ?></span></h3>
                                <ul class="addons list-unstyled">
                                  <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex flex-row">
                                      <input type="checkbox"
                                        class="<?php echo e($currentLanguageInfo->direction == 0 ? 'me-3' : 'ms-3'); ?> service-addon"
                                        name="addons[]" value="<?php echo e($addon->id); ?>"
                                        data-addon_price="<?php echo e($addon->price); ?>" data-package_id="<?php echo e($package->id); ?>">
                                      <li class="addon"><?php echo e($addon->name); ?>

                                        <span>(<span class="text-danger">+</span>
                                          <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($addon->price)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>)</span>
                                      </li>
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                              <?php endif; ?>
                            </div>
                          </form>

                          <div class="packages-footer mt-20">
                            <button type="submit" class="btn btn-lg btn-primary radius-sm"
                              form="<?php echo e('package-form-' . $package->id); ?>">
                              <?php echo e(__('Checkout')); ?>

                            </button>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="gigs-sidebar pb-10">
            <?php if($details->seller_id != 0): ?>
              <?php
                $seller = App\Models\Seller::where('id', $details->seller_id)->first();
              ?>
              <div class="seller-widgets mb-40">
                <h4 class="title mb-20"><?php echo e(__('About The Seller')); ?></h4>
                <div class="seller mb-20">
                  <div class="seller-img">
                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>">
                      <?php if(!is_null($seller->photo)): ?>
                        <img data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>" alt="image"
                          class="lazyload">
                      <?php else: ?>
                        <img data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image" class="lazyload">
                      <?php endif; ?>
                    </a>
                  </div>
                  <?php
                    $sellerInfo = $seller
                        ->seller_info()
                        ->where('language_id', $currentLanguageInfo->id)
                        ->first();
                  ?>
                  <div class="seller-info">
                    <h6 class="mb-0"><a
                        href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"><?php echo e($seller->username); ?></a>
                    </h6>
                    <span class="font-xsm"><?php echo e(@$sellerInfo->name); ?></span>
                    <div class="ratings mt-1">
                      <div class="rate bg-img" data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>">
                        <div class="rating-icon bg-img" style="width: <?php echo e(SellerAvgRating($seller->id) * 20); ?>%;"
                          data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>"></div>
                      </div>
                      <span class="ratings-total font-sm">(<?php echo e(SellerAvgRating($seller->id)); ?>)</span>
                    </div>
                  </div>
                </div>
                <ul class="toggle-list list-unstyled mb-20">
                  <li>
                    <span class="first"><?php echo e(__('Total Services') . ' :'); ?></span>
                    <span class="last h6">
                      <?php
                        $serviceCount = App\Models\ClientService\Service::where([['seller_id', $seller->id], ['service_status', 1]])->count();
                      ?>
                      <?php echo e($serviceCount); ?>

                    </span>
                  </li>
                  <li>
                    <span class="first"><?php echo e(__('Orders Completed') . ' :'); ?></span>
                    <span class="last h6">
                      <?php
                        $orderCount = App\Models\ClientService\ServiceOrder::where([['seller_id', $seller->id], ['order_status', 'completed']])->count();
                      ?>
                      <?php echo e($orderCount); ?>

                    </span>
                  </li>
                  <li>
                    <span class="first"><?php echo e(__('Member since') . ' : '); ?></span>
                    <span class="last h6"><?php echo e(Carbon\Carbon::parse($seller->created_at)->format('dS M Y')); ?></span>
                  </li>
                </ul>
                <a href="javaScript:void(0)" class="btn btn-lg btn-primary radius-sm w-100" data-bs-toggle="modal"
                  data-bs-target="#contactModal" type="button" aria-label="button" style="background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); border: none; padding: 14px 24px; border-radius: 12px; color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3); transition: all 0.3s ease; text-decoration: none; display: block; text-align: center;"><?php echo e(__('Contactez maintenant')); ?></a>


              </div>
            <?php else: ?>
              <?php
                $seller = App\Models\Admin::first();
              ?>
              <div class="seller-widgets mb-40">
                <h4 class="title mb-20"><?php echo e(__('About The Seller')); ?></h4>
                <div class="seller mb-20">
                  <div class="seller-img">
                    <a
                      href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username, 'admin' => true])); ?>">
                      <?php if(!is_null($seller->image)): ?>
                        <img data-src="<?php echo e(asset('assets/img/admins/' . $seller->image)); ?>" alt="image"
                          class="lazyload">
                      <?php else: ?>
                        <img data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image" class="lazyload">
                      <?php endif; ?>
                    </a>
                  </div>
                  <div class="seller-info">
                    <h6 class="mb-0"><?php echo e($seller->username); ?></h6>
                    <span class="font-xsm"><?php echo e(@$seller->first_name . ' ' . $seller->last_name); ?></span>
                  </div>
                </div>
                <ul class="toggle-list list-unstyled mb-20">
                  <li>
                    <span class="first"><?php echo e(__('Total Services') . ' :'); ?></span>
                    <span class="last h6">
                      <?php
                        $serviceCount = App\Models\ClientService\Service::where([['seller_id', 0], ['service_status', 1]])->count();
                      ?>
                      <?php echo e($serviceCount); ?>

                    </span>
                  </li>
                  <li>
                    <span class="first"><?php echo e(__('Orders Completed') . ' :'); ?></span>
                    <span class="last h6">
                      <?php
                        $orderCount = App\Models\ClientService\ServiceOrder::where([['seller_id', null], ['order_status', 'completed']])->count();
                      ?>
                      <?php echo e($orderCount); ?>

                    </span>
                  </li>
                </ul>
                <a href="javaScript:void(0)" class="btn btn-lg btn-primary radius-sm w-100" data-bs-toggle="modal"
                  data-bs-target="#contactModal" type="button" aria-label="button" style="background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); border: none; padding: 14px 24px; border-radius: 12px; color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3); transition: all 0.3s ease; text-decoration: none; display: block; text-align: center;"><?php echo e(__('Contactez maintenant')); ?></a>
              </div>
            <?php endif; ?>
            <?php if(!is_null($details->skills)): ?>
              <div class="seller-widgets mb-40">
                <div class="skills">

                  <?php
                    $selected_skills = json_decode($details->skills);
                  ?>
                  <?php if(!is_null($selected_skills)): ?>
                    <h6><?php echo e(__('Skills')); ?> <?php echo e(__(':')); ?></h6>
                    <div class="skill">
                      <?php $__currentLoopData = $selected_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected_skills): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $skill = App\Models\Skill::where('id', $selected_skills)->first();
                        ?>
                        <?php if($skill): ?>
                          <a href="<?php echo e(route('services', ['skills' => $selected_skills])); ?>">
                            <?php echo e($skill->name); ?>

                          </a>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            <?php endif; ?>
          </div>
          
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Details Section ======-->

  <form class="d-none" action="<?php echo e(route('services')); ?>" method="GET">
    <input type="hidden" id="tag-id" name="tag"
      value="<?php echo e(!empty(request()->input('tag')) ? request()->input('tag') : ''); ?>">
    <button type="submit" id="submitBtn"></button>
  </form>

  <!-- Contact Modal -->
  <div class="modal contact-modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header align-item-center">
          <h4 class="modal-title mb-0" id="contactModalLabel"><?php echo e(__('Contact Now')); ?></h4>
          <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo e(route('seller.contact.message')); ?>" method="POST" id="sellerContactForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="seller_email"
              value="<?php echo e($details->seller_id != 0 ? $seller->recipient_mail : $bs->to_mail); ?>">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mb-20">
                  <input type="text" class="form-control" placeholder="<?php echo e(__('Enter Your Full Name')); ?>"
                    name="name">
                  <p class="text-danger em" id="err_name"></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-20">
                  <input type="email" class="form-control" placeholder="<?php echo e(__('Enter Your Email Address')); ?>"
                    name="email">
                  <p class="text-danger em" id="err_email"></p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-20">
                  <input type="text" class="form-control" placeholder="<?php echo e(__('Enter Subject')); ?>" name="subject">
                  <p class="text-danger em" id="err_subject"></p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-20">
                  <textarea name="message" class="form-control" placeholder="<?php echo e(__('Message')); ?>"></textarea>
                  <p class="text-danger em" id="err_message"></p>
                </div>
              </div>
              <?php if($bs->google_recaptcha_status == 1): ?>
                <div class="col-md-12">
                  <div class="form-group mb-20">
                    <?php echo NoCaptcha::renderJs(); ?>

                    <?php echo NoCaptcha::display(); ?>

                    <p class="text-danger em" id="err_g-recaptcha-response"></p>
                  </div>
                </div>
              <?php endif; ?>
              <div class="col-lg-12 text-center">
                <button class="btn btn-lg btn-primary radius-sm" id="sellerSubmitBtn" type="submit"
                  aria-label="button"><?php echo e(__('Send message')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/seller-contact.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/service.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\service\details.blade.php ENDPATH**/ ?>