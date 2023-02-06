<?php

function connection()
{
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



    return $connection;
}

function query($query, $connection)
{
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
    return $result;
}

function executeQuery($query, $connection)
{
    $result = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

        do {
            $data[] = $row;
        } while ($row = mysqli_fetch_array($result, MYSQLI_BOTH));

    } else {
        $data = null;
    }

    mysqli_free_result($result);
    return $data;

}

function close($connection)
{
    mysqli_close($connection);
    unset($connection);
}