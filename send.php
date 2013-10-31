<?php



if (isset($_POST['android'])) {

	$services_json = json_decode(getenv("VCAP_SERVICES"),true);
	$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
	$username = $mysql_config["username"];
	$password = $mysql_config["password"];
	$hostname = $mysql_config["hostname"];
	$port = $mysql_config["port"];
	$db = $mysql_config["name"];


	$id = $_POST['android'];
	
	$conexion=mysql_connect($hostname,$username,$password) 
	  or die("Problemas en la conexion");
	mysql_select_db($db,$conexion) or
	  die("Problemas en la seleccion de la base de datos");
	mysql_query("insert into id_devices values (null,'$id')", 
	   $conexion) or die("Problemas en el select".mysql_error());
	mysql_close($conexion);
	
	echo "Dispositivo registrado";
}



?>