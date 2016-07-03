<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 01.04.2016
 * Time: 11:26
 * Registrieren
 */

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * GETs
 */
$vorname = htmlspecialchars($_POST["vorname"], ENT_QUOTES, "UTF-8");
$nachname = htmlspecialchars($_POST["nachname"], ENT_QUOTES, "UTF-8");
$passwort = hash ("MD5", htmlspecialchars($_POST["passwort"], ENT_QUOTES, "UTF-8"));
$mail = htmlspecialchars($_POST["mail"], ENT_QUOTES, "UTF-8");

/**
 * Validierung der Eingaben
 * Wenn Variablen befüllt, dann wird registriert
 */
if (!empty ($mail) && !empty ($passwort) && !empty ($nachname) && !empty ($vorname)):
    $dozentInstnc = new dozent();
    $dozent = $dozentInstnc->getByMail($mail);

    if (empty($dozent)):
        $liste = $dozentInstnc->signup($nachname, $vorname, $passwort, $mail);
    endif;

endif;
header('Location: index.php');


