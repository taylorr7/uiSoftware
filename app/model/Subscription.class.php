<?php

class Subscription extends DbObject {
	const DB_TABLE = 'subscriptions';

	public $userid;
	public $courseid;

	protected function getTable() {
		return 'DB_TABLE';
	}

	public function getCourse() {
		return Course::loadById($this->courseid);
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} subscriptions with id {$id}");
		}
		return $results[0];
	}

	public static function loadByUser($user) {
		return Db::instance()->selectByProperty(self::DB_TABLE, 'userid', $user->id, __CLASS__);
	}
}
