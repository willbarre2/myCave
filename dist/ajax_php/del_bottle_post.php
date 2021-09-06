<?php
require dirname(__DIR__) . '/connect.php';


$year_id = intval($_POST['yearId']);
$bottle_id = intval($_POST['bottleId']);

// requette pour effacer photo dans la mémoire

$req = $db->prepare(
    "SELECT photo
	FROM year y
	WHERE id_to_estate = :idestate;
"
);

$req->bindValue(':idestate', $bottle_id, PDO::PARAM_INT);
$req->execute();
while ($resultat = $req->fetchObject()) {
    $tof = "../assets/img/photos/$resultat->photo";

    if ($resultat->photo != 'generic.jpg') :
        unlink($tof);
    endif;
}


// requette pour effacer bouteille dans DB
$req2 = $db->prepare(
    "DELETE 
	FROM estate  
	WHERE estate.id_estate = :idestate;
	DELETE 
	FROM year 
	WHERE year.id_to_estate = :idestate
"
);

$req2->bindValue(':idestate', $bottle_id, PDO::PARAM_INT);
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
