<?php

// Event subclass for a lesson edit
class EditLessonEvent extends Event {

    public static function deleteByLesson($lesson) {
		Db::instance()->deleteByProperties(self::DB_TABLE,
            array('eventtypeid' => 4, 'data' => $lesson->id));
    }

    function __construct($args = array()) {
        $this->eventtypeid = 4;
        parent::__construct($args);
    }

    public function getDescription() {
        $lesson = Lesson::loadById($this->data);
        return "{$this->getUser1()->asLink()} edited the lesson {$lesson->lessonname}";
    }
}
