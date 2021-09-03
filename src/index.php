<?php require __DIR__ . '/header.php'; ?>

<!-- ratraper nav-bar -->
<div id="ratrape-header"></div>

<div id="text-accueil">
    <h1>Bienvenu<?php if (isset($_SESSION['id'])) : ?><span> <?php echo $_SESSION['name'] ?></span> <?php endif; ?></h1>
    <p>Gérez votre cave à vin du bout de la souris, où que vous soyez.</p>
</div>







<?php require __DIR__ . '/footer.php'; ?>