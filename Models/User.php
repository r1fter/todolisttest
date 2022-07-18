<?php
namespace Models;

class User extends Model {
	protected $tablename = 'user';
	
	public function auth($name, $password) {
		$this->init_connection();

		$query = "SELECT * FROM user WHERE name = ? LIMIT 1;";
		$statement = $this->connection->prepare($query);
		$statement->bind_param('s', $name);
		$statement->execute();
		$result = $statement->get_result();

		if($result->num_rows > 0) {
			$user = $result->fetch_assoc();
		} else {
			return false;
		}

		if(password_verify($password, $user['password'])) {
			session_start();
			$_SESSION['user'] = $name;
		} else {
			return false;
		}

		$this->close_connection();

		return true;
	}
}