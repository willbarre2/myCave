<?php
$domaine = "http://localhost/myCave2/myCave/src/";
$page_rouge = $domaine;
$page_blanc = $domaine . "blanc.php";
$page_rose = $domaine . "rose.php";

$rouge_name = "myCave / Rouge";
$blanc_name = "myCave / Blanc";
$rose_name = "myCave / Rosé";


$current_url = 'http://localhost' . $_SERVER['REQUEST_URI']; // url courante

if ($page_rouge === $current_url) :

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
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <div id="nav-cont">
            <img src="./assets/img/logos/logo-Cave.svg" alt="logo myCave">
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
            <div id="btn-con">Connexion</div>
        </div>
    </header>

    <main>