<?php
require dirname(__DIR__) . '/connect.php';


$bottle_id = intval($_POST['bottleID']);

$req = $db->prepare(
    "DELETE
	FROM bottle 
	WHERE id_bottle = :id;
	DELETE 
	FROM year 
	WHERE id_to_bottle = :id

"
);

$req->bindValue(':id', $bottle_id, PDO::PARAM_INT);
$result = $req->execute();

$msg = array();
if ($result) :
    $msg['error'] = FALSE;
    $msg['msg'] = 'Bouteille effacé';
else :
    $msg['error'] = TRUE;
    $msg['msg'] = 'Erreur lors de l\'effacement';
endif;

echo json_encode($msg);
    // ALTER TABLE bottle AUTO_INCREMENT=1;
    // ALTER TABLE year AUTO_INCREMENT=1;