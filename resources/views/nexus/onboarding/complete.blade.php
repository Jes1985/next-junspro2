@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<style>
  .nx-confetti-wrap { position:fixed; inset:0; pointer-events:none; overflow:hidden; z-index:9999; }

  .nx-complete-actions {
    display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-top:1.75rem;
  }

  .nx-feat-grid {
    display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:.85rem;
    margin-top:1.5rem;
  }

  .nx-feat-card {
    background:#fff; border-radius:16px; padding:1.35rem 1rem; text-align:center;
    border:1px solid #f3f4f6;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
    transition:transform .2s;
  }

  .nx-feat-card:hover { transform:translateY(-3px); }
  .nx-feat-card-icon { font-size:2rem; margin-bottom:.5rem; }
  .nx-feat-card-label { font-size:.875rem; font-weight:600; color:#374151; }
  .nx-feat-card-desc  { font-size:.78rem; color:#9ca3af; margin-top:.2rem; }
</style>
@endsection

@section('content')
<div class="nx-ob-page" style="padding-top:0">

  {{-- Confetti canvas --}}
  <canvas id="nx-confetti" class="nx-confetti-wrap"></canvas>

  <div class="nx-ob-wrap" style="padding-top:3rem">

    {{-- Alerte succès --}}
    @if(session('success'))
      <div class="nx-alert nx-alert-success mb-3">✅ {{ session('success') }}</div>
    @endif

    {{-- Hero --}}
    <div class="nx-complete-hero nx-card" style="border:none;box-shadow:var(--nx-shadow)">

      <div class="nx-complete-icon">✦</div>

      <h1 class="nx-title" style="font-size:2.25rem">Bienvenue dans NEXUS !</h1>
      <p style="font-size:1.05rem;color:#6b7280;max-width:480px;margin:0 auto .5rem">
        Votre profil d'échanges est maintenant <strong style="color:var(--nx-purple)">actif</strong>.
        Vous faites partie de la communauté premium d'échanges de valeur.
      </p>

      {{-- Avatar --}}
      @if($user->image)
        <div style="margin:1.5rem auto 0">
          <img src="{{ asset('storage/img/users/' . $user->image) }}"
            alt="{{ $user->first_name }}"
            style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid var(--nx-purple);display:block;margin:0 auto">
          <div style="font-weight:700;font-size:1rem;color:#111827;margin-top:.5rem;text-align:center">
            {{ $user->first_name }} {{ $user->last_name }}
          </div>
          <div style="font-size:.85rem;color:#9ca3af;text-align:center">Membre NEXUS ✦</div>
        </div>
      @else
        <div style="margin-top:1.25rem; font-weight:700;color:#111827;font-size:1rem;text-align:center">
          {{ $user->first_name }} {{ $user->last_name }}
          <span style="font-size:.85rem;color:#9ca3af;font-weight:400;display:block;margin-top:.2rem">Membre NEXUS ✦</span>
        </div>
      @endif

      {{-- Actions --}}
      <div class="nx-complete-actions">
        <a href="{{ route('nexus.dashboard') }}" class="nx-btn nx-btn-primary" style="padding:1rem 2.5rem;font-size:1rem">
          🚀 Accéder à mon espace NEXUS
        </a>
        <a href="{{ route('nexus.dashboard', ['tab' => 'search']) }}" class="nx-btn nx-btn-ghost">
          🔍 Explorer les échanges
        </a>
      </div>

    </div>

    {{-- Ce que NEXUS vous offre --}}
    <div style="margin-top:2.5rem">
      <h2 style="font-size:1.25rem;font-weight:700;color:#111827;text-align:center;margin-bottom:.25rem">
        Ce qui vous attend
      </h2>
      <p style="text-align:center;color:#6b7280;font-size:.9rem;margin-bottom:0">
        Explorez toutes les fonctionnalités de votre espace NEXUS
      </p>

      <div class="nx-feat-grid">
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">🔍</div>
          <div class="nx-feat-card-label">Recherche avancée</div>
          <div class="nx-feat-card-desc">Trouvez le partenaire d'échange idéal</div>
        </div>
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">💬</div>
          <div class="nx-feat-card-label">Messagerie sécurisée</div>
          <div class="nx-feat-card-desc">Échangez en toute confidentialité</div>
        </div>
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">📅</div>
          <div class="nx-feat-card-label">Agenda partagé</div>
          <div class="nx-feat-card-desc">Planifiez vos échanges facilement</div>
        </div>
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">🏆</div>
          <div class="nx-feat-card-label">Score NEXUS</div>
          <div class="nx-feat-card-desc">Votre réputation grandit à chaque échange</div>
        </div>
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">✦</div>
          <div class="nx-feat-card-label">Matching IA</div>
          <div class="nx-feat-card-desc">Suggestions personnalisées chaque semaine</div>
        </div>
        <div class="nx-feat-card">
          <div class="nx-feat-card-icon">🌍</div>
          <div class="nx-feat-card-label">Communauté mondiale</div>
          <div class="nx-feat-card-desc">Des partenaires dans +50 pays</div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
// Mini confetti
(function() {
  const canvas = document.getElementById('nx-confetti');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors = ['#2563EB','#7C3AED','#EC4899','#F59E0B','#10B981'];
  const pieces = Array.from({length:80}, () => ({
    x: Math.random() * canvas.width,
    y: -20 - Math.random() * 80,
    vx: (Math.random() - .5) * 2,
    vy: 2 + Math.random() * 3,
    color: colors[Math.floor(Math.random() * colors.length)],
    w: 8 + Math.random() * 8,
    h: 4 + Math.random() * 6,
    rot: Math.random() * 360,
    rotV: (Math.random() - .5) * 4,
  }));

  let alive = true;
  let frame = 0;

  function draw() {
    if (!alive) return;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pieces.forEach(p => {
      p.x += p.vx; p.y += p.vy; p.rot += p.rotV;
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot * Math.PI / 180);
      ctx.fillStyle = p.color;
      ctx.globalAlpha = .85;
      ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
      ctx.restore();
    });

    frame++;
    if (frame < 180) requestAnimationFrame(draw); else {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      alive = false;
    }
  }

  draw();
})();
</script>
@endsection
