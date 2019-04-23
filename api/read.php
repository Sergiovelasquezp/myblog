<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../models/posts.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
    $post_arr = [];
    $post_arr['data'] = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        ];

        array_push($post_arr['data'], $post_item);
    }

    echo json_encode($post_arr);
} else {
    echo json_encode(
        ['message' => 'No posts found']
    );
}
