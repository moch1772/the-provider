<?php 
    class Search{
        private $conn;
        private $table = 'post';
        private $table2 = 'tag';
        private $table3 = 'wikiarticle';
    
        public $postID;
        public $userID;
        public $dateTime;
        public $showComments;
        public $text;
        public $title;
        public $version;
        public $data;
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
            WHERE C.tag LIKE "%"?"%"';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        return $stmt;
        }

        public function read_TitleW(){
            $sql = 'SELECT p.wikiID, p.userID, p.date,p.version p.text, p.title
            FROM '.$this->table3. ' p
            WHERE p.title LIKE "%"?"%"';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        
        return $stmt;
        }


    }
?>