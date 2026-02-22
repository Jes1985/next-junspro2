
<div class="preply-filter-advanced sector-filter-container">
  <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-industry me-2"></i>Univers d'activité</label>
  <div class="sector-dropdown-wrapper">
    <div class="sector-dropdown-trigger" id="sectorDropdownTrigger">
      <span class="sector-selected-text" id="sectorSelectedText">
        <?php if(request('sector')): ?>
          <?php
            $sectorNames = [
              'business_strategie' => 'Business & Stratégie',
              'tech_digital' => 'Tech & Digital',
              'marketing_marques_croissance' => 'Marketing, Marques & Croissance',
              'sante_bien_etre' => 'Santé & Bien-être',
              'impact_culture_societe' => 'Impact, Culture & Société',
              'formation_transmission' => 'Formation & Transmission',
            ];
            $selectedSectorName = $sectorNames[request('sector')] ?? request('sector');
          ?>
          <?php echo e($selectedSectorName); ?>

        <?php else: ?>
          Tous les univers d'activité
        <?php endif; ?>
      </span>
      <input type="hidden" name="sector" id="sectorInput" value="<?php echo e(request('sector') ?? ''); ?>">
      <i class="fas fa-chevron-down sector-arrow" id="sectorArrow"></i>
    </div>
    <div class="sector-dropdown-menu" id="sectorDropdownMenu" style="display: none;">
      <div class="sector-search-wrapper">
        <i class="fas fa-search sector-search-icon"></i>
        <input type="text" class="sector-search-input" id="sectorSearchInput" placeholder="Tapez votre recherche…" autocomplete="off">
      </div>
      <div class="sector-popular-section">
        <div class="sector-list" id="sectorPopularList"></div>
      </div>
      <div class="sector-all-section" id="sectorAllSection" style="display: none;">
        <div class="sector-list" id="sectorAllList"></div>
      </div>
      <div class="sector-no-results" id="sectorNoResults" style="display: none;">Aucun résultat</div>
      <div class="sector-reset-option" id="sectorResetOption" role="button" tabindex="0">Tous les univers d'activité</div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\filters\partials\sector-filter.blade.php ENDPATH**/ ?>