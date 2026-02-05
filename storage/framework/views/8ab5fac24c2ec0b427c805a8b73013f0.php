
<div class="pause-souffle-inline-premium">
  <p class="pause-souffle-inline-premium__signature">
    Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.
    <a href="<?php echo e(route('presence.pause-souffle')); ?>" class="pause-souffle-inline-premium__cta">Faire une Pause Souffle</a>
  </p>
  <p class="pause-souffle-inline-premium__micro">Guidé • Court • Sans engagement</p>
</div>

<style>
  .pause-souffle-inline-premium {
    margin: 1.5rem 0;
    padding: 0;
    background: transparent;
    border: none;
    max-width: 100%;
  }
  
  .pause-souffle-inline-premium__signature {
    margin: 0 0 0.5rem 0;
    color: #1F2937;
    font-size: 0.9375rem;
    line-height: 1.6;
    display: inline;
  }
  
  .pause-souffle-inline-premium__cta {
    display: inline-block;
    margin-left: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
    vertical-align: baseline;
  }
  
  .pause-souffle-inline-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
    transform: translateY(-1px);
  }
  
  .pause-souffle-inline-premium__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-inline-premium__micro {
    margin: 0.25rem 0 0 0;
    color: #6B7280;
    font-size: 0.8125rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-inline-premium {
      margin: 1.25rem 0;
    }
    
    .pause-souffle-inline-premium__signature {
      font-size: 0.875rem;
      display: block;
    }
    
    .pause-souffle-inline-premium__cta {
      margin-left: 0;
      margin-top: 0.5rem;
      display: inline-block;
      font-size: 0.8125rem;
      padding: 0.5rem 1rem;
    }
    
    .pause-souffle-inline-premium__micro {
      font-size: 0.75rem;
    }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/components/pause-souffle/inline-premium.blade.php ENDPATH**/ ?>