/**
 * NEXUS Onboarding — Autosave silencieux
 * ─────────────────────────────────────────────────────────────
 * Sauvegarde chaque champ en BDD + session immédiatement après
 * modification, sans aucune action de l'utilisateur.
 * Les données sont ainsi indestructibles (déco, refresh, etc.)
 */
(function () {
  'use strict';

  var AUTOSAVE_URL = window._nxAutosaveUrl || '/nexus/onboarding/autosave';
  var CSRF_TOKEN   = document.querySelector('meta[name="csrf-token"]')
                     ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                     : (window._nxCsrfToken || '');

  // Champs fichiers — jamais envoyés via autosave
  var FILE_NAMES = ['photo', 'video_thumbnail', 'property_photos', 'property_photos[]'];

  // Debounce pour les champs texte (éviter un appel par frappe)
  var timers = {};
  function debounce(key, fn, delay) {
    clearTimeout(timers[key]);
    timers[key] = setTimeout(fn, delay || 800);
  }

  /**
   * Envoie un objet de données {clé: valeur} en AJAX vers l'endpoint autosave.
   */
  function save(data) {
    if (!data || Object.keys(data).length === 0) return;

    console.log('[NX-autosave] SAVE →', data);

    var body = new FormData();
    body.append('_token', CSRF_TOKEN);
    for (var key in data) {
      if (Array.isArray(data[key])) {
        data[key].forEach(function(v) { body.append(key + '[]', v); });
      } else {
        body.append(key, data[key] !== null && data[key] !== undefined ? data[key] : '');
      }
    }

    fetch(AUTOSAVE_URL, { method: 'POST', body: body, credentials: 'same-origin' })
      .then(function(r) {
        r.json().then(function(j) {
          if (j.ok) {
            console.log('[NX-autosave] ✅ OK →', data);
          } else {
            console.warn('[NX-autosave] ❌ ERREUR serveur →', j);
          }
        }).catch(function(e) { console.warn('[NX-autosave] réponse non-JSON', r.status, e); });
      })
      .catch(function(err) { console.error('[NX-autosave] FETCH FAILED', err); });
  }

  /**
   * Collecte UNIQUEMENT les données du champ modifié (et son groupe si checkbox/radio).
   * Évite d'écraser d'autres champs sauvegardés avec des valeurs vides du DOM.
   */
  function collectChangedData(el, form) {
    var name = el.name;
    if (!name || FILE_NAMES.indexOf(name) !== -1) return {};

    var key  = name.replace(/\[\]$/, '');
    var data = {};

    if (el.type === 'checkbox') {
      // Collecte toutes les cases cochées du même groupe
      var group = form.querySelectorAll('input[name="' + name + '"]:not([disabled])');
      var vals  = [];
      group.forEach(function (cb) { if (cb.checked) vals.push(cb.value); });
      data[key] = vals;
    } else if (el.type === 'radio') {
      if (el.checked) data[key] = el.value;
    } else {
      data[key] = el.value;
    }

    return data;
  }

  /**
   * Attache les listeners sur un formulaire marqué [data-nx-autosave].
   */
  function attachForm(form) {
    console.log('[NX-autosave] attachForm →', form.id || form.action);
    // Envoi immédiat sur select / checkbox / radio / hidden
    // On envoie UNIQUEMENT le champ modifié (pas tout le form)
    // → évite qu'un select vide (non encore hydraté par JS) écrase une valeur sauvegardée
    form.addEventListener('change', function (e) {
      var el   = e.target;
      var name = el.name || '';
      if (!name || FILE_NAMES.indexOf(name) !== -1) return;
      if (el.type === 'file') return;

      var data = collectChangedData(el, form);
      save(data);
    });

    // Envoi différé (800 ms) sur les champs texte / textarea
    form.addEventListener('input', function (e) {
      var el   = e.target;
      var name = el.name || '';
      if (!name || FILE_NAMES.indexOf(name) !== -1) return;
      if (el.type === 'file' || el.type === 'checkbox' || el.type === 'radio') return;

      debounce('nx_input_' + name, function () {
        save(collectChangedData(el, form));
      }, 800);
    });
  }

  /**
   * Initialisation : parcourt tous les formulaires marqués.
   */
  function init() {
    var forms = document.querySelectorAll('form[data-nx-autosave]');
    console.log('[NX-autosave] init — ' + forms.length + ' form(s) trouvé(s) | URL=' + AUTOSAVE_URL + ' | CSRF=' + (CSRF_TOKEN ? 'OK' : '❌ ABSENT'));
    forms.forEach(attachForm);
  }

  // Lancement après chargement complet du DOM
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Restauration depuis le bfcache (bouton Retour/Avance du navigateur)
  // DOMContentLoaded ne se redéclenche PAS dans ce cas → on ré-attache manuellement
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      console.log('[NX-autosave] pageshow persisted — réattachement des listeners');
      // Rafraîchit le CSRF token (peut avoir expiré)
      var meta = document.querySelector('meta[name="csrf-token"]');
      if (meta) CSRF_TOKEN = meta.getAttribute('content');
      // Détache et réattache pour éviter les doublons
      document.querySelectorAll('form[data-nx-autosave]').forEach(function (form) {
        var clone = form.cloneNode(false);
        while (form.firstChild) clone.appendChild(form.firstChild);
        form.parentNode.replaceChild(clone, form);
        attachForm(clone);
      });
    }
  });
})();