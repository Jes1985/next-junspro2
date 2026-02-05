/**
 * Gestion du modal de renouvellement d'abonnement
 */

let currentSubscriptionId = null;

/**
 * Ouvrir le modal et charger les données
 */
function openRenewModal(subscriptionId) {
  currentSubscriptionId = subscriptionId;
  const overlay = document.getElementById('jsp-renew-modal-overlay');
  const modal = overlay.querySelector('.jsp-renew-modal-container');
  
  // Afficher le modal
  overlay.setAttribute('aria-hidden', 'false');
  overlay.style.display = 'flex';
  document.body.style.overflow = 'hidden';
  
  // Fermer le dropdown de paiement s'il est ouvert
  const trigger = document.getElementById('jsp-renew-modal-payment-dropdown-trigger');
  const menu = document.getElementById('jsp-renew-modal-payment-dropdown-menu');
  if (trigger && menu) {
    trigger.setAttribute('aria-expanded', 'false');
    menu.classList.remove('show');
  }
  
  // Charger les données
  loadRenewQuote(subscriptionId);
  
  // Focus sur le bouton de fermeture pour l'accessibilité
  overlay.querySelector('.jsp-renew-modal-close').focus();
}

/**
 * Fermer le modal
 */
function closeRenewModal() {
  const overlay = document.getElementById('jsp-renew-modal-overlay');
  overlay.setAttribute('aria-hidden', 'true');
  overlay.style.display = 'none';
  document.body.style.overflow = '';
  currentSubscriptionId = null;
}

/**
 * Charger le devis de renouvellement
 */
async function loadRenewQuote(subscriptionId) {
  try {
    const response = await fetch(`/user/subscriptions/${subscriptionId}/renew-quote`, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      credentials: 'same-origin',
    });

    if (!response.ok) {
      throw new Error('Erreur lors du chargement du devis');
    }

    const data = await response.json();
    populateModal(data);
  } catch (error) {
    console.error('Erreur:', error);
    showError('Erreur lors du chargement des informations. Veuillez réessayer.');
  }
}

/**
 * Remplir le modal avec les données
 */
function populateModal(data) {
  // Avatar
  const avatarImg = document.getElementById('jsp-renew-modal-avatar');
  const avatarInitials = document.getElementById('jsp-renew-modal-avatar-initials');
  
  if (data.freelance_avatar_url) {
    avatarImg.src = data.freelance_avatar_url;
    avatarImg.style.display = 'block';
    avatarImg.alt = data.freelance_name;
    avatarInitials.style.display = 'none';
  } else {
    avatarImg.style.display = 'none';
    avatarInitials.textContent = data.freelance_initial || 'F';
    avatarInitials.style.display = 'flex';
  }

  // Titre (déjà défini dans le HTML)
  
  // Récap
  document.getElementById('jsp-renew-modal-hours').textContent = data.hours_per_period;
  document.getElementById('jsp-renew-modal-price').textContent = data.subtotal;
  document.getElementById('jsp-renew-modal-period').textContent = data.period_label;

  // Détails de prix
  document.getElementById('jsp-renew-modal-pricing-detail').textContent = 
    `${data.hours_per_period} h × ${data.price_per_hour} €/h`;
  document.getElementById('jsp-renew-modal-subtotal').textContent = `${data.subtotal} €`;
  document.getElementById('jsp-renew-modal-tax').textContent = `${data.tax_amount} €`;
  document.getElementById('jsp-renew-modal-total').textContent = `${data.total} €`;

  // Texte de renouvellement
  document.getElementById('jsp-renew-modal-renewal-text').textContent = data.renewal_text;

  // Mode de paiement - Mettre à jour l'overlay via la fonction dédiée
  if (typeof updatePaymentOverlayTrigger === 'function') {
    updatePaymentOverlayTrigger(data);
  }
}

/**
 * Obtenir le nom de la marque de carte
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
 * Obtenir l'icône de la marque de carte
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

/**
 * Obtenir l'URL de la page des modes de paiement
 */
function getPaymentMethodsUrl() {
  // Essayer de trouver le lien dans la page, sinon utiliser une route par défaut
  const paymentLink = document.querySelector('a[href*="payment-methods"]');
  if (paymentLink) {
    return paymentLink.getAttribute('href');
  }
  return '/user/settings/payment-methods';
}

/**
 * Confirmer le renouvellement
 */
async function confirmRenewal() {
  if (!currentSubscriptionId) {
    return;
  }

  const confirmBtn = document.getElementById('jsp-renew-modal-confirm-btn');
  
  // Désactiver le bouton et afficher le loading
  confirmBtn.disabled = true;
  confirmBtn.querySelector('.jsp-renew-modal-btn-text').style.display = 'none';
  confirmBtn.querySelector('.jsp-renew-modal-btn-loading').style.display = 'inline';

  try {
    const response = await fetch(`/user/subscriptions/${currentSubscriptionId}/renew`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      credentials: 'same-origin',
      body: JSON.stringify({}),
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.error || 'Erreur lors du renouvellement');
    }

    // Succès
    showSuccess(data.message || 'Renouvellement confirmé avec succès');
    
    // Fermer le modal après un court délai
    setTimeout(() => {
      closeRenewModal();
      // Recharger la page pour mettre à jour les données
      window.location.reload();
    }, 1500);

  } catch (error) {
    console.error('Erreur:', error);
    showError(error.message || 'Erreur lors du renouvellement. Veuillez réessayer.');
    
    // Réactiver le bouton
    confirmBtn.disabled = false;
    confirmBtn.querySelector('.jsp-renew-modal-btn-text').style.display = 'inline';
    confirmBtn.querySelector('.jsp-renew-modal-btn-loading').style.display = 'none';
  }
}

