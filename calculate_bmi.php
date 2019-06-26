<?php
var_dump($_POST);
include("./classes/class_dbase.php");

$dbase = new Dbase();
$dbase->insert_record($_POST);
