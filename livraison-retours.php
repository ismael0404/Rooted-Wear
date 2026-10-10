<?php
/**
 * URBAN STYLE - Page Livraison & Retours
 * Informations sur la livraison et la politique de retour
 */
require_once __DIR__ . '/includes/init.php';

$page_titre = 'Livraison & Retours';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.lr-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.lr-hero h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.lr-hero p {
    color: var(--gris);
    font-size: 1.05rem;
    max-width: 520px;
    margin: 0 auto;
}
.lr-content {
    padding: 60px 0 80px;
    max-width: 900px;
    margin: 0 auto;
}
.lr-section {
    margin-bottom: 60px;
}
.lr-section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 30px;
    padding-bottom: 14px;
    border-bottom: 2px solid var(--gris-clair);
}
.lr-section-icon {
    font-size: 1.5rem;
}

/* Cartes de livraison */
.shipping-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}
.shipping-card {
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    padding: 28px 24px;
    text-align: center;
    transition: border-color 0.3s, box-shadow 0.3s;
}
.shipping-card:hover {
    border-color: var(--accent);
    box-shadow: 0 4px 16px rgba(255,90,31,0.1);
}
.shipping-card.featured {
    border-color: var(--accent);
    position: relative;
}
.shipping-card.featured::before {
    content: 'Populaire';
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--accent);
    color: var(--blanc);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 3px 14px;
    border-radius: 20px;
}
.shipping-card-icon {
    font-size: 2rem;
    margin-bottom: 14px;
}
.shipping-card h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.shipping-card .price {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 6px;
}
.shipping-card .delay {
    color: var(--gris);
    font-size: 0.88rem;
    margin-bottom: 12px;
}
.shipping-card .note {
    color: var(--gris);
    font-size: 0.82rem;
    font-style: italic;
}

/* Tableau des zones */
.lr-table-wrapper {
    overflow-x: auto;
    margin-bottom: 30px;
}
.lr-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    font-size: 0.92rem;
}
.lr-table thead {
    background: var(--noir);
    color: var(--blanc);
}
.lr-table th {
    padding: 14px 20px;
    text-align: left;
    font-weight: 600;
}
.lr-table td {
    padding: 14px 20px;
    border-bottom: 1px solid #eee;
}
.lr-table tbody tr:hover {
    background: var(--gris-clair);
}
.lr-table tbody tr:last-child td {
    border-bottom: none;
}

/* Infos */
.lr-info-box {
    background: var(--gris-clair);
    border-radius: 10px;
    padding: 24px 28px;
    margin-bottom: 25px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
}
.lr-info-box.highlight {
    background: #fff7ed;
    border: 1px solid #fed7aa;
}
.lr-info-icon {
    font-size: 1.4rem;
    flex-shrink: 0;
    margin-top: 2px;
}
.lr-info-box h4 {
    font-size: 0.98rem;
    font-weight: 600;
    margin-bottom: 6px;
}
.lr-info-box p {
    color: var(--gris);
    font-size: 0.9rem;
    line-height: 1.7;
    margin: 0;
}

/* Steps */
.retour-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 30px 0;
}
.retour-step {
    text-align: center;
    padding: 24px 16px;
    background: var(--gris-clair);
    border-radius: 12px;
    position: relative;
}
.retour-step-num {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--accent);
    color: var(--blanc);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
    margin-bottom: 14px;
}
.retour-step h4 {
    font-size: 0.92rem;
    font-weight: 600;
    margin-bottom: 8px;
}
.retour-step p {
    color: var(--gris);
    font-size: 0.82rem;
    line-height: 1.6;
    margin: 0;
}

/* Conditions */
.conditions-list {
    list-style: none;
    padding: 0;
    margin: 0 0 25px;
}
.conditions-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    font-size: 0.92rem;
    color: #444;
    line-height: 1.6;
}
.conditions-list li::before {
    content: '✓';
    color: var(--accent);
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 1px;
}

.lr-cta {
    text-align: center;
    background: var(--gris-clair);
    border-radius: 12px;
    padding: 40px 30px;
}
.lr-cta p {
    color: var(--gris);
    font-size: 0.95rem;
    margin-bottom: 18px;
}
.lr-cta .btn {
    display: inline-block;
    background: var(--accent);
    color: var(--blanc);
    padding: 12px 32px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: opacity 0.3s;
}
.lr-cta .btn:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .lr-hero h1 {
        font-size: 1.8rem;
    }
    .shipping-cards {
        grid-template-columns: 1fr;
    }
    .retour-steps {
        grid-template-columns: 1fr 1fr;
    }
    .lr-content {
        padding: 40px 20px 60px;
    }
}
</style>

