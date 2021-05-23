<?php
	/*
	Connect to data base
	*/
	$dbhost = getenv('DATABASE_HOST');
	$dbuser = getenv('DATABASE_USER');
	$dbpass = getenv('DATABASE_PASS');
	$dbname = getenv('DATABASE_NAME');
	$template = 'default';
	// $connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	$connection = mysqli_connect("free01.123host.vn","huuhieuc_hstore","nk0ckhun9","huuhieuc_hstore");
	// $connection = mysqli_connect("localhost","root","","hstore");
	mysqli_set_charset($connection, 'UTF8');
	if (!$connection) {
		echo "Error:".mysqli_connect_error();
	}
?>
