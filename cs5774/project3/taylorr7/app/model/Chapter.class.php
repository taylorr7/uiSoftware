<?php

class Chapter extends DbObject {
	const DB_TABLE = 'chapters';
	
	protected $id;
	protected $courseid;
	protected $lessonid;
	protected $chapternumber;
	protected $lessonnumber;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'courseid' => '',
				'lessonid' => '',
				'chapternumber' => '',
				'lessonnumber' => ''
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->courseid = $args['courseid'];
		$this->lessonid = $args['lessonid'];
		$this->chapternumber = $args['chapternumber'];
		$this->lessonnumber = $args['lessonnumber'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'courseid' => $this->courseid,
				'lessonid' => $this->lessonid,
				'chapternumber' => $this->chapternumber,
				'lessonnumber' => $this->lessonnumber
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
	
	public static function getCourse($id = null) {
		if($id === null) {
			return null;
		} else {
			$db = Db::instance();
			return $db->fetchById($id, 'Course', 'courses');
		}
	}
	
	public static function getLesson($id = null) {
		if($id === null) {
			return null;
		} else {
			$db = Db::instance();
			return $db->fetchById($id, 'Lesson', 'lessons');
		}		
	}
}