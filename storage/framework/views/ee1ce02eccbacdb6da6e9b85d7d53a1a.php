<?php $__env->startSection('pageHeading'); ?>
    <?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
    <?php if(!empty($seoInfo)): ?>
        <?php echo e($seoInfo->meta_keyword_home); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
    <?php if(!empty($seoInfo)): ?>
        <?php echo e($seoInfo->meta_description_home); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Home-area start-->
    <section class="hero-banner hero-banner_v2 bg-img header-next"
        <?php if(!empty($heroBgImg)): ?> data-bg-img="<?php echo e(asset('assets/img/' . $heroBgImg)); ?>" <?php endif; ?>>
        <div class="container-fluid pe-lg-0">
            <div class="row align-items-center gx-xl-5">
                <div class="col-lg-7">
                    <div class="fluid-left">
                        <div class="banner-content" data-aos="fade-up">
                            <?php if(!empty($heroInfo->title)): ?>
                                <h1 class="title mb-25">
                                    <?php echo e($heroInfo->title); ?>

                                </h1>
                            <?php else: ?>
                                <h1><?php echo e('The Easiest Way to Find & Hire Skills Talent for Projects'); ?></h1>
                            <?php endif; ?>
                            <?php if(!empty($heroInfo->text)): ?>
                                <p class="text"><?php echo e($heroInfo->text); ?></p>
                            <?php else: ?>
                                <p class="text">
                                    <?php echo e('Explore a Diverse World of Skills and Services Offered by Expert Freelancers, Connecting You to the Perfect Match for Your Project Needs.'); ?>

                                </p>
                            <?php endif; ?>
                            <div class="banner-form mt-40">
                                <div class="form-wrapper shadow-md">
                                    <form action="<?php echo e(route('services')); ?>" method="GET">
                                        <div class="input-inline">
                                            <input class="form-control bg-white"
                                                placeholder="<?php echo e(__('e. g. Mobile application')); ?>" type="text"
                                                name="keyword">
                                            <button class="btn btn-lg btn-primary" type="submit"
                                                aria-label="button"><?php echo e(__('Search')); ?></button>
                                        </div>
                                    </form>
                                </div>
                                <?php if(!empty($BasicExtends)): ?>
                                    <?php if(!is_null($BasicExtends->popular_tags)): ?>
                                        <div class="banner-tags mt-15">
                                            <span class="color-dark"><?php echo e(__('Popular Tags') . ' :'); ?></span>
                                            <?php
                                                $tags = explode(',', $BasicExtends->popular_tags);
                                            ?>
                                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a
                                                    href="<?php echo e(route('services', ['keyword' => $tag])); ?>"><?php echo e($tag); ?></a>
                                                <?php if(!$loop->last): ?>
                                                    ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-content">
                        <div class="banner-img" data-aos="fade-up">
                            <?php if(!empty($heroImg)): ?>
                                <img class="lazyload blur-up" data-src="<?php echo e(asset('assets/img/' . $heroImg)); ?>"
                                    alt="Banner Image">
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($heroVideoUrl)): ?>
                            <a href="<?php echo e($heroVideoUrl); ?>" class="video-btn video-btn-white youtube-popup p-absolute"
                                style="margin-left: -50px;" title="<?php echo e(__('Play Video')); ?>">
                                <i class="fas fa-play"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home-area end -->

    <!-- Category-area start -->
    <?php if($secInfo->service_category_section_status == 1): ?>
        <section class="category-area category-area_v2 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title title-center mb-50" data-aos="fade-up">
                            <?php if(!empty($secTitle->category_section_title)): ?>
                                <h2 class="title">
                                    <?php echo e($secTitle->category_section_title); ?>

                                </h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row g-0" data-aos="fade-up">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xxl-3 col-lg-4 col-sm-6 item">
                                    <div class="card border" style="height: 250px;">
                                        <div class="card_icon">
                                            <!-- If use image as icon uncomment below line -->
                                            <img class="lazyload"
                                                data-src="<?php echo e(asset('assets/img/service-categories/' . $category->image)); ?>"
                                                alt="image name here">
                                        </div>
                                        <div class="card_details p-25">
                                            <h4 class="card_title lc-2 mb-15" style="height: 57px;">
                                                <a href="<?php echo e(route('services', ['category' => $category->slug])); ?>"
                                                    target="_self" title="">
                                                    <?php echo e($category->name); ?>

                                                </a>
                                            </h4>
                                            <div class="card_action">
                                                <a href="<?php echo e(route('services', ['category' => $category->slug])); ?>"
                                                    class="btn-text icon-end" title="<?php echo e(__('Show Service Gigs')); ?>"
                                                    target="_self">
                                                    <?php echo e(__('Show Service Gigs')); ?>

                                                    <?php if($currentLanguageInfo->direction == 1): ?>
                                                        <i class="far fa-long-arrow-alt-left"></i>
                                                    <?php else: ?>
                                                        <i class="far fa-long-arrow-alt-right"></i>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Category-area end -->

    <?php
        $position = $currencyInfo->base_currency_symbol_position;
        $symbol = $currencyInfo->base_currency_symbol;
    ?>
    <!-- Service-area start -->
    <?php if(
        $secInfo->featured_services_section_status == 1 &&
            $service_setings->is_service == 1 &&
            count($featuredCategories) == 0): ?>
        <?php $allServiceContents = $serviceCategory->serviceContent; ?>
        <?php if(count($allServiceContents) > 0): ?>
            <section class="service-area bg-primary-light radius-md pt-100 pb-75">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title title-center mb-50" data-aos="fade-up">
                                <?php if(!empty($secTitle->featured_services_section_title)): ?>
                                    <h2 class="title mb-20">
                                        <?php echo e($secTitle->featured_services_section_title); ?>

                                    </h2>
                                <?php endif; ?>
                                <?php if(count($featuredCategories) == 0): ?>
                                    <div class="row text-center">
                                        <div class="col">
                                            <h3 class="mt-3"><?php echo e(__('No Information Found') . '!'); ?></h3>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="tabs-navigation">
                                        <ul class="nav nav-tabs" data-hover="fancyHover">
                                            <?php $__currentLoopData = $featuredCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featuredCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item <?php echo e($loop->first ? 'active' : ''); ?>">
                                                    <button
                                                        class="nav-link hover-effect btn-md radius-sm <?php echo e($loop->first ? 'active' : ''); ?>"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#tab<?php echo e($featuredCategory->slug); ?>"
                                                        type="button"><?php echo e($featuredCategory->name); ?></button>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content" data-aos="fade-up">
                                <?php $__currentLoopData = $featuredCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane slide <?php echo e($loop->first ? 'show active' : ''); ?>"
                                        id="tab<?php echo e($serviceCategory->slug); ?>">

                                        <?php if(count($allServiceContents) == 0): ?>
                                            <div class="row text-center">
                                                <div class="col-lg-12">
                                                    <h4><?php echo e(__('No Service Found') . '!'); ?></h4>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="row">
                                                <?php $__currentLoopData = $allServiceContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $service = $serviceContent->service;
                                                        // review
                                                        $reviewCount = $service->review()->count();
                                                        // wishlist
                                                        if (auth('web')->check() == true) {
                                                            $authUser = auth('web')->user();

                                                            $listedService = $service
                                                                ->wishlist()
                                                                ->where('user_id', $authUser->id)
                                                                ->first();
                                                            $wishlisted = empty($listedService) ? false : true;
                                                        } else {
                                                            $wishlisted = false;
                                                        }
                                                    ?>
                                                    <div class="col-md-6 col-lg-4 col-xl-6">
                                                        <div
                                                            class="row g-0 service_default service_column p-15 border radius-md mb-25 align-items-center">
                                                            <figure class="service_img col-xl-6">
                                                                <a href="<?php echo e(route('service_details', ['slug' => $serviceContent->slug, 'id' => $serviceContent->service_id])); ?>"
                                                                    target="_self" class="lazy-container ratio ratio-2-3">
                                                                    <img class="lazyload"
                                                                        src="<?php echo e(asset('assets/front/images/placeholder.png')); ?>"
                                                                        data-src="<?php echo e(asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image)); ?>"
                                                                        alt="service">
                                                                </a>
                                                            </figure>
                                                            <div class="service_details col-xl-6">
                                                                <div class="authors mb-15">
                                                                    <?php if($service->seller_id != 0): ?>
                                                                        <?php
                                                                            $seller = App\Models\Seller::where(
                                                                                'id',
                                                                                $service->seller_id,
                                                                            )->first();
                                                                        ?>
                                                                        <div class="author">
                                                                            <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"
                                                                                target="_self"
                                                                                title="<?php echo e($seller->username); ?>">
                                                                                <?php if(!is_null($seller->photo)): ?>
                                                                                    <img class="lazyload"
                                                                                        data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>"
                                                                                        alt="Image">
                                                                                <?php else: ?>
                                                                                    <img class="lazyload"
                                                                                        data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>"
                                                                                        alt="Image">
                                                                                <?php endif; ?>
                                                                            </a>
                                                                            <div>
                                                                                <span class="h6 font-sm mb-0">
                                                                                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"
                                                                                        target="_self"
                                                                                        title="<?php echo e($seller->username); ?>">
                                                                                        <?php echo e(strlen($seller->username) > 20 ? mb_substr($seller->username, 0, 20, 'UTF-8') . '..' : $seller->username); ?>

                                                                                    </a>
                                                                                </span>
                                                                                <span class="font-sm">
                                                                                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"
                                                                                        target="_self"
                                                                                        title="<?php echo e($seller->username); ?>">
                                                                                        <?php echo e(strlen(@$seller->seller_info->name) > 20 ? mb_substr(@$seller->seller_info->name, 0, 20, 'UTF-8') . '..' : @$seller->seller_info->name); ?>

                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $admin = App\Models\Admin::first();
                                                                        ?>
                                                                        <div class="author">
                                                                            <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                                                                                target="_self">
                                                                                <?php if(!empty($admin->image)): ?>
                                                                                    <img class="lazyload"
                                                                                        data-src="<?php echo e(asset('assets/img/admins/' . $admin->image)); ?>"
                                                                                        alt="Image">
                                                                                <?php else: ?>
                                                                                    <img class="lazyload"
                                                                                        data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>"
                                                                                        alt="Image">
                                                                                <?php endif; ?>
                                                                            </a>
                                                                            <div>
                                                                                <span class="h6 font-sm mb-0">
                                                                                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                                                                                        target="_self">
                                                                                        <?php echo e($admin->username); ?>

                                                                                    </a>
                                                                                </span>
                                                                                <span class="font-sm">
                                                                                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                                                                                        target="_self">
                                                                                        <?php echo e(strlen($admin->first_name . ' ' . $admin->last_name) > 20 ? mb_substr($admin->first_name . ' ' . $admin->last_name, 0, 20, 'UTF-8') . '..' : $admin->first_name . ' ' . $admin->last_name); ?>

                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <a href="<?php echo e(route('service.update_wishlist', ['slug' => $serviceContent->slug])); ?>"
                                                                        class="btn btn-icon radius-sm wishlist-link"
                                                                        data-tooltip="tooltip" data-bs-placement="top"
                                                                        title="<?php echo e($wishlisted == true ? __('Remove from wishlist') : __('Save to Wishlist')); ?>">
                                                                        <?php if(auth()->guard('web')->check()): ?>
                                                                            <i
                                                                                class="fas fa-heart <?php echo e($wishlisted == true ? 'added-in-wishlist' : ''); ?>"></i>
                                                                        <?php endif; ?>
                                                                        <?php if(auth()->guard('web')->guest()): ?>
                                                                            <i class="fas fa-heart"></i>
                                                                        <?php endif; ?>
                                                                    </a>
                                                                </div>

                                                                <h6 class="service_title lc-2 mb-15">
                                                                    <a href="<?php echo e(route('service_details', ['slug' => $serviceContent->slug, 'id' => $serviceContent->service_id])); ?>"
                                                                        target="_self">
                                                                        <?php echo e(strlen($serviceContent->title) > 45 ? mb_substr($serviceContent->title, 0, 45, 'UTF-8') . '...' : $serviceContent->title); ?>

                                                                    </a>
                                                                </h6>

                                                                <div class="ratings size-md">
                                                                    <div class="rate bg-img"
                                                                        data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>">
                                                                        <div class="rating-icon bg-img"
                                                                            style="width: <?php echo e($service->average_rating * 20); ?>%"
                                                                            data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="ratings-total"><?php echo e($service->average_rating); ?>

                                                                        (<?php echo e($reviewCount); ?>)</span>
                                                                </div>
                                                                <?php
                                                                    $position =
                                                                        $currencyInfo->base_currency_symbol_position;
                                                                    $symbol = $currencyInfo->base_currency_symbol;
                                                                ?>
                                                                <div class="service_bottom-info mt-15 pt-10">
                                                                    <?php if($service->quote_btn_status == 1): ?>
                                                                        <span><?php echo e(__('Request Quote')); ?></span>
                                                                    <?php else: ?>
                                                                        <span><?php echo e(__('Starting At')); ?></span>
                                                                        <span class="font-medium">
                                                                            <?php
                                                                                $currentMinPackagePrice = $service
                                                                                    ->package()
                                                                                    ->where(
                                                                                        'language_id',
                                                                                        $languageId->id,
                                                                                    )
                                                                                    ->min('current_price');
                                                                                $previousPackagePrice = $service
                                                                                    ->package()
                                                                                    ->where(
                                                                                        'language_id',
                                                                                        $languageId->id,
                                                                                    )
                                                                                    ->min('previous_price');
                                                                            ?>
                                                                            <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($currentMinPackagePrice) ? formatPrice('0.00') : formatPrice($currentMinPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                                                            <!--- previous price --->

                                                                            <?php if($previousPackagePrice): ?>
                                                                                <del><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($previousPackagePrice) ? formatPrice(0.0) : formatPrice($previousPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                                                                </del>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="cta-btn text-center mt-15 mb-25">
                                <a href="<?php echo e(route('services')); ?>" class="btn btn-lg btn-primary radius-sm"
                                    title="<?php echo e(__('View More')); ?>" target="_self"><?php echo e(__('View More')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Service-area end -->

    <!-- Testimonial-area start -->
    <?php if($secInfo->testimonials_section_status == 1 && count($testimonials) > 0): ?>
        <section class="testimonial-area testimonial-area_v2 ptb-100">
            <div class="container">
                <div class="section-title title-center mb-50">
                    <?php if(!empty($secTitle->testimonials_section_title)): ?>
                        <h2 class="title">
                            <?php echo e($secTitle->testimonials_section_title); ?>

                        </h2>
                    <?php endif; ?>
                </div>
                <div class="swiper testimonial-slider" id="testimonial-slider-2">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="slider-item radius-md">
                                    <div class="client-img">
                                        <div class="lazy-container radius-sm ratio ratio-1-1">
                                            <img class="lazyload"
                                                src="<?php echo e(asset('assets/front/images/placeholder.png')); ?>"
                                                data-src="<?php echo e(asset('assets/img/clients/' . $testimonial->image)); ?>"
                                                alt="Person Image">
                                        </div>
                                    </div>
                                    <div class="quote">
                                        <p class="text font-lg mb-0">
                                            <?php echo e($testimonial->comment); ?>

                                        </p>
                                    </div>
                                    <div class="client-info">
                                        <h6 class="name mb-0"><?php echo e($testimonial->name); ?></h6>
                                        <span class="designation font-sm"><?php echo e($testimonial->occupation); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-pagination position-relative mt-25" id="testimonial-slider-2-pagination"></div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Testimonial-area end -->

    <!-- Blog-area start -->
    <?php if($secInfo->blog_section_status == 1 && count($posts) > 0): ?>
        <section class="blog-area blog-area_v2 pb-70">
            <div class="container">
                <div class="section-title title-inline mb-50" data-aos="fade-up">
                    <?php if(!empty($secTitle->blog_section_title)): ?>
                        <h2 class="title">
                            <?php echo e($secTitle->blog_section_title); ?>

                        </h2>
                    <?php endif; ?>
                    <a href="<?php echo e(route('blog')); ?>" class="btn btn-lg btn-primary radius-sm"
                        title="<?php echo e(__('Read All Post')); ?>" target="_self"><?php echo e(__('Read All Post')); ?></a>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-xl-4" data-aos="fade-up">
                            <article class="card mb-30 radius-md border">
                                <div class="card_img">
                                    <a href="<?php echo e(route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>"
                                        target="_self" class="lazy-container ratio ratio-2-3">
                                        <img class="lazyload" data-src="<?php echo e(asset('assets/img/posts/' . $post->image)); ?>"
                                            alt="Blog Image">
                                    </a>
                                </div>
                                <div class="card_content p-25">
                                    <ul class="card_list list-unstyled mb-15">
                                        <li class="icon-start">
                                            <a href="#" target="_self"><i
                                                    class="fas fa-user"></i><?php echo e($post->author); ?></a>
                                        </li>
                                        <li class="icon-start">
                                            <a href="<?php echo e(route('blog', ['category' => $post->categorySlug])); ?>"
                                                target="_self" title="<?php echo e($post->categoryName); ?>"><i
                                                    class="fas fa-th-large"></i><?php echo e($post->categoryName); ?></a>
                                        </li>
                                        <li class="icon-start">
                                            <a href="#" target="_self" title=""><i
                                                    class="fas fa-calendar-check"></i><?php echo e($post->created_at->toFormattedDateString()); ?></a>
                                        </li>
                                    </ul>
                                    <h4 class="card_title lc-2 mb-15">
                                        <a href="<?php echo e(route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>"
                                            target="_self" title="">
                                            <?php echo e(strlen($post->title) > 45 ? mb_substr($post->title, 0, 45, 'UTF-8') . '...' : $post->title); ?>

                                        </a>
                                    </h4>
                                    <p class="card_text lc-2">
                                        <?php echo strlen(strip_tags($post->content)) > 100
                                            ? mb_substr(strip_tags($post->content), 0, 100, 'UTF-8') . '...'
                                            : strip_tags($post->content); ?>

                                    </p>
                                    <div class="cta-btn mt-15">
                                        <a href="<?php echo e(route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>"
                                            class="btn-text color-primary" target="_self"
                                            title="<?php echo e(__('READ MORE')); ?>"><?php echo e(__('READ MORE')); ?></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Blog-area end -->

    <!-- Sponsor-area start  -->
    <?php if($secInfo->partners_section_status == 1): ?>
    <?php if(count($partners) > 0): ?>
      <div class="sponsor-area pb-100" data-aos="fade-up">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="swiper sponsor-slider p-30 border radius-md">
                <div class="swiper-wrapper">
                  <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                      <div class="item-single d-flex justify-content-center">
                        <div class="sponsor-img">
                          <a href="<?php echo e($partner->url); ?>" target="_blank">
                            <img class="lazyload" data-src="<?php echo e(asset('assets/img/partners/' . $partner->image)); ?>"
                              alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>
    <!-- Sponsor-area end -->

    <!-- Newsletter-area start -->
    
    <!-- Newsletter-area end -->

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\home\index-v2.blade.php ENDPATH**/ ?>