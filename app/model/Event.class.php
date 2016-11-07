<?php

abstract class Event extends DbObject {
	// The name of the database table it represents
	const DB_TABLE = 'event';

	// The database columns
	public $eventtypeid;
	public $user1id;
	public $user2id;
    public $data;
    public $timestamp;

    public abstract function getDescription();

	protected function getTable() {
		return self::DB_TABLE;
	}

    public function getUser1() {
        return User::loadById($this->user1id);
    }

    public function getUser2() {
        return User::loadById($this->user2id);
    }

	public function getPrettyDate() {
		return date("F j, Y, g:i a", strtotime($this->timestamp));
	}

    private static function getEventSubclass($event) {
        switch ($event['eventtypeid']) {
            case 1:
                return new NewCourseEvent($event);
            case 2:
                return new EditCourseEvent($event);
            case 3:
                return new NewLessonEvent($event);
            case 4:
                return new EditLessonEvent($event);
            case 5:
                return new CourseCommentEvent($event);
            case 6:
                return new SubscribeEvent($event);
            default:
				echo "Unknown event type";
                return $event;
        }
    }

	// Static helper function that loads event by id
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} events with id {$id}");
		}
		return self::getEventSubclass($results[0]);
	}

  public static function getUserEvents($user, $limit = null) {
		$table = self::DB_TABLE;
		$query = "SELECT * FROM {$table} WHERE user1id='{$user->id}' ORDER BY timestamp DESC";
		if (!is_null($limit)) {
			$query .= " LIMIT " . $limit;
		}
		$query .= ";";
		$results = Db::instance()->select($query);
		return array_map(array(__CLASS__, 'getEventSubclass'), $results);
  }

  public static function getFeedEvents($user, $limit = null) {
		$table = self::DB_TABLE;
    $query = "SELECT * FROM {$table} WHERE user1id='{$user->id}' OR user2id='{$user->id}'";
    $subscriptions = Subscription::loadByUser($user);
    $subscriptionsClause = array_reduce($subscriptions, function($carry, $item) {
      $subscribeeId = $item->getSubscribee()->id;
        return "{$carry} OR user1id='{$subscribeeId}' OR user2id='{$subscribeeId}'";
    });
		$orderByClause = " ORDER BY timestamp DESC";
    $query .= $subscriptionsClause . $orderByClause;
		if (!is_null($limit)) {
			$query .= " LIMIT " . $limit;
		}
		$query .= ";";
    $results = Db::instance()->select($query);
    return array_map(array(__CLASS__, 'getEventSubclass'), $results);
  }
}
