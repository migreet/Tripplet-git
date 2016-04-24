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

//Instanzen
$dozentInstnc = new dozent();

//GETs
$dozentenId=$_GET['id'];


$vorlesung = $vorlesungInstnc->delete($dozentenId);
header ('location: ../admin.php');

?>