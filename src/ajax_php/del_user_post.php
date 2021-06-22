<?php
require dirname(__DIR__) . '/connect.php';


$user_id = intval($_POST['userId']);


$req = $db->prepare(
    "DELETE
	FROM user  
	WHERE user.id_user = :id
"
);

$req->bindValue(':id', $user_id, PDO::PARAM_INT);
$result = $req->execute();

$msg = array();
if ($result) :
    $msg['error'] = FALSE;
    $msg['msg'] = 'Utilisateur effacé';
else :
    $msg['error'] = TRUE;
    $msg['msg'] = 'Erreur lors de l\'effacement';
endif;

echo json_encode($msg);
