<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../models/posts.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

//get post id from url
$post->id = isset($_GET['id']) ? $_GET['id'] : die();
//read single post
$post->readSingle();

//create array
$single_post = [
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
];

print_r(json_encode($single_post));
