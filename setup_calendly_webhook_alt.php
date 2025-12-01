<?php
/**
 * Script pour configurer automatiquement le webhook Calendly
 * Version alternative sans cURL (utilise file_get_contents)
 */

// ==========================================
// CONFIGURATION
// ==========================================

$calendlyToken = 'eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzYyMjgxMDU3LCJqdGkiOiI4YTlkOTBiOC1jYjk1LTRlNDYtYjY1Yy1jMjdjY2ZmOTZjNzQiLCJ1c2VyX3V1aWQiOiIyMmE2Nzk0ZS1lYjlkLTQ5OGQtYmU5Ny1iYTY0NTE0ZjY0ODcifQ.ywVHNho7BGOXpCSV2Z-CTMfFhiF0Rea-9mfm8shQpjSZDa_ipz4UABFX2960PkJHIh-oWrsZY2ssMaXHlX9FjQ';
$webhookUrl = 'https://junspro.com/mission/calendly/callback';

// ==========================================
// FONCTIONS
// ==========================================

function httpRequest($url, $method = 'GET', $data = null, $headers = []) {
    $defaultHeaders = [
        'Content-Type: application/json',
    ];
    $headers = array_merge($defaultHeaders, $headers);
    
    $options = [
        'http' => [
            'method' => $method,
            'header' => implode("\r\n", $headers),
            'ignore_errors' => true,
        ]
    ];
    
    if ($data !== null && ($method === 'POST' || $method === 'PUT')) {
        $options['http']['content'] = is_string($data) ? $data : json_encode($data);
    }
    
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    $httpCode = null;
    if (isset($http_response_header)) {
        preg_match('/HTTP\/\d\.\d\s+(\d+)/', $http_response_header[0], $matches);
        $httpCode = isset($matches[1]) ? (int)$matches[1] : null;
    }
    
    return [
        'code' => $httpCode,
        'body' => $response,
    ];
}

// ==========================================
// SCRIPT
// ==========================================

echo "🚀 Configuration du webhook Calendly...\n\n";

// Étape 1: Récupérer les informations utilisateur
echo "1. Récupération des informations utilisateur...\n";
$result = httpRequest(
    'https://api.calendly.com/users/me',
    'GET',
    null,
    ['Authorization: Bearer ' . $calendlyToken]
);

if ($result['code'] !== 200) {
    echo "❌ Erreur: Impossible de récupérer les informations utilisateur.\n";
    echo "Code HTTP: {$result['code']}\n";
    echo "Réponse: {$result['body']}\n";
    exit(1);
}

$user = json_decode($result['body'], true);
if (!$user || !isset($user['resource'])) {
    echo "❌ Erreur: Réponse invalide de l'API.\n";
    echo "Réponse: {$result['body']}\n";
    exit(1);
}

$orgUri = $user['resource']['current_organization'];
$userUri = $user['resource']['uri'];

echo "✓ Utilisateur trouvé: {$user['resource']['name']}\n";
echo "✓ Organisation: $orgUri\n\n";

// Étape 2: Créer le webhook
echo "2. Création du webhook...\n";
$webhookData = [
    'url' => $webhookUrl,
    'events' => ['invitee.created'],
    'organization' => $orgUri,
];

$result = httpRequest(
    'https://api.calendly.com/webhook_subscriptions',
    'POST',
    $webhookData,
    ['Authorization: Bearer ' . $calendlyToken]
);

if ($result['code'] === 201 || $result['code'] === 200) {
    $webhook = json_decode($result['body'], true);
    echo "✅ Webhook créé avec succès!\n\n";
    echo "📋 Détails:\n";
    echo "   URI: {$webhook['resource']['uri']}\n";
    echo "   URL: {$webhook['resource']['callback_url']}\n";
    echo "   Événements: " . implode(', ', $webhook['resource']['events']) . "\n";
    echo "   Statut: {$webhook['resource']['state']}\n\n";
    
    echo "🎉 Configuration terminée!\n";
    echo "Le webhook sera appelé quand un invité crée une réservation.\n\n";
    
} else {
    echo "❌ Erreur lors de la création du webhook.\n";
    echo "Code HTTP: {$result['code']}\n";
    echo "Réponse: {$result['body']}\n";
    
    // Vérifier si le webhook existe déjà
    if (strpos($result['body'], 'already exists') !== false || strpos($result['body'], 'duplicate') !== false) {
        echo "\n⚠️  Le webhook existe peut-être déjà. Vérifiez dans Calendly.\n";
    }
    
    exit(1);
}


