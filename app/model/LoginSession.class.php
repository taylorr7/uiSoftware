<?php

// A utility class that manages a user's session
class LoginSession
{
    // Starts the session if necessary
    private static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Logs the user in, provided the username and password are correct
    public static function logIn($username, $password)
    {
        // Load the user from the database
        $user = User::loadByCredentials($username, $password);
        if ($user) {
            // Valid credentials
            self::startSession();
            // Store the user in the session, but without the password
            $_SESSION['user'] = $user;
            return true;
        } else {
            // Invalid credentials, login fail
            return false;
        }
    }

    // Gets the current user or null if not logged in
    public static function currentUser()
    {
        self::startSession();
        return self::isLoggedIn() ? $_SESSION['user'] : null;
    }

    // Checks if the user is logged in
    public static function isLoggedIn()
    {
        self::startSession();
        return isset($_SESSION['user']);
    }

    // Logs the user out
    public static function logOut()
    {
        self::startSession();
        session_destroy();
    }
}
