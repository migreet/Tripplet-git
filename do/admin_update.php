<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Löschen von Usern
 */

/**
 * Requires
 */
require_once("../php/classes.php");

/**
 * Instanzen
 */
$dozentInstnc = new dozent();

/**
 * GETs
 */
$dozentenId=$_GET['id'];
$rights=$_GET['rights'];

/**
 * Session starten
 */
session_start();

/**
 * Sicherheitsabfrage
 * Wenn gesetzt dann Admin updaten
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
$dozent = $dozentInstnc->updateRights($dozentenId, $rights);
header ('location: ../admin.php');
endif;
?>