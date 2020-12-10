<?php

include_once 'conexion.php';

//Leer 

$agregar = 'SELECT * FROM libros_leidos'; //Aca se coloca el nombre de la tabla
$agregar_datos = $pdo->prepare($agregar);
$agregar_datos->execute();
$resultado_agregar = $agregar_datos->fetchAll();

//var_dump($resultado_agregar)

//Agregar

if ($_POST) {
    
    $nombre_obra = $_POST['nombre_obra'];
    $autor = $_POST['autor'];
    $desccripcion = $_POST['descripcion'];

    $leer = 'INSERT INTO libros_leidos (nombre_obra, autor, descripcion) VALUES (?,?,?)';
    $sentencia_leer = $pdo->prepare($leer);
    $sentencia_leer ->execute([$nombre_obra, $autor, $desccripcion]);

    header('location:index.php');
}

//Editar

if ($_GET) {
    $id = $_GET['id'];
    $editar = 'SELECT * FROM libros_leidos WHERE id=?';
    $editar_sql = $pdo->prepare($editar);
    $editar_sql->execute([$id]);
    $resultado_editar = $editar_sql->fetch();

    
}



?>







<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Indice</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="text-danger">Mi primer CRUD</h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-2 mt-4">
                <div class="text-primary">
                    <h4>Obra</h4>
                </div>
                <?php foreach ($resultado_agregar as $dato) : ?>
                    <div class="bg-white row mt-4">
                        <h6><?php echo $dato['nombre_obra'] ?></h6>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-2 mt-4">
                <div class="text-primary">
                    <h4>Autor</h4>
                </div>
                <?php foreach ($resultado_agregar as $dato) : ?>
                    <div class="bg-white row mt-4">
                        <h6><?php echo $dato['autor'] ?></h6>
                    </div>
                <?php endforeach ?>
            </div>


            <div class="col-md-5 mt-4">
                <div class="text-primary">
                    <h4 class="text-center">Descripción</h4>
                </div>
                <?php foreach ($resultado_agregar as $dato) : ?>
                    <div class="bg-white row mt-4">
                        <h6><?php echo $dato['descripcion'] ?></h6>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-3 text-center mt-4">
                <div class="row">
                    <div class="col-md-6 text-success ">
                        <h4>Editar</h4>
                        <?php foreach ($resultado_agregar as $dato) : ?>
                            <div class="text-center">
                                <a href="index.php?id=<?php echo $dato['id'] ?>" class="text-success"><i class="far fa-edit mt-4"></i></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-md-6 text-danger">
                        <h4>Eliminar</h4>
                        <?php foreach ($resultado_agregar as $dato) : ?>
                            <div class="text-center">
                                <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="text-danger"><i class="far fa-trash-alt mt-4"></i></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>


        </div>

        <div class="row p-3">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center mt-4 text-success">

                <?php if(!$_GET) : ?>
                <h4>Agregar contenido</h4>
                <form action="" method="post">
                    <input type="text" name="nombre_obra" class="form-control mt-3" placeholder="Nombre de la obra">
                    <input type="text" name="autor" class="form-control mt-3" placeholder="Autor">
                    <input type="text" name="descripcion" class="form-control mt-3" placeholder="Descripcion">
                    <button class="btn-primary btn mt-3" type="submit">Agregar</button>
                </form>
                <?php endif ?>

                <?php if($_GET) : ?>
                <h4>Editar contenido</h4>
                <form action="editar.php" method="get">
                    <input type="text" name="nombre_obra" class="form-control mt-3" value="<?php echo $resultado_editar['nombre_obra'] ?>">
                    <input type="text" name="autor" class="form-control mt-3" value="<?php echo $resultado_editar['autor'] ?>">
                    <input type="text" name="descripcion" class="form-control mt-3" value="<?php echo $resultado_editar['descripcion'] ?>">
                    <input type="hidden" name="id" value="<?php echo $resultado_editar['id'] ?>">
                    <button class="btn-primary btn mt-3" type="submit">Editar</button>
                </form>
                <?php endif ?>

            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>