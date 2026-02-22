<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sessionId',
    'subscriptionId',
    'freelancerId',
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
    'sessionId',
    'subscriptionId',
    'freelancerId',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // URLs pour les actions
    // TODO: Quand la route /freelance/messages sera disponible, utiliser: /freelance/messages?thread={{ $subscriptionId }}
    $messageUrl = route('user.messages.index', ['conversation' => $subscriptionId]);
    
    // Profil freelance - route existante /freelance/{id}
    $freelancerProfileUrl = route('freelance.show', ['id' => $freelancerId]);
    
    // URL du projet pour partage
    $projectUrl = route('client.subscriptions.show', $subscriptionId);
    
    // ID unique pour ce menu
    $menuId = 'upcoming-menu-' . $sessionId;
?>

<div class="client-upcoming-item-actions-wrapper" data-item-id="<?php echo e($sessionId); ?>">
    <button
        type="button"
        class="client-upcoming-item-kebab-btn"
        aria-label="Plus d'actions"
        aria-expanded="false"
        aria-haspopup="true"
        data-action-trigger
    >
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="5" r="1.5" fill="currentColor"/>
            <circle cx="10" cy="10" r="1.5" fill="currentColor"/>
            <circle cx="10" cy="15" r="1.5" fill="currentColor"/>
        </svg>
    </button>

    <div class="client-upcoming-item-actions-menu" data-action-menu id="<?php echo e($menuId); ?>">
        <div class="client-upcoming-item-actions-menu-inner">
            <!-- 1. Contacter le freelance -->
            <a
                href="<?php echo e($messageUrl); ?>"
                class="client-upcoming-item-action"
                data-action="contact"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5.83333L10 10.8333L17.5 5.83333M2.5 14.1667H17.5V5.83333H2.5V14.1667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Contacter le freelance</span>
            </a>

            <div class="client-upcoming-item-action-separator"></div>

            <!-- 2. Partager le projet -->
            <button
                type="button"
                class="client-upcoming-item-action"
                data-action="share"
                data-project-url="<?php echo e($projectUrl); ?>"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 6.66667C16.3807 6.66667 17.5 5.54738 17.5 4.16667C17.5 2.78595 16.3807 1.66667 15 1.66667C13.6193 1.66667 12.5 2.78595 12.5 4.16667C12.5 5.54738 13.6193 6.66667 15 6.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 12.5C6.38071 12.5 7.5 11.3807 7.5 10C7.5 8.61929 6.38071 7.5 5 7.5C3.61929 7.5 2.5 8.61929 2.5 10C2.5 11.3807 3.61929 12.5 5 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 18.3333C16.3807 18.3333 17.5 17.214 17.5 15.8333C17.5 14.4526 16.3807 13.3333 15 13.3333C13.6193 13.3333 12.5 14.4526 12.5 15.8333C12.5 17.214 13.6193 18.3333 15 18.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.15833 11.2583L12.8417 14.575M12.8417 5.425L7.15833 8.74167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Partager le projet</span>
            </button>

            <!-- 3. Voir profil du freelance -->
            <a
                href="<?php echo e($freelancerProfileUrl); ?>"
                class="client-upcoming-item-action"
                data-action="view-freelancer"
                target="_blank"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 10C12.3012 10 14.1667 8.13451 14.1667 5.83333C14.1667 3.53215 12.3012 1.66667 10 1.66667C7.69882 1.66667 5.83333 3.53215 5.83333 5.83333C5.83333 8.13451 7.69882 10 10 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.1583 18.3333C17.1583 15.1083 13.95 12.5 10 12.5C6.05 12.5 2.84167 15.1083 2.84167 18.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Voir le profil du freelance</span>
            </a>

            <div class="client-upcoming-item-action-separator"></div>

            <!-- 4. Reprogrammer -->
            <button
                type="button"
                class="client-upcoming-item-action"
                data-action="reschedule"
                data-session-id="<?php echo e($sessionId); ?>"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 5V10L13.3333 11.6667M17.5 10C17.5 14.1421 14.1421 17.5 10 17.5C5.85786 17.5 2.5 14.1421 2.5 10C2.5 5.85786 5.85786 2.5 10 2.5C14.1421 2.5 17.5 5.85786 17.5 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Reprogrammer</span>
            </button>

            <div class="client-upcoming-item-action-separator"></div>

            <!-- 5. Annuler (danger) -->
            <button
                type="button"
                class="client-upcoming-item-action client-upcoming-item-action-danger"
                data-action="cancel"
                data-session-id="<?php echo e($sessionId); ?>"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 5L15 15M15 5L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Annuler</span>
            </button>
        </div>
    </div>

    <!-- Overlay pour fermer le menu -->
    <div class="client-upcoming-item-actions-overlay" data-action-overlay></div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\client-upcoming-actions-menu.blade.php ENDPATH**/ ?>