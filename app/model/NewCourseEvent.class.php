<?php

// Event subclass for a new course
class NewCourseEvent extends Event {

    public static function deleteByCourse($course) {
		Db::instance()->deleteByProperties(self::DB_TABLE,
            array('eventtypeid' => 1, 'data' => $course->id));
    }

    function __construct($args = array()) {
        $this->eventtypeid = 1;
        parent::__construct($args);
    }

    public function getDescription() {
        $course = Course::loadById($this->data);
        return "{$this->getUser1()->asLink()} created the course {$course->asLink()}";
    }
}
