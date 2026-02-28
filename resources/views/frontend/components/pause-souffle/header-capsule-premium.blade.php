{{-- ============================================
     COMPOSANT 1: Header Capsule Premium
     Accès discret "Pause Souffle" visible partout (desktop + mobile)
     Design: capsule discrète, coins arrondis, ombre douce
     ============================================ --}}
<a href="{{ route('presence.pause-souffle') }}" class="pause-souffle-header-capsule-premium" aria-label="Faire une Pause Souffle">
  <span class="pause-souffle-header-capsule-premium__text">Pause Souffle</span>
</a>

<style>
  .pause-souffle-header-capsule-premium {
    display: inline-flex;
    align-items: center;
    padding: 0.65rem 1.25rem;
    background: linear-gradient(135deg, #FFFFFF 0%, #F9FAFB 100%);
    border: 1.5px solid rgba(79, 70, 229, 0.2);
    border-radius: 9999px;
    color: #111827;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    white-space: nowrap;
    box-shadow: 
      0 8px 24px rgba(79, 70, 229, 0.15),
      0 0px 16px rgba(124, 58, 237, 0.1),
      inset 0 1px 2px rgba(255, 255, 255, 0.5);
    line-height: 1;
    position: relative;
    overflow: hidden;
  }

  .pause-souffle-header-capsule-premium::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.05) 100%);
    border-radius: 9999px;
  }
  
  .pause-souffle-header-capsule-premium:hover {
    background: linear-gradient(135deg, #F5F3FF 0%, #FAFBFF 100%);
    border-color: rgba(79, 70, 229, 0.5);
    color: #4F46E5;
    box-shadow: 
      0 16px 40px rgba(79, 70, 229, 0.3),
      0 0px 24px rgba(124, 58, 237, 0.2),
      inset 0 1px 2px rgba(255, 255, 255, 0.6);
    text-decoration: none;
    transform: translateY(-2px) scale(1.03);
  }
  
  .pause-souffle-header-capsule-premium:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
    text-decoration: none;
  }
  
  .pause-souffle-header-capsule-premium__text {
    display: inline-block;
  }
  
  @media (max-width: 768px) {
    .pause-souffle-header-capsule-premium {
      padding: 0.375rem 0.75rem;
      font-size: 0.8125rem;
    }
  }
</style>
