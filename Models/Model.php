<?php
namespace Models;

class Model {
	public $page_size = 3;
	public $fields = [];
	protected $connection;
	protected $tablename;

	protected function init_connection() {
		$config = $GLOBALS['config'];
		$this->connection = new \mysqli($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
	}

	public function close_connection() {
		$this->connection->close();
	}

	public function create($data) {
		$this->init_connection();

		$query = "INSERT INTO ".$this->tablename." ("
			.implode(',', array_keys($data))
			.") VALUES (".
			trim(str_repeat('?,', count($data)), ',').
			");";

		$statement = $this->connection->prepare($query);

		$values = [];
		$types = '';
		foreach ($data as $name => $value) {
			$values[] = $value;
			
			foreach ($this->fields as $field) {
				if($field['name'] = $name) {
					$types .= $field['type'];
					break;
				}
			}	
		}

		$statement->bind_param($types, ...$values);
		$statement->execute();

		$this->close_connection();
	}

	public function list($page=null, $order_by=null, $order_type=null) {
		$this->init_connection();

		$query = "SELECT * FROM ".$this->tablename;
		
		if($order_by) {
			$query .= " ORDER BY $order_by $order_type";
		}

		if($page) {
			$query .= " LIMIT ".($page-1)*$this->page_size.",".$this->page_size;
		}

		$query .= ";";

		$result = $this->connection->query($query);

		$rows = $result->fetch_all(MYSQLI_ASSOC);

		$this->close_connection();

		return $rows;
	}

	public function count() {
		$this->init_connection();

		$query = "SELECT 1 FROM ".$this->tablename.";";
		$result = $this->connection->query($query);
		$count = $result->num_rows;

		$this->close_connection();

		return $count;		
	}

	public function get($id) {
		$this->init_connection();

		$query = "SELECT * FROM ".$this->tablename." WHERE id = ? LIMIT 1;";
		$statement = $this->connection->prepare($query);
		$statement->bind_param('i', $id);
		$statement->execute();
		$result = $statement->get_result();

		$model = null;

		if($result->num_rows > 0) {
			$model = $result->fetch_assoc();
		}

		$this->close_connection();

		return $model;
	}

	public function update($id, $data) {
		$this->init_connection();

		$query = "UPDATE ".$this->tablename." SET ";

		foreach ($data as $key => $value) {
			$query .= " $key=? ,";
		}
		$query = trim($query, ',');

		$query .= " WHERE id=$id;";

		$statement = $this->connection->prepare($query);

		$values = [];
		$types = '';
		foreach ($data as $name => $value) {
			$values[] = $value;
			
			foreach ($this->fields as $field) {
				if($field['name'] = $name) {
					$types .= $field['type'];
					break;
				}
			}	
		}

		$statement->bind_param($types, ...$values);
		$statement->execute();

		$this->close_connection();
	}

}