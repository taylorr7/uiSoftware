<?php

class Subscription extends DbObject {
	const DB_TABLE = 'subscriptions';

	public $user1id;
	public $user2id;

	/*
	* Function to return the Subscription
	* table.
	*/
	protected function getTable() {
		return self::DB_TABLE;
	}

	public function getSubscriber() {
		return User::loadById($user1id);
	}

	public function getSubscribee() {
		return User::loadById($user2id);
	}

	/*
	* Function to return the Subscription object associated
	* with the given id.
	*/
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} subscriptions with id {$id}");
		}
		return $results[0];
	}

	/*
	* Function to return the Subscription objects associated
	* with the given user id.
	*/
	public static function loadByUser($user) {
		return Db::instance()->selectByProperty(self::DB_TABLE, 'user1id', $user->id, __CLASS__);
	}

	/*
	* Function to return the Subscription objects associated
	* with the given subscriber and subscribee.
	*/
	public static function loadBySubscription($user1, $user2) {
		return Db::instance()->selectByProperties(self::DB_TABLE, array('user1id' => $user1->id, 'user2id' => $user2->id), __CLASS__);
	}
}