<section class="lr-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>Livraison &amp; Retours</span>
        </nav>
        <h1>Livraison &amp; Retours</h1>
        <p>Tout ce que vous devez savoir sur nos options de livraison et notre politique de retour.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="lr-content">

            <!-- SECTION LIVRAISON -->
            <div class="lr-section">
                <h2 class="lr-section-title">
                    <span class="lr-section-icon">🚚</span>
                    Livraison
                </h2>

                <!-- Cartes des options -->
                <div class="shipping-cards">
                    <div class="shipping-card featured">
                        <div class="shipping-card-icon">📦</div>
                        <h3>Standard</h3>
                        <div class="price">2 500 FCFA</div>
                        <div class="delay">3 à 5 jours ouvrés</div>
                        <div class="note">Toute la Côte d'Ivoire</div>
                    </div>
                    <div class="shipping-card">
                        <div class="shipping-card-icon">⚡</div>
                        <h3>Express</h3>
                        <div class="price">5 000 FCFA</div>
                        <div class="delay">1 à 2 jours ouvrés</div>
                        <div class="note">Abidjan uniquement</div>
                    </div>
                    <div class="shipping-card">
                        <div class="shipping-card-icon">🎁</div>
                        <h3>Gratuite</h3>
                        <div class="price">0 FCFA</div>
                        <div class="delay">3 à 5 jours ouvrés</div>
                        <div class="note">Dès 25 000 FCFA d'achat</div>
                    </div>
                </div>

                <!-- Tableau des zones -->
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:16px;">Zones de livraison &amp; tarifs</h3>
                <div class="lr-table-wrapper">
                    <table class="lr-table">
                        <thead>
                            <tr>
                                <th>Zone</th>
                                <th>Mode</th>
                                <th>Délai</th>
                                <th>Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Abidjan</td>
                                <td>Standard</td>
                                <td>3 – 5 jours ouvrés</td>
                                <td><strong>2 500 FCFA</strong></td>
                            </tr>
                            <tr>
                                <td>Abidjan</td>
                                <td>Express</td>
                                <td>1 – 2 jours ouvrés</td>
                                <td><strong>5 000 FCFA</strong></td>
                            </tr>
                            <tr>
                                <td>Côte d'Ivoire (hors Abidjan)</td>
                                <td>Standard</td>
                                <td>5 – 7 jours ouvrés</td>
                                <td><strong>3 500 FCFA</strong></td>
                            </tr>
                            <tr>
                                <td>Afrique de l'Ouest</td>
                                <td>Standard</td>
                                <td>7 – 14 jours ouvrés</td>
                                <td><strong>À partir de 7 500 FCFA</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="lr-info-box highlight">
                    <span class="lr-info-icon">🎉</span>
                    <div>
                        <h4>Livraison offerte dès 25 000 FCFA</h4>
                        <p>Profitez de la livraison standard gratuite en Côte d'Ivoire pour toute commande d'un montant supérieur ou égal à 25 000 FCFA. L'offre est automatiquement appliquée à votre panier.</p>
                    </div>
                </div>

                <div class="lr-info-box">
                    <span class="lr-info-icon">📱</span>
                    <div>
                        <h4>Suivi de votre commande</h4>
                        <p>Un numéro de suivi vous est communiqué par e-mail dès l'expédition de votre colis. Vous pouvez également consulter le statut de votre commande en temps réel depuis votre espace client, rubrique « Mes commandes ».</p>
                    </div>
                </div>
            </div>

            <!-- SECTION RETOURS -->
            <div class="lr-section">
                <h2 class="lr-section-title">
                    <span class="lr-section-icon">🔄</span>
                    Retours &amp; Échanges
                </h2>

                <p style="color:var(--gris);font-size:0.95rem;line-height:1.7;margin-bottom:25px;">
                    Votre satisfaction est notre priorité. Si un article ne vous convient pas, vous pouvez le retourner ou l'échanger dans les conditions suivantes.
                </p>

                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:16px;">Conditions de retour</h3>
                <ul class="conditions-list">
                    <li>L'article doit être retourné dans un délai de <strong>14 jours</strong> après réception</li>
                    <li>L'article ne doit pas avoir été porté, lavé ou endommagé</li>
                    <li>Toutes les étiquettes doivent être attachées et intactes</li>
                    <li>L'article doit être dans son emballage d'origine</li>
                    <li>Les articles soldés ou en promotion sont échangeables mais non remboursables</li>
                    <li>Les sous-vêtements et accessoires intimes ne sont ni repris ni échangés</li>
                </ul>

                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:16px;">Comment procéder ?</h3>
                <div class="retour-steps">
                    <div class="retour-step">
                        <div class="retour-step-num">1</div>
                        <h4>Contactez-nous</h4>
                        <p>Envoyez un e-mail ou appelez notre service client avec votre numéro de commande.</p>
                    </div>
                    <div class="retour-step">
                        <div class="retour-step-num">2</div>
                        <h4>Préparez le colis</h4>
                        <p>Emballez l'article avec soin dans son emballage d'origine avec les étiquettes.</p>
                    </div>
                    <div class="retour-step">
                        <div class="retour-step-num">3</div>
                        <h4>Expédiez</h4>
                        <p>Envoyez le colis à l'adresse indiquée par notre service client.</p>
                    </div>
                    <div class="retour-step">
                        <div class="retour-step-num">4</div>
                        <h4>Remboursement</h4>
                        <p>Votre remboursement est traité sous 7 jours après réception du retour.</p>
                    </div>
                </div>

                <div class="lr-info-box">
                    <span class="lr-info-icon">💰</span>
                    <div>
                        <h4>Remboursement</h4>
                        <p>Le remboursement est effectué sur le même moyen de paiement utilisé lors de la commande, dans un délai de 7 jours ouvrés après réception et vérification du retour. Les frais de livraison initiaux ne sont pas remboursés, sauf en cas d'erreur de notre part ou d'article défectueux.</p>
                    </div>
                </div>

                <div class="lr-info-box">
                    <span class="lr-info-icon">🔄</span>
                    <div>
                        <h4>Échanges</h4>
                        <p>Vous souhaitez changer de taille ou de couleur ? L'échange est possible dans les mêmes conditions que le retour. Contactez notre service client pour organiser l'échange. Si le nouvel article est d'un montant différent, la différence sera facturée ou remboursée.</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="lr-cta">
                <p>Une question sur la livraison ou un retour ? Contactez notre service client.</p>
                <a href="<?= e(BASE_URL) ?>/contact.php" class="btn">Nous contacter</a>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

