{{-- Composant C2: Context Module Card - Variante card pour home + services (plus visible + 3 bullets) --}}
<div class="pause-souffle-module-card">
  <div class="pause-souffle-module-card__content">
    <h3 class="pause-souffle-module-card__title">Pause Souffle</h3>
    <p class="pause-souffle-module-card__signature">Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.</p>
    <ul class="pause-souffle-module-card__bullets">
      <li>Clarifier ce qui compte vraiment</li>
      <li>Poser des priorités réalistes</li>
      <li>Choisir une direction cohérente</li>
    </ul>
    <div class="pause-souffle-module-card__actions">
      <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-module-card__cta">Faire une Pause Souffle</a>
      <p class="pause-souffle-module-card__micro">Un rituel court, pour y voir clair.</p>
    </div>
  </div>
</div>

<style>
  .pause-souffle-module-card {
    margin: 2.5rem 0;
    padding: 2rem;
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }
  
  .pause-souffle-module-card__content {
    max-width: 100%;
  }
  
  .pause-souffle-module-card__title {
    margin: 0 0 1rem 0;
    color: #111827;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.3;
  }
  
  .pause-souffle-module-card__signature {
    margin: 0 0 1.5rem 0;
    color: #1F2937;
    font-size: 1rem;
    line-height: 1.6;
  }
  
  .pause-souffle-module-card__bullets {
    margin: 0 0 1.5rem 0;
    padding-left: 1.5rem;
    list-style: disc;
    color: #374151;
    font-size: 0.9375rem;
    line-height: 1.8;
  }
  
  .pause-souffle-module-card__bullets li {
    margin-bottom: 0.5rem;
  }
  
  .pause-souffle-module-card__actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-start;
  }
  
  .pause-souffle-module-card__cta {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: #4F46E5;
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 8px;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  
  .pause-souffle-module-card__cta:hover {
    background: #4338CA;
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
  }
  
  .pause-souffle-module-card__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
  }
  
  .pause-souffle-module-card__micro {
    margin: 0;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.5;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-module-card {
      margin: 2rem 0;
      padding: 1.5rem;
    }
    
    .pause-souffle-module-card__title {
      font-size: 1.25rem;
    }
    
    .pause-souffle-module-card__signature {
      font-size: 0.9375rem;
    }
    
    .pause-souffle-module-card__bullets {
      font-size: 0.875rem;
    }
    
    .pause-souffle-module-card__cta {
      font-size: 0.875rem;
      padding: 0.625rem 1.25rem;
    }
  }
</style>
