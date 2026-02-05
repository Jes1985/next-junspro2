import React, { useState, useRef, useEffect } from 'react';

interface PourQuiJunsproProps {
  initialParagraph: string;
  extendedContent: {
    secondParagraph: string;
    bulletPoints: string[];
  };
}

const PourQuiJunspro: React.FC<PourQuiJunsproProps> = ({
  initialParagraph,
  extendedContent,
}) => {
  const [isExpanded, setIsExpanded] = useState<boolean>(false);
  const detailsRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (detailsRef.current) {
      if (isExpanded) {
        detailsRef.current.style.maxHeight = detailsRef.current.scrollHeight + 'px';
        detailsRef.current.style.opacity = '1';
        detailsRef.current.style.marginBottom = '1.5rem';
      } else {
        detailsRef.current.style.maxHeight = '0';
        detailsRef.current.style.opacity = '0';
        detailsRef.current.style.marginBottom = '0';
      }
    }
  }, [isExpanded]);

  const toggleContent = () => {
    setIsExpanded(!isExpanded);
  };

  return (
    <div style={{ maxWidth: '800px', marginLeft: 'auto', marginRight: 'auto' }}>
      <p
        className="mb-3"
        style={{
          fontSize: '1.2rem',
          lineHeight: '1.8',
          color: '#ffffff',
        }}
      >
        {initialParagraph}
      </p>

      <button
        type="button"
        onClick={toggleContent}
        aria-expanded={isExpanded}
        aria-controls="junspro-pour-qui-details"
        style={{
          background: 'none',
          border: 'none',
          color: '#8B5CF6',
          fontSize: '1rem',
          cursor: 'pointer',
          padding: 0,
          marginBottom: '1rem',
          textDecoration: 'underline',
          textDecorationColor: isExpanded ? '#8B5CF6' : 'transparent',
          transition: 'text-decoration-color 0.2s ease',
        }}
        onMouseEnter={(e) => {
          if (!isExpanded) {
            e.currentTarget.style.textDecorationColor = '#8B5CF6';
          }
        }}
        onMouseLeave={(e) => {
          if (!isExpanded) {
            e.currentTarget.style.textDecorationColor = 'transparent';
          }
        }}
      >
        {isExpanded ? 'Voir moins' : 'Voir plus'}
      </button>

      <div
        id="junspro-pour-qui-details"
        ref={detailsRef}
        aria-hidden={!isExpanded}
        style={{
          maxHeight: 0,
          overflow: 'hidden',
          opacity: 0,
          transition: 'max-height 0.3s ease, opacity 0.3s ease, margin-bottom 0.3s ease',
          marginBottom: 0,
        }}
      >
        <p
          className="mb-3"
          style={{
            fontSize: '1.1rem',
            lineHeight: '1.8',
            color: '#ffffff',
          }}
        >
          {extendedContent.secondParagraph}
        </p>
        <div className="mb-5" style={{ textAlign: 'left' }}>
          {extendedContent.bulletPoints.map((point, index) => (
            <p
              key={index}
              style={{
                fontSize: '1.2rem',
                lineHeight: '1.8',
                color: '#ffffff',
                marginBottom: index < extendedContent.bulletPoints.length - 1 ? '1rem' : 0,
              }}
            >
              {point}
            </p>
          ))}
        </div>
      </div>
    </div>
  );
};

export default PourQuiJunspro;
