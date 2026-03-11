/**
 * Junspro Chatbot Premium
 * Widget Assistant Junspro - Version Premium Refonte
 * Version: 3.0 - Premium Refonte Complète
 */

(function() {
  'use strict';
  
  console.log('[Junspro Chatbot] Version 3.0 Premium chargée');

  // Nettoyer les anciennes instances et forcer le chargement du CSS v6
  cleanupLegacy();
  ensureLatestCss();

  // État du chatbot
  let isOpen = false;
  let focusableElements = [];
  let firstFocusableElement = null;
  let lastFocusableElement = null;

  // Initialisation
  function init() {
    createChatbotHTML();
    attachEventListeners();
  }

  // Supprimer d'éventuels anciens widgets/footers
  function cleanupLegacy() {
    const legacySelectors = [
      '#junsproChat',
      '#junsproChatBubble',
      '.junspro-chat-footer',
      '.junspro-chat',
      '.junspro-chat-bubble',
      '.junspro-chat-wrapper',
      '#junsproChatForm',
      '.junspro-chat-main'
    ];
    legacySelectors.forEach(sel => {
      document.querySelectorAll(sel).forEach(el => el.remove());
    });
  }

  // Forcer le chargement du dernier CSS (cache-bust)
  function ensureLatestCss() {
    const existing = document.querySelector('link[data-junspro-chatbot-css]');
    if (existing) existing.remove();
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/assets/front/css/junspro-chatbot-premium.css?v=6.0&ts=' + Date.now();
    link.setAttribute('data-junspro-chatbot-css', 'true');
    document.head.appendChild(link);
  }

  // Créer le HTML du chatbot
  function createChatbotHTML() {
    const chatbotHTML = `
      <!-- Bulle flottante -->
      <div class="junspro-chat-bubble" id="junsproChatBubble" aria-label="Ouvrir l'assistant Junspro" role="button" tabindex="0">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z" fill="#111827"/>
        </svg>
      </div>

      <!-- Panneau de chat -->
      <div class="junspro-chat hidden" id="junsproChat" role="dialog" aria-modal="true" aria-labelledby="junsproChatTitle">
        <!-- Header -->
        <div class="junspro-chat-header">
          <div class="junspro-chat-header-left">
            <div class="junspro-chat-logo">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z" fill="currentColor"/>
              </svg>
            </div>
            <div class="junspro-chat-title-wrapper">
              <h3 class="junspro-chat-title" id="junsproChatTitle">Assistant Junspro</h3>
              <p class="junspro-chat-subtitle">Disponible pour vous aider 7j/7</p>
            </div>
          </div>
          <button class="junspro-chat-close" id="junsproChatClose" aria-label="Fermer l'assistant">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
            </svg>
          </button>
        </div>

        <!-- Zone de messages -->
        <div class="junspro-chat-main" id="junsproChatMain">
          <!-- Contenu sera injecté ici -->
        </div>
      </div>
    `;

    // Ajouter au body
    document.body.insertAdjacentHTML('beforeend', chatbotHTML);
    
    // Afficher la vue d'accueil
    showHomeView();
  }

  // Afficher la vue d'accueil
  function showHomeView() {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    const homeHTML = `
      <div class="junspro-chat-welcome">
        <div class="junspro-chat-welcome-message">
          <p class="junspro-chat-welcome-line">Bonjour 👋</p>
          <p class="junspro-chat-welcome-line">Je suis l'assistant Junspro.</p>
          <p class="junspro-chat-welcome-line">Que puis-je faire pour vous aujourd'hui&nbsp;?</p>
        </div>
      </div>
      <div class="junspro-chat-actions">
        <button class="junspro-chat-action-btn" data-action="search-freelancer" type="button">
          <svg class="junspro-chat-action-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
          </svg>
          <span>Je cherche un freelance</span>
        </button>
        <button class="junspro-chat-action-btn" data-action="i-am-freelancer" type="button">
          <svg class="junspro-chat-action-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
          </svg>
          <span>Je suis freelance</span>
        </button>
        <button class="junspro-chat-action-btn" data-action="have-question" type="button">
          <svg class="junspro-chat-action-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" fill="currentColor"/>
          </svg>
          <span>J'ai une question sur Junspro</span>
        </button>
        <button class="junspro-chat-action-btn" data-action="contact-team" type="button">
          <svg class="junspro-chat-action-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor"/>
          </svg>
          <span>Contacter l'équipe Junspro</span>
        </button>
        <button class="junspro-chat-action-btn" data-action="chat-ia" type="button" style="background:linear-gradient(135deg,rgba(124,58,237,.12),rgba(201,168,76,.08));border-color:rgba(124,58,237,.3)">
          <svg class="junspro-chat-action-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15h-2v-6h2zm0-8h-2V7h2z" fill="currentColor"/>
          </svg>
          <span>Poser une question à Juns IA ✨</span>
        </button>
      </div>
      <p class="junspro-chat-hint">Choisissez une option pour commencer.</p>
    `;

    main.innerHTML = homeHTML;
    updateFocusableElements();
  }

  // ── Chat IA conversationnel ─────────────────────────────────────
  let aiMessages = []; // historique de la conversation

  function showAIChat() {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    aiMessages = [];

    const html = `
      <div class="junspro-ai-chat" id="junsproAIChat">
        <div class="junspro-ai-messages" id="junsproAIMessages">
          <div class="junspro-ai-msg junspro-ai-msg--bot">
            <span>Bonjour ! Je suis <strong>Juns</strong>, l'assistant IA de Junspro ✨<br>Posez-moi n'importe quelle question sur la plateforme, la formation Pause Souffle, les Rituels ou les commissions.</span>
          </div>
        </div>
        <div class="junspro-ai-input-row">
          <input type="text" id="junsproAIInput" placeholder="Votre question..." maxlength="500" autocomplete="off" />
          <button type="button" id="junsproAISend" aria-label="Envoyer">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
        </div>
        <button class="junspro-ai-back" type="button" id="junsproAIBack">← Retour</button>
      </div>
    `;

    main.innerHTML = html;
    updateFocusableElements();

    const input  = document.getElementById('junsproAIInput');
    const sendBtn = document.getElementById('junsproAISend');
    const backBtn = document.getElementById('junsproAIBack');

    if (input) input.focus();

    if (sendBtn) sendBtn.addEventListener('click', sendAIMessage);
    if (input)   input.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendAIMessage(); }
    });
    if (backBtn) backBtn.addEventListener('click', function() {
      aiMessages = [];
      showHomeView();
    });
  }

  function sendAIMessage() {
    const input    = document.getElementById('junsproAIInput');
    const messages = document.getElementById('junsproAIMessages');
    if (!input || !messages) return;

    const text = input.value.trim();
    if (!text) return;

    // Afficher le message utilisateur
    const userDiv = document.createElement('div');
    userDiv.className = 'junspro-ai-msg junspro-ai-msg--user';
    userDiv.innerHTML = `<span>${escapeHtml(text)}</span>`;
    messages.appendChild(userDiv);
    input.value = '';
    messages.scrollTop = messages.scrollHeight;

    // Ajouter à l'historique
    aiMessages.push({ role: 'user', content: text });

    // Indicateur de frappe
    const typingDiv = document.createElement('div');
    typingDiv.className = 'junspro-ai-msg junspro-ai-msg--bot junspro-ai-typing';
    typingDiv.innerHTML = '<span class="junspro-ai-dots"><span></span><span></span><span></span></span>';
    messages.appendChild(typingDiv);
    messages.scrollTop = messages.scrollHeight;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    fetch('/api/ai/chat', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ messages: aiMessages }),
    })
    .then(r => r.json())
    .then(data => {
      typingDiv.remove();
      const reply = data.reply || "Désolé, je n'ai pas pu obtenir de réponse. Réessaie !";
      aiMessages.push({ role: 'assistant', content: reply });
      const botDiv = document.createElement('div');
      botDiv.className = 'junspro-ai-msg junspro-ai-msg--bot';
      botDiv.innerHTML = `<span>${escapeHtml(reply)}</span>`;
      messages.appendChild(botDiv);
      messages.scrollTop = messages.scrollHeight;
    })
    .catch(() => {
      typingDiv.remove();
      const errDiv = document.createElement('div');
      errDiv.className = 'junspro-ai-msg junspro-ai-msg--bot';
      errDiv.innerHTML = '<span>Une erreur est survenue. Vérifie ta connexion et réessaie.</span>';
      messages.appendChild(errDiv);
      messages.scrollTop = messages.scrollHeight;
    });
  }
  // ───────────────────────────────────────────────────────────────

  // Afficher le formulaire de contact
  function showContactForm() {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    const userEmail = window.junsproUserEmail || '';
    const safeEmail = escapeHtml(userEmail);

    const formHTML = `
      <div class="junspro-chat-contact-form" id="junsproContactForm">
        <form id="assistantContactForm" novalidate>
          <div class="junspro-form-group">
            <label for="contactEmail">Adresse e-mail</label>
            <input 
              type="email" 
              id="contactEmail" 
              name="email" 
              class="junspro-form-input" 
              value="${safeEmail}"
              required
              placeholder="vous@exemple.com"
              autocomplete="email"
            />
            <span class="junspro-form-error" id="emailError" role="alert"></span>
          </div>
          <div class="junspro-form-group">
            <label for="contactSubject">Sujet</label>
            <select id="contactSubject" name="subject" class="junspro-form-input" required>
              <option value="">Sélectionnez un sujet</option>
              <option value="Assistance technique">Assistance technique</option>
              <option value="Problème de paiement">Problème de paiement</option>
              <option value="Question sur un freelance">Question sur un freelance</option>
              <option value="Autre demande">Autre demande</option>
            </select>
            <span class="junspro-form-error" id="subjectError" role="alert"></span>
          </div>
          <div class="junspro-form-group">
            <label for="contactMessage">Message</label>
            <textarea 
              id="contactMessage" 
              name="message" 
              class="junspro-form-textarea" 
              rows="5" 
              required
              placeholder="Décrivez votre question ou votre problème…"
              minlength="10"
            ></textarea>
            <span class="junspro-form-error" id="messageError" role="alert"></span>
          </div>
          <button type="submit" class="junspro-form-submit" id="contactSubmitBtn">
            <span class="submit-text">Envoyer mon message</span>
            <span class="submit-loader" style="display: none;" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-opacity="0.25"/>
                <path d="M12 2A10 10 0 0 0 2 12" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
              </svg>
            </span>
          </button>
          <a href="#" class="junspro-form-back" id="contactBackBtn">&larr; Revenir aux options</a>
        </form>
      </div>
    `;

    main.innerHTML = formHTML;
    updateFocusableElements();

    // Attacher les événements du formulaire
    const form = document.getElementById('assistantContactForm');
    const backBtn = document.getElementById('contactBackBtn');

    if (form) {
      form.addEventListener('submit', handleContactSubmit);
    }

    if (backBtn) {
      backBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showHomeView();
      });
    }

    // Focus sur le premier champ
    const firstInput = document.getElementById('contactEmail');
    if (firstInput) {
      setTimeout(() => firstInput.focus(), 100);
    }
  }

  // Gérer l'envoi du formulaire de contact
  function handleContactSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = document.getElementById('contactSubmitBtn');
    const submitText = submitBtn.querySelector('.submit-text');
    const submitLoader = submitBtn.querySelector('.submit-loader');
    const formData = new FormData(form);

    // Réinitialiser les erreurs
    clearFormErrors();

    // Validation côté client
    const email = formData.get('email');
    const subject = formData.get('subject');
    const message = formData.get('message');

    let hasErrors = false;

    if (!email || !isValidEmail(email)) {
      showFieldError('email', 'Veuillez entrer une adresse e-mail valide.');
      hasErrors = true;
    }

    if (!subject) {
      showFieldError('subject', 'Veuillez sélectionner un sujet.');
      hasErrors = true;
    }

    if (!message || message.trim().length < 10) {
      showFieldError('message', 'Le message doit contenir au moins 10 caractères.');
      hasErrors = true;
    }

    if (hasErrors) {
      return;
    }

    // Désactiver le bouton et afficher le loader
    submitBtn.disabled = true;
    submitText.style.display = 'none';
    submitLoader.style.display = 'inline-block';

    // Récupérer le CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Envoyer la requête AJAX
    fetch('/assistant/contact', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: JSON.stringify({
        email: email,
        subject: subject,
        message: message.trim(),
      }),
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showContactSuccess();
      } else {
        if (data.errors) {
          displayFormErrors(data.errors);
        } else {
          showContactError(data.message || 'Une erreur est survenue. Merci de réessayer.');
        }
        submitBtn.disabled = false;
        submitText.style.display = 'inline';
        submitLoader.style.display = 'none';
      }
    })
    .catch(error => {
      console.error('Erreur lors de l\'envoi du formulaire:', error);
      showContactError('Une erreur est survenue. Merci de réessayer plus tard ou d\'envoyer un e-mail à support@junspro.com.');
      submitBtn.disabled = false;
      submitText.style.display = 'inline';
      submitLoader.style.display = 'none';
    });
  }

  // Afficher le message de succès
  function showContactSuccess() {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    const successHTML = `
      <div class="junspro-chat-success">
        <div class="junspro-chat-success-icon">✓</div>
        <h3 class="junspro-chat-success-title">Merci !</h3>
        <p class="junspro-chat-success-message">Votre message a bien été envoyé.<br>Notre équipe vous répondra par e-mail dès que possible.</p>
        <button class="junspro-chat-action-btn junspro-chat-action-btn-primary" id="backToOptionsBtn" type="button">
          Revenir aux options
        </button>
      </div>
    `;

    main.innerHTML = successHTML;
    updateFocusableElements();

    const backBtn = document.getElementById('backToOptionsBtn');
    if (backBtn) {
      backBtn.addEventListener('click', showHomeView);
      backBtn.focus();
    }
  }

  // Afficher une erreur
  function showContactError(message) {
    const form = document.getElementById('junsproContactForm');
    if (!form) return;

    const errorHTML = `
      <div class="junspro-chat-error" role="alert">
        <p>${escapeHtml(message)}</p>
      </div>
    `;

    form.insertAdjacentHTML('afterbegin', errorHTML);
  }

  // Afficher une erreur de champ
  function showFieldError(fieldName, message) {
    const errorElement = document.getElementById(fieldName + 'Error');
    if (errorElement) {
      errorElement.textContent = message;
      errorElement.style.display = 'block';
    }
  }

  // Afficher les erreurs de validation
  function displayFormErrors(errors) {
    Object.keys(errors).forEach(field => {
      const errorElement = document.getElementById(field + 'Error');
      if (errorElement) {
        errorElement.textContent = errors[field][0];
        errorElement.style.display = 'block';
      }
    });
  }

  // Réinitialiser les erreurs
  function clearFormErrors() {
    const errorElements = document.querySelectorAll('.junspro-form-error');
    errorElements.forEach(el => {
      el.textContent = '';
      el.style.display = 'none';
    });
    const errorMessages = document.querySelectorAll('.junspro-chat-error');
    errorMessages.forEach(el => el.remove());
  }

  // Valider l'email
  function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  // Toggle l'état du chatbot
  function toggleChat() {
    if (isOpen) {
      closeChat();
    } else {
      openChat();
    }
  }

  // Ouvrir le chat
  function openChat() {
    const bubble = document.getElementById('junsproChatBubble');
    const chat = document.getElementById('junsproChat');

    if (!bubble || !chat) return;

    bubble.classList.add('hidden');
    chat.classList.remove('hidden');
    chat.classList.remove('closing');
    isOpen = true;

    // Focus trap
    updateFocusableElements();
    if (firstFocusableElement) {
      firstFocusableElement.focus();
    }

    // Empêcher le scroll du body
    document.body.style.overflow = 'hidden';
  }

  // Fermer le chat
  function closeChat() {
    const bubble = document.getElementById('junsproChatBubble');
    const chat = document.getElementById('junsproChat');

    if (!bubble || !chat) return;

    chat.classList.add('closing');
    
    setTimeout(() => {
      chat.classList.add('hidden');
      bubble.classList.remove('hidden');
      isOpen = false;

      // Restaurer le scroll du body
      document.body.style.overflow = '';

      // Retourner le focus à la bulle
      if (bubble) {
        bubble.focus();
      }
    }, 200);
  }

  // Mettre à jour les éléments focusables pour le focus trap
  function updateFocusableElements() {
    const chat = document.getElementById('junsproChat');
    if (!chat) return;

    const focusableSelectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    focusableElements = Array.from(chat.querySelectorAll(focusableSelectors));
    
    firstFocusableElement = focusableElements[0] || null;
    lastFocusableElement = focusableElements[focusableElements.length - 1] || null;
  }

  // Gérer le clic sur une action
  function handleActionClick(action) {
    switch(action) {
      case 'search-freelancer':
        closeChat();
        setTimeout(() => {
          window.location.href = '/freelances';
        }, 200);
        break;
      case 'i-am-freelancer':
        closeChat();
        setTimeout(() => {
          window.location.href = '/user/signup';
        }, 200);
        break;
      case 'have-question':
        closeChat();
        setTimeout(() => {
          window.location.href = '/faq';
        }, 200);
        break;
      case 'contact-team':
        showContactForm();
        break;
      case 'chat-ia':
        showAIChat();
        break;
      default:
        console.warn('Action non reconnue:', action);
    }
  }

  // Attacher les événements
  function attachEventListeners() {
    const bubble = document.getElementById('junsproChatBubble');
    const chat = document.getElementById('junsproChat');
    const closeBtn = document.getElementById('junsproChatClose');
    const main = document.getElementById('junsproChatMain');

    // Toggle sur la bulle (clic et Enter)
    if (bubble) {
      bubble.addEventListener('click', toggleChat);
      bubble.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          toggleChat();
        }
      });
    }

    // Fermer avec le bouton X
    if (closeBtn) {
      closeBtn.addEventListener('click', closeChat);
    }

    // Fermer en cliquant en dehors (desktop uniquement)
    if (chat) {
      chat.addEventListener('click', function(e) {
        if (e.target === chat) {
          closeChat();
        }
      });
    }
    // Fermer en cliquant sur l'overlay (si padding extérieur)
    if (main) {
      main.addEventListener('click', function(e) {
        if (e.target === main && window.innerWidth >= 992) {
          closeChat();
        }
      });
    }

    // Fermer avec ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && isOpen) {
        closeChat();
      }
    });

    // Focus trap avec Tab
    if (chat) {
      chat.addEventListener('keydown', function(e) {
        if (e.key !== 'Tab') return;

        if (e.shiftKey) {
          // Shift + Tab
          if (document.activeElement === firstFocusableElement) {
            e.preventDefault();
            if (lastFocusableElement) {
              lastFocusableElement.focus();
            }
          }
        } else {
          // Tab
          if (document.activeElement === lastFocusableElement) {
            e.preventDefault();
            if (firstFocusableElement) {
              firstFocusableElement.focus();
            }
          }
        }
      });
    }

    // Déléguer les clics sur les boutons d'action
    document.addEventListener('click', function(e) {
      const actionBtn = e.target.closest('.junspro-chat-action-btn');
      if (actionBtn && actionBtn.dataset.action) {
        e.preventDefault();
        handleActionClick(actionBtn.dataset.action);
      }
    });
  }

  // Échapper le HTML pour la sécurité
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Initialiser quand le DOM est prêt
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
