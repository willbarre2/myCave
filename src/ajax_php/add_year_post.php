<?php

require dirname(__DIR__) . '/connect.php';

$year = intval($_POST['year-add-year']);
$description = htmlspecialchars(trim($_POST['description-add-year']), ENT_QUOTES);
$photo = $_FILES['photo-add-year'];
$photo_error = $photo['error'];
$ext = array('png', 'jpg', 'jpeg');
$stock = intval($_POST['stock-add-year']);
$id_bottle = intval($_POST['current_id_bottle_add']);


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
        $msg_error = 'Votre fichier n\'est pas au bon format (.jpg, .jpeg, .png)';
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
                "INSERT INTO year(annee, stock, descri, id_to_estate, photo)
                VALUES (:annee, :stock, :descri, :id_to_estate, :photo)
            "
            );

            $req->bindValue(':annee', $year, PDO::PARAM_INT);
            $req->bindValue(':stock', $stock, PDO::PARAM_INT);
            $req->bindValue(':descri', $description, PDO::PARAM_STR);
            $req->bindValue(':id_to_estate', $id_bottle, PDO::PARAM_INT);
            if (!empty($photo['name'])) {
                $req->bindValue(':photo', $photo_name, PDO::PARAM_STR);
            } else {
                $req->bindValue(':photo', $generic, PDO::PARAM_STR);
            }


            $result_request = $req->execute();
            if ($result_request) {
                $msg_success = 'Année Ajouté';
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
} else {
    $msg['error'] = FALSE;
    $msg['msg'] = $msg_success;
}

header('Content-Type: application/json');

echo json_encode($msg);
