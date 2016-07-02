<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 24.04.2016
 * Time: 15:10
 */

require_once("include/header.php");
require_once("php/classes.php");

session_start();

unset($_SESSION['votingid']);

header('location: vote.php?notification='."2");
?>