{{-- ============================================
     COMPOSANT INLINE avec bullets: Pause Souffle sans encadré
     Variante avec 3 micro-phrases pour /home, /services, /services/homeswap
     Design: texte + 3 bullets + CTA + micro-ligne, séparation fine optionnelle
     ============================================ --}}
<div class="pause-souffle-inline-premium">
  <div class="pause-souffle-inline-premium__badge">Service phare</div>
  <h2 class="pause-souffle-inline-premium__title">Pause Souffle</h2>
  <p class="pause-souffle-inline-premium__signature">
    Pause Souffle, c'est un temps pour se poser les bonnes questions avant de passer à l'action.
  </p>
  <ul class="pause-souffle-inline-premium__bullets">
    <li>Clarifier ce qui compte vraiment</li>
    <li>Poser des priorités réalistes</li>
    <li>Choisir une direction cohérente</li>
  </ul>
  <div class="pause-souffle-inline-premium__actions">
    <a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-inline-premium__cta">Faire une Pause Souffle</a>
  </div>
  <p class="pause-souffle-inline-premium__micro">Un rituel court, pour y voir clair.</p>
</div>

<style>
  .pause-souffle-inline-premium {
    margin: 1.5rem 0;
    padding: 0;
    background: transparent;
    border: none;
    max-width: 100%;
  }

  .pause-souffle-inline-premium__badge {
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

  .pause-souffle-inline-premium__badge::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.1) 100%);
    border-radius: 50px;
  }

  .pause-souffle-inline-premium__badge:hover {
    background: linear-gradient(135deg, #6D28D9 0%, #9333EA 100%);
    box-shadow: 
      0 16px 48px rgba(79, 70, 229, 0.5),
      0 0px 28px rgba(124, 58, 237, 0.4),
      inset 0 1px 2px rgba(255, 255, 255, 0.4);
    transform: scale(1.08);
  }

  .pause-souffle-inline-premium__title {
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

  .pause-souffle-inline-premium__signature {
    margin: 0 0 1rem 0;
    color: #4B5563;
    font-size: 0.9375rem;
    line-height: 1.7;
    font-weight: 500;
  }
  
  .pause-souffle-inline-premium__bullets {
    margin: 0 0 1rem 0;
    padding-left: 1.25rem;
    list-style: disc;
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.7;
  }
  
  .pause-souffle-inline-premium__bullets li {
    margin-bottom: 0.375rem;
  }
  
  .pause-souffle-inline-premium__actions {
    margin: 0 0 0.5rem 0;
  }
  
  .pause-souffle-inline-premium__cta {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 0.75rem;
    font-size: 0.9375rem;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    white-space: nowrap;
    vertical-align: baseline;
    box-shadow: 
      0 12px 32px rgba(79, 70, 229, 0.35),
      0 4px 16px rgba(124, 58, 237, 0.2),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
  }

  .pause-souffle-inline-premium__cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
    transform: translateX(-150%);
    transition: transform 0.6s ease;
  }
  
  .pause-souffle-inline-premium__cta:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    text-decoration: none;
    color: #FFFFFF;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 
      0 16px 36px rgba(79, 70, 229, 0.35),
      0 0px 24px rgba(124, 58, 237, 0.25),
      inset 0 1px 2px rgba(255, 255, 255, 0.3);
  }

  .pause-souffle-inline-premium__cta:hover::before {
    transform: translateX(150%);
  }
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
    }
    
    .pause-souffle-inline-premium__bullets {
      font-size: 0.8125rem;
      padding-left: 1rem;
    }
    
    .pause-souffle-inline-premium__cta {
      font-size: 0.8125rem;
      padding: 0.5rem 1rem;
      width: 100%;
      text-align: center;
      display: block;
    }
    
    .pause-souffle-inline-premium__micro {
      font-size: 0.75rem;
    }
  }
</style>
