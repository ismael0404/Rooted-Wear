<?php
/**
 * URBAN STYLE - Page FAQ
 * Questions fréquemment posées avec accordéon
 */
require_once __DIR__ . '/includes/init.php';

$page_titre = 'Questions Fréquentes';
require_once __DIR__ . '/includes/header.php';

$faq_sections = [
    [
        'titre' => 'Commandes',
        'icone' => '🛒',
        'questions' => [
            [
                'q' => 'Comment passer une commande ?',
                'r' => 'Passer une commande sur URBAN STYLE est simple et rapide. Parcourez notre catalogue, sélectionnez les articles qui vous plaisent en choisissant la taille et la couleur souhaitées, puis ajoutez-les à votre panier. Une fois votre sélection terminée, cliquez sur « Voir le panier » puis « Passer la commande ». Remplissez vos informations de livraison, choisissez votre mode de paiement et validez votre commande. Vous recevrez un e-mail de confirmation avec le récapitulatif de votre commande.'
            ],
            [
                'q' => 'Comment suivre ma commande ?',
                'r' => 'Dès que votre commande est expédiée, vous recevez un e-mail contenant un numéro de suivi. Vous pouvez également suivre l\'état de votre commande en vous connectant à votre compte, dans la rubrique « Mes commandes ». Le statut est mis à jour en temps réel : en préparation, expédiée, en cours de livraison, livrée.'
            ],
            [
                'q' => 'Puis-je modifier ou annuler ma commande ?',
                'r' => 'Vous pouvez modifier ou annuler votre commande tant qu\'elle n\'a pas encore été expédiée. Pour cela, connectez-vous à votre compte et accédez à « Mes commandes », ou contactez notre service client par e-mail à contact@urbanstyle.ci ou par téléphone au +225 01 02 03 04 05. Si la commande a déjà été expédiée, vous pourrez effectuer un retour après réception.'
            ],
            [
                'q' => 'Quels sont les délais de livraison ?',
                'r' => 'Les délais de livraison dépendent de votre zone géographique et du mode de livraison choisi. Pour Abidjan : livraison standard en 3 à 5 jours ouvrés, livraison express en 1 à 2 jours ouvrés. Pour le reste de la Côte d\'Ivoire : 5 à 7 jours ouvrés. Pour l\'Afrique de l\'Ouest : 7 à 14 jours ouvrés. Ces délais commencent à la date d\'expédition de votre colis.'
            ],
        ]
    ],
    [
        'titre' => 'Livraison',
        'icone' => '🚚',
        'questions' => [
            [
                'q' => 'Quelles sont les zones de livraison ?',
                'r' => 'Nous livrons actuellement dans toute la Côte d\'Ivoire (Abidjan et villes de l\'intérieur) ainsi que dans plusieurs pays d\'Afrique de l\'Ouest : Sénégal, Mali, Burkina Faso, Guinée, Togo, Bénin, Niger, Ghana et Cameroun. Nous travaillons à étendre notre couverture pour desservir davantage de pays africains.'
            ],
            [
                'q' => 'Combien coûte la livraison ?',
                'r' => 'Les frais de livraison varient selon la destination et le mode choisi. Livraison standard à Abidjan : 2 500 FCFA. Livraison express à Abidjan : 5 000 FCFA. Livraison dans le reste de la Côte d\'Ivoire : à partir de 3 500 FCFA. Livraison en Afrique de l\'Ouest : à partir de 7 500 FCFA. Les frais exacts sont calculés au moment de la validation de votre commande.'
            ],
            [
                'q' => 'La livraison est-elle gratuite ?',
                'r' => 'Oui ! La livraison standard est offerte pour toute commande d\'un montant supérieur ou égal à 25 000 FCFA en Côte d\'Ivoire. Cette offre est automatiquement appliquée lors de la validation de votre panier. Des promotions occasionnelles peuvent également offrir la livraison gratuite — suivez-nous sur nos réseaux sociaux pour ne rien manquer !'
            ],
        ]
    ],
    [
        'titre' => 'Paiement',
        'icone' => '💳',
        'questions' => [
            [
                'q' => 'Quels modes de paiement acceptez-vous ?',
                'r' => 'Nous acceptons plusieurs modes de paiement pour faciliter vos achats : Mobile Money (Orange Money, MTN Mobile Money, Moov Money, Wave), cartes bancaires (Visa, Mastercard), et le paiement à la livraison (disponible uniquement à Abidjan). Tous les paiements sont sécurisés et vos données bancaires ne sont jamais stockées sur nos serveurs.'
            ],
            [
                'q' => 'Le paiement est-il sécurisé ?',
                'r' => 'Absolument. La sécurité de vos transactions est notre priorité. Nous utilisons le protocole SSL (Secure Socket Layer) pour chiffrer toutes les données échangées. Nos partenaires de paiement sont certifiés et respectent les normes internationales de sécurité. Vos informations de paiement ne sont jamais stockées sur nos serveurs.'
            ],
            [
                'q' => 'Puis-je payer à la livraison ?',
                'r' => 'Oui, le paiement à la livraison est disponible pour les commandes livrées à Abidjan. Vous réglez le montant total de votre commande en espèces ou par Mobile Money directement auprès du livreur au moment de la réception de votre colis. Un supplément de 1 000 FCFA est appliqué pour ce mode de paiement. Cette option n\'est pas disponible pour les livraisons hors Abidjan.'
            ],
        ]
    ],
    [
        'titre' => 'Retours & Échanges',
        'icone' => '🔄',
        'questions' => [
            [
                'q' => 'Comment retourner un article ?',
                'r' => 'Pour retourner un article, contactez notre service client à contact@urbanstyle.ci ou au +225 01 02 03 04 05 en précisant votre numéro de commande et le motif du retour. Nous vous enverrons les instructions de retour ainsi qu\'une étiquette si nécessaire. L\'article doit être retourné dans son état d\'origine, non porté, non lavé, avec toutes les étiquettes attachées et dans son emballage d\'origine.'
            ],
            [
                'q' => 'Quel est le délai de retour ?',
                'r' => 'Vous disposez de 14 jours à compter de la date de réception de votre commande pour effectuer un retour. Passé ce délai, les retours ne pourront malheureusement pas être acceptés. Le retour doit être initié dans ce délai, mais l\'article peut être expédié dans les jours suivants après accord de notre service client.'
            ],
            [
                'q' => 'Comment obtenir un remboursement ?',
                'r' => 'Une fois votre retour réceptionné et vérifié par notre équipe, le remboursement est effectué dans un délai de 7 jours ouvrés. Le remboursement se fait sur le même moyen de paiement utilisé lors de la commande. Vous recevrez un e-mail de confirmation dès que le remboursement sera traité. Les frais de livraison initiaux ne sont pas remboursés sauf en cas d\'erreur de notre part.'
            ],
        ]
    ],
    [
        'titre' => 'Compte',
        'icone' => '👤',
        'questions' => [
            [
                'q' => 'Comment créer un compte ?',
                'r' => 'Créer un compte URBAN STYLE est gratuit et ne prend que quelques secondes. Cliquez sur l\'icône « Compte » en haut de la page, puis sur « Créer un compte ». Remplissez le formulaire avec votre nom, votre adresse e-mail et un mot de passe sécurisé. Vous pouvez également créer un compte lors de votre première commande. Un compte vous permet de suivre vos commandes, enregistrer vos adresses et profiter d\'offres exclusives.'
            ],
            [
                'q' => 'J\'ai oublié mon mot de passe',
                'r' => 'Pas de panique ! Cliquez sur « Connexion » puis sur « Mot de passe oublié ? ». Entrez l\'adresse e-mail associée à votre compte et vous recevrez un lien de réinitialisation par e-mail. Cliquez sur ce lien et choisissez un nouveau mot de passe. Si vous ne recevez pas l\'e-mail, vérifiez votre dossier spam ou contactez notre service client.'
            ],
            [
                'q' => 'Comment modifier mes informations ?',
                'r' => 'Connectez-vous à votre compte et accédez à la rubrique « Mon profil ». Vous pourrez y modifier votre nom, votre adresse e-mail, votre numéro de téléphone, votre mot de passe et vos adresses de livraison. N\'oubliez pas de cliquer sur « Enregistrer » pour valider vos modifications.'
            ],
        ]
    ],
    [
        'titre' => 'Tailles',
        'icone' => '📏',
        'questions' => [
            [
                'q' => 'Comment choisir ma taille ?',
                'r' => 'Pour trouver votre taille idéale, nous vous recommandons de vous référer à notre guide des tailles disponible sur chaque fiche produit. Prenez vos mensurations (tour de poitrine, tour de taille, tour de hanches) avec un mètre ruban et comparez-les aux mesures indiquées dans le guide. En cas de doute entre deux tailles, nous vous conseillons de prendre la taille supérieure pour plus de confort. N\'hésitez pas à contacter notre service client pour des conseils personnalisés.'
            ],
            [
                'q' => 'Proposez-vous un guide des tailles ?',
                'r' => 'Oui, un guide des tailles détaillé est disponible sur chaque fiche produit. Il inclut les mesures en centimètres pour chaque taille (XS, S, M, L, XL, XXL) et des conseils pour prendre vos mesures correctement. Nos guides sont spécifiques à chaque type de vêtement (hauts, bas, chaussures) car les tailles peuvent varier. Vous trouverez également des indications sur la coupe du vêtement (ajustée, regular, oversize) pour vous aider dans votre choix.'
            ],
        ]
    ],
];
?>

