<?php 

require_once('db/DataBase.php');

try {
	$pdo = new PDO('mysql:dbname=crud;host=mysql','root','root');
	$db = new Database($pdo);
} catch(PDOException $e) {
	throw new \Exception ('error de conexão'.$e->getMessage());
}

$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
$message = filter_input(INPUT_POST, 'message',FILTER_SANITIZE_STRING);

if (is_int($id) && isset($email) && !empty($email) && !empty($message)) {
	
	$user = $db->getList($id);

		if (empty($user)) {
			header('Location:http://localhost/CRUD/editar.php?id=$id');
			exit;
		}

	if ($db->edit($id,$email,$message)) {
		header('Location:http://localhost/CRUD');
		exit;
	}	
} 
	header('Location:http://localhost/CRUD/editar.php?id=$id');

