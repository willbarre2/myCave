<?php
require dirname(__DIR__) . '/connect.php';


$year_id = intval($_POST['yearId']);
$bottle_id = intval($_POST['bottleId']);

// requette pour effacer photo dans la mémoire

$req = $db->prepare(
    "SELECT photo
	FROM year y
	WHERE id_to_bottle = :idb;
"
);

$req->bindValue(':idb', $bottle_id, PDO::PARAM_INT);
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
	FROM bottle  
	WHERE bottle.id_bottle = :idb;
	DELETE 
	FROM year 
	WHERE year.id_to_bottle = :idb
"
);

$req2->bindValue(':idb', $bottle_id, PDO::PARAM_INT);
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