<style>
.faq-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.faq-hero h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.faq-hero p {
    color: var(--gris);
    font-size: 1.05rem;
    max-width: 520px;
    margin: 0 auto;
}
.faq-container {
    padding: 60px 0 80px;
    max-width: 850px;
    margin: 0 auto;
}
.faq-section {
    margin-bottom: 45px;
}
.faq-section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--gris-clair);
}
.faq-section-icon {
    font-size: 1.4rem;
}
.accordion {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.accordion-item {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow 0.3s;
}
.accordion-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.accordion-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    background: var(--blanc);
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 0.98rem;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    color: var(--noir);
    transition: background 0.2s;
}
.accordion-header:hover {
    background: var(--gris-clair);
}
.accordion-header::after {
    content: '+';
    font-size: 1.3rem;
    font-weight: 300;
    color: var(--gris);
    transition: transform 0.3s;
    flex-shrink: 0;
    margin-left: 16px;
}
.accordion-item.active .accordion-header::after {
    content: '−';
}
.accordion-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, padding 0.35s ease;
}
.accordion-item.active .accordion-body {
    max-height: 600px;
}
.accordion-body-inner {
    padding: 0 22px 20px;
    color: var(--gris);
    font-size: 0.92rem;
    line-height: 1.8;
}
.faq-contact-cta {
    text-align: center;
    background: var(--gris-clair);
    border-radius: 12px;
    padding: 45px 30px;
    margin-top: 20px;
}
.faq-contact-cta h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.faq-contact-cta p {
    color: var(--gris);
    font-size: 0.95rem;
    margin-bottom: 22px;
}
.faq-contact-cta .btn {
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
.faq-contact-cta .btn:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .faq-hero h1 {
        font-size: 1.8rem;
    }
    .faq-container {
        padding: 40px 20px 60px;
    }
}
</style>

