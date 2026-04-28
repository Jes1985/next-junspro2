<x-mail::message>
# Votre code de connexion

Bonjour **{{ $userName }}**,

Voici votre code de connexion à usage unique. Il est valable **10 minutes**.

<div style="text-align:center;margin:32px 0;">
  <span style="font-size:36px;font-weight:700;letter-spacing:12px;color:#1a1a1a;background:#f5f5f0;padding:16px 32px;border-radius:8px;display:inline-block;">{{ $otp }}</span>
</div>

Si vous n'avez pas tenté de vous connecter, ignorez cet email. Votre compte reste sécurisé.

---

*Ce code ne fonctionne que pour une seule connexion et expire après 10 minutes.*

{{ config('app.name') }}
</x-mail::message>

{{ config('app.name') }}
</x-mail::message>
