<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Löschen der Vorlesungen
 */

//Requires
require_once("../php/classes.php");

/**
 * GETs
 */
$vorlesungsId=$_GET['id'];

/**
 * Instanzen
 */
$vorlesungInstnc = new vorlesung();

/**
 * Session starten
 */
session_start();

/**
 * Sicherheitsabfrage
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:

    /**
     * Rights check
     */
$usercheck=$vorlesungInstnc->userCheck($vorlesungsId);
if($usercheck['ID']!=$_SESSION['user_id']):
    header ('location: index.php');
endif;

    /**
     * Vorlesungen werden gelöscht
     */
$vorlesung = $vorlesungInstnc->delete($vorlesungsId);
header ('location: ../index.php');
endif;
?>