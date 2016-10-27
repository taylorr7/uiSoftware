<?php

class User extends DbObject {
	const DB_TABLE = 'users';
	
	protected $id;
	protected $username;
	protected $password;
	protected $firstname;
	protected $lastname;
	protected $email;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'username' => '',
				'password' => '',
				'firstname' => null,
				'lastname' => null,
				'email' => null
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->username = $args['username'];
		$this->password = $args['password'];
		$this->firstname = $args['namefirst'];
		$this->lastname = $args['namelast'];
		$this->email = $args['email'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'username' => $this->username,
				'password' => $this->password,
				'firstname' => $this->firstname,
				'lastname' => $this->lastname,
				'email' => $this->email
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
	
	public static function loadByUsername($username = null) {
		if($username == null) {
			return null;
		}
		$query = sprintf(" SELECT id FROM %s WHERE username = '%s' ", self::DB_TABLE, $username);
		$db = Db::instance();
		$result = $db->lookup($query);
		if(!mysql_num_rows($result)) {
			return null;
		} else {
			$row = mysql_fetch_assoc($result);
			$obj = self::loadById($row['id']);
			return ($obj);
		}
	}
}