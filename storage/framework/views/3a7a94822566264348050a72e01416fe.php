
<?php if($config['showExperience'] ?? false): ?>
  <div class="preply-filter-group preply-experience-group">
    <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-briefcase me-2"></i>Mon expérience</label>
    <div class="experience-dropdown-wrapper">
      <div class="experience-dropdown-trigger" id="experienceDropdownTrigger">
        <span class="experience-selected-text" id="experienceSelectedText">
          <?php if(request('experience_level') == '0-2'): ?>0-2 ans
          <?php elseif(request('experience_level') == '3-7'): ?>3-7 ans
          <?php elseif(request('experience_level') == '8-15'): ?>8-15 ans
          <?php elseif(request('experience_level') == '16+'): ?>16 ans et plus
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
      <input type="hidden" name="experience_level" id="experienceLevelInput" value="<?php echo e(request('experience_level')); ?>">
    </div>
  </div>
<?php endif; ?>

<?php if($config['showCategoryFilter'] ?? false): ?>
  <?php if (isset($component)) { $__componentOriginal2e40b8830300013423b46e6b5b9f3c7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2e40b8830300013423b46e6b5b9f3c7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.filters.category-filter','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.filters.category-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2e40b8830300013423b46e6b5b9f3c7c)): ?>
<?php $attributes = $__attributesOriginal2e40b8830300013423b46e6b5b9f3c7c; ?>
<?php unset($__attributesOriginal2e40b8830300013423b46e6b5b9f3c7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2e40b8830300013423b46e6b5b9f3c7c)): ?>
<?php $component = $__componentOriginal2e40b8830300013423b46e6b5b9f3c7c; ?>
<?php unset($__componentOriginal2e40b8830300013423b46e6b5b9f3c7c); ?>
<?php endif; ?>
<?php endif; ?>

<?php if($config['showAvailability'] ?? true): ?>
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
<?php endif; ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/components/services/filters/partials/level-3-filters.blade.php ENDPATH**/ ?>