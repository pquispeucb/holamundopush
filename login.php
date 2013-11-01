<?php

$varUsername = $_POST['paramUsername'];
$varPassword = $_POST['paramPassword'];

if($varUsername == "hola" && $varPassword == "hola"){
	echo 'working';
}else{
	echo 'invalid';
}

?>