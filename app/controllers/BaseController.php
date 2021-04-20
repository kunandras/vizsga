<?php

class BaseController
{
    /**
     * @var string|View
     */
    protected $view;
    protected $currentUser;

    public function __construct()
    {
        $this->view = View::getInstance();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['current_user'])) {
            $this->currentUser = new User();
            $this->view->setVariable('currentUser', $this->currentUser->getUsername());
        }
    }
}