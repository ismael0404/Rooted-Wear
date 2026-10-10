<?php
/**
 * URBAN STYLE - Politique de Confidentialité
 * Protection des données personnelles
 */
require_once __DIR__ . '/includes/init.php';

$page_titre = 'Politique de Confidentialité';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.privacy-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.privacy-hero h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.privacy-hero p {
    color: var(--gris);
    font-size: 0.95rem;
}
.privacy-content {
    padding: 60px 0 80px;
    max-width: 820px;
    margin: 0 auto;
}
.privacy-intro {
    background: var(--gris-clair);
    border-radius: 10px;
    padding: 24px 28px;
    margin-bottom: 40px;
    font-size: 0.92rem;
    line-height: 1.8;
    color: #444;
}
.privacy-last-update {
    color: var(--gris);
    font-size: 0.85rem;
    margin-bottom: 40px;
    font-style: italic;
}
.privacy-section {
    margin-bottom: 35px;
}
.privacy-section h2 {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 14px;
    color: var(--noir);
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
}
.privacy-section p {
    color: #444;
    font-size: 0.92rem;
    line-height: 1.8;
    margin-bottom: 12px;
}
.privacy-section ul {
    margin: 10px 0 14px 20px;
    padding: 0;
}
.privacy-section ul li {
    color: #444;
    font-size: 0.92rem;
    line-height: 1.8;
    margin-bottom: 4px;
}
.privacy-section strong {
    color: var(--noir);
}
.privacy-contact-box {
    background: var(--gris-clair);
    border-radius: 10px;
    padding: 28px 30px;
    margin-top: 40px;
}
.privacy-contact-box h3 {
    font-size: 1.05rem;
    font-weight: 700;
    margin-bottom: 12px;
}
.privacy-contact-box p {
    color: #444;
    font-size: 0.9rem;
    line-height: 1.7;
    margin-bottom: 6px;
}
.privacy-contact-box a {
    color: var(--accent);
    text-decoration: none;
}
.privacy-contact-box a:hover {
    text-decoration: underline;
}
@media (max-width: 768px) {
    .privacy-hero h1 {
        font-size: 1.7rem;
    }
    .privacy-content {
        padding: 40px 20px 60px;
    }
}
</style>

