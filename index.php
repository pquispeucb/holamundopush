<html>
<head>
<title>PROTOTIPO ENVIO DE NOTIFICACIONES</title>
 <link rel="stylesheet" type="text/css" href="js/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="assets/style.css" />
<link rel="stylesheet" type="text/css" href="assets/prettify.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/prettify.js"></script>
<script type="text/javascript" src="js/jquery.multiselect.js"></script>

	<script>
		$(function(){
			$("#ids").multiselect(); 
		});
		
	
	</script>
 </head>
<body id="test" onload="prettyPrint();" bgcolor="yellow">
<img src="ucb.jpg" width="140" height="200" border="1"></br></br>
<font size=5>PAGINA PARA ENVIO DE NOTIFICACIONES - PROTOTIPO</font>
<form action="gcm_engine.php" method="post">
<font size=3>SELECCIONE EL CODIGO DEL REGISTRO DEL DISPOSITIVO MOVIL:</font> 


<select name="registrationIDs[]" multiple="multiple" id="ids">
<?php
// define file
/*
$file = 'android.txt';
$c=1;
$handle = @fopen($file, 'r');
if ($handle) {
   while (!feof($handle)) {
       $line = fgets($handle, 4096);
       $item = explode('|', $line);
       echo '<option value="' . $item[0] . '">' . $item[0] . '</option>' . "\n";
		$c++;
   }
   fclose($handle);
   
   */
   
   
   $services_json = json_decode(getenv("VCAP_SERVICES"),true);
	$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
	$username = $mysql_config["username"];
	$password = $mysql_config["password"];
	$hostname = $mysql_config["hostname"];
	$port = $mysql_config["port"];
	$db = $mysql_config["name"];
   
   
   /*
   $hostname='127.0.0.1';
   $username='root';
   $password='';
   $db='test';
   
   */
   
   $conexion=mysql_connect($hostname,$username,$password) 
		  or die("Problemas en la conexion");
		mysql_select_db($db,$conexion) or
		  die("Problemas en la seleccion de la base de datos");

	$registros=mysql_query("select * from id_devices",$conexion) or
	  die("Problemas en el select:".mysql_error());

	while ($reg=mysql_fetch_array($registros))
	{
	  echo '<option value="' . $reg['registration_id'] . '">' . $reg['registration_id'] . '</option>' . "\n";
			
	}
	mysql_close($conexion);
	
?>
</select>

</br></br>
<font size=3>ESCRIBA EL CONTENIDO DE LA NOTIFICACION:</font> 
<INPUT size=70% TYPE = "Text" VALUE="" NAME = "message">
</br></br>

<input type="submit" value="ENVIAR"/>
<div style="visibility: hidden">
Google API Key (with IP locking) : <INPUT size=70% TYPE="Text" readonly="readonly" VALUE="AIzaSyC6RXR-dufXPPGcaupspTtliu34iNVQIhU" NAME="apiKey">
Get your Google API Key : <a href="https://code.google.com/apis/console/" target="_blank">Google API</a>
<img src="http://www.androidbegin.com/wp-content/uploads/2013/05/Google-API-Key.png" alt="Google API Key" >
</div>
</form>

</body>
</html>