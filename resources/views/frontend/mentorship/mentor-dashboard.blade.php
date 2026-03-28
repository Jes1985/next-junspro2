@extends('frontend.layout')

@section('pageHeading', __('Mentorat - Dashboard Mentor'))

@section('content')
<style>
  .mt-wrap { min-height: 100vh; background: linear-gradient(165deg, #f4efe6 0%, #fdfbf8 55%, #eef5f3 100%); padding: 90px 18px 40px; }
  .mt-shell { max-width: 1160px; margin: 0 auto; }
  .mt-hero { background: #0f1f1c; color: #fef7ea; border-radius: 22px; padding: 28px; border: 1px solid #15352f; }
  .mt-kicker { font-size: 11px; text-transform: uppercase; letter-spacing: .16em; color: #d2aa63; }
  .mt-title { font-size: 34px; line-height: 1.1; margin: 12px 0 10px; font-weight: 600; }
  .mt-sub { color: #d8ccc1; margin-bottom: 0; }

  .mt-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 12px; margin-top: 16px; }
  .mt-card { background: #fff; border: 1px solid #e8dfd3; border-radius: 16px; padding: 16px; }
  .mt-val { font-size: 30px; font-weight: 700; color: #15352f; line-height: 1; }
  .mt-lbl { font-size: 12px; text-transform: uppercase; letter-spacing: .09em; color: #8b7961; margin-top: 8px; }

  .mt-section { margin-top: 18px; background: #fff; border: 1px solid #e8dfd3; border-radius: 16px; padding: 18px; }
  .mt-h2 { margin: 0 0 12px; font-size: 21px; color: #1f2f2c; }
  .mt-form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 8px; margin-bottom: 10px; }
  .mt-input, .mt-select, .mt-textarea { width: 100%; border: 1px solid #e2d9cb; border-radius: 10px; padding: 10px 12px; font-size: 14px; background: #fff; }
  .mt-textarea { min-height: 80px; resize: vertical; }
  .mt-btn { border: 0; border-radius: 10px; padding: 10px 14px; font-size: 13px; font-weight: 700; cursor: pointer; }
  .mt-btn-main { background: #15352f; color: #fff; }
  .mt-btn-ok { background: #0f6b48; color: #fff; }
  .mt-btn-ghost { background: #f4efe6; color: #1f2f2c; border: 1px solid #e8dfd3; }

  .mt-table { width: 100%; border-collapse: collapse; }
  .mt-table th, .mt-table td { text-align: left; padding: 10px 8px; border-bottom: 1px solid #f0ebe2; font-size: 14px; vertical-align: top; }
  .mt-table th { color: #8b7961; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; }
  .mt-pill { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; }
  .mt-pill-open { background: #e6f6ef; color: #0f6b48; }
  .mt-pill-full { background: #fff1dd; color: #9a6515; }
  .mt-pill-draft { background: #eceff5; color: #4f5f79; }
  .mt-pill-paused { background: #fbe6e8; color: #8d1e2a; }
  .mt-empty { color: #8b7961; margin: 4px 0 0; }

  .mt-alert { margin-top: 12px; padding: 10px 12px; border-radius: 10px; font-size: 14px; }
  .mt-alert-ok { background: #e8f7ef; border: 1px solid #bfe3cf; color: #105836; }
  .mt-alert-ko { background: #fdecec; border: 1px solid #f3b8b8; color: #7f2222; }
</style>

<div class="mt-wrap">
  <div class="mt-shell">
    <section class="mt-hero">
      <div class="mt-kicker">Mentor Studio</div>
      <h1 class="mt-title">Dashboard mentor - {{ $user->first_name ?: ($user->name ?? 'Mentor') }}</h1>
      <p class="mt-sub">Pilotage premium des pods, des stagiaires et de la qualite pedagogique.</p>
    </section>

    @if(session('success'))
      <div class="mt-alert mt-alert-ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="mt-alert mt-alert-ko">{{ session('error') }}</div>
    @endif

    <section class="mt-grid">
      <article class="mt-card"><div class="mt-val">{{ $stats['pods_total'] }}</div><div class="mt-lbl">Pods actifs</div></article>
      <article class="mt-card"><div class="mt-val">{{ $stats['active_trainees'] }}</div><div class="mt-lbl">Stagiaires actifs</div></article>
      <article class="mt-card"><div class="mt-val">{{ $stats['pending_applications'] }}</div><div class="mt-lbl">Candidatures en attente</div></article>
      <article class="mt-card"><div class="mt-val">{{ $stats['missions_total'] }}</div><div class="mt-lbl">Missions publiees</div></article>
      <article class="mt-card"><div class="mt-val">{{ $stats['high_risk_recent'] }}</div><div class="mt-lbl">Alertes risque eleve (14j)</div></article>
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Creer un pod</h2>
      <form method="POST" action="{{ route('mentorship.mentor.pods.store') }}">
        @csrf
        <div class="mt-form-grid">
          <input class="mt-input" type="text" name="title" placeholder="Titre du pod" required>
          <input class="mt-input" type="text" name="sector" placeholder="Secteur (ex: Dev web)">
          <input class="mt-input" type="number" name="max_trainees" min="1" max="5" value="3" required>
          <select class="mt-select" name="visibility">
            <option value="public">Public</option>
            <option value="private">Prive</option>
            <option value="school_only">Ecole uniquement</option>
          </select>
          <select class="mt-select" name="premium_label">
            <option value="standard">Standard</option>
            <option value="curated">Curated</option>
            <option value="elite">Elite</option>
          </select>
        </div>
        <textarea class="mt-textarea" name="description" placeholder="Description du pod"></textarea>
        <button class="mt-btn mt-btn-main" type="submit">Creer le pod</button>
      </form>
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Creer une mission</h2>
      <form method="POST" action="{{ route('mentorship.mentor.missions.store') }}">
        @csrf
        <div class="mt-form-grid">
          <select class="mt-select" name="pod_id" required>
            <option value="">Pod cible</option>
            @foreach($pods as $pod)
              <option value="{{ $pod->id }}">{{ $pod->title }}</option>
            @endforeach
          </select>
          <input class="mt-input" type="text" name="title" placeholder="Titre mission" required>
          <select class="mt-select" name="difficulty" required>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
          </select>
          <input class="mt-input" type="number" name="estimated_hours" min="0" placeholder="Heures estimees" required>
          <input class="mt-input" type="date" name="due_date">
        </div>
        <textarea class="mt-textarea" name="brief" placeholder="Brief mission"></textarea>
        <button class="mt-btn mt-btn-main" type="submit">Ajouter mission</button>
      </form>
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Candidatures en attente</h2>
      @if($pendingMemberships->isEmpty())
        <p class="mt-empty">Aucune candidature en attente.</p>
      @else
        <table class="mt-table">
          <thead><tr><th>Pod</th><th>Stagiaire</th><th>Type</th><th>Action</th></tr></thead>
          <tbody>
          @foreach($pendingMemberships as $membership)
            <tr>
              <td>{{ $membership->pod->title }}</td>
              <td>{{ $membership->trainee->first_name ?: ($membership->trainee->name ?? 'Stagiaire') }}</td>
              <td>{{ $membership->trainee_type }}</td>
              <td>
                <form method="POST" action="{{ route('mentorship.mentor.memberships.accept', ['pod' => $membership->pod_id, 'trainee' => $membership->trainee_user_id]) }}">
                  @csrf
                  <button class="mt-btn mt-btn-ok" type="submit">Accepter</button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      @endif
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Reviews a faire</h2>
      @if($recentSubmissions->isEmpty())
        <p class="mt-empty">Aucune soumission en attente de review.</p>
      @else
        <table class="mt-table">
          <thead><tr><th>Stagiaire</th><th>Mission</th><th>Jalon</th><th>Lien</th><th>Review</th></tr></thead>
          <tbody>
          @foreach($recentSubmissions as $submission)
            <tr>
              <td>{{ $submission->trainee->first_name ?: ($submission->trainee->name ?? 'Stagiaire') }}</td>
              <td>{{ $submission->milestone->mission->title }}</td>
              <td>{{ $submission->milestone->title }}</td>
              <td>
                @if($submission->submission_url)
                  <a href="{{ $submission->submission_url }}" target="_blank" rel="noopener">Voir</a>
                @else
                  -
                @endif
              </td>
              <td>
                <form method="POST" action="{{ route('mentorship.mentor.submissions.review', ['submission' => $submission->id]) }}">
                  @csrf
                  <div class="mt-form-grid">
                    <select class="mt-select" name="review_status" required>
                      <option value="approved">Approve</option>
                      <option value="needs_changes">Needs changes</option>
                      <option value="rejected">Reject</option>
                    </select>
                    <input class="mt-input" type="number" name="score_technical" min="0" max="100" placeholder="Tech">
                    <input class="mt-input" type="number" name="score_communication" min="0" max="100" placeholder="Comm">
                    <input class="mt-input" type="number" name="score_autonomy" min="0" max="100" placeholder="Auto">
                  </div>
                  <button class="mt-btn mt-btn-ghost" type="submit">Enregistrer</button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      @endif
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Check-in hebdomadaire</h2>
      @if($activeMemberships->isEmpty())
        <p class="mt-empty">Aucun stagiaire actif pour le moment.</p>
      @else
        <form method="POST" action="{{ route('mentorship.mentor.checkins.store') }}">
          @csrf
          <div class="mt-form-grid">
            <select class="mt-select" name="pod_id" required>
              <option value="">Pod</option>
              @foreach($pods as $pod)
                <option value="{{ $pod->id }}">{{ $pod->title }}</option>
              @endforeach
            </select>
            <select class="mt-select" name="trainee_user_id" required>
              <option value="">Stagiaire</option>
              @foreach($activeMemberships as $membership)
                <option value="{{ $membership->trainee_user_id }}">{{ $membership->trainee->first_name ?: ($membership->trainee->name ?? 'Stagiaire') }} - {{ $membership->pod->title }}</option>
              @endforeach
            </select>
            <input class="mt-input" type="date" name="week_start" required>
            <input class="mt-input" type="number" name="progress_percent" min="0" max="100" placeholder="Progression %" required>
            <input class="mt-input" type="number" name="confidence_level" min="1" max="5" placeholder="Confiance (1-5)">
          </div>
          <div class="mt-form-grid">
            <textarea class="mt-textarea" name="blockers_text" placeholder="Blocages"></textarea>
            <textarea class="mt-textarea" name="next_actions_text" placeholder="Prochaines actions"></textarea>
            <textarea class="mt-textarea" name="mentor_feedback_text" placeholder="Feedback mentor"></textarea>
          </div>
          <button class="mt-btn mt-btn-main" type="submit">Enregistrer check-in</button>
        </form>
      @endif
    </section>

    <section class="mt-section">
      <h2 class="mt-h2">Pods</h2>
      @if($pods->isEmpty())
        <p class="mt-empty">Aucun pod pour le moment.</p>
      @else
        <table class="mt-table">
          <thead>
            <tr>
              <th>Titre</th>
              <th>Secteur</th>
              <th>Statut</th>
              <th>Stagiaires</th>
              <th>Candidatures</th>
              <th>Missions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pods as $pod)
              <tr>
                <td>{{ $pod->title }}</td>
                <td>{{ $pod->sector ?: '-' }}</td>
                <td>
                  @php
                    $status = strtolower($pod->status);
                    $cls = in_array($status, ['open']) ? 'mt-pill-open' : (in_array($status, ['full']) ? 'mt-pill-full' : (in_array($status, ['paused']) ? 'mt-pill-paused' : 'mt-pill-draft'));
                  @endphp
                  <span class="mt-pill {{ $cls }}">{{ $pod->status }}</span>
                </td>
                <td>{{ $pod->active_memberships_count }}/{{ $pod->max_trainees }}</td>
                <td>{{ $pod->pending_memberships_count }}</td>
                <td>{{ $pod->missions_count }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </section>
  </div>
</div>
@endsection
