<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * L�schen der Votings
 */

/**
 * Requires
 */
require_once("../php/classes.php");

/**
 * GETs
 */
$votingId=$_GET['id'];
$vorlesungsId=$_GET['idvorlesung'];

/**
 * Instanzen
 */
$votingInstnc = new voting();

/**
 * Session starten
 */
session_start();

/**
 * Sicherheitsabfrage
 * Votings l�schen
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
    /**
     * Rights Check
     */
    $usercheck=$votingInstnc->userCheck($ID_Vorlesung);
    if($usercheck['ID']!=$_SESSION['user_id']):
        header ('location: index.php');
    endif;

    /**
     * Votings l�schen
     */
    $voting = $votingInstnc->delete($votingId);
    header ('location: ../vorlesung.php?id=' .$vorlesungsId);
endif;
?>