{{-- ============================================
     COMPOSANT 3: Module Card Premium
     Variante CARD pour /home et /services
     Design: fond blanc/ivoire, coins arrondis 2xl, ombre douce, 3 bullets
     ============================================ --}}
<div class="pause-souffle-module-card-premium">
  <div class="pause-souffle-module-card-premium__content">
    <h3 class="pause-souffle-module-card-premium__title">Pause Souffle</h3>
    <p class="pause-souffle-module-card-premium__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <ul class="pause-souffle-module-card-premium__bullets">
      <li>Clarifier ce qui compte vraiment</li>
      <li>Poser des priorités réalistes</li>
      <li>Choisir une direction cohérente</li>
    </ul>
    <div class="pause-souffle-module-card-premium__actions">
      <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-module-card-premium__cta">Faire une Pause Souffle</a>
      <p class="pause-souffle-module-card-premium__micro">Un rituel court, pour y voir clair.</p>
    </div>
  </div>
</div>

<style>
  .pause-souffle-module-card-premium {
    margin: 2.5rem 0;
    padding: 2rem;
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    max-width: 100%;
  }
  
  .pause-souffle-module-card-premium__content {
    max-width: 100%;
  }
  
  .pause-souffle-module-card-premium__title {
    margin: 0 0 1rem 0;
    background: linear-gradient(135deg, #111827 0%, #374151 50%, #4B5563 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.5rem;
    font-weight: 900;
    line-height: 1.3;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    letter-spacing: -0.01em;
  }
  
  .pause-souffle-module-card-premium__signature {
    margin: 0 0 1.5rem 0;
    color: #4B5563;
    font-size: 1rem;
    line-height: 1.7;
    font-weight: 500;
  }
  
  .pause-souffle-module-card-premium__bullets {
    margin: 0 0 1.5rem 0;
    padding-left: 1.5rem;
    list-style: disc;
    color: #374151;
    font-size: 0.9375rem;
    line-height: 1.8;
  }
  
  .pause-souffle-module-card-premium__bullets li {
    margin-bottom: 0.5rem;
  }
  
  .pause-souffle-module-card-premium__actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-start;
  }
  
  .pause-souffle-module-card-premium__cta {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.75rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.75rem;
    font-size: 0.9375rem;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 
      0 12px 32px rgba(79, 70, 229, 0.35),
      0 4px 16px rgba(124, 58, 237, 0.2),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
  }

  .pause-souffle-module-card-premium__cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
    transform: translateX(-150%);
    transition: transform 0.6s ease;
  }
  
  .pause-souffle-module-card-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
      0 20px 48px rgba(79, 70, 229, 0.45),
      0 8px 24px rgba(124, 58, 237, 0.3),
      inset 0 1px 2px rgba(255, 255, 255, 0.4);
  }

  .pause-souffle-module-card-premium__cta:hover::before {
    transform: translateX(150%);
  }
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
    transform: translateY(-1px);
  }
  
  .pause-souffle-module-card-premium__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-module-card-premium__micro {
    margin: 0;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-module-card-premium {
      margin: 2rem 0;
      padding: 1.5rem;
      border-radius: 0.875rem;
    }
    
    .pause-souffle-module-card-premium__title {
      font-size: 1.25rem;
    }
    
    .pause-souffle-module-card-premium__signature {
      font-size: 0.9375rem;
    }
    
    .pause-souffle-module-card-premium__bullets {
      font-size: 0.875rem;
    }
    
    .pause-souffle-module-card-premium__cta {
      font-size: 0.875rem;
      padding: 0.625rem 1.25rem;
    }
  }
</style>
