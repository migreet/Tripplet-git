<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 01.04.2016
 * Time: 10:04
 */ ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<?php include("include/header.php"); ?>


<body>
<?php include("include/navigation_login.php"); ?>

<div class="container" >
    <div class="form-horizontal col-sm-offset-6">
    <h1>Registrieren</h1>
    </div>
    <form class="form-horizontal col-sm-offset-6" role="form" action="register_do.php" method="post">
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="vorname" placeholder="Vorname" id="vorname" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nachname" placeholder="Nachname" id="nachname" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="password" class="form-control" name="passwort" placeholder="Passwort" id="passwort" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="password" class="form-control" name="passwort2" placeholder="Passwort bestätigen" id="passwort2" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mail" placeholder="Emailadresse" id="mail" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default">Registrieren</button>
            </div>
        </div>
    </form>

</div>
<?php require_once('include/footer.php'); ?>
</body>
</html>