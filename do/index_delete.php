<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */
//Löschen der Vorlesungen


//Requires
require_once("../php/classes.php");
session_start();

//Instanzen
$vorlesungInstnc = new vorlesung();

//GETs
$vorlesungsId=$_GET['id'];


$vorlesung = $vorlesungInstnc->delete($vorlesungsId);
//auswertungen die zu fragen gehören die zu votings gehören die zu vorlesungen gehören. antworten auch
header ('location: ../index.php');

?>