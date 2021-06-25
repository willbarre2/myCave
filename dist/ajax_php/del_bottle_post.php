<?php
require dirname(__DIR__) . '/connect.php';


$bottle_id = intval($_POST['bottleID']);

// requette pour effacer photo dans la mémoire

$req = $db->prepare(
    "SELECT photo
	FROM year y
    INNER JOIN bottle b
    ON  y.id_to_bottle = b.id_bottle
	WHERE id_bottle = :id;
"
);

$req->bindValue(':id', $bottle_id, PDO::PARAM_INT);
$req->execute();
$resultat = $req->fetchObject();
$tof = "../assets/img/photos/$resultat->photo";

if ($resultat->photo != 'generic.jpg') {
    unlink($tof);
}

// requette pour éffacer bouteille dans DB
$req2 = $db->prepare(
    "DELETE
	FROM bottle 
	WHERE id_bottle = :id;
	DELETE 
	FROM year 
	WHERE id_to_bottle = :id
"
);

$req2->bindValue(':id', $bottle_id, PDO::PARAM_INT);
$result = $req2->execute();

$msg = array();
if ($result) :
    $msg['error'] = FALSE;
    $msg['msg'] = 'Bouteille effacé';
else :
    $msg['error'] = TRUE;
    $msg['msg'] = 'Erreur lors de l\'effacement';
endif;

echo json_encode($msg);
