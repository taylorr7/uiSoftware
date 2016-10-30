<?php

  class Session {

    public static function start() {
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
    }

    public static function redirect() {
    	Session::start();
    	if (!isset($_SESSION['username'])) {
    		header('Location: '.BASE_URL.'/login');
    		exit();
    	}
    }
  }

?>
