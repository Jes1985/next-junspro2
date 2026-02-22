<?php
  $tabs = [
    'overview' => 'Aperçu',
    'requests' => 'Demandes',
    'jobs' => 'Prestations',
    'calendar' => 'Agenda',
    'services' => 'Services',
    'messages' => 'Messages',
    'earnings' => 'Revenus',
    'profile' => 'Profil',
    'settings' => 'Paramètres',
    'rituals' => 'Rituels'
  ];
?>

<nav class="dashboard-tabs-nav">
  <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('freelance.dashboard', ['tab' => $tabKey])); ?>" 
       class="dashboard-tab-item <?php echo e($activeTab === $tabKey ? 'active' : ''); ?>">
      <?php echo e($tabLabel); ?>

    </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\_tabs.blade.php ENDPATH**/ ?>