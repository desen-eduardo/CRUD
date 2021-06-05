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
		}

	} else {
		header('Location:http://localhost/CRUD');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="main">
		<h1>CRUD</h1>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="update.php">
					<div class="row">
						<?php if ($_GET['msg'] === 'error'): ?>
						<div class="col-md-12">
							<div class="alert alert-danger">
								Os campos precisa ser preenchido
							</div>
						<?php endif; ?>
						<?php if ($_GET['msg'] === 'true'): ?>
						<div class="col-md-12">
							<div class="alert alert-success">
								Dados cadastrado com sucesso!
							</div>
						<?php endif; ?>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="mail">E-mail</label>
								<input type="email" name="email" id="mail" class="form-control" value="<?= $user->email; ?>">
								<input type="hidden" name="id" value="<?= $user->id; ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="message">Mensagem</label>
								<textarea name="message" id="message" class="form-control"><?= $user->message; ?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<button class="btn btn-success" type="submit">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>