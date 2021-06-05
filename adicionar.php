<?php

require_once('db/DataBase.php');

try {
	$pdo = new PDO('mysql:dbname=crud;host=mysql','root','root');
	$db = new Database($pdo);
} catch(PDOException $e) {
	throw new \Exception ('error de conexão'.$e->getMessage());
}


$email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
$message = filter_input(INPUT_POST, 'message',FILTER_SANITIZE_STRING);

if(isset($email) && !empty($email) && !empty($message)) {
	if ($db->add($email,$message)) {
		header('Location:http://localhost/CRUD/index.php?msg=true');
		exit;
	}
} 

header('Location:http://localhost/CRUD/index.php?msg=error');

