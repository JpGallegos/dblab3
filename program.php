<?php 
    session_start();
    $username = "jgallegos";
    $server = "localhost";
    $password = "jgallegos@";
    $dbName = "ccom4027_b42";

    $student = $_GET'estudiante'];
    $semester = $_GET['semestre'];

    $sqlSelect = "SELECT " +
                    "p.nombre AS `Profesor`, " + 
                    "CONCAT(o.codigo, '-', o.seccion) AS Curso, " +
                    "o.dias, " + 
                    "CONCAT(TIME_FORMAT(o.hora_inicia, '%h:%i%p'), '-', TIME_FORMAT(o.hora_termina, '%h:%i%p')) AS Horario " +
                "FROM estudiante AS e " + 
                "INNER JOIN matriculada AS m " + 
                "ON e.num_est = m.num_est " + 
                "INNER JOIN ofrece AS o " + 
                "ON m.id_of = o.id_of " +
                "INNER JOIN profesor AS p " +
                "ON o.id_prof = p.id_prof " +
                "WHERE " +
                    "e.num_est = " . $student . " AND " +
                    "o.semestre = " . $semester . " " +
                "ORDER BY o.dias DESC"; 

    $dbLink = mysql_connect($server, $username, $password) or die("Error connecting to mysql server: " . mysql_error());
    mysql_select_db($dbName) or die("Error selecting specified database on mysql server: " . mysql_error());

    $result = mysql_query($sqlSelect) or die("Query to get data failed: " . mysql_error());
?>
<table class="table table-hover">'
    <thead>
        <tr>
            <th>Número Curso</th>
            <th>Profesor</th>
            <th>Día</th>
            <th>Hora</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($row = mysql_fetch_array($result)) {
                $course = $row["Curso"];
                $prof = $row["Profesor"];
                $day = $row["dias"];
                $hour = $row["Horario"];
                echo "
                <tr>
                    <td>$course<td>
                    <td>$prof</td>
                    <td>$day</td>
                    <td>$hour</td>
                </tr>";                      
            }
        ?>
    </tbody>
</table>