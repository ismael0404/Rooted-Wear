<?php
require_once __DIR__ . '/includes/init.php';

// --- Gestion des paramètres de filtrage ---
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$items_par_page = ITEMS_PAR_PAGE;
$offset = ($page - 1) * $items_par_page;

$conditions = ['actif = 1'];
$parametres = [];
$url_params = []; // Pour conserver les filtres lors de la pagination

// 1. Recherche globale
if (!empty($_GET['q'])) {
    $conditions[] = "(nom LIKE ? OR description LIKE ? OR reference LIKE ?)";
    $recherche = '%' . $_GET['q'] . '%';
    $parametres[] = $recherche;
    $parametres[] = $recherche;
    $parametres[] = $recherche;
    $url_params['q'] = $_GET['q'];
}

// 2. Filtre par Catégorie (slug)
$categorie_actuelle = null;
if (!empty($_GET['categorie'])) {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, nom, description, image FROM categories WHERE slug = ? AND actif = 1");
    $stmt->execute([$_GET['categorie']]);
    $categorie_actuelle = $stmt->fetch();
    
    if ($categorie_actuelle) {
        $conditions[] = "categorie_id = ?";
        $parametres[] = $categorie_actuelle['id'];
        $url_params['categorie'] = $_GET['categorie'];
    }
}

// 3. Filtre par Genre
if (!empty($_GET['genre']) && in_array($_GET['genre'], ['homme', 'femme', 'enfant', 'unisexe'])) {
    $conditions[] = "genre = ?";
    $parametres[] = $_GET['genre'];
    $url_params['genre'] = $_GET['genre'];
}

// 4. Filtre par Prix
if (isset($_GET['prix_min']) && is_numeric($_GET['prix_min'])) {
    $conditions[] = "COALESCE(prix_promo, prix) >= ?";
    $parametres[] = $_GET['prix_min'];
    $url_params['prix_min'] = $_GET['prix_min'];
}
if (isset($_GET['prix_max']) && is_numeric($_GET['prix_max'])) {
    $conditions[] = "COALESCE(prix_promo, prix) <= ?";
    $parametres[] = $_GET['prix_max'];
    $url_params['prix_max'] = $_GET['prix_max'];
}

// 5. Filtres spécifiques (Nouveautés, Promotions)
if (!empty($_GET['nouveautes'])) {
    $conditions[] = "est_nouveau = 1";
    $url_params['nouveautes'] = 1;
}
if (!empty($_GET['promotions'])) {
    $conditions[] = "prix_promo IS NOT NULL";
    $url_params['promotions'] = 1;
}

// --- Construction de la requête SQL ---
$sql_where = implode(' AND ', $conditions);

// Définir le tri
$tri_autorises = [
    'nouveaute' => 'date_creation DESC',
    'prix_croissant' => 'COALESCE(prix_promo, prix) ASC',
    'prix_decroissant' => 'COALESCE(prix_promo, prix) DESC',
    'popularite' => 'vues DESC'
];
$tri_actuel = isset($_GET['tri']) && array_key_exists($_GET['tri'], $tri_autorises) ? $_GET['tri'] : 'nouveaute';
$sql_order = $tri_autorises[$tri_actuel];
if ($tri_actuel !== 'nouveaute') {
    $url_params['tri'] = $tri_actuel;
}

// Requête de comptage pour la pagination
$db = getDB();
$sql_count = "SELECT COUNT(*) as total FROM produits WHERE $sql_where";
$stmt_count = $db->prepare($sql_count);
$stmt_count->execute($parametres);
$total_produits = $stmt_count->fetch()['total'];
$total_pages = ceil($total_produits / $items_par_page);

// Requête principale
$sql_produits = "
    SELECT p.*, c.nom as categorie_nom, c.slug as categorie_slug,
           (SELECT chemin FROM images_produits WHERE produit_id = p.id AND est_principale = 1 LIMIT 1) as image_principale
    FROM produits p
    JOIN categories c ON p.categorie_id = c.id
    WHERE $sql_where 
    ORDER BY $sql_order 
    LIMIT $items_par_page OFFSET $offset
";
$stmt_produits = $db->prepare($sql_produits);
$stmt_produits->execute($parametres);
$produits = $stmt_produits->fetchAll();

// Récupération des catégories pour le menu de filtres
$categories = obtenir_categories_menu();

