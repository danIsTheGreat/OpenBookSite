<?php

# Database Connection Variables
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "vrtuallibrary";

# Create MySql Connection
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

# Check If Connection Actually Created
if (!$conn) {
  die('Connection not successful'.mysqli_connect_error());
}