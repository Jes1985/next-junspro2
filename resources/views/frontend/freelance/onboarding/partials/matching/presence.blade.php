@php
  $selectedSector = (string)($m['sector'] ?? '');
  $selectedExp = (string)($m['experience_level'] ?? '');
@endphp

<div data-onboarding-universe="presence">
  <div class="filter-group filter-group-rituel presence-engagement-block" data-onboarding-presence-rituel>
    <label class="filter-label"><i class="fas fa-coins me-2"></i>Engagement en Rituel</label>
    <div class="engagement-select-wrapper">
      <select name="price_range" class="filter-select budget-filter" data-presence-budget>
        <option value="" {{ empty($m['price_range'] ?? '') ? 'selected' : '' }}>Tous les engagements</option>
        <option value="0-1000" data-min="0" data-max="1000" {{ ($m['price_range'] ?? '') == '0-1000' ? 'selected' : '' }}>0 – 1 000 € — Engagement exploratoire</option>
        <option value="1000-2500" data-min="1000" data-max="2500" {{ ($m['price_range'] ?? '') == '1000-2500' ? 'selected' : '' }}>1 000 – 2 500 € — Engagement ciblé</option>
        <option value="2500-5000" data-min="2500" data-max="5000" {{ ($m['price_range'] ?? '') == '2500-5000' ? 'selected' : '' }}>2 500 – 5 000 € — Engagement structuré</option>
        <option value="5000-10000" data-min="5000" data-max="10000" {{ ($m['price_range'] ?? '') == '5000-10000' ? 'selected' : '' }}>5 000 – 10 000 € — Engagement stratégique</option>
        <option value="10000-20000" class="engagement-progressive engagement-level-1" data-min="10000" data-max="20000" {{ ($m['price_range'] ?? '') == '10000-20000' ? 'selected' : '' }}>10 000 – 20 000 € — Engagement de partenariat</option>
        <option value="20000-60000" class="engagement-progressive engagement-level-2" data-min="20000" data-max="60000" {{ ($m['price_range'] ?? '') == '20000-60000' ? 'selected' : '' }}>20 000 – 60 000 € — Partenariat long terme</option>
        <option value="60000+" class="engagement-progressive engagement-level-3" data-min="60000" data-max="999999" {{ ($m['price_range'] ?? '') == '60000+' ? 'selected' : '' }}>60 000 € et + — Partenariat stratégique étendu</option>
      </select>
      <a href="#" data-engagement-link-level="1" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Explorer des engagements plus avancés</a>
      <a href="#" data-engagement-link-level="2" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Découvrir les partenariats long terme</a>
      <a href="#" data-engagement-link-level="3" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Voir les collaborations stratégiques étendues</a>
      <a href="#" data-engagement-link-reset style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Revenir à l'essentiel</a>
    </div>
    <div class="budget-estimate" data-presence-budget-estimate style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;">
      <span class="budget-estimate-volume">Sélectionnez un engagement pour afficher une estimation en rituels.</span>
      <div class="budget-estimate-prices" style="display: none; font-size: 11px; color: #059669; margin-top: 4px;">
        <span>Tarif journalier moyen (<span data-presence-base-hours>7</span>h) : <span data-express-target="presence-daily-avg" data-base-value="0">0</span> €/jour <span class="budget-estimate-daily-range" style="display: none;">(fourchette : <span data-express-target="presence-daily-min" data-base-value="0">0</span>–<span data-express-target="presence-daily-max" data-base-value="0">0</span> €/jour)</span></span><br>
        <span>Tarif horaire moyen : <span data-express-target="presence-hourly-avg" data-base-value="0">0</span> €/h <span class="budget-estimate-hourly-range" style="display: none;">(fourchette : <span data-express-target="presence-hourly-min" data-base-value="0">0</span>–<span data-express-target="presence-hourly-max" data-base-value="0">0</span> €/h)</span></span>
      </div>
      <div class="budget-estimate-express" style="display: none; font-size: 10px; color: #6B7280; margin-top: 6px;"></div>
    </div>
    <div class="engagement-base-toggle-row" style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 11px; color: #6B7280;">
      <span class="engagement-base-label" style="font-weight: 500;">Base journée :</span>
      <span class="engagement-base-tooltip" data-tooltip="7h : référence 35h/semaine • 8h : journée standard selon organisation" title="7h : référence 35h/semaine • 8h : journée standard selon organisation" style="width: 16px; height: 16px; border-radius: 50%; background: #E5E7EB; color: #6B7280; font-size: 10px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: help;">i</span>
      <div class="engagement-base-toggle" style="display: inline-flex; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
        <button type="button" class="engagement-base-btn is-active" data-base="7" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">7h</button>
        <button type="button" class="engagement-base-btn" data-base="8" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">8h</button>
      </div>
    </div>
    <x-subscription.express-options variant="cards" :showMicroLine="true" />
  </div>

  <div class="filters-level filters-level-2" data-level="affiner">
    <h3 class="filters-level-title">Affiner la recherche</h3>
    <div class="filters-level-inner">
      <div class="preply-filter-group preply-experience-group">
        <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-briefcase me-2"></i>Mon expérience</label>
        <div class="experience-dropdown-wrapper">
          <div class="experience-dropdown-trigger" id="experienceDropdownTrigger">
            <span class="experience-selected-text" id="experienceSelectedText">
              @if($selectedExp === '0-2')0-2 ans
              @elseif($selectedExp === '3-7')3-7 ans
              @elseif($selectedExp === '8-15')8-15 ans
              @elseif($selectedExp === '16+')16 ans et plus
              @else Niveau d'expertise attendu
              @endif
            </span>
            <i class="fas fa-chevron-down experience-arrow" id="experienceArrow"></i>
          </div>
          <div class="experience-dropdown-menu" id="experienceDropdownMenu" style="display: none;">
            <div class="experience-option" data-value="">Niveau d'expertise attendu</div>
            <div class="experience-option" data-value="0-2">0-2 ans</div>
            <div class="experience-option" data-value="3-7">3-7 ans</div>
            <div class="experience-option" data-value="8-15">8-15 ans</div>
            <div class="experience-option" data-value="16+">16 ans et plus</div>
          </div>
          <input type="hidden" name="experience_level" id="experienceLevelInput" value="{{ $selectedExp }}">
        </div>
      </div>

      <div class="preply-filter-group sector-filter-container">
        <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-industry me-2"></i>Univers d'activité</label>
        <select name="sector" class="preply-filter-select">
          <option value="">Tous les univers d'activité</option>
          <option value="business_strategie" {{ $selectedSector === 'business_strategie' ? 'selected' : '' }}>Business & Stratégie</option>
          <option value="tech_digital" {{ $selectedSector === 'tech_digital' ? 'selected' : '' }}>Tech & Digital</option>
          <option value="marketing_marques_croissance" {{ $selectedSector === 'marketing_marques_croissance' ? 'selected' : '' }}>Marketing, Marques & Croissance</option>
          <option value="sante_bien_etre" {{ $selectedSector === 'sante_bien_etre' ? 'selected' : '' }}>Santé & Bien-être</option>
          <option value="impact_culture_societe" {{ $selectedSector === 'impact_culture_societe' ? 'selected' : '' }}>Impact, Culture & Société</option>
          <option value="formation_transmission" {{ $selectedSector === 'formation_transmission' ? 'selected' : '' }}>Formation & Transmission</option>
        </select>
      </div>
    </div>
  </div>

  <div class="filters-level filters-level-3" data-level="avances">
    <h3 class="filters-level-title">Critères avancés</h3>
    <div class="filters-level-inner">
    </div>
  </div>
</div>
