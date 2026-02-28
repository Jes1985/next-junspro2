<!-- Menu contextuel premium Blade pour abonnement Junspro -->
<div class="subscription-menu-dropdown show" style="background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(124,58,237,0.12); padding: 16px 0; min-width: 280px; animation: fadeIn 0.3s;">
    <button class="menu-item" onclick="openCalendarModal()">
        <span class="menu-icon">📅</span>
        Programmer des Rituels
    </button>
    <hr>
    <button class="menu-item" onclick="openChangePlanModal()">
        <span class="menu-icon">🔄</span>
        Changer d'abonnement
    </button>
    <hr>
    <button class="menu-item" onclick="openAddCoursesModal()">
        <span class="menu-icon">💳</span>
        Ajouter des Rituels
    </button>
    <hr>
    <button class="menu-item" onclick="openPauseModal()">
        <span class="menu-icon">⏸️</span>
        Mettre l'abonnement en pause
    </button>
    <hr>
    <button class="menu-item" onclick="openTransferModal()">
        <span class="menu-icon">🔀</span>
        Transférer le solde ou un abonnement
    </button>
</div>

<style>
.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 24px;
    font-size: 1rem;
    font-weight: 500;
    color: #1e40af;
    background: none;
    border: none;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}
.menu-item:hover {
    background: #f3e8ff;
    color: #7c3aed;
}
.menu-icon {
    font-size: 1.4rem;
    color: #7c3aed;
}
hr {
    border: none;
    border-top: 1px solid #eee;
    margin: 0;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px);}
    to { opacity: 1; transform: translateY(0);}
}
</style>
