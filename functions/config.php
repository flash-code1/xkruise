<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// test
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'xkruisec');
define('DB_PASSWORD', 'O?TVyFg9X9jD');
define('DB_CHARSET', 'utf8');
define('DB_NAME', 'xkruisec_xkruise');

// MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);

// LIB PATH
// ! MANUALLY CHANGE THIS IF PHP IS THROWING FILE-NOT-FOUND ERRORS !
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$caching=10 ;
?>