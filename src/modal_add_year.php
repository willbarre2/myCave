<!-- modal création bouteille -->
<div class="modal-add-year-container hidden">
    <div class="modal-add-year">
        <img class="close-modal-add-year" src="./assets/img/logos/icon_croix_bx.svg" alt="icon fermeture modale">
        <h2>Ajout d'année</h2>
        <form class="form-add-year" action="ajax_php/add_year_post.php" method="POST" id="form-add-year" enctype="multipart/form-data">

            <div id="cont-form-add-year">

                <label for="year-add-year" id="year-add-year-label">Année: </label>
                <select class="field" name="year-add-year" id="year-add-year">
                    <option value="0"></option>;
                    <?php
                    $actual_year = (date('Y') - 1);
                    for ($i = 1900; $i <= $actual_year; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>;';
                    }
                    ?>
                </select>

                <label for="description-add-year" id="description-add-year-label">Description: </label>
                <textarea class="field" name="description-add-year" id="description-add-year"></textarea>

                <label for="photo-add-year" id="photo-add-year-label">Photo: </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
                <input class="field" type="file" name="photo-add-year" id="photo-add-year" accept=".png, .jpg, .jpeg">

                <label for="stock-add-year" id="stock-add-year-label">Stock: </label>
                <input class="field" type="number" name="stock-add-year" id="stock-add-year" min="0" value="1">

            </div>

            <input type="hidden" name="current_id_bottle" id="current_id_bottle">

            <button type="submit" id="submitAddYear">Ajouter</button>
        </form>
        <!-- messages bouteille -->
        <div id="resultAddYear"></div>
    </div>
</div>