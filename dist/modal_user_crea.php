<!-- modal création user -->
<div class="modal-crea-container hidden">
    <div class="modal-crea">
        <img class="close-modal-crea" src="./assets/img/logos/icon_croix_bx.svg" alt="icon fermeture modale">
        <h2>Nouvel Utilisateur</h2>
        <div class="form-crea">
            <input class="field" type="text" name="login" id="loginCrea" placeholder="Identifiant" required>
            <div id="pass-eye">
                <input class="field" type="password" name="password" id="passwordCrea" placeholder="Mot De Passe" required>
                <i class="fas fa-eye pass_display pass_btn_crea"></i>
                <i class="fas fa-eye-slash pass_hide pass_btn_crea"></i>
            </div>
            <select class="field" name="role" id="role">
                <option value="2">Editeur</option>;
                <option value="1">Administrateur</option>;
            </select>
            <div id="submitCrea">Créer</div>
        </div>
        <!-- messages créa -->
        <div id="resultCrea"></div>
    </div>
</div>