<?php

class CategoryMapper
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function getFiveForumWithId(): array
    {
        $query = $this->db->prepare('SELECT title FROM categories');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();
        foreach ($results as $result) {
            $category = new Category();
            $category->setTitle($result['title']);
            $categories[] = $category;
        }
        return $categories;
    }

    /**
     * @param int $forumId
     * @return array
     */
    public function getAllCategoryWithForumId(int $forumId): array
    {
        $query = $this->db->prepare('SELECT `id`, `title`, `body`, `created_at`, `updated_at`, `author`, `forum_id` FROM `categories` WHERE `forum_id` = :id');
        $query->execute(array(':id' => $forumId));
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();
        foreach ($results as $result) {
            $category = new Category();
            $category->setId($result['id']);
            $category->setTitle($result['title']);
            $category->setBody($result['body']);
            $category->setCreatedAt($result['created_at']);
            $category->setUpdatedAt($result['updated_at']);
            $category->setAuthor($result['author']);
            $category->setForumId($result['forum_id']);
            $categories[] = $category;
        }
        return $categories;
    }
}