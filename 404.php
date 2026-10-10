<?php
/**
 * URBAN STYLE - Page 404
 * Page d'erreur personnalisée
 */
require_once __DIR__ . '/includes/init.php';

http_response_code(404);

$page_titre = 'Page introuvable';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.page-404 {
    min-height: 65vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 0 80px;
    text-align: center;
}
.page-404-inner {
    max-width: 580px;
    margin: 0 auto;
}
.page-404-code {
    font-size: 8rem;
    font-weight: 900;
    line-height: 1;
    color: var(--gris-clair);
    margin-bottom: 10px;
    letter-spacing: -4px;
    position: relative;
    display: inline-block;
}
.page-404-code span {
    color: var(--accent);
}
.page-404 h1 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 14px;
    color: var(--noir);
}
.page-404 > .page-404-inner > p {
    color: var(--gris);
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 35px;
}
.page-404-search {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    max-width: 440px;
    margin-left: auto;
    margin-right: auto;
}
.page-404-search .form-control {
    flex: 1;
    padding: 13px 18px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
}
.page-404-search .form-control:focus {
    outline: none;
    border-color: var(--accent);
}
.page-404-search .btn-search {
    background: var(--noir);
    color: var(--blanc);
    border: none;
    padding: 13px 22px;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    transition: background 0.3s;
    white-space: nowrap;
}
.page-404-search .btn-search:hover {
    background: var(--accent);
}
.page-404-actions {
    display: flex;
    gap: 14px;
    justify-content: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.page-404-actions .btn-home {
    display: inline-block;
    background: var(--accent);
    color: var(--blanc);
    padding: 13px 32px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: opacity 0.3s;
}
.page-404-actions .btn-home:hover {
    opacity: 0.9;
}
.page-404-actions .btn-contact {
    display: inline-block;
    background: transparent;
    color: var(--noir);
    border: 2px solid var(--noir);
    padding: 11px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: background 0.3s, color 0.3s;
}
.page-404-actions .btn-contact:hover {
    background: var(--noir);
    color: var(--blanc);
}
.page-404-categories {
    border-top: 1px solid #eee;
    padding-top: 30px;
}
.page-404-categories h3 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--gris);
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.page-404-links {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}
.page-404-links a {
    display: inline-block;
    padding: 10px 20px;
    background: var(--gris-clair);
    color: var(--noir);
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.88rem;
    font-weight: 500;
    transition: background 0.3s, color 0.3s;
}
.page-404-links a:hover {
    background: var(--noir);
    color: var(--blanc);
}
@media (max-width: 600px) {
    .page-404-code {
        font-size: 5rem;
    }
    .page-404 h1 {
        font-size: 1.4rem;
    }
    .page-404-search {
        flex-direction: column;
    }
}
</style>

<section class="page-404">
    <div class="page-404-inner">
        <div class="page-404-code">4<span>0</span>4</div>
        <h1>Page introuvable</h1>
        <p>La page que vous recherchez n'existe pas ou a été déplacée. Vérifiez l'adresse ou utilisez la recherche ci-dessous.</p>

        <form action="<?= e(BASE_URL) ?>/boutique.php" method="get" class="page-404-search">
            <input type="text" name="q" class="form-control" placeholder="Rechercher un article..." aria-label="Rechercher">
            <button type="submit" class="btn-search">Rechercher</button>
        </form>

        <div class="page-404-actions">
            <a href="<?= e(BASE_URL) ?>/" class="btn-home">Retour à l'accueil</a>
            <a href="<?= e(BASE_URL) ?>/contact.php" class="btn-contact">Nous contacter</a>
        </div>

        <div class="page-404-categories">
            <h3>Catégories populaires</h3>
            <div class="page-404-links">
                <a href="<?= e(BASE_URL) ?>/boutique.php?categorie=hommes">Hommes</a>
                <a href="<?= e(BASE_URL) ?>/boutique.php?categorie=femmes">Femmes</a>
                <a href="<?= e(BASE_URL) ?>/boutique.php?categorie=chaussures">Chaussures</a>
                <a href="<?= e(BASE_URL) ?>/boutique.php?categorie=accessoires">Accessoires</a>
                <a href="<?= e(BASE_URL) ?>/boutique.php?nouveautes=1">Nouveautés</a>
                <a href="<?= e(BASE_URL) ?>/boutique.php?promotion=1">Promotions</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

