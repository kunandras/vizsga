<?php

class Admins extends BaseController
{
    private UserMapper $userMapper;
    private ForumMapper $forumMapper;
    private CategoryMapper $categoryMapper;
    private CommentMapper $commentMapper;

    public function __construct()
    {
        parent::__construct();
        $this->userMapper = new UserMapper(Database::getInstance());
        $this->forumMapper = new ForumMapper(Database::getInstance());
        $this->categoryMapper = new CategoryMapper(Database::getInstance());
        $this->commentMapper = new CommentMapper(Database::getInstance());
        $this->view->setLayout('index');
    }

    public function index()
    {
        $this->view->render('admins', 'index');
    }

    public function users()
    {
        $users = $this->userMapper->getAllUser();
        $this->view->setVariable('users', $users);
        $this->view->render('admins', 'users');
    }

    public function forums()
    {
        $forums = $this->forumMapper->getAllForum();
        $this->view->setVariable('forums', $forums);
        $this->view->render('admins', 'forums');
    }

    public function categories()
    {
        $this->view->render('admins', 'categories');
    }

    public function comments()
    {
        $this->view->render('admins', 'comments');
    }
}