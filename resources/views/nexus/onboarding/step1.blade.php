@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<style>
/* ─── Assistant ville step1 (même logique que homeswap-filters) ─── */
#nxS1SelectWrap { position: relative; }
.nxs1-city-assistant {
  position: absolute;
  right: 2.5rem;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  align-items: center;
  gap: 0.4rem;
  pointer-events: none;
  z-index: 3;
  flex-shrink: 0;
  flex-wrap: nowrap;
  white-space: nowrap;
}
.nxs1-city-assistant > * { pointer-events: auto; }
.nxs1-city-icons { display: flex; align-items: center; gap: .35rem; }
.nxs1-city-icon {
  display: inline-flex; align-items: center; justify-content: center;
  width: 18px; height: 18px; color: #94a3b8; opacity: .7;
}
.nxs1-city-icon svg { width: 100%; height: 100%; }
.nxs1-city-icon-popular { color: #6b7280; opacity: .75; }
.nxs1-city-info-btn {
  display: inline-flex; align-items: center; justify-content: center;
  width: 18px; height: 18px; padding: 0;
  border: none; background: none; color: #94a3b8;
  cursor: pointer; opacity: .6; transition: all .2s ease;
}
.nxs1-city-info-btn:hover { opacity: 1; color: #EC4899; }
.nxs1-city-popover {
  position: fixed;
  z-index: 10000;
  background: #ffffff;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.08);
  min-width: 200px;
  max-width: 300px;
  animation: nxs1PopoverIn .2s ease;
}
@keyframes nxs1PopoverIn {
  from { opacity: 0; transform: translateY(-4px); }
  to   { opacity: 1; transform: translateY(0); }
}
.nxs1-city-popover-content { padding: .85rem 1rem; }
.nxs1-city-popover-content p + p { margin-top: .4rem; }
.nxs1-city-popover-text { font-size: .75rem; color: #64748b; line-height: 1.5; margin: 0; }
.nxs1-city-popover-badge { color: #6b7280; font-weight: 500; }
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    {{-- Badge --}}
    <div class="nx-badge">
      <span>✦</span> Onboarding NEXUS
    </div>

    {{-- Stepper --}}
    @include('nexus.onboarding._stepper', ['current' => 1])

    {{-- Alerts --}}
    @if(session('success'))
      <div class="nx-alert nx-alert-success mb-3">
        <span>✅</span> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="nx-alert nx-alert-error mb-3">
        <span>⚠️</span>
        <div>
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Card principale --}}
    <div class="nx-card">
      <h1 class="nx-title">Mon identité NEXUS</h1>
      <p class="nx-subtitle">Bienvenue dans l'expérience NEXUS — présentez-vous en quelques mots pour que vos futurs partenaires d'échange vous trouvent facilement.</p>

      <form action="{{ route('nexus.onboarding.step1.store') }}" method="POST" enctype="multipart/form-data" id="nx-step1-form" data-nx-autosave>
        @csrf

        {{-- Photo --}}
        <div class="nx-field">
          <label class="nx-label">Photo de profil <span class="nx-label-hint">(optionnel)</span></label>
          <div class="nx-photo-drop" id="nx-photo-drop" onclick="document.getElementById('photo-input').click()">
            @if(!empty($data['photo_url']))
              <img src="{{ $data['photo_url'] }}" alt="Photo" class="nx-photo-preview" id="photo-preview">
            @else
              <div id="photo-placeholder">
                <div style="font-size:2.5rem;margin-bottom:.5rem">📸</div>
                <div style="font-weight:600;color:#374151;font-size:.95rem">Cliquez pour ajouter votre photo</div>
                <div style="color:#9ca3af;font-size:.8rem;margin-top:.25rem">JPG, PNG, WEBP · max 5 Mo</div>
              </div>
              <img src="" alt="Aperçu" class="nx-photo-preview d-none" id="photo-preview" style="display:none">
            @endif
          </div>
          <input type="file" id="photo-input" name="photo" accept="image/*" class="d-none">
          @error('photo')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Prénom / Nom --}}
        <div class="nx-row">
          <div class="nx-field">
            <label class="nx-label" for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" class="nx-input" value="{{ old('first_name', $data['first_name']) }}" placeholder="Votre prénom" autocomplete="given-name">
            @error('first_name')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
          <div class="nx-field">
            <label class="nx-label" for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" class="nx-input" value="{{ old('last_name', $data['last_name']) }}" placeholder="Votre nom" autocomplete="family-name">
            @error('last_name')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
        </div>

        {{-- E-mail --}}
        <div class="nx-field">
          <label class="nx-label" for="contact_email">E-mail <span class="nx-label-hint">(optionnel)</span></label>
          <input type="email" id="contact_email" name="contact_email" class="nx-input" value="{{ old('contact_email', $data['contact_email']) }}" placeholder="exemple@email.com" autocomplete="email" style="max-width:320px">
          @error('contact_email')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Pays / Ville --}}
        <div class="nx-row">
          <div class="nx-field">
            <label class="nx-label" for="country">Pays</label>
            <select id="country" name="country" class="nx-select" onchange="nxS1UpdateCities(this.value)">
              <option value="">Choisir un pays…</option>
              @php
                $countries = [
                  'FR'=>'🇫🇷 France','GP'=>'🇬🇵 Guadeloupe','MQ'=>'🇲🇶 Martinique','RE'=>'🇷🇪 La Réunion',
                  'BE'=>'🇧🇪 Belgique','CH'=>'🇨🇭 Suisse','ES'=>'🇪🇸 Espagne','DE'=>'🇩🇪 Allemagne',
                  'IT'=>'🇮🇹 Italie','PT'=>'🇵🇹 Portugal','NL'=>'🇳🇱 Pays-Bas','GB'=>'🇬🇧 Royaume-Uni',
                  'CA'=>'🇨🇦 Canada','US'=>'🇺🇸 États-Unis','MT'=>'🇲🇹 Malte','MC'=>'🇲🇨 Monaco',
                  'LU'=>'🇱🇺 Luxembourg','MA'=>'🇲🇦 Maroc','TN'=>'🇹🇳 Tunisie','SN'=>'🇸🇳 Sénégal',
                  'CI'=>"🇨🇮 Côte d'Ivoire",'IE'=>'🇮🇪 Irlande','HR'=>'🇭🇷 Croatie',
                  'BR'=>'🇧🇷 Brésil','JP'=>'🇯🇵 Japon','AE'=>'🇦🇪 Émirats Arabes Unis',
                  'QA'=>'🇶🇦 Qatar','SA'=>'🇸🇦 Arabie Saoudite','SG'=>'🇸🇬 Singapour',
                  'AU'=>'🇦🇺 Australie','MX'=>'🇲🇽 Mexique','CN'=>'🇨🇳 Chine',
                  'KR'=>'🇰🇷 Corée du Sud','IN'=>'🇮🇳 Inde','GR'=>'🇬🇷 Grèce',
                  'TH'=>'🇹🇭 Thaïlande','MU'=>'🇲🇺 Île Maurice','SC'=>'🇸🇨 Seychelles',
                  'SE'=>'🇸🇪 Suède','DK'=>'🇩🇰 Danemark','NO'=>'🇳🇴 Norvège',
                  'AT'=>'🇦🇹 Autriche','CY'=>'🇨🇾 Chypre',
                  'ID'=>'🇮🇩 Indonésie','MY'=>'🇲🇾 Malaisie','PH'=>'🇵🇭 Philippines',
                ];
              @endphp
              @foreach($countries as $code => $name)
                <option value="{{ $code }}" {{ old('country', $data['country']) == $code ? 'selected' : '' }}>{{ $name }}</option>
              @endforeach
            </select>
            @error('country')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
          <div class="nx-field" id="nxS1CityWrapper">
            <label class="nx-label" for="city_select">Ville</label>
            {{-- city caché : valeur réelle soumise --}}
            <input type="hidden" name="city" id="city_hidden" value="{{ old('city', $data['city']) }}">
            {{-- Wrapper relatif autour du select pour positionner correctement les icônes --}}
            <div id="nxS1SelectWrap">
              <select id="city_select" class="nx-select" onchange="nxS1OnCitySelect(this.value)" style="display:none">
                <option value="">Choisir une ville…</option>
              </select>
            </div>
            {{-- Input texte libre (toujours visible si pas de liste, ou si "Autre") --}}
            <input type="text" id="city_input" class="nx-input" value="{{ old('city', $data['city']) }}" placeholder="Saisir votre ville" autocomplete="address-level2" oninput="document.getElementById('city_hidden').value=this.value">
            @error('city')<div class="nx-error">⚠ {{ $message }}</div>@enderror
          </div>
        </div>

        {{-- Bio --}}
        <div class="nx-field">
          <label class="nx-label" for="bio">
            Votre présentation
            <span class="nx-label-hint">· min 30 caractères</span>
          </label>
          <textarea id="bio" name="bio" class="nx-textarea" placeholder="Ex : Expert growth marketing & passionné d'architecture industrielle. Je propose mon loft parisien de 80m² en échange de cours de yoga ou de consulting SEO…" maxlength="1000">{{ old('bio', $data['bio']) }}</textarea>
          <div style="text-align:right;font-size:.75rem;color:#9ca3af;margin-top:.25rem">
            <span id="bio-count">{{ mb_strlen(old('bio', $data['bio'])) }}</span>/1000
          </div>
          @error('bio')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- Footer --}}
        <div class="nx-form-footer">
          <a href="{{ route('nexus.dashboard') }}" class="nx-btn nx-btn-ghost">← Retour</a>
          <button type="submit" class="nx-btn nx-btn-primary">
            Enregistrer et Continuer <span>→</span>
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
  // Photo preview
  const photoInput = document.getElementById('photo-input');
  const photoPreview = document.getElementById('photo-preview');
  const photoPlaceholder = document.getElementById('photo-placeholder');

  if (photoInput) {
    photoInput.addEventListener('change', function() {
      const file = this.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (e) => {
        photoPreview.src = e.target.result;
        photoPreview.style.display = 'block';
        photoPreview.classList.remove('d-none');
        if (photoPlaceholder) photoPlaceholder.style.display = 'none';
      };
      reader.readAsDataURL(file);
    });
  }

  // Bio counter
  const bioEl = document.getElementById('bio');
  const bioCount = document.getElementById('bio-count');
  if (bioEl && bioCount) {
    bioEl.addEventListener('input', () => {
      bioCount.textContent = bioEl.value.length;
    });
  }

  // ─── Autosave localStorage (tous les champs) ────────────────────────────
  const NX_S1_KEY = 'nxs1_draft';

  function nxS1SaveDraft() {
    try {
      localStorage.setItem(NX_S1_KEY, JSON.stringify({
        first_name:    document.getElementById('first_name')?.value    || '',
        last_name:     document.getElementById('last_name')?.value     || '',
        contact_email: document.getElementById('contact_email')?.value || '',
        bio:           document.getElementById('bio')?.value           || '',
        country:       document.getElementById('country')?.value       || '',
        city:          document.getElementById('city_hidden')?.value   || '',
      }));
    } catch(e) {}
  }

  function nxS1RestoreDraft() {
    let draft;
    try { draft = JSON.parse(localStorage.getItem(NX_S1_KEY) || 'null'); } catch(e) {}
    if (!draft) return;

    const fn = document.getElementById('first_name');
    const ln = document.getElementById('last_name');
    const em = document.getElementById('contact_email');
    const bi = document.getElementById('bio');
    const co = document.getElementById('country');

    if (fn && !fn.value && draft.first_name)    { fn.value = draft.first_name; }
    if (ln && !ln.value && draft.last_name)     { ln.value = draft.last_name; }
    if (em && !em.value && draft.contact_email) { em.value = draft.contact_email; }
    if (bi && !bi.value && draft.bio)           { bi.value = draft.bio; if (bioCount) bioCount.textContent = bi.value.length; }

    if (co && !co.value && draft.country) {
      co.value = draft.country;
      nxS1UpdateCities(draft.country);
    }
    if (draft.city) {
      setTimeout(() => {
        const ch = document.getElementById('city_hidden');
        if (ch && !ch.value) {
          ch.value = draft.city;
          const cs = document.getElementById('city_select');
          const ci = document.getElementById('city_input');
          if (cs && cs.style.display !== 'none') {
            cs.value = draft.city;
            if (!cs.value) { cs.value = '__autre'; if (ci) { ci.value = draft.city; ci.style.display = 'block'; } }
            setTimeout(nxS1UpdateCityAssistant, 50);
          } else if (ci) {
            ci.value = draft.city;
          }
        }
      }, 200);
    }
  }

  // Écouter tous les champs texte/select
  ['first_name','last_name','contact_email','bio'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', nxS1SaveDraft);
  });
  document.getElementById('country')?.addEventListener('change', nxS1SaveDraft);
  document.getElementById('city_select')?.addEventListener('change', nxS1SaveDraft);
  document.getElementById('city_input')?.addEventListener('input', nxS1SaveDraft);

  // Sauvegarde périodique toutes les 3s (filet de sécurité)
  setInterval(nxS1SaveDraft, 3000);

  // NE PAS effacer le brouillon à la soumission — il sera effacé à la fin de l'onboarding complet
  // document.getElementById('nx-step1-form')?.addEventListener('submit', () => { ... })

  // Restaurer au chargement (appelé à la fin du script, après toutes les fonctions)
  // ────────────────────────────────────────────────────────────────────────

  // ─── Pays / Ville dynamique + assistant emojis ──────────────────────────
  const nxS1CityBadges = {
    // France
    'Paris':['Business','Langue'],'Lyon':['Business','Workation'],'Marseille':['Repos','Famille'],
    'Toulouse':['Business','Workation'],'Nice':['Repos','Famille'],'Nantes':['Famille','Workation'],
    'Strasbourg':['Langue','Business'],'Montpellier':['Workation','Repos'],'Bordeaux':['Repos','Business'],
    'Lille':['Business','Langue'],'Rennes':['Workation','Famille'],'Grenoble':['Workation','Business'],
    'Tours':['Culture','Famille'],'Metz':['Langue','Famille'],'Reims':['Culture','Famille'],
    // DOM
    'Pointe-à-Pitre':['Repos','Famille'],'Les Abymes':['Famille','Repos'],
    'Fort-de-France':['Repos','Famille'],'Saint-Denis':['Repos','Famille'],
    // Europe
    'Bruxelles':['Business','Langue'],'Anvers':['Business','Culture'],'Genève':['Business','Workation'],
    'Zurich':['Business','Workation'],'Lausanne':['Workation','Langue'],'Berne':['Langue','Business'],
    'Madrid':['Business','Langue'],'Barcelone':['Workation','Repos'],'Valence':['Repos','Famille'],
    'Berlin':['Workation','Business'],'Munich':['Business','Famille'],'Hambourg':['Business','Workation'],
    'Rome':['Culture','Famille'],'Milan':['Business','Workation'],'Florence':['Culture','Repos'],
    'Lisbonne':['Workation','Repos'],'Porto':['Repos','Culture'],
    'Amsterdam':['Workation','Langue'],'Rotterdam':['Business','Workation'],
    'Londres':['Business','Langue'],'Manchester':['Business','Famille'],'Édimbourg':['Culture','Repos'],
    'Dublin':['Langue','Business'],'Cork':['Langue','Famille'],'Galway':['Langue','Famille'],
    'Zagreb':['Business','Langue'],'Split':['Repos','Famille'],'Zadar':['Repos','Famille'],
    'Athènes':['Culture','Famille'],'Thessalonique':['Repos','Culture'],'Santorin':['Repos'],
    'Stockholm':['Business','Langue'],'Göteborg':['Business','Famille'],'Malmö':['Workation','Famille'],
    'Copenhague':['Business','Langue'],'Aarhus':['Workation','Culture'],
    'Oslo':['Business','Workation'],'Bergen':['Repos','Culture'],
    'Vienne':['Culture','Business'],'Salzbourg':['Culture','Repos'],'Graz':['Workation','Famille'],
    'Nicosie':['Business','Repos'],'Limassol':['Repos','Business'],'Paphos':['Repos'],
    'Valetta':['Culture','Repos'],'Monaco':['Business','Repos'],
    'Luxembourg-Ville':['Business','Langue'],
    // Amérique
    'Montréal':['Langue','Business'],'Toronto':['Business','Famille'],'Vancouver':['Workation','Repos'],
    'New York':['Business','Langue'],'Los Angeles':['Workation','Repos'],'Miami':['Repos','Business'],
    'São Paulo':['Business','Workation'],'Rio de Janeiro':['Repos','Famille'],
    'Mexico':['Business','Langue'],'Guadalajara':['Business','Famille'],'Cancún':['Repos'],
    // Afrique / Maghreb
    'Casablanca':['Business','Langue'],'Rabat':['Langue','Famille'],'Marrakech':['Repos','Culture'],
    'Tunis':['Langue','Repos'],'Dakar':['Langue','Famille'],
    // Asie / Océanie
    'Tokyo':['Business','Langue'],'Osaka':['Business','Repos'],'Kyoto':['Culture','Repos'],
    'Dubaï':['Business','Repos'],'Abu Dhabi':['Business','Workation'],
    'Doha':['Business','Langue'],'Riyad':['Business'],
    'Singapour':['Business','Workation'],
    'Sydney':['Business','Workation'],'Melbourne':['Business','Famille'],
    'Bangkok':['Business','Workation'],'Chiang Mai':['Workation','Repos'],'Phuket':['Repos'],
    'Bali':['Repos','Workation'],'Jakarta':['Business','Famille'],
    'Kuala Lumpur':['Business','Famille'],'Penang':['Culture','Repos'],
    'Manille':['Business','Famille'],'Cebu':['Repos','Famille'],
    'Séoul':['Business','Langue'],'Busan':['Repos','Famille'],
    'Mumbai':['Business'],'Delhi':['Business','Famille'],'Bangalore':['Business','Workation'],
    'Pékin':['Business','Langue'],'Shanghai':['Business','Workation'],
    'Port-Louis':['Business','Repos'],'Victoria':['Repos','Business'],
  };

  const nxS1ObjectiveIcons = {
    'Business': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3.5 4.5V11.5H10.5V4.5M3.5 4.5H10.5M3.5 4.5V2.5C3.5 2.224 3.724 2 4 2H10C10.276 2 10.5 2.224 10.5 2.5V4.5M5.5 7H8.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'Workation': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 3.5C2.5 3.224 2.724 3 3 3H11C11.276 3 11.5 3.224 11.5 3.5V10.5C11.5 10.776 11.276 11 11 11H3C2.724 11 2.5 10.776 2.5 10.5V3.5Z" stroke="currentColor" stroke-width="1.25"/><path d="M5.5 7L6.5 8L8.5 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'Famille': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 2.5L3.5 5.5V11.5H5.5V7.5H8.5V11.5H10.5V5.5L7 2.5Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'Langue': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M2 7H12M7 2C7.5 3.5 7.5 4.5 7 7C6.5 9.5 6.5 10.5 7 12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
    'Repos': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3.5 7C3.5 5.067 5.067 3.5 7 3.5C8.933 3.5 10.5 5.067 10.5 7C10.5 8.933 8.933 10.5 7 10.5C5.067 10.5 3.5 8.933 3.5 7Z" stroke="currentColor" stroke-width="1.25"/><path d="M5 7L6.5 8.5L9 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'Culture': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 2V12M2 7H12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/><circle cx="7" cy="7" r="4" stroke="currentColor" stroke-width="1.25"/></svg>',
  };

  const nxS1AllowedObjectives = ['Workation','Famille','Langue','Business','Repos','Culture'];

  const nxS1CitiesByCountry = {
    'FR': ['Paris','Lyon','Marseille','Toulouse','Nice','Nantes','Strasbourg','Montpellier','Bordeaux','Lille','Rennes','Grenoble','Tours','Metz','Reims'],
    'GP': ['Pointe-à-Pitre','Les Abymes','Baie-Mahault','Le Gosier','Sainte-Anne'],
    'MQ': ['Fort-de-France','Le Lamentin','Sainte-Marie','Schoelcher','Ducos'],
    'RE': ['Saint-Denis','Saint-Paul','Saint-Pierre','Le Tampon','Saint-André'],
    'BE': ['Bruxelles','Anvers','Gand','Liège','Charleroi','Bruges','Namur','Louvain'],
    'CH': ['Genève','Zurich','Lausanne','Berne','Bâle','Lugano','Winterthour','Saint-Gall'],
    'ES': ['Madrid','Barcelone','Valence','Séville','Saragosse','Málaga','Bilbao','Valladolid'],
    'DE': ['Berlin','Munich','Hambourg','Francfort','Cologne','Stuttgart','Düsseldorf','Dortmund'],
    'IT': ['Rome','Milan','Naples','Turin','Palerme','Gênes','Bologne','Florence'],
    'PT': ['Lisbonne','Porto','Braga','Coimbra','Funchal','Faro','Setúbal','Amadora'],
    'NL': ['Amsterdam','Rotterdam','La Haye','Utrecht','Eindhoven','Tilburg','Groningue','Almere'],
    'GB': ['Londres','Manchester','Birmingham','Glasgow','Liverpool','Édimbourg','Bristol','Leeds'],
    'CA': ['Montréal','Toronto','Vancouver','Québec','Ottawa','Calgary','Edmonton','Winnipeg'],
    'US': ['New York','Los Angeles','Miami','Chicago','San Francisco','Houston','Boston','Seattle'],
    'MT': ['Valetta','Sliema','Saint Julien','Msida','Gzira'],
    'MC': ['Monaco'],
    'LU': ['Luxembourg-Ville','Esch-sur-Alzette','Differdange','Dudelange'],
    'MA': ['Casablanca','Rabat','Marrakech','Fès','Tanger','Agadir','Meknès','Oujda'],
    'TN': ['Tunis','Sfax','Sousse','Monastir','Gabès','Bizerte','Kairouan'],
    'SN': ['Dakar','Thiès','Kaolack','Ziguinchor','Saint-Louis'],
    'CI': ['Abidjan','Yamoussoukro','Bouaké','Daloa','San-Pédro'],
    'IE': ['Dublin','Cork','Galway','Limerick','Waterford'],
    'HR': ['Zagreb','Split','Rijeka','Osijek','Zadar'],
    'BR': ['São Paulo','Rio de Janeiro','Brasília','Salvador','Fortaleza','Belo Horizonte','Curitiba'],
    'JP': ['Tokyo','Osaka','Kyoto','Yokohama','Nagoya','Sapporo','Fukuoka','Kobe'],
    'AE': ['Dubaï','Abu Dhabi','Charjah','Ajman','Ras al-Khaimah'],
    'QA': ['Doha','Al-Rayyan','Al-Wakra','Al Khor'],
    'SA': ['Riyad','Djeddah','La Mecque','Médine','Dammam'],
    'SG': ['Singapour','Sentosa','Jurong','Woodlands'],
    'AU': ['Sydney','Melbourne','Brisbane','Perth','Adélaïde','Gold Coast','Canberra'],
    'MX': ['Mexico','Guadalajara','Monterrey','Cancún','Puebla','Tijuana','Mérida'],
    'CN': ['Pékin','Shanghai','Canton','Shenzhen','Chengdu','Hangzhou','Wuhan'],
    'KR': ['Séoul','Busan','Incheon','Daegu','Daejeon','Gwangju'],
    'IN': ['Mumbai','Delhi','Bangalore','Chennai','Hyderabad','Kolkata','Pune'],
    'GR': ['Athènes','Thessalonique','Patras','Héraklion','Santorin','Mykonos'],
    'TH': ['Bangkok','Chiang Mai','Phuket','Pattaya','Hua Hin','Koh Samui'],
    'MU': ['Port-Louis','Grand Baie','Flic en Flac','Mahébourg','Rose Hill'],
    'SC': ['Victoria','Beau Vallon','Anse Boileau','Mahé'],
    'SE': ['Stockholm','Göteborg','Malmö','Uppsala','Västerås'],
    'DK': ['Copenhague','Aarhus','Odense','Aalborg','Esbjerg'],
    'NO': ['Oslo','Bergen','Stavanger','Trondheim','Tromsø'],
    'AT': ['Vienne','Graz','Linz','Salzbourg','Innsbruck'],
    'CY': ['Nicosie','Limassol','Larnaca','Paphos','Famagouste'],
    'ID': ['Bali','Jakarta','Yogyakarta','Surabaya','Bandung','Medan'],
    'MY': ['Kuala Lumpur','Penang','Johor Bahru','Kota Kinabalu','Malacca'],
    'PH': ['Manille','Cebu','Davao','Quezon City','Makati'],
  };
  const nxS1CountryEl  = document.getElementById('country');
  const nxS1CitySelect = document.getElementById('city_select');
  const nxS1CityInput  = document.getElementById('city_input');
  const nxS1CityHidden = document.getElementById('city_hidden');
  const nxS1CityWrapper = document.getElementById('nxS1CityWrapper');
  const nxS1SelectWrap  = document.getElementById('nxS1SelectWrap');

  function nxS1UpdateCities(countryCode) {
    const cities = nxS1CitiesByCountry[countryCode] || [];
    nxS1CitySelect.innerHTML = '<option value="">Choisir une ville…</option>';
    nxS1RemoveCityAssistant();
    if (cities.length === 0) {
      nxS1CitySelect.style.display = 'none';
      nxS1CityInput.style.display  = 'block';
      return;
    }
    cities.forEach(c => {
      const opt = document.createElement('option');
      opt.value = c; opt.textContent = c;
      const badges = nxS1CityBadges[c];
      if (badges && badges.length) opt.setAttribute('data-badges', JSON.stringify(badges));
      nxS1CitySelect.appendChild(opt);
    });
    const autre = document.createElement('option');
    autre.value = '__autre'; autre.textContent = '✏️ Autre ville…';
    nxS1CitySelect.appendChild(autre);

    const current = nxS1CityHidden.value;
    if (current && cities.includes(current)) {
      nxS1CitySelect.value = current;
      nxS1CityInput.style.display = 'none';
    } else if (current) {
      nxS1CitySelect.value = '__autre';
      nxS1CityInput.style.display = 'block';
      nxS1CityInput.value = current;
    } else {
      nxS1CityInput.style.display = 'none';
    }
    nxS1CitySelect.style.display = 'block';
    setTimeout(nxS1UpdateCityAssistant, 50);
  }

  function nxS1OnCitySelect(val) {
    if (val === '__autre') {
      nxS1CityInput.style.display = 'block';
      nxS1CityInput.focus();
      nxS1CityHidden.value = nxS1CityInput.value;
      nxS1RemoveCityAssistant();
    } else {
      nxS1CityInput.style.display = 'none';
      nxS1CityHidden.value = val;
      nxS1UpdateCityAssistant();
    }
  }

  function nxS1RemoveCityAssistant() {
    const existing = nxS1SelectWrap && nxS1SelectWrap.querySelector('.nxs1-city-assistant');
    if (existing) existing.remove();
    if (nxS1CitySelect) nxS1CitySelect.style.paddingRight = '';
  }

  function nxS1UpdateCityAssistant() {
    nxS1RemoveCityAssistant();
    if (!nxS1CitySelect || !nxS1SelectWrap) return;
    const selOpt = nxS1CitySelect.options[nxS1CitySelect.selectedIndex];
    if (!selOpt || !selOpt.value || selOpt.value === '__autre') return;

    const badgesJson = selOpt.getAttribute('data-badges');
    let badges = [];
    try { badges = badgesJson ? JSON.parse(badgesJson) : []; } catch(e) {}
    const displayBadges = badges.filter(b => nxS1AllowedObjectives.includes(b));
    if (!displayBadges.length) return;

    const assistant = document.createElement('div');
    assistant.className = 'nxs1-city-assistant';

    const iconsContainer = document.createElement('div');
    iconsContainer.className = 'nxs1-city-icons';
    displayBadges.forEach(b => {
      const span = document.createElement('span');
      span.className = 'nxs1-city-icon';
      span.setAttribute('aria-label', b);
      span.setAttribute('title', b);
      span.innerHTML = nxS1ObjectiveIcons[b] || '';
      iconsContainer.appendChild(span);
    });
    assistant.appendChild(iconsContainer);

    const infoBtn = document.createElement('button');
    infoBtn.type = 'button';
    infoBtn.className = 'nxs1-city-info-btn';
    infoBtn.setAttribute('aria-label', 'Informations sur cette ville');
    infoBtn.setAttribute('aria-expanded', 'false');
    infoBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.25"/><path d="M7 6.5V10" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/><circle cx="7" cy="4.5" r="0.75" fill="currentColor"/></svg>';
    infoBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      nxS1TogglePopover(selOpt.value, displayBadges, infoBtn);
    });
    assistant.appendChild(infoBtn);

    nxS1SelectWrap.appendChild(assistant);

    // Ajuster padding du select pour dégager les icônes + bouton info + la flèche native
    const neededPx = 40 + displayBadges.length * 26 + Math.max(0, displayBadges.length - 1) * 6 + 26;
    nxS1CitySelect.style.paddingRight = Math.max(80, neededPx) + 'px';
  }

  function nxS1TogglePopover(cityName, badges, triggerBtn) {
    const existing = document.querySelector('.nxs1-city-popover');
    if (existing && existing.dataset.city === cityName) {
      existing.remove();
      triggerBtn.setAttribute('aria-expanded', 'false');
      return;
    }
    document.querySelectorAll('.nxs1-city-popover').forEach(p => p.remove());
    document.querySelectorAll('.nxs1-city-info-btn').forEach(b => b.setAttribute('aria-expanded', 'false'));

    const popover = document.createElement('div');
    popover.className = 'nxs1-city-popover';
    popover.dataset.city = cityName;
    const content = document.createElement('div');
    content.className = 'nxs1-city-popover-content';
    if (badges.length > 0) {
      const p1 = document.createElement('p');
      p1.className = 'nxs1-city-popover-text';
      p1.textContent = 'Souvent choisie pour : ' + badges.join(' • ');
      content.appendChild(p1);
    }
    popover.appendChild(content);
    document.body.appendChild(popover);

    const rect = triggerBtn.getBoundingClientRect();
    const w = popover.offsetWidth || 240;
    const h = popover.offsetHeight || 80;
    let left = rect.left + rect.width / 2 - w / 2;
    let top  = rect.bottom + 8;
    if (left < 8) left = 8;
    if (left + w > window.innerWidth - 8) left = window.innerWidth - w - 8;
    if (top + h > window.innerHeight - 8) top = rect.top - h - 8;
    popover.style.left = left + 'px';
    popover.style.top  = top  + 'px';
    triggerBtn.setAttribute('aria-expanded', 'true');

    setTimeout(() => {
      document.addEventListener('click', function closePopover(e) {
        if (!popover.contains(e.target) && e.target !== triggerBtn) {
          popover.remove();
          triggerBtn.setAttribute('aria-expanded', 'false');
          document.removeEventListener('click', closePopover);
        }
      });
    }, 10);
  }

  // Init au chargement
  if (nxS1CountryEl && nxS1CountryEl.value) {
    nxS1UpdateCities(nxS1CountryEl.value);
  }

  // Restaurer le brouillon localStorage (après toutes les fonctions)
  nxS1RestoreDraft();
  // ──────────────────────────────────────────────────────────────────────────────
</script>
<script>
  window._nxAutosaveUrl = '{{ route('nexus.onboarding.autosave') }}';
</script>
<script src="{{ asset('assets/front/js/nexus-autosave.js') }}"></script>
@endsection
