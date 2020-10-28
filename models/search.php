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
            WHERE p.postID =?';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        return $stmt;
        }


    }
/*        
include "../config/db.php";
//returns json array with the elements from the database that conn conects to.
//the elements has to do with the search word in som way in tags or in title
//Vaqriable must be JSON for this to work
function searches($conn)
{   
    $search=$_GET['search'];
    $query="SELECT * FROM post where title like '%$search%'";
    //$search=json_decode($search);
    $result = mysqli_query($conn, "SELECT * FROM post where title like '%$search%'");
    $request=array();
    while($row = mysqli_fetch_array($result)){
        $holder=array("Title"=>$row['title'],"text"=>$row['text'],"Datum_och_tid"=>$row['dateTime']);
        array_push($request,$holder);
    }


    $sql="SELECT postID FROM tag where tag like '%$search%'";
    $tag = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($tag)){
        $sql2="SELECT * FROM post where postID=".$row['postID']."";
        $post = mysqli_query($conn, $sql2);
        while($row = mysqli_fetch_assoc($post)){
           $holder=array("Title"=>$row['title'],"text"=>$row['text'],"Datum_och_tid"=>$row['dateTime']);
            array_push($request,$holder);
        }
    }
    $request=array_map("unserialize", array_unique(array_map("serialize", $request)));
    $request=json_encode($request,true);
    return $request;
    }
*/
?>