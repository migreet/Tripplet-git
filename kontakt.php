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
        <form class="form-horizontal">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textfeld">Kontaktformular</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="textfeld">Ihre Anfrage</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textfeld">Name</label>
                    <div class="col-md-4">
                        <input id="textfeld" name="textfeld" type="text" placeholder="placeholder" class="form-control input-md">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textfeld">Name</label>
                    <div class="col-md-4">
                        <input id="textfeld" name="textfeld" type="text" placeholder="placeholder" class="form-control input-md">
                    </div>
                </div>


            </fieldset>
        </form>

    </div>
</div>

<?php require_once('include/footer.php'); ?>

</body>
</html>

