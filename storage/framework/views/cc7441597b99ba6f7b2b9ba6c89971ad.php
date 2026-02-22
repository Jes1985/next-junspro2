
<a href="<?php echo e(route('presence.pause-souffle')); ?>" class="pause-souffle-header-capsule-premium" aria-label="Faire une Pause Souffle">
  <span class="pause-souffle-header-capsule-premium__text">Pause Souffle</span>
</a>

<style>
  .pause-souffle-header-capsule-premium {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 9999px;
    color: #111827;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    line-height: 1;
  }
  
  .pause-souffle-header-capsule-premium:hover {
    background: #F9FAFB;
    border-color: #4F46E5;
    color: #4F46E5;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.1);
    text-decoration: none;
  }
  
  .pause-souffle-header-capsule-premium:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-header-capsule-premium__text {
    display: inline-block;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-header-capsule-premium {
      padding: 0.375rem 0.75rem;
      font-size: 0.8125rem;
    }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\components\pause-souffle\header-capsule-premium.blade.php ENDPATH**/ ?>