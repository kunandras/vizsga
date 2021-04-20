<?php

class Time
{
    public static function countdown($date): bool
    {
        $currentDate = strtotime($date);
        $futureDate = $currentDate + (60 * 1);
        $formatDate = date('Y-m-d H:i:s', $futureDate);
        if ($formatDate <= date('Y-m-d H:i:s')) {
            return false;
        }
        return true;
    }
}