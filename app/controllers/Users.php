<?php

class Users extends Controller
{
    private UserMapper $userMapper;

    public function __construct()
    {
        $this->userMapper = new UserMapper(Database::getInstance());
    }

    public function index()
    {
        $this->view('users/index');
    }

    /**
     * @throws Exception
     */
    public function register()
    {
        $datas = [
            'username' => '',
            'usernameError' => '',
            'email' => '',
            'emailError' => '',
            'password' => '',
            'passwordError' => '',
            'success' => ''
        ];
        $registerUserData = filter_input(INPUT_POST, 'register_user', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($registerUserData)) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_SPECIAL_CHARS);
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            try {
                $datas = $this->validateRegister($user);
                if (!$this->userMapper->getByUsername($username) && !$this->userMapper->getByEmail($email)) {
                    $this->userMapper->save($user);
                }
            } catch (Exception $e) {
                throw new Exception('Sikertelen regisztráció: ' . $e->getMessage());
            }
        }
        $this->view('users/register', $datas);
    }

    public function login()
    {
        $datas = [
            'username' => '',
            'usernameError' => '',
            'password' => '',
            'passwordError' => '',
            'success' => ''
        ];
        $loginUserData = filter_input(INPUT_POST, 'login_user', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($loginUserData)) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            if ($this->userMapper->getByUsernameAndPassword($username, $password)) {
                $this->view('forums/index');
            }
        }
        $this->view('users/login', $datas);
    }

    /**
     * @param User $user
     * @return array
     */
    private function validateRegister(User $user): array
    {
        $errors = [];
        if (empty($errors['username']) && empty($errors['email']) && empty($errors['password']) && empty($errors['repassword'])) {
            $errors['usernameError'] = 'Minden mező kitöltése kötelező.';
        }
        if (empty($errors['username'])) {
            $errors['usernameError'] = 'Add meg a felhasználóneved.';
        }
        if (empty($errors['email'])) {
            $errors['emailError'] = 'Add meg az e-mail címed.';
        }
        if (empty($errors['password']) || empty($errors['repassword'])) {
            $errors['passwordError'] = 'Add meg a jelszavad.';
        }
        return $errors;
    }
}
