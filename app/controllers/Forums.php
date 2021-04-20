<?php

class Forums extends BaseController
{
    private UserMapper $userMapper;
    private ForumMapper $forumMapper;
    private CategoryMapper $categoryMapper;

    public function __construct()
    {
        parent::__construct();
        $this->userMapper = new UserMapper(Database::getInstance());
        $this->forumMapper = new ForumMapper(Database::getInstance());
        $this->categoryMapper = new CategoryMapper(Database::getInstance());
        $this->view->setLayout('index');
    }

    public function index()
    {
        //Session::userIsLoggedIn();
        $currentUser = $_SESSION['current_user'];
        $forums = $this->forumMapper->getAllForum();
        $forumCount = $this->forumMapper->getAllForumCount();
        $user = $this->userMapper->getUser($currentUser);
        $this->view->setVariable('forums', $forums);
        $this->view->setVariable('forumCount', $forumCount);
        $this->view->setVariable('user', $user);
        $this->view->render('forums', 'index');
    }

    public function create()
    {
        Session::userIsLoggedIn();
        if (!isset($this->currentUser)) {
            $this->view->redirect('forums', 'index', '');
        }
        $currentUser = $_SESSION['current_user'];
        $forumData = filter_input(INPUT_POST, 'create_forum', FILTER_SANITIZE_SPECIAL_CHARS);
        $forum = new Forum();
        if (isset($forumData)) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
            $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
            $forum->setTitle($title);
            $forum->setBody($body);
            $forum->setAuthor($currentUser);
            try {
                $forum->checkForum();
                $this->forumMapper->save($forum);
                $this->view->setFlash('A fórum sikeresen elkészült.');
                $this->view->redirect('forums', 'index', '');
            } catch (ValidException $e) {
                $this->view->setVariable('errors', $e->getErrors());
            }
        }
        $this->view->setVariable('forum', $forum);
        $this->view->setVariable('currentUser', $currentUser);
        $this->view->render('forums', 'create');
    }

    public function delete($forumId)
    {
        Session::userIsLoggedIn();
        if (!isset($forumId)) {
            $this->view->redirect('users', 'login', '');
        }
        $forumData = filter_input(INPUT_POST, 'delete_forum', FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($forumData)) {
            $this->forumMapper->delete($forumId);
        }
        $this->view->redirect('forums', 'index', '');
    }

    public function update($forumId)
    {
        Session::userIsLoggedIn();
        if (!isset($this->currentUser)) {
            $this->view->redirect('forums', 'index', '');
        }
        if (!isset($forumId)) {
            $this->view->redirect('forums', 'index', '');
        }
        $forumData = filter_input(INPUT_POST, 'update_forum', FILTER_SANITIZE_SPECIAL_CHARS);
        $forum = new Forum();
        if (isset($forumData)) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
            $forum->setTitle($title);
            $forum->setBody($body);
            try {
                $forum->checkForum();
                $this->forumMapper->save($forum);
                $this->view->setFlash('A fórum sikeresen elkészült.');
                $this->view->redirect('forums', 'index', '');
            } catch (ValidException $e) {
                $this->view->setVariable('errors', $e->getErrors());
            }
        }
        $this->view->setVariable('forum', $forum);
        $this->view->render('forums', 'update');
    }

    public function category($forumId)
    {
        Session::userIsLoggedIn();
        if (!isset($forumId)) {
            $this->view->redirect('users', 'login', '');
        }
        $currentUser = $_SESSION['current_user'];
        $categories = $this->categoryMapper->getAllCategoryWithForumId($forumId);
        $user = $this->userMapper->getUser($currentUser);
        $this->view->setVariable('categories', $categories);
        $this->view->setVariable('user', $user);
        $this->view->setVariable('forumId', $forumId);
        $this->view->render('forums', 'category');
    }
}