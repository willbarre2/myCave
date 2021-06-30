<?php
if (empty(session_id())) {
    session_start();
}
try {
    $db = new PDO('mysql:host=db5003176171.hosting-data.io;dbname=dbs2565300;charset=utf8;', 'dbu1118774', '2cAcAbOUDIN2');
} catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
}
