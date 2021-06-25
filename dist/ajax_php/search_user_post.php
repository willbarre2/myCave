<?php
require dirname(__DIR__) . '/connect.php';
$input_value = htmlentities(mb_strtolower(trim($_POST['input'])), ENT_QUOTES);

$req = $db->prepare(
	"SELECT identifiant, id_user
	FROM user 
	WHERE identifiant LIKE :login
"
);

$req->bindValue(':login', "%{$input_value}%", PDO::PARAM_STR);
$req->execute();

$results = $req->fetchAll(PDO::FETCH_OBJ);

echo json_encode($results);
