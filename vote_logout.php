<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 24.04.2016
 * Time: 15:10
 * Ausloggen beim Voting
 */

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * Session wird gestartet
 */
session_start();

/**
 * Voting ID in der Session wird resettet
 */
unset($_SESSION['votingid']);
header('location: vote.php?notification='."2");
?>