<?php 
    class Search{
        private $conn;
        private $table = 'post';
        private $table2 = 'tag';
    
        public $postID;
        public $userID;
        public $dateTime;
        public $showComments;
        public $text;
        public $title;
        public $search;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read_Title(){
            $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title
            FROM '.$this->table. ' p
            WHERE p.title LIKE "%"?"%"';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        
        return $stmt;
        }


        public function read_Tag(){
            $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title
            FROM '.$this->table. ' p
            RIGHT JOIN '.$this->table2.' C
            ON p.postID = c.postID
            WHERE C.tag =?';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        return $stmt;
        }


    }
?>