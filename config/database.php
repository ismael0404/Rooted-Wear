<?php
/**
 * Configuration et connexion à la base de données MySQL.
 * Utilise l'extension PDO pour des requêtes sécurisées et performantes.
 */

// Identifiants de connexion (à modifier selon votre environnement XAMPP)
define('DB_HOST', 'localhost');
define('DB_NAME', 'urban_style');
define('DB_USER', 'root'); // 'root' par défaut sur XAMPP
define('DB_PASS', '');     // Vide par défaut sur XAMPP
define('DB_CHARSET', 'utf8mb4'); // Support complet de l'UTF-8 (y compris emojis)

/**
 * Fonction pour obtenir l'instance PDO de connexion à la base de données.
 * Utilise le pattern Singleton : la connexion n'est établie qu'une seule fois par requête PHP.
 *
 * @return PDO L'objet de connexion PDO
 */
function getDB() {
    static $pdo = null;
    
    // Si la connexion n'a pas encore été établie
    if ($pdo === null) {
        try {
            // Création de la chaîne de connexion (DSN)
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            
            // Options de sécurité et de performance PDO
            $options = [
                // Déclenche des exceptions (erreurs fatales) en cas de requête SQL invalide
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Récupère les résultats sous forme de tableau associatif par défaut
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Désactive les requêtes préparées émulées (vrai mode préparé au niveau MySQL = plus sécurisé)
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            // Instanciation de l'objet PDO
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            
        } catch (PDOException $e) {
            // Gestion de l'erreur de connexion
            if (defined('MODE_DEBUG') && MODE_DEBUG) {
                // En développement : affiche le détail de l'erreur
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
            // En production : message générique pour ne pas révéler d'informations sensibles
            die('Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.');
        }
    }
    
    // Retourne l'instance (existante ou nouvellement créée)
    return $pdo;
}
