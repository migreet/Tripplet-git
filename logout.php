<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 02.04.2016
 * Time: 09:38
 */
session_start();
session_destroy();
echo "Logout erfolgreich";
header('Location: index.php');