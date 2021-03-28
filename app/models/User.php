<?php

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private string $ip;
    private string $login_date;
    private string $register_date;

    public function __construct() { }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function setId(int $id): void
    {
        $id = is_int($id);
        if (!$id) {
            throw new Exception('Nem megfelelő ID formátum.');
        }
        if (empty($id)) {
            throw new Exception('Nincs megadva ID.');
        }
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
     * @throws Exception
     */
    public function setUsername(string $username): void
    {
        $username = htmlspecialchars(strip_tags($username));
        if (empty($username)) {
            throw new Exception('Írd be a felhasználónevedet.');
        }
        if (mb_strlen($username) <= 4) {
            throw new Exception('Felhasználónévnek minimum 4 karakternek kell lennie.');
        }
        if (mb_strlen($username) >= 35) {
            throw new Exception('Felhasználónév maximum 35 karakternek lehet.');
        }
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
     * @throws Exception
     */
    public function setEmail(string $email): void
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (empty($email)) {
            throw new Exception('Írd be az e-mail címedet.');
        }
        if (!$email) {
            throw new Exception('Nem megfelelő e-mail cím formátum.');
        }
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
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $password = htmlspecialchars(strip_tags($password));
        $password = password_hash($password, PASSWORD_DEFAULT);
        if (empty($password)) {
            throw new Exception('Írd be a jelszavad.');
        }
        if (mb_strlen($password) <= 4) {
            throw new Exception('Jelszónak minimum 4 karakternek kell lennie.');
        }
        if (mb_strlen($password) >= 35) {
            throw new Exception('Jelszó maximum 35 karakternek lehet.');
        }
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
}