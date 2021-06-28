<?php
if (empty(session_id())) {
    session_start();
}
try {
    $db = new PDO('mysql:host=localhost;dbname=mycave;charset=utf8;port=3307', 'root', '');
} catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
}
