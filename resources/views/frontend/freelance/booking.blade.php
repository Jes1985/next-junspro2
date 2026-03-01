@extends('frontend.layout')

@section('pageHeading')
  {{ __('Programmez vos Rituels') }} - {{ $user->first_name ?? $user->name }}
@endsection

@section('style')
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

  @keyframes spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
  }
</style>
@endsection

@section('content')
{{-- SchedulerHub - Détecte automatiquement l'univers depuis l'URL --}}
<div id="scheduler-hub-container" data-universe="{{ $universeType ?? 'lessons' }}" data-freelancer-id="{{ $freelancer->id ?? $user->id ?? null }}">
  <div class="booking-container" id="session-scheduler-container">
    <!-- En-tête -->
    <div class="booking-header">
      <h1>{{ __('Programmez vos Rituels') }}</h1>
      <p>{{ __('Sélectionnez les créneaux qui vous conviennent') }}</p>
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
            <span style="font-weight: 600; font-size: 16px; color: #111827;">{{ __('Rituels hebdomadaires') }}</span>
          </div>
          <p style="font-size: 14px; color: #6B7280; margin: 0;">{{ __('Suivez vos Rituels à la même heure chaque semaine') }}</p>
        </button>
        <button type="button" id="booking-type-onetime" class="booking-type-btn active" style="flex: 1; padding: 16px; border: 2px solid #EC4899; border-radius: 12px; background: #FDF2F8; cursor: pointer; text-align: left; transition: all 0.2s;" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.setBookingType === 'function'){window.setBookingType('onetime');}else{console.error('setBookingType non définie');}})(event)">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <i class="fas fa-calendar-alt" style="color: #EC4899;"></i>
            <span style="font-weight: 600; font-size: 16px; color: #111827;">{{ __('Rituels ponctuels') }}</span>
          </div>
          <p style="font-size: 14px; color: #6B7280; margin: 0;">{{ __('Choisissez un créneau différent pour chaque Rituel') }}</p>
        </button>
      </div>

      <!-- Contrôles agenda (Style Preply) -->
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 8px;">
          <button type="button" class="btn btn-sm" id="agenda-today-btn" onclick="(function(e){e.preventDefault();e.stopPropagation();if(typeof window.goToToday === 'function'){window.goToToday();}else{console.error('goToToday non définie');}})(event)" style="background: #F3F4F6; border: 1px solid #E5E7EB; color: #374151; padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 500;">
            {{ __('Aujourd\'hui') }}
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
              @php
                $today = \Carbon\Carbon::now();
                $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                $days = [];
                for ($i = 0; $i < 7; $i++) {
                  $days[] = $startOfWeek->copy()->addDays($i);
                }
                $dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
              @endphp
              @for ($day = 0; $day < 7; $day++)
                <th style="background: #F9FAFB; padding: 12px; font-weight: 600; color: #374151; border: 1px solid #E5E7EB;">
                  <span id="agenda-day-{{ $day }}">{{ $dayNames[$day] }}. {{ $days[$day]->format('d') }}</span>
                </th>
              @endfor
            </tr>
          </thead>
          <tbody id="agenda-slots-body">
            @php
              $startHour = 2;
              $endHour = 23;
              $today = \Carbon\Carbon::now();
              $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            @endphp
            <script>
              if (typeof window.bookedSlotsByDate === 'undefined') {
                window.bookedSlotsByDate = @json($bookedSlotsByDate ?? []);
              }
            </script>
            @for ($hour = $startHour; $hour <= $endHour; $hour++)
              @foreach ([0, 30] as $minute)
                <tr>
                  <td style="background: #F9FAFB; padding: 12px; font-weight: 500; color: #6B7280; border: 1px solid #E5E7EB; white-space: nowrap;">
                    {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}
                  </td>
                  @for ($day = 0; $day < 7; $day++)
                    @php
                      $dateForDay = $startOfWeek->copy()->addDays($day);
                      $dateKey = $dateForDay->format('Y-m-d');
                      $isAvailable = isset($availableSlots[$day][$hour][$minute]) && $availableSlots[$day][$hour][$minute] === true;
                      $isBooked = false;
                      if (isset($bookedSlotsByDate[$dateKey][$hour][$minute]) && $bookedSlotsByDate[$dateKey][$hour][$minute] === true) {
                        $isBooked = true;
                      }
                    @endphp
                    <td style="padding: 4px; border: 1px solid #E5E7EB; min-width: 100px;">
                      @if($isBooked)
                        <div style="padding: 6px; min-height: 32px; color: #9CA3AF; font-size: 12px; text-align: center;">—</div>
                      @elseif($isAvailable)
                        <button type="button" 
                                class="btn btn-sm agenda-slot-simple" 
                                data-day="{{ $day }}" 
                                data-hour="{{ $hour }}"
                                data-minute="{{ $minute }}"
                                data-slot-key="{{ $day }}-{{ $hour }}-{{ $minute }}"
                                data-is-configured="true"
                                data-original-border="#10B981"
                                style="width: 100%; background: #FFFFFF; border: 2px solid #10B981; color: #065F46; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; cursor: pointer; font-size: 13px; font-weight: 600; box-shadow: 0 1px 3px rgba(16, 185, 129, 0.2);"
                                onmouseover="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#ECFDF5'; this.style.borderColor='#10B981'; this.style.color='#047857'; this.style.boxShadow='0 2px 6px rgba(16, 185, 129, 0.3)'; this.style.transform='translateY(-1px)'; }"
                                onmouseout="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#FFFFFF'; this.style.borderColor='#10B981'; this.style.color='#065F46'; this.style.boxShadow='0 1px 3px rgba(16, 185, 129, 0.2)'; this.style.transform='translateY(0)'; }">
                          {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}
                        </button>
                      @else
                        <button type="button" 
                                class="btn btn-sm agenda-slot-simple" 
                                data-day="{{ $day }}" 
                                data-hour="{{ $hour }}"
                                data-minute="{{ $minute }}"
                                data-slot-key="{{ $day }}-{{ $hour }}-{{ $minute }}"
                                data-is-configured="false"
                                data-original-border="#3B82F6"
                                style="width: 100%; background: #F0F9FF; border: 2px solid #3B82F6; color: #1E40AF; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; cursor: pointer; font-size: 13px; font-weight: 600; opacity: 0.85; box-shadow: 0 1px 3px rgba(59, 130, 246, 0.15);"
                                onmouseover="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#DBEAFE'; this.style.borderColor='#3B82F6'; this.style.color='#1E3A8A'; this.style.opacity='1'; this.style.boxShadow='0 2px 6px rgba(59, 130, 246, 0.25)'; this.style.transform='translateY(-1px)'; }"
                                onmouseout="if(!this.classList.contains('selected') && !this.classList.contains('booked')) { this.style.background='#F0F9FF'; this.style.borderColor='#3B82F6'; this.style.color='#1E40AF'; this.style.opacity='0.85'; this.style.boxShadow='0 1px 3px rgba(59, 130, 246, 0.15)'; this.style.transform='translateY(0)'; }"
                                title="{{ __('Créneau non configuré - sélectionnable') }}">
                          {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}
                        </button>
                      @endif
                    </td>
                  @endfor
                </tr>
              @endforeach
            @endfor
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Colonne droite : Détails du Rituel (Style Preply) -->
    <div style="padding: 24px; background: #F9FAFB; position: relative;">
      <!-- Photo et nom du freelance -->
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
        @php
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
        @endphp
        @if($imageUrl)
          <img src="{{ $imageUrl }}" alt="{{ $fullName }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
        @else
          <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">
            {{ $initial }}
          </div>
        @endif
        <div>
          <div style="font-weight: 600; font-size: 16px; color: #111827;">{{ $fullName }}</div>
          <div style="font-size: 14px; color: #6B7280;">{{ __('Freelance') }}</div>
        </div>
      </div>
      
      <!-- Durée du Rituel -->
      <div style="margin-bottom: 24px;">
        <div style="font-weight: 600; font-size: 16px; color: #111827; margin-bottom: 12px;">{{ __('Durée du Rituel') }}</div>
        <div id="course-duration-selector" style="position: relative;">
          <button type="button" onclick="toggleDurationDropdown()" style="width: 100%; padding: 12px; background: white; border: 1px solid #E5E7EB; border-radius: 8px; text-align: left; cursor: pointer; display: flex; align-items: center; justify-content: space-between;">
            <span id="course-duration-text">{{ __('Rituel de 50 minutes') }}</span>
            <i class="fas fa-chevron-down" id="course-duration-chevron" style="color: #6B7280; transition: transform 0.2s;"></i>
          </button>
          <div id="course-duration-dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #E5E7EB; border-radius: 8px; margin-top: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000;">
            <div onclick="selectDuration(30)" style="padding: 12px; cursor: pointer; border-bottom: 1px solid #F3F4F6;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span>{{ __('30 minutes') }}</span>
            </div>
            <div onclick="selectDuration(50)" style="padding: 12px; cursor: pointer; border-bottom: 1px solid #F3F4F6;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span style="font-weight: 600;">{{ __('50 minutes') }}</span>
            </div>
            <div onclick="selectDuration(60)" style="padding: 12px; cursor: pointer;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='white';">
              <span>{{ __('60 minutes') }}</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Rituels à programmer -->
      <div style="margin-bottom: 24px;">
        <div style="font-weight: 600; font-size: 16px; color: #111827; margin-bottom: 16px;">
          <span id="courses-count">0</span> <span id="rituels-text">{{ __('Rituel à programmer') }}</span>
        </div>
        <div id="courses-list" style="display: flex; flex-direction: column; gap: 8px;">
          @for ($i = 1; $i <= 5; $i++)
            <div id="course-{{ $i }}-container" class="course-slot-container" style="display: none; padding: 12px; background: white; border: 1px solid #E5E7EB; border-radius: 8px;">
              <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                  <div style="font-weight: 600; font-size: 14px; color: #111827; margin-bottom: 4px;">{{ __('Rituel') }} {{ $i }}</div>
                  <div id="course-{{ $i }}-time" style="font-size: 13px; color: #6B7280;"></div>
                </div>
                <button type="button" onclick="removeCourseSlot({{ $i }})" style="background: transparent; border: none; color: #EF4444; cursor: pointer; padding: 4px 8px; border-radius: 4px; font-size: 18px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='#FEE2E2';" onmouseout="this.style.background='transparent';">
                  &times;
                </button>
              </div>
            </div>
          @endfor
          <div id="courses-empty-state" style="padding: 12px; text-align: center;">
            <p style="color: #9CA3AF; font-size: 14px; margin: 0;">{{ __('Aucun créneau sélectionné') }}</p>
          </div>
        </div>
      </div>
      
      <!-- Bouton Programmer -->
      <button type="button" id="schedule-btn" onclick="(function(){if(typeof window.handleScheduleClick === 'function'){window.handleScheduleClick();}else{console.error('handleScheduleClick non définie');}})()" style="width: 100%; padding: 14px; background: #6B7280; border: none; border-radius: 8px; color: white; font-weight: 600; font-size: 15px; cursor: not-allowed; margin-bottom: 16px; transition: all 0.2s;" disabled>
        {{ __('Programmer') }}
      </button>
      
      <!-- Informations -->
      <div class="booking-info-block" style="padding: 12px; background: #EFF6FF; border-radius: 8px; border-left: 4px solid #3B82F6;">
        <div style="display: flex; align-items: start; gap: 8px;">
          <i class="fas fa-info-circle" style="color: #3B82F6; margin-top: 2px;"></i>
          <p style="font-size: 13px; color: #1E40AF; margin: 0;">
            {{ __('Annulez ou reprogrammez gratuitement jusqu\'à 12h avant le début du Rituel.') }}
          </p>
        </div>
      </div>
      <p style="font-size: clamp(0.75rem, 2.5vw, 0.8125rem); color: #9CA3AF; margin: 12px 0 0 0;">{{ __('Paiement sécurisé') }} • {{ __('Annulation simplifiée') }} • {{ __('Facture') }} • {{ __('Support') }}</p>
    </div>
  </div>
