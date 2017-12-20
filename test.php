<?php
$str = "I really can't describe the picture \ud83d\ude33";
$results = array();
preg_match_all('/./u', $str, $results);
var_dump($results[0]);
?>