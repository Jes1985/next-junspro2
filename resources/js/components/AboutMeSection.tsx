import React, { useState, useMemo, useRef, useEffect } from "react";
import { Languages } from "lucide-react";

type AboutMeSectionProps = {
  title?: string;
  bio: string;
  originalBio?: string; // Texte original si traduit
  isTranslated?: boolean;
  maxLines?: number; // Nombre de lignes max avant troncature (défaut: 4-5 lignes)
  onShowOriginal?: () => void;
};

export const AboutMeSection: React.FC<AboutMeSectionProps> = ({
  title = "À propos de moi",
  bio,
  originalBio,
  isTranslated = false,
  maxLines = 4,
  onShowOriginal,
}) => {
  const [isExpanded, setIsExpanded] = useState(false);
  const [showOriginal, setShowOriginal] = useState(false);
  const textRef = useRef<HTMLParagraphElement>(null);
  const [shouldTruncate, setShouldTruncate] = useState(false);

  // Afficher le texte original ou traduit
  const displayBio = showOriginal && originalBio ? originalBio : bio;

  // Vérifier si le texte doit être tronqué en mesurant la hauteur réelle
  useEffect(() => {
    if (textRef.current) {
      const lineHeight = parseFloat(
        window.getComputedStyle(textRef.current).lineHeight
      );
      const maxHeight = lineHeight * maxLines;
      const actualHeight = textRef.current.scrollHeight;
      setShouldTruncate(actualHeight > maxHeight);
    }
  }, [displayBio, maxLines]);

  const handleToggleOriginal = () => {
    setShowOriginal(!showOriginal);
    onShowOriginal?.();
  };

  // Si pas de bio, afficher un message
  if (!bio || bio.trim() === "") {
    return (
      <div className="mb-4 rounded-2xl bg-white p-8 shadow-sm" style={{ border: "none" }}>
        <h2 className="mb-4 text-left text-[28px] font-bold leading-tight tracking-tight text-slate-900">
          {title}
        </h2>
        <p className="text-base leading-relaxed text-slate-600">
          Aucune présentation disponible pour le moment.
        </p>
      </div>
    );
  }

  return (
    <div
      className="mb-4 rounded-2xl bg-white p-8 shadow-sm transition-shadow hover:shadow-md"
      style={{
        border: "none",
        borderRadius: "16px",
        boxShadow: "0 1px 3px rgba(0, 0, 0, 0.05)",
      }}
    >
      {/* Titre principal - H2, gros, gras, aligné à gauche (style Preply) */}
      <h2
        className="mb-4 text-left font-bold leading-tight tracking-tight text-slate-900"
        style={{
          fontSize: "28px",
          fontWeight: 700,
          color: "#202020",
          lineHeight: 1.2,
          marginBottom: "16px",
          marginTop: 0,
          textAlign: "left",
          fontFamily:
            "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif",
          letterSpacing: "-0.02em",
        }}
      >
        {title}
      </h2>

      {/* Ligne Traduction - discrète, sous le titre (comme Preply) */}
      {isTranslated && originalBio && (
        <div
          className="mb-4 flex items-center gap-2"
          style={{
            fontSize: "13px",
            color: "var(--junspro-text-light, #6B7280)",
            marginBottom: "16px",
            marginTop: 0,
          }}
        >
          <Languages
            className="shrink-0"
            style={{ fontSize: "14px", color: "var(--junspro-text-light, #6B7280)" }}
          />
          <span>Traduction</span>
          <span style={{ color: "var(--junspro-text-light, #6B7280)" }}>•</span>
          <button
            type="button"
            onClick={handleToggleOriginal}
            className="font-medium underline transition-colors"
            style={{
              color: "var(--junspro-text, #111827)",
              textDecoration: "underline",
              fontWeight: 500,
              transition: "color 0.2s ease",
              background: "none",
              border: "none",
              padding: 0,
              cursor: "pointer",
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.color = "var(--junspro-primary, #4F46E5)";
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.color = "var(--junspro-text, #111827)";
            }}
          >
            Voir le texte original
          </button>
        </div>
      )}

      {/* Texte de présentation - paragraphe continu, confortable à lire (style Preply) */}
      <div className="text-base leading-relaxed text-slate-900">
        <p
          ref={textRef}
          className="mb-0 whitespace-pre-line"
          style={{
            fontSize: "16px",
            lineHeight: 1.7,
            color: "#202020",
            marginBottom: 0,
            maxWidth: "100%",
            wordWrap: "break-word",
            fontWeight: 400,
            ...(shouldTruncate && !isExpanded
              ? {
                  maxHeight: `${maxLines * 1.7}em`,
                  overflow: "hidden",
                  transition: "max-height 0.4s ease, overflow 0.4s ease",
                }
              : {}),
          }}
        >
          {displayBio}
        </p>

        {/* Lien Voir plus / Voir moins - couleur primaire Junspro (style Preply) */}
        {shouldTruncate && (
          <button
            type="button"
            onClick={() => setIsExpanded(!isExpanded)}
            className="mt-4 block text-base font-medium transition-colors"
            style={{
              color: "var(--junspro-primary, #4F46E5)",
              textDecoration: "none",
              fontSize: "16px",
              fontWeight: 500,
              padding: 0,
              marginTop: "16px",
              border: "none",
              background: "none",
              cursor: "pointer",
              display: "inline-block",
              transition: "color 0.2s ease",
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.color = "var(--junspro-primary-dark, #4338CA)";
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.color = "var(--junspro-primary, #4F46E5)";
            }}
          >
            {isExpanded ? "Voir moins" : "Voir plus"}
          </button>
        )}
      </div>
    </div>
  );
};
