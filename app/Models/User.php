<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path = explode("public", $path);
	$path = $path[0]; 
    require_once ($path. "App/Models/Users/User.php");
