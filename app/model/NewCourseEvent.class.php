<?php

class NewCourseEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 1;
        parent::__construct($args);
    }

    public function getDescription() {
        $course = Course::loadById($this->data);
        return "{$this->getUser1()->asLink()} created the course {$course->asLink()}";
    }
}
