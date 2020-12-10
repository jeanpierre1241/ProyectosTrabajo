<?php

$localhost = 'mysql:host=localhost;dbname=libros';
$usuario = 'root';
$password = '';

try {

    $pdo = new PDO($localhost, $usuario, $password);

    //echo 'conectado';
    
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

