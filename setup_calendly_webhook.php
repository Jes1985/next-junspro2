<?php
/**
 * Script pour configurer automatiquement le webhook Calendly
 * 
 * Usage:
 * 1. Obtenez un Personal Access Token depuis: https://calendly.com/integrations/api_webhooks
 * 2. Modifiez les variables ci-dessous
 * 3. Exécutez: php setup_calendly_webhook.php
 */

// ==========================================
// CONFIGURATION - À MODIFIER
// ==========================================

// Votre Personal Access Token Calendly
$calendlyToken = 'eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzYyMjgxMDU3LCJqdGkiOiI4YTlkOTBiOC1jYjk1LTRlNDYtYjY1Yy1jMjdjY2ZmOTZjNzQiLCJ1c2VyX3V1aWQiOiIyMmE2Nzk0ZS1lYjlkLTQ5OGQtYmU5Ny1iYTY0NTE0ZjY0ODcifQ.ywVHNho7BGOXpCSV2Z-CTMfFhiF0Rea-9mfm8shQpjSZDa_ipz4UABFX2960PkJHIh-oWrsZY2ssMaXHlX9FjQ';

// URL de votre webhook (votre domaine de production)
$webhookUrl = 'https://junspro.com/mission/calendly/callback';

// ==========================================
// SCRIPT - NE PAS MODIFIER
// ==========================================

echo "🚀 Configuration du webhook Calendly...\n\n";

// Étape 1: Récupérer les informations de l'utilisateur
echo "1. Récupération des informations utilisateur...\n";
$ch = curl_init('https://api.calendly.com/users/me');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $calendlyToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo "❌ Erreur: Impossible de récupérer les informations utilisateur.\n";
    echo "Code HTTP: $httpCode\n";
    echo "Réponse: $response\n";
    exit(1);
}

$user = json_decode($response, true);
if (!$user || !isset($user['resource'])) {
    echo "❌ Erreur: Réponse invalide de l'API.\n";
    echo "Réponse: $response\n";
    exit(1);
}

$orgUri = $user['resource']['current_organization'];
$userUri = $user['resource']['uri'];

echo "✓ Utilisateur trouvé: {$user['resource']['name']}\n";
echo "✓ Organisation: $orgUri\n\n";

// Étape 2: Vérifier les webhooks existants
echo "2. Vérification des webhooks existants...\n";
$ch = curl_init('https://api.calendly.com/webhook_subscriptions?organization=' . urlencode($orgUri));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $calendlyToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $webhooks = json_decode($response, true);
    if (isset($webhooks['collection'])) {
        foreach ($webhooks['collection'] as $webhook) {
            if ($webhook['callback_url'] === $webhookUrl) {
                echo "⚠️  Un webhook avec cette URL existe déjà!\n";
                echo "   ID: {$webhook['uri']}\n";
                echo "   Statut: {$webhook['state']}\n\n";
                echo "Voulez-vous continuer et créer un nouveau webhook? (o/n): ";
                $handle = fopen("php://stdin", "r");
                $line = fgets($handle);
                if (trim($line) !== 'o' && trim($line) !== 'O') {
                    echo "Annulation.\n";
                    exit(0);
                }
                break;
            }
        }
    }
}

// Étape 3: Créer le webhook
echo "3. Création du webhook...\n";
$webhookData = [
    'url' => $webhookUrl,
    'events' => ['invitee.created'],
    'organization' => $orgUri,
];

$ch = curl_init('https://api.calendly.com/webhook_subscriptions');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $calendlyToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhookData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 201 || $httpCode === 200) {
    $webhook = json_decode($response, true);
    echo "✅ Webhook créé avec succès!\n\n";
    echo "📋 Détails:\n";
    echo "   URI: {$webhook['resource']['uri']}\n";
    echo "   URL: {$webhook['resource']['callback_url']}\n";
    echo "   Événements: " . implode(', ', $webhook['resource']['events']) . "\n";
    echo "   Statut: {$webhook['resource']['state']}\n\n";
    
    echo "🎉 Configuration terminée!\n";
    echo "Le webhook sera appelé quand un invité crée une réservation.\n\n";
    
    echo "⚠️  IMPORTANT: N'oubliez pas d'ajouter votre token dans .env:\n";
    echo "   CALENDLY_API_KEY=$calendlyToken\n";
    
} else {
    echo "❌ Erreur lors de la création du webhook.\n";
    echo "Code HTTP: $httpCode\n";
    echo "Réponse: $response\n";
    exit(1);
}

