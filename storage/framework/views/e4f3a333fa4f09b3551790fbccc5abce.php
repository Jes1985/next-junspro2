<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Programmez vos Rituels')); ?> - <?php echo e($user->first_name ?? $user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
  body {
    background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 25%, #DDD6FE 50%, #E0E7FF 75%, #EEF2FF 100%);
    min-height: 100vh;
  }
  
  .booking-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px;
  }
  
  .booking-header {
    margin-bottom: 32px;
  }
  
  .booking-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
  }
  
  .booking-header p {
    font-size: 16px;
    color: #6B7280;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="scheduler-hub-container" data-universe="<?php echo e($universeType ?? 'lessons'); ?>" data-freelancer-id="<?php echo e($freelancer->id ?? $user->id ?? null); ?>">
  <div class="booking-container" id="session-scheduler-container">
    <!-- En-tête -->
    <div class="booking-header">
      <h1><?php echo e(__('Programmez vos Rituels')); ?></h1>
      <p><?php echo e(__('Sélectionnez les créneaux qui vous conviennent')); ?></p>
    </div>

  <!-- Layout en 2 colonnes (Style Preply) -->
  <div style="display: grid; grid-template-columns: 1fr 400px; gap: 0; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(139, 92, 246, 0.15); border: 1px solid rgba(196, 181, 253, 0.3);">
    <!-- Colonne gauche : Calendrier -->
    <div style="padding: 24px; border-right: 1px solid #E5E7EB;">
      <!-- Sélection type de réservation (Style Preply) -->
      <div style="display: flex; gap: 16px; margin-bottom: 24px; border-bottom: 1px solid #E5E7EB; padding-bottom: 16px;">
        <button type="button" id="booking-type-weekly" class="booking-type-btn" style="flex: 1; padding: 16px; border: 2px solid #E5E7EB; border-radius: 12px; background: white; cursor: pointer; text-align: left; transition: all 0.2s;" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.setBookingType === 'function'){window.setBookingType('weekly');}else{console.error('setBookingType non définie');}})(event)">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <i class="fas fa-sync-alt" style="color: #6B7280;"></i>
            <span style="font-weight: 600; font-size: 16px; color: #111827;"><?php echo e(__('Rituels hebdomadaires')); ?></span>
          </div>
          <p style="font-size: 14px; color: #6B7280; margin: 0;"><?php echo e(__('Suivez vos Rituels à la même heure chaque semaine')); ?></p>
        </button>
        <button type="button" id="booking-type-onetime" class="booking-type-btn active" style="flex: 1; padding: 16px; border: 2px solid #EC4899; border-radius: 12px; background: #FDF2F8; cursor: pointer; text-align: left; transition: all 0.2s;" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.setBookingType === 'function'){window.setBookingType('onetime');}else{console.error('setBookingType non définie');}})(event)">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <i class="fas fa-calendar-alt" style="color: #EC4899;"></i>
            <span style="font-weight: 600; font-size: 16px; color: #111827;"><?php echo e(__('Rituels ponctuels')); ?></span>
          </div>
          <p style="font-size: 14px; color: #6B7280; margin: 0;"><?php echo e(__('Choisissez un créneau différent pour chaque Rituel')); ?></p>
        </button>
      </div>

      <!-- Contrôles agenda (Style Preply) -->
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 8px;">
          <button type="button" class="btn btn-sm" id="agenda-today-btn" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.goToToday === 'function'){window.goToToday();}else{console.error('goToToday non définie');}})(event)" style="background: #F3F4F6; border: 1px solid #E5E7EB; color: #374151; padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 500;">
            <?php echo e(__('Aujourd\'hui')); ?>

          </button>
          <button type="button" class="btn btn-sm btn-outline-secondary" id="agenda-prev-week" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.currentWeek !== 'undefined'){window.currentWeek--;}else{window.currentWeek=-1;}if(typeof window.updateWeekDisplay === 'function'){window.updateWeekDisplay();}else{console.error('updateWeekDisplay non définie');}})(event)">
            <i class="fas fa-chevron-left"></i>
          </button>
          <span style="font-weight: 600; min-width: 180px; text-align: center; font-size: 15px; color: #111827;" id="agenda-week-display">Semaine actuelle</span>
          <button type="button" class="btn btn-sm btn-outline-secondary" id="agenda-next-week" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.currentWeek !== 'undefined'){window.currentWeek++;}else{window.currentWeek=1;}if(typeof window.updateWeekDisplay === 'function'){window.updateWeekDisplay();}else{console.error('updateWeekDisplay non définie');}})(event)">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
        <select class="form-select form-select-sm" id="agenda-timezone" style="max-width: 200px;">
          <option value="Europe/Paris" selected>Europe/Paris (GMT+1)</option>
          <option value="Europe/London">Europe/London (GMT+0)</option>
          <option value="America/New_York">America/New_York (GMT-5)</option>
        </select>
      </div>

      <!-- Tableau agenda -->
      <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-bordered text-center" style="margin-bottom: 0;">
          <thead style="position: sticky; top: 0; background: white; z-index: 10;">
            <tr>
              <th style="background: #F9FAFB; padding: 12px; font-weight: 600; color: #374151; border: 1px solid #E5E7EB;">Heure</th>
              <?php
                $today = \Carbon\Carbon::now();
                $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                $days = [];
                for ($i = 0; $i < 7; $i++) {
                  $days[] = $startOfWeek->copy()->addDays($i);
                }
                $dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
              ?>
              <?php for($day = 0; $day < 7; $day++): ?>
                <th style="background: #F9FAFB; padding: 12px; font-weight: 600; color: #374151; border: 1px solid #E5E7EB;">
                  <span id="agenda-day-<?php echo e($day); ?>"><?php echo e($dayNames[$day]); ?>. <?php echo e($days[$day]->format('d')); ?></span>
                </th>
              <?php endfor; ?>
            </tr>
          </thead>
          <tbody id="agenda-slots-body">
            <?php
              $startHour = 2;
              $endHour = 23;
              $today = \Carbon\Carbon::now();
              $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            ?>
            <script>
              if (typeof window.bookedSlotsByDate === 'undefined') {
                window.bookedSlotsByDate = <?php echo json_encode($bookedSlotsByDate ?? [], 15, 512) ?>;
              }
            </script>
            <?php for($hour = $startHour; $hour <= $endHour; $hour++): ?>
              <?php $__currentLoopData = [0, 30]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $minute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td style="background: #F9FAFB; padding: 12px; font-weight: 500; color: #6B7280; border: 1px solid #E5E7EB; white-space: nowrap;">
                    <?php echo e(str_pad($hour, 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad($minute, 2, '0', STR_PAD_LEFT)); ?>

                  </td>
                  <?php for($day = 0; $day < 7; $day++): ?>
                    <?php
                      $dateForDay = $startOfWeek->copy()->addDays($day);
                      $dateKey = $dateForDay->format('Y-m-d');
                      $isAvailable = isset($availableSlots[$day][$hour][$minute]) && $availableSlots[$day][$hour][$minute] === true;
                      $isBooked = false;
                      if (isset($bookedSlotsByDate[$dateKey][$hour][$minute]) && $bookedSlotsByDate[$dateKey][$hour][$minute] === true) {
                        $isBooked = true;
                      }
                    ?>
                    <td style="padding: 4px; border: 1px solid #E5E7EB; min-width: 100px;">
                      <?php if($isBooked): ?>
                        <div style="padding: 6px; min-height: 32px; color: #9CA3AF; font-size: 12px; text-align: center;">—</div>
                      <?php elseif($isAvailable): ?>
                        <button type="button" 
                                class="btn btn-sm agenda-slot-simple" 
                                data-day="<?php echo e($day); ?>" 
                                data-hour="<?php echo e($hour); ?>"
                                data-minute="<?php echo e($minute); ?>"
                                data-slot-key="<?php echo e($day); ?>-<?php echo e($hour); ?>-<?php echo e($minute); ?>"
                                data-is-configured="true"
                                data-original-border="#10B981"
                                style="width: 100%; background: #FFFFFF; border: 2px solid #10B981; color: #065F46; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; cursor: pointer; font-size: 13px; font-weight: 600; box-shadow: 0 1px 3px rgba(16, 185, 129, 0.2);"
                                onmouseover="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#ECFDF5'; this.style.borderColor='#10B981'; this.style.color='#047857'; this.style.boxShadow='0 2px 6px rgba(16, 185, 129, 0.3)'; this.style.transform='translateY(-1px)'; }"
                                onmouseout="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#FFFFFF'; this.style.borderColor='#10B981'; this.style.color='#065F46'; this.style.boxShadow='0 1px 3px rgba(16, 185, 129, 0.2)'; this.style.transform='translateY(0)'; }">
                          <?php echo e(str_pad($hour, 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad($minute, 2, '0', STR_PAD_LEFT)); ?>

                        </button>
                      <?php else: ?>
                        <button type="button" 
                                class="btn btn-sm agenda-slot-simple" 
                                data-day="<?php echo e($day); ?>" 
                                data-hour="<?php echo e($hour); ?>"
                                data-minute="<?php echo e($minute); ?>"
                                data-slot-key="<?php echo e($day); ?>-<?php echo e($hour); ?>-<?php echo e($minute); ?>"
                                data-is-configured="false"
                                data-original-border="#3B82F6"
                                style="width: 100%; background: #F0F9FF; border: 2px solid #3B82F6; color: #1E40AF; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; cursor: pointer; font-size: 13px; font-weight: 600; opacity: 0.85; box-shadow: 0 1px 3px rgba(59, 130, 246, 0.15);"
                                onmouseover="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#DBEAFE'; this.style.borderColor='#3B82F6'; this.style.color='#1E3A8A'; this.style.opacity='1'; this.style.boxShadow='0 2px 6px rgba(59, 130, 246, 0.25)'; this.style.transform='translateY(-1px)'; }"
                                onmouseout="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#F0F9FF'; this.style.borderColor='#3B82F6'; this.style.color='#1E40AF'; this.style.opacity='0.85'; this.style.boxShadow='0 1px 3px rgba(59, 130, 246, 0.15)'; this.style.transform='translateY(0)'; }"
                                title="<?php echo e(__('Créneau non configuré - sélectionnable')); ?>">
                          <?php echo e(str_pad($hour, 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad($minute, 2, '0', STR_PAD_LEFT)); ?>

                        </button>
                      <?php endif; ?>
                    </td>
                  <?php endfor; ?>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Colonne droite : Détails du Rituel (Style Preply) -->
    <div style="padding: 24px; background: #F9FAFB; position: relative;">
      <!-- Photo et nom du freelance -->
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        <?php
          $imageUrl = null;
          if ($user->image) {
            if (\Storage::disk('public')->exists('img/users/' . $user->image)) {
              $imageUrl = \Storage::disk('public')->url('img/users/' . $user->image);
            } else {
              $path2 = public_path('assets/img/users/' . $user->image);
              if (file_exists($path2)) {
                $imageUrl = asset('assets/img/users/' . $user->image);
              }
            }
          }
          $firstName = $user->first_name ?? '';
          $lastName = $user->last_name ?? '';
          $fullName = trim($firstName . ' ' . $lastName) ?: ($user->name ?? __('Freelance'));
          $initial = strtoupper(substr($firstName, 0, 1) ?: substr($lastName, 0, 1) ?: 'F');
        ?>
        <?php if($imageUrl): ?>
          <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($fullName); ?>" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
        <?php else: ?>
          <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">
            <?php echo e($initial); ?>

          </div>
        <?php endif; ?>
        <div>
          <div style="font-weight: 600; font-size: 16px; color: #111827;"><?php echo e($fullName); ?></div>
          <div style="font-size: 14px; color: #6B7280;"><?php echo e(__('Freelance')); ?></div>
        </div>
      </div>
      
      <!-- Durée du Rituel -->
      <div style="margin-bottom: 24px;">
        <div style="font-weight: 600; font-size: 16px; color: #111827; margin-bottom: 12px;"><?php echo e(__('Durée du Rituel')); ?></div>
        <div id="course-duration-selector" style="position: relative;">
          <button type="button" onclick="toggleDurationDropdown()" style="width: 100%; padding: 12px; background: white; border: 1px solid #E5E7EB; border-radius: 8px; text-align: left; cursor: pointer; display: flex; align-items: center; justify-content: space-between;">
            <span id="course-duration-text"><?php echo e(__('Rituel de 50 minutes')); ?></span>
            <i class="fas fa-chevron-down" id="course-duration-chevron" style="color: #6B7280; transition: transform 0.2s;"></i>
          </button>
          <div id="course-duration-dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #E5E7EB; border-radius: 8px; margin-top: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000;">
            <div onclick="selectDuration(30)" style="padding: 12px; cursor: pointer; border-bottom: 1px solid #F3F4F6;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span><?php echo e(__('30 minutes')); ?></span>
            </div>
            <div onclick="selectDuration(50)" style="padding: 12px; cursor: pointer; border-bottom: 1px solid #F3F4F6;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span style="font-weight: 600;"><?php echo e(__('50 minutes')); ?></span>
            </div>
            <div onclick="selectDuration(60)" style="padding: 12px; cursor: pointer;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span><?php echo e(__('60 minutes')); ?></span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Rituels à programmer -->
      <div style="margin-bottom: 24px;">
        <div style="font-weight: 600; font-size: 16px; color: #111827; margin-bottom: 16px;">
          <span id="courses-count">0</span> <span id="rituels-text"><?php echo e(__('Rituel à programmer')); ?></span>
        </div>
        <div id="courses-list" style="display: flex; flex-direction: column; gap: 8px;">
          <?php for($i = 1; $i <= 5; $i++): ?>
            <div id="course-<?php echo e($i); ?>-container" class="course-slot-container" style="display: none; padding: 12px; background: white; border: 1px solid #E5E7EB; border-radius: 8px;">
              <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                  <div style="font-weight: 600; font-size: 14px; color: #111827; margin-bottom: 4px;"><?php echo e(__('Rituel')); ?> <?php echo e($i); ?></div>
                  <div id="course-<?php echo e($i); ?>-time" style="font-size: 13px; color: #6B7280;"></div>
                </div>
                <button type="button" onclick="removeCourseSlot(<?php echo e($i); ?>)" style="background: transparent; border: none; color: #EF4444; cursor: pointer; padding: 4px 8px; border-radius: 4px; font-size: 18px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='#FEE2E2';" onmouseout="this.style.background='transparent';">
                  &times;
                </button>
              </div>
            </div>
          <?php endfor; ?>
          <div id="courses-empty-state" style="padding: 12px; text-align: center;">
            <p style="color: #9CA3AF; font-size: 14px; margin: 0;"><?php echo e(__('Aucun créneau sélectionné')); ?></p>
          </div>
        </div>
      </div>
      
      <!-- Bouton Programmer -->
      <button type="button" id="schedule-btn" onclick="(function(){if(typeof window.handleScheduleClick === 'function'){window.handleScheduleClick();}else{console.error('handleScheduleClick non définie');}})()" style="width: 100%; padding: 14px; background: #6B7280; border: none; border-radius: 8px; color: white; font-weight: 600; font-size: 15px; cursor: not-allowed; margin-bottom: 16px; transition: all 0.2s;" disabled>
        <?php echo e(__('Programmer')); ?>

      </button>
      
      <!-- Informations -->
      <div class="booking-info-block" style="padding: 12px; background: #EFF6FF; border-radius: 8px; border-left: 4px solid #3B82F6;">
        <div style="display: flex; align-items: start; gap: 8px;">
          <i class="fas fa-info-circle" style="color: #3B82F6; margin-top: 2px;"></i>
          <p style="font-size: 13px; color: #1E40AF; margin: 0;">
            <?php echo e(__('Annulez ou reprogrammez gratuitement jusqu\'à 12h avant le début du Rituel.')); ?>

          </p>
        </div>
      </div>
      <p style="font-size: clamp(0.75rem, 2.5vw, 0.8125rem); color: #9CA3AF; margin: 12px 0 0 0;"><?php echo e(__('Paiement sécurisé')); ?> • <?php echo e(__('Annulation simplifiée')); ?> • <?php echo e(__('Facture')); ?> • <?php echo e(__('Support')); ?></p>
    </div>
  </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php echo $__env->make('frontend.freelance.partials.booking-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/scheduler-premium.css')); ?>">
<script src="<?php echo e(asset('assets/js/scheduler/SchedulerHub.js')); ?>"></script>
<?php if(isset($universeType) && $universeType === 'projects'): ?>
  <script src="<?php echo e(asset('assets/js/scheduler/ProjectScheduler.js')); ?>"></script>
<?php elseif(isset($universeType) && $universeType === 'homeswap'): ?>
  <script src="<?php echo e(asset('assets/js/scheduler/HomeSwapScheduler.js')); ?>"></script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const container = document.getElementById('scheduler-hub-container');
  if (!container) return;

  const universe = container.getAttribute('data-universe');
  const freelancerId = container.getAttribute('data-freelancer-id');

  // Initialiser le SchedulerHub
  if (typeof SchedulerHub !== 'undefined') {
    const hub = new SchedulerHub('scheduler-hub-container', {
      universeType: universe,
      freelancerId: freelancerId
    });

    // Exposer les instances pour les callbacks
    if (universe === 'projects' && typeof ProjectScheduler !== 'undefined') {
      window.projectSchedulerInstance = hub;
    } else if (universe === 'homeswap' && typeof HomeSwapScheduler !== 'undefined') {
      window.homeSwapSchedulerInstance = hub;
    }
  }
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\booking.blade.php ENDPATH**/ ?>