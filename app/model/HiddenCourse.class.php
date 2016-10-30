<?php

class HiddenCourse extends DbObject {
	const DB_TABLE = 'hidden_courses';
	
	protected $id;
	protected $courseid;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'courseid' => '',
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->courseid = $args['courseid'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'courseid' => $this->courseid,
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
}