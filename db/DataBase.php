<?php

declare(strict_types=1);

class DataBase 
{
	private $conn;

	public function __construct(PDO $pdo)
	{
		$this->conn = $pdo;
	}

	public function add(string $email,string $message): bool
	{
		$query = $this->conn->prepare('INSERT INTO users (email,message) VALUES (:email,:message)');
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':message',$message,PDO::PARAM_STR);
		return $query->execute();	
	}

	public function all(): array
	{
		$query = $this->conn->prepare('SELECT * FROM users');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function edit(int $id,string $email,string $message): bool
	{
		$query = $this->conn->prepare('UPDATE users SET email = :email, message = :message WHERE id = :id');
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':message',$message,PDO::PARAM_STR);
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		return $query->execute();	
	}

	public function delete(int $id): bool
	{
		$query = $this->conn->prepare('DELETE FROM users WHERE id = :id');
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		return $query->execute();
	}

	public function getList(int $id): ?object
	{
		$query = $this->conn->prepare('SELECT * FROM users WHERE id = :id');
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		$query->execute();
		$value = $query->fetch(PDO::FETCH_OBJ);
		if (empty($value)) {
			return null;
		}

		return $value;
	}

} 