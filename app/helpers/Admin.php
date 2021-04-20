<?php

class Admin
{
    /**
     * @param string $role
     * @return bool
     */
    public static function isAdmin(string $role): bool
    {
        if ($role === 'admin') {
            return true;
        }
        return false;
    }
}