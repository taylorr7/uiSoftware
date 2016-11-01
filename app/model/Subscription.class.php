<?php

class Subscription extends DbObject {
	const DB_TABLE = 'subscriptions';

	public $userid;
	public $courseid;

	/*
	* Function to return the Subscription
	* table.
	*/
	protected function getTable() {
		return self::DB_TABLE;
	}

	/*
	* Function to return the Course object associated
	* with this Subscription.
	*/
	public function getCourse() {
		return Course::loadById($this->courseid);
	}

	/*
	* Function to return the Subscription object associated
	* with the given id.
	*/
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found ${$numResults} subscriptions with id {$id}");
		}
		return $results[0];
	}

	/*
	* Function to return the Subscription objects associated
	* with the given user id.
	*/
	public static function loadByUser($user) {
		return Db::instance()->selectByProperty(self::DB_TABLE, 'userid', $user->id, __CLASS__);
	}
}
