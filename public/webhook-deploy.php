<?php
/**
 * Webhook de déploiement automatique
 * Appelé par GitHub à chaque push sur la branche
 */

define('DEPLOY_SECRET', 'junspro-deploy-2026-secure');
define('DEPLOY_SCRIPT', '/var/www/junspro/deploy.sh');
define('LOG_FILE', '/var/log/junspro-deploy.log');

// Vérification du secret
$secret = $_GET['secret'] ?? $_SERVER['HTTP_X_SECRET'] ?? '';
if ($secret !== DEPLOY_SECRET) {
    http_response_code(403);
    die(json_encode(['error' => 'Unauthorized']));
}

// Vérification signature GitHub (optionnel mais recommandé)
$githubSecret = 'junspro-webhook-2026';
if (isset($_SERVER['HTTP_X_HUB_SIGNATURE_256'])) {
    $payload = file_get_contents('php://input');
    $expected = 'sha256=' . hash_hmac('sha256', $payload, $githubSecret);
    if (!hash_equals($expected, $_SERVER['HTTP_X_HUB_SIGNATURE_256'])) {
        http_response_code(403);
        die(json_encode(['error' => 'Invalid signature']));
    }
    $data = json_decode($payload, true);
    // Déployer seulement si c'est la bonne branche
    $branch = $data['ref'] ?? '';
    if ($branch !== 'refs/heads/restore-filters-one-test') {
        http_response_code(200);
        die(json_encode(['message' => "Branch $branch ignored"]));
    }
}

// Lancer le déploiement en arrière-plan
$logEntry = date('Y-m-d H:i:s') . ": Webhook reçu - déploiement lancé\n";
file_put_contents(LOG_FILE, $logEntry, FILE_APPEND);

exec("nohup bash " . DEPLOY_SCRIPT . " > /dev/null 2>&1 &");

http_response_code(200);
echo json_encode([
    'status'  => 'success',
    'message' => 'Deployment started',
    'time'    => date('Y-m-d H:i:s'),
]);
