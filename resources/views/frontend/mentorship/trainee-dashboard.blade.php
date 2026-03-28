@extends('frontend.layout')

@section('pageHeading', __('Mentorat - Dashboard Stagiaire'))

@section('content')
<style>
  .tr-wrap { min-height: 100vh; background: radial-gradient(circle at 10% 10%, #f0f7ff 0%, #fbf7ef 50%, #f7f7f7 100%); padding: 90px 18px 40px; }
  .tr-shell { max-width: 1160px; margin: 0 auto; }
  .tr-hero { background: #121826; color: #eff4ff; border-radius: 22px; padding: 28px; border: 1px solid #1e2c46; }
  .tr-kicker { font-size: 11px; text-transform: uppercase; letter-spacing: .16em; color: #f4c365; }
  .tr-title { font-size: 34px; line-height: 1.1; margin: 12px 0 10px; font-weight: 600; }
  .tr-sub { color: #c8d2e9; margin: 0; }

  .tr-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 12px; margin-top: 16px; }
  .tr-card { background: #fff; border: 1px solid #e8e8eb; border-radius: 16px; padding: 16px; }
  .tr-val { font-size: 30px; font-weight: 700; color: #1b2b47; line-height: 1; }
  .tr-lbl { font-size: 12px; text-transform: uppercase; letter-spacing: .09em; color: #6f7990; margin-top: 8px; }

  .tr-progress { margin-top: 12px; background: #edf1f7; border-radius: 999px; overflow: hidden; height: 10px; }
  .tr-progress > div { height: 100%; background: linear-gradient(90deg, #6ea8ff 0%, #2b6bd8 100%); }

  .tr-section { margin-top: 18px; background: #fff; border: 1px solid #e8e8eb; border-radius: 16px; padding: 18px; }
  .tr-h2 { margin: 0 0 12px; font-size: 21px; color: #1e2a3f; }
  .tr-item { border: 1px solid #eef0f4; border-radius: 14px; padding: 14px; margin-bottom: 12px; }
  .tr-item:last-child { margin-bottom: 0; }
  .tr-item h3 { margin: 0 0 6px; font-size: 16px; color: #1f2f50; }
  .tr-meta { font-size: 13px; color: #6f7990; }
  .tr-pill { display: inline-block; margin-top: 8px; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; }
  .tr-pill-ok { background: #e8f6eb; color: #24693a; }
  .tr-pill-ko { background: #ffe9e9; color: #922a2a; }

  .tr-form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 8px; margin-bottom: 10px; }
  .tr-input, .tr-select, .tr-textarea { width: 100%; border: 1px solid #dae0ea; border-radius: 10px; padding: 10px 12px; font-size: 14px; background: #fff; }
  .tr-textarea { min-height: 80px; resize: vertical; }
  .tr-btn { border: 0; border-radius: 10px; padding: 10px 14px; font-size: 13px; font-weight: 700; cursor: pointer; background: #1f4da5; color: #fff; }

  .tr-alert { margin-top: 12px; padding: 10px 12px; border-radius: 10px; font-size: 14px; }
  .tr-alert-ok { background: #e8f7ef; border: 1px solid #bfe3cf; color: #105836; }
  .tr-alert-ko { background: #fdecec; border: 1px solid #f3b8b8; color: #7f2222; }
</style>

<div class="tr-wrap">
  <div class="tr-shell">
    <section class="tr-hero">
      <div class="tr-kicker">Apprenant Studio</div>
      <h1 class="tr-title">Dashboard stagiaire - {{ $user->first_name ?: ($user->name ?? 'Stagiaire') }}</h1>
      <p class="tr-sub">Progression, preuves de competences et trajectoire de certification en un seul espace.</p>
    </section>

    @if(session('success'))
      <div class="tr-alert tr-alert-ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="tr-alert tr-alert-ko">{{ session('error') }}</div>
    @endif

    <section class="tr-grid">
      <article class="tr-card"><div class="tr-val">{{ $stats['memberships_total'] }}</div><div class="tr-lbl">Parcours tutorat</div></article>
      <article class="tr-card"><div class="tr-val">{{ $stats['active_memberships'] }}</div><div class="tr-lbl">Parcours actifs</div></article>
      <article class="tr-card"><div class="tr-val">{{ $stats['validated_milestones'] }}</div><div class="tr-lbl">Jalons valides</div></article>
      <article class="tr-card"><div class="tr-val">{{ $stats['total_milestones'] }}</div><div class="tr-lbl">Jalons totaux</div></article>
      <article class="tr-card"><div class="tr-val">{{ $stats['progress'] }}%</div><div class="tr-lbl">Progression globale</div><div class="tr-progress"><div style="width: {{ $stats['progress'] }}%"></div></div></article>
    </section>

    <section class="tr-section">
      <h2 class="tr-h2">Eligibilite certificat</h2>
      @if($certificate['eligible'])
        <span class="tr-pill tr-pill-ok">Eligible</span>
      @else
        <span class="tr-pill tr-pill-ko">Non eligible pour l'instant</span>
      @endif
      <p class="tr-meta" style="margin-top:10px;">
        Taux de validation: {{ $certificate['validation_rate'] }}% (min {{ $certificate['rules']['min_validation_rate'] }}%) ·
        Score moyen: {{ $certificate['average_score'] }} (min {{ $certificate['rules']['min_average_score'] }}) ·
        Risque eleve recent: {{ $certificate['high_risk_open'] ? 'oui' : 'non' }}
      </p>
    </section>

    <section class="tr-section">
      <h2 class="tr-h2">Candidater a un pod</h2>
      @if($openPods->isEmpty())
        <p class="tr-meta">Aucun pod ouvert disponible actuellement.</p>
      @else
        @foreach($openPods as $pod)
          <article class="tr-item">
            <h3>{{ $pod->title }}</h3>
            <div class="tr-meta">Mentor: {{ $pod->mentor->first_name ?: ($pod->mentor->name ?? 'Mentor') }} · Secteur: {{ $pod->sector ?: '-' }} · Places: {{ $pod->active_trainees_count }}/{{ $pod->max_trainees }}</div>
            <form method="POST" action="{{ route('mentorship.trainee.pods.apply', ['pod' => $pod->id]) }}" style="margin-top:10px;">
              @csrf
              <div class="tr-form-grid">
                <select class="tr-select" name="trainee_type" required>
                  <option value="student">Etudiant stagiaire</option>
                  <option value="graduate">Jeune diplome</option>
                </select>
                <button class="tr-btn" type="submit">Candidater</button>
              </div>
            </form>
          </article>
        @endforeach
      @endif
    </section>

    <section class="tr-section">
      <h2 class="tr-h2">Soumettre un jalon</h2>
      @if($activeMilestones->isEmpty())
        <p class="tr-meta">Aucun jalon ouvert a soumettre pour le moment.</p>
      @else
        @foreach($activeMilestones as $milestone)
          <article class="tr-item">
            <h3>{{ $milestone->title }}</h3>
            <div class="tr-meta">Pod: {{ $milestone->mission->pod->title }} · Mission: {{ $milestone->mission->title }} · Echeance: {{ $milestone->due_date ? $milestone->due_date->format('d/m/Y') : '-' }}</div>
            <form method="POST" action="{{ route('mentorship.trainee.milestones.submit', ['milestone' => $milestone->id]) }}" style="margin-top:10px;">
              @csrf
              <div class="tr-form-grid">
                <input class="tr-input" type="url" name="submission_url" placeholder="URL du livrable (GitHub, Figma, Drive...)">
              </div>
              <textarea class="tr-textarea" name="notes" placeholder="Notes de soumission"></textarea>
              <button class="tr-btn" type="submit" style="margin-top:8px;">Envoyer au mentor</button>
            </form>
          </article>
        @endforeach
      @endif
    </section>

    <section class="tr-section">
      <h2 class="tr-h2">Mes pods</h2>
      @forelse($memberships as $membership)
        <article class="tr-item">
          <h3>{{ $membership->pod->title }}</h3>
          <div class="tr-meta">
            Mentor: {{ $membership->pod->mentor->first_name ?: ($membership->pod->mentor->name ?? 'Mentor') }} ·
            Statut: {{ $membership->membership_status }} ·
            Debut: {{ $membership->start_date ? $membership->start_date->format('d/m/Y') : '-' }}
          </div>
        </article>
      @empty
        <p class="tr-meta">Aucune adhesion active pour le moment.</p>
      @endforelse
    </section>
  </div>
</div>
@endsection
