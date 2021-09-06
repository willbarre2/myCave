<?php require __DIR__ . '/header.php';

mb_internal_encoding("UTF-8");
function mb_ucfirst($string)
{
    $string = mb_strtolower($string);
    return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
}
?>

<!-- ratraper nav-bar -->
<div id="ratrape-header"></div>

<div id="text-accueil">
    <h1>Bienvenu<?php if (isset($_SESSION['id'])) : ?><span> <?php echo mb_ucfirst($_SESSION['name']) ?></span> <?php endif; ?></h1>
    <p>Gérez votre cave à vin du bout de la souris, où que vous soyez.</p>
</div>


<?php require __DIR__ . '/footer.php'; ?>