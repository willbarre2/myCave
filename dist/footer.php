<?php
$domaine = "http://localhost/myCave2/myCave/src/";
?>

</main>

<footer <?php if ($domaine === $current_url || $domaine . "index.php" === $current_url) echo 'id="footer-index"'; ?>>
    <p id="footer">&copy; William Barré - 2021 - Tous droits réservés</p>
</footer>

<script src="./assets/libs/jquery_min.js"></script>
<script src="./assets/js/index.js"></script>
<script src="./assets/js/crea.js"></script>
<script src="./assets/js/del_user.js"></script>
<script src="./assets/js/add.js"></script>
<script src="./assets/js/del.js"></script>
<script src="./assets/js/up.js"></script>
<script src="./assets/js/add_year.js"></script>
</body>

</html>