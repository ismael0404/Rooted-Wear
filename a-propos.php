<?php
/**
 * URBAN STYLE - Page À Propos
 * Histoire de la marque, mission, valeurs et engagements
 */
require_once __DIR__ . '/includes/init.php';

// Récupérer quelques statistiques
$nb_produits = 0;
$nb_clients = 0;
try {
    $stmt = $pdo->query('SELECT COUNT(*) FROM produits WHERE actif = 1');
    $nb_produits = (int) $stmt->fetchColumn();
} catch (PDOException $ex) {
    $nb_produits = 500;
}
try {
    $stmt = $pdo->query('SELECT COUNT(*) FROM utilisateurs');
    $nb_clients = (int) $stmt->fetchColumn();
} catch (PDOException $ex) {
    $nb_clients = 1200;
}
if ($nb_produits < 1) $nb_produits = 500;
if ($nb_clients < 1) $nb_clients = 1200;

$page_titre = 'À Propos';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.apropos-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 80px 0 70px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.apropos-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,90,31,0.15) 0%, transparent 60%);
    pointer-events: none;
}
.apropos-hero .container {
    position: relative;
    z-index: 1;
}
.apropos-hero h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.apropos-hero h1 span {
    color: var(--accent);
}
.apropos-hero p {
    font-size: 1.1rem;
    color: #bbb;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

/* Notre Histoire */
.histoire-section {
    padding: 80px 0;
}
.histoire-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}
.histoire-visual {
    background: var(--gris-clair);
    border-radius: 16px;
    height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
}
.histoire-content h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
}
.histoire-content h2 span {
    color: var(--accent);
}
.histoire-content p {
    color: var(--gris);
    font-size: 0.98rem;
    line-height: 1.8;
    margin-bottom: 16px;
}

/* Mission */
.mission-section {
    background: var(--gris-clair);
    padding: 80px 0;
}
.mission-section .section__title {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 50px;
}
.mission-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.mission-card {
    background: var(--blanc);
    border-radius: 12px;
    padding: 35px 30px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.mission-card-icon {
    font-size: 2.4rem;
    margin-bottom: 18px;
}
.mission-card h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 12px;
}
.mission-card p {
    color: var(--gris);
    font-size: 0.9rem;
    line-height: 1.7;
    margin: 0;
}

/* Chiffres clés */
.chiffres-section {
    padding: 70px 0;
    background: var(--noir);
    color: var(--blanc);
}
.chiffres-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    text-align: center;
}
.chiffre-item {
    padding: 20px;
}
.chiffre-nombre {
    font-size: 2.6rem;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 8px;
}
.chiffre-label {
    font-size: 0.95rem;
    color: #bbb;
}

/* Engagements */
.engagements-section {
    padding: 80px 0;
}
.engagements-section .section__title {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 50px;
}
.engagements-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 35px;
    max-width: 900px;
    margin: 0 auto;
}
.engagement-item {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}
.engagement-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: var(--gris-clair);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.engagement-item h3 {
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 6px;
}
.engagement-item p {
    color: var(--gris);
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0;
}