</div>
</div>

{{-- ══════════════════════════════════════════
     POPUP DE CONFIRMATION ULTRA LUXE
     ══════════════════════════════════════════ --}}

{{-- Modale de confirmation --}}
<div id="luxury-confirm-modal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;padding:1rem;">
  {{-- Backdrop --}}
  <div id="luxury-confirm-backdrop" style="position:absolute;inset:0;background:rgba(10,8,30,0.6);transition:opacity 0.3s ease;"></div>

  {{-- Card --}}
  <div id="luxury-confirm-card" style="position:relative;width:min(520px,100%);">
    {{-- Glow border --}}
    <div style="position:absolute;inset:-1px;border-radius:28px;background:linear-gradient(135deg,rgba(139,92,246,0.6) 0%,rgba(59,130,246,0.5) 35%,rgba(236,72,153,0.5) 70%,rgba(139,92,246,0.6) 100%);padding:1.5px;">
      <div style="height:100%;border-radius:27px;background:linear-gradient(160deg,#0f0c29 0%,#1a1140 50%,#0d1117 100%);"></div>
    </div>

    {{-- Inner content --}}
    <div style="position:relative;border-radius:28px;padding:2.5rem;overflow:hidden;">
      {{-- Radial glow decoration --}}
      <div style="position:absolute;top:-80px;right:-60px;width:250px;height:250px;background:radial-gradient(circle,rgba(139,92,246,0.25) 0%,transparent 65%);pointer-events:none;"></div>
      <div style="position:absolute;bottom:-80px;left:-60px;width:220px;height:220px;background:radial-gradient(circle,rgba(59,130,246,0.2) 0%,transparent 65%);pointer-events:none;"></div>

      {{-- Header --}}
      <div style="display:flex;align-items:flex-start;gap:1rem;margin-bottom:1.5rem;">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#8B5CF6,#3B82F6);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 8px 24px rgba(139,92,246,0.4);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2">
            <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
          </svg>
        </div>
        <div>
          <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#8B5CF6;margin-bottom:.3rem;">Confirmation requise</div>
          <h2 id="luxury-confirm-title" style="margin:0;font-size:1.5rem;font-weight:900;color:white;letter-spacing:-.03em;line-height:1.2;">Programmer vos Rituels</h2>
        </div>
      </div>

      {{-- Slot pills --}}
      <div id="luxury-confirm-slots" style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1.75rem;"></div>

      {{-- Info bar --}}
      <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:.85rem 1rem;margin-bottom:1.75rem;display:flex;align-items:center;gap:.65rem;">
        <div style="width:8px;height:8px;border-radius:50%;background:#10B981;flex-shrink:0;box-shadow:0 0 8px #10B981;"></div>
        <p id="luxury-confirm-subtitle" style="margin:0;font-size:.875rem;color:rgba(255,255,255,0.65);line-height:1.5;"></p>
      </div>

      {{-- Boutons --}}
      <div style="display:flex;gap:.75rem;">
        <button type="button" id="luxury-confirm-cancel"
          style="flex:1;padding:1rem;border-radius:14px;border:1.5px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.7);font-weight:700;font-size:.95rem;cursor:pointer;transition:all .2s ease;letter-spacing:-.01em;"
          onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='white';"
          onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.7)';"
        >Annuler</button>
        <button type="button" id="luxury-confirm-ok"
          style="flex:2;padding:1rem;border-radius:14px;border:none;background:linear-gradient(135deg,#8B5CF6 0%,#3B82F6 60%,#EC4899 100%);color:white;font-weight:800;font-size:.95rem;cursor:pointer;transition:all .3s cubic-bezier(0.34,1.56,0.64,1);letter-spacing:-.01em;box-shadow:0 8px 28px rgba(139,92,246,0.45);"
          onmouseover="this.style.transform='translateY(-2px) scale(1.02)';this.style.boxShadow='0 16px 40px rgba(139,92,246,0.55)';"
          onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 8px 28px rgba(139,92,246,0.45)';"
        >
          <span id="luxury-confirm-ok-text">Confirmer la programmation</span>
        </button>
      </div>
    </div>
  </div>
