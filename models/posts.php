<?php

class Post
{
    private $conn;
    private $table = 'posts';

    //public properties
    public $id;
    public $category_id;
    public $category_title;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT 
                    c.name as category_name, 
                    p.id,
                    p.category_id, 
                    p.title, 
                    p.body, 
                    p.author, 
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c 
                ON
                    p.category_id = c.id
                ORDER BY
                    p.created_at DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //get single post
    public function readSingle()
    {
        $query = 'SELECT 
                    c.name as category_name, 
                    p.id,
                    p.category_id, 
                    p.title, 
                    p.body, 
                    p.author, 
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c 
                ON
                    p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT 
                    0, 1';

        $stmt = $this->conn->prepare($query);
        //BIND ID
        $stmt->bindParam(1, $this->id);
        //EXECUTE QUERY
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //asignacion de propiedades a $row
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->author = $row['author'];
    }
}
