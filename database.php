<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_login_database';

      try {
          $conexion = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
      } catch (PDOException $error) {
            die('Conexión fallida:'.$error->getMessage());
      }  

?>