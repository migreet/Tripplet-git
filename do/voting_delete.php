<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */

//Löschen der Fragen

//Requires
require_once("../php/classes.php");
session_start();
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
//Instanzen
$fragenInstnc = new frage();

//GETs
$fragenId=$_GET['id'];
$votingId=$_GET['idvoting'];


$frage = $fragenInstnc->delete($fragenId);
header ('location: ../voting.php?id=' .$votingId);
endif;
?>