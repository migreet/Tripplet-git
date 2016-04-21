<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 */

//Requires
require_once("php/classes.php");
session_start();

//Instanzen
$votingInstnc = new voting();

//GETs
$votingId=$_GET['id'];


$voting = $votingInstnc->delete($votingId);
header ('location: ../voting.php');

?>