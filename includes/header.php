<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_titre ?? SITE_NOM) ?> | <?= SITE_NOM ?></title>
    <meta name="description" content="<?= e($page_description ?? SITE_DESCRIPTION) ?>">
    <meta name="robots" content="noindex, nofollow"> <!-- Environnement de développement -->
    
    <!-- Polices Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- La feuille de style principale sera liée ici plus tard -->
    <style>
        /* Styles de base temporaires pour un rendu propre */
        body { margin: 0; font-family: 'Inter', sans-serif; background-color: #fcfcfc; color: #111; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        a { text-decoration: none; transition: 0.2s; }
        a:hover { opacity: 0.7; }
    </style>
</head>
<body>

    <!-- Barre promotionnelle Supérieure -->
    <div style="background: #111; color: #fff; text-align: center; padding: 10px; font-size: 0.85rem; font-weight: 500; letter-spacing: 0.5px;">
        Livraison GRATUITE à partir de <?= formater_prix(SEUIL_LIVRAISON_GRATUITE) ?>
    </div>

    <!-- En-tête de navigation -->
    <header style="background: #fff; border-bottom: 1px solid #eee; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; padding: 15px 20px;">
            
            <!-- Logo -->
            <a href="<?= BASE_URL ?>/" style="font-size: 1.5rem; font-weight: 900; letter-spacing: 2px; color: #111; text-transform: uppercase;">
                <?= SITE_NOM ?>
            </a>

            <!-- Menu Principal -->
            <nav style="display: flex; gap: 30px;">
                <a href="<?= BASE_URL ?>/produits.php?filtre=nouveautes" style="color: #333; font-weight: 500; text-transform: uppercase; font-size: 0.85rem;">Nouveautés</a>
                <a href="<?= BASE_URL ?>/produits.php?genre=homme" style="color: #333; font-weight: 500; text-transform: uppercase; font-size: 0.85rem;">Homme</a>
                <a href="<?= BASE_URL ?>/produits.php?genre=femme" style="color: #333; font-weight: 500; text-transform: uppercase; font-size: 0.85rem;">Femme</a>
                <a href="<?= BASE_URL ?>/produits.php?categorie=chaussures" style="color: #333; font-weight: 500; text-transform: uppercase; font-size: 0.85rem;">Chaussures</a>
                <a href="<?= BASE_URL ?>/produits.php?filtre=promotions" style="color: #FF5A1F; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Promotions</a>
            </nav>

            <!-- Icônes d'action -->
            <div style="display: flex; gap: 20px; align-items: center; font-size: 1.2rem;">
                <a href="<?= BASE_URL ?>/recherche.php" style="color: #111;" title="Recherche">🔍</a>
                
                <?php if (est_connecte()): ?>
                    <a href="<?= BASE_URL ?>/mon-compte.php" style="color: #111;" title="Mon Compte">👤</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/connexion.php" style="color: #111;" title="Se connecter">👤</a>
                <?php endif; ?>

                <a href="<?= BASE_URL ?>/panier.php" style="color: #111; position: relative;" title="Panier">
                    🛒
                    <span style="position: absolute; top: -8px; right: -10px; background: #FF5A1F; color: #fff; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: bold;">
                        <?= compter_panier() ?>
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- Zone pour les notifications Flash -->
    <div class="container" style="margin-top: 15px;">
        <?= afficher_messages_flash() ?>
    </div>

    <!-- Début du contenu de la page spécifique -->
    <main style="min-height: 60vh;">

