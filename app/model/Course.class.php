<?php

class Course extends DbObject {
	const DB_TABLE = 'courses';

	public $userid;
	public $coursename;
	public $coursedescription;
	public $coursecontent;
	public $published;

	protected function getTable() {
		return self::DB_TABLE;
	}

	public function getCreator() {
		return User::loadById($this->userid);
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} courses with id {$id}");
		}
		return $results[0];
	}

	public static function loadByUser($user) {
		return Db::instance()->selectByProperty(self::DB_TABLE, 'userid', $user->id, __CLASS__);
	}

	public static function loadPublished() {
		return array_filter(
			Db::instance()->selectAll(self::DB_TABLE, __CLASS__),
			function($item) {
				return $item->published;
			});
	}

	public static function search($qry) {
		return Db::instance()->search(
			self::DB_TABLE,
			array('coursename', 'coursedescription'),
			$qry,
			__CLASS__);
	}
}
