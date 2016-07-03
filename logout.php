<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 02.04.2016
 * Time: 09:38
 * Logout
 */
/**
 * Session wird beendet
 */
session_start();
session_destroy();
header('Location: index.php');