/**
 * Obtenir le token CSRF
 */
function getCsrfToken() {
  const token = document.querySelector('meta[name="csrf-token"]');
  return token ? token.getAttribute('content') : '';
}

/**
 * Afficher un message d'erreur
 */
function showError(message) {
  // Utiliser toastr si disponible, sinon alert
  if (typeof toastr !== 'undefined') {
    toastr.error(message);
  } else {
    alert(message);
  }
}

/**
 * Afficher un message de succès
 */
function showSuccess(message) {
  // Utiliser toastr si disponible, sinon alert
  if (typeof toastr !== 'undefined') {
    toastr.success(message);
  } else {
    alert(message);
  }
}

/**
 * Toggle le dropdown de mode de paiement
 */
function togglePaymentDropdown() {
  const trigger = document.getElementById('jsp-renew-modal-payment-dropdown-trigger');
  const menu = document.getElementById('jsp-renew-modal-payment-dropdown-menu');
  
  if (!trigger || !menu) return;
  
  const isOpen = trigger.getAttribute('aria-expanded') === 'true';
  
  if (isOpen) {
    trigger.setAttribute('aria-expanded', 'false');
    menu.classList.remove('show');
  } else {
    trigger.setAttribute('aria-expanded', 'true');
    menu.classList.add('show');
  }
}

/**
 * Sélectionner un mode de paiement
 */
function selectPaymentMethod(paymentType) {
  const trigger = document.getElementById('jsp-renew-modal-payment-dropdown-trigger');
  const menu = document.getElementById('jsp-renew-modal-payment-dropdown-menu');
  const selected = document.getElementById('jsp-renew-modal-payment-dropdown-selected');
  const items = document.querySelectorAll('.jsp-renew-modal-payment-dropdown-item');
  
  if (!trigger || !menu || !selected) return;
  
  // Retirer l'état actif de tous les items
  items.forEach(item => {
    item.classList.remove('jsp-renew-modal-payment-dropdown-item-active');
  });
  
  // Trouver l'item sélectionné et le marquer comme actif
  const selectedItem = document.querySelector(`[data-payment-type="${paymentType}"]`);
  if (selectedItem) {
    selectedItem.classList.add('jsp-renew-modal-payment-dropdown-item-active');
    
    // Mettre à jour l'affichage sélectionné avec le contenu de l'item
    const icon = selectedItem.querySelector('i').cloneNode(true);
    const text = selectedItem.querySelector('span').textContent;
    
    selected.innerHTML = '';
    selected.appendChild(icon);
    const span = document.createElement('span');
    span.textContent = text;
    selected.appendChild(span);
  }
  
  // Fermer le dropdown
  trigger.setAttribute('aria-expanded', 'false');
  menu.classList.remove('show');
  
  // TODO: Implémenter la logique de changement de mode de paiement si nécessaire
  // Pour l'instant, c'est juste un changement visuel
}

/**
 * Initialisation au chargement de la page
 */
document.addEventListener('DOMContentLoaded', function() {
  // Écouter les clics sur les boutons avec data-renew-subscription
  document.addEventListener('click', function(e) {
    const trigger = e.target.closest('[data-renew-subscription]');
    if (trigger) {
      e.preventDefault();
      const subscriptionId = trigger.getAttribute('data-renew-subscription');
      openRenewModal(subscriptionId);
    }
  });

  // Fermer le modal au clic sur l'overlay
  const overlay = document.getElementById('jsp-renew-modal-overlay');
  if (overlay) {
    overlay.addEventListener('click', function(e) {
      if (e.target === overlay) {
        closeRenewModal();
      }
    });
  }

  // Fermer le modal avec ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const overlay = document.getElementById('jsp-renew-modal-overlay');
      if (overlay && overlay.getAttribute('aria-hidden') === 'false') {
        closeRenewModal();
      }
    }
  });

  // Empêcher la fermeture du modal au clic dans le contenu
  const modalContainer = document.querySelector('.jsp-renew-modal-container');
  if (modalContainer) {
    modalContainer.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }

  // Fermer le dropdown de paiement au clic en dehors
  document.addEventListener('click', function(e) {
    const dropdownWrapper = document.querySelector('.jsp-renew-modal-payment-dropdown-wrapper');
    const trigger = document.getElementById('jsp-renew-modal-payment-dropdown-trigger');
    const menu = document.getElementById('jsp-renew-modal-payment-dropdown-menu');
    
    if (dropdownWrapper && trigger && menu) {
      if (!dropdownWrapper.contains(e.target)) {
        trigger.setAttribute('aria-expanded', 'false');
        menu.classList.remove('show');
      }
    }
  });
});

