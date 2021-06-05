<?php 

require_once('db/DataBase.php');

	$id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);

	if (is_int($id)){
		
		try {
			$pdo = new PDO('mysql:dbname=crud;host=mysql','root','root');
			$db = new Database($pdo);
		} catch(PDOException $e) {
			throw new \Exception ('error de conexão'.$e->getMessage());
		}	

		$user = $db->getList($id);

		if (empty($user)) {
			header('Location:http://localhost/CRUD');
			exit;
		}

		if ($db->delete($id)) {
			header('Location:http://localhost/CRUD');
			exit;
		}

	} else {
		header('Location:http://localhost/CRUD');
	}