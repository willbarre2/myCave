<?php
require dirname(__DIR__) . '/connect.php';

$login = $_POST['login'];
$password = $_POST['password'];
$role = $_POST['role'];


if (in_array('', $_POST)) {
    $msg_error = 'Merci de renseigner l\'identifiant, le mot de passe et le role';
    $error = 1;
    if (empty($login)) {
        $msg_error .= 'Merci de renseigner l\'identifiant<br>';
        $error = 2;
    }
    if (empty($password)) {
        $msg_error .= 'Merci de renseigner le mot de passe<br>';
        $error = 3;
    }
    if (empty($role)) {
        $msg_error .= 'Merci de renseigner le role<br>';
        $error = 4;
    }
} else {
    $login = htmlentities(trim(mb_strtolower($login)), ENT_QUOTES); // faille XSS
    $password = htmlentities(trim($password), ENT_QUOTES);
    $role = intval($_POST['role']);

    $req = $db->prepare(
        "INSERT INTO user( identifiant, mot_de_passe, id_to_role)
				VALUES ( :identifiant, :mot_de_passe, :id_to_role);
				"
    );

    $req->bindValue(':identifiant', $login, PDO::PARAM_STR);
    $req->bindValue(':mot_de_passe', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $req->bindValue(':id_to_role', $role, PDO::PARAM_INT);

    $result_request = $req->execute();

    if ($result_request) {
        $msg_success = 'Utilisateur crée';
    } else {
        if ($req->errorInfo()[0] == 23000) {
            $msg_error = 'Cet identifiant existe déjà';
            $error = 2;
        } else {
            $msg_error = 'Oups, une erreur s\'est produite';
            $error = 0;
        }
    }
}

$result = isset($msg_error);
$msg = array();

if ($result) {
    $msg['error'] = TRUE;
    $msg['msg'] = $msg_error;
    $msg['field'] = $error;
} else {
    $msg['error'] = FALSE;
    $msg['msg'] = $msg_success;
}

header('Content-Type: application/json');

echo json_encode($msg);
