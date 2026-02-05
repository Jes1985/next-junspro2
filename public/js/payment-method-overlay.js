/**
 * Gestion de l'overlay Mode de paiement
 * L'overlay est rendu dans body pour éviter les problèmes de overflow
 */

let paymentOverlayInstance = null;
let paymentOverlayMenu = null;
let paymentOverlayTrigger = null;

/**
 * Initialisation au chargement du DOM
 */
document.addEventListener('DOMContentLoaded', function() {
  paymentOverlayTrigger = document.getElementById('jsp-payment-overlay-trigger');
  paymentOverlayMenu = document.getElementById('jsp-payment-overlay-menu');
  
  if (!paymentOverlayTrigger || !paymentOverlayMenu) {
    return;
  }
  
  // Cloner le menu pour le rendre dans body
  paymentOverlayInstance = paymentOverlayMenu.cloneNode(true);
  paymentOverlayInstance.id = 'jsp-payment-overlay-menu-instance';
  paymentOverlayInstance.style.display = 'none';
  document.body.appendChild(paymentOverlayInstance);
  
  // Écouter le clic sur le trigger
  paymentOverlayTrigger.addEventListener('click', function(e) {
    e.stopPropagation();
    togglePaymentOverlay();
  });
  
  // Écouter les clics sur les items
  paymentOverlayInstance.addEventListener('click', function(e) {
    const item = e.target.closest('.jsp-payment-overlay-item');
    if (item) {
      e.stopPropagation();
      const paymentType = item.getAttribute('data-payment-type');
      selectPaymentMethod(paymentType);
      closePaymentOverlay();
    }
  });
  
  // Fermer au clic en dehors
  document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('jsp-payment-overlay-trigger-wrapper');
    if (wrapper && !wrapper.contains(e.target) && paymentOverlayInstance && !paymentOverlayInstance.contains(e.target)) {
      closePaymentOverlay();
    }
  });
  
  // Fermer avec ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && paymentOverlayInstance && paymentOverlayInstance.style.display !== 'none') {
      closePaymentOverlay();
    }
  });
});

/**
 * Ouvrir/fermer l'overlay
 */
function togglePaymentOverlay() {
  if (!paymentOverlayTrigger || !paymentOverlayInstance) return;
  
  const isOpen = paymentOverlayTrigger.getAttribute('aria-expanded') === 'true';
  
  if (isOpen) {
    closePaymentOverlay();
  } else {
    openPaymentOverlay();
  }
}

/**
 * Ouvrir l'overlay
 */
function openPaymentOverlay() {
  if (!paymentOverlayTrigger || !paymentOverlayInstance) return;
  
  // Calculer la position du trigger
  const rect = paymentOverlayTrigger.getBoundingClientRect();
  const overlayHeight = paymentOverlayInstance.offsetHeight || 220; // Hauteur estimée ou max-height
  
  // Positionner l'overlay au-dessus du trigger
  let top = rect.top - overlayHeight - 8;
  const minTop = 12;
  
  // Si l'overlay dépasse en haut, le positionner en dessous
  if (top < minTop) {
    top = rect.bottom + 8;
  }
  
  // Appliquer les styles
  paymentOverlayInstance.style.position = 'fixed';
  paymentOverlayInstance.style.left = rect.left + 'px';
  paymentOverlayInstance.style.top = top + 'px';
  paymentOverlayInstance.style.width = rect.width + 'px';
  paymentOverlayInstance.style.display = 'block';
  paymentOverlayInstance.style.zIndex = '999999';
  
  // Mettre à jour l'état du trigger
  paymentOverlayTrigger.setAttribute('aria-expanded', 'true');
}

/**
 * Fermer l'overlay
 */
function closePaymentOverlay() {
  if (!paymentOverlayTrigger || !paymentOverlayInstance) return;
  
  paymentOverlayInstance.style.display = 'none';
  paymentOverlayTrigger.setAttribute('aria-expanded', 'false');
}

/**
 * Sélectionner un mode de paiement
 */
