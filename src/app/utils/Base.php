<?php
/*
 * Simplified methods to var dump and die.
 */
function dd($toDd){
    var_dump($toDd);
    die();
}

$request = $_REQUEST;