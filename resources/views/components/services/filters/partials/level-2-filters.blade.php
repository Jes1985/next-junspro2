{{-- Niveau 2 "Affiner la recherche" : Domaine V1 (5 domaines premium), Spécialisation, Secteur (universe=projects) --}}
@if(!empty($categories) && !($hideDomainSpec ?? false))
  @php
    $isCorporatePresenceForDesc = !empty($categories) && isset($categories[0]) && is_array($categories[0]) && isset($categories[0]['slug']) && strpos($categories[0]['slug'], 'experiences-bien-etre') !== false;
    $domainLongDescriptions = ($universe ?? '') === 'lessons' ? [
      'langues' => "Expression, compréhension et fluidité pour progresser vite.",
      'certifications' => "Préparation structurée aux examens et objectifs de score.",
      'soutien-scolaire' => "Méthode, confiance et progression du primaire au lycée.",
      'etudes-superieur' => "Méthodologie, rédaction et réussite universitaire.",
      'tech-outils' => "Compétences numériques pratiques : outils, code, data, IA.",
      'carriere-soft-skills' => "CV, entretiens, communication et compétences professionnelles.",
    ] : (($universe ?? '') === 'at-home' ? [
      'beaute-soins' => "Beauté à domicile, gestes précis et finition impeccable.",
      'massage-relaxation' => "Relâchement profond, récupération et sérénité sur-mesure.",
      'menage-repassage' => "Intérieur net, détails soignés, service discret et fiable.",
      'bien-etre-sport' => "Énergie, mobilité, équilibre : un accompagnement juste et progressif.",
      'accompagnement' => "Soutien du quotidien, présence fiable et organisation sans charge mentale.",
    ] : (($universe ?? '') === 'wellnesslive' ? [
      'cardio-training' => "Endurance, énergie et intensité maîtrisée pour progresser Rituel après Rituel.",
      'renforcement-musculaire' => "Force, tonus et posture : un travail précis, efficace et évolutif.",
      'bien-etre' => "Mobilité, respiration et équilibre : retrouver un corps léger et aligné.",
      'danse' => "Rythme, expression et fluidité : bouger avec grâce et confiance.",
    ] : ($isCorporatePresenceForDesc ? [
      'pause-souffle' => "Un rituel de clarté et de discernement pour revenir à l'essentiel, poser des priorités réalistes et choisir une direction cohérente, avant d'agir.",
      'experiences-bien-etre-serinite' => "Apaiser, recentrer et créer des temps de respiration dans des contextes professionnels et événementiels.",
      'team-building-cohesion-qvt' => "Favoriser la cohésion, la coopération et la qualité relationnelle au sein des organisations.",
      'evenements-vie-celebrations' => "Concevoir des événements privés porteurs de sens et de mémoire.",
      'vitalite-experiences-immersives' => "Soutenir la vitalité, l'énergie et l'engagement corporel par l'expérience vécue.",
      'intervenants-experts-experience-humaine' => "Mobiliser des expertises humaines au service de l'accompagnement individuel et collectif.",
      'partenaires-logistique-evenementielle' => "S'appuyer sur des partenaires fiables pour concevoir et déployer des événements maîtrisés.",
    ] : [
      'strategie-conseil' => "Vision, structuration et décisions à fort enjeu.",
      'marketing-croissance' => "Positionnement, acquisition et développement durable.",
      'tech-produits-digitaux' => "Conception, évolution et performance des solutions digitales.",
      'creation-image-marque' => "Identité, narration et impact de marque.",
      'formation-accompagnement' => "Accompagnement stratégique et transmission ciblée.",
      'type-de-logement' => "Choisissez le type de logement qui correspond à votre recherche d'échange.",
    ])));
  @endphp
  <div class="preply-filter-group">
    <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-folder-open me-2"></i>Domaine</label>
    <div class="domain-dropdown-wrapper">
      <div class="domain-dropdown-trigger" id="domainDropdownTrigger">
        <span class="domain-selected-text" id="domainSelectedText">
          @php
            /**
             * Fonction helper pour normaliser une valeur en string sûre
             */
            if (!function_exists('normalizeValue')) {
              function normalizeValue($item) {
                if (is_string($item)) {
                  return \Illuminate\Support\Str::slug($item);
                }
                if (is_array($item)) {
                  $rawValue = $item['value'] ?? $item['slug'] ?? $item['label'] ?? $item['name'] ?? $item['title'] ?? '';
                  return \Illuminate\Support\Str::slug($rawValue);
                }
                return '';
              }
            }
            if (!function_exists('getLabel')) {
              function getLabel($item) {
                if (is_string($item)) {
                  return $item;
                }
                if (is_array($item)) {
                  return $item['label'] ?? $item['name'] ?? $item['title'] ?? '';
                }
                return '';
              }
            }
            $catSlug = request('category');
            $catLabel = 'Tous les domaines';
            if ($catSlug && is_array($categories) && isset($categories[0]['slug'])) {
              foreach ($categories as $c) { 
                $cSlug = normalizeValue($c);
                if ($cSlug === $catSlug) { 
                  $catLabel = getLabel($c); 
                  break; 
                } 
              }
            }
          @endphp
          {{ $catLabel }}
        </span>
        <i class="fas fa-chevron-down domain-arrow" id="domainArrow"></i>
      </div>
      <div class="domain-dropdown-menu domain-dropdown-menu-v1" id="domainDropdownMenu" style="display: none;">
        <div class="domain-option" data-value=""><span>Tous les domaines</span></div>
        @foreach($categories as $cat)
          @php $domainDesc = $cat['description'] ?? ($domainLongDescriptions[$cat['slug'] ?? ''] ?? ''); @endphp
          <div class="domain-option" data-value="{{ $cat['slug'] ?? '' }}">
            <span class="domain-option-label">{{ $cat['label'] ?? '' }}</span>
            @if(!empty($domainDesc))
              <span class="domain-option-desc">{{ $domainDesc }}</span>
            @endif
          </div>
        @endforeach
      </div>
      <input type="hidden" name="category" id="domainInput" value="{{ request('category') }}">
    </div>
    {{-- Micro-description premium sous le filtre Domaine (affiché uniquement lorsqu'un domaine est sélectionné) --}}
    <div id="domainPremiumDesc" class="domain-premium-desc" style="display: none;" aria-live="polite" data-domain-descriptions='@json($domainLongDescriptions)'>
      <span class="domain-premium-desc-icon" aria-hidden="true">✦</span>
      <span id="domainPremiumDescText"></span>
    </div>
  </div>
  <script>
    window.__domainLongDescriptions = @json($domainLongDescriptions);
  </script>
@endif

@if(($config['showSpecialization'] ?? false) && !($hideDomainSpec ?? false))
  @php
    // Détecter si on est sur Corporate/Présence via les slugs des domaines
    $isCorporatePresence = !empty($categories) && isset($categories[0]) && is_array($categories[0]) && isset($categories[0]['slug']) && strpos($categories[0]['slug'], 'experiences-bien-etre') !== false;
    
    if (!isset($domainSpecializations)) {
      $domainSpecializations = $isCorporatePresence ? [
        'pause-souffle' => [
          ['clarte_priorites', 'Clarté & priorités'],
          ['transition_vie', 'Transition de vie'],
          ['equilibre_charge_mentale', 'Équilibre & charge mentale'],
          ['rythme_discipline_douce', 'Rythme & discipline douce'],
          ['leadership_decision', 'Leadership & décision'],
          ['dimension_spirituelle', 'Dimension spirituelle'],
        ],
        'experiences-bien-etre-serinite' => [
          ['massage_amma_entreprise', 'Massage amma assis (entreprise)'],
          ['massage_amma_evenement', 'Massage amma assis (événement)'],
          ['journee_bien_etre_entreprise', 'Journée bien-être en entreprise'],
          ['pauses_bien_etre_site', 'Pauses bien-être sur site'],
          ['espace_bien_etre_evenementiel', 'Espace bien-être événementiel'],
        ],
        'team-building-cohesion-qvt' => [
          ['team_building_presentiel', 'Team building en présentiel'],
          ['journee_qvt', 'Journée QVT'],
          ['cohesion_equipe', 'Cohésion d\'équipe'],
          ['seminaire_entreprise', 'Séminaire d\'entreprise'],
          ['temps_collectifs_encadres', 'Temps collectifs encadrés'],
        ],
        'evenements-vie-celebrations' => [
          ['evjf', 'EVJF'],
          ['evg', 'EVG'],
          ['preparation_mariage', 'Préparation mariage'],
          ['anniversaire', 'Anniversaire'],
          ['evenement_familial_prive', 'Événement familial privé'],
        ],
        'vitalite-experiences-immersives' => [
          ['journee_vitalite', 'Journée vitalité'],
          ['pilates_groupe', 'Pilates en groupe'],
          ['yoga_groupe', 'Yoga en groupe'],
          ['atelier_posture_prevention', 'Atelier posture & prévention'],
          ['programme_vitalite', 'Programme vitalité'],
        ],
        'intervenants-experts-experience-humaine' => [
          ['praticien_massage_amma', 'Praticien massage amma'],
          ['professeur_pilates', 'Professeur Pilates'],
          ['professeur_yoga', 'Professeur yoga'],
          ['animateur_ateliers', 'Animateur d\'ateliers'],
          ['conferencier', 'Conférencier'],
          ['accompagnement_sagesse_vie', 'Accompagnement en sagesse de vie'],
        ],
        'partenaires-logistique-evenementielle' => [
          ['location_salle', 'Location de salle'],
          ['traiteur_evenementiel', 'Traiteur événementiel'],
          ['personnel_evenementiel', 'Personnel événementiel'],
          ['son_audiovisuel', 'Son & audiovisuel'],
          ['decoration_evenementielle', 'Décoration événementielle'],
          ['direction_projet_evenementiel', 'Direction de projet événementiel'],
        ],
      ] : [
        'strategie-conseil' => [
          ['conseil_strategique', 'Conseil stratégique'],
          ['business_plan_modelisation', 'Business plan & modélisation'],
          ['etude_de_marche', 'Étude de marché'],
          ['structuration_de_projet', 'Structuration de projet'],
          ['pilotage_gouvernance', 'Pilotage & gouvernance'],
        ],
        'marketing-croissance' => [
          ['strategie_marketing', 'Stratégie marketing'],
          ['branding_positionnement', 'Branding & positionnement'],
          ['acquisition_visibilite', 'Acquisition & visibilité'],
          ['content_marketing', 'Content marketing'],
          ['crm_email_marketing', 'CRM & Email marketing'],
        ],
        'tech-produits-digitaux' => [
          ['developpement_web', 'Développement web'],
          ['nocode_automatisation', 'No-code & automatisation'],
          ['maintenance_optimisation_continue', 'Maintenance & optimisation continue'],
          ['outils_data_ia_appliquee', 'Outils data & IA appliquée (cas d\'usage business)'],
        ],
        'creation-image-marque' => [
          ['design_branding', 'Design & branding'],
          ['ux_ui', 'UX / UI'],
          ['video_motion_design', 'Vidéo & motion design'],
          ['copywriting_strategique', 'Copywriting stratégique'],
        ],
        'formation-accompagnement' => [
          ['coaching_professionnel', 'Coaching professionnel'],
          ['formation_business', 'Formation business (dirigeants & équipes)'],
          ['mentorat_strategique', 'Mentorat stratégique'],
          ['accompagnement_dirigeants', 'Accompagnement dirigeants'],
        ],
        'type-de-logement' => [
          ['chambre', 'Chambre'],
          ['studio', 'Studio'],
          ['appartement', 'Appartement'],
          ['maison', 'Maison'],
          ['penthouse', 'Penthouse'],
          ['autre', 'Autre'],
        ],
      ];
    }
  @endphp
  <div class="preply-filter-advanced" id="specializationFilterWrapper" data-initial-specialization="{{ request('specialization') ?? '' }}" data-domain-specializations='@json($domainSpecializations)' style="display: none;">
    <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-graduation-cap me-2"></i>Spécialisation</label>
    <select name="specialization" id="specializationSelect" class="preply-filter-select">
      <option value="">Spécialisation</option>
    </select>
  </div>
  <script>
    window.__domainSpecializations = @json($domainSpecializations);
  </script>
@endif

@if(($config['showSector'] ?? false) && in_array($universe ?? '', ['projects', 'lessons', 'at-home', 'wellnesslive']))
  <div class="preply-filter-advanced sector-filter-container">
    <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-industry me-2"></i>Univers d'activité</label>
    <div class="sector-dropdown-wrapper">
      <div class="sector-dropdown-trigger" id="sectorDropdownTrigger">
        <span class="sector-selected-text" id="sectorSelectedText">
          @if(request('sector'))
            @php
              $sectorNames = [
                'business_strategie' => 'Business & Stratégie',
                'tech_digital' => 'Tech & Digital',
                'marketing_marques_croissance' => 'Marketing, Marques & Croissance',
                'sante_bien_etre' => 'Santé & Bien-être',
                'impact_culture_societe' => 'Impact, Culture & Société',
                'formation_transmission' => 'Formation & Transmission',
              ];
              $selectedSectorName = $sectorNames[request('sector')] ?? request('sector');
            @endphp
            {{ $selectedSectorName }}
          @else
            Tous les univers d'activité
          @endif
        </span>
        <input type="hidden" name="sector" id="sectorInput" value="{{ request('sector') ?? '' }}">
        <i class="fas fa-chevron-down sector-arrow" id="sectorArrow"></i>
      </div>
      <div class="sector-dropdown-menu" id="sectorDropdownMenu" style="display: none;">
        <div class="sector-search-wrapper">
          <i class="fas fa-search sector-search-icon"></i>
          <input type="text" class="sector-search-input" id="sectorSearchInput" placeholder="Tapez votre recherche…" autocomplete="off">
        </div>
        <div class="sector-popular-section">
          <div class="sector-list" id="sectorPopularList"></div>
        </div>
        <div class="sector-all-section" id="sectorAllSection" style="display: none;">
          <div class="sector-list" id="sectorAllList"></div>
        </div>
        <div class="sector-no-results" id="sectorNoResults" style="display: none;">Aucun résultat</div>
        <div class="sector-reset-option" id="sectorResetOption" role="button" tabindex="0">Tous les univers d'activité</div>
      </div>
    </div>
  </div>
@endif
