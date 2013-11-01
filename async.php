<?php
 // receive data from app's http request
 $data=$_POST["message"];
 // write data from my android app to a text file
 file_put_contents('mensaje.txt',$data);
 echo "Mensaje enviado correctamente";
?>