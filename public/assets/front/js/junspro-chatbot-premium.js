/**
 * Junspro Chatbot Premium
 * Gestion du chatbot Assistant Junspro style ComeUp
 */

(function() {
  'use strict';

  // État du chatbot
  let isOpen = false;

  // Initialisation
  function init() {
    createChatbotHTML();
    attachEventListeners();
  }

  // Créer le HTML du chatbot
  function createChatbotHTML() {
    const chatbotHTML = `
      <!-- Bulle flottante (fermée) -->
      <div class="junspro-chat-bubble" id="junsproChatBubble">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
        </svg>
      </div>

      <!-- Panneau de chat (ouvert) -->
      <div class="junspro-chat hidden" id="junsproChat">
        <!-- Header -->
        <div class="junspro-chat-header">
          <div class="junspro-chat-header-left">
            <div class="junspro-chat-logo">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" fill="currentColor"/>
                <path d="M12 2v10M12 12v10M2 7h20M2 17h20" stroke="currentColor" stroke-width="1.5" fill="none"/>
              </svg>
            </div>
            <h3 class="junspro-chat-title">
              <span>Assistant</span>
              <span class="junspro-chat-title-separator">|</span>
              <span>Junspro</span>
            </h3>
          </div>
          <button class="junspro-chat-close" id="junsproChatClose" aria-label="Fermer">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
            </svg>
          </button>
        </div>

        <!-- Zone de messages -->
        <div class="junspro-chat-main" id="junsproChatMain">
          <div class="junspro-chat-message-ai">
            <div class="junspro-chat-message-ai-label">Assistant IA</div>
            <div class="junspro-chat-message-ai-content">
              Bonjour 👋 Je suis l'assistant Junspro. Que puis-je faire pour vous ?
            </div>
          </div>
          <!-- Boutons d'actions suggérées -->
          <div class="junspro-chat-suggestions">
            <button class="junspro-chat-suggestion-btn" data-action="search-freelancer">
              Je cherche un freelance
            </button>
            <button class="junspro-chat-suggestion-btn" data-action="i-am-freelancer">
              Je suis freelance
            </button>
            <button class="junspro-chat-suggestion-btn" data-action="have-question">
              J'ai une question
            </button>
          </div>
        </div>

        <!-- Footer - Zone de saisie -->
        <div class="junspro-chat-footer">
          <form id="junsproChatForm" class="junspro-chat-input-wrapper">
            <input 
              type="text" 
              class="junspro-chat-input" 
              id="junsproChatInput"
              placeholder="Posez une question..." 
              autocomplete="off"
            />
            <button type="submit" class="junspro-chat-send" id="junsproChatSend" aria-label="Envoyer">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
              </svg>
            </button>
          </form>
        </div>
      </div>
    `;

    // Ajouter au body
    document.body.insertAdjacentHTML('beforeend', chatbotHTML);
  }

  // Attacher les événements
  function attachEventListeners() {
    const bubble = document.getElementById('junsproChatBubble');
    const chat = document.getElementById('junsproChat');
    const closeBtn = document.getElementById('junsproChatClose');
    const form = document.getElementById('junsproChatForm');
    const input = document.getElementById('junsproChatInput');
    const sendBtn = document.getElementById('junsproChatSend');

    // Ouvrir le chat
    if (bubble) {
      bubble.addEventListener('click', openChat);
    }

    // Fermer le chat
    if (closeBtn) {
      closeBtn.addEventListener('click', closeChat);
    }

    // Fermer en cliquant en dehors (optionnel)
    if (chat) {
      chat.addEventListener('click', function(e) {
        if (e.target === chat) {
          closeChat();
        }
      });
    }

    // Envoyer un message
    if (form) {
      form.addEventListener('submit', handleSendMessage);
    }

    // Entrée pour envoyer
    if (input) {
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
          e.preventDefault();
          handleSendMessage(e);
        }
      });
    }

    // Boutons d'actions suggérées
    const suggestionButtons = document.querySelectorAll('.junspro-chat-suggestion-btn');
    suggestionButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const action = this.getAttribute('data-action');
        handleSuggestionClick(action, this.textContent);
      });
    });
  }

  // Gérer le clic sur une suggestion
  function handleSuggestionClick(action, text) {
    // Afficher le texte de la suggestion comme message utilisateur
    addUserMessage(text);
    scrollToBottom();

    // Masquer les suggestions
    const suggestions = document.querySelector('.junspro-chat-suggestions');
    if (suggestions) {
      suggestions.style.display = 'none';
    }

    // Répondre selon l'action
    setTimeout(() => {
      let response = '';
      switch(action) {
        case 'search-freelancer':
          response = "Parfait ! Je peux vous aider à trouver le freelance idéal. Utilisez la barre de recherche en haut de la page ou explorez nos catégories. Vous pouvez aussi me décrire votre projet et je vous orienterai vers les meilleurs profils.";
          break;
        case 'i-am-freelancer':
          response = "Excellent ! Pour devenir freelance sur Junspro, créez votre profil, ajoutez vos compétences et votre portfolio. Les clients pourront alors vous contacter et vous proposer des missions. Souhaitez-vous que je vous guide dans la création de votre profil ?";
          break;
        case 'have-question':
          response = "Je suis là pour répondre à toutes vos questions ! Consultez notre <a href='#' onclick='event.preventDefault();'>centre d'aide</a> ou posez-moi directement votre question ci-dessous.";
          break;
        default:
          response = "Merci pour votre message. Comment puis-je vous aider davantage ?";
      }
      addAIMessage(response);
      scrollToBottom();
    }, 500);
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

    // Focus sur l'input
    const input = document.getElementById('junsproChatInput');
    if (input) {
      setTimeout(() => input.focus(), 100);
    }

    // Scroll en bas
    scrollToBottom();
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
    }, 200);
  }

  // Envoyer un message
  function handleSendMessage(e) {
    e.preventDefault();

    const input = document.getElementById('junsproChatInput');
    const main = document.getElementById('junsproChatMain');
    const sendBtn = document.getElementById('junsproChatSend');

    if (!input || !main) return;

    const message = input.value.trim();

    if (!message) return;

    // Désactiver le bouton
    if (sendBtn) {
      sendBtn.disabled = true;
    }

    // Afficher le message de l'utilisateur
    addUserMessage(message);

    // Vider l'input
    input.value = '';

    // Réactiver le bouton
    if (sendBtn) {
      sendBtn.disabled = false;
    }

    // Scroll en bas
    scrollToBottom();

    // Simuler une réponse de l'IA (à remplacer par un vrai appel API)
    setTimeout(() => {
      addAIMessage("Merci pour votre message. Je traite votre demande...");
      scrollToBottom();
    }, 500);
  }

  // Ajouter un message utilisateur
  function addUserMessage(text) {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    const messageHTML = `
      <div class="junspro-chat-message-user">
        <div class="junspro-chat-message-user-content">${escapeHtml(text)}</div>
      </div>
    `;

    main.insertAdjacentHTML('beforeend', messageHTML);
  }

  // Ajouter un message IA
  function addAIMessage(text) {
    const main = document.getElementById('junsproChatMain');
    if (!main) return;

    const messageHTML = `
      <div class="junspro-chat-message-ai">
        <div class="junspro-chat-message-ai-label">Assistant IA</div>
        <div class="junspro-chat-message-ai-content">${escapeHtml(text)}</div>
      </div>
    `;

    main.insertAdjacentHTML('beforeend', messageHTML);
  }

  // Scroll en bas
  function scrollToBottom() {
    const main = document.getElementById('junsproChatMain');
    if (main) {
      setTimeout(() => {
        main.scrollTop = main.scrollHeight;
      }, 100);
    }
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

