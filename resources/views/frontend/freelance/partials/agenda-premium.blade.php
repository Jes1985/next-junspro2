<!-- Agenda & Disponibilités -->
<div class="freelancer-profile-section-premium" id="agenda">
  <h2 class="freelancer-profile-section-title">
    <i class="fas fa-calendar-alt"></i>
    {{ __('Agenda') }}
  </h2>
  
  <!-- Bandeau d'info -->
  <div class="alert alert-info d-flex align-items-start mb-3" role="alert">
    <i class="fas fa-info-circle me-2 mt-1"></i>
    <div>
      <small>{{ __('Sélectionnez l\'heure de votre premier Rituel. Les heures sont affichées dans votre fuseau horaire.') }}</small>
    </div>
  </div>

  <!-- Contrôles agenda -->
  <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
      <button class="btn btn-sm btn-outline-secondary" id="agenda-prev-week">
        <i class="fas fa-chevron-left"></i>
      </button>
      <span class="fw-semibold" id="agenda-week-display">10-16 déc. 2025</span>
      <button class="btn btn-sm btn-outline-secondary" id="agenda-next-week">
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
  <div class="table-responsive">
    <table class="table table-bordered text-center agenda-table-premium">
      <thead>
        <tr>
          <th class="agenda-time-header"></th>
          <th class="agenda-day-header">{{ __('Lun') }}</th>
          <th class="agenda-day-header">{{ __('Mar') }}</th>
          <th class="agenda-day-header">{{ __('Mer') }}</th>
          <th class="agenda-day-header">{{ __('Jeu') }}</th>
          <th class="agenda-day-header">{{ __('Ven') }}</th>
          <th class="agenda-day-header">{{ __('Sam') }}</th>
          <th class="agenda-day-header">{{ __('Dim') }}</th>
        </tr>
      </thead>
      <tbody id="agenda-slots">
        @for ($hour = 0; $hour < 24; $hour++)
          <tr>
            <td class="agenda-time-cell">
              <span class="agenda-time-label">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00</span>
            </td>
            @for ($day = 0; $day < 7; $day++)
              <td class="agenda-slot-cell">
                <button class="agenda-slot-btn-premium" 
                        data-day="{{ $day }}" 
                        data-hour="{{ $hour }}">
                  {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                </button>
              </td>
            @endfor
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
</div>

<style>
  .agenda-table-premium {
    border-collapse: separate;
    border-spacing: 0;
  }

  .agenda-time-header {
    background: var(--junspro-bg-light) !important;
    border: 1px solid var(--junspro-border) !important;
    font-weight: 600;
    color: var(--junspro-text);
    padding: 12px;
    width: 80px;
  }

  .agenda-day-header {
    background: var(--junspro-bg-light) !important;
    border: 1px solid var(--junspro-border) !important;
    font-weight: 600;
    color: var(--junspro-text);
    padding: 12px;
  }

  .agenda-time-cell {
    background: var(--junspro-bg-light);
    border: 1px solid var(--junspro-border);
    padding: 8px;
    text-align: right;
    vertical-align: middle;
    width: 80px;
  }

  .agenda-time-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--junspro-text-light);
  }

  .agenda-slot-cell {
    border: 1px solid var(--junspro-border);
    padding: 4px;
    vertical-align: middle;
    background: white;
  }

  .agenda-slot-btn-premium {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid var(--junspro-border);
    border-radius: 8px;
    background: white;
    color: var(--junspro-primary);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    min-height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .agenda-slot-btn-premium:hover {
    background: rgba(79, 70, 229, 0.08);
    border-color: var(--junspro-primary);
    color: var(--junspro-primary-dark);
    transform: translateY(-1px);
  }

  .agenda-slot-btn-premium.selected {
    background: var(--junspro-gradient);
    border-color: var(--junspro-primary);
    color: white;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
    font-weight: 600;
  }
</style>

<script>
  // Gestion de l'agenda
  document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.getElementById('agenda-prev-week');
    const nextBtn = document.getElementById('agenda-next-week');
    const weekDisplay = document.getElementById('agenda-week-display');
    const slotBtns = document.querySelectorAll('.agenda-slot-btn-premium');

    let currentWeek = 0;

    function updateWeekDisplay() {
      const today = new Date();
      const startOfWeek = new Date(today);
      const dayOfWeek = today.getDay();
      const daysToMonday = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
      startOfWeek.setDate(today.getDate() - daysToMonday + (currentWeek * 7));
      const endOfWeek = new Date(startOfWeek);
      endOfWeek.setDate(startOfWeek.getDate() + 6);

      const options = { day: 'numeric', month: 'short' };
      const startStr = startOfWeek.toLocaleDateString('fr-FR', options);
      const endStr = endOfWeek.toLocaleDateString('fr-FR', options);
      
      if (weekDisplay) {
        weekDisplay.textContent = `${startStr} – ${endStr} ${endOfWeek.getFullYear()}`;
      }
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { currentWeek--; updateWeekDisplay(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { currentWeek++; updateWeekDisplay(); });

    slotBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        slotBtns.forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
      });
    });

    updateWeekDisplay();
  });
</script>




