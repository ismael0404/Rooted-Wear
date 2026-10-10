<?php
/**
 * URBAN STYLE - Conditions Générales de Vente
 * CGV complètes en français
 */
require_once __DIR__ . '/includes/init.php';

$page_titre = 'Conditions Générales de Vente';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.cgv-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.cgv-hero h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.cgv-hero p {
    color: var(--gris);
    font-size: 0.95rem;
}
.cgv-content {
    padding: 60px 0 80px;
    max-width: 820px;
    margin: 0 auto;
}
.cgv-last-update {
    color: var(--gris);
    font-size: 0.85rem;
    margin-bottom: 40px;
    font-style: italic;
}
.cgv-article {
    margin-bottom: 35px;
}
.cgv-article h2 {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 14px;
    color: var(--noir);
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
}
.cgv-article p {
    color: #444;
    font-size: 0.92rem;
    line-height: 1.8;
    margin-bottom: 12px;
}
.cgv-article ul {
    margin: 10px 0 14px 20px;
    padding: 0;
}
.cgv-article ul li {
    color: #444;
    font-size: 0.92rem;
    line-height: 1.8;
    margin-bottom: 4px;
}
@media (max-width: 768px) {
    .cgv-hero h1 {
        font-size: 1.7rem;
    }
    .cgv-content {
        padding: 40px 20px 60px;
    }
}
</style>

