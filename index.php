<?php
    session_start();
    require 'database.php';
    if (isset($_SESSION['usuarios_id'])) {
        $record = $conexion->prepare('SELECT * FROM usuarios WHERE id = :id');
        $record->bindParam(':id',$_SESSION['usuarios_id']);
        $record->execute();
        $results = $record->fetch(PDO::FETCH_ASSOC);

        $usuario = null;
        if (count($results) > 0) {
            $usuario = $results;
        }
    }

?>
//Hay que crear una api y ademas controlar en el frontend y tambien el backend 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partial/headers.php' ?>
    <?php if(!empty($usuario)) : ?>
        <br>Bienvenido, <?=$usuario['email']?>
        <br>ha ingresado al sistema satisfactoriamente
        <a href="logout.php">Salir del sistema</a>
        <?php else: ?>        
    <h1>Por favor registrese</h1>
    <a href="login.php">Loguearse</a> o
    <a href="registrar.php">Registrarse</a>
    <?php endif; ?>
</body>
</html>
