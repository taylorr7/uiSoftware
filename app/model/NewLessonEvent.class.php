<?php

class NewLessonEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 3;
        parent::__construct($args);
    }

    public function getDescription() {
        $lesson = Lesson::loadById($this->data);
        return "{$this->getUser1()->asLink()} created the lesson {$lesson->lessonname}";
    }
}
