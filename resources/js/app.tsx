import React from 'react';
import { createRoot } from 'react-dom/client';
import { FreelancerList } from './components/FreelancerList';

// Initialiser React quand le DOM est prêt
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('freelancers-root');
  if (container) {
    const root = createRoot(container);
    root.render(
      <React.StrictMode>
        <FreelancerList />
      </React.StrictMode>
    );
  }
});


