<?php
/**
 * Protection contre les attaques CSRF (Cross-Site Request Forgery)
 */

/**
 * Génère un jeton CSRF et le stocke en session.
 * Retourne le champ HTML caché à insérer dans les formulaires.
 */
function generer_csrf() {
    if (empty($_SESSION['csrf_token'])) {
        // Création d'un jeton aléatoire robuste de 32 octets (64 caractères hexa)
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

/**
 * Vérifie que le jeton CSRF soumis correspond à celui en session.
 * À appeler au début du traitement de chaque formulaire en méthode POST.
 */
function verifier_csrf() {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        message_flash('error', 'Erreur de sécurité : le jeton a expiré. Veuillez réessayer.');
        return false;
    }
    return true;
}
