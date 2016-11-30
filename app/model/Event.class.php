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

	// The primary user associated with event
    public function getUser1() {
        return User::loadById($this->user1id);
    }

	// The secondary user associated with event
    public function getUser2() {
        return User::loadById($this->user2id);
    }

	// Formats the timestamp for web-friendly output
	public function getPrettyDate() {
		return date("F j, Y, g:i a", strtotime($this->timestamp));
	}

	// A static helper function that creates the proper event subclass
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

	// Deletes all events associated with the given user
	public static function deleteUsersEvents($user) {
		Db::instance()->deleteByProperty(self::DB_TABLE, 'user1id', $user->id);
		Db::instance()->deleteByProperty(self::DB_TABLE, 'user2id', $user->id);
	}

	// Gets events with given primary user
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

  // Get events of users and people he is subscribed to
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

  public static function getActivityForMonth($user) {
	$table = self::DB_TABLE;

	return array_map(function($i) use ($user, $table) {
		$query = <<<SQL
SELECT DATE_SUB(CURRENT_DATE(), INTERVAL {$i} day) as day,
	COUNT(*) as count from {$table}
WHERE (user1id='{$user->id}' OR user2id='{$user->id}')
	AND date(timestamp) = DATE_SUB(CURRENT_DATE(), INTERVAL {$i} day);
SQL;
		return Db::instance()->select($query)[0];
	}, range(0, 30));
  }
}
