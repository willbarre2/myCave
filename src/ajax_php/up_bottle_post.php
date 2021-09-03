<?php
require dirname(__DIR__) . '/connect.php';

mb_internal_encoding("UTF-8");
function mb_ucfirst($string)
{
    $string = mb_strtolower($string);
    return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
}

$name = htmlspecialchars(mb_strtoupper(trim($_POST['name'])), ENT_QUOTES);
$year = intval($_POST['year']);
$grapes = htmlspecialchars(mb_ucfirst(trim($_POST['grapes'])), ENT_QUOTES);
$country = htmlspecialchars(mb_ucfirst(trim($_POST['country'])), ENT_QUOTES);
$region = htmlspecialchars(mb_ucfirst(trim($_POST['region'])), ENT_QUOTES);
$description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES);
$photo = $_FILES['photo'];
$photo_error = $photo['error'];
$photo_name = uniqid() . '_' . $photo['name'];
$current_picture = $_POST['current_picture'];
$current_id = intval($_POST['current_id']);
$current_id_bottle = intval($_POST['current_id_bottle']);
$generic = 'generic.jpg';
$ext = array('png', 'jpg', 'jpeg');
$type = intval($_POST['type']);
$stock = intval($_POST['stock']);

if ($name == '') {
    $msg_error = 'Merci de renseigner le Nom';
    $error = 1;
} else {
    if ($photo_error > 0 && $photo_error < 3) {
        $msg_error = 'Votre fichier est trop grand';
        $error = 2;
    } elseif ($photo_error == 3 || $photo_error > 4) {
        $msg_error = 'Oups une erreur s\'est produite';
        $error = 2;
    } else {
        if ($photo['size'] > 3000000) {
            $msg_error = 'Votre fichier est trop grand (3Mo max)';
            $error = 2;
        } elseif ($photo_error == 0 && !in_array(pathinfo($photo['name'], PATHINFO_EXTENSION), $ext)) {
            $msg_error = 'Votre fichier n\'est pas au bon format (.jpg, .jpeg, .png)';
            $error = 2;
        } else {

            if ($photo_error == 0 && $current_picture != $generic) {
                unlink("../assets/img/photos/$current_picture");
                @mkdir(dirname(__DIR__) . '/assets/img/photos/', 0775);
                $photo_folder = dirname(__DIR__) . '/assets/img/photos/';
                $dir = $photo_folder . $photo_name;
                $move_file = @move_uploaded_file($photo['tmp_name'], $dir);
            } elseif ($photo_error == 0 && $current_picture = $generic) {
                @mkdir(dirname(__DIR__) . '/assets/img/photos/', 0775);
                $photo_folder = dirname(__DIR__) . '/assets/img/photos/';
                $dir = $photo_folder . $photo_name;
                $move_file = @move_uploaded_file($photo['tmp_name'], $dir);
            }

            $sql_cepage = !empty($grapes) ? ', cepage = :cepage' : '';
            $sql_region = !empty($region) ? ', region = :region' : '';
            $sql_pays = !empty($country) ? ', pays = :pays' : '';
            $sql_descri = !empty($description) ? ', descri = :descri' : '';
            $req = $db->prepare(
                "UPDATE estate
                SET nom = :nom$sql_cepage$sql_region$sql_pays, id_to_user = :iduser, id_to_category = :idcat
                WHERE id_estate = $current_id_bottle;
                UPDATE year
                SET annee = :annee$sql_descri, id_to_estate = $current_id_bottle, photo = :photo, stock = :stock
                WHERE id_year = $current_id
            "
            );

            $req->bindValue(':nom', $name, PDO::PARAM_STR);
            if (!empty($grapes)) {
                $req->bindValue(':cepage', $grapes, PDO::PARAM_STR);
            }
            if (!empty($region)) {
                $req->bindValue(':region', $region, PDO::PARAM_STR);
            }
            if (!empty($country)) {
                $req->bindValue(':pays', $country, PDO::PARAM_STR);
            }
            $req->bindValue(':iduser', $_SESSION['id'], PDO::PARAM_INT);
            $req->bindValue(':idcat', $type, PDO::PARAM_INT);

            $req->bindValue(':annee', $year, PDO::PARAM_INT);
            if (!empty($description)) {
                $req->bindValue(':descri', $description, PDO::PARAM_STR);
            }

            if ($photo_error == 0) {
                $req->bindValue(':photo', $photo_name, PDO::PARAM_STR);
            } else {
                $req->bindValue(':photo', $current_picture, PDO::PARAM_STR);
            }

            $req->bindValue(':stock', $stock, PDO::PARAM_INT);


            $result_request = $req->execute();
            if ($result_request) {
                $msg_success = 'Bouteille Modifié';
            } else {
                $msg_error = 'Oups, une erreur s\'est produite';
                $error = 0;
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
