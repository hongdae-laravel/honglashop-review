<?php

/**
 * @file Review.php
 * @date 2019-01-29
 */
class Review
{
    private $db;

    public function __construct(DbInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @param Post $post
     * @return null
     */
    public function write(Post $post)
    {
        echo '😎 Review->write()' . PHP_EOL;
        $this->db->insert($post);
    }

    /**
     * @param Post $post
     * @return null
     */
    public function update(Post $post)
    {
        echo '😎 Review->update()' . PHP_EOL;
        $this->db->update($post);
    }

    /**
     * @param Int $id
     * @return null
     */
    public function delete(Int $id)
    {
        echo '😎 Review->delete()' . PHP_EOL;
        $this->db->delete($id);
    }

    /**
     * @param Int $id
     * @return Array $postData
     */
    public function get(Int $id)
    {
        echo '😎 Review->get(' . $id . ')' . PHP_EOL;
        $post = $this->db->select($id);

        $postData = $post->getPostData();

        return $postData;
    }

    /**
     * @param Int $productId
     * @return Array $postList
     */
    public function getList(Int $productId)
    {
        echo '😎 Review->getList()' . PHP_EOL;

        $postList = [];
        $posts = $this->db->getList($productId);
        $i = 0;
        while ($post = $posts->fetchArray()) {
            // print_r($row);
            foreach ($post as $key) {
                $postList[$i]['id'] = $post['id'];
                $postList[$i]['title'] = $post['title'];
                $postList[$i]['title'] = $post['title'];
                $postList[$i]['content'] = $post['content'];
                $postList[$i]['user_id'] = $post['user_id'];
                $postList[$i]['product_id'] = $post['product_id'];
                $postList[$i]['point'] = $post['point'];
            }
            $i++;
        }

        return $postList;
    }
}
