

<!DOCTYPE html>
<html lang="de">

<?php

require_once("php/classes.php");
require_once("include/header.php");
?>


<body>

<div class="container">
<h1>Vielen Dank für Ihre Teilnahme!</h1>
<p>Sie können das Browserfenster nun schließen</p>

<?php
session_start();
session_destroy();
?>
</div>