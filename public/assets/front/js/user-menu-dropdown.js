/**
 * Gestion du menu utilisateur dropdown premium
 * Utilise Bootstrap Dropdown API - version simplifiée
 */
(function() {
  'use strict';

  // Attendre que le DOM soit chargé
  document.addEventListener('DOMContentLoaded', function() {
    // Vérifier que Bootstrap est disponible
    if (typeof bootstrap === 'undefined') {
      console.warn('Bootstrap n\'est pas chargé');
      return;
    }

    // Sélectionner tous les boutons de menu utilisateur
    const userMenuButtons = document.querySelectorAll('.user-menu-btn[data-bs-toggle="dropdown"]');
    
    userMenuButtons.forEach(function(button) {
      const dropdownElement = button.nextElementSibling;
      
      if (!dropdownElement || !dropdownElement.classList.contains('user-menu-premium')) {
        return;
      }

      // Initialiser le dropdown Bootstrap
      const dropdown = new bootstrap.Dropdown(button);

      // Fermer les autres menus quand celui-ci s'ouvre
      button.addEventListener('show.bs.dropdown', function() {
        document.querySelectorAll('.user-menu-btn[data-bs-toggle="dropdown"]').forEach(function(otherButton) {
          if (otherButton !== button) {
            const otherDropdown = bootstrap.Dropdown.getInstance(otherButton);
            if (otherDropdown) {
              otherDropdown.hide();
            }
          }
        });
      });

      // Fermer au clic sur un item
      dropdownElement.querySelectorAll('.dropdown-item').forEach(function(item) {
        item.addEventListener('click', function() {
          dropdown.hide();
        });
      });
    });
  });
})();
