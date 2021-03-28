<?php

class UserMapper
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     *
     * @param int $id
     * @return User|null
     */
    public function getUser(int $id): ?User
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `password`, `email`, `role`, `ip`, `login_date`, `register_date` FROM `users` WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user !== null) {
            return new User();
        }
        return null;
    }

    /**
     *
     * @return array
     * @throws Exception
     */
    public function getAllUser(): array
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `email`, `login_date`, `register_date` FROM `users`');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
        foreach ($results as $result) {
            $user = new User();
            $user->setId($result['id']);
            $user->setUsername($result['username']);
            $user->setEmail($result['email']);
            $user->setLoginDate($result['login_date']);
            $user->setRegisterDate($result['register_date']);
            $users[] = $user;
        }
        return $users;
    }

    /**
     *
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $query = $this->db->prepare('INSERT INTO users (`username`, `email`, `password`, `ip`) VALUES (:username, :email, :password, :ip)');
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        $query = $this->db->prepare('SELECT `id` FROM `users` WHERE `username` = :username AND `password` = :password');
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function userIsValid(string $username, string $password): bool
    {
        $query = $this->db->prepare('SELECT COUNT(`username`) FROM users WHERE username = :username AND password = :password');
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function existsUsername(string $username): bool
    {
        $query = $this->db->prepare('SELECT COUNT(`username`) FROM `users` WHERE `username` = :username');
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function existsEmail(string $email): bool
    {
        $query = $this->db->prepare('SELECT COUNT(`email`) FROM `users` WHERE `email` = :email');
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateIp(int $id): bool
    {
        $query = $this->db->prepare('UPDATE users SET ip = :ip WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        if ($query->execute()) {
            return true;
        }
        return false;
    }
}