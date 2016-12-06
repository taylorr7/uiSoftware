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

	// Creates an object containing all the course and comment data associated
	// with a user.  To check if comments were written by user, the current user
	// must be provided as well
	public static function loadUsersCourseData($user, $curUser, $publishedOnly = false) {
		$usersCourses = self::loadByUser($user, $publishedOnly);

		$courseNodes = array_map(function($course) use($curUser) {
			// Use regex to get the lessons
			preg_match_all("~LESSON:name-([^:]+):~", $course->coursecontent, $lessonMatches);
			$lessonNames = array_map(function($lessonName) {
				return array("name" => "Lesson: {$lessonName}", "size" => 1);
			}, $lessonMatches[1]);

			$commentsChildren = array_map(function($comment) use($course, $curUser) {
				return array(
					"name" => "{$comment->getCommenter()->username} commented: {$comment->content}",
					"comment" => $comment->content,
					"id" => "Edit Comment",
					"courseId" => $course->id,
					"commentId" => $comment->id,
					"isOwn" => $comment->commenterid === $curUser->id,
					"size" => 1
				);
			}, Comment::loadByCourse($course->id));

			if (empty($commentsChildren)) {
				array_push($commentsChildren, array(
					"name" => "No Comments",
					"courseId" => $course->id,
					"size" => 1
				));
			}

			array_push($commentsChildren, array(
				"name" => "Add Comment",
				"id" => "Add Comment",
				"courseId" => $course->id,
				"size" => 1
			));

			$commentsNode = array("name" => "Comments", "children" => $commentsChildren);

			return array(
				"name" => $course->coursename,
				"courseId" => $course->id,
				"children" => array_merge($lessonNames, [$commentsNode])
			);
		}, $usersCourses);

		return array(
			"name" => "{$user->username}'s Courses",
			"children" => $courseNodes
		);
	}
}
