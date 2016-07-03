<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 02.05.2016
 * Time: 23:22
 * Alte Votings schließen
 */

/**
 * Requires
 */
require_once("../php/classes.php");
require_once("../include/header.php");

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
 * Votings nach Zeitstempel auslesen
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
    $voting = $votingInstnc ->getByTimestamp();

    /**
     * Alte Votings updaten
     */
    foreach ($voting as $eintrag){
    $votingInstnc->update($eintrag['ID'], NULL);

}
endif;
?>