<section class="cgv-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>Conditions Générales de Vente</span>
        </nav>
        <h1>Conditions Générales de Vente</h1>
        <p>Veuillez lire attentivement les présentes conditions avant toute utilisation de notre site.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cgv-content">
            <p class="cgv-last-update">Dernière mise à jour : Janvier 2024</p>

            <div class="cgv-article">
                <h2>Article 1 – Objet</h2>
                <p>Les présentes Conditions Générales de Vente (ci-après « CGV ») régissent l'ensemble des ventes de produits effectuées par la société URBAN STYLE, dont le siège social est situé à Cocody Riviera Palmeraie, Abidjan, Côte d'Ivoire, à travers son site internet accessible à l'adresse urbanstyle.ci (ci-après le « Site »).</p>
                <p>Les présentes CGV s'appliquent à l'exclusion de toutes autres conditions, et notamment celles applicables pour d'autres circuits de commercialisation des produits. Elles sont accessibles à tout moment sur le Site et prévaudront, le cas échéant, sur toute autre version ou tout autre document contradictoire.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 2 – Acceptation des conditions</h2>
                <p>La validation de la commande par le client implique l'acceptation sans réserve des présentes CGV. Le client reconnaît avoir pris connaissance des CGV avant la passation de sa commande et les avoir acceptées en cochant la case prévue à cet effet.</p>
                <p>URBAN STYLE se réserve le droit de modifier les présentes CGV à tout moment. Les CGV applicables sont celles en vigueur à la date de la commande. Il est donc conseillé au client de consulter régulièrement la dernière version des CGV disponible sur le Site.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 3 – Produits</h2>
                <p>Les produits proposés à la vente sont ceux qui figurent sur le Site au jour de la consultation par le client. Les photographies et descriptions des produits sont les plus fidèles possibles, mais ne sauraient engager la responsabilité d'URBAN STYLE en cas de légères différences avec le produit livré (notamment en ce qui concerne les couleurs, qui peuvent varier en fonction des paramètres d'affichage de l'écran).</p>
                <p>URBAN STYLE s'efforce de présenter les caractéristiques essentielles des produits (composition, taille, couleur, entretien) sur chaque fiche produit. Les offres de produits sont valables dans la limite des stocks disponibles. En cas d'indisponibilité d'un produit après passation de la commande, le client en sera informé dans les meilleurs délais.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 4 – Prix</h2>
                <p>Les prix des produits sont indiqués en Francs CFA (FCFA / XOF), toutes taxes comprises. URBAN STYLE se réserve le droit de modifier ses prix à tout moment, étant entendu que le prix figurant sur le Site au jour de la commande sera le seul applicable au client.</p>
                <p>Les frais de livraison ne sont pas inclus dans le prix des produits et sont indiqués séparément lors du processus de commande, avant la validation définitive par le client. Le montant total dû par le client, frais de livraison inclus, est indiqué sur la page de confirmation de commande.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 5 – Commande</h2>
                <p>Le client passe sa commande en ligne sur le Site en suivant le processus suivant :</p>
                <ul>
                    <li>Sélection des produits et ajout au panier</li>
                    <li>Vérification du contenu du panier</li>
                    <li>Identification du client (connexion ou création de compte)</li>
                    <li>Saisie de l'adresse de livraison</li>
                    <li>Choix du mode de livraison</li>
                    <li>Choix du mode de paiement et validation du paiement</li>
                    <li>Confirmation de la commande</li>
                </ul>
                <p>La commande n'est définitivement validée qu'après réception du paiement intégral du prix. Un e-mail de confirmation récapitulant la commande est envoyé au client. URBAN STYLE se réserve le droit de refuser ou d'annuler toute commande en cas de litige antérieur avec le client, de suspicion de fraude ou de commande anormale.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 6 – Paiement</h2>
                <p>Le paiement du prix s'effectue au moment de la commande, selon les modes de paiement suivants :</p>
                <ul>
                    <li>Mobile Money (Orange Money, MTN Mobile Money, Moov Money, Wave)</li>
                    <li>Carte bancaire (Visa, Mastercard) via notre plateforme de paiement sécurisée</li>
                    <li>Paiement à la livraison (Abidjan uniquement, supplément de 1 000 FCFA)</li>
                </ul>
                <p>Les paiements sont sécurisés par le protocole SSL. Les données bancaires du client ne sont pas conservées par URBAN STYLE. En cas de paiement à la livraison, le client s'engage à régler le montant total de sa commande au livreur au moment de la réception du colis.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 7 – Livraison</h2>
                <p>Les produits sont livrés à l'adresse indiquée par le client lors de la commande. Les délais de livraison indiqués sur le Site sont donnés à titre indicatif et courent à compter de la date d'expédition de la commande.</p>
                <p>En cas de retard de livraison, le client pourra contacter le service client d'URBAN STYLE. Un retard de livraison ne pourra donner lieu à l'annulation de la commande que si le retard excède 30 jours calendaires à compter de la date d'expédition. Le client est tenu de vérifier le bon état du colis à la réception et de signaler toute anomalie dans un délai de 48 heures.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 8 – Droit de rétractation</h2>
                <p>Conformément à la réglementation en vigueur, le client dispose d'un délai de quatorze (14) jours à compter de la réception des produits pour exercer son droit de rétractation, sans avoir à justifier de motifs ni à payer de pénalités.</p>
                <p>Pour exercer ce droit, le client doit notifier sa décision de rétractation au service client d'URBAN STYLE par e-mail à contact@urbanstyle.ci ou par courrier. Les produits doivent être retournés dans leur état d'origine, non portés, non lavés, avec toutes les étiquettes et dans leur emballage d'origine.</p>
                <p>Le droit de rétractation ne peut être exercé pour les sous-vêtements et articles intimes pour des raisons d'hygiène, ni pour les articles personnalisés ou confectionnés sur mesure.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 9 – Garantie</h2>
                <p>Tous les produits vendus par URBAN STYLE bénéficient de la garantie légale de conformité et de la garantie contre les vices cachés, conformément aux dispositions légales en vigueur.</p>
                <p>En cas de produit non conforme ou présentant un défaut, le client peut demander le remplacement ou le remboursement du produit en contactant le service client dans un délai de trente (30) jours à compter de la réception. La garantie ne couvre pas les dommages résultant d'une utilisation anormale, d'un défaut d'entretien ou de l'usure normale du produit.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 10 – Responsabilité</h2>
                <p>URBAN STYLE s'engage à fournir des produits conformes aux descriptions figurant sur le Site. La responsabilité d'URBAN STYLE ne saurait être engagée dans les cas suivants :</p>
                <ul>
                    <li>Non-respect de la législation du pays dans lequel les produits sont livrés</li>
                    <li>Mauvaise utilisation, négligence ou défaut d'entretien de la part du client</li>
                    <li>Force majeure ou cas fortuit</li>
                    <li>Fait imprévisible et insurmontable d'un tiers</li>
                </ul>
                <p>En tout état de cause, la responsabilité d'URBAN STYLE sera limitée au montant de la commande concernée.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 11 – Données personnelles</h2>
                <p>Les informations personnelles collectées lors de la commande sont nécessaires au traitement et à la livraison de celle-ci. Elles sont traitées conformément à notre Politique de Confidentialité, accessible sur le Site.</p>
                <p>Le client dispose d'un droit d'accès, de rectification, de suppression et d'opposition sur ses données personnelles, qu'il peut exercer en contactant URBAN STYLE à l'adresse contact@urbanstyle.ci. Pour plus d'informations, le client est invité à consulter notre <a href="<?= e(BASE_URL) ?>/confidentialite.php" style="color:var(--accent)">Politique de Confidentialité</a>.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 12 – Propriété intellectuelle</h2>
                <p>L'ensemble des éléments du Site (textes, images, logos, icônes, sons, logiciels, mise en page, base de données) sont la propriété exclusive d'URBAN STYLE ou de ses partenaires et sont protégés par les lois relatives à la propriété intellectuelle.</p>
                <p>Toute reproduction, représentation, modification, distribution ou exploitation de tout ou partie des éléments du Site, par quelque moyen et sur quelque support que ce soit, sans l'autorisation écrite préalable d'URBAN STYLE, est strictement interdite et constituerait une contrefaçon sanctionnée par la loi.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 13 – Droit applicable</h2>
                <p>Les présentes CGV sont soumises au droit ivoirien. En cas de litige relatif à l'interprétation ou à l'exécution des présentes CGV, les parties s'efforceront de trouver une solution amiable. À défaut d'accord amiable dans un délai de trente (30) jours, le litige sera soumis aux tribunaux compétents d'Abidjan, Côte d'Ivoire.</p>
                <p>Si l'une des clauses des présentes CGV était déclarée nulle ou inapplicable, les autres clauses resteront en vigueur et conserveront leur plein effet.</p>
            </div>

            <div class="cgv-article">
                <h2>Article 14 – Contact</h2>
                <p>Pour toute question relative aux présentes CGV, le client peut contacter URBAN STYLE :</p>
                <ul>
                    <li><strong>Adresse :</strong> Cocody Riviera Palmeraie, Abidjan, Côte d'Ivoire</li>
                    <li><strong>Téléphone :</strong> +225 01 02 03 04 05</li>
                    <li><strong>E-mail :</strong> <a href="mailto:contact@urbanstyle.ci" style="color:var(--accent)">contact@urbanstyle.ci</a></li>
                </ul>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

