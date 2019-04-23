<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

include_once '../config/database.php';
include_once '../models/posts.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

//get raw content data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//create post
if ($post->createPost()) {
    echo json_encode(['message' => 'New post created']);
} else {
    echo json_encode(['message' => 'New post error']);
}
