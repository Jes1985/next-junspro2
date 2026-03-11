@extends('frontend.layout')

@section('pageHeading', $module->title)

@section('style')
<style>
/* ══════════════════════════════════════════════════════
   MODULE PAGE — FORMATION PRATICIEN PAUSE SOUFFLE
   Design: dark/gold, typographie contemplative
   ══════════════════════════════════════════════════════ */
:root {
  --gold:    #c9a84c;
  --gold-l:  #e8d17a;
  --gold-dim: rgba(201,168,76,.15);
  --dark:    #0a0a0a;
  --surf:    #141414;
  --surf2:   #1e1e1e;
  --border:  rgba(201,168,76,.18);
  --text:    #e8e0d0;
  --muted:   rgba(232,224,208,.5);
  --green:   #22c55e;
  --green-dim: rgba(34,197,94,.12);
}

body { background: var(--dark); color: var(--text); }

/* ── Navigation haut ── */
.mod-nav {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 2rem;
  border-bottom: 1px solid var(--border);
  background: var(--surf);
  position: sticky; top: 0; z-index: 50;
}
.mod-nav__back {
  display: flex; align-items: center; gap: .5rem;
  color: var(--muted); font-size: .82rem; text-decoration: none;
  transition: color .2s;
}
.mod-nav__back:hover { color: var(--text); }
.mod-nav__title {
  font-size: .85rem; font-weight: 600; color: var(--gold);
  text-align: center; flex: 1; padding: 0 1rem;
}
.mod-nav__progress {
  font-size: .78rem; color: var(--muted); white-space: nowrap;
}

/* ── Hero du module ── */
.mod-hero {
  background: linear-gradient(135deg, #120c00 0%, #0a0a0a 60%, #080812 100%);
  border-bottom: 1px solid var(--border);
  padding: 3rem 2rem 2.5rem;
  text-align: center;
}
.mod-hero__eyebrow {
  font-size: .72rem; letter-spacing: .18em; text-transform: uppercase;
  color: var(--gold); margin-bottom: .8rem;
}
.mod-hero__num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--gold-dim); border: 1.5px solid var(--gold);
  font-size: 1.6rem; font-weight: 800; color: var(--gold);
  margin: 0 auto 1.25rem;
}
.mod-hero__title {
  font-size: clamp(1.5rem, 4vw, 2.2rem); font-weight: 700;
  color: #fff; margin: 0 0 .6rem; line-height: 1.25;
}
.mod-hero__week {
  font-size: .85rem; color: var(--muted); margin: 0 0 1.5rem;
}

/* Barre de progression activités */
.mod-hero__progress {
  max-width: 320px; margin: 0 auto;
}
.mod-hero__progress-label {
  display: flex; justify-content: space-between;
  font-size: .76rem; color: var(--muted); margin-bottom: .4rem;
}
.mod-hero__progress-track {
  height: 5px; background: rgba(255,255,255,.08); border-radius: 3px; overflow: hidden;
}
.mod-hero__progress-fill {
  height: 100%; border-radius: 3px;
  background: linear-gradient(90deg, var(--gold), var(--gold-l));
  transition: width .5s ease;
}

/* ── Contenu principal ── */
.mod-body {
  max-width: 740px; margin: 0 auto; padding: 0 1.5rem 4rem;
}

/* Lecteur audio */
.mod-audio {
  margin: 2.5rem 0;
  background: rgba(201,168,76,.07);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 1.4rem 1.8rem;
  display: flex; flex-direction: column; gap: .75rem;
}
.mod-audio__label {
  display: flex; align-items: center; gap: .6rem;
  font-size: .85rem; color: var(--gold); font-weight: 600;
}
.mod-audio audio {
  width: 100%;
  height: 40px;
  border-radius: 8px;
  accent-color: var(--gold);
}
.mod-audio__hint {
  font-size: .74rem; color: var(--muted);
}

