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
        <h1>Impressum</h1>
        <div>Hochschule der Medien<br>
            Nobelstraße 10 <br>
            70569 Stuttgart
        </div>
    </div>
        <?php
        //Breadcrumb
        echo"
        <div class='breadcrumb'>
        > <a href='index.php'> Vorlesungen</a> > Accountverwaltung
        </div>";
        ?>


                </div>

    </body>

<?php endif; ?>
</html>



