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
}
