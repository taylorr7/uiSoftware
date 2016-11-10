<?php

include_once '../global.php';

/*
 * Get action to route to.
 */
$action = $_GET['action'];

$lc = new LessonController();
$lc->checkLoginStatus();
$lc->route($action);

/*
 * Class to control lesson.
 */
class LessonController {
	/*
	 * Send not logged in user to login page.
	 */
	public function checkLoginStatus() {
		if (!LoginSession::isLoggedIn()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	/*
	 * Route to appropriate function.
	 */
	public function route($action) {
		switch($action) {
			case 'personalLessons': $this->personalLessons();	break;

      case 'newLesson': $this->newLesson(); break;

      case 'editLesson':
				$lid = $_GET['lid'];
				$this->editLesson($lid);
				break;

			case 'deleteLesson':
				$lid = $_GET['lid'];
				$this->deleteLesson($lid);
				break;

      case 'processLesson':
          $lid = isset($_GET['lid']) ? $_GET['lid'] : null;
          $lname = htmlspecialchars($_POST['lname']);
          $lcontent = htmlspecialchars($_POST['content']);
          $this->processLesson($lid, $lname, $lcontent);
          break;

			default: header('Location: '.BASE_URL);	exit();
		}
	}

	/*
	 * Function to access personal lessons.
	 */
	public function personalLessons() {
		$user = LoginSession::currentUser();
		$lessons = Lesson::loadByUser($user);

		$pageName = 'Personal Lessons';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/lessons.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

  /*
	 * Function to create a new lesson.
	 */
	public function newLesson() {
		$user = LoginSession::currentUser();
		$lesson = new Lesson();

		$pageName = 'New Lesson';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editlesson.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to edit a lesson.
	 */
	public function editLesson($lid) {
		$user = LoginSession::currentUser();
		$lesson = Lesson::loadById($lid);
        if ($lesson->userid != $user->id) {
            // User does not own lesson to edit
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }

		$pageName = 'Edit Lesson';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editlesson.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
  }

	/*
	 * Function to delete a lesson.
	 */
	public function deleteLesson($lid) {
		Db::deleteById("lessons", $lid);
		header('Location: ' . BASE_URL . '/lessons');
	}

	/*
	 * Function to process edit lesson.
	 */
	public function processLesson($lid, $lessonname, $content) {
		$user = LoginSession::currentUser();
		if ($lid) {
			$lesson = Lesson::loadById($lid);
			if ($lesson->userid != $user->id) {
				// User does not own lesson to edit
				header("HTTP/1.1 403 Forbidden" );
				exit();
			}
		} else {
			$lesson = new Lesson();
		}
		$lesson->lessonname = $lessonname;
		$lesson->content = $content;
		$lesson->userid = $user->id;
		$lesson->save();

		$event = $lid ? new EditLessonEvent() : new NewLessonEvent();
		$event->user1id = $user->id;
		$event->data = $lesson->id;
		$event->save();

		header('Location: ' . BASE_URL . '/lessons/personal');
	}
}
