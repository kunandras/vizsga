<?php

class User
{
    private int $id;
    public string $username;
    private string $email;
    private string $password;
    private string $role;
    private string $ip;
    private string $login_date;
    private string $register_date;

    /**
     * User constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $username = '', string $email = '', string $password = '')
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getLoginDate(): string
    {
        return $this->login_date;
    }

    /**
     * @param string $login_date
     */
    public function setLoginDate(string $login_date): void
    {
        $this->login_date = $login_date;
    }

    /**
     * @return string
     */
    public function getRegisterDate(): string
    {
        return $this->register_date;
    }

    /**
     * @param string $register_date
     */
    public function setRegisterDate(string $register_date): void
    {
        $this->register_date = $register_date;
    }

    public function checkRegister(): void
    {
        $errors = array();
        if (empty($this->username)) {
            $errors['username'] = 'Felhasználónév nem maradhat üresen.';
        }
        if (mb_strlen(trim($this->username)) < 3) {
            $errors['username'] = 'Felhasználónév minimum 3, maximum 25 betű lehet.';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Érvénytelen e-mail cím formátum.';
        }
        if (mb_strlen(trim($this->password)) < 3) {
            $errors['password'] = 'Jelszónak minimum 3 karakternek kell lennie.';
        }
        if (!empty($errors)) {
            throw new ValidException($errors, 'Sikertelen regisztráció.');
        }
    }

    public function checkUpdate()
    {
        $errors = array();
        if (empty($this->username)) {
            $errors['username'] = 'Felhasználónév nem maradhat üresen.';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Érvénytelen e-mail cím formátum.';
        }
        if (!empty($errors)) {
            throw new ValidException($errors, 'Sikertelen regisztráció.');
        }
    }
}