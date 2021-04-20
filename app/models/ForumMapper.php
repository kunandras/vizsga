<?php

class ForumMapper
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function getAllForum(): array
    {
        $query = $this->db->prepare('SELECT `id`, `title`, `body`, `created_at`, `updated_at`, `author` FROM `forums` ORDER BY `created_at` DESC');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $forums = array();
        foreach ($results as $result) {
            $forum = new Forum();
            $forum->setId($result['id']);
            $forum->setTitle($result['title']);
            $forum->setBody($result['body']);
            $forum->setCreatedAt($result['created_at']);
            $forum->setUpdatedAt($result['updated_at']);
            $forum->setAuthor($result['author']);
            $forums[] = $forum;
        }
        return $forums;
    }

    public function getAllForumCount(): int
    {
        $query = $this->db->prepare('SELECT * FROM `forums`');
        $query->execute();
        return $query->rowCount();
    }

    /**
     * @param Forum $forum
     * @return bool
     */
    public function save(Forum $forum): bool
    {
        $title = $forum->getTitle();
        $body = $forum->getBody();
        $author = $forum->getAuthor();
        $query = $this->db->prepare('INSERT INTO `forums` (`title`, `body`, `author`) VALUES (:title, :body, :author)');
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':body', $body, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    public function update(int $id)
    {
        $query = $this->db->prepare('UPDATE `forums` SET `title`, `body`, `updated_at` WHERE id = :id');
        $query->execute(array(':id' => $id));
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->db->prepare('DELETE FROM forums WHERE id = :id');
        $query->execute(array(':id' => $id));
    }

    /**
     * @param string $title
     * @return bool
     */
    public function getForumByTitle(string $title): bool
    {
        $query = $this->db->prepare('SELECT COUNT(`title`) FROM `forum` WHERE `title` = :title');
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return true;
        }
        return false;
    }
}