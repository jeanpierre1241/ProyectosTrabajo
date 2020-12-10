<?php 

include_once 'conexion.php';

$id = $_GET['id'];

$eliminar = 'DELETE FROM libros_leidos WHERE id=?';
$eliminar_sql = $pdo->prepare($eliminar);
$eliminar_sql->execute([$id]);

header('location: index.php');