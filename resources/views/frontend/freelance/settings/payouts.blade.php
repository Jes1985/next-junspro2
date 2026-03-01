@extends('frontend.freelance.layouts.app')

@section('content')
<style>
/* =====================================================================
   PAYOUT SETTINGS â€” International Banking, Ultra-Premium
   ===================================================================== */
.payout-wrap { max-width: 1120px; margin: 0 auto; padding: 2.5rem 1.5rem; }
.payout-header { margin-bottom: 2.5rem; }
.payout-header h1 { font-size: 1.9rem; font-weight: 800; color: #111827; margin: 0 0 .35rem; letter-spacing: -.5px; }
.payout-header p  { color: #6b7280; font-size: 1rem; margin: 0; }

.flash-ok  { background:#d1fae5; border:1px solid #10b981; color:#065f46; padding:1rem 1.25rem; border-radius:12px; margin-bottom:2rem; font-weight:500; }
.flash-err { background:#fee2e2; border:1px solid #ef4444; color:#991b1b; padding:1rem 1.25rem; border-radius:12px; margin-bottom:2rem; font-weight:500; }

/* â”€â”€ Saved banner â”€â”€ */
.saved-banner {
  display:flex; align-items:center; gap:.85rem;
  background:linear-gradient(135deg,#f0fdf4,#dcfce7);
  border:1px solid #86efac; border-radius:14px;
  padding:1rem 1.25rem; margin-bottom:2rem;
}
.saved-ic { width:42px; height:42px; background:#10b981; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#fff; font-size:1.1rem; }
.saved-txt strong { display:block; color:#065f46; font-weight:700; font-size:.9rem; }
.saved-txt span   { color:#047857; font-size:.8rem; font-family:monospace; }

/* â”€â”€ STEP 1 â€” country selector â”€â”€ */
.step-block { background:#fff; border-radius:20px; padding:2rem; box-shadow:0 4px 30px rgba(0,0,0,.07); border:1px solid #f3f4f6; margin-bottom:2rem; }
.step-label { font-size:.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#0369a1; margin-bottom:.75rem; }
.step-title { font-size:1.1rem; font-weight:700; color:#111827; margin:0 0 1.25rem; }

/* Search input */
.country-search-wrap { position:relative; }
.country-search-input {
  width:100%; padding:.85rem 1.1rem .85rem 3rem;
  border:2px solid #e5e7eb; border-radius:14px;
  font-size:1rem; color:#111827; background:#fafafa;
  outline:none; transition:border-color .2s, box-shadow .2s;
  box-sizing:border-box;
}
.country-search-input:focus { border-color:#0369a1; background:#fff; box-shadow:0 0 0 4px rgba(3,105,161,.1); }
.country-search-icon { position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:#9ca3af; pointer-events:none; }
.country-search-clear {
  position:absolute; right:.9rem; top:50%; transform:translateY(-50%);
  color:#9ca3af; cursor:pointer; font-size:1.1rem; display:none;
}
.country-search-clear.vis { display:block; }

/* Dropdown */
.country-dropdown {
  position:absolute; top:calc(100% + 6px); left:0; right:0; z-index:100;
  background:#fff; border:1.5px solid #e5e7eb; border-radius:14px;
  box-shadow:0 20px 60px rgba(0,0,0,.15); max-height:320px; overflow-y:auto;
  display:none;
}
.country-dropdown.open { display:block; }
.country-opt {
  display:flex; align-items:center; gap:.75rem;
  padding:.7rem 1rem; cursor:pointer; transition:background .15s;
  border-bottom:1px solid #f9fafb;
}
.country-opt:last-child { border-bottom:none; }
.country-opt:hover, .country-opt.active { background:#eff6ff; }
.country-opt-flag { font-size:1.4rem; line-height:1; flex-shrink:0; }
.country-opt-info {}
.country-opt-name { font-size:.9rem; font-weight:600; color:#111827; }
.country-opt-system { font-size:.7rem; color:#6b7280; font-weight:500; letter-spacing:.3px; }
.country-opt-none { padding:1.5rem; text-align:center; color:#9ca3af; font-size:.875rem; }

/* Selected chip */
.country-selected-chip {
  display:none; align-items:center; gap:.75rem;
  background:#eff6ff; border:1.5px solid #bfdbfe;
  border-radius:12px; padding:.6rem 1rem; margin-top:.75rem;
}
.country-selected-chip.vis { display:flex; }
.country-chip-flag { font-size:1.5rem; }
.country-chip-name { font-size:.92rem; font-weight:700; color:#1e40af; }
.country-chip-sys  { font-size:.72rem; color:#3b82f6; font-weight:600; letter-spacing:.5px; text-transform:uppercase; }
.country-chip-change { margin-left:auto; font-size:.8rem; color:#0369a1; cursor:pointer; font-weight:600; text-decoration:underline; }

/* â”€â”€ STEP 2 â€” form â”€â”€ */
.payout-cols { display:grid; grid-template-columns:1fr 1fr; gap:2.5rem; align-items:start; }
@media(max-width:820px){ .payout-cols { grid-template-columns:1fr; } }

/* â”€â”€ BANK CARD PREVIEW â”€â”€ */
.bank-card-scene { perspective:900px; width:100%; max-width:400px; margin:0 auto 1.25rem; }
.bank-card {
  position:relative; width:100%; padding-top:63%;
  border-radius:20px;
  background:var(--card-bg, linear-gradient(135deg,#0f172a,#0369a1));
  box-shadow:0 25px 60px var(--card-shadow,rgba(3,105,161,.5)), 0 8px 20px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.15);
  overflow:hidden;
  transition:background .5s, transform .4s cubic-bezier(.23,1,.32,1), box-shadow .5s;
}
.bank-card:hover { transform:rotateY(-4deg) rotateX(3deg) scale(1.02); }
.bank-card::before {
  content:''; position:absolute; inset:0; z-index:1;
  background:linear-gradient(105deg,transparent 35%,rgba(255,255,255,.08) 50%,transparent 65%);
  background-size:200% 100%;
  animation:bkShimmer 4s ease-in-out infinite;
}
@keyframes bkShimmer { 0%,100%{background-position:200% 0} 50%{background-position:-200% 0} }
.bank-card-inner {
  position:absolute; inset:0; padding:7% 8%;
  display:flex; flex-direction:column; justify-content:space-between;
  z-index:2; color:#fff;
}
.bk-top { display:flex; align-items:center; justify-content:space-between; }
.bk-icon { width:48px; height:32px; background:rgba(255,255,255,.15); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,.2); }
.bk-system-badge { font-size:.62rem; font-weight:800; letter-spacing:1.5px; opacity:.75; text-transform:uppercase; }
.bk-country-flag  { font-size:1.4rem; }
.bk-mid {}
.bk-label { font-size:.6rem; font-weight:700; letter-spacing:2px; opacity:.55; text-transform:uppercase; margin-bottom:.25rem; }
.bk-number { font-family:'Courier New',monospace; font-size:clamp(.75rem,2vw,1rem); letter-spacing:.1em; font-weight:600; line-height:1.6; text-shadow:0 1px 4px rgba(0,0,0,.4); word-break:break-all; min-height:2.4em; }
.bk-routing-row { display:flex; gap:1.5rem; margin-top:.4rem; }
.bk-routing-block .bk-label { font-size:.55rem; }
.bk-routing-val { font-family:'Courier New',monospace; font-size:clamp(.7rem,1.8vw,.85rem); font-weight:600; letter-spacing:.06em; }
.bk-bottom { display:flex; align-items:flex-end; justify-content:space-between; }
.bk-holder-label { font-size:.55rem; letter-spacing:1.5px; opacity:.55; text-transform:uppercase; margin-bottom:.15rem; }
.bk-holder-name  { font-size:.88rem; font-weight:700; letter-spacing:.05em; text-transform:uppercase; text-shadow:0 1px 3px rgba(0,0,0,.4); }
.bk-type-stamp   { font-size:.65rem; font-weight:800; letter-spacing:1.5px; opacity:.5; text-transform:uppercase; }

/* accepted badges */
.bank-badges { display:flex; gap:.6rem; justify-content:center; flex-wrap:wrap; margin-top:.5rem; }
.bank-badge { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.3rem .7rem; font-size:.68rem; font-weight:700; color:#374151; box-shadow:0 1px 4px rgba(0,0,0,.07); }

/* â”€â”€ FORM â”€â”€ */
.pf-card { background:#fff; border-radius:20px; padding:2.25rem; box-shadow:0 4px 30px rgba(0,0,0,.07); border:1px solid #f3f4f6; }
.pf-title { font-size:1.1rem; font-weight:700; color:#111827; margin:0 0 1.75rem; padding-bottom:1rem; border-bottom:1px solid #f3f4f6; }
.pf-group { margin-bottom:1.4rem; }
.pf-label { display:flex; align-items:center; gap:.4rem; font-size:.78rem; font-weight:700; color:#374151; letter-spacing:.3px; text-transform:uppercase; margin-bottom:.5rem; }
.pf-label i { color:var(--accent,#0369a1); }
.pf-wrap { position:relative; }
.pf-input {
  width:100%; padding:.82rem 1rem; border:2px solid #e5e7eb; border-radius:14px;
  font-size:.97rem; color:#111827; background:#fafafa; font-family:'Courier New',monospace;
  letter-spacing:.05em; outline:none; transition:border-color .2s,background .2s,box-shadow .2s;
  box-sizing:border-box;
}
.pf-input:focus { border-color:var(--accent,#0369a1); background:#fff; box-shadow:0 0 0 4px rgba(3,105,161,.1); }
.pf-input.pf-text { font-family:inherit; letter-spacing:normal; }
.pf-hint  { color:#9ca3af; font-size:.75rem; margin-top:.35rem; padding-left:.2rem; }
.pf-err   { color:#ef4444; font-size:.78rem; margin-top:.35rem; }
.pf-badge { position:absolute; right:.9rem; top:50%; transform:translateY(-50%); background:#eff6ff; border:1px solid #bfdbfe; border-radius:6px; padding:.18rem .5rem; font-size:.68rem; font-weight:800; color:#1d4ed8; pointer-events:none; display:none; }
.pf-badge.vis { display:block; }

/* Two-col mini grid for routing+account side by side */
.pf-row2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
@media(max-width:500px){ .pf-row2 { grid-template-columns:1fr; } }

/* Bank sections (only one visible at a time) */
.bank-section { display:none; }
.bank-section.active { display:block; }

.pf-submit-btn {
  width:100%; background:linear-gradient(135deg,var(--accent,#0369a1),#0e4d7a); color:#fff;
  border:none; border-radius:14px; padding:.9rem 1.5rem; font-size:1rem; font-weight:700;
  cursor:pointer; letter-spacing:.2px; box-shadow:0 8px 25px rgba(3,105,161,.3);
  transition:transform .2s,box-shadow .2s; margin-top:1.75rem;
}
.pf-submit-btn:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(3,105,161,.4); }

/* â”€â”€ Info box â”€â”€ */
.payout-info { margin-top:2.5rem; padding:1.5rem 1.75rem; background:linear-gradient(135deg,#eff6ff,#e0f2fe); border-left:4px solid #0369a1; border-radius:14px; }
.payout-info h3 { font-weight:700; margin:0 0 .6rem; color:#1e40af; font-size:.95rem; }
.payout-info ul { color:#1e3a8a; margin:0; padding-left:1.25rem; line-height:2; font-size:.865rem; }

/* â”€â”€ Placeholder state â”€â”€ */
.step2-placeholder {
  background:linear-gradient(135deg,#f8fafc,#f1f5f9);
  border:2px dashed #cbd5e1; border-radius:20px;
  padding:3rem 2rem; text-align:center; color:#94a3b8;
}
.step2-placeholder i { font-size:2.5rem; display:block; margin-bottom:1rem; color:#cbd5e1; }
.step2-placeholder p { margin:0; font-size:.95rem; font-weight:500; }
</style>

<div class="payout-wrap">

  <div class="payout-header">
    <h1>Versements</h1>
    <p>Renseignez vos coordonnÃ©es bancaires pour recevoir vos paiements, quel que soit votre pays.</p>
  </div>

  @if(session('success'))
    <div class="flash-ok">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash-err">{{ session('error') }}</div>
  @endif
  @if($errors->any())
    <div class="flash-err">{{ $errors->first() }}</div>
  @endif

  @if($freelancerProfile && ($freelancerProfile->bank_iban || $freelancerProfile->bank_account_holder))
    <div class="saved-banner">
      <div class="saved-ic"><i class="fas fa-check"></i></div>
      <div class="saved-txt">
        <strong>CoordonnÃ©es bancaires enregistrÃ©es</strong>
        <span>
          @if($freelancerProfile->bank_country)
            Pays : {{ $freelancerProfile->bank_country }} &nbsp;Â·&nbsp;
          @endif
          @if($freelancerProfile->bank_iban)
            RÃ©f. : {{ substr($freelancerProfile->bank_iban,0,8) }}â€¢â€¢â€¢â€¢{{ substr($freelancerProfile->bank_iban,-4) }}
          @endif
          &nbsp;Â·&nbsp; {{ $freelancerProfile->bank_account_holder }}
        </span>
      </div>
    </div>
  @endif

  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       STEP 1 â€” Choisir son pays
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  <div class="step-block">
    <div class="step-label">Ã‰tape 1</div>
    <div class="step-title">Dans quel pays se trouve votre compte bancaire ?</div>

    <div class="country-search-wrap" id="countrySearchWrap">
      <span class="country-search-icon"><i class="fas fa-search"></i></span>
      <input type="text" class="country-search-input" id="countrySearchInput"
             placeholder="Rechercher un paysâ€¦" autocomplete="off" />
      <span class="country-search-clear" id="countrySearchClear">âœ•</span>
      <div class="country-dropdown" id="countryDropdown"></div>
    </div>

    <div class="country-selected-chip" id="selectedChip">
      <span class="country-chip-flag" id="chipFlag"></span>
      <div>
        <div class="country-chip-name" id="chipName"></div>
        <div class="country-chip-sys"  id="chipSys"></div>
      </div>
      <span class="country-chip-change" id="chipChange">Modifier</span>
    </div>
  </div>

  {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       STEP 2 â€” Formulaire (masquÃ© jusqu'au choix pays)
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
  <div id="step2Area">
    <div class="step2-placeholder" id="step2Placeholder">
      <i class="fas fa-globe"></i>
      <p>SÃ©lectionnez votre pays pour afficher le formulaire bancaire adaptÃ©</p>
    </div>

    <div id="step2Form" style="display:none;">
      <div class="step-block" style="margin-bottom:2rem;">
        <div class="step-label">Ã‰tape 2</div>
        <div class="step-title" id="formTitle">CoordonnÃ©es bancaires</div>
      </div>

      <div class="payout-cols">

        {{-- Card preview --}}
        <div>
          <div class="bank-card-scene">
            <div class="bank-card" id="bankCard">
              <div class="bank-card-inner">
                <div class="bk-top">
                  <div class="bk-icon" id="bkIcon">ðŸ¦</div>
                  <span class="bk-country-flag" id="bkFlag"></span>
                  <span class="bk-system-badge" id="bkSysBadge">BANK</span>
                </div>
                <div class="bk-mid">
                  <div class="bk-label" id="bkNumberLabel">IBAN</div>
                  <div class="bk-number" id="bkNumber">â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢</div>
                  <div class="bk-routing-row" id="bkRoutingRow" style="display:none;">
                    <div class="bk-routing-block">
                      <div class="bk-label" id="bkRoutingLabel">ROUTING</div>
                      <div class="bk-routing-val" id="bkRoutingVal">â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢</div>
                    </div>
                  </div>
                </div>
                <div class="bk-bottom">
                  <div>
                    <div class="bk-holder-label">Titulaire</div>
                    <div class="bk-holder-name" id="bkHolder">VOTRE NOM</div>
                  </div>
                  <div class="bk-type-stamp" id="bkTypeStamp">VIREMENT</div>
                </div>
              </div>
            </div>
          </div>
          <div class="bank-badges" id="bankBadges"></div>
        </div>

        {{-- Form --}}
        <div class="pf-card">
          <div class="pf-title" id="pfTitle"><i class="fas fa-university"></i>&nbsp; DÃ©tails bancaires</div>
          <form method="POST" action="{{ route('freelance.settings.payouts.store') }}" id="payoutForm">
            @csrf
            <input type="hidden" name="bank_country" id="hBankCountry" value="{{ old('bank_country', $freelancerProfile->bank_country ?? '') }}">
            <input type="hidden" name="bank_type"    id="hBankType"    value="{{ old('bank_type',    $freelancerProfile->bank_type    ?? '') }}">

            {{-- Titulaire (always visible) --}}
            <div class="pf-group">
              <label class="pf-label" for="bank_account_holder"><i class="fas fa-user"></i>&nbsp; Titulaire du compte</label>
              <div class="pf-wrap">
                <input type="text" id="bank_account_holder" name="bank_account_holder"
                       class="pf-input pf-text"
                       value="{{ old('bank_account_holder', $freelancerProfile->bank_account_holder ?? ($user->first_name.' '.$user->last_name)) }}"
                       placeholder="{{ $user->first_name }} {{ $user->last_name }}" />
              </div>
              <div class="pf-hint">Exactement comme sur votre relevÃ© bancaire.</div>
            </div>

            {{-- â”€â”€ IBAN countries â”€â”€ --}}
            <div class="bank-section" id="sec-iban">
              <div class="pf-group">
                <label class="pf-label" for="fi_iban"><i class="fas fa-hashtag"></i>&nbsp; IBAN</label>
                <div class="pf-wrap">
                  <input type="text" id="fi_iban" name="bank_iban" class="pf-input"
                         value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                         placeholder="FR76 3000 6000 0112 3456 7890 189" maxlength="42" autocomplete="off" />
                  <div class="pf-badge" id="fi_ibanBadge"></div>
                </div>
                <div class="pf-hint" id="fi_ibanHint">Format : groupes de 4 caractÃ¨res sÃ©parÃ©s par des espaces.</div>
              </div>
            </div>

            {{-- â”€â”€ USA â€” ACH â”€â”€ --}}
            <div class="bank-section" id="sec-ach">
              <div class="pf-row2">
                <div class="pf-group">
                  <label class="pf-label" for="fi_routing_ach"><i class="fas fa-route"></i>&nbsp; ABA Routing #</label>
                  <input type="text" id="fi_routing_ach" name="bank_routing" class="pf-input"
                         value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                         placeholder="021000021" maxlength="9" />
                  <div class="pf-hint">9 chiffres (bas du chÃ¨que)</div>
                </div>
                <div class="pf-group">
                  <label class="pf-label" for="fi_account_ach"><i class="fas fa-credit-card"></i>&nbsp; Account #</label>
                  <input type="text" id="fi_account_ach" name="bank_iban" class="pf-input"
                         value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                         placeholder="123456789012" maxlength="17" />
                  <div class="pf-hint">4â€“17 chiffres</div>
                </div>
              </div>
            </div>

            {{-- â”€â”€ Canada â€” EFT â”€â”€ --}}
            <div class="bank-section" id="sec-eft">
              <div class="pf-row2">
                <div class="pf-group">
                  <label class="pf-label" for="fi_transit"><i class="fas fa-code-branch"></i>&nbsp; Transit (5)</label>
                  <input type="text" id="fi_transit" name="bank_routing" class="pf-input"
                         value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                         placeholder="00011" maxlength="8" />
                </div>
                <div class="pf-group">
                  <label class="pf-label" for="fi_account_eft"><i class="fas fa-credit-card"></i>&nbsp; NumÃ©ro compte</label>
                  <input type="text" id="fi_account_eft" name="bank_iban" class="pf-input"
                         value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                         placeholder="1234567" maxlength="12" />
                </div>
              </div>
              <div class="pf-group">
                <label class="pf-label" for="fi_institution"><i class="fas fa-university"></i>&nbsp; Institution # (3)</label>
                <input type="text" id="fi_institution" name="bank_extra" class="pf-input"
                       placeholder="004" maxlength="3" />
                <div class="pf-hint">Ex : 001 = BMO, 002 = Scotiabank, 004 = TD</div>
              </div>
            </div>

            {{-- â”€â”€ Australia/NZ â€” BSB â”€â”€ --}}
            <div class="bank-section" id="sec-bsb">
              <div class="pf-row2">
                <div class="pf-group">
                  <label class="pf-label" for="fi_bsb"><i class="fas fa-code-branch"></i>&nbsp; BSB</label>
                  <input type="text" id="fi_bsb" name="bank_routing" class="pf-input"
                         value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                         placeholder="062-000" maxlength="7" />
                  <div class="pf-hint">6 chiffres (format XXX-XXX)</div>
                </div>
                <div class="pf-group">
                  <label class="pf-label" for="fi_account_bsb"><i class="fas fa-credit-card"></i>&nbsp; Account #</label>
                  <input type="text" id="fi_account_bsb" name="bank_iban" class="pf-input"
                         value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                         placeholder="12345678" maxlength="9" />
                </div>
              </div>
            </div>

            {{-- â”€â”€ India â€” IFSC â”€â”€ --}}
            <div class="bank-section" id="sec-ifsc">
              <div class="pf-group">
                <label class="pf-label" for="fi_ifsc"><i class="fas fa-code"></i>&nbsp; Code IFSC</label>
                <input type="text" id="fi_ifsc" name="bank_routing" class="pf-input"
                       value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                       placeholder="SBIN0000001" maxlength="11" style="text-transform:uppercase;" />
                <div class="pf-hint">11 caractÃ¨res : 4 lettres + 0 + 6 alphanumÃ©riques</div>
              </div>
              <div class="pf-group">
                <label class="pf-label" for="fi_account_ifsc"><i class="fas fa-credit-card"></i>&nbsp; NumÃ©ro de compte</label>
                <input type="text" id="fi_account_ifsc" name="bank_iban" class="pf-input"
                       value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                       placeholder="00000123456789012" maxlength="18" />
              </div>
            </div>

            {{-- â”€â”€ Mexico â€” CLABE â”€â”€ --}}
            <div class="bank-section" id="sec-clabe">
              <div class="pf-group">
                <label class="pf-label" for="fi_clabe"><i class="fas fa-hashtag"></i>&nbsp; CLABE interbancaire</label>
                <input type="text" id="fi_clabe" name="bank_iban" class="pf-input"
                       value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                       placeholder="032180000118359719" maxlength="18" />
                <div class="pf-hint">18 chiffres â€” CLABE interbancaria</div>
              </div>
            </div>

            {{-- â”€â”€ Brazil â€” PIX â”€â”€ --}}
            <div class="bank-section" id="sec-pix">
              <div class="pf-group">
                <label class="pf-label" for="fi_pix"><i class="fas fa-bolt"></i>&nbsp; ClÃ© PIX</label>
                <input type="text" id="fi_pix" name="bank_iban" class="pf-input pf-text"
                       value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                       placeholder="CPF, CNPJ, e-mail, tÃ©lÃ©phone ou clÃ© alÃ©atoire" maxlength="80" />
                <div class="pf-hint">Peut Ãªtre un CPF/CNPJ, e-mail, numÃ©ro de tÃ©lÃ©phone (+55â€¦) ou une clÃ© alÃ©atoire.</div>
              </div>
            </div>

            {{-- â”€â”€ UK â€” Sort Code â”€â”€ --}}
            <div class="bank-section" id="sec-sortcode">
              <div class="pf-row2">
                <div class="pf-group">
                  <label class="pf-label" for="fi_sortcode"><i class="fas fa-code-branch"></i>&nbsp; Sort Code</label>
                  <input type="text" id="fi_sortcode" name="bank_routing" class="pf-input"
                         value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                         placeholder="20-00-00" maxlength="8" />
                  <div class="pf-hint">6 chiffres (XX-XX-XX)</div>
                </div>
                <div class="pf-group">
                  <label class="pf-label" for="fi_account_sc"><i class="fas fa-credit-card"></i>&nbsp; Account #</label>
                  <input type="text" id="fi_account_sc" name="bank_iban" class="pf-input"
                         value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                         placeholder="31926819" maxlength="8" />
                  <div class="pf-hint">8 chiffres</div>
                </div>
              </div>
            </div>

            {{-- â”€â”€ Generic  â”€â”€ --}}
            <div class="bank-section" id="sec-generic">
              <div class="pf-group">
                <label class="pf-label" for="fi_bank_name"><i class="fas fa-university"></i>&nbsp; Nom de la banque</label>
                <input type="text" id="fi_bank_name" name="bank_routing" class="pf-input pf-text"
                       value="{{ old('bank_routing', $freelancerProfile->bank_routing ?? '') }}"
                       placeholder="Ex : Citibank, ICBCâ€¦" maxlength="60" />
              </div>
              <div class="pf-group">
                <label class="pf-label" for="fi_account_gen"><i class="fas fa-credit-card"></i>&nbsp; NumÃ©ro de compte</label>
                <input type="text" id="fi_account_gen" name="bank_iban" class="pf-input"
                       value="{{ old('bank_iban', $freelancerProfile->bank_iban ?? '') }}"
                       placeholder="0000000000000000" maxlength="34" />
              </div>
            </div>

            <div id="pfErrors"></div>

            <button type="submit" class="pf-submit-btn" id="pfSubmitBtn">
              <i class="fas fa-shield-alt"></i>&nbsp; Enregistrer les coordonnÃ©es
            </button>
          </form>
        </div>
      </div>{{-- /.payout-cols --}}
    </div>{{-- /#step2Form --}}
  </div>{{-- /#step2Area --}}

  <div class="payout-info">
    <h3>ðŸ”’ SÃ©curitÃ© & informations</h3>
    <ul>
      <li>Vos donnÃ©es bancaires sont chiffrÃ©es (AES-256) et jamais partagÃ©es avec des tiers</li>
      <li>Les versements sont effectuÃ©s une fois par mois, aprÃ¨s validation de vos missions</li>
      <li>Junspro prend en charge les virements SEPA, ACH, SWIFT et les systÃ¨mes locaux</li>
      <li>En cas de doute, contactez le support : <strong>support@junspro.com</strong></li>
    </ul>
  </div>

</div>{{-- /.payout-wrap --}}

<script>
(function () {

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     1. DONNÃ‰ES â€” Pays + systÃ¨me bancaire
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  var COUNTRIES = [
    // â”€â”€â”€ EUROPE / SEPA â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'FR',f:'ðŸ‡«ðŸ‡·',n:'France',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'DE',f:'ðŸ‡©ðŸ‡ª',n:'Allemagne',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'ES',f:'ðŸ‡ªðŸ‡¸',n:'Espagne',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'IT',f:'ðŸ‡®ðŸ‡¹',n:'Italie',               s:'IBAN (SEPA)',    t:'iban'},
    {c:'BE',f:'ðŸ‡§ðŸ‡ª',n:'Belgique',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'NL',f:'ðŸ‡³ðŸ‡±',n:'Pays-Bas',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'PT',f:'ðŸ‡µðŸ‡¹',n:'Portugal',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'CH',f:'ðŸ‡¨ðŸ‡­',n:'Suisse',               s:'IBAN (SEPA)',    t:'iban'},
    {c:'AT',f:'ðŸ‡¦ðŸ‡¹',n:'Autriche',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'LU',f:'ðŸ‡±ðŸ‡º',n:'Luxembourg',           s:'IBAN (SEPA)',    t:'iban'},
    {c:'IE',f:'ðŸ‡®ðŸ‡ª',n:'Irlande',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'PL',f:'ðŸ‡µðŸ‡±',n:'Pologne',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'SE',f:'ðŸ‡¸ðŸ‡ª',n:'SuÃ¨de',                s:'IBAN (SEPA)',    t:'iban'},
    {c:'DK',f:'ðŸ‡©ðŸ‡°',n:'Danemark',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'NO',f:'ðŸ‡³ðŸ‡´',n:'NorvÃ¨ge',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'FI',f:'ðŸ‡«ðŸ‡®',n:'Finlande',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'CZ',f:'ðŸ‡¨ðŸ‡¿',n:'TchÃ©quie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'HU',f:'ðŸ‡­ðŸ‡º',n:'Hongrie',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'RO',f:'ðŸ‡·ðŸ‡´',n:'Roumanie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'SK',f:'ðŸ‡¸ðŸ‡°',n:'Slovaquie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'HR',f:'ðŸ‡­ðŸ‡·',n:'Croatie',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'SI',f:'ðŸ‡¸ðŸ‡®',n:'SlovÃ©nie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'BG',f:'ðŸ‡§ðŸ‡¬',n:'Bulgarie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'GR',f:'ðŸ‡¬ðŸ‡·',n:'GrÃ¨ce',                s:'IBAN (SEPA)',    t:'iban'},
    {c:'LT',f:'ðŸ‡±ðŸ‡¹',n:'Lituanie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'LV',f:'ðŸ‡±ðŸ‡»',n:'Lettonie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'EE',f:'ðŸ‡ªðŸ‡ª',n:'Estonie',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'CY',f:'ðŸ‡¨ðŸ‡¾',n:'Chypre',               s:'IBAN (SEPA)',    t:'iban'},
    {c:'MT',f:'ðŸ‡²ðŸ‡¹',n:'Malte',                s:'IBAN (SEPA)',    t:'iban'},
    // â”€â”€â”€ UK â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'GB',f:'ðŸ‡¬ðŸ‡§',n:'Royaume-Uni',          s:'Sort Code / BACS',t:'sortcode'},
    // â”€â”€â”€ MOYEN-ORIENT / IBAN â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'AE',f:'ðŸ‡¦ðŸ‡ª',n:'Ã‰mirats arabes unis',  s:'IBAN',           t:'iban'},
    {c:'SA',f:'ðŸ‡¸ðŸ‡¦',n:'Arabie saoudite',       s:'IBAN',           t:'iban'},
    {c:'QA',f:'ðŸ‡¶ðŸ‡¦',n:'Qatar',                 s:'IBAN',           t:'iban'},
    {c:'BH',f:'ðŸ‡§ðŸ‡­',n:'BahreÃ¯n',              s:'IBAN',           t:'iban'},
    {c:'KW',f:'ðŸ‡°ðŸ‡¼',n:'KoweÃ¯t',               s:'IBAN',           t:'iban'},
    {c:'JO',f:'ðŸ‡¯ðŸ‡´',n:'Jordanie',             s:'IBAN',           t:'iban'},
    {c:'IL',f:'ðŸ‡®ðŸ‡±',n:'IsraÃ«l',               s:'IBAN',           t:'iban'},
    {c:'TR',f:'ðŸ‡¹ðŸ‡·',n:'Turquie',              s:'IBAN',           t:'iban'},
    {c:'LB',f:'ðŸ‡±ðŸ‡§',n:'Liban',                s:'IBAN',           t:'iban'},
    // â”€â”€â”€ AFRIQUE / IBAN â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'MA',f:'ðŸ‡²ðŸ‡¦',n:'Maroc',                s:'IBAN',           t:'iban'},
    {c:'TN',f:'ðŸ‡¹ðŸ‡³',n:'Tunisie',              s:'IBAN',           t:'iban'},
    {c:'DZ',f:'ðŸ‡©ðŸ‡¿',n:'AlgÃ©rie',              s:'IBAN',           t:'iban'},
    {c:'MU',f:'ðŸ‡²ðŸ‡º',n:'ÃŽle Maurice',          s:'IBAN',           t:'iban'},
    {c:'CM',f:'ðŸ‡¨ðŸ‡²',n:'Cameroun',             s:'IBAN',           t:'iban'},
    {c:'SN',f:'ðŸ‡¸ðŸ‡³',n:'SÃ©nÃ©gal',              s:'IBAN',           t:'iban'},
    {c:'CI',f:'ðŸ‡¨ðŸ‡®',n:"CÃ´te d'Ivoire",        s:'IBAN',           t:'iban'},
    {c:'GA',f:'ðŸ‡¬ðŸ‡¦',n:'Gabon',                s:'IBAN',           t:'iban'},
    // â”€â”€â”€ AMÃ‰RIQUES â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'US',f:'ðŸ‡ºðŸ‡¸',n:'Ã‰tats-Unis',           s:'ABA / ACH',      t:'ach'},
    {c:'CA',f:'ðŸ‡¨ðŸ‡¦',n:'Canada',               s:'EFT',            t:'eft'},
    {c:'MX',f:'ðŸ‡²ðŸ‡½',n:'Mexique',              s:'CLABE',          t:'clabe'},
    {c:'BR',f:'ðŸ‡§ðŸ‡·',n:'BrÃ©sil',               s:'PIX',            t:'pix'},
    {c:'AR',f:'ðŸ‡¦ðŸ‡·',n:'Argentine',            s:'CBU / CVU',      t:'generic'},
    {c:'CO',f:'ðŸ‡¨ðŸ‡´',n:'Colombie',             s:'NumÃ©ro compte',  t:'generic'},
    {c:'CL',f:'ðŸ‡¨ðŸ‡±',n:'Chili',                s:'NumÃ©ro compte',  t:'generic'},
    // â”€â”€â”€ ASIE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    {c:'IN',f:'ðŸ‡®ðŸ‡³',n:'Inde',                 s:'IFSC / NEFT',    t:'ifsc'},
    {c:'CN',f:'ðŸ‡¨ðŸ‡³',n:'Chine',                s:'NumÃ©ro compte',  t:'generic'},
    {c:'JP',f:'ðŸ‡¯ðŸ‡µ',n:'Japon',                s:'Zengin',         t:'generic'},
    {c:'AU',f:'ðŸ‡¦ðŸ‡º',n:'Australie',            s:'BSB',            t:'bsb'},
    {c:'NZ',f:'ðŸ‡³ðŸ‡¿',n:'Nouvelle-ZÃ©lande',     s:'BSB',            t:'bsb'},
    {c:'SG',f:'ðŸ‡¸ðŸ‡¬',n:'Singapour',            s:'PayNow / FAST',  t:'generic'},
    {c:'HK',f:'ðŸ‡­ðŸ‡°',n:'Hong Kong',            s:'FPS',            t:'generic'},
    {c:'KR',f:'ðŸ‡°ðŸ‡·',n:'CorÃ©e du Sud',         s:'NumÃ©ro compte',  t:'generic'},
    {c:'TH',f:'ðŸ‡¹ðŸ‡­',n:'ThaÃ¯lande',            s:'PromptPay',      t:'generic'},
    {c:'MY',f:'ðŸ‡²ðŸ‡¾',n:'Malaisie',             s:'NumÃ©ro compte',  t:'generic'},
    {c:'ID',f:'ðŸ‡®ðŸ‡©',n:'IndonÃ©sie',            s:'NumÃ©ro compte',  t:'generic'},
    {c:'PH',f:'ðŸ‡µðŸ‡­',n:'Philippines',          s:'InstaPay',       t:'generic'},
    {c:'PK',f:'ðŸ‡µðŸ‡°',n:'Pakistan',             s:'IBAN',           t:'iban'},
    {c:'BD',f:'ðŸ‡§ðŸ‡©',n:'Bangladesh',           s:'NumÃ©ro compte',  t:'generic'},
    {c:'VN',f:'ðŸ‡»ðŸ‡³',n:'ViÃªt Nam',             s:'NumÃ©ro compte',  t:'generic'},
  ];

  /* â”€â”€ ThÃ¨mes visuels par type â”€â”€ */
  var THEMES = {
    iban:     {bg:'linear-gradient(135deg,#0f172a,#0369a1,#0e4d7a)', shadow:'rgba(3,105,161,.5)',  accent:'#0369a1', badges:['SEPA','SWIFT','SHA256'], stamp:'VIREMENT', icon:'ðŸ¦'},
    ach:      {bg:'linear-gradient(135deg,#064e3b,#065f46,#047857)', shadow:'rgba(4,120,87,.5)',   accent:'#047857', badges:['ACH','WIRE','256-AES'], stamp:'CHECKING',  icon:'ðŸ¦'},
    eft:      {bg:'linear-gradient(135deg,#1e3a8a,#1d4ed8,#2563eb)', shadow:'rgba(37,99,235,.5)', accent:'#1d4ed8', badges:['EFT','Interac','SSL'], stamp:'EFT', icon:'ðŸ¦'},
    bsb:      {bg:'linear-gradient(135deg,#4c1d95,#6d28d9,#7c3aed)', shadow:'rgba(109,40,217,.5)',accent:'#7c3aed', badges:['BSB','NPP','SWIFT'], stamp:'TRANSFER', icon:'ðŸ¦'},
    ifsc:     {bg:'linear-gradient(135deg,#7c2d12,#c2410c,#ea580c)', shadow:'rgba(194,65,12,.5)', accent:'#ea580c', badges:['NEFT','IMPS','RTGS'], stamp:'TRANSFER', icon:'ðŸ¦'},
    clabe:    {bg:'linear-gradient(135deg,#134e4a,#0d9488,#14b8a6)', shadow:'rgba(13,148,136,.5)',accent:'#0d9488', badges:['CLABE','SPEI','MXN'], stamp:'SPEI', icon:'ðŸ¦'},
    pix:      {bg:'linear-gradient(135deg,#1a2e05,#365314,#4d7c0f)', shadow:'rgba(77,124,15,.5)', accent:'#65a30d', badges:['PIX','BRL','24/7'], stamp:'PIX', icon:'ðŸ¦'},
    sortcode: {bg:'linear-gradient(135deg,#1e1b4b,#3730a3,#4338ca)', shadow:'rgba(67,56,202,.5)', accent:'#4338ca', badges:['BACS','FPS','GBP'], stamp:'BACS', icon:'ðŸ¦'},
    generic:  {bg:'linear-gradient(135deg,#1f2937,#374151,#4b5563)', shadow:'rgba(55,65,81,.5)',  accent:'#6b7280', badges:['SWIFT','SEPA','SSL'], stamp:'TRANSFER', icon:'ðŸ¦'},
  };

  var IBAN_LENGTHS = {FR:27,DE:22,BE:16,NL:18,ES:24,IT:27,PT:25,LU:20,CH:21,AT:20,IE:22,PL:28,CZ:24,HU:28,RO:24,DK:18,SE:24,FI:18,NO:15,GR:27,SK:24,HR:21,BG:22,SI:19,LT:20,LV:21,EE:20,CY:28,MT:31,GB:22,AE:23,SA:24,QA:29,BH:22,KW:30,JO:30,IL:23,TR:26,LB:28,MA:28,TN:24,DZ:26,MU:30,CM:27,SN:28,CI:28,GA:27,PK:24};

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     2. Ã‰TAT
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  var currentCountry = null;
  var currentType    = null;

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     3. ELEMENTS DOM
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  var searchInput   = document.getElementById('countrySearchInput');
  var dropdown      = document.getElementById('countryDropdown');
  var clearBtn      = document.getElementById('countrySearchClear');
  var selectedChip  = document.getElementById('selectedChip');
  var chipFlag      = document.getElementById('chipFlag');
  var chipName      = document.getElementById('chipName');
  var chipSys       = document.getElementById('chipSys');
  var chipChange    = document.getElementById('chipChange');
  var placeholder   = document.getElementById('step2Placeholder');
  var step2Form     = document.getElementById('step2Form');
  var bankCard      = document.getElementById('bankCard');
  var bkNumber      = document.getElementById('bkNumber');
  var bkHolder      = document.getElementById('bkHolder');
  var bkSysBadge    = document.getElementById('bkSysBadge');
  var bkFlag        = document.getElementById('bkFlag');
  var bkRoutingRow  = document.getElementById('bkRoutingRow');
  var bkRoutingVal  = document.getElementById('bkRoutingVal');
  var bkRoutingLabel= document.getElementById('bkRoutingLabel');
  var bkNumberLabel = document.getElementById('bkNumberLabel');
  var bkTypeStamp   = document.getElementById('bkTypeStamp');
  var bankBadges    = document.getElementById('bankBadges');
  var pfSubmitBtn   = document.getElementById('pfSubmitBtn');
  var pfErrors      = document.getElementById('pfErrors');
  var hBankCountry  = document.getElementById('hBankCountry');
  var hBankType     = document.getElementById('hBankType');
  var holderInput   = document.getElementById('bank_account_holder');

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     4. RECHERCHE PAYS
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  function renderDropdown(list) {
    if (!list.length) {
      dropdown.innerHTML = '<div class="country-opt-none">Aucun pays trouvÃ©</div>';
    } else {
      dropdown.innerHTML = list.map(function(c){
        return '<div class="country-opt" data-code="'+c.c+'">' +
          '<span class="country-opt-flag">'+c.f+'</span>' +
          '<div class="country-opt-info">' +
            '<div class="country-opt-name">'+c.n+'</div>' +
            '<div class="country-opt-system">'+c.s+'</div>' +
          '</div></div>';
      }).join('');
      dropdown.querySelectorAll('.country-opt').forEach(function(el){
        el.addEventListener('click', function(){
          var code = this.getAttribute('data-code');
          var obj  = COUNTRIES.find(function(x){ return x.c===code; });
          if(obj) selectCountry(obj);
        });
      });
    }
    dropdown.classList.add('open');
  }

  searchInput.addEventListener('input', function(){
    var q = this.value.trim().toLowerCase();
    clearBtn.classList.toggle('vis', q.length > 0);
    if (!q) { dropdown.classList.remove('open'); return; }
    var filtered = COUNTRIES.filter(function(c){
      return c.n.toLowerCase().includes(q) || c.c.toLowerCase().includes(q) || c.s.toLowerCase().includes(q);
    });
    renderDropdown(filtered);
  });

  searchInput.addEventListener('focus', function(){
    if (this.value.trim()) { dropdown.classList.add('open'); }
    else { renderDropdown(COUNTRIES.slice(0,20)); }
  });

  document.addEventListener('click', function(e){
    if (!document.getElementById('countrySearchWrap').contains(e.target)) {
      dropdown.classList.remove('open');
    }
  });

  clearBtn.addEventListener('click', function(){
    searchInput.value = '';
    clearBtn.classList.remove('vis');
    dropdown.classList.remove('open');
  });

  chipChange.addEventListener('click', function(){
    selectedChip.classList.remove('vis');
    searchInput.value = '';
    searchInput.focus();
    placeholder.style.display = '';
    step2Form.style.display    = 'none';
    currentCountry = null; currentType = null;
  });

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     5. SÃ‰LECTION PAYS â†’ afficher form adaptÃ©
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  function selectCountry(obj) {
    currentCountry = obj;
    currentType    = obj.t;

    /* Chip */
    chipFlag.textContent = obj.f;
    chipName.textContent = obj.n;
    chipSys.textContent  = obj.s;
    selectedChip.classList.add('vis');
    searchInput.value = '';
    clearBtn.classList.remove('vis');
    dropdown.classList.remove('open');

    /* Hidden inputs */
    hBankCountry.value = obj.c;
    hBankType.value    = obj.t;

    /* Show step2 */
    placeholder.style.display = 'none';
    step2Form.style.display    = '';

    /* Theme carte */
    applyTheme(obj.t, obj.f);

    /* Show proper form section */
    document.querySelectorAll('.bank-section').forEach(function(s){ s.classList.remove('active'); });
    var sec = document.getElementById('sec-'+obj.t);
    if (sec) sec.classList.add('active');

    /* Card labels */
    var labels = {
      iban:     {num:'IBAN',       routing:null,        stamp:'VIREMENT'},
      ach:      {num:'ACCOUNT #',  routing:'ABA ROUTING #', stamp:'ACH / CHECKING'},
      eft:      {num:'ACCOUNT #',  routing:'TRANSIT',   stamp:'EFT'},
      bsb:      {num:'ACCOUNT #',  routing:'BSB CODE',  stamp:'TRANSFER'},
      ifsc:     {num:'ACCOUNT #',  routing:'IFSC CODE', stamp:'NEFT/RTGS'},
      clabe:    {num:'CLABE',      routing:null,        stamp:'SPEI'},
      pix:      {num:'CLÃ‰ PIX',    routing:null,        stamp:'PIX'},
      sortcode: {num:'ACCOUNT #',  routing:'SORT CODE', stamp:'BACS / FPS'},
      generic:  {num:'ACCOUNT #',  routing:'BANQUE',    stamp:'TRANSFER'},
    };
    var lbl = labels[obj.t] || labels.generic;
    bkNumberLabel.textContent  = lbl.num;
    bkTypeStamp.textContent    = lbl.stamp;
    bkSysBadge.textContent     = obj.s;
    bkFlag.textContent         = obj.f;

    if (lbl.routing) {
      bkRoutingRow.style.display = '';
      bkRoutingLabel.textContent = lbl.routing;
      bkRoutingVal.textContent   = 'â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢';
    } else {
      bkRoutingRow.style.display = 'none';
    }

    /* Reset card displays */
    bkNumber.textContent = 'â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢ â€¢â€¢â€¢â€¢';
    bkHolder.textContent = (holderInput.value || 'VOTRE NOM').toUpperCase();

    /* Wire up live preview for this type */
    wireLivePreview(obj.t, obj.c);
  }

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     6. THÃˆME CARTE
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  function applyTheme(type, flag) {
    var th = THEMES[type] || THEMES.generic;
    bankCard.style.background = th.bg;
    bankCard.style.setProperty('--card-shadow', th.shadow);
    bankCard.style.boxShadow = '0 25px 60px '+th.shadow+', 0 8px 20px rgba(0,0,0,.35), inset 0 1px 0 rgba(255,255,255,.15)';
    document.getElementById('bkIcon').textContent = th.icon;
    bankBadges.innerHTML = th.badges.map(function(b){
      return '<span class="bank-badge">'+b+'</span>';
    }).join('');
    document.getElementById('pfTitle').innerHTML = '<i class="fas fa-university" style="color:'+th.accent+'"></i>&nbsp; DÃ©tails bancaires â€” '+flag;
  }

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     7. LIVE PREVIEW par type
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  function formatIBAN(raw) {
    return raw.toUpperCase().replace(/[^A-Z0-9]/g,'').match(/.{1,4}/g)
      ? raw.toUpperCase().replace(/[^A-Z0-9]/g,'').match(/.{1,4}/g).join(' ')
      : raw.toUpperCase().replace(/[^A-Z0-9]/g,'');
  }

  function wireInput(el, onUpdate) {
    if(!el) return;
    el.addEventListener('input', function(){ onUpdate(this.value); });
    onUpdate(el.value);
  }

  function wireLivePreview(type, cc) {
    /* Holder (always) */
    holderInput.addEventListener('input', function(){
      bkHolder.textContent = (this.value||'VOTRE NOM').toUpperCase();
    });

    if (type === 'iban') {
      var ibanInput = document.getElementById('fi_iban');
      if (!ibanInput) return;
      var maxLen = IBAN_LENGTHS[cc] || 27;
      var hintEl = document.getElementById('fi_ibanHint');
      var badgeEl = document.getElementById('fi_ibanBadge');
      if (hintEl) hintEl.textContent = cc + ' â€” IBAN attendu : ' + maxLen + ' caractÃ¨res';

      wireInput(ibanInput, function(v){
        var fmt = formatIBAN(v);
        ibanInput.value = fmt;
        var clean = fmt.replace(/\s/g,'');
        var padded = clean.padEnd(maxLen,'â€¢');
        var groups = padded.match(/.{1,4}/g)||['â€¢â€¢â€¢â€¢'];
        bkNumber.textContent = groups.join(' ');
        if (cc && /^[A-Z]{2}$/.test(cc)) {
          badgeEl.textContent = cc; badgeEl.classList.add('vis');
        }
      });

    } else if (type === 'ach') {
      wireInput(document.getElementById('fi_routing_ach'), function(v){
        bkRoutingVal.textContent = v.replace(/\D/g,'').padEnd(9,'â€¢');
      });
      wireInput(document.getElementById('fi_account_ach'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(12,'â€¢');
      });

    } else if (type === 'eft') {
      wireInput(document.getElementById('fi_transit'), function(v){
        bkRoutingVal.textContent = v.replace(/\D/g,'').padEnd(8,'â€¢');
      });
      wireInput(document.getElementById('fi_account_eft'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(7,'â€¢');
      });

    } else if (type === 'bsb') {
      wireInput(document.getElementById('fi_bsb'), function(v){
        var raw=v.replace(/\D/g,'');
        if(raw.length>3) raw=raw.slice(0,3)+'-'+raw.slice(3,6);
        document.getElementById('fi_bsb').value=raw;
        bkRoutingVal.textContent = raw.replace('-','').padEnd(6,'â€¢');
      });
      wireInput(document.getElementById('fi_account_bsb'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(9,'â€¢');
      });

    } else if (type === 'ifsc') {
      wireInput(document.getElementById('fi_ifsc'), function(v){
        document.getElementById('fi_ifsc').value = v.toUpperCase();
        bkRoutingVal.textContent = v.toUpperCase().padEnd(11,'â€¢');
      });
      wireInput(document.getElementById('fi_account_ifsc'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(16,'â€¢');
      });

    } else if (type === 'clabe') {
      wireInput(document.getElementById('fi_clabe'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(18,'â€¢');
      });

    } else if (type === 'pix') {
      wireInput(document.getElementById('fi_pix'), function(v){
        bkNumber.textContent = v || 'â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢';
      });

    } else if (type === 'sortcode') {
      wireInput(document.getElementById('fi_sortcode'), function(v){
        var raw=v.replace(/\D/g,'');
        if(raw.length>4) raw=raw.slice(0,2)+'-'+raw.slice(2,4)+'-'+raw.slice(4,6);
        else if(raw.length>2) raw=raw.slice(0,2)+'-'+raw.slice(2,4);
        document.getElementById('fi_sortcode').value=raw;
        bkRoutingVal.textContent = raw.replace(/-/g,'').padEnd(6,'â€¢');
      });
      wireInput(document.getElementById('fi_account_sc'), function(v){
        bkNumber.textContent = v.replace(/\D/g,'').padEnd(8,'â€¢');
      });

    } else {
      wireInput(document.getElementById('fi_account_gen'), function(v){
        bkNumber.textContent = v.padEnd(16,'â€¢');
      });
    }
  }

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     8. VALIDATION & SUBMIT
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  document.getElementById('payoutForm').addEventListener('submit', function(e){
    e.preventDefault();
    pfErrors.innerHTML = '';

    var holder = holderInput.value.trim();
    var errs   = [];

    if (!currentCountry) { errs.push('Veuillez sÃ©lectionner votre pays bancaire.'); }
    if (!holder)          { errs.push('Le nom du titulaire est requis.'); }

    if (currentType === 'iban') {
      var v = document.getElementById('fi_iban').value.replace(/\s/g,'');
      var expected = IBAN_LENGTHS[currentCountry.c] || 15;
      if (v.length < expected) errs.push('IBAN incomplet ('+v.length+'/'+expected+' caractÃ¨res).');
    } else if (currentType === 'ach') {
      if (!document.getElementById('fi_routing_ach').value.match(/^\d{9}$/)) errs.push('ABA Routing Number : 9 chiffres requis.');
      if (document.getElementById('fi_account_ach').value.replace(/\D/g,'').length < 4) errs.push('NumÃ©ro de compte trop court.');
    } else if (currentType === 'clabe') {
      if (!document.getElementById('fi_clabe').value.match(/^\d{18}$/)) errs.push('CLABE : 18 chiffres requis.');
    }

    if (errs.length) {
      pfErrors.innerHTML = '<div style="background:#fef2f2;color:#991b1b;border:1px solid #fca5a5;border-radius:12px;padding:1rem 1.25rem;margin-bottom:1rem;font-size:.875rem;">' +
        errs.map(function(e){ return 'â€¢ '+e; }).join('<br>') + '</div>';
      return;
    }

    pfSubmitBtn.disabled = true;
    pfSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp; SÃ©curisation en coursâ€¦';
    this.submit();
  });

  /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     9. INIT â€” prÃ©-sÃ©lectionner si pays dÃ©jÃ  en base
  â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
  var savedCountry = '{{ $freelancerProfile->bank_country ?? "" }}';
  if (savedCountry) {
    var obj = COUNTRIES.find(function(x){ return x.c === savedCountry; });
    if (obj) selectCountry(obj);
  }

  /* Holder live always */
  holderInput.addEventListener('input', function(){
    bkHolder.textContent = (this.value||'VOTRE NOM').toUpperCase();
  });
  bkHolder.textContent = (holderInput.value||'VOTRE NOM').toUpperCase();

})();
</script>
@endsection
