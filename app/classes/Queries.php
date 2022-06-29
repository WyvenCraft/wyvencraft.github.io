<?php

class Queries {
	
	private static $db;

	public static function init() {

		if (!isset(self::$db)) {
			self::$db = Database::getInstance();
		}

	}
	
	public static function getAll($table, $limit = null) {

		$data = self::$db->getAll($table, $limit);
		return $data->results();

	}

	public static function getWhere($table, $where, $limit = null) {

		$whereStatement = self::formatWhereStatement($where);
		$data = self::$db->getWhere($table, $whereStatement, $limit);
		return $data->results();

	}

	public static function getFirst($table, $where) {

		$data = self::getWhere($table, $where);
		return ((empty($data)) ? null : $data[0]);

	}
	
	public static function orderAll($table, $order, $sort = null, $limit = null) {

		$data = self::$db->orderAll($table, $order, $sort, $limit);
		return $data->results();

	}
	
	public static function orderWhere($table, $where, $order, $sort = null, $limit = null) {

		$whereStatement = self::formatWhereStatement($where);
		$data = self::$db->orderWhere($table, $whereStatement, $order, $sort, $limit);
		return $data->results();
		
	}
	
	public static function create($table, $fields = []) {

		$keys = '';
		$values = '';
		$i = 0;
		foreach ($fields as $key => $value) {
			$i++;
			$keys .= '`' . $key . '`';
			$values .= '\'' . self::$db->getConnection()->real_escape_string($value) . '\'';
			if ($i < count($fields)) {
				$keys .= ', ';
				$values .= ', ';
			}
		}

		$fields = '(' . $keys . ') VALUES ( ' . $values . ')';
		return self::$db->insert($table, $fields);

	}
	
	public static function update($table, $where, $fields = []) {

		$set = '';
		$i = 0;
		foreach ($fields as $key => $value) {
			$i++;
			$set .= '`' . $key . '` = \'' . self::$db->getConnection()->real_escape_string($value) . '\'';
			if ($i < count($fields)) {
				$set .= ', ';
			}
		}

		$whereStatement = self::formatWhereStatement($where);
		return self::$db->update($table, $whereStatement, $set);

	}
	
	public static function delete($table, $where) {

		$whereStatement = self::formatWhereStatement($where);
		return self::$db->delete($table, $whereStatement);

	}

	public static function increment($table, $where, $field) {

		$whereStatement = self::formatWhereStatement($where);
		return self::$db->increment($table, $whereStatement, $field);

	}

	public static function decrement($table, $where, $field) {

		$whereStatement = self::formatWhereStatement($where);
		return self::$db->decrement($table, $whereStatement, $field);

	}

	public static function getLastID() {

		return self::$db->getLastID();

	}

	private static function formatWhereStatement($whereArray) {
	
		$whereStatement = '';
		$i = 0;
		foreach ($whereArray as $key => $value) {
			$i++;
			$whereStatement .= '`' . $key . '` = ' . '\'' . $value. '\'';
			if ($i < count($whereArray)) {
				$whereStatement .= ' AND ';
			}
		}

		return $whereStatement;

	}

}