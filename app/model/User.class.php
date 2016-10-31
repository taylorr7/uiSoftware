<?php

class User extends DbObject {
	const DB_TABLE = 'users';

	public $username;
	public $password;
	public $namefirst;
	public $namelast;
	public $email;

	protected function getTable() {
		return self::DB_TABLE;
	}

	public function getGravatarHash() {
		return md5(strtolower(trim($this->email)));
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} users with id {$id}");
		}
		return $results[0];
	}

	public static function loadByUsername($username) {
		$results = Db::instance()->selectByProperty(self::DB_TABLE, 'username', $username, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} users with username {$id}");
		}
		return $results[0];
	}

	public static function loadByCredentials($username, $password) {
		$results = Db::instance()->selectByProperties(
			self::DB_TABLE,
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

	public static function search($qry) {
		return Db::instance()->search(
			self::DB_TABLE,
			array('namefirst', 'username', 'email', 'namelast'),
			$qry,
			__CLASS__);
	}
}
