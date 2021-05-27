<!-- modal Connexion -->
<div class="connexion-modal-container hidden">
    <div class="connexion-modal">
        <img class="close-modal" src="./assets/img/logos/icon_croix_bx.svg" alt="icon fermeture modale">
        <h2>Authentification</h2>
        <form action="connexion_post.php" method="POST">
            <input type="text" name="login" id="login" placeholder="Identifiant" required>
            <div id="pass-eye">
                <input type="password" name="password" id="password" placeholder="Mot De Passe" required>
                <i class="fas fa-eye pass_display pass_btn"></i>
                <i class="fas fa-eye-slash pass_hide pass_btn"></i>
            </div>
            <button type="submit">Se Connecter</button>
        </form>
    </div>
</div>