<?php

include_once '../global.php';

$action = $_GET['action'];

$cc = new CourseController();
$cc->checkLoginStatus();
$cc->route($action);

class CourseController {
	public function checkLoginStatus() {
		if (!LoginSession::isLoggedIn()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	public function route($action) {
		switch($action) {
			case 'courses':
                $this->courses();
                break;

			case 'personalCourses':
				$this->personalCourses();
				break;

            case 'viewCourse':
                $cid = $_GET['cid'];
                $this->viewCourse($cid);
                break;

            case 'loadCourse':
				$cid = $_GET['cid'];
				$lid = $_GET['lid'];
				$this->loadCourse($cid,$lid);
				break;

            case 'newCourse':
                $this->newCourse();
                break;

            case 'editCourse':
                $cid = $_GET['cid'];
                $this->editCourse($cid);
                break;

            case 'processCourse':
                $cid = isset($_GET['cid']) ? $_GET['cid'] : null;
                $cname = htmlspecialchars($_POST['cname']);
                $cdescription = htmlspecialchars($_POST['cdescription']);
                $ccontent = htmlspecialchars($_POST['ccontent']);
                $this->processCourse($cid, $cname, $cdescription, $ccontent);
                break;

			case 'publish':
				$id = $_POST['name'];
				$check = $_POST['check'];
				$this->publish($id, $check);
				break;
		}
	}

	public function courses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadPublished();
		$pageName = 'Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function personalCourses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadByUser($user);
		$pageName = 'Personal Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

    public function viewCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
        if (!$course->published && $course->userid != $user->id) {
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }

		$pageName = 'Course Info';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/coursepage.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

    public function loadCourse($cid, $lid) {
		$course = Course::loadById($cid);
		$toc = $course->coursecontent;
		if($lid == "null") {
			$content = null;
		} else if($lid == "home") {
			$content = "Welcome to {$course->coursename}!";
		} else {
			$content = Lesson::loadByName($lid)->content;
		}

		$json = array('toc' => $toc, 'content' => $content);
		header('Content-Type: application/json');
		echo json_encode($json);
	}


	public function newCourse() {
		$user = LoginSession::currentUser();
		$course = new Course();
		$lessonArray = Lesson::loadByUser($user);
		$lessonList = array();
		for($i = 0; $i < count($lessonArray); $i++) {
			array_push($lessonList, $lessonArray[$i]->lessonname);
		}
		$pageName = 'New Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function editCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
        if ($course->userid != $user->id) {
            // User does not own course to edit
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }
		$lessonArray = Lesson::loadByUser($user);
		$lessonList = array();
		for($i = 0; $i < count($lessonArray); $i++) {
			array_push($lessonList, $lessonArray[$i]->lessonname);
		}
		$pageName = 'Edit Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
    }

    public function processCourse($cid, $coursename, $coursedescription, $coursecontent) {
		$user = LoginSession::currentUser();
		if (is_null($cid)) {
			$course = new Course();
		} else {
			$course = Course::loadById($cid);
			if ($course->userid != $user->id) {
	            // User does not own course to edit
	            header("HTTP/1.1 403 Forbidden" );
	            exit();
	        }
		}
        $course->coursename = $coursename;
        $course->coursedescription = $coursedescription;
        $course->coursecontent = $coursecontent;
        $course->save();
		header('Location: ' . BASE_URL . '/courses/personal');
    }

	public function publish($cid, $check) {
        $user = LoginSession::currentUser();
		$course = Course::loadById($cid);
        if ($course->userid != $user->id) {
            // User does not own course to edit
            header("HTTP/1.1 403 Forbidden" );
            exit();
        }
		if($check == 'false') {
			if($course->published == 0) {
				$course->update(array('published' => 1));
				$course->save();
				$json = array('status' => 'published');
			} else {
				$course->update(array('published' => 0));
				$course->save();
				$json = array('status' => 'unpublished');
			}
		} else {
			if($course->published == 0) {
				$json = array('status' => 'unpublished');
			} else {
				$json = array('status' => 'published');
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
