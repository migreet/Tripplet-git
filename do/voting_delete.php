<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Löschen der Fragen
 */

/**
 * Requires
 */
require_once("../php/classes.php");

/**
 * GETs
 */
$fragenId=$_GET['id'];
$votingId=$_GET['idvoting'];

/**
 * Instanzen
 */
$fragenInstnc = new frage();

/**
 * Session starten
 */
session_start();

/**
 * Sicherheitsabfrage
 * Fragen löschen
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

/**
 * Fragen werden gelöscht
 */
else:
    $frage = $fragenInstnc->delete($fragenId);
    header ('location: ../voting.php?id=' .$votingId);
endif;
?>