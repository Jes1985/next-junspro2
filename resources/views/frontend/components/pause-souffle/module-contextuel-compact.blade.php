{{-- Composant C1: Context Module Compact - Variante compact pour univers + profils (ultra court) --}}
<div class="pause-souffle-module-compact">
  <div class="pause-souffle-module-compact__content">
    <p class="pause-souffle-module-compact__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <div class="pause-souffle-module-compact__actions">
      <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-module-compact__cta">Faire une Pause Souffle</a>
      <p class="pause-souffle-module-compact__micro">Un rituel court, pour y voir clair.</p>
    </div>
  </div>
</div>

<style>
  .pause-souffle-module-compact {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
  }
  
  .pause-souffle-module-compact__content {
    max-width: 100%;
  }
  
  .pause-souffle-module-compact__signature {
    margin: 0 0 1rem 0;
    color: #1F2937;
    font-size: 0.9375rem;
    line-height: 1.6;
  }
  
  .pause-souffle-module-compact__actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-start;
  }
  
  .pause-souffle-module-compact__cta {
    display: inline-block;
    padding: 0.625rem 1.25rem;
    background: #4F46E5;
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  
  .pause-souffle-module-compact__cta:hover {
    background: #4338CA;
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
  }
  
  .pause-souffle-module-compact__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
  }
  
  .pause-souffle-module-compact__micro {
    margin: 0;
    color: #6B7280;
    font-size: 0.8125rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-module-compact {
      margin: 1.5rem 0;
      padding: 1.25rem;
    }
    
    .pause-souffle-module-compact__signature {
      font-size: 0.875rem;
    }
    
    .pause-souffle-module-compact__cta {
      font-size: 0.8125rem;
      padding: 0.5rem 1rem;
    }
  }
</style>