</div>

{{-- Toast de succès / erreur --}}
<div id="luxury-toast" style="display:none;position:fixed;top:1.5rem;right:1.5rem;width:min(400px,calc(100vw - 3rem));z-index:10000;transform:translateX(120%);transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);">
  <div style="background:linear-gradient(135deg,#0f0c29,#1a1140);border-radius:20px;padding:1.25rem 1.5rem;box-shadow:0 24px 60px rgba(0,0,0,0.5);position:relative;overflow:hidden;">
    <div id="luxury-toast-glow" style="position:absolute;inset:0;pointer-events:none;"></div>
    <div id="luxury-toast-border" style="position:absolute;inset:0;border-radius:20px;pointer-events:none;"></div>
    <div style="position:relative;display:flex;align-items:flex-start;gap:.875rem;">
      <div id="luxury-toast-icon" style="width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"></div>
      <div style="flex:1;min-width:0;">
        <div id="luxury-toast-title" style="font-weight:800;font-size:.95rem;color:white;margin-bottom:.2rem;"></div>
        <div id="luxury-toast-text" style="font-size:.85rem;color:rgba(255,255,255,0.65);line-height:1.5;"></div>
      </div>
      <button onclick="hideLuxuryToast()" style="background:transparent;border:none;color:rgba(255,255,255,0.4);cursor:pointer;font-size:1.1rem;padding:.2rem;line-height:1;flex-shrink:0;" onmouseover="this.style.color='white';" onmouseout="this.style.color='rgba(255,255,255,0.4)';">✕</button>
    </div>
  </div>
