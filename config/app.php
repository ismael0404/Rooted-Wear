<?php
/**
 * Configuration principale de l'application URBAN STYLE
 * Ce fichier contient les constantes globales utilisées dans tout le site.
 */

// --- Identité de la boutique ---
define('SITE_NOM', 'Rooted Wear');
define('SITE_DESCRIPTION', 'Votre destination mode urbaine et streetwear');

// --- Configuration de l'URL ---
// BASE_URL doit correspondre au dossier où est installé le projet (ex: '/okon' ou '' si à la racine)
define('BASE_URL', '/okon'); 

// --- Configuration financière ---
define('DEVISE', 'FCFA');
define('DEVISE_CODE', 'XOF');
define('FRAIS_LIVRAISON', 2500); // Montant des frais de livraison standard
define('SEUIL_LIVRAISON_GRATUITE', 25000); // Montant à partir duquel la livraison est offerte

// --- Gestion des fichiers (upload d'images) ---
define('UPLOADS_DIR', __DIR__ . '/../uploads/produits/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // Taille maximale autorisée: 5 Mo (en octets)
define('EXTENSIONS_AUTORISEES', ['jpg', 'jpeg', 'png', 'webp', 'gif']);
define('TYPES_MIME_AUTORISES', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
define('TAILLE_IMAGE_MAX_LARGEUR', 1200); // Pour redimensionnement
define('TAILLE_IMAGE_MAX_HAUTEUR', 1500);

// --- Paramètres d'affichage ---
define('ITEMS_PAR_PAGE', 12); // Nombre de produits par page dans le catalogue

// --- Sécurité et Authentification ---
define('TENTATIVES_CONNEXION_MAX', 5); // Nombre d'échecs avant blocage temporaire
define('DUREE_BLOCAGE_CONNEXION', 900); // Durée du blocage en secondes (15 minutes)
define('DUREE_JETON_REINITIALISATION', 3600); // Expiration du lien de mot de passe oublié (1 heure)

// --- Mode de fonctionnement ---
// Mettre MODE_DEBUG à false en production pour masquer les erreurs techniques aux utilisateurs
define('MODE_DEBUG', true); 

// --- Configuration Serveur Mail (SMTP) ---
// Laisser vide si non utilisé (en mode développement local par exemple)
define('SMTP_HOST', '');
define('SMTP_PORT', '');
define('SMTP_USER', '');
define('SMTP_PASS', '');
