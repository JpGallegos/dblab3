<?php 
    session_start();
    $username = "jgallegos";
    $server = "localhost";
    $password = "jgallegos@";
    $dbName = "ccom4027_b42";

    $sqlStudents = "SELECT num_est, nombre FROM estudiante";
    $sqlSemesters = "SELECT DISTINCT semestre FROM ofrece";

    $dbLink = mysql_connect($server, $username, $password) or die("Error connecting to mysql server: " . mysql_error());
    mysql_select_db($dbName) or die("Error selecting specified database on mysql server: " . mysql_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Programa de Clases</title>
    <link rel="stylesheet" type="text/css" href="./assets/vendor/bootstrap-3.3.4/css/bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="./assets/vendor/bootstrap-3.3.4/css/bootstrap-theme.min.css"></link>
    <link rel="stylesheet" type="text/css" href="./assets/css/site.css"></link>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Lab 3</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav"></ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <form id="search" class="form-inline" style="padding-top:5px; padding-bottom:5px;">
            <div class="form-group">
                <label for="estudiante">Estudiante</label>
                <select id="estudiante" name="estudiante" class="form-control">
                    <?php 
                        $studentResult = mysql_query($sqlStudents) or die("Query to get data failed: " . mysql_error());
                        while ($row = mysql_fetch_array($studentResult)) {
                            $name = $row["nombre"];
                            $value = $row["num_est"];
                            echo "<option value=\"$value\">$name</option>";
                        }                       
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semestre">Semestre</label>
                <select id="semestre" name="semestre" class="form-control">
                    <?php 
                        $semestreResult = mysql_query($sqlSemesters) or die("Query to get data failed: " . mysql_error());
                        while ($row = mysql_fetch_array($semestreResult)) {
                            $semestre = $row["semestre"];
                            echo "<option value=\"$semestre\">$semestre</option>";                        
                        }                       
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>
        <div class="jumbotron">
            <div class="container"></div>
        </div>

        <hr/>
        <footer>
            <p>&copy; John Gallegos 2015</p>
        </footer>
    </div>

    <script type="text/javascript" src="./assets/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/vendor/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascritp">
        $(function () {
            $(document).ready(function () {
                var request;

                $('#search').submit(function (e) {
                    e.preventDefault();

                    if (request) {
                        request.abort();
                    }

                    var $form = $(this);

                    var serializedData = $form.serialize();

                    console.log(serializedData);
                });
            });
        })();
    </script
</body>
</html>