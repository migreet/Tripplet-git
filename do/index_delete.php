<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */
//L�schen der Vorlesungen


//Requires
require_once("../php/classes.php");
session_start();

//Instanzen
$vorlesungInstnc = new vorlesung();

//GETs
$vorlesungsId=$_GET['id'];


$vorlesung = $vorlesungInstnc->delete($vorlesungsId);
//auswertungen die zu fragen geh�ren die zu votings geh�ren die zu vorlesungen geh�ren. antworten auch
header ('location: ../index.php');

?>