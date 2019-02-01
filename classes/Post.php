<?php

class Post
{
    private $postData = [];

    public function __construct(array $arr = null)
    {
        $this->postData = [
            'id' => $arr['id'],
            'title' => $arr['title'],
            'content' => $arr['content'],
            'user_id' => $arr['user_id'],
            'product_id' => $arr['product_id'],
            'point' => $arr['point'],
        ];
    }

    public function productId(Int $productId)
    {
        $this->postData['product_id'] = $productId;

        return $this;
    }

    public function userId(Int $userId)
    {
        $this->postData['user_id'] = $userId;

        return $this;
    }

    public function id(Int $id)
    {
        $this->postData['id'] = $id;

        return $this;
    }

    public function title(String $title)
    {
        $this->postData['title'] = $title;

        return $this;
    }

    public function content(String $content)
    {
        $this->postData['content'] = $content;

        return $this;
    }

    public function point(Int $point)
    {
        $this->postData['point'] = $point;

        return $this;
    }


    public function getPostData()
    {
        return $this->postData;
    }
}
