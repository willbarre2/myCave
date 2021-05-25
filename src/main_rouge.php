<?php
require 'connect.php';
?>
<div style="width: 100%; height: 150px;"></div> <!-- ratraper nav-bar -->

<?php
$req = $db->prepare("
        SELECT *
        FROM bottle
        INNER JOIN type
        ON bottle.id_to_type = type.id_type
        INNER JOIN year
        ON bottle.id_to_year = year.id_year
        WHERE type.type = 1
        ");
$req->execute();
var_dump($req->fetchAll())
?>

<?php while ($cards = $req->fetchObject()) {
    echo    '<article class="cards">
            <div class="del-creat-cont">
                <img src="./assets/img/logos/icon_croix_bx.svg" alt="icon des suppression"><img src="./assets/img/logos/icon_crayon.svg" alt="icon d\'édition">
            </div>
            <div class="card-cont">
                <img src="./assets/img/' . $cards->photo . '" alt="photo de bouteille : ' . $cards->nom . '">
                <h2>' . $cards->nom . '</h2>
                <div class="annee">
                    <h4>Année :</h4>
                    <p>' . $cards->annee . '</p>
                </div>
                <div class="cepage">
                    <h4>Cépage(s) :</h4>
                    <p>' . $cards->cepage . '</p>
                </div>
                <div class="pays">
                    <h4>Pays :</h4>
                    <p>' . $cards->pays . '</p>
                </div>
                <div class="region">
                    <h4>Région :</h4>
                    <p>' . $cards->region . '</p>
                </div>
                <div class="descri">
                    <h4>Description :</h4>
                </div>
                <div class="textarea">
                    <p>' . $cards->description . '</p>
                </div>
            </div>
        </article>';
} ?>