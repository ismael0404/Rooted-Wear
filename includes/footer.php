    </main> <!-- Fin du contenu principal ouvert dans header.php -->

    <!-- Pied de page -->
    <footer style="background: #111; color: #fff; padding: 60px 0 20px 0; margin-top: 60px;">
        <div class="container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px;">
            
            <!-- Colonne 1 : Marque -->
            <div>
                <h3 style="font-size: 1.2rem; font-weight: 900; letter-spacing: 2px; margin-bottom: 20px; text-transform: uppercase;"><?= SITE_NOM ?></h3>
                <p style="color: #aaa; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px;">
                    <?= SITE_DESCRIPTION ?>. Qualité premium et design urbain.
                </p>
                <div style="display: flex; gap: 10px;">
                    <a href="#" style="display: inline-flex; width: 35px; height: 35px; border-radius: 50%; border: 1px solid #555; align-items: center; justify-content: center; color: #fff; font-size: 0.8rem;">FB</a>
                    <a href="#" style="display: inline-flex; width: 35px; height: 35px; border-radius: 50%; border: 1px solid #555; align-items: center; justify-content: center; color: #fff; font-size: 0.8rem;">IG</a>
                </div>
            </div>

            <!-- Colonne 2 : Liens Rapides Boutique -->
            <div>
                <h4 style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">Boutique</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/produits.php?genre=homme" style="color: #aaa; font-size: 0.85rem;">Homme</a></li>
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/produits.php?genre=femme" style="color: #aaa; font-size: 0.85rem;">Femme</a></li>
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/produits.php?categorie=chaussures" style="color: #aaa; font-size: 0.85rem;">Chaussures</a></li>
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/produits.php?filtre=promotions" style="color: #FF5A1F; font-size: 0.85rem;">Promotions</a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Service Client -->
            <div>
                <h4 style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">Aide & Contact</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/faq.php" style="color: #aaa; font-size: 0.85rem;">FAQ</a></li>
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/livraison-retours.php" style="color: #aaa; font-size: 0.85rem;">Livraison & Retours</a></li>
                    <li style="margin-bottom: 12px;"><a href="<?= BASE_URL ?>/contact.php" style="color: #aaa; font-size: 0.85rem;">Nous contacter</a></li>
                </ul>
            </div>

            <!-- Colonne 4 : Newsletter -->
            <div>
                <h4 style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">Newsletter</h4>
                <p style="color: #aaa; font-size: 0.85rem; margin-bottom: 15px;">Inscrivez-vous pour nos offres exclusives.</p>
                <form action="<?= BASE_URL ?>/newsletter.php" method="POST" style="display: flex;">
                    <input type="email" placeholder="Votre email" style="padding: 12px; border: none; outline: none; width: 100%; border-radius: 4px 0 0 4px; font-family: 'Inter', sans-serif;" required>
                    <button type="submit" style="background: #FF5A1F; color: #fff; border: none; padding: 12px 18px; cursor: pointer; border-radius: 0 4px 4px 0; font-weight: 600;">OK</button>
                </form>
            </div>
            
        </div>

        <!-- Mentions légales du Footer -->
        <div style="border-top: 1px solid #333; margin-top: 40px; padding-top: 25px;">
            <div class="container" style="display: flex; justify-content: space-between; align-items: center; color: #777; font-size: 0.8rem;">
                <div>&copy; <?= date('Y') ?> <?= SITE_NOM ?>. Tous droits réservés.</div>
                <div style="display: flex; gap: 20px;">
                    <a href="<?= BASE_URL ?>/conditions.php" style="color: #777;">CGV</a>
                    <a href="<?= BASE_URL ?>/confidentialite.php" style="color: #777;">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Emplacement pour les scripts JS futurs -->
    <!-- <script src="<?= BASE_URL ?>/assets/js/main.js"></script> -->
</body>
</html>

