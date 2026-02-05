// Exemple d'utilisation du composant PourQuiJunspro

import React from 'react';
import PourQuiJunspro from './PourQuiJunspro';

const PourQuiJunsproExample: React.FC = () => {
  const content = {
    initialParagraph: "Junspro s'adresse aux particuliers, indépendants, petites équipes et PME qui veulent déléguer leurs projets digitaux (site, tunnel, automatisation, marketing, branding…) à des freelances fiables et pédagogues.",
    extendedContent: {
      secondParagraph: "Les missions sont facturées à l'heure, avec à chaque séance un temps dédié au compte-rendu, pour que vous sachiez exactement ce qui a été fait et ce qu'il reste à faire.",
      bulletPoints: [
        "Vous lancez un projet et avez besoin d'un cadre clair.",
        "Vous voulez comprendre les outils pour rester autonome après la mission.",
        "Vous préférez une collaboration humaine et pédagogique plutôt qu'une simple livraison de fichiers.",
      ],
    },
  };

  return (
    <div className="cta-section-modern text-center text-white">
      <div className="cta-content-modern">
        <h2 className="mb-4" style={{ fontSize: '2.5rem', fontWeight: 700 }}>
          Pour qui est fait Junspro?
        </h2>
        <PourQuiJunspro
          initialParagraph={content.initialParagraph}
          extendedContent={content.extendedContent}
        />
        <a
          href="/explore"
          className="btn btn-light btn-lg rounded-pill px-5"
        >
          Trouver mon freelance
          <i className="fas fa-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  );
};

export default PourQuiJunsproExample;
