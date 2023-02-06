<?php

include "../../common/utils.php";
include "../../common/mysql.php";
include "../../common/config.php";

// Connect to the database
$connection = connection();

// Get the total number of superheroes
$sql = "SELECT * FROM usuario";

$rows = executeQuery($sql, $connection);

close($connection);

?>

<!-- Page content -->

<h1>HOLASDASDASdsad</h1>