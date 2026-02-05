/**
 * Sticky Bar - Alpine.js Component
 * Gère l'affichage/masquage de la barre sticky en bas de page
 */
function stickyBar() {
  return {
    isVisible: false,
    scrollThreshold: 0.4, // 40% de la page

    init() {
      // Écouter le scroll
      window.addEventListener('scroll', () => {
        this.handleScroll();
      });

      // Vérifier au chargement
      this.handleScroll();
    },

    handleScroll() {
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      
      const scrollPercentage = scrollTop / (documentHeight - windowHeight);
      
      // Afficher si on a scrollé plus de 40% et qu'on n'est pas trop proche du footer
      const footer = document.querySelector('footer');
      const footerTop = footer ? footer.offsetTop : documentHeight;
      const distanceToFooter = footerTop - (scrollTop + windowHeight);
      
      // Afficher si scroll > 40% et qu'on est à plus de 100px du footer
      if (scrollPercentage > this.scrollThreshold && distanceToFooter > 100) {
        this.isVisible = true;
      } else {
        this.isVisible = false;
      }
    }
  };
}

