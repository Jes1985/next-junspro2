{{-- ============================================
     COMPOSANT INLINE Projects : badge + titre + contenu inline-premium
     Uniquement pour /services/projects — ajoute badge SERVICE PHARE et titre Pause Souffle
     ============================================ --}}
<div class="pause-souffle-inline-projects">
  <div class="pause-souffle-inline-projects__badge">Service phare</div>
  <h2 class="pause-souffle-inline-projects__title">Pause Souffle</h2>
  <p class="pause-souffle-inline-premium__signature">
    Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.
  </p>
  <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-inline-premium__cta">Faire une Pause Souffle</a>
  <p class="pause-souffle-inline-premium__micro">Guidé • A votre rythme • En toute sérénité</p>
</div>

<style>
  .pause-souffle-inline-projects {
    margin: 1.5rem 0;
    padding: 0;
    background: transparent;
    border: none;
    max-width: 100%;
  }
  
  .pause-souffle-inline-projects__badge {
    display: inline-block;
    margin-bottom: 0.5rem;
    padding: 0.5rem 1.1rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    border-radius: 50px;
    box-shadow: 
      0 8px 24px rgba(79, 70, 229, 0.35),
      0 0px 16px rgba(124, 58, 237, 0.25),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
  }

  .pause-souffle-inline-projects__badge::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.1) 100%);
    border-radius: 50px;
  }

  .pause-souffle-inline-projects__badge:hover {
    background: linear-gradient(135deg, #6D28D9 0%, #9333EA 100%);
    box-shadow: 
      0 16px 48px rgba(79, 70, 229, 0.5),
      0 0px 28px rgba(124, 58, 237, 0.4),
      inset 0 1px 2px rgba(255, 255, 255, 0.4);
    transform: scale(1.08);
  }
  
  .pause-souffle-inline-projects__title {
    margin: 0 0 0.75rem 0;
    background: linear-gradient(135deg, #111827 0%, #374151 50%, #4B5563 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2rem;
    font-weight: 900;
    line-height: 1.2;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    letter-spacing: -0.02em;
  }
  
  .pause-souffle-inline-projects . pause-souffle-inline-premium__signature {
    margin: 0 0 1.25rem 0;
    color: #4B5563;
    font-size: 0.9375rem;
    line-height: 1.7;
    display: block;
    font-weight: 500;
  }
  
  .pause-souffle-inline-projects .pause-souffle-inline-premium__cta {
    display: inline-block;
    margin-bottom: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
  }
  
  .pause-souffle-inline-projects .pause-souffle-inline-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
    transform: translateY(-1px);
  }
  
  .pause-souffle-inline-projects .pause-souffle-inline-premium__cta:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-inline-projects .pause-souffle-inline-premium__micro {
    margin: 0.5rem 0 0 0;
    color: #6B7280;
    font-size: 0.8125rem;
    line-height: 1.5;
    font-weight: 500;
    letter-spacing: 0.02em;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-inline-projects {
      margin: 1.25rem 0;
    }
    
    .pause-souffle-inline-projects__badge {
      font-size: 0.6875rem;
      padding: 0.25rem 0.75rem;
    }
    
    .pause-souffle-inline-projects__title {
      font-size: 1.5rem;
    }
    
    .pause-souffle-inline-projects .pause-souffle-inline-premium__signature {
      font-size: 0.875rem;
      display: block;
    }
    
    .pause-souffle-inline-projects .pause-souffle-inline-premium__cta {
      margin-bottom: 0.5rem;
      display: inline-block;
      font-size: 0.8125rem;
      padding: 0.5rem 1rem;
    }
    
    .pause-souffle-inline-projects .pause-souffle-inline-premium__micro {
      font-size: 0.75rem;
    }
  }
</style>
