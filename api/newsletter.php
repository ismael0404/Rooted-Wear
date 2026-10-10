<?php
/**
 * URBAN STYLE - API Newsletter (AJAX)
 * Endpoint d'inscription à la newsletter
 * POST: email (required, validated)
 * Returns: JSON {success: bool, message: string}
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Empêcher l'accès direct via GET
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée.'
    ]);
    exit;
}

require_once __DIR__ . '/../includes/init.php';

// Lire le body JSON ou les données POST classiques
$input = json_decode(file_get_contents('php://input'), true);
$email = '';

if ($input && isset($input['email'])) {
    $email = trim($input['email']);
} else {
    $email = trim(obtenir_parametre('email', ''));
}

// Validation
if ($email === '') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'L\'adresse e-mail est obligatoire.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'L\'adresse e-mail n\'est pas valide.'
    ]);
    exit;
}

try {
    // Vérifier les doublons
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM newsletter WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $existe = (int) $stmt->fetchColumn();

    if ($existe > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Cette adresse e-mail est déjà inscrite à notre newsletter.'
        ]);
        exit;
    }

    // Insérer
    $stmt = $pdo->prepare('INSERT INTO newsletter (email, date_inscription) VALUES (:email, NOW())');
    $stmt->execute([':email' => $email]);

    echo json_encode([
        'success' => true,
        'message' => 'Merci ! Vous êtes maintenant inscrit à notre newsletter.'
    ]);
} catch (PDOException $ex) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Une erreur est survenue. Veuillez réessayer plus tard.'
    ]);
}

