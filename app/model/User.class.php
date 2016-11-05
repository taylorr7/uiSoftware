<?php

class User extends DbObject {
	const DB_TABLE = 'users';

	public $username;
	public $password;
	public $namefirst;
	public $namelast;
	public $email;

	public function asLink() {
		return sprintf('<a href="%s/authors/view/%2$s">%2$s</a>', BASE_URL, $this->username);
	}

	/*
	* Function to return the User
	* table.
	*/
	protected function getTable() {
		return self::DB_TABLE;
	}

	/*
	* Function to return the Gravatar url
	*/
	public function getProfileUrl() {
		$hash = md5(strtolower(trim($this->email)));
		return "https://www.gravatar.com/avatar/{$hash}.jpg?s=256";
	}

	/*
	* Function to return the User object associated
	* with the given id.
	*/
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} users with id {$id}");
		}
		return $results[0];
	}

	/*
	* Function to return the User object associated
	* with the given username.
	*/
	public static function loadByUsername($username) {
		$results = Db::instance()->selectByProperty(self::DB_TABLE, 'username', $username, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} users with username {$id}");
		}
		return $results[0];
	}

	/*
	* Function to return the User object associated
	* with the given username and password.
	*/
	public static function loadByCredentials($username, $password) {
		$results = Db::instance()->selectByProperties(
			self::DB_TABLE,
			array('username' => $username, 'password' => $password),
			__CLASS__);

		$numResults = count($results);
		if ($numResults > 1) {
			die("Found {$numResults} users with same credentials");
		} else if ($numResults == 1) {
			return $results[0];
		}
		return null;
	}

	/*
	* Function to search the User table for the user with
	* the given credentials.
	*/
	public static function search($qry) {
		return Db::instance()->search(
			self::DB_TABLE,
			array('namefirst', 'username', 'email', 'namelast'),
			$qry,
			__CLASS__);
	}
}
