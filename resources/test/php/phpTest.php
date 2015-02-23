<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-type:text/html');

phpInfo();

require_once('../../main/php/library.php');

echo "<p>All library files are required without error</p>";

?>