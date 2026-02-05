<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Junspro — Là où tout devient possible.</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body {
      margin: 0; padding: 0; height: 100%; width: 100%; overflow: hidden;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* ========== SCOPÉ #cover-hero UNIQUEMENT ========== */
    #cover-hero {
      position: fixed;
      inset: 0;
      z-index: 9999;
      overflow: hidden;
    }

    #cover-hero #fabricCanvas { display: none; }

    /* ---------- Overlay premium: glass + vignette + grain + light sweep ---------- */
    #cover-hero .overlay {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      z-index: 1;
      pointer-events: none;
      background:
        linear-gradient(180deg, rgba(255,255,255,0.03) 0%, transparent 45%, transparent 55%, rgba(255,255,255,0.02) 100%),
        radial-gradient(ellipse 92% 88% at 50% 50%, transparent 38%, rgba(0,0,0,0.04) 68%, rgba(0,0,0,0.1) 100%);
    }

    #cover-hero .overlay::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 256'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      background-size: 180px 180px;
      opacity: 0.04;
      pointer-events: none;
    }

    #cover-hero .overlay::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, transparent 42%, transparent 58%, rgba(139,92,246,0.035) 100%);
      pointer-events: none;
    }

    /* ---------- Contenu centré ---------- */
    #cover-hero .content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 2rem 1.5rem;
      text-align: center;
    }

    /* ---------- Eyebrow premium (2 lignes) ---------- */
    #cover-hero .cover-eyebrow {
      position: absolute;
      top: 2.5rem;
      left: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.35rem;
      z-index: 10;
      opacity: 0;
      transform: translateX(-50%) translateY(10px);
      animation: cover-fade-up-ebrow 0.6s ease-out 0.1s 1 forwards;
    }

    #cover-hero .cover-eyebrow__brand {
      font-size: 0.6875rem;
      font-weight: 600;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: #111827;
    }

    #cover-hero .cover-eyebrow__tagline {
      font-size: 0.75rem;
      font-weight: 400;
      letter-spacing: 0.02em;
      color: #111827;
      opacity: 0.7;
    }

    /* ---------- H1 premium ---------- */
    #cover-hero .content h1 {
      font-size: clamp(2.625rem, 6vw, 5.75rem);
      font-weight: 300;
      letter-spacing: -0.02em;
      line-height: 1.08;
      color: #111827;
      margin-bottom: 2.75rem;
      text-rendering: optimizeLegibility;
      opacity: 0;
      transform: translateY(12px);
      animation: cover-fade-up 0.65s ease-out 0.25s 1 forwards;
    }

    /* ---------- Bloc CTA + micro-ligne ---------- */
    #cover-hero .cover-cta-block {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.25rem;
      opacity: 0;
      transform: translateY(12px);
      animation: cover-fade-up 0.6s ease-out 0.4s 1 forwards;
    }

    /* ---------- CTA pill luxe ---------- */
    #cover-hero .cta {
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      padding: 1rem 2.25rem;
      font-size: 1.0625rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      color: #0f172a;
      text-decoration: none;
      border-radius: 999px;
      border: 1.5px solid rgba(139, 92, 246, 0.5);
      background: rgba(255, 255, 255, 0.22);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 2px 16px rgba(139, 92, 246, 0.12), 0 0 0 1px rgba(255,255,255,0.5) inset;
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    #cover-hero .cta::after {
      content: '→';
      font-size: 1.125rem;
      transition: transform 0.28s ease;
    }

    #cover-hero .cta:hover {
      transform: scale(1.02) translateY(-1px);
      border-color: rgba(139, 92, 246, 0.65);
      box-shadow: 0 6px 24px rgba(139, 92, 246, 0.18), 0 0 0 1px rgba(255,255,255,0.6) inset;
    }

    #cover-hero .cta:hover::after { transform: translateX(3px); }

    #cover-hero .cta:focus-visible {
      outline: 2px solid rgba(139, 92, 246, 0.6);
      outline-offset: 3px;
    }

    /* ---------- Micro-ligne confiance ---------- */
    #cover-hero .cover-trust {
      font-size: 0.8125rem;
      color: #111827;
      opacity: 0.65;
      font-weight: 400;
      letter-spacing: 0.01em;
      line-height: 1.5;
      max-width: 320px;
    }

    @keyframes cover-fade-up {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes cover-fade-up-ebrow {
      from { opacity: 0; transform: translateX(-50%) translateY(10px); }
      to { opacity: 1; transform: translateX(-50%) translateY(0); }
    }

    @media (prefers-reduced-motion: reduce) {
      #cover-hero .cover-eyebrow { animation: none; opacity: 1; transform: translateX(-50%); }
      #cover-hero .content h1 { animation: none; opacity: 1; transform: none; }
      #cover-hero .cover-cta-block { animation: none; opacity: 1; transform: none; }
      #cover-hero .cta:hover { transform: none; }
      #cover-hero .cta:hover::after { transform: none; }
    }

    @media (max-width: 768px) {
      #cover-hero .cover-eyebrow { top: 1.75rem; }
      #cover-hero .cover-eyebrow__brand { font-size: 0.625rem; letter-spacing: 0.22em; }
      #cover-hero .cover-eyebrow__tagline { font-size: 0.6875rem; }
      #cover-hero .content h1 { margin-bottom: 2rem; }
      #cover-hero .cta { padding: 0.9rem 1.75rem; font-size: 1rem; }
      #cover-hero .cover-trust { font-size: 0.75rem; max-width: 100%; padding: 0 0.5rem; }
    }
  </style>
</head>
<body>
  <?php
    $soieImagePath = null;
    $imageLocations = ['images', 'assets/img'];
    foreach ($imageLocations as $locationDir) {
      $locationPath = public_path($locationDir);
      if (is_dir($locationPath)) {
        $files = glob($locationPath . DIRECTORY_SEPARATOR . 'cover-hero*');
        if (!empty($files)) {
          $foundFile = $files[0];
          $relativePath = str_replace([public_path(), DIRECTORY_SEPARATOR], ['', '/'], $foundFile);
          $relativePath = ltrim($relativePath, '/');
          $pathParts = explode('/', $relativePath);
          $fileName = array_pop($pathParts);
          $fileName = rawurlencode($fileName);
          $relativePath = implode('/', $pathParts) . '/' . $fileName;
          $soieImagePath = asset($relativePath);
          break;
        }
      }
    }
  ?>
  <div id="cover-hero" class="cover-container" <?php if($soieImagePath): ?> style="background-image: url('<?php echo e($soieImagePath); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;" <?php endif; ?>>
    <canvas id="fabricCanvas"></canvas>
    <div class="overlay"></div>
    <div class="content">
      <div class="cover-eyebrow">
        <span class="cover-eyebrow__brand">JUNSPRO</span>
        <span class="cover-eyebrow__tagline">La plateforme pour entreprises, particuliers & freelances</span>
      </div>
      <h1>Là où tout devient possible.</h1>
      <div class="cover-cta-block">
        <a href="/home" class="cta">Entrer dans l'expérience</a>
        <p class="cover-trust">Déposez une mission • Profils vérifiés • Paiement sécurisé par Stripe</p>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const canvas = document.getElementById('fabricCanvas');
      const ctx = canvas.getContext('2d');

      function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
      }
      resizeCanvas();
      window.addEventListener('resize', resizeCanvas);

      const baseColor = { r: 250, g: 249, b: 255 };
      const amethystColor = { r: 139, g: 92, b: 246 };

      function noise(x, y, t) {
        const scale = 0.008;
        const x0 = Math.floor(x * scale);
        const y0 = Math.floor(y * scale);
        const x1 = x0 + 1;
        const y1 = y0 + 1;
        const sx = (x * scale) - x0;
        const sy = (y * scale) - y0;
        const n0 = Math.sin(x0 * 12.9898 + y0 * 78.233 + t) * 43758.5453;
        const n1 = Math.sin(x1 * 12.9898 + y0 * 78.233 + t) * 43758.5453;
        const n2 = Math.sin(x0 * 12.9898 + y1 * 78.233 + t) * 43758.5453;
        const n3 = Math.sin(x1 * 12.9898 + y1 * 78.233 + t) * 43758.5453;
        const n0n = n0 - Math.floor(n0);
        const n1n = n1 - Math.floor(n1);
        const n2n = n2 - Math.floor(n2);
        const n3n = n3 - Math.floor(n3);
        const ix = sx * sx * (3 - 2 * sx);
        const iy = sy * sy * (3 - 2 * sy);
        const v0 = n0n * (1 - ix) + n1n * ix;
        const v1 = n2n * (1 - ix) + n3n * ix;
        return v0 * (1 - iy) + v1 * iy;
      }

      function drawFabric() {
        const imageData = ctx.createImageData(canvas.width, canvas.height);
        const data = imageData.data;
        const time = 1000;
        for (let y = 0; y < canvas.height; y++) {
          for (let x = 0; x < canvas.width; x++) {
            const idx = (y * canvas.width + x) * 4;
            const n1 = noise(x, y, time);
            const n2 = noise(x * 2, y * 2, time * 0.8) * 0.5;
            const n3 = noise(x * 4, y * 4, time * 0.6) * 0.25;
            const combinedNoise = (n1 + n2 + n3) / 1.75;
            const foldDepth = combinedNoise * 40 - 20;
            const diagonalGradient = ((x + y) / (canvas.width + canvas.height)) * 70 - 35;
            const verticalGradient = (y / canvas.height) * 35 - 17;
            const amethystZone = Math.max(0, Math.min(1, (combinedNoise - 0.15) * 1.8));
            const shadowIntensity = Math.max(0, -foldDepth * 0.5);
            const finalVariation = foldDepth + (diagonalGradient * 0.3) + (verticalGradient * 0.2) - shadowIntensity;
            const r = Math.max(170, Math.min(255, baseColor.r + (amethystColor.r - baseColor.r) * amethystZone * 0.7 + finalVariation * 0.4));
            const g = Math.max(160, Math.min(255, baseColor.g + (amethystColor.g - baseColor.g) * amethystZone * 0.7 + finalVariation * 0.4));
            const b = Math.max(210, Math.min(255, baseColor.b + (amethystColor.b - baseColor.b) * amethystZone * 0.8 + finalVariation * 0.4));
            data[idx] = r; data[idx + 1] = g; data[idx + 2] = b; data[idx + 3] = 255;
          }
        }
        ctx.putImageData(imageData, 0, 0);
        const highlightGradient1 = ctx.createRadialGradient(canvas.width * 0.25, canvas.height * 0.35, 0, canvas.width * 0.25, canvas.height * 0.35, canvas.width * 0.45);
        highlightGradient1.addColorStop(0, 'rgba(255, 255, 255, 0.45)');
        highlightGradient1.addColorStop(0.25, 'rgba(255, 255, 255, 0.35)');
        highlightGradient1.addColorStop(0.5, 'rgba(255, 255, 255, 0.2)');
        highlightGradient1.addColorStop(0.75, 'rgba(255, 255, 255, 0.08)');
        highlightGradient1.addColorStop(1, 'rgba(255, 255, 255, 0)');
        const highlightGradient2 = ctx.createRadialGradient(canvas.width * 0.75, canvas.height * 0.65, 0, canvas.width * 0.75, canvas.height * 0.65, canvas.width * 0.35);
        highlightGradient2.addColorStop(0, 'rgba(255, 255, 255, 0.4)');
        highlightGradient2.addColorStop(0.35, 'rgba(237, 233, 254, 0.3)');
        highlightGradient2.addColorStop(0.65, 'rgba(221, 214, 254, 0.2)');
        highlightGradient2.addColorStop(1, 'rgba(221, 214, 254, 0)');
        const lightRay = ctx.createLinearGradient(canvas.width * 0.08, canvas.height * 0.18, canvas.width * 0.92, canvas.height * 0.82);
        lightRay.addColorStop(0, 'rgba(255, 255, 255, 0.18)');
        lightRay.addColorStop(0.25, 'rgba(255, 255, 255, 0.35)');
        lightRay.addColorStop(0.5, 'rgba(255, 255, 255, 0.3)');
        lightRay.addColorStop(0.75, 'rgba(237, 233, 254, 0.22)');
        lightRay.addColorStop(1, 'rgba(221, 214, 254, 0.12)');
        ctx.fillStyle = highlightGradient1;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = highlightGradient2;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = lightRay;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
      }
      drawFabric();
    })();
  </script>
</body>
</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/home/cover.blade.php ENDPATH**/ ?>