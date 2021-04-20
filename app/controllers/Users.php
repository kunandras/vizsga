<?php

class Users extends BaseController
{
    private UserMapper $userMapper;

    public function __construct()
    {
        parent::__construct();
        $this->userMapper = new UserMapper(Database::getInstance());
        $this->view->setLayout('index');
    }

    public function index()
    {
        $this->view->render('users', 'index');
    }

    public function login()
    {
        $loginData = filter_input(INPUT_POST, 'login_user', FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($loginData)) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $user = $this->userMapper->getUser($username);
            if ($this->userMapper->getByUsernameAndPassword($username, $password)) {
                Session::sessionStart($user);
                $this->userMapper->updateLogin($username);
                $this->userMapper->updateIp($username);
                $this->view->redirect('forums', 'index', '');
            } else {
                $errors = array();
                $errors['base'] = 'Helytelen felhasználónév vagy jelszó.';
                $this->view->setVariable('errors', $errors);
            }
        }
        $this->view->render('users', 'login');
    }

    /**
     * @throws Exception
     */
    public function register()
    {
        $registerUserData = filter_input(INPUT_POST, 'register_user', FILTER_SANITIZE_SPECIAL_CHARS);
        $user = new User();
        if (isset($registerUserData)) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            try {
                $user->checkRegister();
                if (!$this->userMapper->getByUsernameOrEmail($username, $email)) {
                    $this->userMapper->save($user);
                    $this->view->setFlash('Sikeres regisztráció, kérjük jelentkezzen be.');
                    $this->view->redirect('users', 'login', '');
                    throw new Exception('Ezzel a felhasználónévvel vagy e-mail címmel már regisztráltak.');
                } else {
                    $errors = array();
                    $errors['base'] = 'Ezzel a felhasználónévvel vagy e-mail címmel már regisztráltak.';
                    $this->view->setVariable('errors', $errors);
                }
            } catch (ValidException $e) {
                $this->view->setVariable('errors', $e->getErrors());
            }
        }
        $this->view->setVariable('user', $user);
        $this->view->render('users', 'register');
    }

    public function profile($id)
    {
        $userid = $_SESSION['id'];
        if (!$this->currentUser) {
            $this->view->redirect('users', 'index', '');
        }

        $updateProfileData = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_SPECIAL_CHARS);
        $user = new User();
        if (isset($updateProfileData)) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $user->setUsername($username);
            $user->setEmail($email);
            try {
                echo 1;
                $user->checkUpdate();
                if (!$this->userMapper->getByUsername($username) && !$this->userMapper->getByEmail($email)) {
                    $this->userMapper->update($username, $email, $userid);
                    $this->view->setFlash('Sikeres profil módosítás.');
                    $this->view->redirect('users', 'profile', $id);
               } else {
                    $errors = array();
                    $errors['base'] = 'Ez a felhasználónév vagy e-mail cím már létezik a rendszerben.';
                    $this->view->setVariable('errors', $errors);
                }
            } catch (ValidException $e) {
                $this->view->setVariable('errors', $e->getErrors());
            }
        }
        $this->view->setVariable('id', $id);
        $this->view->render('users', 'profile');
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        $this->view->redirect('users', 'login', '');
    }
}