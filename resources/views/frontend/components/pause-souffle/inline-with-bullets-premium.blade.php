{{-- ============================================
     COMPOSANT INLINE avec bullets: Pause Souffle sans encadré
     Variante avec 3 micro-phrases pour /home, /services, /services/homeswap
     Design: texte + 3 bullets + CTA + micro-ligne, séparation fine optionnelle
     ============================================ --}}
<div class="pause-souffle-inline-premium">
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
  
  .pause-souffle-inline-premium__signature {
    margin: 0 0 0.75rem 0;
    color: #1F2937;
    font-size: 0.9375rem;
    line-height: 1.6;
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
    display: inline-block;
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
