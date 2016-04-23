<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 01.04.2016
 * Time: 11:36
 */
session_start();

require_once("php/classes.php");
//require_once("include/session.php");

$mail = $_POST["mail"];
$passwort = hash ("MD5", $_POST["passwort"]);
$dozentInstnc = new dozent();
$dozent=$dozentInstnc->getByMail($mail);

if (!empty ($mail) && !empty ($passwort)) {

	if(!isset($_SESSION['login'])){
        if($mail===$dozent['mail'] && $passwort===$dozent['passwort']):
		$_SESSION ['login']=1;
		$_SESSION ['mail']=$mail;
            $_SESSION ['rights']=$dozent['ID_RECHTE'];
		$_SESSION ['id'] =$dozent['ID'];

        header ('location: index.php');

        else:
        header ('location: index.php');

        endif;
	}
	else {
		header ('location: index.php');
	}
	
	
	
	/*
    $userInstanz = new dozent();
    $logincheck = $userInstanz->getByMail($username);
    if ($logincheck == null) {
        header('Location: index.php');
    }
    else {session_start();
        $_SESSION ['benutzer'] = $userInstanz;
        $_SESSION ['login'] = "1";
        header('Location: index.php');
        die();
    }
	*/
}
else {echo "Ein Fehler ist aufgetreten. Bitter loggen Sie sich erneut ein.";}

?>


