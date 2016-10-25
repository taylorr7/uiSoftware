<?php

class Course extends DbObject {
	const DB_TABLE = 'courses';
	
	protected $id;
	protected $userid;
	protected $coursename;
	protected $coursedescription;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'userid' => '',
				'coursename' => '',
				'coursedescription' => ''
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->userid = $args['userid'];
		$this->coursename = $args['coursename'];
		$this->coursedescription = $args['coursedescription'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'userid' => $this->userid,
				'coursename' => $this->coursename,
				'coursedescription' => $this->coursedescription
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
}