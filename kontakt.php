<!DOCTYPE html>
<html lang="de">
<body>

<?php

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * Session wird gestartet
 */
session_start();
?>

<div class="container">
    <!-- Breadcrumb -->
    <h1>Kontakt</h1>
    <?php echo "<div class='col-md-4' id='impressim_aside'> ";
        require_once("include/aside_impressum.php");
        echo "</div>";
    ?>
    <div class='col-md-8'>
        <p>Bei Fragen, Anregungen oder anderen Anliegen kontaktieren Sie uns bitte unter den links angegebenen Kontaktmöglichkeiten.</p>
    </div>
</div>

<?php require_once('include/footer.php'); ?>

</body>
</html>

