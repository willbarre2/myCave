<?php
if (empty(session_id())) {
    session_start();
};

$domaine = "https://mycavewb.com/";
$page_rouge = $domaine . "rouge.php";
$page_blanc = $domaine . "blanc.php";
$page_rose = $domaine . "rose.php";

$home_name = "myCave / Accueil";
$rouge_name = "myCave / Rouge";
$blanc_name = "myCave / Blanc";
$rose_name = "myCave / Rosé";


$current_url = strtok(('https://mycavewb.com' . $_SERVER['REQUEST_URI']), '?');

if ($domaine === $current_url || $domaine . "index.php" === $current_url) :

    $title = $home_name;

elseif ($page_rouge === $current_url) :

    $title = $rouge_name;

elseif ($page_blanc === $current_url) :

    $title = $blanc_name;

elseif ($page_rose === $current_url) :

    $title = $rose_name;

endif;

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> gestionnaire de cave à vin en ligne.</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <div id="btn-burger"></div>
        <div id="nav-cont">
            <a href="index.php"><img src="./assets/img/logos/logo-Cave.svg" alt="logo myCave"></a>
            <nav>
                <ul>
                    <li>
                        <a id="nav-rouge" class="<?php if ($page_rouge === $current_url) echo 'current_page'; ?>" href="<?php echo $page_rouge; ?>">Rouge</a>
                    </li>
                    <li>
                        <a id="nav-blanc" class="<?php if ($page_blanc === $current_url) echo 'current_page'; ?>" href="<?php echo $page_blanc; ?>">Blanc</a>
                    </li>
                    <li>
                        <a id="nav-rose" class="<?php if ($page_rose === $current_url) echo 'current_page'; ?>" href="<?php echo $page_rose; ?>">Rosé</a>
                    </li>
                </ul>
            </nav>

            <?php if (isset($_SESSION['id'])) : ?>
                <form action="deconnexion.php" method="post">
                    <button type="submit" id="btn-decon">Déconnexion</button>
                </form>
            <?php else : ?>
                <div id="btn-con">Connexion</div>
            <?php endif; ?>
            <?php if (isset($_SESSION['role'])) : ?>
                <img src="./assets/img/logos/icon_bottle_white.svg" alt="icon blanc d'ajout de bouteille" id="icon-bottle-white">
            <?php endif; ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
                <div id="btn-crea-white" class="icon-user-white"></div>
                <div id="btn-del-white" class="icon-user-del-white"></div>
            <?php endif; ?>
        </div>
    </header>
    <div>
        <?php if (isset($_SESSION['role'])) : ?>
            <img src="./assets/img/logos/icon_bottle.svg" alt="icon bordeaux d'ajout de bouteille" id="icon-bottle-bx">

        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
            <div id="btn-crea" class="icon-user-bx"></div>
            <div id="btn-del" class="icon-user-del-bx"></div>
        <?php endif; ?>
    </div>

    <?php require __DIR__ . '/modal_connexion.php'; ?>
    <?php require __DIR__ . '/modal_user_crea.php'; ?>
    <?php require __DIR__ . '/modal_user_del.php'; ?>
    <?php require __DIR__ . '/modal_bottle_add.php'; ?>
    <?php require __DIR__ . '/modal_update_bottle.php'; ?>
    <?php require __DIR__ . '/modal_add_year.php'; ?>
    <?php require __DIR__ . '/modal_del_bottle_year.php'; ?>

    <main>