<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Félicitations Praticien(ne) Pause Souffle</title>
</head>
<body style="margin:0; padding:0; background:#0f0f0f; font-family: 'Segoe UI', Arial, sans-serif;">
  <div style="max-width:600px; margin:0 auto; background:#0f0f0f; padding:40px 20px;">

    <!-- Header -->
    <div style="text-align:center; margin-bottom:32px;">
      <div style="font-size:11px; letter-spacing:.15em; text-transform:uppercase; color:#c9a84c; margin-bottom:8px;">Junspro · Formation Praticien Pause Souffle</div>
      <div style="font-size:42px; margin-bottom:4px;">🏅</div>
      <div style="font-size:22px; color:#c9a84c; letter-spacing:.1em;">∞+</div>
    </div>

    <!-- Main card -->
    <div style="background:linear-gradient(135deg,#1a0e00,#111); border:1.5px solid #c9a84c; border-radius:16px; padding:36px 32px; margin-bottom:24px;">

      <h1 style="font-size:24px; font-weight:800; color:#ffffff; margin:0 0 8px; line-height:1.3;">
        Félicitations, {{ $user->first_name ?? $user->name }} !
      </h1>
      <p style="font-size:15px; color:#c9a84c; font-weight:600; margin:0 0 24px;">
        Vous êtes désormais officiellement Praticien(ne) Pause Souffle.
      </p>

      <blockquote style="border-left:2px solid #c9a84c; padding-left:14px; margin:16px 0 24px; font-style:italic; font-size:13px; color:rgba(201,168,76,.85); line-height:1.7;">
        « J'ai couru très longtemps.<br>
        J'ai tout arrêté.<br>
        Et c'est là que j'ai tout trouvé — et infiniment plus. »
      </blockquote>

      <p style="font-size:14px; color:rgba(255,255,255,.8); line-height:1.7; margin:0 0 20px;">
        Vous avez complété les 6 modules de la formation <strong style="color:#fff;">Praticien Pause Souffle</strong>.
        Votre attestation est disponible dès maintenant dans votre espace personnel.
      </p>

      <p style="font-size:14px; color:rgba(255,255,255,.7); line-height:1.7; margin:0 0 28px;">
        Cette certification témoigne de votre engagement profond envers la pratique, votre souffle et votre chemin intérieur.
        Portez-la avec fierté — elle est le reflet de qui vous êtes devenu(e).
      </p>

      <!-- CTA -->
      <div style="text-align:center;">
        <a href="{{ $attestationUrl }}"
           style="display:inline-block; background:linear-gradient(135deg,#c9a84c,#a07830); color:#0f0f0f; font-weight:700; font-size:14px; letter-spacing:.05em; text-transform:uppercase; padding:14px 32px; border-radius:8px; text-decoration:none;">
          Voir mon attestation
        </a>
      </div>
    </div>

    <!-- Quote footer -->
    <div style="text-align:center; padding:16px 0;">
      <p style="font-size:11px; color:rgba(255,255,255,.3); letter-spacing:.08em; text-transform:uppercase; margin:0 0 4px;">
        Infiniment plus — ∞+
      </p>
      <p style="font-size:11px; color:rgba(255,255,255,.2); margin:0;">
        Junspro • <a href="{{ url('/') }}" style="color:rgba(201,168,76,.4); text-decoration:none;">junspro.com</a>
      </p>
    </div>

  </div>
</body>
</html>
