<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost:3306";
$username   = "root";
$password   = "123456";
$dbname     = "test"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );







 ?>
