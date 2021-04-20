<?php

class UserHelper
{
    /**
     * @param string $role
     * @return bool
     */
    public static function isUser(string $role): bool
    {
        if ($role === 'user') {
            return true;
        }
        return false;
    }


}