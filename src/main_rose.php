<?php
require 'connect.php';
?>
<!-- ratraper nav-bar -->
<div id="ratrape-header"></div>

<?php
// -----cards dynamiques-----


$req = $db->query("
        SELECT *
        FROM bottle
        INNER JOIN category
        ON bottle.id_to_category = category.id_category
        INNER JOIN year
        ON bottle.id_bottle = year.id_to_bottle
        WHERE category.id_category = 3
        ");
// $req->execute();
// var_dump($req->fetchObject());
?>

<?php while ($cards = $req->fetchObject()) { ?>
    <article class="cards">
        <?php if (isset($_SESSION['role'])) : ?>
            <div class="del-creat-cont">
                <img src="./assets/img/logos/icon_croix_bx.svg" alt="icon des suppression"><img src="./assets/img/logos/icon_crayon.svg" alt="icon d'édition">
            </div>
        <?php endif; ?>
        <div class="card-cont">
            <img src="./assets/img/photos/<?php echo $cards->photo; ?>" alt="photo de bouteille : <?php echo $cards->nom; ?>">
            <h2><?php echo $cards->nom; ?></h2>
            <div class="annee">
                <h4>Année :</h4>
                <p><?php echo $cards->annee; ?></p>
            </div>
            <div class="cepage">
                <h4>Cépage(s) :</h4>
                <p><?php echo $cards->cepage; ?></p>
            </div>
            <div class="pays">
                <h4>Pays :</h4>
                <p><?php echo $cards->pays; ?></p>
            </div>
            <div class="region">
                <h4>Région :</h4>
                <p><?php echo $cards->region; ?></p>
            </div>
            <div class="descri">
                <h4>Description :</h4>
            </div>
            <div class="textarea">
                <p><?php echo $cards->descri ?></p>
            </div>
        </div>
    </article>
<?php } ?>