<?php

class EditLessonEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 4;
        parent::__construct($args);
    }

    public function getDescription() {
        $lesson = Lesson::loadById($this->data);
        return "{$this->getUser1()->asLink()} edited the lesson {$lesson->lessonname}";
    }
}
