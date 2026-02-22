<div class="col-lg-4">
  <div class="blog-sidebar-premium">
    <!-- Search Widget Premium -->
    <div class="sidebar-widget-premium mb-4">
      <form action="<?php echo e(route('blog')); ?>" method="GET" class="blog-search-form-premium">
        <div class="search-input-wrapper">
          <input type="text" 
                 class="search-input-premium" 
                 placeholder="<?php echo e(__('Rechercher par titre')); ?>" 
                 name="title" 
                 value="<?php echo e(!empty(request()->input('title')) ? request()->input('title') : ''); ?>">
          <input type="hidden" name="category" value="<?php echo e(!empty(request()->input('category')) ? request()->input('category') : ''); ?>">
          <button type="submit" class="search-btn-premium">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>

    <!-- Categories Widget Premium -->
    <?php if(count($categories) > 0): ?>
      <div class="sidebar-widget-premium">
        <h4 class="widget-title-premium"><?php echo e(__('Catégories')); ?></h4>
        <ul class="categories-list-premium">
          <li>
            <a href="#" class="category-link-premium <?php if(empty(request()->input('category'))): ?> active <?php endif; ?>" data-category_slug="">
              <span class="category-name"><?php echo e(__('Tout')); ?></span>
              <span class="category-count"><?php echo e($totalPost); ?></span>
            </a>
          </li>

          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <a href="#" class="category-link-premium <?php if($category->slug == request()->input('category')): ?> active <?php endif; ?>" data-category_slug="<?php echo e($category->slug); ?>">
                <span class="category-name"><?php echo e($category->name); ?></span>
                <span class="category-count"><?php echo e($category->postCount); ?></span>
              </a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>

  
  <form class="d-none" action="<?php echo e(route('blog')); ?>" method="GET">
    <input type="hidden" name="title" value="<?php echo e(!empty(request()->input('title')) ? request()->input('title') : ''); ?>">
    <input type="hidden" id="categoryKey" name="category">
    <button type="submit" id="submitBtn"></button>
  </form>
  
</div>

<style>
  /* Blog Sidebar Premium */
  .blog-sidebar-premium {
    position: sticky;
    top: 120px;
  }
  
  .sidebar-widget-premium {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    border: 1.5px solid #F3F4F6;
  }
  
  /* Search Form Premium */
  .blog-search-form-premium {
    margin: 0;
  }
  
  .search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
  }
  
  .search-input-premium {
    width: 100%;
    padding: 12px 50px 12px 16px;
    border: 1.5px solid #E5E7EB;
    border-radius: 12px;
    font-size: 0.95rem;
    color: #111827;
    background: #F9FAFB;
    transition: all 0.3s ease;
  }
  
  .search-input-premium:focus {
    outline: none;
    border-color: #1e40af;
    background: white;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
  }
  
  .search-btn-premium {
    position: absolute;
    right: 8px;
    width: 36px;
    height: 36px;
    border: none;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .search-btn-premium:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
  }
  
  /* Widget Title Premium */
  .widget-title-premium {
    font-size: 1.1rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 1.25rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid transparent;
    border-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) 1;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .widget-title-premium::before {
    content: '';
    width: 3px;
    height: 16px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    border-radius: 2px;
  }
  
  /* Categories List Premium */
  .categories-list-premium {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .categories-list-premium li {
    margin-bottom: 0.5rem;
  }
  
  .categories-list-premium li:last-child {
    margin-bottom: 0;
  }
  
  .category-link-premium {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-radius: 12px;
    text-decoration: none;
    color: #6B7280;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: 1.5px solid transparent;
  }
  
  .category-link-premium:hover {
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.06) 0%, rgba(124, 58, 237, 0.06) 100%);
    color: #1e40af;
    border-color: rgba(30, 64, 175, 0.2);
  }
  
  .category-link-premium.active {
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.12) 0%, rgba(124, 58, 237, 0.12) 100%);
    color: #1e40af;
    font-weight: 600;
    border-color: rgba(30, 64, 175, 0.3);
  }
  
  .category-name {
    flex: 1;
  }
  
  .category-count {
    background: #F3F4F6;
    color: #6B7280;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    min-width: 32px;
    text-align: center;
    transition: all 0.3s ease;
  }
  
  .category-link-premium:hover .category-count,
  .category-link-premium.active .category-count {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
  }
  
  @media (max-width: 991px) {
    .blog-sidebar-premium {
      position: static;
      margin-top: 2rem;
    }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\blog\side-bar.blade.php ENDPATH**/ ?>