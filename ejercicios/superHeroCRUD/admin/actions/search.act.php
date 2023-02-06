<?php

include "../../common/utils.php";
include "../../common/mysql.php";
include "../../common/config.php";

$connection = connection();

$search = $_POST['search'];
$page = $_GET['page'];
echo $page;

if (empty($search)) {
    header('Location: ../home.php?page=guest');
} else {
    $sql = "SELECT * FROM superheroes WHERE nombre LIKE '%$search%'";

    $result = executeQuery($sql, $connection);

    debug($result);

    close($connection);


    if (empty($result)){
        header('Location: ../home.php?page=error');
    } else {

        header('Location: ../home.php?page=result&search=' . $search);
        include "../home.php?page=result&search=" . $search;

    }
}