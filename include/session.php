<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:13
 */
require_once("php/dbdata.php");
session_start ();
if ($_SESSION ['login']<>"1")
        {$_SESSION = array();
        session_destroy ();
        header ('location: index.php');}

else {
    $benutzer = $_SESSION ["benutzer"];
}
?>