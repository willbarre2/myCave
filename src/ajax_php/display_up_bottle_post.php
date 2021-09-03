<?php
require dirname(__DIR__) . '/connect.php';
$year_id = intval($_POST['yearID']);

$req = $db->prepare(
	"SELECT y.id_year, y.annee, y.descri, y.photo, y.stock, e.id_estate, e.nom, e.cepage, e.region, e.pays, c.type
	FROM year y
	INNER JOIN estate e
	ON y.id_to_estate = e.id_estate
    INNER JOIN category c
    ON e.id_to_category = c.id_category   
	WHERE y.id_year = :id
"
);

$req->bindValue(':id', $year_id, PDO::PARAM_INT);

$req->execute();

$results = $req->fetchObject();

echo json_encode($results);
