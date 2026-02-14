/**
 * expressOptions.js — Module Express unique (source de vérité)
 * Gère la sélection Express, persistance localStorage, émet express:changed
 * Scoped via data-attributes uniquement
 */
(function() {
  'use strict';

  const STORAGE_KEY = 'junspro_express_mode';
  const MODES = { none: { percent: 0, multiplier: 1.0 }, '24': { percent: 30, multiplier: 1.3 }, '48': { percent: 20, multiplier: 1.2 }, '72': { percent: 10, multiplier: 1.1 } };

  function getStoredMode() {
    try {
      var v = localStorage.getItem(STORAGE_KEY);
      return (v && MODES[v]) ? v : 'none';
    } catch (e) {
      return 'none';
    }
  }

  function setStoredMode(mode) {
    try {
      localStorage.setItem(STORAGE_KEY, mode);
    } catch (e) {}
  }

  function emitChanged(mode) {
    var m = MODES[mode] || MODES.none;
    window.dispatchEvent(new CustomEvent('express:changed', {
      detail: { mode: mode, percent: m.percent, multiplier: m.multiplier }
    }));
  }

  function setSelectedInContainer(container, mode) {
    var input = container.querySelector('[data-express-input]');
    var cards = container.querySelectorAll('.express-option-card[data-express]');
    var micro = container.querySelector('[data-express-micro]');
    if (input) input.value = mode;
    cards.forEach(function(card) {
      var sel = card.getAttribute('data-express') === mode;
      card.classList.toggle('is-selected', sel);
      card.setAttribute('aria-pressed', sel ? 'true' : 'false');
    });
    if (micro) {
      var pct = (MODES[mode] || MODES.none).percent;
      micro.textContent = pct > 0 ? 'Supplément Express appliqué : +' + pct + '%' : 'Standard : aucun supplément';
    }
  }

  function updateUrl(mode) {
    try {
      var url = new URL(window.location.href);
      if (mode === 'none') {
        url.searchParams.delete('express');
      } else {
        url.searchParams.set('express', mode);
      }
      if (url.toString() !== window.location.href) {
        window.history.replaceState({}, '', url.toString());
      }
    } catch (e) {}
  }

  function setSelected(mode) {
    setStoredMode(mode);
    updateUrl(mode);
    document.querySelectorAll('[data-express-options]').forEach(function(c) {
      setSelectedInContainer(c, mode);
    });
    emitChanged(mode);
  }

  function initContainer(container) {
    var cards = container.querySelectorAll('.express-option-card[data-express]');
    cards.forEach(function(card) {
      card.addEventListener('click', function() {
        setSelected(this.getAttribute('data-express'));
      });
    });
  }

  function init() {
    var containers = document.querySelectorAll('[data-express-options]');
    if (!containers.length) return;
    var first = containers[0];
    var fromUrl = first.getAttribute('data-initial');
    var initial = (fromUrl && fromUrl !== 'none') ? fromUrl : getStoredMode();
    setStoredMode(initial);
    containers.forEach(function(c) {
      initContainer(c);
      setSelectedInContainer(c, initial);
    });
    emitChanged(initial);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