/* CTA */
.apropos-cta {
    background: var(--gris-clair);
    padding: 70px 0;
    text-align: center;
}
.apropos-cta h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 14px;
}
.apropos-cta p {
    color: var(--gris);
    font-size: 1rem;
    max-width: 500px;
    margin: 0 auto 28px;
    line-height: 1.7;
}
.apropos-cta .btn {
    display: inline-block;
    background: var(--accent);
    color: var(--blanc);
    padding: 14px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: opacity 0.3s;
}
.apropos-cta .btn:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .apropos-hero h1 {
        font-size: 2rem;
    }
    .histoire-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .histoire-visual {
        height: 250px;
    }
    .mission-cards {
        grid-template-columns: 1fr;
    }
    .chiffres-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .engagements-list {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Hero -->
<section class="apropos-hero">
    <div class="container">
        <h1>L'histoire d'<span>URBAN STYLE</span></h1>
        <p>Née au cœur d'Abidjan, URBAN STYLE est bien plus qu'une marque de mode — c'est un mouvement qui célèbre le style urbain africain avec audace et authenticité.</p>
    </div>
</section>

<!-- Notre Histoire -->
<section class="histoire-section">
    <div class="container">
        <div class="histoire-grid">
            <div class="histoire-visual">
                🏙️
            </div>
            <div class="histoire-content">
                <h2>Notre <span>Histoire</span></h2>
                <p>
                    Tout a commencé en 2019, dans le quartier vibrant de Cocody à Abidjan. Face à un marché de la mode dominé par les grandes enseignes internationales, nous avons eu une vision : proposer une mode urbaine accessible, tendance et profondément ancrée dans l'identité africaine.
                </p>
                <p>
                    URBAN STYLE est née de la conviction que le style n'a pas de frontières. En mêlant les influences streetwear mondiales aux couleurs, aux textures et à l'énergie de l'Afrique de l'Ouest, nous avons créé une marque qui parle à une nouvelle génération — fière de ses racines et résolument tournée vers l'avenir.
                </p>
                <p>
                    Depuis nos débuts, nous avons grandi grâce à une communauté fidèle de passionnés de mode qui partagent notre vision d'un style unique, accessible et sans compromis sur la qualité.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Notre Mission -->
<section class="mission-section">
    <div class="container">
        <h2 class="section__title">Notre Mission</h2>
        <div class="mission-cards">
            <div class="mission-card">
                <div class="mission-card-icon">🎨</div>
                <h3>Créativité Audacieuse</h3>
                <p>Nous repoussons les limites du style en proposant des collections qui osent mélanger les genres, les inspirations et les cultures pour créer quelque chose d'unique.</p>
            </div>
            <div class="mission-card">
                <div class="mission-card-icon">🤝</div>
                <h3>Accessibilité pour Tous</h3>
                <p>La mode ne devrait pas être un luxe réservé à quelques-uns. Nous nous engageons à offrir des pièces de qualité à des prix justes et accessibles.</p>
            </div>
            <div class="mission-card">
                <div class="mission-card-icon">🌍</div>
                <h3>Fierté Africaine</h3>
                <p>Nous célébrons l'identité africaine à travers chaque pièce, en valorisant le savoir-faire local et en portant haut les couleurs de notre continent.</p>
            </div>
        </div>
    </div>
</section>

<!-- Chiffres Clés -->
<section class="chiffres-section">
    <div class="container">
        <div class="chiffres-grid">
            <div class="chiffre-item">
                <div class="chiffre-nombre"><?= e(number_format($nb_produits, 0, ',', ' ')) ?>+</div>
                <div class="chiffre-label">Produits disponibles</div>
            </div>
            <div class="chiffre-item">
                <div class="chiffre-nombre"><?= e(number_format($nb_clients, 0, ',', ' ')) ?>+</div>
                <div class="chiffre-label">Clients satisfaits</div>
            </div>
            <div class="chiffre-item">
                <div class="chiffre-nombre">5+</div>
                <div class="chiffre-label">Années d'expérience</div>
            </div>
            <div class="chiffre-item">
                <div class="chiffre-nombre">10+</div>
                <div class="chiffre-label">Pays livrés</div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Engagements -->
<section class="engagements-section">
    <div class="container">
        <h2 class="section__title">Nos Engagements</h2>
        <div class="engagements-list">
            <div class="engagement-item">
                <div class="engagement-icon">✅</div>
                <div>
                    <h3>Qualité Premium</h3>
                    <p>Chaque article est soigneusement sélectionné et contrôlé pour garantir une qualité irréprochable. Nous travaillons avec des fournisseurs de confiance.</p>
                </div>
            </div>
            <div class="engagement-item">
                <div class="engagement-icon">💎</div>
                <div>
                    <h3>Style Authentique</h3>
                    <p>Nos collections reflètent les dernières tendances tout en conservant une identité forte, inspirée par la culture urbaine africaine et internationale.</p>
                </div>
            </div>
            <div class="engagement-item">
                <div class="engagement-icon">📦</div>
                <div>
                    <h3>Livraison Fiable</h3>
                    <p>Nous assurons une livraison rapide et sécurisée partout en Côte d'Ivoire et dans toute l'Afrique de l'Ouest, avec un suivi en temps réel.</p>
                </div>
            </div>
            <div class="engagement-item">
                <div class="engagement-icon">💬</div>
                <div>
                    <h3>Service Client Dédié</h3>
                    <p>Notre équipe est à votre écoute pour répondre à toutes vos questions, vous conseiller et vous accompagner avant, pendant et après votre achat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="apropos-cta">
    <div class="container">
        <h2>Prêt à découvrir notre collection ?</h2>
        <p>Explorez nos dernières pièces et trouvez le style qui vous correspond.</p>
        <a href="<?= e(BASE_URL) ?>/boutique.php" class="btn">Découvrir la boutique</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

