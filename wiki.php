<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (isset($_GET['search'])) {
	$search = $_GET['search'];
        
	$command = 'python /var/www/html/wiki.py '. $search . ' 2>&1';
	$output = shell_exec($command);

    $output= str_replace("[edit]"," ",$output);

	echo $output;

}
?>