<?php
require dirname(__DIR__) . '/connect.php';
$user_id = intval($_POST['userID']);

$req = $db->prepare(
    "SELECT identifiant, id_user
    FROM user u
	WHERE u.id_user = :id
"
);

$req->bindValue(':id', $user_id, PDO::PARAM_INT);

$req->execute();

$results = $req->fetchObject();

echo json_encode($results);
