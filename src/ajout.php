<?php
require 'connect.php';
mb_internal_encoding("UTF-8");
function mb_ucfirst($s)
{
    $s = mb_strtolower($s);
    return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
}
$req = $db->query("
    SELECT *
    FROM role
    WHERE id
    ORDER BY id
    DESC
");
$req->execute();
?>

<form action="crea_post.php" method="POST" class="crea-cont">
    <img src="./assets/img/generic.jpg" alt="photo bouteille">
    <h2>CHATEAU DE SAINT COME</h2>
    <div class="annee">
        <label for="annee">Année: </label>
        <select id="annee" type="text" name="annee">
            <?php while ($option = $req->fetchObject()) {
                echo '<option value = "' . $option->id . '">' . mb_ucfirst($option->role_name) . '</option>';
            } ?>
        </select>
    </div>
    <div class="cepage">
        <label for="cepage">Cépage(s): </label>
        <input id="cepage" type="text" name="cepage">
    </div>
    <div class="pays">
        <label for="pays">Pays: </label>
        <input id="pays" type="text" name="pays">
    </div>
    <div class="region">
        <label for="region">Région: </label>
        <input id="region" type="text" name="region">
    </div>
    <div class="descri">
        <label for="descri">Description: </label>
        <input id="descri" type="text" name="descri">
    </div>
    <div class="textarea">
        <textarea id="textarea" type="tel" name="textarea" placeholder="écrire plus de 10 caractères"></textarea>
    </div>
    <div>
        <label for="type">Type: <span class="red">*</span></label>
        <select id="type" name="type">
            <?php while ($option = $req->fetchObject()) {
                echo '<option value = "' . $option->id . '">' . mb_ucfirst($option->role_name) . '</option>';
            } ?>
        </select>
    </div>
    <button type="submit">Création</button>
</form>