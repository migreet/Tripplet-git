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
        <i class='fa fa-angle-right'></i> <a href='index.php'> Vorlesungen</a> <i class='fa fa-angle-right'></i> Kontakt
        </div>";
    echo"<h1>Impressum</h1>";
    echo "<div class='col-md-8'>";

    echo "</div>";

    echo "<div class='col-md-4' id='impressim_aside'> ";

    echo "</div>";
    ?>

</div>



</div>
<?php require_once('include/footer.php'); ?>
</body>


</html>

