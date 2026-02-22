
<?php
  $currentHash = request()->get('tab') ?: (request()->get('hash') ?: 'overview');
?>

<?php if(request()->routeIs('freelance.*')): ?>
<nav class="freelance-dashboard-nav">
  <div class="container-fluid px-xl-5">
    <div class="freelance-nav-wrapper">
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'overview'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'overview' || (!request('tab') && request()->routeIs('freelance.dashboard')) ? 'active' : ''); ?>" 
         data-tab="overview">Aperçu</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'requests'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'requests' ? 'active' : ''); ?>" 
         data-tab="requests">Demandes</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'jobs'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'jobs' ? 'active' : ''); ?>" 
         data-tab="jobs">Prestations</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'calendar'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'calendar' ? 'active' : ''); ?>" 
         data-tab="calendar">Agenda</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'services'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'services' ? 'active' : ''); ?>" 
         data-tab="services">Services</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'messages'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'messages' ? 'active' : ''); ?>" 
         data-tab="messages">Messages</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'earnings'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'earnings' ? 'active' : ''); ?>" 
         data-tab="earnings">Revenus</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'profile'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'profile' ? 'active' : ''); ?>" 
         data-tab="profile">Profil</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'settings'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'settings' ? 'active' : ''); ?>" 
         data-tab="settings">Paramètres</a>
      <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'rituals'])); ?>" 
         class="freelance-nav-item <?php echo e(request('tab') === 'rituals' ? 'active' : ''); ?>" 
         data-tab="rituals">Rituels</a>
    </div>
  </div>
</nav>
<?php endif; ?>

<style>
  .freelance-dashboard-nav {
    background: white;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    padding: 0;
    margin: 0;
    position: sticky;
    top: 0;
    z-index: 99;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .freelance-nav-wrapper {
    display: flex;
    gap: 0.5rem;
    overflow-x: auto;
    padding: 1rem 0;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
  }

  .freelance-nav-wrapper::-webkit-scrollbar {
    height: 4px;
  }

  .freelance-nav-wrapper::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.05);
  }

  .freelance-nav-wrapper::-webkit-scrollbar-thumb {
    background: rgba(124, 58, 237, 0.3);
    border-radius: 2px;
  }

  .freelance-nav-item {
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    color: #6b7280;
    font-weight: 500;
    font-size: 0.95rem;
    border-radius: 12px;
    transition: all 0.2s ease;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
  }

  .freelance-nav-item:hover {
    color: var(--junspro-purple, #7C3AED);
    background: #f3f4f6;
  }

  .freelance-nav-item.active {
    color: #fff !important;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) !important;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3) !important;
  }

  @media (max-width: 768px) {
    .freelance-nav-item {
      padding: 0.625rem 1.25rem;
      font-size: 0.85rem;
    }
  }
</style>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\partials\navbar.blade.php ENDPATH**/ ?>