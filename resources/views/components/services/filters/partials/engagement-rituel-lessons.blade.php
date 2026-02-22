{{-- Engagement en Rituel — Lessons uniquement — placé avant Univers d'activité — Univers A (Lessons) --}}
<div class="filter-group filter-group-rituel lessons-engagement-block" data-lessons-filters>
  <label class="filter-label"><i class="fas fa-coins me-2"></i>Engagement en Rituel (Budget / 4 semaines)</label>
  <div class="engagement-select-wrapper">
    <select name="price_range" class="filter-select budget-filter" id="lessonsBudgetFilter">
      <option value="" {{ empty(request('price_range')) ? 'selected' : '' }}>Tous les engagements</option>
      <option value="0-1000" data-min="0" data-max="1000" {{ request('price_range') == '0-1000' ? 'selected' : '' }}>0 – 1 000 € — Budget formation — Exploratoire</option>
      <option value="1000-2500" data-min="1000" data-max="2500" {{ request('price_range') == '1000-2500' ? 'selected' : '' }}>1 000 – 2 500 € — Budget formation — Standard</option>
      <option value="2500-5000" data-min="2500" data-max="5000" {{ request('price_range') == '2500-5000' ? 'selected' : '' }}>2 500 – 5 000 € — Budget formation — Intensif</option>
      <option value="5000-10000" data-min="5000" data-max="10000" {{ request('price_range') == '5000-10000' ? 'selected' : '' }}>5 000 – 10 000 € — Budget formation — Avancé</option>
      <option value="10000-20000" data-min="10000" data-max="20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>10 000 – 20 000 € — Budget formation — Partenariat</option>
      <option value="20000-60000" data-min="20000" data-max="60000" {{ request('price_range') == '20000-60000' ? 'selected' : '' }}>20 000 – 60 000 € — Budget formation — Long terme</option>
      <option value="60000+" data-min="60000" data-max="999999" {{ request('price_range') == '60000+' ? 'selected' : '' }}>60 000 € et + — Budget formation — Stratégique étendu</option>
    </select>
  </div>
  <div class="budget-estimate" id="lessonsBudgetEstimate" style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;">
    <span class="budget-estimate-volume">Sélectionnez un engagement pour afficher une estimation en rituels.</span>
    <div class="budget-estimate-prices" style="display: none; font-size: 11px; color: #059669; margin-top: 4px;">
      <span>
        Tarif journalier moyen (<span class="budget-estimate-base-hours">7</span>h) :
        <span data-express-target="engagement-daily-avg" data-base-value="0">0</span> €/jour
        <span class="budget-estimate-daily-range" style="display: none;">
          (fourchette :
          <span data-express-target="engagement-daily-min" data-base-value="0">0</span>–<span data-express-target="engagement-daily-max" data-base-value="0">0</span> €/jour)
        </span>
      </span><br>
      <span>
        Tarif horaire moyen :
        <span data-express-target="engagement-hourly-avg" data-base-value="0">0</span> €/h
        <span class="budget-estimate-hourly-range" style="display: none;">
          (fourchette :
          <span data-express-target="engagement-hourly-min" data-base-value="0">0</span>–<span data-express-target="engagement-hourly-max" data-base-value="0">0</span> €/h)
        </span>
      </span>
    </div>
    <div class="budget-estimate-express" style="display: none; font-size: 10px; color: #6B7280; margin-top: 6px;"></div>
  </div>
  <div class="budget-estimate-hourly" id="lessonsBudgetEstimateHourly" style="font-size: 11px; margin-top: 4px; color: #059669; opacity: 0.9; font-weight: 400; display: none;"></div>
  <div class="budget-recommandation-junspro" id="lessonsRecommandationJunspro" style="font-size: 11px; margin-top: 6px; color: #2563EB; font-weight: 500; display: none;"></div>
  <x-subscription.express-options variant="cards" :showMicroLine="true" />
  <div class="engagement-base-toggle-row" id="lessonsEngagementBaseToggleRow" style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 11px; color: #6B7280;">
    <span class="engagement-base-label" style="font-weight: 500;">Base journée :</span>
    <span class="engagement-base-tooltip" data-tooltip="7h : référence 35h/semaine • 8h : journée standard selon organisation" title="7h : référence 35h/semaine • 8h : journée standard selon organisation" style="width: 16px; height: 16px; border-radius: 50%; background: #E5E7EB; color: #6B7280; font-size: 10px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: help;">i</span>
    <div class="engagement-base-toggle" style="display: inline-flex; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
      <button type="button" class="engagement-base-btn is-active" data-base="7" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">7h</button>
      <button type="button" class="engagement-base-btn" data-base="8" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">8h</button>
    </div>
  </div>
  <a href="#lessonsTarifAccordion" class="lessons-affiner-tarif-link" id="lessonsAffinerTarifLink" style="display: block; margin-top: 12px;">
    <i class="fas fa-sliders-h me-2"></i>Affiner par tarif horaire
  </a>
</div>
