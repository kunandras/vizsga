<?php

class Topics extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('topics/index');
    }
}