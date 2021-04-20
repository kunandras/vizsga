<?php

class CommentMapper
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}