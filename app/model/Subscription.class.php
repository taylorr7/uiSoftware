<?php

class Subscription extends DbObject {
	const DB_TABLE = 'subscriptions';

	public $userid;
	public $courseid;

	public static function loadById($id) {
		$db = Db::instance();
		$obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
		return $obj;
	}

	protected function getTable() {
		return 'DB_TABLE';
	}

	public static function loadById($id) {
		$results = Db::instance()->selectById(DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} subscriptions with id {$id}");
		}
		return $results[0];
	}
}
