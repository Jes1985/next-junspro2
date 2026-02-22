
<?php
  $signature = app(\App\Services\Junspro\CycleUsageService::class)->ritualSignatureText();
?>
<p class="ritual-signature-helper" style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0; line-height: 1.4;"><?php echo e($signature); ?></p>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/components/ritual-signature.blade.php ENDPATH**/ ?>