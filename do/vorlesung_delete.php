<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */
//Löschen der Votings


//Requires
require_once("../php/classes.php");
session_start();
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
//Instanzen
$votingInstnc = new voting();

//GETs
$votingId=$_GET['id'];
$vorlesungsId=$_GET['idvorlesung'];

//Rights Check
$usercheck=$votingInstnc->userCheck($ID_Vorlesung);
if($usercheck['ID']!=$_SESSION['user_id']) {
    header ('location: index.php');
}

//Vorlesung löschen
$voting = $votingInstnc->delete($votingId);
header ('location: ../vorlesung.php?id=' .$vorlesungsId);
endif;
?>