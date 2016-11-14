<?php

class NewLessonEvent extends Event {

    public static function deleteByLesson($lesson) {
		Db::instance()->deleteByProperties(self::DB_TABLE,
            array('eventtypeid' => 3, 'data' => $lesson->id));
    }

    function __construct($args = array()) {
        $this->eventtypeid = 3;
        parent::__construct($args);
    }

    public function getDescription() {
        $lesson = Lesson::loadById($this->data);
        return "{$this->getUser1()->asLink()} created the lesson {$lesson->lessonname}";
    }
}
