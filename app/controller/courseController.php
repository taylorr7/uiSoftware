<?php

include_once '../global.php';

/*
 * Get action to route to.
 */
$action = $_GET['action'];

$cc = new CourseController();
$cc->checkLoginStatus();
$cc->route($action);

/*
 * Class to control courses.
 */
class CourseController {
	/*
	 * Send not logged in user to login page.
	 */
	public function checkLoginStatus() {
		if (!LoginSession::currentUser()->canViewSite()) {
			header('Location: ' . BASE_URL . '/login');
			exit();
		}
	}

	/*
	 * Route to appropriate function
	 */
	public function route($action) {
		switch($action) {
			case 'courses': $this->courses(); break;

			case 'personalCourses': $this->personalCourses(); break;

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

			case 'deleteCourse':
				$cid = $_GET['cid'];
				$this->deleteCourse($cid);
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

			case 'comment':
				$cid = $_GET['cid'];
				$content = $_GET['content'];
				$this->comment($cid, $content);
				break;
				
			case 'edComment':
				$cid = $_GET['cid'];
				$content = $_GET['content'];
				$this->edComment($cid, $content);
				break;
			
			case 'delComment':
				$cid = $_GET['cid'];
				$this->delComment($cid);
				break;
		}
	}

	/*
	 * Function to view courses
	 */
	public function courses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadAll(!$user->isAdmin());
		$pageName = 'Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	/*
	 * Function to view personal courses.
	 */
	public function personalCourses() {
		$user = LoginSession::currentUser();
		$courses = Course::loadByUser($user);
		$pageName = 'Personal Courses';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/courses.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

  /*
	 * Function to view courses.
	 */
  public function viewCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
    if (!$user->canViewCourse($course)) {
      header("HTTP/1.1 403 Forbidden" );
      exit();
    }

		$pageName = 'Course Info';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/coursepage.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

  /*
	 * Function to load course.
	 */
  public function loadCourse($cid, $lid) {
	$user = LoginSession::currentUser();
	 $course = Course::loadById($cid);
	 if (!$user->canViewCourse($course)) {
	   header("HTTP/1.1 403 Forbidden" );
	   exit();
	 }
		$toc = $course->coursecontent;
		if ($lid == "null") {
			$content = null;
			$comments = null;
		} else if ($lid == "home") {
			$content = "Welcome to {$course->coursename}!";
			$comments = null;
		} else if ($lid == "comment") {
			$content = "Comments";
			$results = Comment::loadByCourse($cid);
			if(count($results) == 0 ){
				$comments = null;
			} else {
				$comments = array();
				for($i = 0; $i < count($results); $i++) {
					$commenter = User::loadById($results[$i]->commenterid);
					$commenterName = $commenter->username;
					$commenterUrl = $commenter->getProfileUrl();
					array_push($comments, array('commenterName' => $commenterName, 'content' => $results[$i]->content, 'url' => $commenterUrl, 'timestamp' => $results[$i]->getPrettyDate()));
				}
			}
		} else {
			$content = Lesson::loadByName($lid)->content;
			$comments = null;
		}

		$json = array('toc' => $toc, 'content' => $content, 'comments' => $comments);
		header('Content-Type: application/json');
		echo json_encode($json);
	}

  /*
	 * Function to create new course.
	 */
	public function newCourse() {
		$user = LoginSession::currentUser();
		$course = new Course();
		$lessonArray = Lesson::loadByUser($user);
		$lessonList = array_map(function($l) {
			return $l->lessonname;
		}, $lessonArray);
		$pageName = 'New Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

  /*
	 * Function to edit course.
	 */
	public function editCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
    if (!$user->canModifyCourse($course)) {
      // User does not own course to edit
      header("HTTP/1.1 403 Forbidden" );
      exit();
    }
		$lessonArray = Lesson::loadByUser($user);
		$lessonList = array_map(function($l) {
			return $l->lessonname;
		}, $lessonArray);

		$pageName = 'Edit Course';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/editcourse.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
  }

	/*
	 * Function to delete course.
	 */
	public function deleteCourse($cid) {
		$user = LoginSession::currentUser();
		$course = Course::loadById($cid);
		if (!$user->canModifyCourse($course)) {
		  // User does not own course to delete
		  header("HTTP/1.1 403 Forbidden" );
		  exit();
		}
		$course->delete();
		header('Location: ' . BASE_URL . '/courses');
	}

	/*
	 * Function to process course.
	 */
  public function processCourse($cid, $coursename, $coursedescription, $coursecontent) {
	$user = LoginSession::currentUser();
	if ($cid) {
		$course = Course::loadById($cid);
	    if (!$user->canModifyCourse($course)) {
	      // User does not own course to edit
	      header("HTTP/1.1 403 Forbidden" );
	      exit();
	    }
	} else {
		$course = new Course();
		$course->published = false;
	}
	$course->userid = $user->id;
    $course->coursename = $coursename;
    $course->coursedescription = $coursedescription;
    $course->coursecontent = $coursecontent;
	$course->save();

	$event = $cid ? new EditCourseEvent() : new NewCourseEvent();
	$event->user1id = $user->id;
	$event->data = $course->id;
	$event->save();

	header('Location: ' . BASE_URL . '/courses/personal');
  }

	/*
	 * Function to publish course.
	 */
	public function publish($cid, $check) {
    $user = LoginSession::currentUser();
		$course = Course::loadById($cid);
    if (!$user->canModifyCourse($course)) {
      // User does not own course to edit
      header("HTTP/1.1 403 Forbidden" );
      exit();
    }
		if ($check == 'false') {
			if ($course->published == 0) {
				$course->update(array('published' => 1));
				$course->save();
				$json = array('status' => 'published');
			} else {
				$course->update(array('published' => 0));
				$course->save();
				$json = array('status' => 'unpublished');
			}
		} else {
			if ($course->published == 0) {
				$json = array('status' => 'unpublished');
			} else {
				$json = array('status' => 'published');
			}
		}
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	/*
	 * Function to comment on a course.
	 */
	public function comment($cid, $content) {
		$user = LoginSession::currentUser();
		$newComment = new Comment();
		$newComment->courseid = $cid;
		$newComment->commenterid = $user->id;
		$newComment->content = $content;
		$newComment->save();

		$course = Course::loadById($cid);
		$event = new CourseCommentEvent();
		$event->user1id = $user->id;
		$event->user2id = $course->userid;
		$event->data = $newComment->id;
		$event->save();

		$json = array('status' => 'Success');
		header('Content-Type: application/json');
		echo json_encode($json);
	}
	
	/*
	 * Function to edit a comment on a course.
	 */
	public function edComment($cid, $content) {
		$user = LoginSession::currentUser();
		$comment = Comment::loadById($cid);
		if($user->id != $comment->commenterid) {
			header("HTTP/1.1 403 Forbidden" );
			exit();
		}
		
		$comment->content = $content;
		$comment->save();
		
		$json = array('status' => 'Success');
		header('Content-Type: application/json');
		echo json_encode($json);
	}
	
	/*
	 * Function to delete a comment on a course.
	 */
	public function delComment($cid) {
		$user = LoginSession::currentUser();
		$comment = Comment::loadById($cid);
		$commentEvent = CourseCommentEvent::loadByCommentId($cid);
		if($user->id != $comment->commenterid) {
			header("HTTP/1.1 403 Forbidden" );
			exit();
		}
		
		$comment->delete();
		$commentEvent->delete();

		$json = array('status' => 'Success');
		header('Content-Type: application/json');
		echo json_encode($json);
	}
}
