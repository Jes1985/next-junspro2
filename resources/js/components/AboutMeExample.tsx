import React from "react";
import { AboutMeSection } from "./AboutMeSection";

/**
 * Exemple d'utilisation du composant AboutMeSection
 * Reproduit exactement le design de la capture d'écran
 */
export const AboutMeExample: React.FC = () => {
  // Exemple de bio (comme dans la capture d'écran)
  const bio = `Bonjour, je suis Eman. Championne nationale de débat et présidente de la société littéraire anglaise, avec plus de 800 heures de lecture et plus de 1000 heures d'enseignement, je vous aiderai à embellir vos compétences en expression orale, compréhension et lecture, que ce soit pour les SAT ou pour des conversations quotidiennes. De plus, si vous souhaitez améliorer vos compétences en écriture ou vos compétences en présentation, je serai là pour vous accompagner.`;

  // Texte original (exemple si traduit)
  const originalBio = `Hello, I am Eman. National debate champion and president of the English literary society, with over 800 hours of reading and over 1000 hours of teaching, I will help you embellish your skills in oral expression, comprehension, and reading, whether for the SATs or for daily conversations. Furthermore, if you wish to improve your writing skills or your presentation skills, I will be there to support you.`;

  return (
    <div className="container mx-auto max-w-4xl px-4 py-8">
      <AboutMeSection
        title="À propos de moi"
        bio={bio}
        originalBio={originalBio}
        isTranslated={true}
        maxLines={4}
        onShowOriginal={() => {
          console.log("Afficher le texte original");
        }}
      />
    </div>
  );
};

































