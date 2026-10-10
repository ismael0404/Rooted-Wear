<?php
/**
 * URBAN STYLE - Page Contact
 * Formulaire de contact et informations
 */
require_once __DIR__ . '/includes/init.php';

// Traitement du formulaire
$erreurs = [];
$ancien = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifier_csrf()) {
        $erreurs[] = 'Jeton de sécurité invalide. Veuillez réessayer.';
    }

    $nom = trim(obtenir_parametre('nom', ''));
    $email = trim(obtenir_parametre('email', ''));
    $sujet = trim(obtenir_parametre('sujet', ''));
    $message_txt = trim(obtenir_parametre('message', ''));

    $ancien = compact('nom', 'email', 'sujet', 'message_txt');

    if ($nom === '') {
        $erreurs[] = 'Le nom est obligatoire.';
    }
    if ($email === '') {
        $erreurs[] = 'L\'adresse e-mail est obligatoire.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = 'L\'adresse e-mail n\'est pas valide.';
    }
    if ($sujet === '') {
        $erreurs[] = 'Le sujet est obligatoire.';
    }
    if ($message_txt === '') {
        $erreurs[] = 'Le message est obligatoire.';
    }

    if (empty($erreurs)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages_contact (nom, email, sujet, message, date_creation) VALUES (:nom, :email, :sujet, :message, NOW())');
            $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':sujet' => $sujet,
                ':message' => $message_txt,
            ]);
            message_flash('Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.', 'succes');
            rediriger('/contact.php');
            exit;
        } catch (PDOException $ex) {
            $erreurs[] = 'Une erreur est survenue. Veuillez réessayer plus tard.';
        }
    }
}

$page_titre = 'Contactez-nous';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.contact-hero {
    background-color: var(--noir);
    color: var(--blanc);
    padding: 60px 0 40px;
    text-align: center;
}
.contact-hero h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
}
.contact-hero p {
    color: var(--gris);
    font-size: 1.05rem;
    max-width: 520px;
    margin: 0 auto;
}
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    gap: 50px;
    padding: 60px 0 80px;
}
.contact-info-card {
    background: var(--gris-clair);
    border-radius: 12px;
    padding: 40px 35px;
}
.contact-info-card h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 30px;
}
.contact-info-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 28px;
}
.contact-info-icon {
    width: 44px;
    height: 44px;
    background: var(--noir);
    color: var(--blanc);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.1rem;
}
.contact-info-item h3 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 4px;
}
.contact-info-item p {
    color: var(--gris);
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0;
}
.contact-info-item a {
    color: var(--accent);
    text-decoration: none;
}
.contact-info-item a:hover {
    text-decoration: underline;
}
.contact-socials {
    display: flex;
    gap: 14px;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #ddd;
}
.contact-social-link {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: var(--noir);
    color: var(--blanc);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1rem;
    transition: background 0.3s;
}
.contact-social-link:hover {
    background: var(--accent);
}
.contact-form-section h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 25px;
}
.contact-form .form-group {
    margin-bottom: 20px;
}
.contact-form .form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    font-size: 0.9rem;
}
.contact-form .form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    transition: border-color 0.3s;
    box-sizing: border-box;
}
.contact-form .form-control:focus {
    outline: none;
    border-color: var(--accent);
}
.contact-form textarea.form-control {
    min-height: 140px;
    resize: vertical;
}
.contact-form .btn-submit {
    display: inline-block;
    background: var(--accent);
    color: var(--blanc);
    border: none;
    padding: 14px 40px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    transition: opacity 0.3s;
}
.contact-form .btn-submit:hover {
    opacity: 0.9;
}
.contact-erreurs {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    border-radius: 8px;
    padding: 16px 20px;
    margin-bottom: 24px;
}
.contact-erreurs ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.contact-erreurs li {
    color: #dc2626;
    font-size: 0.9rem;
    padding: 2px 0;
}
.contact-map {
    margin-top: 20px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #ddd;
}
.contact-map iframe {
    width: 100%;
    height: 220px;
    border: 0;
    display: block;
}
@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
        padding: 40px 0 60px;
    }
}
</style>

<section class="contact-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?= e(BASE_URL) ?>/">Accueil</a> &rsaquo;
            <span>Contact</span>
        </nav>
        <h1>Contactez-nous</h1>
        <p>Une question, une suggestion ou besoin d'aide ? Notre équipe est à votre écoute.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Colonne gauche : Informations -->
            <div class="contact-info-card">
                <h2>Nos coordonnées</h2>

                <div class="contact-info-item">
                    <div class="contact-info-icon">📍</div>
                    <div>
                        <h3>Adresse</h3>
                        <p>Cocody Riviera Palmeraie<br>Abidjan, Côte d'Ivoire</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">📞</div>
                    <div>
                        <h3>Téléphone</h3>
                        <p><a href="tel:+2250102030405">+225 01 02 03 04 05</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">✉️</div>
                    <div>
                        <h3>E-mail</h3>
                        <p><a href="mailto:contact@urbanstyle.ci">contact@urbanstyle.ci</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">🕐</div>
                    <div>
                        <h3>Horaires d'ouverture</h3>
                        <p>
                            Lundi – Vendredi : 8h00 – 18h00<br>
                            Samedi : 9h00 – 16h00<br>
                            Dimanche : Fermé
                        </p>
                    </div>
                </div>

                <div class="contact-socials">
                    <a href="#" class="contact-social-link" title="Facebook" aria-label="Facebook">f</a>
                    <a href="#" class="contact-social-link" title="Instagram" aria-label="Instagram">ig</a>
                    <a href="#" class="contact-social-link" title="Twitter" aria-label="Twitter">𝕏</a>
                    <a href="#" class="contact-social-link" title="WhatsApp" aria-label="WhatsApp">wa</a>
                </div>

                <!-- Carte Google Maps -->
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127254.49013012564!2d-4.0631258!3d5.3599517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ea5311959121%3A0x3fe70ddce19221a6!2sAbidjan%2C%20C%C3%B4te%20d&#39;Ivoire!5e0!3m2!1sfr!2sfr!4v1700000000000!5m2!1sfr!2sfr"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Localisation URBAN STYLE">
                    </iframe>
                </div>
            </div>

            <!-- Colonne droite : Formulaire -->
            <div class="contact-form-section">
                <h2>Envoyez-nous un message</h2>

                <?php if (!empty($erreurs)): ?>
                    <div class="contact-erreurs">
                        <ul>
                            <?php foreach ($erreurs as $err): ?>
                                <li><?= e($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="contact-form" novalidate>
                    <?= generer_csrf() ?>

                    <div class="form-group">
                        <label for="nom" class="form-label">Nom complet <span style="color:var(--accent)">*</span></label>
                        <input type="text" id="nom" name="nom" class="form-control" required
                               placeholder="Votre nom complet"
                               value="<?= e($ancien['nom'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Adresse e-mail <span style="color:var(--accent)">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" required
                               placeholder="votre@email.com"
                               value="<?= e($ancien['email'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="sujet" class="form-label">Sujet <span style="color:var(--accent)">*</span></label>
                        <input type="text" id="sujet" name="sujet" class="form-control" required
                               placeholder="L'objet de votre message"
                               value="<?= e($ancien['sujet'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">Message <span style="color:var(--accent)">*</span></label>
                        <textarea id="message" name="message" class="form-control" required
                                  placeholder="Décrivez votre demande en détail..."><?= e($ancien['message_txt'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

