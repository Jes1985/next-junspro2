@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<style>
  .nx-skill-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(155px,1fr)); gap:.65rem; }

  .nx-skill-input { display:none; }

  .nx-skill-card {
    display:flex; align-items:center; gap:.6rem;
    padding:.7rem 1rem; border-radius:12px;
    border:2px solid #e5e7eb; background:#f9fafb;
    cursor:pointer; transition:all .18s;
    font-size:.875rem; font-weight:500; color:#374151;
    user-select:none;
  }

  .nx-skill-input:checked + .nx-skill-card {
    border-color:var(--nx-purple);
    background:rgba(124,58,237,.07);
    color:var(--nx-purple); font-weight:700;
  }

  .nx-skill-icon { font-size:1.2rem; flex-shrink:0; }

  .nx-contact-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }
  @media(max-width:480px){ .nx-contact-grid{ grid-template-columns:1fr 1fr; } }

  .nx-rule-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(175px,1fr)); gap:.6rem; }
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    <div class="nx-badge"><span>✦</span> Onboarding NEXUS</div>
    @include('nexus.onboarding._stepper', ['current' => 5])

    @if($errors->any())
      <div class="nx-alert nx-alert-error mb-3">
        <span>⚠️</span>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
      </div>
    @endif

    <div class="nx-card">
      <h1 class="nx-title">Mes critères d'échange</h1>
      <p class="nx-subtitle">Définissez ce que vous apportez et ce que vous recherchez. La magie NEXUS opère quand les talents se rencontrent.</p>

      <form action="{{ route('nexus.onboarding.step5.store') }}" method="POST">
        @csrf

        {{-- Ce que j'offre --}}
        <div class="nx-field">
          <label class="nx-label">Ce que j'offre <span style="color:#ef4444">*</span></label>
          <p style="font-size:.85rem;color:#6b7280;margin-bottom:.75rem">Sélectionnez les domaines dans lesquels vous pouvez apporter de la valeur.</p>
          <div class="nx-skill-grid">
            @foreach($skillOptions as $sk)
              <input type="checkbox" name="offer_skills[]" value="{{ $sk['slug'] }}" id="offer_{{ $sk['slug'] }}" class="nx-skill-input"
                {{ in_array($sk['slug'], old('offer_skills', $data['offer_skills'] ?? [])) ? 'checked' : '' }}>
              <label for="offer_{{ $sk['slug'] }}" class="nx-skill-card">
                <span class="nx-skill-icon">{{ $sk['icon'] }}</span>
                <span>{{ $sk['label'] }}</span>
              </label>
            @endforeach
          </div>
          @error('offer_skills')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.5rem 0">

        {{-- Ce que je recherche --}}
        <div class="nx-field">
          <label class="nx-label">Ce que je recherche <span style="color:#ef4444">*</span></label>
          <p style="font-size:.85rem;color:#6b7280;margin-bottom:.75rem">Quelles compétences ou services attendez-vous d'un partenaire d'échange ?</p>
          <div class="nx-skill-grid">
            @foreach($skillOptions as $sk)
              <input type="checkbox" name="seek_skills[]" value="{{ $sk['slug'] }}" id="seek_{{ $sk['slug'] }}" class="nx-skill-input"
                {{ in_array($sk['slug'], old('seek_skills', $data['seek_skills'] ?? [])) ? 'checked' : '' }}>
              <label for="seek_{{ $sk['slug'] }}" class="nx-skill-card">
                <span class="nx-skill-icon">{{ $sk['icon'] }}</span>
                <span>{{ $sk['label'] }}</span>
              </label>
            @endforeach
          </div>
          @error('seek_skills')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.5rem 0">

        {{-- Règles --}}
        <div class="nx-field">
          <label class="nx-label">Règles de l'échange <span class="nx-label-hint">(optionnel)</span></label>
          <div class="nx-rule-grid">
            @foreach($ruleOptions as $slug => $label)
              <input type="checkbox" name="exchange_rules[]" value="{{ $slug }}" id="rule_{{ $slug }}" class="nx-chip-input"
                {{ in_array($slug, old('exchange_rules', $data['exchange_rules'] ?? [])) ? 'checked' : '' }}>
              <label for="rule_{{ $slug }}" class="nx-chip-label" style="border-radius:10px">{{ $label }}</label>
            @endforeach
          </div>
        </div>

        {{-- Mode de contact --}}
        <div class="nx-field">
          <label class="nx-label">Contact préféré</label>
          <div class="nx-contact-grid">
            @php
              $contacts = [
                'message' => ['icon'=>'💬','label'=>'Message'],
                'video'   => ['icon'=>'📹','label'=>'Visio'],
                'phone'   => ['icon'=>'📞','label'=>'Téléphone'],
              ];
            @endphp
            @foreach($contacts as $slug => $c)
              <input type="radio" name="preferred_contact" value="{{ $slug }}" id="contact_{{ $slug }}" class="nx-radio-input"
                {{ old('preferred_contact', $data['preferred_contact'] ?? 'message') === $slug ? 'checked' : '' }}>
              <label for="contact_{{ $slug }}" class="nx-radio-card" style="padding:.9rem">
                <span class="nx-radio-card-icon">{{ $c['icon'] }}</span>
                <span class="nx-radio-card-label">{{ $c['label'] }}</span>
              </label>
            @endforeach
          </div>
          @error('preferred_contact')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Note libre --}}
        <div class="nx-field">
          <label class="nx-label" for="exchange_note">Note complémentaire <span class="nx-label-hint">(optionnel)</span></label>
          <textarea id="exchange_note" name="exchange_note" class="nx-textarea" placeholder="Ajoutez tout ce qui vous semble important pour votre futur partenaire…" maxlength="1000">{{ old('exchange_note', $data['exchange_note']) }}</textarea>
        </div>

        {{-- Footer --}}
        <div class="nx-form-footer">
          <a href="{{ route('nexus.onboarding.step4') }}" class="nx-btn nx-btn-ghost">← Retour</a>
          <button type="submit" class="nx-btn nx-btn-primary">Continuer →</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
