@extends('frontend.freelance.layouts.app')

@section('content')
<style>
/* =====================================================================
   PREMIUM PAYOUT FORM — Versements freelance
   ===================================================================== */

.payout-wrap {
  max-width: 1100px;
  margin: 0 auto;
  padding: 2.5rem 1.5rem;
}

/* ── Header ── */
.payout-header { margin-bottom: 2.5rem; }
.payout-header h1 {
  font-size: 1.9rem; font-weight: 800; color: #111827;
  margin: 0 0 .35rem;
  letter-spacing: -.5px;
}
.payout-header p { color: #6b7280; font-size: 1rem; margin: 0; }

/* ── Flash messages ── */
.flash-success {
  background: #d1fae5; border: 1px solid #10b981; color: #065f46;
  padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 2rem;
  font-weight: 500;
}
.flash-error {
  background: #fee2e2; border: 1px solid #ef4444; color: #991b1b;
  padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 2rem;
  font-weight: 500;
}

/* ── Already-saved banner ── */
.saved-banner {
  display: flex; align-items: center; gap: .85rem;
  background: linear-gradient(135deg,#f0fdf4,#dcfce7);
  border: 1px solid #86efac; border-radius: 14px;
  padding: 1rem 1.25rem; margin-bottom: 2rem;
}
.saved-banner-icon {
  width: 40px; height: 40px; background: #10b981; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; color: #fff; font-size: 1.1rem;
}
.saved-banner-text strong { display: block; color: #065f46; font-weight: 700; font-size: .95rem; }
.saved-banner-text span   { color: #047857; font-size: .82rem; font-family: monospace; }

/* ── 2-column layout ── */
.payout-cols {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2.5rem;
  align-items: start;
}
@media(max-width:820px){ .payout-cols { grid-template-columns: 1fr; } }

/* ===================== IBAN CARD PREVIEW ===================== */
.iban-card-scene {
  perspective: 900px;
  width: 100%;
  max-width: 400px;
  margin: 0 auto 1.5rem;
}
.iban-card {
  position: relative;
  width: 100%;
  padding-top: 63%;          /* ratio 1.586:1 standard carte */
  border-radius: 20px;
  background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 35%, #0e4d7a 65%, #0369a1 100%);
  box-shadow:
    0 25px 60px rgba(3,105,161,.55),
    0 8px 20px rgba(0,0,0,.4),
    inset 0 1px 0 rgba(255,255,255,.15);
  overflow: hidden;
  transition: transform .4s cubic-bezier(.23,1,.32,1);
}
.iban-card:hover { transform: rotateY(-4deg) rotateX(3deg) scale(1.02); }

/* holographic shimmer */
.iban-card::before {
  content: '';
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(
    105deg,
    transparent 35%,
    rgba(255,255,255,.08) 50%,
    transparent 65%
  );
  background-size: 200% 100%;
  animation: ibanShimmer 4s ease-in-out infinite;
}
@keyframes ibanShimmer {
  0%,100% { background-position: 200% 0; }
  50%      { background-position: -200% 0; }
}

.iban-card-inner {
  position: absolute; inset: 0; padding: 7% 8%;
  display: flex; flex-direction: column; justify-content: space-between;
  z-index: 2;
  color: #fff;
}

/* Bank icon top-left */
.iban-card-bank-row {
  display: flex; align-items: center; justify-content: space-between;
}
.iban-card-bank-icon {
  width: 48px; height: 32px;
  background: rgba(255,255,255,.15);
  border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem;
  backdrop-filter: blur(4px);
  border: 1px solid rgba(255,255,255,.2);
}
.iban-card-sepa-badge {
  font-size: .65rem; font-weight: 700; letter-spacing: 1.5px;
  opacity: .75; text-transform: uppercase;
}

/* Country code */
.iban-card-country {
  font-size: .7rem; font-weight: 700;
  letter-spacing: 2px; opacity: .65;
  text-transform: uppercase;
}

/* IBAN number */
.iban-card-number {
  font-family: 'Courier New', monospace;
  font-size: clamp(.8rem, 2.2vw, 1.1rem);
  letter-spacing: .12em;
  font-weight: 600;
  line-height: 1.5;
  text-shadow: 0 1px 4px rgba(0,0,0,.4);
  min-height: 2.5em;
  word-break: break-all;
}

/* Bottom row — holder + IBAN label */
.iban-card-bottom {
  display: flex; align-items: flex-end; justify-content: space-between;
}
.iban-card-holder-block {}
.iban-card-holder-label {
  font-size: .6rem; letter-spacing: 1.5px; opacity: .55;
  text-transform: uppercase; margin-bottom: .2rem;
}
.iban-card-holder-name {
  font-size: .92rem; font-weight: 700; letter-spacing: .05em;
  text-transform: uppercase;
  text-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.iban-card-iban-label {
  font-size: .65rem; font-weight: 800; letter-spacing: 2px;
  opacity: .55; text-transform: uppercase;
}

/* Accepted badges below card */
.iban-accepted {
  display: flex; gap: .75rem; align-items: center; justify-content: center;
  flex-wrap: wrap; margin-top: .75rem;
}
.iban-badge {
  background: white; border: 1px solid #e5e7eb; border-radius: 8px;
  padding: .35rem .75rem; font-size: .7rem; font-weight: 700;
  color: #374151; letter-spacing: .5px;
  box-shadow: 0 1px 4px rgba(0,0,0,.08);
}

/* ===================== PREMIUM FORM ===================== */
.payout-form-card {
  background: #fff;
  border-radius: 20px;
  padding: 2.25rem;
  box-shadow: 0 4px 30px rgba(0,0,0,.07), 0 1px 8px rgba(0,0,0,.04);
  border: 1px solid #f3f4f6;
}
.payout-form-title {
  font-size: 1.15rem; font-weight: 700; color: #111827;
  margin: 0 0 1.75rem; padding-bottom: 1rem;
  border-bottom: 1px solid #f3f4f6;
}

.pf-group { margin-bottom: 1.5rem; }
.pf-label {
  display: flex; align-items: center; gap: .4rem;
  font-size: .82rem; font-weight: 700; color: #374151;
  letter-spacing: .3px; text-transform: uppercase;
  margin-bottom: .55rem;
}
.pf-label-icon { color: #0369a1; }

.pf-input-wrap { position: relative; }
.pf-input {
  width: 100%; padding: .85rem 1.1rem;
  border: 2px solid #e5e7eb; border-radius: 14px;
  font-size: 1rem; color: #111827;
  background: #fafafa;
  font-family: 'Courier New', monospace;
  letter-spacing: .06em;
  transition: border-color .2s, background .2s, box-shadow .2s;
  outline: none;
  box-sizing: border-box;
}
.pf-input:focus {
  border-color: #0369a1;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(3,105,161,.12);
}
.pf-input.pf-text { font-family: inherit; letter-spacing: normal; }
.pf-hint {
  color: #9ca3af; font-size: .78rem; margin-top: .4rem;
  padding-left: .25rem;
}
.pf-error { color: #ef4444; font-size: .8rem; margin-top: .4rem; }

/* Flag badge inside IBAN input */
.pf-flag-badge {
  position: absolute; right: .9rem; top: 50%; transform: translateY(-50%);
  background: #eff6ff; border: 1px solid #bfdbfe;
  border-radius: 6px; padding: .2rem .55rem;
  font-size: .72rem; font-weight: 800; color: #1d4ed8;
  letter-spacing: 1px; pointer-events: none;
  display: none;
}
.pf-flag-badge.visible { display: block; }

/* Submit row */
.pf-submit-row {
  display: flex; gap: 1rem; align-items: center;
  margin-top: 2rem;
}
.pf-submit-btn {
  flex: 1;
  background: linear-gradient(135deg, #0369a1 0%, #0e4d7a 100%);
  color: #fff; border: none; border-radius: 14px;
  padding: .9rem 1.5rem; font-size: 1rem; font-weight: 700;
  cursor: pointer; letter-spacing: .2px;
  box-shadow: 0 8px 25px rgba(3,105,161,.3);
  transition: transform .2s, box-shadow .2s;
}
.pf-submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(3,105,161,.4);
}
.pf-cancel-link {
  color: #6b7280; text-decoration: none; font-weight: 500;
  padding: .9rem 1.25rem; border-radius: 12px;
  transition: background .2s; font-size: .9rem;
}
.pf-cancel-link:hover { background: #f3f4f6; color: #374151; }

/* ── Info box ── */
.payout-infobox {
  margin-top: 2.5rem;
  padding: 1.5rem 1.75rem;
  background: linear-gradient(135deg, #eff6ff, #e0f2fe);
  border-left: 4px solid #0369a1;
  border-radius: 14px;
}
.payout-infobox h3 {
  font-weight: 700; margin: 0 0 .6rem; color: #1e40af; font-size: .95rem;
}
.payout-infobox ul {
  color: #1e3a8a; margin: 0; padding-left: 1.25rem; line-height: 2;
  font-size: .875rem;
}
</style>

<div class="payout-wrap">

  <div class="payout-header">
    <h1>Versements</h1>
    <p>Renseignez votre IBAN pour recevoir vos paiements en toute sécurité.</p>
  </div>

  @if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash-error">{{ session('error') }}</div>
  @endif

  @if($freelancerProfile && $freelancerProfile->bank_iban)
    <div class="saved-banner">
      <div class="saved-banner-icon"><i class="fas fa-check"></i></div>
      <div class="saved-banner-text">
        <strong>Coordonnées bancaires enregistrées</strong>
        <span>
          IBAN : {{ strtoupper(substr($freelancerProfile->bank_iban, 0, 4)) }}&nbsp;
          {{ substr($freelancerProfile->bank_iban, 4, 4) }}&nbsp;
          ••••&nbsp;••••&nbsp;••••&nbsp;{{ substr(preg_replace('/\s/','',$freelancerProfile->bank_iban), -4) }}
          &nbsp;·&nbsp; Titulaire : {{ $freelancerProfile->bank_account_holder }}
        </span>
      </div>
    </div>
  @endif

  <div class="payout-cols">

    {{-- ─────────────── IBAN CARD PREVIEW ─────────────── --}}
    <div>
      <div class="iban-card-scene">
        <div class="iban-card">
          <div class="iban-card-inner">
            <div class="iban-card-bank-row">
              <div class="iban-card-bank-icon">🏦</div>
              <span class="iban-card-sepa-badge">SEPA</span>
            </div>

            <div>
              <div class="iban-card-country" id="ibanCountryDisplay">— IBAN</div>
              <div class="iban-card-number" id="ibanNumberDisplay">•••• •••• •••• •••• •••• •••• •••</div>
            </div>

            <div class="iban-card-bottom">
              <div class="iban-card-holder-block">
                <div class="iban-card-holder-label">Titulaire</div>
                <div class="iban-card-holder-name" id="ibanHolderDisplay">VOTRE NOM</div>
              </div>
              <div class="iban-card-iban-label">IBAN</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iban-accepted">
        <span class="iban-badge">🇪🇺 SEPA</span>
        <span class="iban-badge">🔒 SSL</span>
        <span class="iban-badge">🛡 PCI-DSS</span>
        <span class="iban-badge">🏦 Virement</span>
      </div>
    </div>

    {{-- ─────────────── FORM ─────────────── --}}
    <div class="payout-form-card">
      <div class="payout-form-title">
        <i class="fas fa-university" style="color:#0369a1;margin-right:.4rem;"></i>
        Coordonnées bancaires
      </div>

      <form method="POST" action="{{ route('user.update_profile') }}" id="payout-form">
        @csrf

        {{-- IBAN --}}
        <div class="pf-group">
          <label class="pf-label" for="bank_iban">
            <span class="pf-label-icon"><i class="fas fa-hashtag"></i></span>
            IBAN
          </label>
          <div class="pf-input-wrap">
            <input
              type="text"
              id="bank_iban"
              name="bank_iban"
              class="pf-input @error('bank_iban') pf-input-error @enderror"
              value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
              placeholder="FR76 3000 6000 0112 3456 7890 189"
              maxlength="42"
              autocomplete="off"
              spellcheck="false"
            >
            <div class="pf-flag-badge" id="ibanFlagBadge"></div>
          </div>
          <div class="pf-hint">Saisissez votre IBAN sans espaces ou avec espaces — il sera formaté automatiquement.</div>
          @error('bank_iban')
            <div class="pf-error">{{ $message }}</div>
          @enderror
        </div>

        {{-- Titulaire --}}
        <div class="pf-group">
          <label class="pf-label" for="bank_account_holder">
            <span class="pf-label-icon"><i class="fas fa-user"></i></span>
            Titulaire du compte
          </label>
          <div class="pf-input-wrap">
            <input
              type="text"
              id="bank_account_holder"
              name="bank_account_holder"
              class="pf-input pf-text @error('bank_account_holder') pf-input-error @enderror"
              value="{{ old('bank_account_holder', $freelancerProfile->bank_account_holder ?? ($user->first_name . ' ' . $user->last_name)) }}"
              placeholder="{{ $user->first_name }} {{ $user->last_name }}"
            >
          </div>
          <div class="pf-hint">Le nom doit correspondre exactement à celui de votre compte bancaire.</div>
          @error('bank_account_holder')
            <div class="pf-error">{{ $message }}</div>
          @enderror
        </div>

        <div id="payout-errors"></div>

        <div class="pf-submit-row">
          <button type="submit" class="pf-submit-btn" id="payout-submit-btn">
            <i class="fas fa-shield-alt"></i>&nbsp; Enregistrer les coordonnées
          </button>
          <a href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" class="pf-cancel-link">
            Annuler
          </a>
        </div>

      </form>
    </div>
  </div>

  {{-- Info box --}}
  <div class="payout-infobox">
    <h3>💳 À savoir</h3>
    <ul>
      <li>Ces coordonnées sont nécessaires pour recevoir vos paiements</li>
      <li>Les versements sont effectués une fois par mois</li>
      <li>Vos informations bancaires sont sécurisées et chiffrées (AES-256)</li>
      <li>Seul l'IBAN vous est demandé — aucun RIB papier n'est nécessaire</li>
    </ul>
  </div>

</div>

<script>
(function () {

  var ibanInput   = document.getElementById('bank_iban');
  var holderInput = document.getElementById('bank_account_holder');
  var ibanDisplay = document.getElementById('ibanNumberDisplay');
  var holderDisp  = document.getElementById('ibanHolderDisplay');
  var countryDisp = document.getElementById('ibanCountryDisplay');
  var flagBadge   = document.getElementById('ibanFlagBadge');
  var form        = document.getElementById('payout-form');
  var submitBtn   = document.getElementById('payout-submit-btn');
  var errorsEl    = document.getElementById('payout-errors');

  if (!ibanInput) return;

  /* Longueurs IBAN par pays (ISO 13616) */
  var ibanLengths = {
    FR:27, DE:22, BE:16, NL:18, ES:24, IT:27, PT:25, LU:20, CH:21,
    AT:20, GB:22, IE:22, PL:28, CZ:24, HU:28, RO:24, DK:18, SE:24,
    FI:18, NO:15, GR:27, SK:24, HR:21, BG:22, SI:19, LT:20, LV:21,
    EE:20, CY:28, MT:31
  };

  var countryNames = {
    FR:'France', DE:'Allemagne', BE:'Belgique', NL:'Pays-Bas',
    ES:'Espagne', IT:'Italie', PT:'Portugal', LU:'Luxembourg',
    CH:'Suisse', AT:'Autriche', GB:'Royaume-Uni', IE:'Irlande',
    PL:'Pologne', CZ:'Tchéquie', HU:'Hongrie', RO:'Roumanie',
    DK:'Danemark', SE:'Suède', FI:'Finlande', NO:'Norvège',
    GR:'Grèce', SK:'Slovaquie', HR:'Croatie', BG:'Bulgarie',
    SI:'Slovénie', LT:'Lituanie', LV:'Lettonie', EE:'Estonie',
    CY:'Chypre', MT:'Malte'
  };

  /* ── Formatage IBAN ── */
  function formatIBAN(raw) {
    var clean = raw.toUpperCase().replace(/[^A-Z0-9]/g, '');
    var groups = clean.match(/.{1,4}/g) || [];
    return groups.join(' ');
  }

  /* ── Détection pays ── */
  function getCountryCode(raw) {
    var clean = raw.replace(/\s/g,'').toUpperCase();
    if (clean.length < 2) return null;
    return clean.substring(0, 2);
  }

  /* ── Live IBAN preview ── */
  function updateIBANDisplay(raw) {
    var clean  = raw.replace(/\s/g,'').toUpperCase();
    var cc     = getCountryCode(clean);
    var maxLen = (cc && ibanLengths[cc]) ? ibanLengths[cc] : 27;

    /* Affichage pays */
    if (cc && countryNames[cc]) {
      countryDisp.textContent = cc + ' — ' + countryNames[cc];
    } else {
      countryDisp.textContent = cc ? (cc + ' — IBAN') : '— IBAN';
    }

    /* Badge pays input */
    if (cc && /^[A-Z]{2}$/.test(cc)) {
      flagBadge.textContent = cc;
      flagBadge.classList.add('visible');
    } else {
      flagBadge.classList.remove('visible');
    }

    /* Padding avec •• */
    var padded = clean.padEnd(maxLen, '•');
    var groups = padded.match(/.{1,4}/g) || ['••••'];
    ibanDisplay.textContent = groups.join(' ');
  }

  /* ── Events ── */
  ibanInput.addEventListener('input', function () {
    var formatted = formatIBAN(this.value);
    this.value = formatted;
    updateIBANDisplay(formatted);
  });

  holderInput.addEventListener('input', function () {
    holderDisp.textContent = this.value.toUpperCase() || 'VOTRE NOM';
  });

  /* ── Init avec les valeurs PHP déjà remplies ── */
  if (ibanInput.value) {
    ibanInput.value = formatIBAN(ibanInput.value);
    updateIBANDisplay(ibanInput.value);
  }
  if (holderInput.value) {
    holderDisp.textContent = holderInput.value.toUpperCase();
  }

  /* ── Validation & submit ── */
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    errorsEl.innerHTML = '';

    var rawIBAN = ibanInput.value.replace(/\s/g,'').toUpperCase();
    var holder  = holderInput.value.trim();
    var cc      = rawIBAN.length >= 2 ? rawIBAN.substring(0,2) : '';
    var expected = ibanLengths[cc] || 15;
    var errors  = [];

    if (rawIBAN.length < expected) {
      errors.push('IBAN incomplet — longueur attendue pour la ' + (countryNames[cc]||'zone') + ' : ' + expected + ' caractères (actuellement ' + rawIBAN.length + ')');
    }
    if (!/^[A-Z]{2}[0-9]{2}/.test(rawIBAN)) {
      errors.push('Format IBAN invalide (doit commencer par un code pays puis 2 chiffres de contrôle)');
    }
    if (!holder) errors.push('Le nom du titulaire est requis');

    if (errors.length > 0) {
      errorsEl.innerHTML = '<div style="background:#fef2f2;color:#991b1b;border:1px solid #fca5a5;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1rem;font-size:.875rem;">' +
        errors.map(function(e){ return '• ' + e; }).join('<br>') + '</div>';
      return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp; Sécurisation en cours…';
    form.submit();
  });

})();
</script>
@endsection

