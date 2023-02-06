<div class="container">
    <div class="row">



        <div class="row">

            <div class="col-lg-12">
                <a href="#" class="btn btn-lg">Superheroes</a>
            </div>

        </div>

        <div class="row cuadroListado">
            <div class="col-lg-12">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Evolución</th>
                        <th scope="col">IdUsuario</th>
                        <th scope="col">created_at</th>
                        <th scope="col">updated_at</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    include "../common/utils.php";
                    include "../common/mysql.php";
                    include "../common/config.php";

                    $connection = connection();

                    $result = $connection->query("SELECT * FROM superheroes WHERE nombre LIKE '%$search%'");

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<th scope='row'>1</th>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['imagen'] . "</td>";
                        echo "<td>" . $row['evolucion'] . "</td>";
                        echo "<td>" . $row['idUsuario'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>" . $row['updated_at'] . "</td>";
                        echo "</tr>";
                    }

                    ?>

                    </tbody>


                </table>


            </div>
        </div>

    </div>
</div>
