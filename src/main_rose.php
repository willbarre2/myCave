<?php
require 'connect.php';
?>

<!-- requette pour pagination -->
<?php
$req = $db->query(
    "SELECT COUNT(id_year) AS count_years
	FROM year y
    INNER JOIN bottle b
    ON y.id_to_bottle = b.id_bottle
    WHERE b.id_to_category = 3 
"
);
$result = $req->fetchObject();
$count_bottles = $result->count_years;
$per_page = 4;
$nb_pages = ceil($count_bottles / $per_page); // arrondie au chiffre sup de la division

// on détermine si on a une requette Get avec le num de la page sinon on est à la page 1
if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nb_pages) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

?>

<!-- ratraper nav-bar -->
<div id="ratrape-header"></div>



<!-- affichage pagination sur pages + que 1  -->
<?php if (isset($_GET['page'])) { ?>
    <ul class="navigation">
        <!-- chevron de gauche -->
        <?php if ($current_page == 1) : ?>
            <li class="disabled"><a href="#"><i class="fas fa-chevron-left"></i></a></li>
        <?php else : ?>
            <li class="wave-effect"><a href="?page=<?php echo $current_page - 1; ?>"><i class="fas fa-chevron-left"></i></a></li>
        <?php endif; ?>

        <!-- navigation en cliquant directement -->

        <?php
        for ($i = 1; $i <= $nb_pages; $i++) : ?>

            <?php if ($i == $current_page) : ?>
                <li class="active"><a><?php echo $i; ?></a></li>
            <?php else : ?>
                <li class="wave-effect"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>

        <?php endfor; ?>

        <!-- chevron de droite -->
        <?php if ($current_page == $nb_pages) : ?>
            <li class="disabled"><a href="#"><i class="fas fa-chevron-right"></i></a> </li>
        <?php else : ?>
            <li class="wave-effect"><a href="?page=<?php echo $current_page + 1; ?>"><i class="fas fa-chevron-right"></i></a></li>
        <?php endif; ?>
    </ul>
<?php } ?>

<?php
// -----cards dynamiques-----


$req = $db->prepare(
    "SELECT *
        FROM year y
        INNER JOIN bottle b
        ON y.id_to_bottle = b.id_bottle
        INNER JOIN category c
        ON b.id_to_category = c.id_category
        WHERE c.id_category = 3
        ORDER BY b.nom
        LIMIT :offset, :per_page
        "
);

$req->bindValue(':offset', (($current_page - 1) * $per_page), PDO::PARAM_INT);
$req->bindValue(':per_page', $per_page, PDO::PARAM_INT);
$req->execute();
?>

<?php while ($cards = $req->fetchObject()) { ?>
    <article class="cards">
        <?php if (isset($_SESSION['role'])) : ?>
            <div class="del-creat-cont">
                <img src="./assets/img/logos/icon_year_bx.svg" alt="icon d'ajout d'année" class="btn-add-year" data-id="<?php echo $cards->id_bottle ?>">
                <img src="./assets/img/logos/icon_crayon.svg" alt="icon d'édition" class="btn-up" data-id="<?php echo $cards->id_year ?>">
                <img src="./assets/img/logos/icon_croix_bx.svg" alt="icon des suppression" class="btn-del" data-idy="<?php echo $cards->id_year ?>" data-idb="<?php echo $cards->id_bottle ?>">
            </div>
        <?php endif; ?>
        <div class="card-cont">
            <div class="photos-bottles" style="background: center / cover url('./assets/img/photos/<?php echo $cards->photo; ?>');"></div>
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
            <div class="stock">
                <h4>Stock :</h4>
                <p><?php if ($cards->stock == "0") {
                        echo "en rupture";
                    } else {
                        echo $cards->stock . " bouteille(s)";
                    } ?></p>
            </div>
        </div>
    </article>
    <!-- message delete bouteille -->
    <div class="msgDel"></div>
<?php } ?>

<!-- affichage pagination -->
<ul class="navigation">
    <!-- chevron de gauche -->
    <?php if ($current_page == 1) : ?>
        <li class="disabled"><a href="#"><i class="fas fa-chevron-left"></i></a></li>
    <?php else : ?>
        <li class="wave-effect"><a href="rose.php?page=<?php echo $current_page - 1; ?>"><i class="fas fa-chevron-left"></i></a></li>
    <?php endif; ?>

    <!-- navigation en cliquant directement -->

    <?php
    for ($i = 1; $i <= $nb_pages; $i++) : ?>

        <?php if ($i == $current_page) : ?>
            <li class="active"><a><?php echo $i; ?></a></li>
        <?php else : ?>
            <li class="wave-effect"><a href="rose.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endif; ?>

    <?php endfor; ?>

    <!-- chevron de droite -->
    <?php if ($current_page == $nb_pages) : ?>
        <li class="disabled"><a href="#"><i class="fas fa-chevron-right"></i></a> </li>
    <?php else : ?>
        <li class="wave-effect"><a href="rose.php?page=<?php echo $current_page + 1; ?>"><i class="fas fa-chevron-right"></i></a></li>
    <?php endif; ?>
</ul>