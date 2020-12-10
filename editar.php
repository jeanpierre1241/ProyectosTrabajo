<?php

include_once 'conexion.php';

$id = $_GET['id'];
$nombre_obra = $_GET['nombre_obra'];
$autor = $_GET['autor'];
$descripcion = $_GET['descripcion'];

$editar = 'UPDATE libros_leidos SET nombre_obra=?, autor=?, descripcion=? WHERE id=?';
$sql_editar = $pdo->prepare($editar);
$sql_editar ->execute([$nombre_obra, $autor, $descripcion, $id]);

header ('location:index.php');