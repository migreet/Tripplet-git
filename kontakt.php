<!DOCTYPE html>
<html lang="de">
<body>

<?php
/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");
require_once("include/navigation.php");

/**
 * Session wird gestartet
 */
session_start();
?>

<div class="container">
    <!-- Breadcrumb -->
    <div class='breadcrumb'>
        <i class='fa fa-angle-right'></i> <a href='index.php'> Vorlesungen</a> <i class='fa fa-angle-right'></i> Kontakt
    </div>
    <h1>Kontakt</h1>
    <?php echo "<div class='col-md-4' id='impressim_aside'> ";
        require_once("include/aside_impressum.php");
        echo "</div>";
    ?>
    <div class='col-md-8'>
    </div>
</div>

<?php require_once('include/footer.php'); ?>

</body>
</html>

