<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cof";
	$tbname = "feedback";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) 
	{
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Creating database if database doesn't exists
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	if ($conn->query($sql) === FALSE) 
	{
	    echo "Error creating database: " . $conn->error;
	}

	// Create connection with the database
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) 
	{
	    die("Connection failed: " . mysqli_connect_error());
	}

	//Creating table for inserting feedback data if it doesn't exists
	$sql = "CREATE TABLE IF NOT EXISTS ".$tbname." (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	rateApp VARCHAR(50),
	rateSatis VARCHAR(50)
	)";

	if ($conn->query($sql) === FALSE) 
	{
    	echo "Error creating table: " . $conn->error;
	}
 


?>