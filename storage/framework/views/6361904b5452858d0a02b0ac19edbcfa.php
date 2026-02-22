<script>
  // Variables globales
  window.currentWeek = 0;
  window.bookingType = 'onetime';
  window.selectedSlots = [];
  window.maxCourses = 5;
  window.courseDuration = 50; // Durée par défaut en minutes
  
  // Fonction pour mettre à jour l'affichage de la semaine
  window.updateWeekDisplay = function() {
    const today = new Date();
    const startOfWeek = new Date(today);
    const dayOfWeek = today.getDay();
    const daysToMonday = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
    startOfWeek.setDate(today.getDate() - daysToMonday + (window.currentWeek * 7));
    startOfWeek.setHours(0, 0, 0, 0);
    const endOfWeek = new Date(startOfWeek);
    endOfWeek.setDate(startOfWeek.getDate() + 6);

    const monthNames = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 
                        'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    
    const startDay = startOfWeek.getDate();
    const startMonth = monthNames[startOfWeek.getMonth()];
    const endDay = endOfWeek.getDate();
    const endMonth = monthNames[endOfWeek.getMonth()];
    const year = endOfWeek.getFullYear();
    
    const weekDisplay = document.getElementById('agenda-week-display');
    if (weekDisplay) {
      if (startMonth === endMonth) {
        weekDisplay.textContent = `${startDay} – ${endDay} ${startMonth} ${year}`;
      } else {
        weekDisplay.textContent = `${startDay} ${startMonth} – ${endDay} ${endMonth} ${year}`;
      }
    }
    
    // Mettre à jour les dates dans les en-têtes
    for (let i = 0; i < 7; i++) {
      const date = new Date(startOfWeek);
      date.setDate(date.getDate() + i);
      const dateElement = document.getElementById('agenda-day-' + i);
      if (dateElement) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        dateElement.textContent = `${['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'][i]}. ${day}`;
      }
    }
    
    // Mettre à jour les créneaux réservés
    updateBookedSlotsForWeek(startOfWeek);
  };
  
  // Fonction pour mettre à jour l'affichage des créneaux réservés
  function updateBookedSlotsForWeek(startOfWeek) {
    if (!window.bookedSlotsByDate) return;
    
    const slotButtons = document.querySelectorAll('.agenda-slot-simple');
    slotButtons.forEach(button => {
      const day = parseInt(button.dataset.day);
      const hour = parseInt(button.dataset.hour);
      const minute = parseInt(button.dataset.minute) || 0;
      
      if (isNaN(day) || isNaN(hour)) return;
      
      const date = new Date(startOfWeek);
      date.setDate(startOfWeek.getDate() + day);
      const dateKey = date.getFullYear() + '-' + 
                     String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                     String(date.getDate()).padStart(2, '0');
      
      const isBooked = window.bookedSlotsByDate[dateKey] && 
                      window.bookedSlotsByDate[dateKey][hour] && 
                      window.bookedSlotsByDate[dateKey][hour][minute];
      
      if (isBooked) {
        button.disabled = true;
        button.style.background = '#F3F4F6';
        button.style.borderColor = '#E5E7EB';
        button.style.color = '#9CA3AF';
        button.style.cursor = 'not-allowed';
        button.classList.add('booked');
        button.title = '<?php echo e(__("Créneau déjà réservé")); ?>';
      } else {
        button.disabled = false;
        if (!button.classList.contains('selected')) {
          const currentBg = window.getComputedStyle(button).backgroundColor;
          // Vérifier si c'est un créneau configuré (vert) ou non configuré (bleu)
          const isConfigured = currentBg === 'rgb(255, 255, 255)' || 
                              button.style.background === 'white' || 
                              button.style.background === '#FFFFFF' ||
                              button.style.borderColor === 'rgb(16, 185, 129)' ||
                              button.style.borderColor === '#10B981';
          if (isConfigured) {
            // Créneau configuré - vert brillant
            button.style.background = '#FFFFFF';
            button.style.borderColor = '#10B981';
            button.style.color = '#065F46';
            button.style.opacity = '1';
            button.style.boxShadow = '0 1px 3px rgba(16, 185, 129, 0.2)';
            button.style.fontWeight = '600';
          } else {
            // Créneau non configuré - bleu brillant
            button.style.background = '#F0F9FF';
            button.style.borderColor = '#3B82F6';
            button.style.color = '#1E40AF';
            button.style.opacity = '0.85';
            button.style.boxShadow = '0 1px 3px rgba(59, 130, 246, 0.15)';
            button.style.fontWeight = '600';
          }
          button.style.cursor = 'pointer';
        }
        button.classList.remove('booked');
        button.title = '';
      }
    });
  }
  
  // Fonction pour définir le type de réservation
  window.setBookingType = function(type) {
    try {
      const weeklyBtn = document.getElementById('booking-type-weekly');
      const onetimeBtn = document.getElementById('booking-type-onetime');
      
      if (!weeklyBtn || !onetimeBtn) return;
      
      if (type === 'weekly') {
        weeklyBtn.style.borderColor = '#EC4899';
        weeklyBtn.style.background = '#FDF2F8';
        onetimeBtn.style.borderColor = '#E5E7EB';
        onetimeBtn.style.background = 'white';
        window.bookingType = 'weekly';
      } else {
        onetimeBtn.style.borderColor = '#EC4899';
        onetimeBtn.style.background = '#FDF2F8';
        weeklyBtn.style.borderColor = '#E5E7EB';
        weeklyBtn.style.background = 'white';
        window.bookingType = 'onetime';
      }
    } catch (error) {
      console.error('Erreur dans setBookingType:', error);
    }
  };
  
  // Fonction pour revenir à aujourd'hui
  window.goToToday = function() {
    window.currentWeek = 0;
    if (typeof window.updateWeekDisplay === 'function') {
      window.updateWeekDisplay();
    }
  };
  
  // Fonction pour ajouter un créneau sélectionné
  window.addSelectedSlot = function(day, hour, minute) {
    minute = minute || 0;
    
    if (window.selectedSlots.length >= window.maxCourses) {
      alert('<?php echo e(__("Vous ne pouvez programmer que :max Rituels maximum", ["max" => 5])); ?>');
      return;
    }
    
    const slotKey = `${day}-${hour}-${minute}`;
    if (window.selectedSlots.find(s => s.key === slotKey)) {
      return;
    }
    
    const slot = {
      key: slotKey,
      day: day,
      hour: hour,
      minute: minute,
      courseNumber: window.selectedSlots.length + 1
    };
    
    window.selectedSlots.push(slot);
    updateCoursesList();
    updateScheduleButton();
  };
  
  // Fonction pour retirer un créneau
  window.removeSelectedSlot = function(slotKey) {
    window.selectedSlots = window.selectedSlots.filter(s => s.key !== slotKey);
    window.selectedSlots.forEach((slot, index) => {
      slot.courseNumber = index + 1;
    });
    updateCoursesList();
    updateScheduleButton();
    const btn = document.querySelector(`[data-slot-key="${slotKey}"]`);
    if (btn) {
      btn.classList.remove('selected');
      // Restaurer le style original selon le type (utiliser les attributs data)
      const isConfigured = btn.getAttribute('data-is-configured') === 'true';
      if (isConfigured) {
        btn.style.background = '#FFFFFF';
        btn.style.borderColor = '#10B981';
        btn.style.color = '#065F46';
        btn.style.opacity = '1';
        btn.style.boxShadow = '0 1px 3px rgba(16, 185, 129, 0.2)';
        btn.style.fontWeight = '600';
      } else {
        btn.style.background = '#F0F9FF';
        btn.style.borderColor = '#3B82F6';
        btn.style.color = '#1E40AF';
        btn.style.opacity = '0.85';
        btn.style.boxShadow = '0 1px 3px rgba(59, 130, 246, 0.15)';
        btn.style.fontWeight = '600';
      }
      btn.style.transform = 'translateY(0)';
    }
  };
  
  // Fonction pour mettre à jour la liste des Rituels
  function updateCoursesList() {
    const coursesCount = document.getElementById('courses-count');
    const emptyState = document.getElementById('courses-empty-state');
    const rituelsText = document.getElementById('rituels-text');
    
    if (!coursesCount) return;
    
    for (let i = 1; i <= 5; i++) {
      const container = document.getElementById('course-' + i + '-container');
      if (container) container.style.display = 'none';
    }
    
    if (window.selectedSlots.length === 0) {
      if (emptyState) emptyState.style.display = 'block';
    } else {
      if (emptyState) emptyState.style.display = 'none';
      window.selectedSlots.forEach((slot) => {
        const dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        const hourStr = String(slot.hour).padStart(2, '0') + ':' + String(slot.minute || 0).padStart(2, '0');
        const courseContainer = document.getElementById('course-' + slot.courseNumber + '-container');
        const courseTime = document.getElementById('course-' + slot.courseNumber + '-time');
        if (courseContainer) courseContainer.style.display = 'block';
        if (courseTime) courseTime.textContent = `${dayNames[slot.day]}. ${hourStr}`;
      });
    }
    
    if (coursesCount) coursesCount.textContent = window.selectedSlots.length;
    // Mettre à jour le texte au pluriel si nécessaire
    if (rituelsText) {
      if (window.selectedSlots.length <= 1) {
        rituelsText.textContent = '<?php echo e(__("Rituel à programmer")); ?>';
      } else {
        rituelsText.textContent = '<?php echo e(__("Rituels à programmer")); ?>';
      }
    }
  }
  
  // Fonction pour retirer un Rituel spécifique
  window.removeCourseSlot = function(courseNumber) {
    const slot = window.selectedSlots.find(s => s.courseNumber === courseNumber);
    if (slot) removeSelectedSlot(slot.key);
  };
  
  // Fonction pour mettre à jour le bouton Programmer
  function updateScheduleButton() {
    const scheduleBtn = document.getElementById('schedule-btn');
    if (!scheduleBtn) return;
    
    if (window.selectedSlots.length > 0) {
      scheduleBtn.style.background = '#3B82F6';
      scheduleBtn.style.cursor = 'pointer';
      scheduleBtn.disabled = false;
      scheduleBtn.onmouseover = function() {
        this.style.background = '#2563EB';
        this.style.transform = 'translateY(-1px)';
        this.style.boxShadow = '0 4px 12px rgba(59, 130, 246, 0.3)';
      };
      scheduleBtn.onmouseout = function() {
        this.style.background = '#3B82F6';
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
      };
    } else {
      scheduleBtn.style.background = '#6B7280';
      scheduleBtn.style.cursor = 'not-allowed';
      scheduleBtn.disabled = true;
      scheduleBtn.onmouseover = null;
      scheduleBtn.onmouseout = null;
    }
  }
  
  // Gestion des clics sur les créneaux (avec délégation d'événements pour les éléments dynamiques)
  document.addEventListener('click', function(e) {
    // Vérifier si le clic est sur un bouton de créneau ou à l'intérieur
    const slotButton = e.target.closest('.agenda-slot-simple');
    if (slotButton) {
      e.preventDefault();
      e.stopPropagation();
      
      const day = parseInt(slotButton.dataset.day);
      const hour = parseInt(slotButton.dataset.hour);
      const minute = parseInt(slotButton.dataset.minute) || 0;
      const slotKey = `${day}-${hour}-${minute}`;
      
      console.log('Clic sur créneau:', { day, hour, minute, slotKey });
      
      if (slotButton.classList.contains('booked') || slotButton.disabled) {
        console.log('Créneau réservé ou désactivé');
        return;
      }
      
      // Vérifier si le créneau est déjà sélectionné (vérifier la classe ET le style)
      const isSelectedInArray = window.selectedSlots.find(s => s.key === slotKey);
      const isSelectedByClass = slotButton.classList.contains('selected');
      const isSelectedByStyle = slotButton.style.background === 'rgb(236, 72, 153)' || 
                               slotButton.style.background === '#EC4899' ||
                               window.getComputedStyle(slotButton).backgroundColor === 'rgb(236, 72, 153)';
      
      const isSelected = isSelectedInArray || isSelectedByClass || isSelectedByStyle;
      
      if (isSelected) {
        console.log('Désélection du créneau (clic sur créneau déjà sélectionné)');
        removeSelectedSlot(slotKey);
        slotButton.classList.remove('selected');
        
        // Restaurer le style selon le type (configuré = vert brillant, non configuré = bleu brillant)
        // Vérifier le style original en regardant les attributs data ou le style initial
        const originalBorder = slotButton.getAttribute('data-original-border') || 
                              (slotButton.dataset.day !== undefined ? '#10B981' : '#3B82F6');
        const isConfigured = originalBorder === '#10B981' || 
                             slotButton.getAttribute('data-is-configured') === 'true';
        
        if (isConfigured) {
          slotButton.style.background = '#FFFFFF';
          slotButton.style.borderColor = '#10B981';
          slotButton.style.color = '#065F46';
          slotButton.style.opacity = '1';
          slotButton.style.boxShadow = '0 1px 3px rgba(16, 185, 129, 0.2)';
          slotButton.style.fontWeight = '600';
        } else {
          slotButton.style.background = '#F0F9FF';
          slotButton.style.borderColor = '#3B82F6';
          slotButton.style.color = '#1E40AF';
          slotButton.style.opacity = '0.85';
          slotButton.style.boxShadow = '0 1px 3px rgba(59, 130, 246, 0.15)';
          slotButton.style.fontWeight = '600';
        }
        slotButton.style.transform = 'translateY(0)';
      } else {
        console.log('Sélection du créneau');
        // Sauvegarder le style original avant de le changer
        const currentBorder = window.getComputedStyle(slotButton).borderColor;
        const isConfigured = currentBorder === 'rgb(16, 185, 129)' || 
                             slotButton.style.borderColor === '#10B981';
        slotButton.setAttribute('data-original-border', slotButton.style.borderColor || currentBorder);
        slotButton.setAttribute('data-is-configured', isConfigured ? 'true' : 'false');
        
        addSelectedSlot(day, hour, minute);
        slotButton.classList.add('selected');
        slotButton.style.background = '#EC4899';
        slotButton.style.borderColor = '#EC4899';
        slotButton.style.color = 'white';
        slotButton.style.opacity = '1';
        slotButton.style.boxShadow = '0 4px 12px rgba(236, 72, 153, 0.4)';
        slotButton.style.transform = 'translateY(-1px)';
        slotButton.style.fontWeight = '700';
      }
    }
  });
  
  // Fonction pour gérer le clic sur le bouton Programmer
  window.handleScheduleClick = function() {
    if (window.selectedSlots.length === 0) {
      alert('<?php echo e(__("Veuillez sélectionner au moins un créneau")); ?>');
      return;
    }
    
    const slotsText = window.selectedSlots.map(slot => {
      const dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
      const hourStr = String(slot.hour).padStart(2, '0') + ':' + String(slot.minute || 0).padStart(2, '0');
      return `${dayNames[slot.day]}. ${hourStr}`;
    }).join(', ');
    
    const rituelText = window.selectedSlots.length <= 1 ? '<?php echo e(__("Rituel")); ?>' : '<?php echo e(__("Rituels")); ?>';
    if (!confirm(`<?php echo e(__('Confirmer la programmation de')); ?> ${window.selectedSlots.length} ${rituelText} ?\n\n${slotsText}`)) {
      return;
    }
    
    // Vérifier que des créneaux sont sélectionnés
    if (!window.selectedSlots || !Array.isArray(window.selectedSlots) || window.selectedSlots.length === 0) {
      alert('<?php echo e(__("Veuillez sélectionner au moins un créneau.")); ?>');
      return;
    }
    
    // Désactiver le bouton pendant le traitement
    const scheduleBtn = document.getElementById('schedule-btn');
    if (scheduleBtn) {
      scheduleBtn.disabled = true;
      scheduleBtn.textContent = '<?php echo e(__("Programmation en cours...")); ?>';
      scheduleBtn.style.cursor = 'wait';
    }
    
    // Préparer les données pour l'API
    const slotsData = window.selectedSlots.map(slot => ({
      day: slot.day,
      hour: slot.hour,
      minute: slot.minute || 0
    }));
    
    // Vérifier que les données sont valides
    const invalidSlots = slotsData.filter(slot => 
      slot.day === undefined || slot.hour === undefined || slot.minute === undefined
    );
    if (invalidSlots.length > 0) {
      console.error('Slots invalides:', invalidSlots);
      alert('<?php echo e(__("Certains créneaux sélectionnés sont invalides. Veuillez réessayer.")); ?>');
      if (scheduleBtn) {
        scheduleBtn.disabled = false;
        scheduleBtn.textContent = '<?php echo e(__("Programmer")); ?>';
        scheduleBtn.style.cursor = 'pointer';
      }
      return;
    }
    
    // Récupérer l'ID du freelance depuis l'URL
    const urlParts = window.location.pathname.split('/');
    const freelancerId = urlParts[urlParts.length - 2]; // /freelance/{id}/booking
    
    // Appel API pour programmer les cours
    fetch(`/freelance/${freelancerId}/book-slots`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        slots: slotsData,
        duration: window.courseDuration || 50,
        booking_type: window.bookingType || 'onetime',
        week_offset: window.currentWeek || 0 // Envoyer l'offset de semaine actuel
      })
    })
    .then(async response => {
      // Vérifier si la réponse est OK
      if (!response.ok) {
        // Essayer de parser le JSON même en cas d'erreur
        try {
          const errorData = await response.json();
          throw new Error(errorData.message || `Erreur HTTP ${response.status}`);
        } catch (e) {
          // Si ce n'est pas du JSON, utiliser le message d'erreur HTTP
          throw new Error(`Erreur HTTP ${response.status}: ${response.statusText}`);
        }
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        // Afficher un message de succès
        alert(data.message + (data.errors && data.errors.length > 0 ? '\n\n' + data.errors.join('\n') : ''));
        
        // Rediriger vers le dashboard ou recharger la page
        window.location.href = '<?php echo e(route("user.dashboard")); ?>';
      } else {
        // Afficher l'erreur
        alert(data.message || '<?php echo e(__("Une erreur est survenue")); ?>');
        
        // Réactiver le bouton
        if (scheduleBtn) {
          scheduleBtn.disabled = false;
          scheduleBtn.textContent = '<?php echo e(__("Programmer")); ?>';
          scheduleBtn.style.cursor = 'pointer';
        }
      }
    })
    .catch(error => {
      console.error('Erreur détaillée:', error);
      const errorMessage = error.message || '<?php echo e(__("Une erreur est survenue lors de la réservation. Veuillez réessayer.")); ?>';
      alert(errorMessage);
      
      // Réactiver le bouton
      if (scheduleBtn) {
        scheduleBtn.disabled = false;
        scheduleBtn.textContent = '<?php echo e(__("Programmer")); ?>';
        scheduleBtn.style.cursor = 'pointer';
      }
    });
  };
  
  // Fonction pour toggle le dropdown de durée
  window.toggleDurationDropdown = function() {
    const dropdown = document.getElementById('course-duration-dropdown');
    const chevron = document.getElementById('course-duration-chevron');
    if (dropdown && chevron) {
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
      } else {
        dropdown.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
      }
    }
  };
  
  // Fonction pour sélectionner une durée
  window.selectDuration = function(minutes) {
    window.courseDuration = minutes;
    const text = document.getElementById('course-duration-text');
    const dropdown = document.getElementById('course-duration-dropdown');
    const chevron = document.getElementById('course-duration-chevron');
    if (text) {
      text.textContent = `<?php echo e(__('Rituel de')); ?> ${minutes} <?php echo e(__('minutes')); ?>`;
    }
    if (dropdown) dropdown.style.display = 'none';
    if (chevron) chevron.style.transform = 'rotate(0deg)';
  };
  
  // Fermer le dropdown si on clique en dehors
  document.addEventListener('click', function(e) {
    const selector = document.getElementById('course-duration-selector');
    const dropdown = document.getElementById('course-duration-dropdown');
    if (selector && dropdown && dropdown.style.display === 'block') {
      if (!selector.contains(e.target)) {
        dropdown.style.display = 'none';
        const chevron = document.getElementById('course-duration-chevron');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
      }
    }
  });
  
  // Initialisation
  document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Scripts de réservation chargés');
    console.log('✅ bookedSlotsByDate:', window.bookedSlotsByDate);
    console.log('✅ Nombre de boutons trouvés:', document.querySelectorAll('.agenda-slot-simple').length);
    
    window.updateWeekDisplay();
    updateCoursesList();
    updateScheduleButton();
    
    // Vérifier que les boutons sont bien présents et cliquables
    const slotButtons = document.querySelectorAll('.agenda-slot-simple');
    slotButtons.forEach((btn, index) => {
      if (index < 3) { // Log seulement les 3 premiers pour debug
        console.log(`Bouton ${index}:`, {
          day: btn.dataset.day,
          hour: btn.dataset.hour,
          minute: btn.dataset.minute,
          disabled: btn.disabled,
          classList: Array.from(btn.classList)
        });
      }
    });
  });
  
  // S'assurer que les fonctions sont disponibles immédiatement
  console.log('✅ Fonctions globales définies:', {
    updateWeekDisplay: typeof window.updateWeekDisplay,
    addSelectedSlot: typeof window.addSelectedSlot,
    handleScheduleClick: typeof window.handleScheduleClick
  });
</script>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\partials\booking-scripts.blade.php ENDPATH**/ ?>