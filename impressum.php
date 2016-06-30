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
        echo "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.";
        echo "</div>";

        echo "<div class='col-md-4'>";
        require_once("include/aside_impressum.php");
        echo "</div>";
        ?>

    </div>



                </div>

    </body>


</html>



