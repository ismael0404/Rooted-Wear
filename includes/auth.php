<?php
/**
 * Fonctions de gestion de l'authentification et des autorisations
 */

/**
 * Vérifie si l'utilisateur actuel est connecté
 */
function est_connecte() {
    return isset($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_id'] > 0;
}

/**
 * Vérifie si l'utilisateur actuel a des privilèges d'administrateur
 * (Rôles 1: admin, 2: gestionnaire_catalogue, 3: gestionnaire_commandes)
 */
function est_admin() {
    return est_connecte() && isset($_SESSION['utilisateur_role']) && in_array($_SESSION['utilisateur_role'], ['admin', 'gestionnaire_catalogue', 'gestionnaire_commandes']);
}

/**
 * Vérifie si l'utilisateur actuel est le super administrateur
 */
function est_super_admin() {
    return est_connecte() && isset($_SESSION['utilisateur_role']) && $_SESSION['utilisateur_role'] === 'admin';
}

/**
 * Protège une page qui nécessite d'être connecté
 */
function verifier_connexion() {
    if (!est_connecte()) {
        message_flash('error', 'Veuillez vous connecter pour accéder à cette page.');
        rediriger('/connexion.php');
    }
}

/**
 * Protège une page qui nécessite d'être administrateur
 */
function verifier_admin() {
    if (!est_admin()) {
        message_flash('error', 'Accès refusé. Privilèges insuffisants.');
        rediriger('/');
    }
}

/**
 * Connecte un utilisateur en session après validation de ses identifiants
 */
function connecter_utilisateur($utilisateur, $role_nom) {
    // Régénération de l'ID de session pour prévenir les attaques de fixation de session
    session_regenerate_id(true);
    
    $_SESSION['utilisateur_id'] = $utilisateur['id'];
    $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
    $_SESSION['utilisateur_prenom'] = $utilisateur['prenom'];
    $_SESSION['utilisateur_email'] = $utilisateur['email'];
    $_SESSION['utilisateur_role'] = $role_nom;
}

/**
 * Déconnecte l'utilisateur courant
 */
function deconnecter_utilisateur() {
    // On vide les variables de session
    $_SESSION = array();
    
    // On détruit le cookie de session si existant
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // On détruit la session côté serveur
    session_destroy();
    
    // On redémarre une nouvelle session vide pour les messages flash éventuels
    session_start();
    session_regenerate_id(true);
}

