<?php
/**
 * Initialisation de l'application.
 * Ce fichier doit être inclus au tout début de chaque page du site.
 */

// Configuration sécurisée des sessions avant leur démarrage
ini_set('session.cookie_httponly', 1); // Empêche l'accès aux cookies de session via JavaScript (protection XSS)
ini_set('session.use_only_cookies', 1); // Force l'utilisation des cookies pour l'ID de session
ini_set('session.cookie_samesite', 'Lax'); // Protection basique contre le CSRF inter-sites

// Démarrage de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuration du fuseau horaire (Côte d'Ivoire)
date_default_timezone_set('Africa/Abidjan');

// Inclusion des fichiers de configuration
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

// Gestion des erreurs selon l'environnement
if (defined('MODE_DEBUG') && MODE_DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Inclusion des librairies utilitaires
require_once __DIR__ . '/fonctions.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/panier-fonctions.php';
