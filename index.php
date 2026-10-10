<?php
require_once __DIR__ . '/includes/init.php';

$page_titre = 'Accueil';
$page_description = 'URBAN STYLE - Votre destination mode urbaine et streetwear en Côte d\'Ivoire';

$db = getDB();

// 1. Récupérer les nouveautés depuis la Base de Données
$stmt = $db->prepare('
    SELECT p.*, c.nom as categorie_nom 
    FROM produits p 
    JOIN categories c ON p.categorie_id = c.id 
    WHERE p.actif = 1 AND p.est_nouveau = 1 
    ORDER BY p.date_creation DESC LIMIT 4
');
$stmt->execute();
$nouveautes = $stmt->fetchAll();

// 2. Récupérer les meilleures ventes (produits mis en vedette)
$stmt2 = $db->prepare('
    SELECT p.*, c.nom as categorie_nom 
    FROM produits p 
    JOIN categories c ON p.categorie_id = c.id 
    WHERE p.actif = 1 AND p.est_vedette = 1 
    ORDER BY p.vues DESC LIMIT 4
');
$stmt2->execute();
$vedettes = $stmt2->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<!-- SECTION HERO (Bannière principale) -->
<section style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=1600&q=80') center/cover; min-height: 85vh; display: flex; align-items: center; color: white;">
    <div class="container" style="text-align: center;">
        <span style="color: #FF5A1F; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; font-size: 0.9rem; display: block; margin-bottom: 20px;">Nouvelle Collection</span>
        <h1 style="font-size: 3.5rem; font-weight: 900; text-transform: uppercase; margin-bottom: 20px; line-height: 1.1;">L'esprit de la rue,<br>le style de demain.</h1>
        <p style="font-size: 1.1rem; color: #ddd; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">Découvrez nos dernières pièces streetwear pour affirmer votre identité.</p>
        <div>
            <a href="<?= BASE_URL ?>/produits.php" style="display: inline-block; background: #FF5A1F; color: #fff; padding: 15px 35px; font-weight: 700; text-transform: uppercase; margin-right: 15px; border-radius: 4px;">Découvrir la collection</a>
            <a href="<?= BASE_URL ?>/produits.php?filtre=nouveautes" style="display: inline-block; background: transparent; color: #fff; border: 2px solid #fff; padding: 13px 35px; font-weight: 700; text-transform: uppercase; border-radius: 4px;">Voir les nouveautés</a>
        </div>
    </div>
</section>

<!-- SECTION AVANTAGES -->
<section style="padding: 50px 0; background: #fff; border-bottom: 1px solid #eee;">
    <div class="container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; text-align: center;">
        <div>
            <div style="font-size: 2rem; margin-bottom: 10px;">🚚</div>
            <h4 style="font-weight: 700; margin-bottom: 5px;">Livraison Rapide</h4>
            <p style="color: #777; font-size: 0.85rem; margin: 0;">Partout en Côte d'Ivoire</p>
        </div>
        <div>
            <div style="font-size: 2rem; margin-bottom: 10px;">🔒</div>
            <h4 style="font-weight: 700; margin-bottom: 5px;">Paiement Sécurisé</h4>
            <p style="color: #777; font-size: 0.85rem; margin: 0;">Paiement à la livraison possible</p>
        </div>
        <div>
            <div style="font-size: 2rem; margin-bottom: 10px;">🎧</div>
            <h4 style="font-weight: 700; margin-bottom: 5px;">Service Client</h4>
            <p style="color: #777; font-size: 0.85rem; margin: 0;">Assistance 7j/7</p>
        </div>
        <div>
            <div style="font-size: 2rem; margin-bottom: 10px;">🔄</div>
            <h4 style="font-weight: 700; margin-bottom: 5px;">Retours Simples</h4>
            <p style="color: #777; font-size: 0.85rem; margin: 0;">Sous 14 jours</p>
        </div>
    </div>
</section>

<!-- SECTION NOUVEAUTÉS -->
<section style="padding: 80px 0;">
    <div class="container">
        <h2 style="font-size: 2rem; font-weight: 800; text-transform: uppercase; margin-bottom: 40px; text-align: center;">Dernières Arrivées</h2>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
            <?php foreach ($nouveautes as $produit): ?>
            <div style="background: #fff; transition: 0.3s; position: relative;">
                <a href="<?= BASE_URL ?>/produit.php?id=<?= $produit['id'] ?>">
                    <div style="position: relative; background: #F5F5F5; aspect-ratio: 3/4; overflow: hidden; margin-bottom: 15px;">
                        <img src="<?= image_produit() ?>" alt="<?= e($produit['nom']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <span style="position: absolute; top: 10px; left: 10px; background: #111; color: #fff; font-size: 0.7rem; padding: 4px 10px; font-weight: 700; text-transform: uppercase;">Nouveau</span>
                    </div>
                </a>
                <div style="padding: 0 5px;">
                    <span style="color: #777; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;"><?= e($produit['categorie_nom']) ?></span>
                    <h3 style="font-size: 1rem; font-weight: 600; margin: 5px 0;"><a href="<?= BASE_URL ?>/produit.php?id=<?= $produit['id'] ?>" style="color: #111; text-decoration: none;"><?= e($produit['nom']) ?></a></h3>
                    <div style="font-weight: 700; margin-top: 8px;">
                        <?php if ($produit['prix_promo']): ?>
                            <span style="color: #FF5A1F; font-size: 1.1rem;"><?= formater_prix($produit['prix_promo']) ?></span>
                            <span style="color: #aaa; text-decoration: line-through; font-weight: 400; font-size: 0.85rem; margin-left: 5px;"><?= formater_prix($produit['prix']) ?></span>
                        <?php else: ?>
                            <span style="font-size: 1.1rem;"><?= formater_prix($produit['prix']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <a href="<?= BASE_URL ?>/produits.php?filtre=nouveautes" style="display: inline-block; background: #111; color: #fff; padding: 14px 35px; font-weight: 600; text-transform: uppercase; border-radius: 4px; font-size: 0.9rem;">Voir toutes les nouveautés</a>
        </div>
    </div>
</section>

<!-- SECTION BANNIÈRES CATÉGORIES -->
<section style="padding: 0 20px 80px 20px;">
    <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        <div style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516826957135-700ede19c6ce?auto=format&fit=crop&w=800&q=80') center/cover; height: 400px; display: flex; align-items: flex-end; padding: 40px; color: white;">
            <div>
                <h3 style="font-size: 2rem; font-weight: 800; text-transform: uppercase; margin-bottom: 15px;">Collection Homme</h3>
                <a href="<?= BASE_URL ?>/produits.php?genre=homme" style="color: #fff; font-weight: 600; font-size: 1.1rem; padding-bottom: 5px; border-bottom: 2px solid white;">Découvrir</a>
            </div>
        </div>
        <div style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?auto=format&fit=crop&w=800&q=80') center/cover; height: 400px; display: flex; align-items: flex-end; padding: 40px; color: white;">
            <div>
                <h3 style="font-size: 2rem; font-weight: 800; text-transform: uppercase; margin-bottom: 15px;">Collection Femme</h3>
                <a href="<?= BASE_URL ?>/produits.php?genre=femme" style="color: #fff; font-weight: 600; font-size: 1.1rem; padding-bottom: 5px; border-bottom: 2px solid white;">Découvrir</a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION MEILLEURES VENTES -->
<section style="padding: 0 0 80px 0;">
    <div class="container">
        <h2 style="font-size: 2rem; font-weight: 800; text-transform: uppercase; margin-bottom: 40px; text-align: center;">Meilleures Ventes</h2>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
            <?php foreach ($vedettes as $produit): ?>
            <div style="background: #fff; transition: 0.3s; position: relative;">
                <a href="<?= BASE_URL ?>/produit.php?id=<?= $produit['id'] ?>">
                    <div style="position: relative; background: #F5F5F5; aspect-ratio: 3/4; overflow: hidden; margin-bottom: 15px;">
                        <img src="<?= image_produit() ?>" alt="<?= e($produit['nom']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php if ($produit['prix_promo']): ?>
                            <span style="position: absolute; top: 10px; left: 10px; background: #FF5A1F; color: #fff; font-size: 0.7rem; padding: 4px 10px; font-weight: 700; text-transform: uppercase;">Promo</span>
                        <?php endif; ?>
                    </div>
                </a>
                <div style="padding: 0 5px;">
                    <span style="color: #777; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;"><?= e($produit['categorie_nom']) ?></span>
                    <h3 style="font-size: 1rem; font-weight: 600; margin: 5px 0;"><a href="<?= BASE_URL ?>/produit.php?id=<?= $produit['id'] ?>" style="color: #111; text-decoration: none;"><?= e($produit['nom']) ?></a></h3>
                    <div style="font-weight: 700; margin-top: 8px;">
                        <?php if ($produit['prix_promo']): ?>
                            <span style="color: #FF5A1F; font-size: 1.1rem;"><?= formater_prix($produit['prix_promo']) ?></span>
                            <span style="color: #aaa; text-decoration: line-through; font-weight: 400; font-size: 0.85rem; margin-left: 5px;"><?= formater_prix($produit['prix']) ?></span>
                        <?php else: ?>
                            <span style="font-size: 1.1rem;"><?= formater_prix($produit['prix']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

