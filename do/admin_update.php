<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */
//Löschen von Usern


//Requires
require_once("../php/classes.php");
session_start();
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
//Instanzen
$dozentInstnc = new dozent();

//GETs
$dozentenId=$_GET['id'];
$rights=$_GET['rights'];


$dozent = $dozentInstnc->updateRights($dozentenId, $rights);
header ('location: ../admin.php');
endif;
?>