<?php $__env->startSection('pageHeading'); ?>
  Choisir mon cycle (4 semaines) | <?php echo e($websiteInfo->website_title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  Choisissez votre cycle Pause Souffle : 1, 2, 4 ou 8 rituels par cycle de 4 semaines.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
  .pause-souffle-choose-cycle-page {
    min-height: 70vh;
    padding: 4rem 1rem;
    background: #FFFFFF;
  }

  .pause-souffle-choose-cycle-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .pause-souffle-choose-cycle-header {
    text-align: center;
    margin-bottom: 3rem;
  }

  .pause-souffle-choose-cycle-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-choose-cycle-header p {
    font-size: 1.125rem;
    color: #6B7280;
    line-height: 1.6;
  }

  .pause-souffle-packs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  .pause-souffle-pack-card {
    border: 2px solid #E5E7EB;
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #FFFFFF;
  }

  .pause-souffle-pack-card:hover {
    border-color: #6366F1;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    transform: translateY(-2px);
  }

  .pause-souffle-pack-card.selected {
    border-color: #6366F1;
    background: #F0F4FF;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
  }

  .pause-souffle-pack-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 0.5rem;
  }

  .pause-souffle-pack-card .rituals-count {
    font-size: 0.875rem;
    color: #6B7280;
    margin-bottom: 1rem;
  }

  .pause-souffle-pack-card .price {
    font-size: 1.75rem;
    font-weight: 700;
    color: #6366F1;
    margin-bottom: 0.5rem;
  }

  .pause-souffle-pack-card .price-currency {
    font-size: 1rem;
    color: #6B7280;
  }

  .pause-souffle-addon-section {
    background: #F9FAFB;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
  }

  .pause-souffle-addon-section h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-addon-section p {
    font-size: 0.875rem;
    color: #6B7280;
    margin-bottom: 1.5rem;
  }

  .pause-souffle-stepper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
  }

  .pause-souffle-stepper-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #E5E7EB;
    border-radius: 8px;
    background: #FFFFFF;
    color: #1F2937;
    font-size: 1.25rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .pause-souffle-stepper-btn:hover:not(:disabled) {
    border-color: #6366F1;
    color: #6366F1;
  }

  .pause-souffle-stepper-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .pause-souffle-stepper-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    min-width: 60px;
    text-align: center;
  }

  .pause-souffle-total {
    text-align: center;
    font-size: 1.125rem;
    font-weight: 600;
    color: #1F2937;
    padding: 1rem;
    background: #FFFFFF;
    border-radius: 8px;
    margin-top: 1rem;
  }

  .pause-souffle-activate-btn {
    display: block;
    width: 100%;
    padding: 1rem 2rem;
    background: #6366F1;
    color: #FFFFFF;
    text-align: center;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .pause-souffle-activate-btn:hover:not(:disabled) {
    background: #4F46E5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
  }

  .pause-souffle-activate-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  /* ── Stepper visuel — bulles cycle ────────────────────────── */
  .jp-bubble-recap {
    margin: 0 0 1.25rem;
    text-align: center;
  }
  .jp-bubble-recap-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #9ca3af;
    margin-bottom: 0.6rem;
  }
  .jp-bubble-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
    margin-bottom: 0.55rem;
  }
  .jp-bubble {
    width: 38px; height: 38px;
    border-radius: 50%;
    border: 2px solid #e5e7eb;
    background: #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.65rem; font-weight: 700;
    color: #d1d5db;
    transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
    flex-shrink: 0;
  }
  .jp-bubble.is-pack {
    background: #6366f1;
    border-color: #4f46e5;
    color: #fff;
    transform: scale(1.08);
  }
  .jp-bubble.is-addon {
    background: #f59e0b;
    border-color: #d97706;
    color: #fff;
    transform: scale(1.05);
  }
  .jp-bubble-legend {
    display: flex;
    justify-content: center;
    gap: 1rem;
    font-size: 0.72rem;
    color: #6b7280;
  }
  .jp-legend-dot {
    display: inline-block;
    width: 9px; height: 9px;
    border-radius: 50%;
    margin-right: 4px;
    vertical-align: middle;
  }
  .jp-bubble-total-line {
    margin-top: 0.55rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: #374151;
  }
  .jp-bubble-total-line .jp-total-highlight {
    color: #6366f1;
    font-size: 1rem;
  }
  /* ── fin stepper visuel ────────────────────────────────────── */

  @media (max-width: 768px) {
    .pause-souffle-choose-cycle-header h1 {
      font-size: 2rem;
    }

    .pause-souffle-packs-grid {
      grid-template-columns: 1fr;
    }

    .jp-bubble {
      width: 30px; height: 30px;
      font-size: 0.6rem;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="pause-souffle-choose-cycle-page">
  <div class="pause-souffle-choose-cycle-container">
    <div class="pause-souffle-choose-cycle-header">
      <h1>Choisir mon cycle (4 semaines)</h1>
      <p>Après votre rituel d'essai, choisissez le rythme qui vous convient pour les 4 prochaines semaines.</p>
    </div>

    <form id="chooseCycleForm" method="POST" action="<?php echo e(route('pause-souffle.activate-cycle')); ?>">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="intake_id" value="<?php echo e($intake->id); ?>">
      <?php if(!empty($isPreview)): ?>
        <div style="margin-bottom:1.5rem;padding:0.75rem 1rem;background:#fef3c7;border:1px solid #fcd34d;border-radius:8px;font-size:0.82rem;color:#92400e;text-align:center;">
          ⚠️ Mode aperçu — les prix sont indicatifs et la soumission est désactivée.
        </div>
      <?php endif; ?>

      <div class="pause-souffle-packs-grid">
        <?php $__currentLoopData = ['pack_1' => '1 rituel', 'pack_2' => '2 rituels', 'pack_4' => '4 rituels', 'pack_8' => '8 rituels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packKey => $packLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $packData = $packs[$packKey] ?? null;
            $ritualsPerCycle = config("pause_souffle.pack_to_rituals_per_cycle.{$packKey}", 0);
          ?>
          <?php if($packData): ?>
            <div class="pause-souffle-pack-card" data-pack="<?php echo e($packKey); ?>" onclick="selectPack('<?php echo e($packKey); ?>')">
              <h3><?php echo e($packLabel); ?></h3>
              <div class="rituals-count">par cycle de 4 semaines</div>
              <div class="price">
                <?php echo e(number_format($packData['amount'], 2, ',', ' ')); ?>

                <span class="price-currency"><?php echo e($packData['currency']); ?></span>
              </div>
              <input type="radio" name="pack" value="<?php echo e($packKey); ?>" id="pack_<?php echo e($packKey); ?>" style="display: none;">
            </div>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="pause-souffle-addon-section">
        <h2>Rituels supplémentaires</h2>
        <p>Ajoutez jusqu'à 12 rituels au total par cycle (pack + add-on).</p>

        
        <div class="jp-bubble-recap">
          <p class="jp-bubble-recap-label">Aperçu de votre cycle (12 rituels max)</p>
          <div class="jp-bubble-row" id="jp-bubble-row">
            
          </div>
          <div class="jp-bubble-legend">
            <span><span class="jp-legend-dot" style="background:#6366f1"></span>Pack sélectionné</span>
            <span><span class="jp-legend-dot" style="background:#f59e0b"></span>Add-on</span>
            <span><span class="jp-legend-dot" style="background:#f3f4f6; border:1.5px solid #e5e7eb; box-sizing:border-box;"></span>Disponible</span>
          </div>
          <p class="jp-bubble-total-line" id="jp-bubble-total" style="display:none">
            Total sélectionné : <span class="jp-total-highlight" id="jp-total-count">0</span> rituels / 4 semaines
          </p>
        </div>
        
        
        <div class="pause-souffle-stepper">
          <button type="button" class="pause-souffle-stepper-btn" onclick="decreaseAddon()" id="decreaseBtn">-</button>
          <span class="pause-souffle-stepper-value" id="addonValue">0</span>
          <button type="button" class="pause-souffle-stepper-btn" onclick="increaseAddon()" id="increaseBtn">+</button>
        </div>
        
        <input type="hidden" name="addon_qty" id="addonQty" value="0">
        
        <div class="pause-souffle-total" id="totalDisplay">
          Total : <span id="totalRituals">0</span> rituels / 4 semaines
        </div>
      </div>

      <button type="submit" class="pause-souffle-activate-btn" id="activateBtn"
              <?php echo e(!empty($isPreview) ? 'disabled title="Mode aperçu : soumission désactivée"' : ''); ?>>
        Activer mon cycle (4 semaines)
      </button>
    </form>
  </div>
</div>

<script>
  let selectedPack = null;
  let addonQty = 0;
  const maxRituals = 12;
  const isPreview = <?php echo e(!empty($isPreview) ? 'true' : 'false'); ?>;

  // ── Rendu visuel des bulles ──────────────────────────────
  function renderBubbles() {
    const packRituals = selectedPack ? getPackRituals(selectedPack) : 0;
    const total = packRituals + addonQty;
    const row   = document.getElementById('jp-bubble-row');
    if (!row) return;

    row.innerHTML = '';
    for (let i = 1; i <= maxRituals; i++) {
      const b = document.createElement('div');
      b.className = 'jp-bubble';
      b.textContent = i;
      if (i <= packRituals) {
        b.classList.add('is-pack');
        b.title = 'Inclus dans le pack';
      } else if (i <= packRituals + addonQty) {
        b.classList.add('is-addon');
        b.title = 'Add-on';
      } else {
        b.title = 'Disponible';
      }
      row.appendChild(b);
    }

    // Ligne récap total
    const totalLine  = document.getElementById('jp-bubble-total');
    const totalCount = document.getElementById('jp-total-count');
    if (totalLine && totalCount) {
      totalLine.style.display  = selectedPack ? 'block' : 'none';
      totalCount.textContent   = total;
    }
  }
  // ── fin renderBubbles ─────────────────────────────────────────

  function selectPack(packKey) {
    // Désélectionner tous les packs
    document.querySelectorAll('.pause-souffle-pack-card').forEach(card => {
      card.classList.remove('selected');
    });
    
    // Sélectionner le pack cliqué
    const card = document.querySelector(`[data-pack="${packKey}"]`);
    if (card) {
      card.classList.add('selected');
      const radio = document.getElementById(`pack_${packKey}`);
      if (radio) {
        radio.checked = true;
        selectedPack = packKey;
        // Réinitialiser add-on si le pack change et dépasse le max
        const maxAddon = maxRituals - getPackRituals(packKey);
        if (addonQty > maxAddon) {
          addonQty = maxAddon;
          updateAddonDisplay();
        }
        updateTotal();
        renderBubbles();
        checkActivateButton();
      }
    }
  }

  function getPackRituals(packKey) {
    // Les packs représentent le nombre de rituels par cycle de 4 semaines
    const packMap = {
      'pack_1': 1,
      'pack_2': 2,
      'pack_4': 4,
      'pack_8': 8
    };
    return packMap[packKey] || 0;
  }

  function increaseAddon() {
    if (!selectedPack) return;
    
    const packRituals = getPackRituals(selectedPack);
    const maxAddon = maxRituals - packRituals;
    
    if (addonQty < maxAddon) {
      addonQty++;
      updateAddonDisplay();
      updateTotal();
      renderBubbles();
    }
  }

  function decreaseAddon() {
    if (addonQty > 0) {
      addonQty--;
      updateAddonDisplay();
      updateTotal();
      renderBubbles();
    }
  }

  function updateAddonDisplay() {
    document.getElementById('addonValue').textContent = addonQty;
    document.getElementById('addonQty').value = addonQty;
    
    // Désactiver boutons si limites atteintes
    const packRituals = selectedPack ? getPackRituals(selectedPack) : 0;
    const maxAddon = maxRituals - packRituals;
    
    document.getElementById('increaseBtn').disabled = addonQty >= maxAddon;
    document.getElementById('decreaseBtn').disabled = addonQty <= 0;
  }

  function updateTotal() {
    const packRituals = selectedPack ? getPackRituals(selectedPack) : 0;
    const totalRituals = packRituals + addonQty;
    
    document.getElementById('totalRituals').textContent = totalRituals;
    
    // Ajuster add-on si dépassement
    if (totalRituals > maxRituals) {
      addonQty = Math.max(0, maxRituals - packRituals);
      updateAddonDisplay();
    }
  }

  function checkActivateButton() {
    const activateBtn = document.getElementById('activateBtn');
    activateBtn.disabled = !selectedPack || isPreview;
  }

  // Initialiser au chargement
  document.addEventListener('DOMContentLoaded', function() {
    checkActivateButton();
    updateAddonDisplay();
    renderBubbles(); // dessiner les 12 bulles grises vides
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\presence\pause-souffle-choose-cycle.blade.php ENDPATH**/ ?>