<?php
require "config.php";
/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */


try 
{
// 	$connection = new PDO($baseDSN, $username, $password, $options);
	$connection = new PDO($dsn);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = file_get_contents("sql/init-sqlite.sql");
	$connection->exec($sql);
	
	echo "Database and table users created successfully.";
	
}

catch(PDOException $error)
{
	echo $sql . "<br>" . $error->getMessage();
}

