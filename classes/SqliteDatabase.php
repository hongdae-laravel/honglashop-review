<?php

class SqliteDatabase implements DbInterface
{

    private $sqlite;

    public function init()
    {
        $this->sqlite = new SQLite3('review.db');

        $isReviewTableExist = $this->sqlite->query('SELECT * FROM sqlite_master WHERE type="table" AND name="review"')->fetchArray();

        if (!$isReviewTableExist) {
            $this->sqlite->query('CREATE TABLE review(id, title, content, user_id, product_id, point)');
            echo 'Table is created.' . PHP_EOL;
        } else {
            echo 'Table alredy exists.' . PHP_EOL;
        }
    }

    public function insert(Post $post)
    {
        $postData = $post->getPostData();

        $sql = 'INSERT INTO '
            . 'review(id, title, content, user_id, product_id, point) '
            . 'VALUES (:id, :title, :content, :userId, :product_id, :point)';
        $stmt = $this->sqlite->prepare($sql);
        $stmt->bindValue(':id', $postData['id']);
        $stmt->bindValue(':title', $postData['title']);
        $stmt->bindValue(':content', $postData['content']);
        $stmt->bindValue(':user_id', $postData['user_id']);
        $stmt->bindValue(':product_id', $postData['product_id']);
        $stmt->bindValue(':point', $postData['point']);

        $stmt->execute();
    }

    public function update(Post $post)
    {
        $postData = $post->getPostData();

        $sql = 'UPDATE review '
            . 'SET title=:title, content=:content, point=:point '
            . 'WHERE id=:id';
        $stmt = $this->sqlite->prepare($sql);
        $stmt->bindValue(':id', $postData['id']);
        $stmt->bindValue(':title', $postData['title']);
        $stmt->bindValue(':content', $postData['content']);
        $stmt->bindValue(':point', $postData['point']);

        $stmt->execute();
    }

    public function delete(Int $id)
    {
        $sql = 'DELETE FROM review WHERE id=:id';
        $stmt = $this->sqlite->prepare($sql);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    public function select(Int $id)
    {
        $sql = 'SELECT * FROM review WHERE id=:id ';
        $stmt = $this->sqlite->prepare($sql);
        $stmt->bindValue(':id', $id);

        $posts = $stmt->execute();

        while ($row = $posts->fetchArray()) {
            $post = new Post([
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'user_id' => $row['user_id'],
                'product_id' => $row['product_id'],
                'point' => $row['point'],
            ]);
        }

        return $post;
    }

    public function getList(Int $productId)
    {
        $query = 'SELECT * FROM review WHERE product_id = ' . $productId;

        return $this->sqlite->query($query);

        $sql = 'SELECT * FROM review WHERE product_id=:product_id';
        $stmt = $this->sqlite->prepare($sql);
        $stmt->bindValue(':product_id', $productId);

        return $stmt->execute();
    }
}
