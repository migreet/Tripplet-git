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
        require_once(include/aside_impressum);
        ?>

    </div>



                </div>

    </body>


</html>



