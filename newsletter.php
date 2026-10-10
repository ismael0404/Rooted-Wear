<?php
/**
 * URBAN STYLE - Inscription Newsletter (fallback non-AJAX)
 * Formulaire d'inscription à la newsletter
 */
require_once __DIR__ . '/includes/init.php';

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifier_csrf()) {
        $erreurs[] = 'Jeton de sécurité invalide. Veuillez réessayer.';
    }

    $email = trim(obtenir_parametre('email', ''));

    if ($email === '') {
        $erreurs[] = 'L\'adresse e-mail est obligatoire.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = 'L\'adresse e-mail n\'est pas valide.';
    }

    if (empty($erreurs)) {
        try {
            // Vérifier les doublons
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM newsletter WHERE email = :email');
            $stmt->execute([':email' => $email]);
            $existe = (int) $stmt->fetchColumn();

            if ($existe > 0) {
                message_flash('Cette adresse e-mail est déjà inscrite à notre newsletter.', 'info');
            } else {
                $stmt = $pdo->prepare('INSERT INTO newsletter (email, date_inscription) VALUES (:email, NOW())');
                $stmt->execute([':email' => $email]);
                message_flash('Merci ! Vous êtes maintenant inscrit à notre newsletter. Vous recevrez nos dernières offres et nouveautés.', 'succes');
            }
            rediriger('/newsletter.php');
            exit;
        } catch (PDOException $ex) {
            $erreurs[] = 'Une erreur est survenue. Veuillez réessayer plus tard.';
        }
    }
}

$page_titre = 'Newsletter';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.newsletter-hero {
    background: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.newsletter-hero h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.newsletter-hero p {
    color: var(--gris);
    font-size: 1.05rem;
}
.newsletter-page {
    padding: 60px 0 80px;
}
.newsletter-box {
    max-width: 550px;
    margin: 0 auto;
    text-align: center;
}
.newsletter-box-icon {
    font-size: 3rem;
    margin-bottom: 20px;
}
.newsletter-box h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 12px;
}
.newsletter-box > p {
    color: var(--gris);
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 30px;
}
.newsletter-form {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
}
.newsletter-form .form-control {
    flex: 1;
    padding: 14px 18px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
}
.newsletter-form .form-control:focus {
    outline: none;
    border-color: var(--accent);
}
.newsletter-form .btn-submit {
    background: var(--accent);
    color: var(--blanc);
    border: none;
    padding: 14px 28px;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    transition: opacity 0.3s;
    white-space: nowrap;
}
.newsletter-form .btn-submit:hover {
    opacity: 0.9;
}
.newsletter-erreurs {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    border-radius: 8px;
    padding: 14px 18px;
    margin-bottom: 20px;
    text-align: left;
}
.newsletter-erreurs ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.newsletter-erreurs li {
    color: #dc2626;
    font-size: 0.88rem;
}
.newsletter-perks {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 45px;
    text-align: center;
}
.newsletter-perk {
    padding: 20px;
}
.newsletter-perk-icon {
    font-size: 1.6rem;
    margin-bottom: 10px;
}
.newsletter-perk h4 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 6px;
}
.newsletter-perk p {
    color: var(--gris);
    font-size: 0.82rem;
    line-height: 1.5;
    margin: 0;
}
@media (max-width: 600px) {
    .newsletter-form {
        flex-direction: column;
    }
    .newsletter-perks {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
</style>

<section class="newsletter-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>Newsletter</span>
        </nav>
        <h1>Newsletter</h1>
        <p>Restez informé de nos dernières nouveautés et offres exclusives.</p>
    </div>
</section>

<section class="newsletter-page section">
    <div class="container">
        <div class="newsletter-box">
            <div class="newsletter-box-icon">📧</div>
            <h2>Rejoignez la communauté URBAN STYLE</h2>
            <p>Inscrivez-vous à notre newsletter pour recevoir en avant-première nos nouvelles collections, nos promotions exclusives et nos conseils mode.</p>

            <?php if (!empty($erreurs)): ?>
                <div class="newsletter-erreurs">
                    <ul>
                        <?php foreach ($erreurs as $err): ?>
                            <li><?= e($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="" class="newsletter-form" novalidate>
                <?= generer_csrf() ?>
                <input type="email" name="email" class="form-control" required
                       placeholder="Votre adresse e-mail"
                       value="<?= e(obtenir_parametre('email', '')) ?>">
                <button type="submit" class="btn-submit">S'inscrire</button>
            </form>

            <p style="color:var(--gris);font-size:0.8rem;">En vous inscrivant, vous acceptez de recevoir nos communications. Vous pouvez vous désinscrire à tout moment.</p>

            <div class="newsletter-perks">
                <div class="newsletter-perk">
                    <div class="newsletter-perk-icon">🆕</div>
                    <h4>Nouveautés en avant-première</h4>
                    <p>Soyez les premiers à découvrir nos nouvelles collections.</p>
                </div>
                <div class="newsletter-perk">
                    <div class="newsletter-perk-icon">🏷️</div>
                    <h4>Offres exclusives</h4>
                    <p>Profitez de réductions réservées à nos abonnés.</p>
                </div>
                <div class="newsletter-perk">
                    <div class="newsletter-perk-icon">💡</div>
                    <h4>Conseils mode</h4>
                    <p>Recevez nos inspirations et tendances du moment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