/* Intro narrative */
.mod-intro {
  margin: 2.5rem 0;
  padding: 2rem 2.2rem;
  background: var(--surf);
  border-left: 3px solid var(--gold);
  border-radius: 0 12px 12px 0;
  font-size: 1rem; line-height: 1.9;
  color: rgba(232,224,208,.88);
  white-space: pre-line;
}
.mod-intro strong { color: #fff; }

/* Séparateur */
.mod-divider {
  display: flex; align-items: center; gap: 1rem;
  margin: 2.5rem 0;
  color: var(--muted); font-size: .75rem; letter-spacing: .12em; text-transform: uppercase;
}
.mod-divider::before, .mod-divider::after {
  content: ''; flex: 1; height: 1px; background: var(--border);
}

/* ── Activités ── */
.mod-activities { display: flex; flex-direction: column; gap: 1.25rem; }

.mod-activity {
  background: var(--surf);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 14px;
  overflow: hidden;
  transition: border-color .2s;
}
.mod-activity.is-done {
  border-color: rgba(34,197,94,.3);
  background: rgba(34,197,94,.04);
}

.mod-activity__header {
  display: flex; align-items: flex-start; gap: 1rem; padding: 1.2rem 1.4rem;
  cursor: pointer;
}
.mod-activity__icon {
  flex-shrink: 0; width: 44px; height: 44px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem;
  background: rgba(255,255,255,.05);
}
.mod-activity__icon--lecture   { background: rgba(59,130,246,.12); }
.mod-activity__icon--pratique  { background: rgba(16,185,129,.12); }
.mod-activity__icon--ecriture  { background: rgba(245,158,11,.10); }
.mod-activity__icon--exercice  { background: rgba(139,92,246,.12); }
.mod-activity__icon--reflexion { background: rgba(236,72,153,.10); }

.mod-activity__meta { flex: 1; }
.mod-activity__title {
  font-size: .95rem; font-weight: 600; color: #fff; margin: 0 0 .25rem; line-height: 1.3;
}
.mod-activity__tags {
  display: flex; align-items: center; gap: .5rem; flex-wrap: wrap;
}
.mod-activity__tag {
  font-size: .7rem; padding: .18rem .55rem; border-radius: 20px;
  background: rgba(255,255,255,.07); color: var(--muted);
  text-transform: capitalize;
}
.mod-activity__check {
  flex-shrink: 0; margin-top: .1rem;
  width: 22px; height: 22px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  background: rgba(34,197,94,.2); border: 1.5px solid rgba(34,197,94,.5);
  color: #4ade80; font-size: .85rem;
}
.mod-activity__expand {
  flex-shrink: 0; margin-top: .25rem;
  color: var(--muted); font-size: .8rem;
  transition: transform .25s;
}
.mod-activity.is-expanded .mod-activity__expand { transform: rotate(180deg); }

/* Corps de l'activité */
.mod-activity__body {
  display: none;
  padding: 0 1.4rem 1.4rem;
  border-top: 1px solid rgba(255,255,255,.05);
}
.mod-activity.is-expanded .mod-activity__body { display: block; }

.mod-activity__desc {
  font-size: .9rem; color: rgba(232,224,208,.75); line-height: 1.75;
  margin-bottom: 1.2rem; margin-top: 1rem;
}

/* Textarea journal */
.mod-journal-label {
  font-size: .78rem; color: var(--gold); margin-bottom: .45rem;
  display: flex; align-items: center; gap: .4rem;
}
.mod-journal-textarea {
  width: 100%; min-height: 120px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px;
  color: var(--text);
  font-size: .875rem; line-height: 1.65;
  padding: .9rem 1rem;
  resize: vertical;
  outline: none;
  transition: border-color .2s;
  font-family: inherit;
}
.mod-journal-textarea:focus { border-color: rgba(201,168,76,.4); }
.mod-journal-textarea::placeholder { color: rgba(232,224,208,.25); }
.mod-journal-saved {
  font-size: .72rem; color: var(--muted); margin-top: .35rem; height: .9rem;
  transition: opacity .3s;
}

/* Bouton valider activité */
.mod-btn-validate {
  margin-top: 1rem;
  display: inline-flex; align-items: center; gap: .5rem;
  background: linear-gradient(135deg, #1a4a1a, #14391e);
  border: 1.5px solid rgba(34,197,94,.4);
  color: #4ade80; padding: .6rem 1.2rem; border-radius: 10px;
  font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: all .2s;
}
.mod-btn-validate:hover { border-color: rgba(34,197,94,.7); background: rgba(34,197,94,.15); }
.mod-btn-validate.is-done {
  background: rgba(34,197,94,.12);
  border-color: rgba(34,197,94,.3);
  color: #4ade80; cursor: default;
}

/* Guide respiration */
.mod-breath-guide {
  background: rgba(16,185,129,.07);
  border: 1px solid rgba(16,185,129,.2);
  border-radius: 12px;
  padding: 1.25rem;
  margin-bottom: 1rem;
}
.mod-breath-guide__title {
  font-size: .8rem; color: #6ee7b7; margin-bottom: .75rem;
  display: flex; align-items: center; gap: .4rem;
}
.mod-breath-timer-btn {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(16,185,129,.15); border: 1px solid rgba(16,185,129,.3);
  color: #6ee7b7; border-radius: 8px; padding: .5rem 1rem;
  font-size: .82rem; cursor: pointer; transition: all .2s;
}
.mod-breath-timer-btn:hover { background: rgba(16,185,129,.25); }
.mod-breath-display {
  margin-top: .75rem; text-align: center;
  font-size: 1.8rem; font-weight: 700; color: #6ee7b7; letter-spacing: .05em;
  display: none;
}
.mod-breath-phase {
  font-size: .8rem; color: rgba(110,231,183,.7); margin-top: .2rem;
}

/* ── Conclusion ── */
.mod-conclusion {
  margin: 3rem 0 2rem;
  text-align: center;
  padding: 2.5rem 2rem;
  background: linear-gradient(135deg, rgba(201,168,76,.08), rgba(201,168,76,.03));
  border: 1px solid var(--border);
  border-radius: 18px;
}
.mod-conclusion__symbol {
  font-size: 2.2rem; margin-bottom: .75rem; display: block;
}
.mod-conclusion__text {
  font-size: 1.1rem; font-style: italic; color: var(--gold-l); line-height: 1.7;
}

/* ── Navigation prev/next ── */
.mod-nav-bottom {
  display: flex; justify-content: space-between; align-items: center;
  margin-top: 2rem; gap: 1rem; flex-wrap: wrap;
}
.mod-nav-btn {
  display: flex; align-items: center; gap: .5rem;
  padding: .75rem 1.4rem; border-radius: 10px;
  font-size: .85rem; font-weight: 600; text-decoration: none;
  transition: all .2s;
  border: 1.5px solid rgba(255,255,255,.1); color: var(--muted);
  background: var(--surf);
}
.mod-nav-btn:hover { border-color: rgba(201,168,76,.4); color: var(--text); }
.mod-nav-btn--gold {
  background: linear-gradient(135deg, #2d1f00, #1a1200);
  border-color: var(--gold); color: var(--gold);
}
.mod-nav-btn--gold:hover { background: var(--gold-dim); color: var(--gold-l); }

/* ── CTA terminer le module ── */
.mod-complete-wrap {
  margin-top: 2.5rem;
  background: var(--surf);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 1.8rem 2rem;
  text-align: center;
}
.mod-complete-wrap h3 {
  font-size: 1.05rem; color: #fff; margin: 0 0 .4rem;
}
.mod-complete-wrap p {
  font-size: .85rem; color: var(--muted); margin: 0 0 1.25rem;
}
.mod-btn-complete {
  display: inline-flex; align-items: center; gap: .6rem;
  background: linear-gradient(135deg, #7c3aed, #4c1d95);
  color: #fff; padding: .9rem 2rem; border-radius: 12px;
  font-size: .95rem; font-weight: 700; border: none; cursor: pointer;
  transition: all .2s; text-decoration: none;
}
.mod-btn-complete:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(124,58,237,.4); }
.mod-btn-complete--gold {
  background: linear-gradient(135deg, var(--gold), #a07820);
  color: #1a0e00;
}
.mod-btn-complete--gold:hover { box-shadow: 0 6px 20px rgba(201,168,76,.35); }

/* Flash */
.mod-flash {
  padding: 1rem 1.5rem 0;
  max-width: 740px; margin: 0 auto;
}
.mod-flash__msg {
  border-radius: 10px; padding: .8rem 1.2rem; font-size: .88rem; margin-bottom: .5rem;
}
.mod-flash__msg--success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.25); color: #86efac; }
.mod-flash__msg--info    { background: rgba(59,130,246,.1); border: 1px solid rgba(59,130,246,.25); color: #93c5fd; }

@media (max-width: 640px) {
  .mod-nav { padding: .75rem 1rem; }
  .mod-hero { padding: 2rem 1.25rem 1.75rem; }
  .mod-body { padding: 0 1rem 3rem; }
  .mod-intro { padding: 1.4rem 1.5rem; }
  .mod-activity__header { gap: .75rem; padding: 1rem; }
  .mod-activity__body { padding: 0 1rem 1rem; }
  .mod-conclusion { padding: 1.75rem 1.25rem; }
}
</style>
@endsection

@section('content')
<div style="background: var(--dark, #0a0a0a); min-height: 100vh;">

  {{-- Navigation sticky --}}
  <nav class="mod-nav">
    <a href="{{ route('formation.dashboard') }}" class="mod-nav__back">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Tableau de bord
    </a>
    <div class="mod-nav__title">{{ $module->title }}</div>
    <div class="mod-nav__progress">{{ $completedCount }}/{{ $totalCount }} activités</div>
  </nav>

  {{-- Flash --}}
  @if(session('success') || session('info'))
  <div class="mod-flash">
    @if(session('success'))
      <div class="mod-flash__msg mod-flash__msg--success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
      <div class="mod-flash__msg mod-flash__msg--info">{{ session('info') }}</div>
    @endif
  </div>
  @endif

  {{-- Hero du module --}}
  <div class="mod-hero">
    <div class="mod-hero__eyebrow">{{ $module->week_label }} · Formation Praticien Pause Souffle</div>
    <div class="mod-hero__num">{{ $module->order }}</div>
    <h1 class="mod-hero__title">{{ $module->title }}</h1>
    @if($module->description)
      <p class="mod-hero__week">{{ $module->description }}</p>
    @endif

    @if($totalCount > 0)
    <div class="mod-hero__progress">
      <div class="mod-hero__progress-label">
        <span>Progression</span>
        <span>{{ $completedCount }}/{{ $totalCount }}</span>
      </div>
      <div class="mod-hero__progress-track">
        <div class="mod-hero__progress-fill" style="width: {{ $totalCount > 0 ? round($completedCount/$totalCount*100) : 0 }}%"></div>
      </div>
    </div>
    @endif
  </div>

  {{-- Corps du module --}}
  <div class="mod-body">

    {{-- Lecteur audio guidé FR / EN --}}
    @if($module->audio_path || $module->audio_path_en)
    <div class="mod-audio">
      {{-- Toggle langue --}}
      @if($module->audio_path && $module->audio_path_en)
      <div style="display:flex;gap:8px;margin-bottom:10px;">
        <button id="btn-lang-fr" onclick="switchAudioLang('fr')"
          style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
          🇫🇷 Français
        </button>
        <button id="btn-lang-en" onclick="switchAudioLang('en')"
          style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
          🇬🇧 English
        </button>
      </div>
      @endif

      <div class="mod-audio__label">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
        <span id="audio-label-text">Écouter le module guidé</span>
      </div>
      <audio id="mod-audio-player" controls preload="metadata" style="width:100%">
        <source id="mod-audio-source"
          src="{{ asset('storage/' . ($module->audio_path ?? $module->audio_path_en)) }}"
          type="audio/mpeg">
      </audio>
      <div class="mod-audio__hint">🎧 Recommandé : écoutez d'abord le module guidé, puis travaillez les activités.</div>
    </div>

    <script>
    var _audioFr  = "{{ $module->audio_path ? asset('storage/'.$module->audio_path) : '' }}";
    var _audioEn  = "{{ $module->audio_path_en ? asset('storage/'.$module->audio_path_en) : '' }}";
    function switchAudioLang(lang) {
      var player  = document.getElementById('mod-audio-player');
      var source  = document.getElementById('mod-audio-source');
      var label   = document.getElementById('audio-label-text');
      var btnFr   = document.getElementById('btn-lang-fr');
      var btnEn   = document.getElementById('btn-lang-en');
      if (lang === 'fr' && _audioFr) {
        source.src = _audioFr;
        label.textContent = 'Écouter le module guidé';
        if (btnFr) { btnFr.style.background='#c9a84c'; btnFr.style.color='#0f0f0f'; }
        if (btnEn) { btnEn.style.background='rgba(201,168,76,.15)'; btnEn.style.color='#c9a84c'; }
      } else if (lang === 'en' && _audioEn) {
        source.src = _audioEn;
        label.textContent = 'Listen to the guided module';
        if (btnEn) { btnEn.style.background='#c9a84c'; btnEn.style.color='#0f0f0f'; }
        if (btnFr) { btnFr.style.background='rgba(201,168,76,.15)'; btnFr.style.color='#c9a84c'; }
      }
      player.load();
    }
    </script>
    @endif

    {{-- Texte introductif narratif (FR par défaut, bascule EN via bouton) --}}
    @if($module->intro_text || $module->intro_text_en)
    @if($module->intro_text_en)
    <div style="display:flex;gap:8px;margin:20px 0 8px;align-items:center;">
      <span style="font-size:12px;color:rgba(201,168,76,.7);text-transform:uppercase;letter-spacing:.08em;">Présentation</span>
      <div style="flex:1;height:1px;background:rgba(201,168,76,.15);"></div>
      <button onclick="toggleIntroLang()" id="btn-intro-lang"
        style="background:none;border:1px solid rgba(201,168,76,.4);color:#c9a84c;font-size:11px;padding:3px 10px;border-radius:12px;cursor:pointer;">
        🇬🇧 Read in English
      </button>
    </div>
    @endif
    <div class="mod-intro" id="mod-intro-fr">{!! nl2br(e($module->intro_text)) !!}</div>
    @if($module->intro_text_en)
    <div class="mod-intro" id="mod-intro-en" style="display:none;">{!! nl2br(e($module->intro_text_en)) !!}</div>
    <script>
    var _introLang = 'fr';
    function toggleIntroLang() {
      var btn = document.getElementById('btn-intro-lang');
      if (_introLang === 'fr') {
        document.getElementById('mod-intro-fr').style.display = 'none';
        document.getElementById('mod-intro-en').style.display = 'block';
        btn.textContent = '🇫🇷 Lire en Français';
        _introLang = 'en';
      } else {
        document.getElementById('mod-intro-fr').style.display = 'block';
        document.getElementById('mod-intro-en').style.display = 'none';
        btn.textContent = '🇬🇧 Read in English';
        _introLang = 'fr';
      }
    }
    </script>
    @endif
    @endif

    @if(count($activities) > 0)
    <div class="mod-divider">Activités du module</div>

    <div class="mod-activities" id="mod-activities">
      @foreach($activities as $idx => $act)
      @php
        $prog    = $activityProgress->get($idx);
        $isDone  = $prog && $prog->completed_at;
        $notes   = $prog->notes ?? '';
        $type    = $act['type'] ?? 'pratique';
        $iconMap = ['lecture'=>'📖','pratique'=>'🌬️','ecriture'=>'✍️','exercice'=>'💡','reflexion'=>'🔍'];
        $isJournal = in_array($type, ['ecriture','reflexion']);
        $isBreath  = $type === 'pratique';
      @endphp
      <div class="mod-activity {{ $isDone ? 'is-done' : '' }}" id="activity-{{ $idx }}" data-idx="{{ $idx }}">

        <div class="mod-activity__header" onclick="toggleActivity({{ $idx }})">
          <div class="mod-activity__icon mod-activity__icon--{{ $type }}">
            {{ $iconMap[$type] ?? '▸' }}
          </div>
          <div class="mod-activity__meta">
            <div class="mod-activity__title">{{ $act['title'] }}</div>
            <div class="mod-activity__tags">
              <span class="mod-activity__tag">{{ ucfirst($type) }}</span>
              @if(!empty($act['duration']))
                <span class="mod-activity__tag">⏱ {{ $act['duration'] }}</span>
              @endif
              @if($isDone)
                <span class="mod-activity__tag" style="color:#4ade80;background:rgba(34,197,94,.12);">✓ Fait</span>
              @endif
            </div>
          </div>
          @if($isDone)
            <div class="mod-activity__check">✓</div>
          @else
            <div class="mod-activity__expand">▼</div>
          @endif
        </div>

        <div class="mod-activity__body">
          @if(!empty($act['description']))
          <div class="mod-activity__desc">{{ $act['description'] }}</div>
          @endif

          {{-- Guide respiration animé pour les pratiques --}}
          @if($isBreath)
          <div class="mod-breath-guide">
            <div class="mod-breath-guide__title">
              🌬️ Minuteur de pratique
            </div>
            <button class="mod-breath-timer-btn" onclick="startBreathTimer({{ $idx }}, this)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
              Démarrer le minuteur
            </button>
            <div class="mod-breath-display" id="breath-display-{{ $idx }}">
              <div id="breath-timer-{{ $idx }}">5</div>
              <div class="mod-breath-phase" id="breath-phase-{{ $idx }}">Inspirez</div>
            </div>
          </div>
          @endif

          {{-- Zone de journal pour écriture / réflexion --}}
          @if($isJournal)
          <div class="mod-journal-label">
            ✍️ Votre journal personnel (enregistré automatiquement)
          </div>
          <textarea
            class="mod-journal-textarea"
            id="notes-{{ $idx }}"
            data-idx="{{ $idx }}"
            data-slug="{{ $module->slug }}"
            placeholder="Écrivez ici vos réponses et réflexions… Votre texte est sauvegardé automatiquement."
            oninput="autosaveNotes(this)"
          >{{ $notes }}</textarea>
          <div class="mod-journal-saved" id="saved-{{ $idx }}"></div>
          @endif

          {{-- Bouton valider --}}
          <form method="POST" action="{{ route('formation.activity.complete', [$module->slug, $idx]) }}" class="mod-validate-form" data-idx="{{ $idx }}">
            @csrf
            @if($isJournal)
              <input type="hidden" name="notes" id="hidden-notes-{{ $idx }}">
            @endif
            <button type="submit" class="mod-btn-validate {{ $isDone ? 'is-done' : '' }}" data-idx="{{ $idx }}">
              @if($isDone)
                ✓ Activité validée
              @else
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
                J'ai fait cette activité
              @endif
            </button>
          </form>
        </div>

      </div>
      @endforeach
    </div>
    @endif

    {{-- Conclusion ∞+ --}}
    @php
      $conclusions = [
        '01-je-me-rencontre'           => ['∞+', "Infiniment + présent(e) à vous-même\nqu'au début de cette semaine."],
        '02-je-reconnais-mes-blessures' => ['∞+', "Infiniment + proche de vous-même\ndans votre vérité."],
        '03-je-decris-mon-bonheur'      => ['∞+', "Infiniment + proche\nde votre propre boussole intérieure."],
        '04-j-ecoute-mon-souffle'       => ['∞+', "Infiniment + à l'écoute\nde votre souffle intérieur."],
        '05-je-decouvre-ma-mission'     => ['∞+', "Infiniment + proche\nde votre raison d'être."],
        '06-je-pratique-le-rituel'      => ['∞+', "J'ai couru très longtemps.\nJ'ai tout arrêté. Et c'est là que j'ai tout trouvé\n— et infiniment plus. ∞+"],
      ];
    @endphp
    @if(isset($conclusions[$module->slug]))
    <div class="mod-conclusion">
      <span class="mod-conclusion__symbol">{{ $conclusions[$module->slug][0] }}</span>
      <p class="mod-conclusion__text">{{ $conclusions[$module->slug][1] }}</p>
    </div>
    @endif

    {{-- Bloc terminer le module --}}
    @if($moduleStatus !== 'completed')
    <div class="mod-complete-wrap">
      <h3>Prêt(e) à avancer ?</h3>
      <p>Marquez ce module comme terminé pour débloquer le suivant.</p>
      <form method="POST" action="{{ route('formation.module.complete', $module->id) }}">
        @csrf
        <button type="submit" class="mod-btn-complete {{ $completedCount >= $totalCount && $totalCount > 0 ? 'mod-btn-complete--gold' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
          Terminer ce module
        </button>
      </form>
    </div>
    @else
    <div class="mod-complete-wrap" style="border-color: rgba(34,197,94,.3); background: rgba(34,197,94,.04);">
      <h3 style="color: #4ade80;">✓ Module complété</h3>
      <p>Ce module est terminé. Continuez votre progression.</p>
    </div>
    @endif

    {{-- Navigation prev/next --}}
    <div class="mod-nav-bottom">
      @if($prevSlug)
        <a href="{{ route('formation.module.show', $prevSlug) }}" class="mod-nav-btn">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
          Module précédent
        </a>
      @else
        <div></div>
      @endif

      @if($nextSlug)
        <a href="{{ route('formation.module.show', $nextSlug) }}" class="mod-nav-btn mod-nav-btn--gold">
          Module suivant
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      @endif
    </div>

  </div>{{-- /mod-body --}}

</div>
@endsection

@section('script')
<script>
// ─── Toggle accordéon activités ───────────────────────────
function toggleActivity(idx) {
  const el = document.getElementById('activity-' + idx);
  if (!el) return;
  const isExp = el.classList.contains('is-expanded');
  // Fermer tous
  document.querySelectorAll('.mod-activity.is-expanded').forEach(e => e.classList.remove('is-expanded'));
  if (!isExp) el.classList.add('is-expanded');
}

// Ouvrir la première activité non terminée au chargement
document.addEventListener('DOMContentLoaded', function () {
  const first = document.querySelector('.mod-activity:not(.is-done)');
  if (first) {
    const idx = first.getAttribute('data-idx');
    if (idx !== null) toggleActivity(parseInt(idx));
  }
});

// ─── Autosave journal ──────────────────────────────────────
const saveTimers = {};

function autosaveNotes(textarea) {
  const idx  = textarea.getAttribute('data-idx');
  const slug = textarea.getAttribute('data-slug');
  const savedEl = document.getElementById('saved-' + idx);
  // Synchroniser le hidden input
  const hidden = document.getElementById('hidden-notes-' + idx);
  if (hidden) hidden.value = textarea.value;

  if (saveTimers[idx]) clearTimeout(saveTimers[idx]);
  if (savedEl) savedEl.textContent = 'Enregistrement…';

  saveTimers[idx] = setTimeout(function () {
    fetch(`/mon-espace/formation/module/${slug}/activity/${idx}/notes`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
      },
      body: JSON.stringify({ notes: textarea.value }),
    })
    .then(r => r.json())
    .then(() => {
      if (savedEl) {
        savedEl.textContent = 'Sauvegardé ✓';
        setTimeout(() => { savedEl.textContent = ''; }, 2500);
      }
    })
    .catch(() => { if (savedEl) savedEl.textContent = ''; });
  }, 1200);
}

// ─── Validation activité via AJAX ─────────────────────────
document.querySelectorAll('.mod-validate-form').forEach(function(form) {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const idx    = form.getAttribute('data-idx');
    const slug   = form.getAttribute('action').split('/module/')[1].split('/activity/')[0];
    const notes  = document.getElementById('notes-' + idx)?.value || '';
    const btn    = form.querySelector('.mod-btn-validate');

    fetch(form.getAttribute('action'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        'Accept': 'application/json',
      },
      body: JSON.stringify({ notes }),
    })
    .then(r => r.json())
    .then(d => {
      if (d.ok) {
        const activity = document.getElementById('activity-' + idx);
        activity?.classList.add('is-done');
        if (btn) {
          btn.classList.add('is-done');
          btn.innerHTML = '✓ Activité validée';
        }
        // Mettre à jour compteur + barre
        updateProgress();
        // Ouvrir la prochaine activité non terminée
        setTimeout(() => {
          const next = document.querySelector('.mod-activity:not(.is-done)');
          if (next) {
            const nextIdx = next.getAttribute('data-idx');
            if (nextIdx !== null) toggleActivity(parseInt(nextIdx));
          }
        }, 400);
      }
    })
    .catch(() => form.submit()); // fallback : soumission normale
  });
});

