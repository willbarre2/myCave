<!-- modal création bouteille -->
<div class="modal-add-bottle-container hidden">
    <div class="modal-add-bottle">
        <img class="close-modal-add" src="./assets/img/logos/icon_croix_bx.svg" alt="icon fermeture modale">
        <h2>Ajout bouteille</h2>
        <form class="form-add" action="ajax_php/add_bottle_post.php" method="POST" id="form-add-bottle" enctype="multipart/form-data">

            <div id="cont-form-add-bottle">
                <label for="name" id="name-label">Nom*: </label>
                <input class="field" type="text" name="name" id="name" required>

                <label for="year" id="year-label">Année: </label>
                <select class="field" name="year" id="year" required>
                    <option value="0"></option>;
                    <?php
                    $actual_year = (date('Y') - 1);
                    for ($i = 1900; $i <= $actual_year; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>;';
                    }
                    ?>
                </select>

                <label for="grapes" id="grapes-label">Cépage(s): </label>
                <input class="field" type="text" name="grapes" id="grapes">

                <label for="country" id="country-label">Pays: </label>
                <input class="field" type="text" name="country" id="country">

                <label for="region" id="region-label">Région: </label>
                <input class="field" type="text" name="region" id="region">

                <label for="description" id="description-label">Description: </label>
                <textarea class="field" name="description" id="description"></textarea>

                <label for="photo" id="photo-label">Photo: </label>
                <input class="field" type="file" name="photo" id="photo">

                <label for="type" id="type-label">Type*: </label>
                <select class="field" name="type" id="type" required>
                    <option value="1">Rouge</option>;
                    <option value="2">Blanc</option>;
                    <option value="3">Rosé</option>;
                </select>
            </div>

            <div id="submitAdd">Ajouter</div>
        </form>
        <!-- messages bouteille -->
        <div id="resultAdd"></div>
        <p id="champ-requis">*champs requis</p>
    </div>
</div>