</div>

<style>
  /* Popup luxe - animations */
  #luxury-confirm-card {
    transform: translateY(20px) scale(0.97);
    opacity: 0;
    transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
  }
  #luxury-confirm-modal.open { display: flex !important; }
  #luxury-confirm-modal.open #luxury-confirm-backdrop {
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
  }
  #luxury-confirm-modal.open #luxury-confirm-card {
    transform: translateY(0) scale(1);
    opacity: 1;
  }
  .slot-pill-luxe {
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .5rem .9rem; border-radius: 10px;
    background: rgba(255,255,255,0.06);
    border: 1.5px solid rgba(255,255,255,0.12);
    color: white; font-size: .85rem; font-weight: 700;
    letter-spacing: -.01em;
  }
  .slot-pill-luxe svg { opacity: .7; }
  #luxury-toast.show { transform: translateX(0) !important; display: block !important; }
</style>

@endsection

@push('scripts')
@include('frontend.freelance.partials.booking-scripts')

{{-- SchedulerHub pour détecter et charger le bon scheduler --}}
<link rel="stylesheet" href="{{ asset('assets/front/css/scheduler-premium.css') }}">
<script src="{{ asset('assets/js/scheduler/SchedulerHub.js') }}"></script>
@if(isset($universeType) && $universeType === 'projects')
  <script src="{{ asset('assets/js/scheduler/ProjectScheduler.js') }}"></script>
@elseif(isset($universeType) && $universeType === 'homeswap')
  <script src="{{ asset('assets/js/scheduler/HomeSwapScheduler.js') }}"></script>
@endif

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
@endpush

