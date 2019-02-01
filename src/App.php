<?php
require 'vendor/autoload.php';

$db = new SqliteDatabase();
$db->init();
$review = new Review($db);

$post = new Post();
$post->productId(123)->userId(999);

$post2 = clone $post;

$post->id(1)->title('Lorem')->content('Foo bar baz qux')->point(100);
$post2->id(2)->title('Lorem2')->content('Foo bar baz qux2')->point(40);

$review->write($post);
$review->write($post2);

$selectedReview = $review->get(1);

print_r($selectedReview);

$post3 = new Post([
    'id' => 1,
    'title' => 'Loremmmmmmm~~',
    'content' => 'Foo bar baz quxxxxxxx~~',
    'user_id' => 999,
    'product_id' => 123,
    'point' => 20,
]);

$review->update($post3);
$selectedReviewList = $review->getList(123);

print_r($selectedReviewList);

$review->delete(1);

$selectedReviewList = $review->getList(123);
print_r($selectedReviewList);
