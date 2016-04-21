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

//Instanzen
$votingInstnc = new voting();

//GETs
$votingId=$_GET['id'];
$vorlesungsId=$_GET['idvorlesung'];


$voting = $votingInstnc->delete($votingId);
header ('location: ../vorlesung.php?id=' .$vorlesungsId);

?>