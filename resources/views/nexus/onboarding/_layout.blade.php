{{-- Partial : CSS commun onboarding NEXUS --}}
<style>
  :root {
    --nx-blue:     #2563EB;
    --nx-purple:   #7C3AED;
    --nx-pink:     #EC4899;
    --nx-gold:     #F59E0B;
    --nx-gradient: linear-gradient(135deg, #2563EB 0%, #7C3AED 55%, #EC4899 100%);
    --nx-light:    linear-gradient(135deg, #EEF2FF 0%, #F5F3FF 50%, #FDF2F8 100%);
    --nx-shadow:   0 8px 32px rgba(37,99,235,0.12);
    --nx-radius:   20px;
  }

  /* ── Page ───────────────────────────────────────────────────── */
  .nx-ob-page {
    min-height: 100vh;
    background: linear-gradient(150deg, #f0f4ff 0%, #f5f0ff 50%, #fdf2f8 100%);
    padding: 2.5rem 0 5rem;
    font-family: 'Inter', system-ui, sans-serif;
  }

  .nx-ob-wrap {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 2.5rem;
  }

  @media (max-width: 1024px) {
    .nx-ob-wrap { padding: 0 1.75rem; }
  }

  @media (max-width: 600px) {
    .nx-ob-wrap { padding: 0 1rem; }
  }

  /* ── Logo / Badge NEXUS ─────────────────────────────────────── */
  .nx-badge {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--nx-gradient);
    color: #fff;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    padding: .35rem 1rem;
    border-radius: 100px;
    margin-bottom: 1.5rem;
  }

  /* ── Stepper ────────────────────────────────────────────────── */
  .nx-stepper {
    background: #fff;
    border-radius: var(--nx-radius);
    padding: 1.5rem 2rem;
    margin-bottom: 1.75rem;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
    display: flex;
    align-items: center;
    gap: 0;
    overflow-x: auto;
  }

  .nx-step {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex: 1;
    min-width: 0;
  }

  .nx-step-dot {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: 700;
    transition: all .25s;
  }

  .nx-step.completed .nx-step-dot {
    background: var(--nx-gradient);
    color: #fff;
  }

  .nx-step.active .nx-step-dot {
    background: var(--nx-gradient);
    color: #fff;
    box-shadow: 0 0 0 5px rgba(124,58,237,.15);
  }

  .nx-step.pending .nx-step-dot {
    background: #e5e7eb;
    color: #9ca3af;
  }

  .nx-step-label {
    font-size: .75rem;
    font-weight: 500;
    color: #6b7280;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .nx-step.active .nx-step-label {
    color: var(--nx-purple);
    font-weight: 700;
  }

  .nx-step.completed .nx-step-label {
    color: var(--nx-blue);
    font-weight: 600;
  }

  .nx-step-sep {
    flex-shrink: 0;
    width: 28px;
    height: 2px;
    border-radius: 2px;
    margin: 0 .25rem;
  }

  .nx-step.completed + .nx-step-sep,
  .nx-step-sep.done {
    background: var(--nx-gradient);
  }

  .nx-step-sep.pending {
    background: #e5e7eb;
  }

  /* ── Card ───────────────────────────────────────────────────── */
  .nx-card {
    background: #fff;
    border-radius: var(--nx-radius);
    padding: 2.75rem 3rem;
    box-shadow: var(--nx-shadow);
    border: 1px solid rgba(124,58,237,.06);
  }

  @media (max-width:600px) {
    .nx-card { padding: 1.75rem 1.25rem; }
    .nx-stepper { padding: 1rem; }
  }

  /* ── Titres ─────────────────────────────────────────────────── */
  .nx-title {
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -.03em;
    margin-bottom: .5rem;
    background: var(--nx-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .nx-subtitle {
    font-size: 1rem;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 2.25rem;
  }

  /* ── Form ───────────────────────────────────────────────────── */
  .nx-field { margin-bottom: 1.5rem; }

  .nx-label {
    display: block;
    font-size: .875rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: .4rem;
  }

  .nx-label-hint {
    font-weight: 400;
    color: #9ca3af;
    font-size: .8rem;
  }

  .nx-input, .nx-select, .nx-textarea {
    width: 100%;
    padding: .85rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: .95rem;
    color: #111827;
    background: #fff;
    transition: border-color .2s, box-shadow .2s;
  }

  .nx-input:focus, .nx-select:focus, .nx-textarea:focus {
    outline: none;
    border-color: var(--nx-purple);
    box-shadow: 0 0 0 3px rgba(124,58,237,.1);
  }

  .nx-textarea { resize: vertical; min-height: 110px; }

  .nx-error {
    color: #ef4444;
    font-size: .8rem;
    margin-top: .3rem;
    display: flex;
    align-items: center;
    gap: .35rem;
  }

  .nx-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

  @media (max-width:600px) { .nx-row { grid-template-columns: 1fr; } }

  /* ── Boutons ────────────────────────────────────────────────── */
  .nx-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: .9rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    border: none;
    transition: all .2s;
    text-decoration: none;
  }

  .nx-btn-primary {
    background: var(--nx-gradient);
    color: #fff;
    box-shadow: 0 4px 16px rgba(124,58,237,.25);
  }

  .nx-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(124,58,237,.35);
    color: #fff;
  }

  .nx-btn-ghost {
    background: transparent;
    color: var(--nx-purple);
    border: 2px solid rgba(124,58,237,.25);
  }

  .nx-btn-ghost:hover {
    background: rgba(124,58,237,.06);
    border-color: var(--nx-purple);
    color: var(--nx-purple);
  }

  .nx-form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-top: 2.5rem;
    padding-top: 1.75rem;
    border-top: 1px solid #f3f4f6;
    flex-wrap: wrap;
  }

  /* ── Chips / Pills ──────────────────────────────────────────── */
  .nx-chips { display: flex; flex-wrap: wrap; gap: .6rem; }

  .nx-chip-input { display: none; }

  .nx-chip-label {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .45rem 1rem;
    border-radius: 100px;
    border: 2px solid #e5e7eb;
    background: #f9fafb;
    font-size: .875rem;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    transition: all .2s;
    user-select: none;
  }

  .nx-chip-input:checked + .nx-chip-label {
    border-color: var(--nx-purple);
    background: rgba(124,58,237,.06);
    color: var(--nx-purple);
    font-weight: 600;
  }

  /* ── Radio cards ────────────────────────────────────────────── */
  .nx-radio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: .75rem;
  }

  .nx-radio-input { display: none; }

  .nx-radio-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: .35rem;
    padding: 1.25rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 16px;
    background: #f9fafb;
    cursor: pointer;
    transition: all .2s;
    text-align: center;
  }

  .nx-radio-card-icon { font-size: 1.75rem; }
  .nx-radio-card-label { font-size: .875rem; font-weight: 600; color: #374151; }
  .nx-radio-card-desc { font-size: .75rem; color: #9ca3af; }

  .nx-radio-input:checked + .nx-radio-card {
    border-color: var(--nx-purple);
    background: rgba(124,58,237,.05);
    box-shadow: 0 4px 16px rgba(124,58,237,.12);
  }

  .nx-radio-input:checked + .nx-radio-card .nx-radio-card-label {
    color: var(--nx-purple);
  }

  /* ── Photo upload ───────────────────────────────────────────── */
  .nx-photo-drop {
    border: 2px dashed #d1d5db;
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all .2s;
    background: #fafafa;
  }

  .nx-photo-drop:hover {
    border-color: var(--nx-purple);
    background: rgba(124,58,237,.03);
  }

  .nx-photo-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--nx-purple);
    margin: 0 auto .75rem;
    display: block;
  }

  /* ── Languages ──────────────────────────────────────────────── */
  .nx-lang-row {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: .75rem;
    align-items: end;
    padding: .75rem;
    border: 1px solid #f3f4f6;
    border-radius: 12px;
    background: #fafafa;
    margin-bottom: .5rem;
  }

  .nx-lang-remove {
    background: none;
    border: none;
    color: #ef4444;
    cursor: pointer;
    font-size: 1.1rem;
    padding: .5rem;
    border-radius: 8px;
    line-height: 1;
    transition: background .15s;
  }

  .nx-lang-remove:hover { background: #fef2f2; }

  /* ── Country pills ──────────────────────────────────────────── */
  .nx-countries { display: flex; flex-wrap: wrap; gap: .5rem; }

  /* ── Alert ──────────────────────────────────────────────────── */
  .nx-alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    font-size: .9rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: .75rem;
  }

  .nx-alert-success {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #166534;
  }

  .nx-alert-error {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #991b1b;
  }

  .nx-alert-info {
    background: #eff6ff;
    border: 1px solid #93c5fd;
    color: #1e40af;
  }

  /* ── Recap card ─────────────────────────────────────────────── */
  .nx-recap-block {
    background: linear-gradient(135deg, #f0f4ff, #f5f3ff, #fdf2f8);
    border: 1px solid rgba(124,58,237,.12);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1rem;
  }

  .nx-recap-title {
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--nx-purple);
    margin-bottom: .75rem;
    display: flex;
    align-items: center;
    gap: .4rem;
  }

  .nx-recap-edit {
    margin-left: auto;
    font-size: .75rem;
    font-weight: 600;
    color: var(--nx-purple);
    text-decoration: none;
    padding: .25rem .65rem;
    border-radius: 8px;
    border: 1px solid rgba(124,58,237,.2);
    transition: background .15s;
  }

  .nx-recap-edit:hover { background: rgba(124,58,237,.07); }

  .nx-recap-row {
    display: flex;
    align-items: baseline;
    gap: .5rem;
    font-size: .9rem;
    color: #374151;
    margin-bottom: .35rem;
  }

  .nx-recap-row strong { color: #111827; min-width: 6rem; }

  /* ── Checkbox ───────────────────────────────────────────────── */
  .nx-check-wrap { display: flex; gap: .85rem; align-items: flex-start; }

  .nx-check-wrap input[type=checkbox] {
    width: 18px; height: 18px; flex-shrink: 0;
    accent-color: var(--nx-purple);
    margin-top: .2rem; cursor: pointer;
  }

  .nx-check-label { font-size: .9rem; color: #374151; line-height: 1.55; }

  /* ── Flatpickr skin ─────────────────────────────────────────── */
  .flatpickr-calendar { border-radius: 16px !important; }
  .flatpickr-day.selected, .flatpickr-day.selected:hover {
    background: var(--nx-purple) !important; border-color: var(--nx-purple) !important;
  }
  .flatpickr-day.inRange {
    background: rgba(124,58,237,.1) !important; border-color: transparent !important;
  }

  /* ── Complete page ──────────────────────────────────────────── */
  .nx-complete-hero {
    text-align: center;
    padding: 4rem 1rem 2rem;
  }

  .nx-complete-icon {
    width: 100px; height: 100px;
    border-radius: 50%;
    background: var(--nx-gradient);
    display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 32px rgba(124,58,237,.3);
    animation: nx-pop .5s cubic-bezier(.34,1.56,.64,1);
  }

  @keyframes nx-pop {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
  }

  /* ═══════════════════════════════════════════════════════════
     LISIBILITÉ — Augmentation typographique +15% sur tous
     les textes de l'onboarding (badge, labels, inputs, boutons)
     ═══════════════════════════════════════════════════════════ */

  /* Badge NEXUS */
  .nx-badge { font-size: .87rem; }

  /* Stepper */
  .nx-step-label   { font-size: .88rem; }
  .nx-step-dot     { font-size: .93rem; }

  /* Titres */
  .nx-title    { font-size: 2.3rem; }
  .nx-subtitle { font-size: 1.125rem; }

  /* Labels & hints */
  .nx-label      { font-size: 1rem; }
  .nx-label-hint { font-size: .9rem; }

  /* Champs */
  .nx-input, .nx-select, .nx-textarea { font-size: 1.0625rem; }

  /* Erreurs */
  .nx-error { font-size: .9rem; }

  /* Boutons */
  .nx-btn { font-size: 1.0625rem; }

  /* Chips équipements */
  .nx-chip-label { font-size: 1rem !important; }

  /* Radio cards */
  .nx-radio-card-icon  { font-size: 2rem; }
  .nx-radio-card-label { font-size: 1rem; }
  .nx-radio-card-desc  { font-size: .875rem; }

  /* Alertes */
  .nx-alert { font-size: 1.0625rem; }

  /* Recap step 6 */
  .nx-recap-title { font-size: .82rem; }
  .nx-recap-edit  { font-size: .875rem; }
  .nx-recap-row   { font-size: 1.05rem; }

  /* Checkbox label */
  .nx-check-label { font-size: 1.05rem; }
</style>
