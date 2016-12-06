<?php
// Event subclass for a course comment
class CourseCommentEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 5;
        parent::__construct($args);
    }

    public function getDescription() {
        $user1Link = $this->getUser1()->asLink();
        $user2Link = $this->getUser2()->asLink();
        $comment = Comment::loadById($this->data);
        $courseLink = $comment->getCourse()->asLink();
        return <<<HTML
{$user1Link} commented on {$user2Link}'s course {$courseLink}:
<blockquote>
    {$comment->content}
</blockquote>
HTML;
    }
	
	// Static helper function that loads course comment event by comment id
	public static function loadByCommentId($cid) {
		$props = array('eventtypeid' => 5, 'data' => $cid);
		$results = Db::instance()->selectByProperties(self::DB_TABLE, $props, __CLASS__);
		$numResults = count($results);
		if ($numResults != 1) {
			die("Found {$numResults} events with comment id {$cid}");
		}
		return $results[0];
	}
}