{{-- ============================================
     COMPOSANT 4: Module Compact Premium
     Variante COMPACT pour univers /services/* + profils
     Design: discret, 1 phrase + CTA + micro-ligne, pas de bullets
     ============================================ --}}
<div class="pause-souffle-module-compact-premium">
  <div class="pause-souffle-module-compact-premium__content">
    <p class="pause-souffle-module-compact-premium__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <div class="pause-souffle-module-compact-premium__actions">
      <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-module-compact-premium__cta">Faire une Pause Souffle</a>
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
    color: #4B5563;
    font-size: 0.9375rem;
    line-height: 1.7;
    font-weight: 500;
  }
  
  .pause-souffle-module-compact-premium__actions {
    display: flex;
    flex-direction: row;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
  }
  
  .pause-souffle-module-compact-premium__cta {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    white-space: nowrap;
    box-shadow: 
      0 12px 32px rgba(79, 70, 229, 0.35),
      0 4px 16px rgba(124, 58, 237, 0.2),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
  }

  .pause-souffle-module-compact-premium__cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
    transform: translateX(-150%);
    transition: transform 0.6s ease;
  }
  
  .pause-souffle-module-compact-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    transform: translateY(-2px) scale(1.03);
    box-shadow: 
      0 16px 36px rgba(79, 70, 229, 0.35),
      0 0px 24px rgba(124, 58, 237, 0.25),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
  }

  .pause-souffle-module-compact-premium__cta:hover::before {
    transform: translateX(150%);
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
