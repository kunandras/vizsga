<?php

class Categories extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('categories/index');
    }
}