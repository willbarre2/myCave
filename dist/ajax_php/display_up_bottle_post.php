<?php
require dirname(__DIR__) . '/connect.php';
$year_id = intval($_POST['yearID']);

$req = $db->prepare(
	"SELECT y.id_year, y.annee, y.descri, y.photo, y.stock, b.id_bottle, b.nom, b.cepage, b.region, b.pays, c.type
	FROM year y
	INNER JOIN bottle b
	ON y.id_to_bottle = b.id_bottle
    INNER JOIN category c
    ON b.id_to_category = c.id_category   
	WHERE y.id_year = :id
"
);

$req->bindValue(':id', $year_id, PDO::PARAM_INT);

$req->execute();

$results = $req->fetchObject();

echo json_encode($results);
