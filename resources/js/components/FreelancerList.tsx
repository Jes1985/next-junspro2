import React, { useState, useMemo, useCallback } from "react";
import { FreelancerCard, Freelancer } from "./FreelancerCard";
import { Pagination } from "./Pagination";

const mockFreelancers: Freelancer[] = [
  {
    id: 1,
    firstName: "Maxence",
    lastName: "Berger",
    countryName: "France",
    countryCode: "FR",
    countryFlag: "🇫🇷",
    avatarUrl:
      "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80",
    initials: "MB",
    role: "Freelance expert",
    headline: "Freelance expert en développement web et design.",
    about: "Freelance expert en développement web & design — spécialisé en sites de lancement, tunnels de vente et automatisation pour coachs & infopreneurs. Plus de 5 ans d'expérience dans le développement web et le design.",
    languages: [
      { name: "Français", level: "Natif" },
      { name: "Anglais", level: "C1 avancé" },
    ],
    popularityLabel: "Très populaire. 39 réservations récentes.",
    hourlyRate: 65,
    priceLabel: "par heure",
    rating: 4.9,
    reviewsCount: 43,
    stats: { delivered: 36, recurring: 12 },
    isOnline: true,
    lastSeenAt: new Date().toISOString(),
    isTopFreelancer: true,
    isVerified: true,
    video: {
      thumbnailUrl:
        "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80",
    },
  },
  {
    id: 2,
    firstName: "Cléa",
    lastName: "Lefebvre",
    countryName: "France",
    countryCode: "FR",
    countryFlag: "🇫🇷",
    initials: "CL",
    role: "Freelance expert",
    headline: "Anglais professionnel, juridique et business.",
    about: "Anglais professionnel, juridique et business avec une avocate britannique — gagnez en confiance et crédibilité.",
    languages: [
      { name: "Français", level: "Natif" },
      { name: "Anglais", level: "Natif" },
    ],
    popularityLabel: "Populaire. 5 réservations récentes.",
    hourlyRate: 41,
    priceLabel: "cours de 50 min",
    rating: 5,
    reviewsCount: 13,
    stats: { delivered: 182, recurring: 13 },
    isOnline: false,
    lastSeenAt: new Date(Date.now() - 8 * 60 * 60 * 1000).toISOString(),
    isVerified: true,
    video: {
      thumbnailUrl:
        "https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80",
    },
  },
  {
    id: 3,
    firstName: "Sophie",
    lastName: "Martin",
    countryName: "France",
    countryCode: "FR",
    countryFlag: "🇫🇷",
    avatarUrl:
      "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80",
    initials: "SM",
    role: "Freelance expert",
    headline: "Expert en marketing digital et stratégie de contenu.",
    about: "Expert en marketing digital et stratégie de contenu — spécialisée dans l'accompagnement des startups et PME pour développer leur présence en ligne.",
    languages: [
      { name: "Français", level: "Natif" },
      { name: "Anglais", level: "C2" },
      { name: "Espagnol", level: "B2" },
    ],
    popularityLabel: "Très populaire. 52 réservations récentes.",
    hourlyRate: 55,
    priceLabel: "par heure",
    rating: 4.8,
    reviewsCount: 67,
    stats: { delivered: 48, recurring: 18 },
    isOnline: true,
    lastSeenAt: new Date(Date.now() - 30 * 60 * 1000).toISOString(),
    isTopFreelancer: true,
    isVerified: true,
    video: {
      thumbnailUrl:
        "https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80",
    },
  },
  // Ajout de plus de freelances mock pour tester la pagination
  ...Array.from({ length: 17 }, (_, i) => ({
    id: i + 4,
    firstName: `Emma`,
    lastName: String.fromCharCode(65 + (i % 26)) + ".",
    countryName: "France",
    countryCode: "FR",
    countryFlag: "🇫🇷",
    initials: `E${String.fromCharCode(65 + (i % 26))}`,
    role: "Freelance expert",
    headline: "Expert en développement et design.",
    about: `Expert en développement et design — spécialisé dans les solutions web modernes pour entreprises. Plus de ${3 + i} ans d'expérience.`,
    languages: [
      { name: "Français", level: "Natif" },
      { name: "Anglais", level: "C1 avancé" },
    ],
    popularityLabel: `Populaire. ${Math.floor(Math.random() * 20)} réservations récentes.`,
    hourlyRate: Math.floor(Math.random() * 50) + 30,
    priceLabel: "par heure",
    rating: Number((Math.random() * 1.5 + 4).toFixed(1)),
    reviewsCount: Math.floor(Math.random() * 50) + 10,
    stats: {
      delivered: Math.floor(Math.random() * 100) + 10,
      recurring: Math.floor(Math.random() * 20) + 5,
    },
    isOnline: Math.random() > 0.5,
    lastSeenAt: new Date(Date.now() - Math.random() * 7 * 24 * 60 * 60 * 1000).toISOString(),
    isVerified: Math.random() > 0.5,
    video: {
      thumbnailUrl:
        "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80",
    },
  } as Freelancer)),
];

