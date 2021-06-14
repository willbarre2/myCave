<?php
require dirname(__DIR__) . '/connect.php';
$bottle_id = intval($_POST['bottleID']);

$req = $db->prepare(
    "SELECT b.nom, b.cepage, b.region, b.pays, y.annee, y.descri, y.photo, c.type
	FROM bottle b
	INNER JOIN year y
	ON b.id_bottle = y.id_to_bottle
    INNER JOIN category c
    ON b.id_to_category = c.id_category   
	WHERE b.id_bottle = :id
"
);

$req->bindValue(':id', $bottle_id, PDO::PARAM_INT);

$req->execute();

$results = $req->fetchObject();

echo json_encode($results);
