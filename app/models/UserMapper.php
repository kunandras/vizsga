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
     * @return array
     * @throws Exception
     */
    public function getUser(int $id): array
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `email`, `password`, `role`, `login_date`, `register_date`, `ip` FROM `users` WHERE `id` = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $aUser = array();
        if ($result !== null) {
            $user = new User();
            $user->setId($result['id']);
            $user->setUsername($result['username']);
            $user->setEmail($result['email']);
            $user->setPassword($result['password']);
            $user->setRole($result['role']);
            $user->setLoginDate($result['login_date']);
            $user->setRegisterDate($result['register_date']);
            $user->setIp($result['ip']);
            $aUser[] = $user;
        }
        return $aUser;
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
    public function save(User $user): bool
    {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $password = self::passwordHash($password);

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
    public function getByUsernameAndPassword(string $username, string $password): bool
    {
        $query = $this->db->prepare('SELECT COUNT(`username`) FROM `users` WHERE `username` = :username AND `password` = :password');
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
    public function getByUsername(string $username): bool
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
    public function getByEmail(string $email): bool
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
        $query = $this->db->prepare('UPDATE `users` SET `ip` = :ip WHERE `id` = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $password
     * @return string
     */
    private function passwordHash(string $password): string
    {
        $salt = 'x$-ĐÍ^?á?Gds(+';
        for ($i = 0; $i < 1234; $i++) {
            $password = md5(sha1($password . $salt) . $salt);
        }
        return $password;
    }
}
