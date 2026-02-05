# Documentation : Composants FreelancerCard et FreelancerVideoCard

## Vue d'ensemble

Refonte complète des composants de carte freelance inspirée de Preply, avec l'identité visuelle Junspro (violet dégradé, arrondis, ombres douces).

## Structure des composants

### 1. FreelancerCard.tsx

Composant principal de la carte freelance avec 3 colonnes :

#### Colonne gauche : Identité
- Photo/Avatar (120x120px sur mobile, 140x140px sur desktop)
- Badge qualité (Top Junspro, Vérifié, Nouveau talent)
- Statut en ligne/hors ligne avec tooltip

#### Colonne centre : Résumé texte
- Nom + Initiale + Drapeau + Badges
- Ligne métier + pays
- Phrase d'accroche (headline)
- Description tronquée avec "Voir plus/Voir moins"
- Lien "En savoir plus"
- Langues parlées
- Popularité avec icône

#### Colonne droite : Tarif / Stats / CTA
- Icône favoris (optionnelle)
- Prix horaire (gros, gras)
- Note + Avis
- Stats (projets livrés, clients récurrents)
- Bouton principal : "Réserver 1h d'essai" (violet dégradé)
- Bouton secondaire : "Envoyer un message" (outline)

### 2. FreelancerVideoCard.tsx

Carte vidéo de présentation qui s'affiche au survol (desktop) ou au clic (mobile).

**Positionnement :**
- Peut être positionnée à gauche ou à droite de la carte principale
- Prop `position: "left" | "right"`
- Ne chevauche jamais la carte principale

**Contenu :**
- Miniature vidéo (ratio 16:9) avec bouton Play au centre
- Titre "Vidéo de présentation"
- Bouton principal : "Lire la vidéo" (violet dégradé)
- Bouton secondaire : "Voir tout l'agenda" (link style)
- Bouton optionnel : "Voir le profil de [Prénom]"

## Types TypeScript

### Freelancer

```typescript
type Freelancer = {
  // Identité
  id: number | string;
  firstName: string;
  lastName: string;
  countryName?: string;
  countryCode?: string;
  countryFlag?: string; // Emoji drapeau
  avatarUrl?: string;
  initials?: string;
  
  // Métier et description
  headline?: string;
  jobTitle?: string;
  about?: string; // Description longue
  
  // Tarification
  hourlyRate?: number;
  price?: string;
  priceLabel?: string;
  
  // Évaluations
  rating: number;
  reviewsCount: number;
  stats: { delivered: number; recurring: number };
  
  // Statut
  isOnline?: boolean;
  lastSeenAt?: string;
  
  // Badges
  isTopFreelancer?: boolean;
  isVerified?: boolean;
  badges?: Badge[];
  
  // Popularité
  popularityText?: string;
  
  // Langues
  languages?: Language[];
  
  // Vidéo
  video?: {
    thumbnailUrl?: string;
    videoUrl?: string;
    onViewAgenda?: () => void;
    onViewProfile?: () => void;
    onPlayVideo?: () => void;
  };
};
```

## Utilisation

### Exemple basique

```tsx
import { FreelancerCard } from "./components/FreelancerCard";

const freelancer: Freelancer = {
  id: 1,
  firstName: "Maxence",
  lastName: "Berger",
  countryName: "France",
  countryFlag: "🇫🇷",
  avatarUrl: "https://example.com/avatar.jpg",
  headline: "Freelance expert en développement web et design",
  jobTitle: "Développeur Full Stack",
  about: "Spécialisé dans le développement web moderne avec React, Node.js et TypeScript. Plus de 5 ans d'expérience dans la création d'applications web performantes et scalables...",
  hourlyRate: 65,
  rating: 4.9,
  reviewsCount: 61,
  stats: {
    delivered: 120,
    recurring: 45
  },
  isOnline: true,
  isVerified: true,
  isTopFreelancer: false,
  popularityText: "Très populaire. 19 réservations récentes",
  languages: [
    { name: "Français", level: "Natif" },
    { name: "Anglais", level: "Avancé" }
  ],
  video: {
    thumbnailUrl: "https://example.com/video-thumb.jpg",
    videoUrl: "https://example.com/video.mp4",
    onViewAgenda: () => console.log("Voir agenda"),
    onViewProfile: () => console.log("Voir profil"),
    onPlayVideo: () => console.log("Lire vidéo")
  }
};

<FreelancerCard
  freelancer={freelancer}
  videoPosition="right"
  onVideoPositionChange={(pos) => console.log("Position:", pos)}
  onPrimaryAction={(f) => console.log("Réserver essai", f)}
  onContact={(f) => console.log("Contacter", f)}
  onShowMore={(f) => console.log("En savoir plus", f)}
  onFavorite={(f) => console.log("Favoris", f)}
/>
```