<section class="privacy-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>Politique de Confidentialité</span>
        </nav>
        <h1>Politique de Confidentialité</h1>
        <p>Comment nous protégeons et utilisons vos données personnelles.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="privacy-content">
            <p class="privacy-last-update">Dernière mise à jour : Janvier 2024</p>

            <div class="privacy-intro">
                La société URBAN STYLE, dont le siège social est situé à Cocody Riviera Palmeraie, Abidjan, Côte d'Ivoire, s'engage à protéger la vie privée de ses utilisateurs. La présente politique de confidentialité décrit les types de données personnelles que nous collectons, la manière dont nous les utilisons et les mesures que nous prenons pour les protéger, conformément à la réglementation en vigueur en matière de protection des données personnelles.
            </div>

            <div class="privacy-section">
                <h2>1. Collecte des données</h2>
                <p>Nous collectons les données personnelles que vous nous fournissez directement lors de :</p>
                <ul>
                    <li>La création de votre compte client (nom, prénom, adresse e-mail, mot de passe, numéro de téléphone)</li>
                    <li>La passation d'une commande (adresse de livraison, adresse de facturation)</li>
                    <li>L'utilisation de notre formulaire de contact (nom, e-mail, sujet, message)</li>
                    <li>L'inscription à notre newsletter (adresse e-mail)</li>
                    <li>La navigation sur notre site (données de connexion, adresse IP, type de navigateur, pages visitées, via les cookies)</li>
                </ul>
                <p>Nous ne collectons que les données strictement nécessaires aux finalités décrites ci-dessous. Les données marquées d'un astérisque (*) dans nos formulaires sont obligatoires ; sans elles, nous ne pourrons traiter votre demande.</p>
            </div>

            <div class="privacy-section">
                <h2>2. Utilisation des données</h2>
                <p>Vos données personnelles sont utilisées pour les finalités suivantes :</p>
                <ul>
                    <li><strong>Gestion des commandes :</strong> traitement, préparation, expédition et suivi de vos commandes</li>
                    <li><strong>Gestion du compte client :</strong> création, authentification et gestion de votre espace personnel</li>
                    <li><strong>Service client :</strong> réponse à vos demandes, réclamations et assistance</li>
                    <li><strong>Communication commerciale :</strong> envoi de newsletters, offres promotionnelles et informations sur nos nouveautés (uniquement avec votre consentement)</li>
                    <li><strong>Amélioration du site :</strong> analyse de la navigation pour améliorer l'expérience utilisateur et le contenu du site</li>
                    <li><strong>Obligations légales :</strong> respect de nos obligations comptables, fiscales et légales</li>
                </ul>
            </div>

            <div class="privacy-section">
                <h2>3. Protection des données</h2>
                <p>URBAN STYLE met en œuvre les mesures techniques et organisationnelles appropriées pour protéger vos données personnelles contre tout accès non autorisé, toute modification, divulgation ou destruction. Ces mesures comprennent :</p>
                <ul>
                    <li>Le chiffrement SSL de toutes les communications entre votre navigateur et notre serveur</li>
                    <li>Le hachage sécurisé des mots de passe (ils ne sont jamais stockés en clair)</li>
                    <li>La limitation de l'accès aux données personnelles aux seuls employés qui en ont besoin dans le cadre de leurs fonctions</li>
                    <li>La mise à jour régulière de nos systèmes de sécurité</li>
                    <li>La sauvegarde régulière des données</li>
                </ul>
                <p>Malgré toutes les précautions prises, aucune méthode de transmission ou de stockage de données n'est totalement sécurisée. Nous nous engageons à vous informer dans les plus brefs délais en cas de violation de données susceptible d'engendrer un risque élevé pour vos droits et libertés.</p>
            </div>

            <div class="privacy-section">
                <h2>4. Cookies</h2>
                <p>Notre site utilise des cookies pour améliorer votre expérience de navigation. Un cookie est un petit fichier texte déposé sur votre terminal (ordinateur, tablette, smartphone) lors de votre visite sur notre site.</p>
                <p>Nous utilisons les types de cookies suivants :</p>
                <ul>
                    <li><strong>Cookies essentiels :</strong> indispensables au fonctionnement du site (session, panier d'achat, authentification). Ils ne peuvent pas être désactivés.</li>
                    <li><strong>Cookies analytiques :</strong> nous permettent de comprendre comment les visiteurs utilisent le site (pages visitées, temps passé, taux de rebond) afin d'en améliorer le contenu et les performances.</li>
                    <li><strong>Cookies fonctionnels :</strong> permettent de mémoriser vos préférences (langue, devise, derniers articles consultés) pour vous offrir une expérience personnalisée.</li>
                </ul>
                <p>Vous pouvez à tout moment gérer vos préférences en matière de cookies depuis les paramètres de votre navigateur. La suppression ou le refus de certains cookies peut affecter votre expérience de navigation et limiter l'accès à certaines fonctionnalités du site.</p>
            </div>

            <div class="privacy-section">
                <h2>5. Droits des utilisateurs</h2>
                <p>Conformément à la réglementation applicable en matière de protection des données personnelles, vous disposez des droits suivants :</p>
                <ul>
                    <li><strong>Droit d'accès :</strong> vous pouvez demander à connaître les données personnelles que nous détenons à votre sujet</li>
                    <li><strong>Droit de rectification :</strong> vous pouvez demander la correction de données inexactes ou incomplètes</li>
                    <li><strong>Droit de suppression :</strong> vous pouvez demander la suppression de vos données personnelles, sous réserve de nos obligations légales de conservation</li>
                    <li><strong>Droit d'opposition :</strong> vous pouvez vous opposer au traitement de vos données à des fins de prospection commerciale à tout moment</li>
                    <li><strong>Droit à la portabilité :</strong> vous pouvez demander à recevoir vos données dans un format structuré et lisible par machine</li>
                    <li><strong>Droit à la limitation du traitement :</strong> vous pouvez demander la limitation du traitement de vos données dans certains cas prévus par la loi</li>
                </ul>
                <p>Pour exercer l'un de ces droits, veuillez nous contacter à l'adresse contact@urbanstyle.ci. Nous nous engageons à répondre à votre demande dans un délai maximum de trente (30) jours.</p>
            </div>

            <div class="privacy-section">
                <h2>6. Partage des données</h2>
                <p>Vos données personnelles ne sont jamais vendues à des tiers. Elles peuvent être partagées avec :</p>
                <ul>
                    <li><strong>Nos prestataires de livraison :</strong> pour assurer l'acheminement de vos commandes (nom, adresse, téléphone)</li>
                    <li><strong>Nos prestataires de paiement :</strong> pour le traitement sécurisé de vos transactions (données de paiement transmises de manière chiffrée)</li>
                    <li><strong>Nos prestataires techniques :</strong> pour l'hébergement et la maintenance du site</li>
                    <li><strong>Les autorités compétentes :</strong> lorsque la loi l'exige ou en réponse à une décision de justice</li>
                </ul>
                <p>Tous nos prestataires sont contractuellement tenus de protéger vos données et de ne les utiliser que dans le cadre des finalités prévues.</p>
            </div>

            <div class="privacy-section">
                <h2>7. Durée de conservation</h2>
                <p>Nous conservons vos données personnelles pendant la durée strictement nécessaire aux finalités pour lesquelles elles ont été collectées :</p>
                <ul>
                    <li><strong>Données de compte client :</strong> pendant toute la durée de votre compte, puis 3 ans après la dernière activité</li>
                    <li><strong>Données de commande :</strong> 5 ans à compter de la date de la commande (obligations comptables et fiscales)</li>
                    <li><strong>Données de prospection commerciale :</strong> 3 ans à compter du dernier contact</li>
                    <li><strong>Données de contact (formulaire) :</strong> 1 an à compter de la réception du message</li>
                    <li><strong>Cookies :</strong> 13 mois maximum</li>
                </ul>
                <p>À l'expiration de ces délais, vos données sont supprimées ou anonymisées de manière irréversible.</p>
            </div>

            <div class="privacy-section">
                <h2>8. Modifications de la politique</h2>
                <p>URBAN STYLE se réserve le droit de modifier la présente politique de confidentialité à tout moment. Les modifications entreront en vigueur dès leur publication sur le Site. La date de dernière mise à jour est indiquée en haut de la présente page.</p>
                <p>En cas de modification substantielle affectant vos droits, nous vous en informerons par e-mail ou par une notification visible sur le Site. Nous vous encourageons à consulter régulièrement cette page pour rester informé de nos pratiques en matière de protection des données.</p>
            </div>

            <div class="privacy-section">
                <h2>9. Contact – Délégué à la Protection des Données</h2>
                <p>Pour toute question relative à la présente politique de confidentialité ou pour exercer vos droits, vous pouvez contacter notre Délégué à la Protection des Données (DPO) :</p>
            </div>

            <div class="privacy-contact-box">
                <h3>Délégué à la Protection des Données</h3>
                <p><strong>URBAN STYLE – Service Protection des Données</strong></p>
                <p>Cocody Riviera Palmeraie, Abidjan, Côte d'Ivoire</p>
                <p>E-mail : <a href="mailto:dpo@urbanstyle.ci">dpo@urbanstyle.ci</a></p>
                <p>Téléphone : <a href="tel:+2250102030405">+225 01 02 03 04 05</a></p>
                <p style="margin-top:14px;color:var(--gris);font-size:0.85rem;">
                    Si vous estimez, après nous avoir contactés, que vos droits ne sont pas respectés, vous pouvez adresser une réclamation à l'autorité de protection des données compétente (ARTCI – Autorité de Régulation des Télécommunications de Côte d'Ivoire).
                </p>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

