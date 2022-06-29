<?php

class Database {

	private static $instance = null;
	private $_results = null;
	private $_count = 0;
	private $_connection = null;

	public function __construct($dbConfig = []) {

		if (empty($dbConfig)) {
			$dbConfig = Config::get('database', 'credentials');
		}
		
		$this->_connection = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

		if ($this->_connection->connect_error) {
			die('Connection Failed: ' . $this->_connection->connect_error);
		}

		$announcement_table = "CREATE TABLE IF NOT EXISTS announcements (id int(11) AUTO_INCREMENT,
		title varchar(256) NOT NULL COLLATE 'utf8mb4_general_ci',
		description MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_general_ci',
		contentTitle varchar(256) NOT NULL COLLATE 'utf8mb4_general_ci',
		contentDescription MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_general_ci',
		author varchar(128) NOT NULL COLLATE 'utf8mb4_general_ci',
		createdAt varchar(64) NOT NULL COLLATE 'utf8mb4_general_ci',
		PRIMARY KEY (id))";

		$updates_table = "CREATE TABLE IF NOT EXISTS updates (id int(11) AUTO_INCREMENT,
		title varchar(256) NOT NULL COLLATE 'utf8mb4_general_ci',
		update_server varchar(256) NOT NULL COLLATE 'utf8mb4_general_ci',
		author varchar(128) NOT NULL COLLATE 'utf8mb4_general_ci',
		createdAt varchar(64) NOT NULL COLLATE 'utf8mb4_general_ci',
		PRIMARY KEY (id))";		

		$rules_table = "CREATE TABLE IF NOT EXISTS rules (id int(11) AUTO_INCREMENT,
		title varchar(256) NOT NULL COLLATE 'utf8mb4_general_ci',
		description MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_general_ci',
		punishment MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_general_ci',
		PRIMARY KEY (id))";		

		if ($this->_connection->query($announcement_table) === TRUE && $this->_connection->query($updates_table) === TRUE && $this->_connection->query($rules_table) === TRUE) {
			//echo "Tables created";
		  } else {
			echo "Error creating table: " . $this->_connection->error;
		}

	}
	
	public static function getInstance($dbConfig = []) {

		if (!isset(self::$instance)) {
			self::$instance = new Database($dbConfig);
		}
	
		return self::$instance;
	
	}

	public function getConnection() {

		return $this->_connection;

	} 

	public function query($sql) {

		$query = $this->_connection->query($sql);

		if ($query) {
			if ($query && strpos(strtoupper($sql), 'SELECT') === 0 || strpos(strtoupper($sql), 'ORDER') === 0) {
				$this->_results = $query;
				$this->_count = $query->num_rows;
			} else {
				$this->_results = null;
				$this->_count = 0;
			}
			return $this;
		} else {
			return $this;
		}

	}

	public function getAll($table, $limit = null) {

		$sql = "SELECT * FROM {$table}";

		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}

		return ((!$this->query($sql)) ? false : $this);

	}

	public function getWhere($table, $where, $limit = null) {

		$sql = "SELECT * FROM {$table} WHERE {$where}";

		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}

		return ((!$this->query($sql)) ? false : $this);

	}

	public function orderAll($table, $order, $sort = null, $limit = null) {

		$sql = "SELECT * FROM {$table} ORDER BY `{$order}`";

		if (!is_null($sort)) {
			$sql .= " {$sort}";
		}

		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}

		return ((!$this->query($sql)) ? false : $this);
		
	}

	public function orderWhere($table, $where, $order, $sort = null, $limit = null) {

		$sql = "SELECT * FROM {$table} WHERE {$where} ORDER BY `{$order}`";

		if (!is_null($sort)) {
			$sql .= " {$sort}";
		}

		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}

		return ((!$this->query($sql)) ? false : $this);
		
	}

	public function createTable($name, $data) {

		$sql = "CREATE TABLE {$name} ({$data})";
		return ((!$this->query($sql)) ? false : $this);

	}
	
	public function alterTable($name, $column, $attributes) {

		$sql = "ALTER TABLE `{$name}` ADD {$column} {$attributes}";
		return ((!$this->query($sql)) ? false : $this);

	}
	
	public function dropTable($name) {

		$sql = "DROP TABLE {$name}";
		return ((!$this->query($sql)) ? false : $this);

	}

	public function insert($table, $fields) {

		$sql = "INSERT INTO {$table} {$fields}";
		return ((!$this->query($sql)) ? false : $this);
	
	}

	public function delete($table, $where) {

		$sql = "DELETE FROM {$table} WHERE {$where}";
		return ((!$this->query($sql)) ? false : $this);


	}

	public function update($table, $where, $fields) {

		$sql = "UPDATE {$table} SET {$fields} WHERE {$where}";
		return ((!$this->query($sql)) ? false : $this);
	
	}

	public function increment($table, $where, $field) {

		$sql = "UPDATE {$table} SET {$field} = {$field} + 1 WHERE {$where}";
		return ((!$this->query($sql)) ? false : $this);
	
	}

	public function decrement($table, $where, $field) {

		$sql = "UPDATE {$table} SET {$field} = {$field} - 1 WHERE {$where}";
		return ((!$this->query($sql)) ? false : $this);
	
	}

	public function results() {

		if (!$this->_results) {
			return [];
		}

		$results = [];
		while ($result = $this->_results->fetch_object()) {
			$results[] = $result;    
		}

		return $results;

	}
	
	public function first() {

		$results = $this->results();
		return ((isset($results[0])) ? $results[0] : null);

	}
	
	public function count() {

		return $this->_count;

	}

	public function getLastID() {

		return $this->_connection->insert_id;

	}

}