<?php

class EditCourseEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 2;
        parent::__construct($args);
    }

    public function getDescription() {
        $course = Course::loadById($this->data);
        return "{$this->getUser1()->asLink()} edited the course {$course->asLink()}";
    }
}