<section class="faq-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>FAQ</span>
        </nav>
        <h1>Questions Fréquentes</h1>
        <p>Trouvez rapidement les réponses à vos questions les plus courantes.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-container">

            <?php foreach ($faq_sections as $section): ?>
                <div class="faq-section">
                    <h2 class="faq-section-title">
                        <span class="faq-section-icon"><?= $section['icone'] ?></span>
                        <?= e($section['titre']) ?>
                    </h2>
                    <div class="accordion">
                        <?php foreach ($section['questions'] as $faq): ?>
                            <div class="accordion-item">
                                <button class="accordion-header" type="button">
                                    <?= e($faq['q']) ?>
                                </button>
                                <div class="accordion-body">
                                    <div class="accordion-body-inner">
                                        <?= e($faq['r']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="faq-contact-cta">
                <h3>Vous n'avez pas trouvé votre réponse ?</h3>
                <p>Notre équipe est disponible pour répondre à toutes vos questions.</p>
                <a href="<?= e(BASE_URL) ?>/contact.php" class="btn">Nous contacter</a>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.accordion-header').forEach(function(header) {
        header.addEventListener('click', function() {
            var item = this.parentElement;
            var isActive = item.classList.contains('active');
            // Fermer les autres dans la même section
            item.closest('.accordion').querySelectorAll('.accordion-item.active').forEach(function(openItem) {
                openItem.classList.remove('active');
            });
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

