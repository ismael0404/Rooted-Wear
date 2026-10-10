CREATE DATABASE IF NOT EXISTS `urban_style` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `urban_style`;

SET FOREIGN_KEY_CHECKS=0;

-- =========================================================================
-- 1. TABLE DES RÔLES
-- Définit les différents niveaux d'accès au système (admin, client, etc.)
-- =========================================================================
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(50) NOT NULL,
  `description` TEXT,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `nom`, `description`) VALUES
(1, 'admin', 'Administrateur principal'),
(2, 'gestionnaire_catalogue', 'Gestionnaire de catalogue'),
(3, 'gestionnaire_commandes', 'Gestionnaire de commandes'),
(4, 'client', 'Client régulier du site');

-- =========================================================================
-- 2. TABLE DES UTILISATEURS
-- Stocke les informations de tous les utilisateurs (clients et admins)
-- =========================================================================
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT NOT NULL DEFAULT 4,
  `nom` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `telephone` VARCHAR(20),
  `mot_de_passe` VARCHAR(255) NOT NULL, -- Haché avec bcrypt (password_hash)
  `actif` TINYINT(1) DEFAULT 1,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion de clients de démonstration (mot de passe : password123)
INSERT INTO `utilisateurs` (`id`, `role_id`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`) VALUES
(1, 4, 'Dupont', 'Jean', 'client1@test.com', '0102030405', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
(2, 4, 'Martin', 'Sophie', 'client2@test.com', '0504030201', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- =========================================================================
-- 3. TABLE DES CATÉGORIES
-- Permet de classer les produits. Gère une hiérarchie basique (parent_id)
-- =========================================================================
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `parent_id` INT NULL,
  `nom` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE, -- Utilisé pour les URL (ex: t-shirts-polos)
  `description` TEXT,
  `image` VARCHAR(255),
  `ordre` INT DEFAULT 0,
  `actif` TINYINT(1) DEFAULT 1,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `nom`, `slug`, `description`) VALUES
(1, 'T-Shirts & Polos', 'tshirts-polos', 'Hauts décontractés et confortables'),
(2, 'Pantalons & Jeans', 'pantalons-jeans', 'Bas urbains pour tous les jours'),
(3, 'Vestes & Sweats', 'vestes-sweats', 'Vêtements chauds et stylés'),
(4, 'Chaussures', 'chaussures', 'Sneakers et chaussures de ville'),
(5, 'Accessoires', 'accessoires', 'Sacs, casquettes, montres'),
(6, 'Sportswear', 'sportswear', 'Vêtements adaptés pour le sport'),
(7, 'Nouveautés', 'nouveautes', 'Dernières arrivées en boutique'),
(8, 'Promotions', 'promotions', 'Bons plans et réductions');

-- =========================================================================
-- 4. TABLE DES PRODUITS
-- Informations générales sur un produit. Les déclinaisons (tailles/couleurs) 
-- sont gérées dans 'variantes_produits'
-- =========================================================================
DROP TABLE IF EXISTS `produits`;
CREATE TABLE `produits` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `categorie_id` INT NOT NULL,
  `nom` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `reference` VARCHAR(50) NOT NULL UNIQUE,
  `description` TEXT,
  `description_courte` VARCHAR(500),
  `prix` DECIMAL(10,0) NOT NULL, -- Prix en FCFA (sans décimales)
  `prix_promo` DECIMAL(10,0) NULL,
  `genre` ENUM('homme','femme','enfant','unisexe') NOT NULL DEFAULT 'unisexe',
  `est_nouveau` TINYINT(1) DEFAULT 0,
  `est_vedette` TINYINT(1) DEFAULT 0,
  `actif` TINYINT(1) DEFAULT 1,
  `vues` INT DEFAULT 0,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`categorie_id`) REFERENCES `categories`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `produits` (`id`, `categorie_id`, `nom`, `slug`, `reference`, `description_courte`, `prix`, `prix_promo`, `genre`, `est_nouveau`, `est_vedette`) VALUES
(1, 1, 'T-Shirt Logo Minimal', 't-shirt-logo-minimal', 'TS-MIN-001', 'T-shirt 100% coton avec logo brodé', 12000, NULL, 'homme', 1, 1),
(2, 4, 'Sneakers Classic White', 'sneakers-classic-white', 'SH-CLW-002', 'Baskets blanches confortables et élégantes', 35000, 29000, 'unisexe', 0, 1);

-- =========================================================================
-- 5. TABLE DES TAILLES
-- Référentiel des tailles disponibles (vêtements et chaussures)
-- =========================================================================
DROP TABLE IF EXISTS `tailles`;
CREATE TABLE `tailles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(10) NOT NULL,
  `ordre` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tailles` (`id`, `nom`, `ordre`) VALUES
(1, 'XS', 1), (2, 'S', 2), (3, 'M', 3), (4, 'L', 4), (5, 'XL', 5),
(6, '38', 6), (7, '39', 7), (8, '40', 8), (9, '41', 9), (10, '42', 10);

-- =========================================================================
-- 6. TABLE DES COULEURS
-- Référentiel des couleurs avec leur code hexadécimal pour l'affichage web
-- =========================================================================
DROP TABLE IF EXISTS `couleurs`;
CREATE TABLE `couleurs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(50) NOT NULL,
  `code_hex` VARCHAR(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `couleurs` (`id`, `nom`, `code_hex`) VALUES
(1, 'Noir', '#000000'), (2, 'Blanc', '#FFFFFF'), (3, 'Gris', '#808080');

-- =========================================================================
-- 7. TABLE DES VARIANTES DE PRODUITS
-- Fait le lien entre un produit, une taille et une couleur. Gère le stock réel.
-- =========================================================================
DROP TABLE IF EXISTS `variantes_produits`;
CREATE TABLE `variantes_produits` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `produit_id` INT NOT NULL,
  `taille_id` INT NOT NULL,
  `couleur_id` INT NOT NULL,
  `stock` INT DEFAULT 0, -- Quantité physique disponible
  `sku` VARCHAR(50) NOT NULL UNIQUE, -- Code unique de gestion des stocks
  FOREIGN KEY (`produit_id`) REFERENCES `produits`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`taille_id`) REFERENCES `tailles`(`id`),
  FOREIGN KEY (`couleur_id`) REFERENCES `couleurs`(`id`),
  UNIQUE KEY (`produit_id`, `taille_id`, `couleur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `variantes_produits` (`id`, `produit_id`, `taille_id`, `couleur_id`, `stock`, `sku`) VALUES
(1, 1, 3, 1, 20, 'URB-TSMIN-M-N'),
(2, 1, 4, 1, 15, 'URB-TSMIN-L-N'),
(3, 2, 8, 2, 10, 'URB-SHCLW-40-B');

SET FOREIGN_KEY_CHECKS=1;
