<?php
require_once __DIR__ . '/includes/init.php';

$produit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$produit_id) {
    rediriger('/produits.php');
}

$db = getDB();

// 1. Récupérer les informations du produit
$stmt = $db->prepare("
    SELECT p.*, c.nom as categorie_nom, c.slug as categorie_slug 
    FROM produits p 
    JOIN categories c ON p.categorie_id = c.id 
    WHERE p.id = ? AND p.actif = 1
");
$stmt->execute([$produit_id]);
$produit = $stmt->fetch();

if (!$produit) {
    message_flash('error', 'Produit introuvable.');
    rediriger('/produits.php');
}

// Incrémenter le nombre de vues
$db->prepare("UPDATE produits SET vues = vues + 1 WHERE id = ?")->execute([$produit_id]);

// 2. Récupérer les images
$stmt_images = $db->prepare("SELECT * FROM images_produits WHERE produit_id = ? ORDER BY est_principale DESC, ordre ASC");
$stmt_images->execute([$produit_id]);
$images = $stmt_images->fetchAll();
$image_principale = !empty($images) ? $images[0]['chemin'] : null;

// 3. Récupérer les variantes (tailles, couleurs, stocks)
$stmt_variantes = $db->prepare("
    SELECT vp.id, vp.stock, vp.sku, 
           t.id as taille_id, t.nom as taille_nom, 
           c.id as couleur_id, c.nom as couleur_nom, c.code_hex
    FROM variantes_produits vp
    JOIN tailles t ON vp.taille_id = t.id
    JOIN couleurs c ON vp.couleur_id = c.id
    WHERE vp.produit_id = ?
    ORDER BY t.ordre ASC, c.nom ASC
");
$stmt_variantes->execute([$produit_id]);
$variantes_brutes = $stmt_variantes->fetchAll();

// Organiser les variantes pour faciliter l'affichage
$tailles = [];
$couleurs = [];
$variantes = []; // Map pour le JS: variantes[taille_id][couleur_id] = { id, stock }

foreach ($variantes_brutes as $v) {
    if (!isset($tailles[$v['taille_id']])) {
        $tailles[$v['taille_id']] = ['id' => $v['taille_id'], 'nom' => $v['taille_nom']];
    }
    if (!isset($couleurs[$v['couleur_id']])) {
        $couleurs[$v['couleur_id']] = ['id' => $v['couleur_id'], 'nom' => $v['couleur_nom'], 'code' => $v['code_hex']];
    }
    
    if (!isset($variantes[$v['taille_id']])) {
        $variantes[$v['taille_id']] = [];
    }
    $variantes[$v['taille_id']][$v['couleur_id']] = [
        'id' => $v['id'],
        'stock' => (int)$v['stock']
    ];
}

// 4. Produits similaires (même catégorie, hors produit actuel)
$stmt_similaires = $db->prepare("
    SELECT p.*, (SELECT chemin FROM images_produits WHERE produit_id = p.id AND est_principale = 1 LIMIT 1) as image_principale
    FROM produits p 
    WHERE p.categorie_id = ? AND p.id != ? AND p.actif = 1 
    ORDER BY RAND() LIMIT 4
");
$stmt_similaires->execute([$produit['categorie_id'], $produit_id]);
$produits_similaires = $stmt_similaires->fetchAll();

$page_titre = $produit['nom'] . ' | ' . SITE_NOM;
require_once __DIR__ . '/includes/header.php';
?>

<div class="container section">
    
    <!-- Fil d'ariane -->
    <div class="breadcrumb mb-8">
        <a href="<?= BASE_URL ?>/">Accueil</a>
        <span class="mx-2 text-gray-400">/</span>
        <a href="<?= BASE_URL ?>/produits.php?categorie=<?= urlencode($produit['categorie_slug']) ?>"><?= e($produit['categorie_nom']) ?></a>
        <span class="mx-2 text-gray-400">/</span>
        <span class="text-gray-800 font-semibold"><?= e($produit['nom']) ?></span>
    </div>

    <div class="product-detail" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">
        
        <!-- Galerie Images -->
        <div class="product-gallery">
            <div class="product-gallery__main bg-gray-100 relative overflow-hidden aspect-[3/4] mb-4 rounded-lg">
                <?php if ($produit['est_nouveau']): ?>
                    <span class="badge badge-new absolute top-4 left-4 z-10">Nouveau</span>
                <?php endif; ?>
                <?php if (est_promotion_active($produit)): ?>
                    <span class="badge badge-sale absolute top-4 left-4 z-10">-<?= calculer_reduction($produit['prix'], $produit['prix_promo']) ?>%</span>
                <?php endif; ?>
                
                <img src="<?= image_produit($image_principale) ?>" alt="<?= e($produit['nom']) ?>" id="main-image" class="w-full h-full object-cover">
            </div>
            
            <?php if (count($images) > 1): ?>
            <div class="product-gallery__thumbs flex gap-3 overflow-x-auto pb-2">
                <?php foreach ($images as $index => $img): ?>
                    <div class="product-gallery__thumb flex-shrink-0 w-20 aspect-[3/4] border-2 cursor-pointer <?= $index === 0 ? 'border-black' : 'border-transparent hover:border-gray-300' ?>" onclick="changeMainImage(this, '<?= image_produit($img['chemin']) ?>')">
                        <img src="<?= image_produit($img['chemin'], 100, 133) ?>" alt="Miniature" class="w-full h-full object-cover">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Infos Produit -->
        <div class="product-info">
            <p class="text-sm text-gray-500 uppercase tracking-widest mb-2 font-semibold"><?= e($produit['categorie_nom']) ?></p>
            <h1 class="text-3xl font-bold mb-2"><?= e($produit['nom']) ?></h1>
            <p class="text-sm text-gray-400 mb-6 font-mono">Réf: <?= e($produit['reference']) ?></p>
            
            <div class="flex items-center gap-4 mb-8">
                <?php if (est_promotion_active($produit)): ?>
                    <span class="text-3xl font-bold text-[var(--accent)]"><?= formater_prix($produit['prix_promo']) ?></span>
                    <span class="text-xl text-gray-400 line-through"><?= formater_prix($produit['prix']) ?></span>
                <?php else: ?>
                    <span class="text-3xl font-bold"><?= formater_prix($produit['prix']) ?></span>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($produit['description_courte'])): ?>
                <p class="text-gray-600 mb-8 leading-relaxed"><?= nl2br(e($produit['description_courte'])) ?></p>
            <?php endif; ?>
            
            <!-- Formulaire d'ajout au panier -->
            <form id="form-panier" class="mb-10">
                <input type="hidden" name="action" value="ajouter">
                <input type="hidden" id="variante_id" name="variante_id" value="">
                
                <!-- Sélecteur de Taille -->
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Taille</span>
                        <a href="#" class="text-sm underline text-gray-500 hover:text-black">Guide des tailles</a>
                    </div>
                    <div class="flex flex-wrap gap-2" id="size-selector">
                        <?php foreach ($tailles as $t): ?>
                            <button type="button" class="size-btn border border-gray-300 py-3 px-4 min-w-[3rem] text-center rounded hover:border-black transition" data-id="<?= $t['id'] ?>">
                                <?= e($t['nom']) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Sélecteur de Couleur -->
                <div class="mb-8">
                    <span class="font-semibold block mb-3">Couleur <span id="color-name-display" class="font-normal text-gray-500 ml-2"></span></span>
                    <div class="flex flex-wrap gap-3" id="color-selector">
                        <?php foreach ($couleurs as $c): ?>
                            <button type="button" class="color-btn w-10 h-10 rounded-full border border-gray-300 relative disabled:opacity-30 disabled:cursor-not-allowed" 
                                    style="background-color: <?= e($c['code']) ?>" 
                                    title="<?= e($c['nom']) ?>" 
                                    data-id="<?= $c['id'] ?>" data-name="<?= e($c['nom']) ?>">
                                <span class="sr-only"><?= e($c['nom']) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Info Stock -->
                <div id="stock-info" class="text-sm font-semibold mb-4 hidden"></div>

                <div class="flex gap-4">
                    <!-- Quantité -->
                    <div class="flex items-center border border-gray-300 rounded h-14">
                        <button type="button" class="px-4 text-xl hover:bg-gray-100" onclick="updateQty(-1)">-</button>
                        <input type="number" id="quantite" name="quantite" value="1" min="1" class="w-12 text-center border-none font-semibold focus:outline-none" readonly>
                        <button type="button" class="px-4 text-xl hover:bg-gray-100" onclick="updateQty(1)">+</button>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <button type="submit" id="btn-add-cart" class="btn btn-primary flex-grow h-14 text-base" disabled>
                        Sélectionner taille & couleur
                    </button>
                    <button type="button" class="w-14 h-14 flex items-center justify-center border border-gray-300 rounded hover:border-black transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </button>
                </div>
            </form>
            
            <!-- Avantages -->
            <ul class="space-y-4 text-sm text-gray-600 border-t border-b border-gray-200 py-6 mb-8">
                <li class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    Livraison offerte à partir de <?= formater_prix(SEUIL_LIVRAISON_GRATUITE) ?>
                </li>
                <li class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    Retours acceptés sous 30 jours
                </li>
                <li class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Paiement 100% sécurisé
                </li>
            </ul>
            
            <!-- Description Complète -->
            <div>
                <h3 class="font-bold text-lg mb-4">Description</h3>
                <div class="text-gray-600 prose">
                    <?= nl2br(e($produit['description'])) ?>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Produits Similaires -->
    <?php if (count($produits_similaires) > 0): ?>
    <div class="mt-24">
        <h2 class="text-2xl font-bold uppercase mb-8 text-center">Vous aimerez aussi</h2>
        <div class="products-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php foreach ($produits_similaires as $p): ?>
                <div class="product-card">
                    <a href="<?= BASE_URL ?>/produit.php?id=<?= $p['id'] ?>" class="product-card__image-container block">
                        <img src="<?= image_produit($p['image_principale']) ?>" alt="<?= e($p['nom']) ?>" class="product-card__image" loading="lazy">
                    </a>
                    <div class="product-card__info mt-3 text-center">
                        <h3 class="product-card__title text-sm font-semibold"><a href="<?= BASE_URL ?>/produit.php?id=<?= $p['id'] ?>"><?= e($p['nom']) ?></a></h3>
                        <p class="mt-1 font-bold"><?= formater_prix($p['prix']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<!-- Scripts pour la page produit -->
<script>
    // Données des variantes passées au JS
    const variantesData = <?= json_encode($variantes) ?>;
    
    let selectedSize = null;
    let selectedColor = null;
    let currentVariant = null;

    const sizeBtns = document.querySelectorAll('.size-btn');
    const colorBtns = document.querySelectorAll('.color-btn');
    const colorNameDisplay = document.getElementById('color-name-display');
    const inputVariante = document.getElementById('variante_id');
    const btnAddCart = document.getElementById('btn-add-cart');
    const inputQty = document.getElementById('quantite');
    const stockInfo = document.getElementById('stock-info');

    // Changer l'image principale
    function changeMainImage(thumbElement, src) {
        document.getElementById('main-image').src = src;
        document.querySelectorAll('.product-gallery__thumb').forEach(el => {
            el.classList.remove('border-black');
            el.classList.add('border-transparent');
        });
        thumbElement.classList.remove('border-transparent');
        thumbElement.classList.add('border-black');
    }

    // Sélection de taille
    sizeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Activer le bouton
            sizeBtns.forEach(b => {
                b.classList.remove('border-black', 'bg-black', 'text-white');
                b.classList.add('border-gray-300');
            });
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-black', 'bg-black', 'text-white');
            
            selectedSize = btn.dataset.id;
            
            // Mettre à jour les couleurs disponibles pour cette taille
            updateColorAvailability();
            checkVariant();
        });
    });

    // Sélection de couleur
    colorBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.disabled) return;
            
            // Activer le bouton
            colorBtns.forEach(b => {
                b.classList.remove('ring-2', 'ring-offset-2', 'ring-black');
            });
            btn.classList.add('ring-2', 'ring-offset-2', 'ring-black');
            
            selectedColor = btn.dataset.id;
            colorNameDisplay.textContent = '- ' + btn.dataset.name;
            
            checkVariant();
        });
    });

    // Mettre à jour la disponibilité des couleurs
    function updateColorAvailability() {
        if (!selectedSize || !variantesData[selectedSize]) return;
        
        colorBtns.forEach(btn => {
            const colorId = btn.dataset.id;
            const variante = variantesData[selectedSize][colorId];
            
            if (!variante || variante.stock <= 0) {
                btn.disabled = true;
                if (selectedColor === colorId) {
                    // Désélectionner la couleur si elle n'est plus dispo
                    btn.classList.remove('ring-2', 'ring-offset-2', 'ring-black');
                    selectedColor = null;
                    colorNameDisplay.textContent = '';
                }
            } else {
                btn.disabled = false;
            }
        });
    }

    // Vérifier la variante sélectionnée complète
    function checkVariant() {
        if (selectedSize && selectedColor && variantesData[selectedSize] && variantesData[selectedSize][selectedColor]) {
            currentVariant = variantesData[selectedSize][selectedColor];
            
            if (currentVariant.stock > 0) {
                inputVariante.value = currentVariant.id;
                btnAddCart.disabled = false;
                btnAddCart.textContent = 'Ajouter au panier';
                
                // Gérer l'affichage du stock
                stockInfo.classList.remove('hidden');
                if (currentVariant.stock <= 5) {
                    stockInfo.textContent = `Plus que ${currentVariant.stock} en stock !`;
                    stockInfo.className = 'text-sm font-semibold mb-4 text-[var(--accent)]';
                } else {
                    stockInfo.textContent = 'En stock';
                    stockInfo.className = 'text-sm font-semibold mb-4 text-[var(--succes)]';
                }
                
                // Ajuster la quantité si elle dépasse le stock
                if (parseInt(inputQty.value) > currentVariant.stock) {
                    inputQty.value = currentVariant.stock;
                }
            } else {
                btnAddCart.disabled = true;
                btnAddCart.textContent = 'Rupture de stock';
                stockInfo.classList.add('hidden');
            }
        } else {
            currentVariant = null;
            inputVariante.value = '';
            btnAddCart.disabled = true;
            btnAddCart.textContent = 'Sélectionner taille & couleur';
            stockInfo.classList.add('hidden');
        }
    }

    // Changer quantité
    window.updateQty = function(change) {
        let newVal = parseInt(inputQty.value) + change;
        
        if (newVal < 1) newVal = 1;
        
        if (currentVariant && newVal > currentVariant.stock) {
            newVal = currentVariant.stock;
            if (window.showToast) window.showToast("Stock maximum atteint", "warning");
        }
        
        inputQty.value = newVal;
    };

    // Soumission du formulaire (Simulation AJAX pour l'instant)
    document.getElementById('form-panier').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentVariant) return;
        
        // TODO: Appeler l'API panier en AJAX
        if (window.showToast) {
            window.showToast(`Produit ajouté au panier (${inputQty.value}x)`, "success");
        } else {
            alert(`Produit ajouté au panier (${inputQty.value}x)`);
        }
        
        // Mettre à jour le compteur du header (simulation)
        const cartBadge = document.querySelector('.cart-count');
        if(cartBadge) {
            let current = parseInt(cartBadge.textContent) || 0;
            cartBadge.textContent = current + parseInt(inputQty.value);
        }
    });

    // Auto-sélection de la première taille dispo si possible
    if (sizeBtns.length > 0) {
        // Optionnel : ne pas forcer la sélection pour obliger l'utilisateur
    }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

