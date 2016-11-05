<?php

class Lesson extends DbObject {
	// The name of the database table it represents
	const DB_TABLE = 'lessons';

	// The database columns
	public $userid;
	public $lessonname;
	public $content;

	protected function getTable() {
		return self::DB_TABLE;
	}

	// Static helper function that loads lesson by id
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} lessons with id {$id}");
		}
		return $results[0];
	}

	// Static helper function that loads all lessons creataed by user
	public static function loadByUser($user) {
		return Db::instance()->selectByProperty(self::DB_TABLE, 'userid', $user->id, __CLASS__);
	}

	// Static helper function that loads a lesson by a name
	public static function loadByName($name) {
		$results = Db::instance()->selectByProperty(self::DB_TABLE, 'lessonname', $name, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} lessons with name {$name}");
		}
		return $results[0];
	}
}
