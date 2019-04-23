<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

include_once '../config/database.php';
include_once '../models/posts.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

//get raw content data
$data = json_decode(file_get_contents("php://input"));

//set the id to update
$post->id = $data->id;

//update post
if ($post->deletePost()) {
    echo json_encode(['message' => 'Post deleted']);
} else {
    echo json_encode(['message' => 'Post delete error']);
}