function selectPaymentMethod(paymentType) {
  if (!paymentOverlayTrigger || !paymentOverlayInstance) return;
  
  const triggerContent = document.getElementById('jsp-payment-overlay-trigger-content');
  const items = paymentOverlayInstance.querySelectorAll('.jsp-payment-overlay-item');
  
  // Retirer l'état actif de tous les items
  items.forEach(item => {
    item.classList.remove('jsp-payment-overlay-item-active');
  });
  
  // Trouver l'item sélectionné
  const selectedItem = paymentOverlayInstance.querySelector(`[data-payment-type="${paymentType}"]`);
  if (selectedItem) {
    selectedItem.classList.add('jsp-payment-overlay-item-active');
    
    // Mettre à jour le trigger avec le contenu de l'item sélectionné
    if (triggerContent) {
      const icon = selectedItem.querySelector('i').cloneNode(true);
      const text = selectedItem.querySelector('span').textContent;
      
      triggerContent.innerHTML = '';
      triggerContent.appendChild(icon);
      const span = document.createElement('span');
      span.textContent = text;
      triggerContent.appendChild(span);
    }
  }
  
  // TODO: Implémenter la logique de changement de mode de paiement si nécessaire
}

/**
 * Mettre à jour l'affichage du trigger avec les données du backend
 * Cette fonction est appelée depuis subscription-renew-modal.js
 */
function updatePaymentOverlayTrigger(data) {
  const triggerContent = document.getElementById('jsp-payment-overlay-trigger-content');
  const currentLabel = document.getElementById('jsp-payment-overlay-current-label');
  
  if (!triggerContent) return;
  
  if (data && data.payment_method && data.payment_method.brand && data.payment_method.last4) {
    const brandName = getCardBrandName(data.payment_method.brand);
    const cardIcon = getCardBrandIcon(data.payment_method.brand);
    
    // Mettre à jour le trigger
    triggerContent.innerHTML = `
      <i class="${cardIcon}"></i>
      <span>${brandName} •••• ${data.payment_method.last4}</span>
    `;
    
    // Mettre à jour l'option "Carte actuelle" dans l'overlay
    if (currentLabel) {
      currentLabel.textContent = `Carte actuelle (${brandName} •••• ${data.payment_method.last4})`;
    }
    
    // Mettre à jour l'instance dans body aussi
    if (paymentOverlayInstance) {
      const instanceCurrentLabel = paymentOverlayInstance.querySelector('#jsp-payment-overlay-current-label');
      if (instanceCurrentLabel) {
        instanceCurrentLabel.textContent = `Carte actuelle (${brandName} •••• ${data.payment_method.last4})`;
      }
      
      // Marquer l'option "current" comme active
      const currentItem = paymentOverlayInstance.querySelector('[data-payment-type="current"]');
      if (currentItem) {
        currentItem.classList.add('jsp-payment-overlay-item-active');
      }
    }
  } else {
    triggerContent.innerHTML = `
      <i class="fas fa-credit-card"></i>
      <span>Ajouter un mode de paiement</span>
    `;
    
    if (currentLabel) {
      currentLabel.textContent = 'Aucun mode de paiement enregistré';
    }
  }
}

/**
 * Obtenir le nom de la marque de carte (utilisé depuis subscription-renew-modal.js)
 */
function getCardBrandName(brand) {
  const brands = {
    'visa': 'Visa',
    'mastercard': 'Mastercard',
    'amex': 'American Express',
    'american express': 'American Express',
    'discover': 'Discover',
    'jcb': 'JCB',
    'diners': 'Diners Club',
    'diners club': 'Diners Club',
    'unionpay': 'UnionPay',
    'cartes bancaires': 'Cartes Bancaires',
    'card': 'Carte',
  };
  return brands[brand.toLowerCase()] || brand.charAt(0).toUpperCase() + brand.slice(1).toLowerCase();
}

/**
 * Obtenir l'icône de la marque de carte (utilisé depuis subscription-renew-modal.js)
 */
function getCardBrandIcon(brand) {
  const icons = {
    'visa': 'fab fa-cc-visa',
    'mastercard': 'fab fa-cc-mastercard',
    'amex': 'fab fa-cc-amex',
    'american express': 'fab fa-cc-amex',
    'discover': 'fab fa-cc-discover',
    'jcb': 'fab fa-cc-jcb',
    'diners': 'fab fa-cc-diners-club',
    'diners club': 'fab fa-cc-diners-club',
    'unionpay': 'fab fa-cc-stripe',
    'cartes bancaires': 'fas fa-credit-card',
    'card': 'fas fa-credit-card',
  };
  return icons[brand.toLowerCase()] || 'fas fa-credit-card';
}





















