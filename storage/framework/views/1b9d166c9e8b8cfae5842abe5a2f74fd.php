<?php
  $selectedSector = (string)($m['sector'] ?? '');
  $selectedExp = (string)($m['experience_level'] ?? '');
?>

<div data-onboarding-universe="projects">
  <div class="filter-group filter-group-rituel projects-engagement-block" data-onboarding-projects-rituel>
    <label class="filter-label"><i class="fas fa-coins me-2"></i>Engagement en Rituel</label>
    <div class="engagement-select-wrapper">
      <select name="price_range" class="filter-select budget-filter" data-projects-budget>
        <option value="" <?php echo e(empty($m['price_range'] ?? '') ? 'selected' : ''); ?>>Tous les engagements</option>
        <option value="0-1000" data-min="0" data-max="1000" <?php echo e(($m['price_range'] ?? '') == '0-1000' ? 'selected' : ''); ?>>0 – 1 000 € — Engagement exploratoire</option>
        <option value="1000-2500" data-min="1000" data-max="2500" <?php echo e(($m['price_range'] ?? '') == '1000-2500' ? 'selected' : ''); ?>>1 000 – 2 500 € — Engagement ciblé</option>
        <option value="2500-5000" data-min="2500" data-max="5000" <?php echo e(($m['price_range'] ?? '') == '2500-5000' ? 'selected' : ''); ?>>2 500 – 5 000 € — Engagement structuré</option>
        <option value="5000-10000" data-min="5000" data-max="10000" <?php echo e(($m['price_range'] ?? '') == '5000-10000' ? 'selected' : ''); ?>>5 000 – 10 000 € — Engagement stratégique</option>
        <option value="10000-20000" class="engagement-progressive engagement-level-1" data-min="10000" data-max="20000" <?php echo e(($m['price_range'] ?? '') == '10000-20000' ? 'selected' : ''); ?>>10 000 – 20 000 € — Engagement de partenariat</option>
        <option value="20000-60000" class="engagement-progressive engagement-level-2" data-min="20000" data-max="60000" <?php echo e(($m['price_range'] ?? '') == '20000-60000' ? 'selected' : ''); ?>>20 000 – 60 000 € — Partenariat long terme</option>
        <option value="60000+" class="engagement-progressive engagement-level-3" data-min="60000" data-max="999999" <?php echo e(($m['price_range'] ?? '') == '60000+' ? 'selected' : ''); ?>>60 000 € et + — Partenariat stratégique étendu</option>
      </select>
      <a href="#" data-engagement-link-level="1" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Explorer des engagements plus avancés</a>
      <a href="#" data-engagement-link-level="2" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Découvrir les partenariats long terme</a>
      <a href="#" data-engagement-link-level="3" style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Voir les collaborations stratégiques étendues</a>
      <a href="#" data-engagement-link-reset style="display:none; margin-top:6px; font-size:11px; color:#6b7280; text-decoration:underline; cursor:pointer;">Revenir à l'essentiel</a>
    </div>
    <div class="budget-estimate" data-projects-budget-estimate style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;">
      <span class="budget-estimate-volume">Sélectionnez un engagement pour afficher une estimation en rituels.</span>
      <div class="budget-estimate-prices" style="display: none; font-size: 11px; color: #059669; margin-top: 4px;">
        <span>Tarif journalier moyen (<span data-projects-base-hours>7</span>h) : <span data-express-target="projects-daily-avg" data-base-value="0">0</span> €/jour <span class="budget-estimate-daily-range" style="display: none;">(fourchette : <span data-express-target="projects-daily-min" data-base-value="0">0</span>–<span data-express-target="projects-daily-max" data-base-value="0">0</span> €/jour)</span></span><br>
        <span>Tarif horaire moyen : <span data-express-target="projects-hourly-avg" data-base-value="0">0</span> €/h <span class="budget-estimate-hourly-range" style="display: none;">(fourchette : <span data-express-target="projects-hourly-min" data-base-value="0">0</span>–<span data-express-target="projects-hourly-max" data-base-value="0">0</span> €/h)</span></span>
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
    <?php if (isset($component)) { $__componentOriginal5cbed211e40342dd846196c4523ba0f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cbed211e40342dd846196c4523ba0f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.express-options','data' => ['variant' => 'cards','showMicroLine' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.express-options'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'cards','showMicroLine' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $attributes = $__attributesOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $component = $__componentOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__componentOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
  </div>

  <div class="filters-level filters-level-2" data-level="affiner">
    <h3 class="filters-level-title">Affiner la recherche</h3>
    <div class="filters-level-inner">
      <div class="preply-filter-group sector-filter-container">
        <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-industry me-2"></i>Univers d'activité</label>
        <select name="sector" class="preply-filter-select">
          <option value="">Tous les univers d'activité</option>
          <option value="business_strategie" <?php echo e($selectedSector === 'business_strategie' ? 'selected' : ''); ?>>Business & Stratégie</option>
          <option value="tech_digital" <?php echo e($selectedSector === 'tech_digital' ? 'selected' : ''); ?>>Tech & Digital</option>
          <option value="marketing_marques_croissance" <?php echo e($selectedSector === 'marketing_marques_croissance' ? 'selected' : ''); ?>>Marketing, Marques & Croissance</option>
          <option value="sante_bien_etre" <?php echo e($selectedSector === 'sante_bien_etre' ? 'selected' : ''); ?>>Santé & Bien-être</option>
          <option value="impact_culture_societe" <?php echo e($selectedSector === 'impact_culture_societe' ? 'selected' : ''); ?>>Impact, Culture & Société</option>
          <option value="formation_transmission" <?php echo e($selectedSector === 'formation_transmission' ? 'selected' : ''); ?>>Formation & Transmission</option>
        </select>
      </div>
    </div>
  </div>

  <div class="filters-level filters-level-3" data-level="avances">
    <h3 class="filters-level-title">Critères avancés</h3>
    <div class="filters-level-inner">
      <div class="preply-filter-group preply-experience-group">
        <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-briefcase me-2"></i>Mon expérience</label>
        <div class="experience-dropdown-wrapper">
          <div class="experience-dropdown-trigger" id="experienceDropdownTrigger">
            <span class="experience-selected-text" id="experienceSelectedText">
              <?php if($selectedExp === '0-2'): ?>0-2 ans
              <?php elseif($selectedExp === '3-7'): ?>3-7 ans
              <?php elseif($selectedExp === '8-15'): ?>8-15 ans
              <?php elseif($selectedExp === '16+'): ?>16 ans et plus
              <?php else: ?> Niveau d'expertise attendu
              <?php endif; ?>
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
          <input type="hidden" name="experience_level" id="experienceLevelInput" value="<?php echo e($selectedExp); ?>">
        </div>
      </div>

      <div class="preply-filter-group preply-availability-group">
        <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-calendar-alt me-2"></i>Mes disponibilités</label>
        <button type="button" class="preply-availability-trigger" onclick="toggleAvailabilityPanel()">
          <span class="availability-selected-text">Toutes les heures</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="preply-availability-panel" id="availabilityPanel">
          <div class="availability-section">
            <h4 class="availability-section-title">Heures</h4>
            <div class="availability-time-group">
              <div class="availability-time-label">Journée</div>
              <div class="availability-time-slots">
                <button type="button" class="availability-time-btn" data-time="9-12"><i class="fas fa-sun"></i><span>9-12</span></button>
                <button type="button" class="availability-time-btn" data-time="12-15"><i class="fas fa-sun"></i><span>12-15</span></button>
                <button type="button" class="availability-time-btn" data-time="15-18"><i class="fas fa-sun"></i><span>15-18</span></button>
              </div>
            </div>
            <div class="availability-time-group">
              <div class="availability-time-label">Soir et nuit</div>
              <div class="availability-time-slots">
                <button type="button" class="availability-time-btn" data-time="18-21"><i class="fas fa-sun"></i><span>18-21</span></button>
                <button type="button" class="availability-time-btn" data-time="21-24"><i class="fas fa-moon"></i><span>21-24</span></button>
                <button type="button" class="availability-time-btn" data-time="0-3"><i class="fas fa-moon"></i><span>0-3</span></button>
              </div>
            </div>
            <div class="availability-time-group">
              <div class="availability-time-label">Tôt le matin</div>
              <div class="availability-time-slots">
                <button type="button" class="availability-time-btn" data-time="3-6"><i class="fas fa-moon"></i><span>3-6</span></button>
                <button type="button" class="availability-time-btn" data-time="6-9"><i class="fas fa-sun"></i><span>6-9</span></button>
              </div>
            </div>
          </div>
          <div class="availability-section">
            <h4 class="availability-section-title">Jours</h4>
            <div class="availability-days">
              <button type="button" class="availability-day-btn" data-day="0">Dim</button>
              <button type="button" class="availability-day-btn" data-day="1">Lun</button>
              <button type="button" class="availability-day-btn" data-day="2">Mar</button>
              <button type="button" class="availability-day-btn" data-day="3">Mer</button>
              <button type="button" class="availability-day-btn" data-day="4">Jeu</button>
              <button type="button" class="availability-day-btn" data-day="5">Ven</button>
              <button type="button" class="availability-day-btn" data-day="6">Sam</button>
            </div>
          </div>
          <div class="availability-actions">
            <button type="button" class="availability-clear-btn" onclick="clearAvailabilitySelection()">Effacer</button>
            <button type="button" class="availability-apply-btn" onclick="applyAvailabilityFilter()">Appliquer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\partials\matching\projects.blade.php ENDPATH**/ ?>