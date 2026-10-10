<?php
/**
 * Fonctions de gestion du panier d'achat (Basées sur les sessions pour l'instant)
 */

/**
 * Retourne le nombre total d'articles dans le panier
 */
function compter_panier() {
    if (!isset($_SESSION['panier'])) {
        return 0;
    }
    $total = 0;
    foreach ($_SESSION['panier'] as $item) {
        $total += $item['quantite'];
    }
    return $total;
}

/**
 * Récupère le contenu complet du panier
 */
function obtenir_panier() {
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        return [];
    }
    return $_SESSION['panier'];
}

/**
 * Calcule le sous-total, la livraison et le total TTC du panier
 */
function calculer_total_panier() {
    $sous_total = 0;
    $panier = obtenir_panier();
    
    foreach ($panier as $item) {
        // Prend en compte le prix promo s'il existe
        $prix = isset($item['prix_promo']) && $item['prix_promo'] > 0 ? $item['prix_promo'] : $item['prix'];
        $sous_total += $prix * $item['quantite'];
    }
    
    $frais_livraison = ($sous_total >= SEUIL_LIVRAISON_GRATUITE || $sous_total == 0) ? 0 : FRAIS_LIVRAISON;
    $total = $sous_total + $frais_livraison;
    $montant_restant_livraison_gratuite = max(0, SEUIL_LIVRAISON_GRATUITE - $sous_total);
    
    return [
        'sous_total' => $sous_total,
        'frais_livraison' => $frais_livraison,
        'total' => $total,
        'nombre_articles' => compter_panier(),
        'montant_restant_livraison_gratuite' => $montant_restant_livraison_gratuite
    ];
}

