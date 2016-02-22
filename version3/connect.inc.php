<?php


// DB Constants
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'jesse';
$mysql_dbname = 'treasure_hunt'; // Change all the attributes

$CONN_ERROR = "Could'nt connect";


// DB Connection

$mysql_connect = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_dbname) or die($CONN_ERROR);


?>