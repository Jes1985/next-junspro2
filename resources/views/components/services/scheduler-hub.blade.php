{{-- 
  Composant SchedulerHub - Point d'entrée unique pour tous les schedulers
  Usage: <x-services.scheduler-hub universe="projects" freelancer-id="123" />
--}}

@props([
    'universe' => 'lessons', // lessons|wellnesslive|at-home|corporate|projects|homeswap
    'freelancerId' => null,
])

<div id="scheduler-hub-container" data-universe="{{ $universe }}" data-freelancer-id="{{ $freelancerId }}">
    {{-- Le scheduler existant (Mode A) sera affiché ici si universe est lessons|wellnesslive|at-home|corporate --}}
    {{-- Les nouveaux schedulers (Mode B/C) seront injectés via JS si universe est projects|homeswap --}}
    
    @if(in_array($universe, ['lessons', 'wellnesslive', 'at-home', 'corporate']))
        {{-- Mode A : Scheduler existant --}}
        {{-- Le contenu sera injecté depuis booking.blade.php --}}
        <div class="booking-container" id="session-scheduler-container">
            {{-- Contenu du scheduler existant --}}
        </div>
    @else
        {{-- Mode B/C : Nouveaux schedulers --}}
        <div class="scheduler-container" id="new-scheduler-container">
            {{-- Sera rempli par JS --}}
        </div>
    @endif
</div>

@push('scripts')
<script src="{{ asset('assets/js/scheduler/SchedulerHub.js') }}"></script>
@if($universe === 'projects')
    <script src="{{ asset('assets/js/scheduler/ProjectScheduler.js') }}"></script>
@elseif($universe === 'homeswap')
    <script src="{{ asset('assets/js/scheduler/HomeSwapScheduler.js') }}"></script>
@endif

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
@endpush

