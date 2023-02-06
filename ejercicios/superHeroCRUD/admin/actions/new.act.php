<?php

include "../../common/utils.php";
include "../../common/mysql.php";
include "../../common/config.php";


$userName = $_POST['username'];
$password = md5($_POST['password']);

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


$sql = "INSERT INTO usuario (usuario, psw) VALUES ('$userName', '$password')";

// Execute the query

$return = executeQuery($sql, $connection);

// Close the connection

close($connection);

// Redirect to the index

header("Location: ../home.php");