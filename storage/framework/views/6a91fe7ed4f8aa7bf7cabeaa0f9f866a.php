
<div class="pause-souffle-module-compact-premium">
  <div class="pause-souffle-module-compact-premium__content">
    <p class="pause-souffle-module-compact-premium__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <div class="pause-souffle-module-compact-premium__actions">
      <a href="<?php echo e(route('presence.pause-souffle')); ?>" class="pause-souffle-module-compact-premium__cta">Faire une Pause Souffle</a>
      <p class="pause-souffle-module-compact-premium__micro">Un rituel court, pour y voir clair.</p>
    </div>
  </div>
</div>

<style>
  .pause-souffle-module-compact-premium {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 0.75rem;
    max-width: 100%;
  }
  
  .pause-souffle-module-compact-premium__content {
    max-width: 100%;
  }
  
  .pause-souffle-module-compact-premium__signature {
    margin: 0 0 1rem 0;
    color: #1F2937;
    font-size: 0.9375rem;
    line-height: 1.6;
  }
  
  .pause-souffle-module-compact-premium__actions {
    display: flex;
    flex-direction: row;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
  }
  
  .pause-souffle-module-compact-premium__cta {
    display: inline-block;
    padding: 0.625rem 1.25rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
  }
  
  .pause-souffle-module-compact-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
    transform: translateY(-1px);
  }
  
  .pause-souffle-module-compact-premium__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-module-compact-premium__micro {
    margin: 0;
    color: #6B7280;
    font-size: 0.8125rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-module-compact-premium {
      margin: 1.5rem 0;
      padding: 1.25rem;
    }
    
    .pause-souffle-module-compact-premium__signature {
      font-size: 0.875rem;
    }
    
    .pause-souffle-module-compact-premium__actions {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;
    }
    
    .pause-souffle-module-compact-premium__cta {
      font-size: 0.8125rem;
      padding: 0.5rem 1rem;
      width: 100%;
      text-align: center;
    }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\components\pause-souffle\module-compact-premium.blade.php ENDPATH**/ ?>