<?php

namespace App\Services\Junspro;

/**
 * Service anti-désintermédiation : filtre les coordonnées (email, téléphone, URLs)
 * dans les messages avant réservation confirmée.
 */
class ContactGuardService
{
    protected static string $replacementPlaceholder = '[coordonnées masquées]';

    /** Message premium affiché séparément (bannière) */
    public static string $infoMessage = 'Pour votre sécurité, les coordonnées sont disponibles après réservation confirmée.';

    /**
     * Remplace les coordonnées détectées dans un message par "[coordonnées masquées]".
     * Patterns : email, numéros de téléphone (FR + international), URLs (WhatsApp, Telegram, Instagram, Calendly, etc.).
     */
    public static function filterContactCoordinates(string $message): string
    {
        $result = $message;

        // Emails : user@domain.tld
        $result = preg_replace(
            '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
            self::$replacementPlaceholder,
            $result
        );

        // Numéros téléphone : 06/07 FR, +33, formats internationaux (min 8 chiffres significatifs)
        $result = preg_replace(
            '/(?:\+33|0)[1-9](?:[-.\s]?\d{2}){4}|(?:\+\d{1,3}[-.\s]?)?\(?\d{2,4}\)?[-.\s]?\d{2,4}[-.\s]?\d{2,4}[-.\s]?\d{2,4}/',
            self::$replacementPlaceholder,
            $result
        );

        // URLs : http, https, www.
        $result = preg_replace(
            '#https?://[^\s<>"\']+|www\.[^\s<>"\']+#i',
            self::$replacementPlaceholder,
            $result
        );

        // Liens contact sans préfixe : wa.me/xxx, api.whatsapp.com/xxx, t.me/xxx, instagram.com/xxx, calendly.com/xxx, linktr.ee/xxx
        $result = preg_replace(
            '#(?:wa\.me|api\.whatsapp\.com|t\.me|instagram\.com|calendly\.com|linktr\.ee)/[^\s<>"\']+#i',
            self::$replacementPlaceholder,
            $result
        );

        // Réduire les répétitions consécutives du placeholder
        $result = preg_replace(
            '/(' . preg_quote(self::$replacementPlaceholder, '/') . '\s*)+/',
            self::$replacementPlaceholder,
            $result
        );

        return trim($result);
    }

    /**
     * Indique si le message contient des coordonnées (email, téléphone, URL).
     */
    public static function containsContactCoordinates(string $message): bool
    {
        // Email
        if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $message)) {
            return true;
        }

        // Téléphone (06/07 FR, +33, international)
        if (preg_match('/(?:\+33|0)[1-9](?:[-.\s]?\d{2}){4}|(?:\+\d{1,3}[-.\s]?)?\(?\d{2,4}\)?[-.\s]?\d{2,4}[-.\s]?\d{2,4}[-.\s]?\d{2,4}/', $message)) {
            return true;
        }

        // URL (http, www, wa.me, t.me, etc.)
        if (preg_match('#https?://[^\s<>"\']+|www\.[^\s<>"\']+#i', $message)) {
            return true;
        }
        if (preg_match('#(?:wa\.me|api\.whatsapp\.com|t\.me|instagram\.com|calendly\.com|linktr\.ee)/[^\s<>"\']+#i', $message)) {
            return true;
        }

        return false;
    }
}