const FREELANCERS_PER_PAGE = 10;

export const FreelancerList: React.FC = () => {
  const [currentPage, setCurrentPage] = useState(1);
  // État pour gérer la position de la vidéo pour chaque freelance (par défaut alternance gauche/droite)
  const [videoPositions, setVideoPositions] = useState<Record<string | number, "left" | "right">>(() => {
    const positions: Record<string | number, "left" | "right"> = {};
    mockFreelancers.forEach((f, idx) => {
      positions[f.id] = idx % 2 === 0 ? "left" : "right";
    });
    return positions;
  });

  // Calculer la pagination
  const totalFreelancers = mockFreelancers.length;
  const totalPages = Math.ceil(totalFreelancers / FREELANCERS_PER_PAGE);

  // Filtrer les freelances pour la page courante
  const paginatedFreelancers = useMemo(() => {
    const startIndex = (currentPage - 1) * FREELANCERS_PER_PAGE;
    const endIndex = startIndex + FREELANCERS_PER_PAGE;
    return mockFreelancers.slice(startIndex, endIndex);
  }, [currentPage]);

  const handlePageChange = (page: number) => {
    setCurrentPage(page);
    // Scroll to top on page change
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  // Handler pour changer la position de la vidéo
  const handleVideoPositionChange = useCallback((freelancerId: string | number, position: "left" | "right") => {
    setVideoPositions((prev) => ({
      ...prev,
      [freelancerId]: position,
    }));
  }, []);

  // Handler pour réserver une séance d'essai
  const handleBookTrial = useCallback((freelancer: Freelancer) => {
    if (!freelancer?.id) return;
    window.location.href = `/freelance/${freelancer.id}`;
  }, []);

  // Handler pour envoyer un message
  const handleContactFreelancer = useCallback((freelancer: Freelancer) => {
    if (!freelancer?.id) return;
    window.location.href = `/freelance/${freelancer.id}`;
  }, []);

  // Handler pour voir l'agenda
  const handleViewAgenda = useCallback((freelancer: Freelancer) => {
    if (!freelancer?.id) return;
    window.location.href = `/freelance/${freelancer.id}#agenda`;
  }, []);

  // Handler pour voir le profil
  const handleViewProfile = useCallback((freelancer: Freelancer) => {
    if (!freelancer?.id) return;
    window.location.href = `/freelance/${freelancer.id}`;
  }, []);

  // Handler pour "En savoir plus"
  const handleShowMore = useCallback((freelancer: Freelancer) => {
    if (!freelancer?.id) return;
    window.location.href = `/freelance/${freelancer.id}`;
  }, []);

  return (
    <div className="freelancers-list-wrapper flex flex-col w-full max-w-full" style={{ 
      position: 'relative', 
      zIndex: 1,
      isolation: 'isolate' // Isolation pour éviter les effets de bord sur le hero
    }}>
      {/* Liste des cartes freelances */}
      <div className="freelancers-grid gap-6 w-full max-w-full">
        {paginatedFreelancers.map((freelancer, idx) => (
          <FreelancerCard
            key={`${freelancer.firstName}-${(currentPage - 1) * FREELANCERS_PER_PAGE + idx}`}
            freelancer={{
              ...freelancer,
              video: freelancer.video ? {
                thumbnailUrl: freelancer.video.thumbnailUrl,
                videoUrl: freelancer.video.videoUrl,
                onViewAgenda: () => handleViewAgenda(freelancer),
                onViewProfile: () => handleViewProfile(freelancer),
                onPlayVideo: () => handleViewProfile(freelancer),
              } : undefined
            }}
            videoPosition={videoPositions[freelancer.id] || "right"}
            onVideoPositionChange={(position) => handleVideoPositionChange(freelancer.id, position)}
            onPrimaryAction={handleBookTrial}
            onContact={handleContactFreelancer}
            onShowMore={handleShowMore}
          />
        ))}
      </div>

      {/* Pagination */}
      <Pagination
        currentPage={currentPage}
        totalPages={totalPages}
        onPageChange={handlePageChange}
      />
    </div>
  );
};
