<?php

class Course extends DbObject {
	private const DB_TABLE = 'courses';

	public $userid;
	public $coursename;
	public $coursedescription;
	public $hidden;

	protected function getTable() {
		return 'DB_TABLE';
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} courses with id {$id}");
		}
		return $results[0];
	}
}
