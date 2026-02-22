

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'universe' => 'lessons', // lessons|wellnesslive|at-home|corporate|projects|homeswap
    'freelancerId' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'universe' => 'lessons', // lessons|wellnesslive|at-home|corporate|projects|homeswap
    'freelancerId' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="scheduler-hub-container" data-universe="<?php echo e($universe); ?>" data-freelancer-id="<?php echo e($freelancerId); ?>">
    
    
    
    <?php if(in_array($universe, ['lessons', 'wellnesslive', 'at-home', 'corporate'])): ?>
        
        
        <div class="booking-container" id="session-scheduler-container">
            
        </div>
    <?php else: ?>
        
        <div class="scheduler-container" id="new-scheduler-container">
            
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/scheduler/SchedulerHub.js')); ?>"></script>
<?php if($universe === 'projects'): ?>
    <script src="<?php echo e(asset('assets/js/scheduler/ProjectScheduler.js')); ?>"></script>
<?php elseif($universe === 'homeswap'): ?>
    <script src="<?php echo e(asset('assets/js/scheduler/HomeSwapScheduler.js')); ?>"></script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('scheduler-hub-container');
    if (!container) return;

    const universe = container.getAttribute('data-universe');
    const freelancerId = container.getAttribute('data-freelancer-id');

    // Initialiser le SchedulerHub
    if (typeof SchedulerHub !== 'undefined') {
        const hub = new SchedulerHub('scheduler-hub-container', {
            universeType: universe,
            freelancerId: freelancerId
        });

        // Exposer les instances pour les callbacks
        if (universe === 'projects' && typeof ProjectScheduler !== 'undefined') {
            window.projectSchedulerInstance = hub;
        } else if (universe === 'homeswap' && typeof HomeSwapScheduler !== 'undefined') {
            window.homeSwapSchedulerInstance = hub;
        }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\scheduler-hub.blade.php ENDPATH**/ ?>