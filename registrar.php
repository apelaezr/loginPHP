<?php
    require 'database.php';
    $message = '';
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && ($_POST['password']) == ($_POST['confirm_password'])) {
        $sql = "INSERT INTO usuarios  (email, password) VALUES (:email, :password)";
        $stmt = $conexion->prepare($sql);
        $email = $_POST['email'];
        $stmt->bindParam(':email',$email);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);
        if ($stmt->execute()) {
            $message = 'Usuario creado satisfactoriamente';
        }
    }else
        $message = 'Ha ocurrido un error creando su contraseña';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partial/headers.php' ?>
     <?php if (!empty($message)) : ?> 
         <p><?= $message?></p>
         <?php endif; ?>
    <h1>Registrarse</h1>
    <span>o <a href="login.php">Loguearse</a></span>

    <form action="registrar.php" method = "post">
            <input type="text" name = "email" placeholder = "Ingrese su correo electrónico">
            <input type="password" name = "password" placeholder = "Ingrese su contraseña">
            <input type="password" name = "confirm_password" placeholder = "Confirme su contraseña">
            <input type="submit" value = "Enviar">
        </form>
</body>
</html>