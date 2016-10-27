<?php

class Lesson extends DbObject {
	const DB_TABLE = 'lessons';
	
	protected $id;
	protected $userid;
	protected $lessonname;
	protected $content;
	
	public function __construct($args = array()) {
		$defaultArgs = array(
				'id' => null,
				'userid' => '',
				'lessonname' => '',
				'content' => ''
			);
		$args += $defaultArgs;
		$this->id = $args['id'];
		$this->userid = $args['userid'];
		$this->lessonname = $args['lessonname'];
		$this->content = $args['content'];
	}
	
	public function save() {
		$db = Db::instance();
		$db_properties = array(
				'userid' => $this->userid,
				'lessonname' => $this->lessonname,
				'content' => $this->content
			);
		$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
	}
	
	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}
}