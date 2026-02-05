import React, { useMemo, useState, useEffect, useRef } from "react";
import { ArrowUpRight, Check, Crown, Star, TrendingUp, MessageCircle, Heart, Play } from "lucide-react";
import clsx from "clsx";
import { formatDistanceToNow } from "date-fns";
import { fr } from "date-fns/locale";
import { FreelancerVideoCard } from "./FreelancerVideoCard";

// ============================================
// TYPES
// ============================================

type Language = { 
  name: string; 
  level: string; 
  code?: string;
};

type Badge = { 
  label: string; 
  type?: "top" | "verified" | "new" | "custom"; 
};

type Stats = { 
  delivered: number; // projets livrés
  recurring: number; // clients récurrents
};

export type Freelancer = {
  id: number | string;
  // Identité
  firstName: string;
  lastName?: string; // Pour extraire l'initiale
  countryName?: string; // Ex: "France", "Pakistan"
  countryCode?: string; // Ex: "FR", "PK" pour le drapeau
  countryFlag?: string; // Emoji drapeau direct (ex: "🇫🇷")
  avatarUrl?: string;
  initials?: string; // Fallback si pas d'avatar
  
  // Métier et description
  headline?: string; // Phrase d'accroche courte
  jobTitle?: string; // Ex: "Freelance expert", "Professeur d'anglais"
  role?: string; // Rôle/métier (ex: "Freelance expert")
  about?: string; // Description longue
  
  // Tarification
  hourlyRate?: number; // Tarif horaire en €
  price?: string; // Format affiché (ex: "65 €")
  priceLabel?: string; // Label (ex: "par heure")
  
  // Évaluations et stats
  rating: number; // Note sur 5
  reviewsCount: number; // Nombre d'avis
  stats: Stats;
  
  // Statut
  isOnline?: boolean;
  lastSeenAt?: string; // Date ISO string
  
  // Badges et vérifications
  isTopFreelancer?: boolean;
  isVerified?: boolean;
  badges?: Badge[];
  
  // Popularité
  popularityText?: string; // Ex: "Très populaire. 19 réservations récentes"
  popularityLabel?: string; // Ex: "Très populaire. 11 réservations récentes"
  
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

export type FreelancerCardProps = {
  freelancer: Freelancer;
  videoPosition?: "left" | "right";
  onVideoPositionChange?: (position: "left" | "right") => void;
  onPrimaryAction?: (freelancer: Freelancer) => void; // "Réserver 1h d'essai"
  onContact?: (freelancer: Freelancer) => void; // "Envoyer un message"
  onShowMore?: (freelancer: Freelancer) => void; // "En savoir plus"
  onFavorite?: (freelancer: Freelancer) => void; // Icône cœur
};

// ============================================
// UTILITAIRES
// ============================================

/**
 * Formate le temps écoulé depuis lastSeenAt en français lisible
 * CORRIGE les valeurs négatives et absurdes
 * Exemples: "il y a 5 min", "il y a 2 h", "il y a 3 j"
 */
function formatLastSeen(date?: string, isOnline?: boolean): string {
  if (isOnline) return "En ligne";
  if (!date) return "Hors ligne · vu récemment";
  
  try {
    const lastSeen = new Date(date);
    const now = new Date();
    
    // Vérifier que la date est valide
    if (isNaN(lastSeen.getTime())) {
      return "Hors ligne · vu récemment";
    }
    
    // Si la date est dans le futur, utiliser maintenant
    if (lastSeen > now) {
      return "Hors ligne · vu récemment";
    }
    
    const diffInMs = now.getTime() - lastSeen.getTime();
    const diffInMinutes = Math.abs(Math.floor(diffInMs / 60000));
    
    // Protection contre les valeurs absurdes (> 1 an)
    if (diffInMinutes > 525600) {
      return "Hors ligne · vu il y a longtemps";
    }
    
    // Formatage selon la durée
    if (diffInMinutes < 60) {
      return `Hors ligne · vu il y a ${diffInMinutes} min`;
    } else if (diffInMinutes < 1440) {
      const hours = Math.floor(diffInMinutes / 60);
      return `Hors ligne · vu il y a ${hours} h`;
    } else {
      const days = Math.floor(diffInMinutes / 1440);
      return `Hors ligne · vu il y a ${days} jours`;
    }
  } catch (error) {
    return "Hors ligne · vu récemment";
  }
}

/**
 * Extrait l'initiale du nom de famille
 */
function getLastInitial(lastName?: string): string {
  if (!lastName || lastName.length === 0) return "";
  return lastName.charAt(0).toUpperCase() + ".";
}

/**
 * Génère les initiales à partir du prénom et nom
 */
function getInitials(firstName: string, lastName?: string): string {
  const first = firstName?.charAt(0)?.toUpperCase() || "";
  const last = lastName?.charAt(0)?.toUpperCase() || "";
  return first + last;
}

/**
 * Mapping des codes pays vers les drapeaux emoji
 */
function getCountryFlag(countryCode?: string, countryName?: string): string {
  if (!countryCode && !countryName) return "🌍";
  
  const code = (countryCode || countryName || "").toLowerCase().substring(0, 2);
  
  const flagMap: Record<string, string> = {
    'fr': '🇫🇷', 'en': '🇬🇧', 'gb': '🇬🇧', 'uk': '🇬🇧',
    'us': '🇺🇸', 'es': '🇪🇸', 'de': '🇩🇪', 'it': '🇮🇹',
    'pt': '🇵🇹', 'nl': '🇳🇱', 'be': '🇧🇪', 'ch': '🇨🇭',
    'ca': '🇨🇦', 'au': '🇦🇺', 'pk': '🇵🇰', 'ma': '🇲🇦',
    'tn': '🇹🇳', 'dz': '🇩🇿', 'sn': '🇸🇳', 'ci': '🇨🇮',
    'cm': '🇨🇲', 'cd': '🇨🇩', 'eg': '🇪🇬', 'sa': '🇸🇦'
  };
  
  return flagMap[code] || "🌍";
}

// ============================================
// COMPOSANT PRINCIPAL
// ============================================

export const FreelancerCard: React.FC<FreelancerCardProps> = ({
  freelancer,
  videoPosition = "right",
  onVideoPositionChange,
  onPrimaryAction,
  onContact,
  onShowMore,
  onFavorite,
}) => {
  // États
  const [isHovered, setIsHovered] = useState(false);
  const [showVideo, setShowVideo] = useState(false);
  const [showVideoMobile, setShowVideoMobile] = useState(false); // État séparé pour mobile
  
  const cardRef = useRef<HTMLDivElement>(null);
  
  // Calculs dérivés
  const lastInitial = useMemo(
    () => getLastInitial(freelancer.lastName),
    [freelancer.lastName]
  );
  
  const displayName = useMemo(() => {
    // Format "Prénom N." (ex: "Emma W.")
    return `${freelancer.firstName} ${lastInitial}`.trim();
  }, [freelancer.firstName, lastInitial]);
  
  const initials = useMemo(
    () => freelancer.initials || getInitials(freelancer.firstName, freelancer.lastName),
    [freelancer.initials, freelancer.firstName, freelancer.lastName]
  );
  
  const lastSeenLabel = useMemo(
    () => formatLastSeen(freelancer.lastSeenAt, freelancer.isOnline),
    [freelancer.lastSeenAt, freelancer.isOnline]
  );
  
  // Description tronquée (aperçu max ~2-3 lignes pour la carte)
  const truncatedAbout = useMemo(() => {
    if (!freelancer.about) return "";
    const maxLength = 150; // ~2-3 lignes
    if (freelancer.about.length <= maxLength) return freelancer.about;
    return freelancer.about.substring(0, maxLength).trim() + "...";
  }, [freelancer.about]);
  
  // Badges calculés
  const badges = useMemo(() => {
    const computed: Badge[] = [];
    
    if (freelancer.isTopFreelancer) {
      computed.push({ label: "Super freelance", type: "top" });
    } else if (freelancer.isVerified) {
      computed.push({ label: "Vérifié", type: "verified" });
    }
    
    if (freelancer.badges) {
      computed.push(...freelancer.badges);
    }
    
    return computed;
  }, [freelancer.isTopFreelancer, freelancer.isVerified, freelancer.badges]);
  
  // Ligne métier + pays + drapeau (ex: "Freelance expert · France FR 🇫🇷")
  const jobLine = useMemo(() => {
    const parts: string[] = [];
    const role = freelancer.role || freelancer.jobTitle || "Freelance expert";
    parts.push(role);
    
    if (freelancer.countryName) {
      const countryCode = freelancer.countryCode || freelancer.countryName.substring(0, 2).toUpperCase();
      const flag = freelancer.countryFlag || getCountryFlag(freelancer.countryCode, freelancer.countryName);
      parts.push(`${freelancer.countryName} ${countryCode} ${flag}`);
    }
    
    return parts.join(" · ");
  }, [freelancer.role, freelancer.jobTitle, freelancer.countryName, freelancer.countryCode, freelancer.countryFlag]);
  
  // Affichage de la vidéo au survol (desktop uniquement)
  useEffect(() => {
    // Détecter si on est sur mobile
    const isMobile = window.innerWidth < 1024;
    if (isMobile) return; // Ne pas gérer le survol sur mobile
    
    let timeoutId: NodeJS.Timeout;
    if (isHovered && freelancer.video) {
      timeoutId = setTimeout(() => setShowVideo(true), 150);
    } else {
      setShowVideo(false);
    }
    return () => {
      if (timeoutId) clearTimeout(timeoutId);
    };
  }, [isHovered, freelancer.video]);
  
  // Formatage du prix
  const priceDisplay = freelancer.price || (freelancer.hourlyRate ? `${Math.round(freelancer.hourlyRate)} €` : "Sur devis");
  const priceLabelDisplay = freelancer.priceLabel || "par heure";
  
  // Popularité (utiliser popularityLabel si disponible, sinon popularityText)
  const popularityDisplay = freelancer.popularityLabel || freelancer.popularityText || "";
  
  return (
    <div
      ref={cardRef}
      className="freelancer-card group relative w-full"
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      style={{ 
        position: 'relative', 
        display: 'flex',
        overflow: 'visible',
        maxWidth: '100%',
        margin: '0 auto 24px',
        isolation: 'isolate' // Isolation pour éviter les effets de bord
      }}
    >
      {/* ============================================
          WRAPPER DU CONTENU - Limite la largeur pour réserver l'espace pour la vidéo
          ============================================ */}
      {/* Bouton vidéo pour mobile (afficher la carte vidéo) */}
      {freelancer.video && (
        <button
          className="lg:hidden absolute top-4 right-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 shadow-lg backdrop-blur-sm transition hover:bg-white hover:shadow-xl"
          onClick={() => setShowVideoMobile(!showVideoMobile)}
          aria-label={`Voir la vidéo de présentation de ${freelancer.firstName}`}
        >
          <Play className="h-5 w-5 text-junspro-600" />
        </button>
      )}
      
      {/* Carte vidéo mobile (modal/overlay) */}
      {freelancer.video && showVideoMobile && (
        <div
          className="lg:hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
          onClick={() => setShowVideoMobile(false)}
        >
          <div
            className="w-full max-w-md"
            onClick={(e) => e.stopPropagation()}
          >
            <FreelancerVideoCard
              freelancer={freelancer}
              position="right"
              onViewAgenda={freelancer.video?.onViewAgenda}
              onViewProfile={freelancer.video?.onViewProfile}
              onPlayVideo={freelancer.video?.onPlayVideo}
            />
          </div>
        </div>
      )}

      {/* ============================================
          WRAPPER DU CONTENU - Limite la largeur pour réserver l'espace pour la vidéo
          ============================================ */}
      <div 
        className="freelancer-card__content"
        style={{
          display: 'flex',
          alignItems: 'stretch',
          width: '100%',
          maxWidth: 'calc(100% - 360px)', // Réserve ~360px pour la carte vidéo à droite
          marginRight: '1.5rem', // Espace entre la carte et la vidéo
          flex: 1,
          minWidth: 0,
          position: 'relative'
        }}
      >
        {/* ============================================
            CARTE PRINCIPALE FREELANCE
            Layout 3 colonnes : Avatar (~18%) | Centre (~52%) | Droite (~30%)
            ============================================ */}
        <div className="flex w-full flex-col gap-4 rounded-2xl bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-lg lg:flex-row lg:gap-6 lg:p-6">
        
          {/* ============================================
              COLONNE GAUCHE : AVATAR / IDENTITÉ (~18%)
              ============================================ */}
          <div className="freelancer-card__left flex-shrink-0" style={{ flex: '0 0 18%', minWidth: 0 }}>
          {/* Photo/Avatar */}
          <div className="relative h-[120px] w-[120px] lg:h-[140px] lg:w-[140px]">
            <div className="relative h-full w-full overflow-hidden rounded-2xl shadow-md">
              {freelancer.avatarUrl ? (
                <img
                  src={freelancer.avatarUrl}
                  alt={`${displayName}`}
                  className="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                />
              ) : (
                <div
                  className={clsx(
                    "h-full w-full flex items-center justify-center text-white text-3xl font-bold lg:text-4xl",
                    "bg-gradient-to-br from-junspro-700 via-junspro-600 to-junspro-500"
                  )}
                >
                  {initials}
                </div>
              )}
              
              {/* Liseré blanc translucide */}
              <div className="pointer-events-none absolute inset-0 rounded-2xl ring-2 ring-white/80" />
            </div>
            
            {/* Badge qualité (coin supérieur droit) */}
            {badges.length > 0 && (
              <div className="absolute -right-2 -top-2 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-lg ring-2 ring-white">
                {badges[0].type === "top" ? (
                  <Crown className="h-4 w-4 text-amber-500" />
                ) : (
                  <Check className="h-4 w-4 text-emerald-500" />
                )}
              </div>
            )}
            
            {/* Statut en ligne/hors ligne (point en bas à droite) */}
            <div className="absolute -bottom-1 -right-1 z-10">
              <span
                className={clsx(
                  "block h-4 w-4 rounded-full ring-2 ring-white shadow-lg transition lg:h-[16px] lg:w-[16px]",
                  freelancer.isOnline ? "bg-emerald-500 animate-pulse" : "bg-slate-400"
                )}
                title={lastSeenLabel}
              />
            </div>
          </div>
          
          {/* Texte du statut en ligne/hors ligne (sous l'avatar) */}
          <div className="mt-3 flex items-center gap-2 text-xs font-medium text-slate-600 lg:text-sm">
            <span
              className={clsx(
                "block h-2 w-2 rounded-full",
                freelancer.isOnline ? "bg-emerald-500" : "bg-slate-400"
              )}
            />
            <span>{lastSeenLabel}</span>
          </div>
        </div>

          {/* ============================================
              COLONNE CENTRE : INFOS (~52%)
              ============================================ */}
          <div className="freelancer-card__main flex min-w-0 flex-col gap-2.5" style={{ flex: '1 1 52%', minWidth: 0, marginRight: '1.5rem' }}>
          {/* Nom + Initiale (ex: "Emma W.") */}
          <div className="flex items-center gap-2 flex-wrap">
            <h3 className="text-lg font-bold text-slate-900 lg:text-xl">
              {displayName}
            </h3>
            {freelancer.isVerified && (
              <Check className="h-4 w-4 text-emerald-500 shrink-0" />
            )}
          </div>
          
          {/* Ligne métier + pays + drapeau (ex: "Freelance expert · France FR 🇫🇷") */}
          {jobLine && (
            <div className="text-sm font-medium text-slate-700 lg:text-base">
              {jobLine}
            </div>
          )}
          
          {/* Phrase d'accroche (headline) */}
          {freelancer.headline && (
            <p className="text-sm font-semibold text-slate-900 lg:text-base">
              {freelancer.headline}
            </p>
          )}
          
          {/* Popularité */}
          {popularityDisplay && (
            <div className="flex items-center gap-1.5 text-xs text-slate-700 lg:gap-2 lg:text-sm">
              <TrendingUp className="h-3.5 w-3.5 shrink-0 text-emerald-500 lg:h-4 lg:w-4" />
              <span className="font-medium">{popularityDisplay}</span>
            </div>
          )}
          
          {/* Description : uniquement un aperçu court (3 lignes max).
              Le texte complet sera consulté sur la page profil via « En savoir plus ». */}
          {freelancer.about && (
            <div className="space-y-1">
              <p
                className={clsx(
                  "text-xs leading-relaxed text-slate-700 lg:text-sm line-clamp-3"
                )}
              >
                {truncatedAbout}
              </p>
            </div>
          )}
          
          {/* Lien "En savoir plus" (aligné à gauche) */}
          {onShowMore && (
            <button
              type="button"
              onClick={() => onShowMore?.(freelancer)}
              className="flex w-fit items-center gap-1 text-xs font-semibold text-junspro-600 transition hover:text-junspro-700 hover:underline lg:text-sm lg:gap-1.5"
            >
              En savoir plus <ArrowUpRight className="h-3 w-3 lg:h-3.5 lg:w-3.5" />
            </button>
          )}
          
          {/* Langues parlées */}
          {freelancer.languages && freelancer.languages.length > 0 && (
            <div className="text-xs font-medium text-slate-800 lg:text-sm">
              Parle : {freelancer.languages
                .slice(0, 2)
                .map((l) => `${l.name}${l.level ? ` (${l.level})` : ""}`)
                .join(", ")}
              {freelancer.languages.length > 2 && ` +${freelancer.languages.length - 2}`}
            </div>
          )}
          </div>

          {/* ============================================
              COLONNE DROITE : TARIF / STATS / CTA (~30%)
              ============================================ */}
          <div className="freelancer-card__right flex w-full flex-col gap-3 border-l-0 border-t border-slate-200 pt-3 lg:shrink-0 lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0" style={{ flex: '0 0 30%', minWidth: 0 }}>
          {/* Prix + Favoris (header aligné à droite) */}
          <div className="flex items-start justify-between gap-2">
            <div className="flex-1">
              <div className="text-2xl font-bold text-slate-900 lg:text-3xl">{priceDisplay}</div>
              <div className="mt-0.5 text-xs font-medium text-slate-600 lg:text-sm">{priceLabelDisplay}</div>
            </div>
            {/* Icône Favoris (en haut à droite, jamais par-dessus le prix) */}
            {onFavorite && (
              <button
                onClick={() => onFavorite?.(freelancer)}
                className="p-1.5 text-slate-400 transition hover:text-red-500 hover:scale-110 shrink-0"
                aria-label="Ajouter aux favoris"
                title="Ajouter aux favoris"
              >
                <Heart className="h-5 w-5" />
              </button>
            )}
          </div>

          {/* Note + Avis sur une ligne */}
          <div className="flex items-center gap-1.5 text-xs font-semibold text-slate-800 lg:text-sm">
            <span>{freelancer.rating.toFixed(1)}</span>
            <Star className="h-3.5 w-3.5 fill-amber-400 text-amber-400 lg:h-4 lg:w-4" />
            <span className="text-slate-600">
              {freelancer.reviewsCount} {freelancer.reviewsCount > 1 ? "avis" : "avis"}
            </span>
          </div>

          {/* Stats projets : 2 colonnes alignées */}
          <div className="grid grid-cols-2 gap-2">
            <div className="rounded-lg bg-slate-50 p-2 text-center">
              <div className="text-xl font-bold text-slate-900">{freelancer.stats.delivered}</div>
              <div className="mt-0.5 text-xs font-medium text-slate-600">projets livrés</div>
            </div>
            <div className="rounded-lg bg-slate-50 p-2 text-center">
              <div className="text-xl font-bold text-slate-900">{freelancer.stats.recurring}</div>
              <div className="mt-0.5 text-xs font-medium text-slate-600">clients récurrents</div>
            </div>
          </div>

          {/* Bouton CTA principal (dégradé violet Junspro) */}
          <div className="mt-auto">
            <button
              onClick={() => onPrimaryAction?.(freelancer)}
              disabled={!freelancer?.id}
              className={clsx(
                "w-full rounded-xl px-3 py-2.5 text-xs font-semibold text-white shadow-md transition-all duration-200 hover:shadow-lg hover:brightness-105 lg:text-sm lg:px-4 lg:py-3",
                "bg-gradient-to-r from-junspro-600 via-junspro-500 to-junspro-400",
                !freelancer?.id && "cursor-not-allowed opacity-50"
              )}
            >
              Réserver 1h d'essai
            </button>
          </div>

          {/* Bouton secondaire "Envoyer un message" */}
          <button
            onClick={() => onContact?.(freelancer)}
            disabled={!freelancer?.id}
            className={clsx(
              "flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-800 transition hover:border-slate-300 hover:bg-slate-50 lg:gap-2 lg:px-4 lg:py-2.5 lg:text-sm",
              !freelancer?.id && "cursor-not-allowed opacity-50"
            )}
          >
            <MessageCircle className="h-3.5 w-3.5 lg:h-4 lg:w-4" />
            Envoyer un message
          </button>
          </div>
        </div>
        {/* ============================================
            CARTE VIDÉO (positionnée à droite du wrapper de contenu, dans l'espace réservé)
            S'ouvre au survol (desktop) ou au clic (mobile)
            ============================================ */}
        {freelancer.video && (
          <div
            className={clsx(
              "hidden lg:block absolute z-50 transition-all duration-300 ease-out freelancer-video-card freelancer-video-card--right",
              showVideo && isHovered
                ? "opacity-100 translate-x-0 pointer-events-auto"
                : "opacity-0 translate-x-4 pointer-events-none"
            )}
            style={{
              top: '50%',
              transform: showVideo && isHovered 
                ? 'translateY(-50%) translateX(0)' 
                : 'translateY(-50%) translateX(10px)',
              left: '100%', // Position à droite du wrapper de contenu (pas de la carte complète)
              marginLeft: '1.5rem', // Espace entre le wrapper de contenu et la vidéo
              zIndex: 10
            }}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
          >
            <FreelancerVideoCard
              freelancer={freelancer}
              position="right"
              onViewAgenda={freelancer.video?.onViewAgenda}
              onViewProfile={freelancer.video?.onViewProfile}
              onPlayVideo={freelancer.video?.onPlayVideo}
            />
          </div>
        )}
      </div>
      {/* Fin du wrapper de contenu */}
      
    </div>
  );
};
