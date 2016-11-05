<?php
class Comment extends DbObject {
	// The name of the database table it represents
	const DB_TABLE = 'comments';

	// The database columns
	public $commenterid;
	public $content;
	public $timestamp;

	protected function getTable() {
		return self::DB_TABLE;
	}

	// Loads the user who created the comment
	public function getCommenter() {
		return User::loadById($this->commenterid);
	}

	// Static helper function that loads comment by id
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} comments with id {$id}");
		}
		return $results[0];
	}

	// Static helper function that loads comment by id
	public static function loadByCourse($courseId) {
		return Db::instance()->select(
            "SELECT * FROM {self::DB_TABLE} WHERE courseid = '{$courseId}' ORDER BY timestamp",
			__CLASS__);
	}
}
