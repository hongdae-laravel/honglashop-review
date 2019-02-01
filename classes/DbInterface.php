<?php

interface DbInterface
{
    public function insert(Post $post);
    public function update(Post $post);
    public function delete(Int $id);
    public function select(Int $id);
    public function getList(Int $productId);
}
