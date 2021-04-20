<?php

class Session
{
    /**
     * @param User $user
     * @return bool
     */
    public static function sessionStart(User $user): bool
    {
        session_regenerate_id();
        $_SESSION['current_user'] = $user->getUsername();
        $_SESSION['id'] = $user->getId();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['login'] = true;
        $_SESSION['last_login'] = time();
        $_SESSION['ip'] = $user->getIp();
        return true;
    }

    public static function userIsLoggedIn()
    {
        if (!isset($_SESSION['current_user'])) {
            header('Location: ' . URLROOT . 'users/index');
        }
    }

    public static function adminIsLoggedIn()
    {
        if ((!isset($_SESSION['role']) && $_SESSION['role']) !== 'admin') {
            header('Location: ' . URLROOT . 'users/index');
        }
    }

    /**
     * @return bool
     */
    public static function loginTime(): bool
    {
        if (!isset($_SESSION['last_login'])) {
            return false;
        }
        if ($_SESSION['last_login'] + (60 * 60 * 24) <= time()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function sessionIsValid(): bool
    {
        if (self::loginTime()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function sessionValidate(): bool
    {
        if (self::sessionIsValid()) {
            return true;
        } else {
            self::sessionEnd();
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function loginInUser(): bool
    {
        return (isset($_SESSION['login']) && $_SESSION['login']);
    }

    /**
     * @return bool
     */
    public static function loginGood(): bool
    {
        if (self::loginInUser()) {
            return true;
        } else {
            self::sessionEnd();
            header('Location: ' . URLROOT . 'users/index');
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function allInternalSite(): bool
    {
        if (!self::loginGood()) {
            self::sessionEnd();
            header('Location: ' . URLROOT . 'users/index');
            return false;
        }
        return true;
    }

    public static function sessionEnd()
    {
        session_unset();
        session_destroy();
        header('Location: ' . URLROOT . 'users/login');
    }
}