## Fonctionnalités

### 1. Statut en ligne/hors ligne

- Pastille verte si `isOnline === true`
- Pastille grise sinon avec tooltip affichant "vu il y a X min/h/j"
- Formatage automatique en français via `formatDistanceToNow` (date-fns)

### 2. Description tronquée

- Par défaut : 2-3 lignes (150 caractères max)
- Bouton "Voir plus" / "Voir moins" pour développer/réduire
- Géré par un state React local (`isExpanded`)

### 3. Carte vidéo au survol

- Desktop : apparaît au survol avec animation fade + translation
- Mobile : peut être déclenchée par un bouton/icône (à implémenter)
- Positionnement latéral configurable (gauche/droite)
- Ne chevauche jamais la carte principale

### 4. Responsive

- Mobile : colonnes empilées verticalement
- Desktop : 3 colonnes côte à côte
- Carte vidéo : passe en dessous sur petits écrans

## Styles

Les composants utilisent Tailwind CSS avec les couleurs Junspro :

- `junspro-600`, `junspro-500`, `junspro-400` : Dégradé violet pour les CTA
- `junspro-700`, `junspro-600`, `junspro-500` : Dégradé pour les avatars/fallbacks

Les classes Tailwind utilisées :
- `rounded-2xl` : Coins très arrondis
- `shadow-sm`, `shadow-lg` : Ombres douces
- `hover:-translate-y-1` : Légère élévation au survol
- `bg-gradient-to-r from-junspro-600 via-junspro-500 to-junspro-400` : Dégradé violet

## Intégration avec l'API

Si certaines données ne sont pas encore disponibles dans l'API, elles peuvent être mockées côté front :

```typescript
// Exemple de mapping depuis l'API backend
const mapToFreelancer = (apiData: any): Freelancer => ({
  id: apiData.id,
  firstName: apiData.user?.name?.split(' ')[0] || "Freelance",
  lastName: apiData.user?.name?.split(' ').slice(1).join(' ') || "",
  countryName: apiData.user?.country_name || "France",
  countryFlag: getCountryFlag(apiData.user?.country_code), // Fonction utilitaire
  avatarUrl: apiData.user?.photo ? `/assets/admin/img/seller-photo/${apiData.user.photo}` : undefined,
  headline: apiData.freelancer_profile?.headline || "Freelance expert",
  about: apiData.freelancer_profile?.bio || apiData.freelancer_profile?.about || "",
  hourlyRate: apiData.freelancer_profile?.hourly_rate,
  rating: apiData.avg_rating || 0,
  reviewsCount: apiData.reviews_count || 0,
  stats: {
    delivered: apiData.completed_orders || 0,
    recurring: apiData.recurring_clients || 0
  },
  isOnline: apiData.is_online || false,
  lastSeenAt: apiData.last_seen_at,
  isVerified: apiData.user?.is_verified_freelancer || false,
  isTopFreelancer: apiData.user?.is_super_freelancer || false,
  popularityText: `Très populaire. ${apiData.recent_bookings || 0} réservations récentes`,
  languages: apiData.languages || [],
  video: {
    thumbnailUrl: apiData.video_thumbnail_url,
    videoUrl: apiData.video_url
  }
});
```

## Évolutions futures

- Page profil freelance détaillée : réutiliser les mêmes composants
- Favoris : implémenter la logique backend
- Vidéo : intégrer un lecteur vidéo modal
- Mobile : améliorer l'UX de la carte vidéo (drawer/modal)
