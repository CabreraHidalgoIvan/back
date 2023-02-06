<?php

include "../../common/utils.php";
include "../../common/mysql.php";
include "../../common/config.php";

// Check if the user is already logged in, if yes then redirect him to welcome page

debug($_POST);

$username = $_POST['usernameSH'];
$password = $_POST['passwordSH'];

// Connect to the database
$db_host = "localhost";
$db_name = "CRUDSuperhero";
$db_usuario = "root";
$db_pass = "";

$connection = mysqli_connect($db_host, $db_usuario, $db_pass);

if (mysqli_connect_errno()) {
    echo "Fallo al conectar con la BBDD";
    exit();
}

mysqli_select_db($connection, $db_name) or die ("No se encuentra la BBDD");

mysqli_set_charset($connection, "utf8");

$sql = "SELECT * FROM superheroes WHERE nombre = '$username' AND psw = '$password'";

// Execute the query

$result = executeQuery($sql, $connection);

// Close the connection

close($connection);

// Validate credentials
if(empty($result)) {
    header('Location: ../index.php?page=error');
} elseif ($result[0]['nombre'] !== $username || $result[0]['psw'] !== $password){
    header('Location: ../index.php?page=error');
} else {
    session_start();
    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['usernameSH'] = $result[0]['usuario'];
    $_SESSION['id_session'] = session_id();

    header('Location: ../home.php?page=superhero');
    exit;
}