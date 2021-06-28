<?php
require dirname(__DIR__) . '/connect.php';

$year_id = intval($_POST['yearId']);
$bottle_id = intval($_POST['bottleId']);

// requette pour effacer photo dans la mémoire

$req = $db->prepare(
    "SELECT photo
	FROM year y
	WHERE id_year = :idy;
"
);

$req->bindValue(':idy', $year_id, PDO::PARAM_INT);
$req->execute();
$resultat = $req->fetchObject();
$tof = "../assets/img/photos/$resultat->photo";

if ($resultat->photo != 'generic.jpg') {
    unlink($tof);
}

// requette pour effacer année dans DB
$req2 = $db->prepare(
    "DELETE  
	FROM year 
	WHERE year.id_year = :idy
"
);

$req2->bindValue(':idy', $year_id, PDO::PARAM_INT);
$result = $req2->execute();

$msg = array();
if ($result) :
    $msg['error'] = FALSE;
    $msg['msg'] = 'Année effacé';
else :
    $msg['error'] = TRUE;
    $msg['msg'] = 'Erreur lors de l\'effacement';
endif;

echo json_encode($msg);
