<!-- modal modif bouteille -->
<div class="modal-up-bottle-container hidden">
    <div class="modal-up-bottle">
        <img class="close-modal-up" src="./assets/img/logos/icon_croix_bx.svg" alt="icon fermeture modale">
        <h2>Modification bouteille</h2>
        <form class="form-add" action="ajax_php/up_bottle_post.php" method="POST" id="form-up-bottle" enctype="multipart/form-data">

            <div id="cont-form-add-bottle">
                <label for="name" id="name-label">Nom*: </label>
                <input class="field" type="text" name="name" id="name-up">

                <label for="year" id="year-label">Année: </label>
                <select class="field" name="year" id="year-up">
                    <option value="0"></option>;
                    <?php
                    $actual_year = (date('Y') - 1);
                    for ($i = 1900; $i <= $actual_year; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>;';
                    }
                    ?>
                </select>

                <label for="grapes" id="grapes-label">Cépage(s): </label>
                <input class="field" type="text" name="grapes" id="grapes-up">

                <label for="country" id="country-label">Pays: </label>
                <input class="field" type="text" name="country" id="country-up">

                <label for="region" id="region-label">Région: </label>
                <input class="field" type="text" name="region" id="region-up">

                <label for="description" id="description-label">Description: </label>
                <textarea class="field" name="description" id="description-up"></textarea>

                <label for="type" id="type-label">Type*: </label>
                <select class="field" name="type" id="type-up">
                    <option value="1">Rouge</option>;
                    <option value="2">Blanc</option>;
                    <option value="3">Rosé</option>;
                </select>

                <label for="photo" id="photo-label">Photo: </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
                <input class="field" type="file" name="photo" id="photo-up" accept=".png, .jpg, .jpeg">

                <div id="cont-tof-stock">
                    <div id="container-photo"></div>
                    <div id="cont-stock-up">
                        <label for="stock" id="stock-label-up">Stock: </label>
                        <input class="field" type="number" name="stock" id="stock-up" min="0" value="1">
                    </div>
                </div>
                <input type="hidden" name="current_picture" id="current_picture">
                <input type="hidden" name="current_id" id="current_id">
            </div>

            <button type="submit" id="submitUp">Modifier</button>
        </form>
        <!-- messages bouteille -->
        <div id="resultUp"></div>
        <p id="champ-requis">*champs requis</p>
    </div>
</div>