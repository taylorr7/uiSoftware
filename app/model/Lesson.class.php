<?php

class Lesson extends DbObject {
	const DB_TABLE = 'lessons';

	public $userid;
	public $lessonname;
	public $content;

	protected function getTable() {
		return 'DB_TABLE';
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} lessons with id {$id}");
		}
		return $results[0];
	}

	public static function loadByUser($user) {
		Db::instance()->selectByProperty(DB_TABLE, 'userid', $user->getId(), __CLASS__);
	}
}
