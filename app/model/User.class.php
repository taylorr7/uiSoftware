<?php

class User extends DbObject {
	const DB_TABLE = 'users';

	public $username;
	public $password;
	public $firstname;
	public $lastname;
	public $email;

	protected function getTable() {
		return 'DB_TABLE';
	}

	public function getGravatarHash() {
		return md5(strtolower(trim($this->$email)));
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} users with id {$id}");
		}
		return $results[0];
	}

	public static function loadByUsername($username) {
		$results = Db::instance()->selectByProperty(DB_TABLE, 'username', $username, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} users with username {$id}");
		}
		return $results[0];
	}

	public static function loadByCredentials($username, $passwaord) {
		$results = Db::instance()->selectByProperties(
			DB_TABLE,
			array('username' => $username, 'password' => $password),
			__CLASS__);

		$numResults = count($results);
		if ($numResults > 1) {
			die("Found ${$numResults} users with same credentials");
		} else if ($numResults == 1) {
			return $results[0];
		}
		return null;
	}
}