// --- Préparation des variables d'affichage ---
$page_titre = $categorie_actuelle ? $categorie_actuelle['nom'] . ' | ' . SITE_NOM : 'Catalogue | ' . SITE_NOM;
$titre_section = $categorie_actuelle ? $categorie_actuelle['nom'] : 'Toute la collection';

// Construction de l'URL de base pour la pagination
$query_string = http_build_query($url_params);
$url_pagination_base = BASE_URL . '/produits.php' . ($query_string ? '?' . $query_string . '&' : '?');

require_once __DIR__ . '/includes/header.php';
?>

<!-- En-tête du catalogue -->
<div class="category-banner" style="height: 250px; background-color: var(--noir);">
    <div class="container relative z-10 text-center">
        <h1 class="category-banner__title"><?= e($titre_section) ?></h1>
        <?php if ($categorie_actuelle && !empty($categorie_actuelle['description'])): ?>
            <p class="text-white opacity-80 max-w-2xl mx-auto mt-4"><?= e($categorie_actuelle['description']) ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="container section">
    
    <!-- Fil d'ariane -->
    <div class="breadcrumb">
        <a href="<?= BASE_URL ?>/">Accueil</a>
        <span class="mx-2 text-gray-400">/</span>
        <span class="text-gray-800 font-semibold"><?= e($titre_section) ?></span>
    </div>

    <div class="catalog-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: 40px; margin-top: 30px;">
        
        <!-- Sidebar Filtres -->
        <aside class="filters-sidebar">
            
            <form action="<?= BASE_URL ?>/produits.php" method="GET" id="form-filtres">
                <!-- Conserver la catégorie actuelle si elle existe -->
                <?php if (!empty($_GET['categorie'])): ?>
                    <input type="hidden" name="categorie" value="<?= e($_GET['categorie']) ?>">
                <?php endif; ?>
                
                <?php if (!empty($_GET['q'])): ?>
                    <input type="hidden" name="q" value="<?= e($_GET['q']) ?>">
                    <div class="mb-4">
                        <p class="text-sm">Résultats pour : <strong>"<?= e($_GET['q']) ?>"</strong></p>
                    </div>
                <?php endif; ?>
                
                <div class="filter-group">
                    <h3 class="filter-group__title">Catégories</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>
                            <a href="<?= BASE_URL ?>/produits.php" class="<?= empty($_GET['categorie']) ? 'font-bold text-black' : '' ?>">Toutes les catégories</a>
                        </li>
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= BASE_URL ?>/produits.php?categorie=<?= urlencode($cat['slug']) ?>" class="<?= (!empty($_GET['categorie']) && $_GET['categorie'] == $cat['slug']) ? 'font-bold text-black' : 'hover:text-black transition' ?>">
                                    <?= e($cat['nom']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="filter-group">
                    <h3 class="filter-group__title">Genre</h3>
                    <div class="space-y-2 text-sm">
                        <?php 
                        $genres = ['homme' => 'Homme', 'femme' => 'Femme', 'enfant' => 'Enfant', 'unisexe' => 'Unisexe'];
                        foreach ($genres as $val => $label): 
                            $checked = (!empty($_GET['genre']) && $_GET['genre'] == $val) ? 'checked' : '';
                        ?>
                        <label class="filter-option cursor-pointer flex items-center gap-2">
                            <input type="radio" name="genre" value="<?= $val ?>" <?= $checked ?> onchange="this.form.submit()">
                            <span><?= $label ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3 class="filter-group__title">Collection</h3>
                    <div class="space-y-2 text-sm">
                        <label class="filter-option cursor-pointer flex items-center gap-2">
                            <input type="checkbox" name="nouveautes" value="1" <?= !empty($_GET['nouveautes']) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <span>Nouveautés</span>
                        </label>
                        <label class="filter-option cursor-pointer flex items-center gap-2">
                            <input type="checkbox" name="promotions" value="1" <?= !empty($_GET['promotions']) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <span class="text-[var(--accent)] font-semibold">Promotions</span>
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <h3 class="filter-group__title">Prix (<?= DEVISE ?>)</h3>
                    <div class="flex items-center gap-2">
                        <input type="number" name="prix_min" placeholder="Min" class="w-full p-2 border border-gray-300 rounded text-sm" value="<?= $_GET['prix_min'] ?? '' ?>">
                        <span>-</span>
                        <input type="number" name="prix_max" placeholder="Max" class="w-full p-2 border border-gray-300 rounded text-sm" value="<?= $_GET['prix_max'] ?? '' ?>">
                    </div>
                    <button type="submit" class="btn btn-outline btn-sm w-full mt-3">Appliquer</button>
                </div>

                <?php if (!empty($url_params)): ?>
                    <a href="<?= BASE_URL ?>/produits.php" class="btn btn-outline btn-full btn-sm mt-4 text-gray-500 border-gray-300 hover:border-black hover:text-black">
                        Réinitialiser les filtres
                    </a>
                <?php endif; ?>

            </form>
        </aside>
        
        <!-- Contenu Principal -->
        <main class="catalog-content">
            
            <!-- Barre d'outils -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <p class="text-sm text-gray-600">
                    <strong><?= $total_produits ?></strong> produit(s) trouvé(s)
                </p>
                
                <div class="flex items-center gap-3 text-sm">
                    <label for="tri" class="text-gray-600">Trier par :</label>
                    <select id="tri" form="form-filtres" name="tri" onchange="this.form.submit()" class="p-2 border border-gray-300 rounded focus:outline-none focus:border-black">
                        <option value="nouveaute" <?= $tri_actuel == 'nouveaute' ? 'selected' : '' ?>>Nouveautés</option>
                        <option value="prix_croissant" <?= $tri_actuel == 'prix_croissant' ? 'selected' : '' ?>>Prix croissant</option>
                        <option value="prix_decroissant" <?= $tri_actuel == 'prix_decroissant' ? 'selected' : '' ?>>Prix décroissant</option>
                        <option value="popularite" <?= $tri_actuel == 'popularite' ? 'selected' : '' ?>>Popularité</option>
                    </select>
                </div>
            </div>

            <!-- Grille de produits -->
            <?php if (count($produits) > 0): ?>
                <div class="products-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <?php foreach ($produits as $p): ?>
                        <div class="product-card">
                            <a href="<?= BASE_URL ?>/produit.php?id=<?= $p['id'] ?>" class="product-card__image-container block">
                                <div class="product-card__badges">
                                    <?php if ($p['est_nouveau']): ?>
                                        <span class="badge badge-new">Nouveau</span>
                                    <?php endif; ?>
                                    <?php if (est_promotion_active($p)): ?>
                                        <span class="badge badge-sale">-<?= calculer_reduction($p['prix'], $p['prix_promo']) ?>%</span>
                                    <?php endif; ?>
                                </div>
                                
                                <img src="<?= image_produit($p['image_principale']) ?>" alt="<?= e($p['nom']) ?>" class="product-card__image" loading="lazy">
                            </a>
                            
                            <!-- Bouton Favoris (à implémenter en JS) -->
                            <button class="product-card__wishlist" title="Ajouter aux favoris" data-id="<?= $p['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>

                            <div class="product-card__info mt-3">
                                <a href="<?= BASE_URL ?>/produits.php?categorie=<?= urlencode($p['categorie_slug']) ?>" class="product-card__category inline-block mb-1 text-xs text-gray-500 uppercase tracking-wider hover:text-black">
                                    <?= e($p['categorie_nom']) ?>
                                </a>
                                <h3 class="product-card__title text-sm font-semibold mb-2">
                                    <a href="<?= BASE_URL ?>/produit.php?id=<?= $p['id'] ?>" class="hover:underline">
                                        <?= e($p['nom']) ?>
                                    </a>
                                </h3>
                                
                                <div class="product-card__price-container flex items-center gap-2 mt-auto">
                                    <?php if (est_promotion_active($p)): ?>
                                        <span class="product-card__price product-card__price--promo font-bold text-[var(--accent)]"><?= formater_prix($p['prix_promo']) ?></span>
                                        <span class="product-card__price--old text-sm text-gray-400 line-through"><?= formater_prix($p['prix']) ?></span>
                                    <?php else: ?>
                                        <span class="product-card__price font-bold"><?= formater_prix($p['prix']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="pagination flex justify-center mt-12 gap-2">
                        <?= generer_pagination($page, $total_pages, $url_pagination_base) ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-state py-20 text-center">
                    <svg class="mx-auto mb-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <h3 class="text-xl font-bold mb-2">Aucun produit trouvé</h3>
                    <p class="text-gray-500 mb-6">Nous n'avons trouvé aucun produit correspondant à vos critères.</p>
                    <a href="<?= BASE_URL ?>/produits.php" class="btn btn-outline">Voir toute la collection</a>
                </div>
            <?php endif; ?>

        </main>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

