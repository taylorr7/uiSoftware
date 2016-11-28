<?php
class Course extends DbObject {
	// The name of the database table it represents
	const DB_TABLE = 'courses';

	// The database columns
	public $userid;
	public $coursename;
	public $coursedescription;
	public $coursecontent;
	public $published;

	protected function getTable() {
		return self::DB_TABLE;
	}

	public function asLink() {
		return sprintf("<a href=\"%s/courses/view/%d\">%s</a>", BASE_URL, $this->id, $this->coursename);
	}

	// Loads the user who created the course
	public function getCreator() {
		return User::loadById($this->userid);
	}

	// Static helper function that loads course by id
	public static function loadById($id) {
		$results = Db::instance()->selectById(self::DB_TABLE, $id, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} courses with id {$id}");
		}
		return $results[0];
	}

	// Static helper function that loads all courses creataed by user
	public static function loadByUser($user, $publishedOnly = false) {
		$props = array('userid' => $user->id);
		if ($publishedOnly) {
			$props['published'] = true;
		}
		return Db::instance()->selectByProperties(self::DB_TABLE, $props, __CLASS__);
	}

	// Static helper function that loads all published courses
	public static function loadAll($publishedOnly = false) {
		if ($publishedOnly) {
			return Db::instance()->selectByProperty(self::DB_TABLE, 'published', 1, __CLASS__);
		} else {
			return Db::instance()->selectAll(self::DB_TABLE, __CLASS__);
		}
	}

	// Static helper function that searches all courses
	public static function search($qry) {
		return Db::instance()->search(
			self::DB_TABLE,
			array('coursename', 'coursedescription'),
			$qry,
			__CLASS__);
	}

	public static function loadUsersCourseData($user, $publishedOnly = false) {
		$usersCourses = self::loadByUser($user, $publishedOnly);

		$courseNodes = array_map(function($course) {
			preg_match_all("~LESSON:name-([^:]+):~", $course->coursecontent, $lessonMatches);
			$lessonNames = array_map(function($lessonName) {
				return array("name" => "Lesson: {$lessonName}", "size" => 1);
			}, $lessonMatches[1]);

			$commentsChildren = array_map(function($comment) {
				return array(
					"name" => "{$comment->getCommenter()->username} commented: {$comment->content}",
					"size" => 1
				);
			}, Comment::loadByCourse($course->id));
			$commentsNode = array("name" => "Comments", "children" => $commentsChildren);
			
			foreach($commentsNode as $key => &$child) {
				if($child == null) {
					$child = "No Comments";
				}
			}

			return array(
				"name" => $course->coursename,
				"published" => $course->published,
				"children" => array_merge($lessonNames, [$commentsNode])
			);
		}, $usersCourses);

		return array(
			"name" => "{$user->username}'s Courses",
			"children" => $courseNodes
		);
	}
}
