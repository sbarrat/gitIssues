<?php
var_dump($_POST);
// Comprobar si la aplicacion esta autorizada
$ch = curl_init("https://api.github.com/");
curl_setopt($ch, CURLOPT_POST, true);
var_dump(curl_getinfo($ch));
curl_close($ch);