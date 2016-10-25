<?php

class Subscription extends DbObject {
	const DB_TABLE = 'subscriptions';
	
	protected $id;
	protected $userid;
	protected $courseid;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'userid' => '',
				'courseid' => ''
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->userid = $args['userid'];
		$this->courseid = $args['courseid'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'userid' => $this->userid,
				'courseid' => $this->courseid,
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
	
	public static function getUser($id = null) {
		if($id === null) {
			return null;
		} else {
			$db = Db::instance();
			return $db->fetchById($id, 'User', 'users');
		}		
	}
	
	public static function getCourse($id = null) {
		if($id === null) {
			return null;
		} else {
			$db = Db::instance();
			return $db->fetchById($id, 'Course', 'courses');
		}
	}
}