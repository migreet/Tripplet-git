<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 02.05.2016
 * Time: 23:22
 */

//Requires
require_once("../php/classes.php");
require_once("../include/header.php");
session_start();

$votingInstnc = new voting();
$voting = $votingInstnc ->getByTimestamp();

foreach ($voting as $eintrag){

    $votingInstnc->update($eintrag['ID'], NULL);

}

