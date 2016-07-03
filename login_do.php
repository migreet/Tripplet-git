<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 01.04.2016
 * Time: 11:36
 * Login ausführen
 */

/**
 * Requires
 */
require_once("php/classes.php");

/**
 * GETs
 */
$mail = $_POST["mail"];
$passwort = hash ("MD5", $_POST["passwort"]);

/**
 * Instanzen
 */
$dozentInstnc = new dozent();

/**
 * Session starten
 */
session_start();

/**
 * Daten werden überprüft
 * Session wird gesetzt bei nicht eingeloggtem Zustand
 */
$dozent=$dozentInstnc->getByMail($mail);

if (!empty ($mail) && !empty ($passwort)):

	if(!isset($_SESSION['login'])):
        if($mail===$dozent['mail'] && $passwort===$dozent['passwort']):
		$_SESSION ['login']=1;
		$_SESSION ['mail']=$mail;
        $_SESSION ['rights']=$dozent['ID_RECHTE'];
		$_SESSION ['user_id'] =$dozent['ID'];
            $_SESSION['id']= uniqid();
        header ('location: index.php');

        else:
        header ('location: index.php');

        endif;

	else :
		header ('location: index.php');

	endif;
	

else:
	echo "Ein Fehler ist aufgetreten. Bitter loggen Sie sich erneut ein.";
endif;

?>


