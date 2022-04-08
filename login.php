<?php
    session_start();
    if (isset($_SESSION['usuarios_id'])) {
        header('LOCATION; /loginPHP');
    }
    require 'database.php';
    $message = '';
    if (!empty($_POST['email']) &&  !empty($_POST['password'])) {
        $record = $conexion->prepare("SELECT id, email, password FROM usuarios WHERE email=:email");
        $record->bindParam(':email',$_POST['email']);
        $record->execute();
        $results = $record->fetch(PDO::FETCH_ASSOC);
        if (count($results) > 0 && password_verify($_POST['password'],$results['password'])) {
            $_SESSION['usuarios_id'] = $results['id'];
            header('Location: /loginPHP');
        } else
                $message = 'Lo sentimos, sus credenciales no coinciden';
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partial/headers.php' ?>
        <h1>Loguearse</h1>
        <span>o <a href="registrar.php">Registrarse</a></span>
       
       <?php if(!empty($message)):?>
            <p><?= $message?></p>
        <?php endif; ?>
        <form action="login.php" method = "post">
            <input type="text" name = "email" placeholder = "Ingrese su correo electrónico">
            <input type="password" name = "password" placeholder = "Ingrese su contraseña">
            <input type="submit" value = "Enviar">
        </form>
</body>
</html>