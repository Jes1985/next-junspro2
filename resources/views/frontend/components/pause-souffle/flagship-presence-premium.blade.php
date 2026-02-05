{{-- ============================================
     COMPOSANT 5: Flagship Présence Premium
     Service phare pour landing univers Présence
     Design: badge "Service phare", titre + phrase + 3 bénéfices + CTA + micro-ligne
     ============================================ --}}
<div class="pause-souffle-flagship-premium">
  <div class="pause-souffle-flagship-premium__badge">Service phare</div>
  <div class="pause-souffle-flagship-premium__content">
    <h2 class="pause-souffle-flagship-premium__title">Pause Souffle</h2>
    <p class="pause-souffle-flagship-premium__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <ul class="pause-souffle-flagship-premium__benefits">
      <li>Clarifier ce qui compte vraiment</li>
      <li>Poser des priorités réalistes</li>
      <li>Choisir une direction cohérente</li>
    </ul>
    <div class="pause-souffle-flagship-premium__actions">
      <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-flagship-premium__cta">Faire une Pause Souffle</a>
      <p class="pause-souffle-flagship-premium__micro">Un rituel court, pour y voir clair.</p>
    </div>
  </div>
</div>

<style>
  .pause-souffle-flagship-premium {
    margin: 3rem 0;
    padding: 2.5rem;
    background: linear-gradient(135deg, #FFFFFF 0%, #F9FAFB 100%);
    border: 1px solid #E5E7EB;
    border-radius: 1.25rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    max-width: 100%;
    position: relative;
  }
  
  .pause-souffle-flagship-premium__badge {
    position: absolute;
    top: -0.75rem;
    left: 2rem;
    padding: 0.375rem 0.875rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-radius: 9999px;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.3);
  }
  
  .pause-souffle-flagship-premium__content {
    max-width: 100%;
    margin-top: 0.5rem;
  }
  
  .pause-souffle-flagship-premium__title {
    margin: 0 0 1rem 0;
    color: #111827;
    font-size: 2rem;
    font-weight: 700;
    line-height: 1.2;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  }
  
  .pause-souffle-flagship-premium__signature {
    margin: 0 0 1.5rem 0;
    color: #1F2937;
    font-size: 1.125rem;
    line-height: 1.7;
  }
  
  .pause-souffle-flagship-premium__benefits {
    margin: 0 0 2rem 0;
    padding-left: 1.5rem;
    list-style: disc;
    color: #374151;
    font-size: 1rem;
    line-height: 1.8;
  }
  
  .pause-souffle-flagship-premium__benefits li {
    margin-bottom: 0.75rem;
  }
  
  .pause-souffle-flagship-premium__actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-start;
  }
  
  .pause-souffle-flagship-premium__cta {
    display: inline-block;
    padding: 0.875rem 1.75rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.5rem;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.2s ease;
  }
  
  .pause-souffle-flagship-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    transform: translateY(-2px);
  }
  
  .pause-souffle-flagship-premium__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-flagship-premium__micro {
    margin: 0;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-flagship-premium {
      margin: 2rem 0;
      padding: 1.75rem;
      border-radius: 1rem;
    }
    
    .pause-souffle-flagship-premium__badge {
      left: 1.5rem;
      font-size: 0.6875rem;
      padding: 0.25rem 0.75rem;
    }
    
    .pause-souffle-flagship-premium__title {
      font-size: 1.5rem;
    }
    
    .pause-souffle-flagship-premium__signature {
      font-size: 1rem;
    }
    
    .pause-souffle-flagship-premium__benefits {
      font-size: 0.9375rem;
    }
    
    .pause-souffle-flagship-premium__cta {
      font-size: 0.9375rem;
      padding: 0.75rem 1.5rem;
    }
  }
</style>
