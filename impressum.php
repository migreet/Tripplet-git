<!DOCTYPE html>
<html lang="de">


<?php
require_once("include/header.php");
require_once("php/classes.php");

session_start();
?>


    <body>
    <?php require_once("include/navigation.php");
    ?>

    <div class="container">
        <?php
        //Breadcrumb
        echo"
        <div class='breadcrumb'>
        > <a href='index.php'> Vorlesungen</a> > Impressum
        </div>";
        echo "<div class='col-md-8'>";
        echo "<div>";

        echo "<div class='col-md-4'>";
        require_once("include/aside_impressum.php");
        echo "<div>";
        ?>

    </div>



                </div>

    </body>


</html>



