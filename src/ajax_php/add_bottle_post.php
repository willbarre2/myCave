<?php

require dirname(__DIR__) . '/connect.php';

mb_internal_encoding("UTF-8");
function mb_ucfirst($string)
{
    $string = mb_strtolower($string);
    return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
}

$name = htmlentities(mb_strtoupper(trim($_POST['name'])), ENT_QUOTES);
$year = intval($_POST['year']);
$grapes = htmlentities(mb_ucfirst(trim($_POST['grapes'])), ENT_QUOTES);
$country = htmlentities(mb_ucfirst(trim($_POST['country'])), ENT_QUOTES);
$region = htmlentities(mb_ucfirst(trim($_POST['region'])), ENT_QUOTES);
$description = htmlentities(trim($_POST['description']), ENT_QUOTES);
$photo = $_FILES['photo'];
$photo_error = $photo['error'];
$ext = array('png', 'jpg', 'jpeg');
$type = intval($_POST['type']);

if ($name == '') {
    $msg_error = 'Merci de renseigner le Nom';
    $error = 1;
} else {
    if ($photo_error > 0 && $photo_error < 3) {
        $msg_error = 'Votre fichier est trop grand (3Mo max)';
        $error = 2;
    } elseif ($photo_error == 3 || $photo_error > 4) {
        $msg_error = 'Oups une erreur s\'est produite 1';
        $error = 2;
    } else {
        if ($photo['size'] > 3000000) {
            $msg_error = 'Votre fichier est trop grand (3Mo max)';
            $error = 2;
        } elseif ($photo_error == 0 && !in_array(pathinfo($photo['name'], PATHINFO_EXTENSION), $ext)) {
            $msg_error = 'Votre fichier n\'est pas une image (.jpg, .jpeg, .png)';
            $error = 2;
        } else {
            if ($photo_error == 0) {
                $photo_name = uniqid() . '_' . $photo['name'];
                @mkdir(dirname(__DIR__) . '/assets/img/photos/', 0775);
                $photo_folder = dirname(__DIR__) . '/assets/img/photos/';
                $dir = $photo_folder . $photo_name;
                $move_file = @move_uploaded_file($photo['tmp_name'], $dir);
            }

            if ($photo_error == 0 && !$move_file) {
                $msg_error = 'Oups une erreur s\'est produite 2';
                $error = 2;
            } else {
                $id_session = intval($_SESSION['id']);
                $generic = 'generic.jpg';
                $req = $db->prepare(
                    "INSERT INTO bottle(nom, cepage, region, pays, id_to_user, id_to_category)
					VALUES (:nom, :cepage, :region, :pays, :iduser, :idcat);
                    INSERT INTO year(annee, descri, id_to_bottle, photo)
					VALUES (:annee, :descri, LAST_INSERT_ID(), :photo)
				"
                );

                $req->bindValue(':nom', $name, PDO::PARAM_STR);
                $req->bindValue(':cepage', $grapes, PDO::PARAM_STR);
                $req->bindValue(':region', $region, PDO::PARAM_STR);
                $req->bindValue(':pays', $country, PDO::PARAM_STR);
                $req->bindValue(':iduser', $id_session, PDO::PARAM_INT);
                $req->bindValue(':idcat', $type, PDO::PARAM_INT);

                $req->bindValue(':annee', $year, PDO::PARAM_INT);
                $req->bindValue(':descri', $description, PDO::PARAM_STR);
                if (!empty($photo['name'])) {
                    $req->bindValue(':photo', $photo_name, PDO::PARAM_STR);
                } else {
                    $req->bindValue(':photo', $generic, PDO::PARAM_STR);
                }


                $result_request = $req->execute();
                if ($result_request) {
                    $msg_success = 'Bouteille Ajouté';
                } else {
                    $msg_error = 'Oups, une erreur s\'est produite';
                    $error = 0;
                }
            }
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
