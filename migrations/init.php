<?php
include dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'main.php';

$mysqli = new mysqli($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

$result = $mysqli->query("
	CREATE TABLE IF NOT EXISTS task (
		id INT AUTO_INCREMENT PRIMARY KEY,  
		name VARCHAR(255) NOT NULL,  
		email VARCHAR(255) NOT NULL,  
		description TEXT NOT NULL,
		is_completed BOOLEAN NOT NULL DEFAULT FALSE,
		is_edited BOOLEAN NOT NULL DEFAULT FALSE  
	) ENGINE=INNODB;
");

$mysqli->query("
	CREATE TABLE IF NOT EXISTS user (
		id INT AUTO_INCREMENT PRIMARY KEY,  
		name VARCHAR(255) UNIQUE NOT NULL,  
		password VARCHAR(255) NOT NULL
	) ENGINE=INNODB;
");

$mysqli->query("
	INSERT INTO user (name, password) VALUES ('admin', '".password_hash('123', PASSWORD_DEFAULT)."');
");


$mysqli->close();