function updateProgress() {
  const total = document.querySelectorAll('.mod-activity').length;
  const done  = document.querySelectorAll('.mod-activity.is-done').length;
  const fill  = document.querySelector('.mod-hero__progress-fill');
  const label = document.querySelector('.mod-hero__progress-label span:last-child');
  const navLbl = document.querySelector('.mod-nav__progress');
  if (fill)   fill.style.width = (total > 0 ? Math.round(done/total*100) : 0) + '%';
  if (label)  label.textContent = done + '/' + total;
  if (navLbl) navLbl.textContent = done + '/' + total + ' activités';
}

// ─── Minuteur respiration ──────────────────────────────────
const breathTimers = {};

function startBreathTimer(idx, btn) {
  if (breathTimers[idx]) {
    clearInterval(breathTimers[idx].interval);
    clearTimeout(breathTimers[idx].timeout);
    delete breathTimers[idx];
    btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg> Démarrer le minuteur`;
    const display = document.getElementById('breath-display-' + idx);
    if (display) display.style.display = 'none';
    return;
  }

  const display = document.getElementById('breath-display-' + idx);
  const timerEl = document.getElementById('breath-timer-' + idx);
  const phaseEl = document.getElementById('breath-phase-' + idx);
  if (!display || !timerEl) return;
  display.style.display = 'block';

  // Séquence : [durée, label] × cycle
  const sequence = [
    [5, 'Inspirez'], [5, 'Retenez'], [5, 'Expirez']
  ];

  let seqIdx = 0, remaining = sequence[0][0];

  btn.innerHTML = '⏹ Arrêter';

  function tick() {
    timerEl.textContent = remaining;
    phaseEl.textContent = sequence[seqIdx][1];

    if (remaining <= 0) {
      seqIdx = (seqIdx + 1) % sequence.length;
      remaining = sequence[seqIdx][0];
    } else {
      remaining--;
    }
  }

  tick();
  breathTimers[idx] = { interval: setInterval(tick, 1000) };
}
</script>
@endsection
