{{-- Sidebar supprimée (doublon avec la navigation horizontale en haut) --}}
<style>
  /* Masquer la sidebar dans tous les onglets */
  .sidebar { display: none !important; }
  /* Passer le grid sur 1 colonne (100%) dans tous les onglets */
  .dashboard-container {
    grid-template-columns: 1fr !important;
    gap: 0 !important;
  }
  .main-content {
    grid-column: 1 !important;
    padding-right: 2cm !important;
  }
</style>
