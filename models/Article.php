<?php

class Article{
    private $conn;
    private $table = 'wikiarticle';

    public $wikiID;
    public $userID;
    public $date;
    public $version;
    public $text;
    public $title;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.wikiID, p.userID, p.date, p.version, p.text, p.title
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.wikiID, p.userID, p.date, p.version, p.text, p.title
        FROM '.$this->table. ' p
        WHERE p.wikiID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->wikiID = $row['wikiID'];
        $this->userID = $row['userID'];
        $this->date = $row['date'];
        $this->version = $row['version'];
        $this->text = $row['text'];
        $this->title = $row['title'];
        
        return $stmt;
    }
    
    public function create() {
        $sql = 'INSERT INTO ' . $this->table . ' SET title = :title, text = :text, userID = :userID, version = :version';

        $stmt = $this->conn->prepare($sql);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->text = htmlspecialchars($this->text);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->version = htmlspecialchars(strip_tags($this->version));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':version', $this->version);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
    
    //Update Article
    public function update(){


        $sql = 'SELECT * FROM '.$this->table.' WHERE wikiID=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $wikiID=$row['wikiID'];
        $userID=$row['userID'];
        $title=$row['title'];
        $text=$row['text'];
        $version=$row['version'];

        $sql = "INSERT INTO wikihistory SET wikiID='$wikiID', userID='$userID', text='$text', title='$title', version='$version'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();


        //Query
        $sql=' UPDATE '.$this->table.'
        SET
            text = :text,
            title = :title,
            userID = :userID,
            version = ' .$version. '+ 1
            WHERE 
            wikiID = :wikiID';

        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->text = htmlspecialchars($this->text);
        $this->title = htmlspecialchars($this->title);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));

        //sätt data/Bind data
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':userID', $this->userID);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $sql = 'SELECT * FROM '.$this->table.' WHERE wikiID=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $wikiID=$row['wikiID'];
        $userID=$row['userID'];
        $dateTime=$row['dateTime'];
        $version=$row['version'];
        $text=$row['text'];
        $title=$row['title'];

        $sql = "INSERT INTO wikihistory SET wikiID='$wikiID',userID='$userID', date='$dateTime',version='$version',text='$text',title='$title'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $sql = 'DELETE FROM ' . $this->table . ' WHERE wikiID = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->wikiID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
    
    public function titleLink(){
        $sql='SELECT text FROM wikiarticle WHERE wikiID=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();

        $rw = $stmt->fetch(PDO::FETCH_ASSOC);
        $tet=$rw['text'];

        $sql='SELECT title,wikiID FROM wikiarticle WHERE NOT wikiID=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();


       $nog=array();
       $deb=array();
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           
            $title=$row['title'];
            $ID=$row['wikiID'];
            array_push($nog,$title);
            
            $url='&lt;a href=&quot;http://localhost:8080/t4/bull/kalender/the-provider/api/article/read_single.php?wikiID='.$ID.'&quot;&gt;'.$title.'&lt;/a&gt;';
            array_push($deb,$url);
       }
       
       $newstring = str_replace($nog,$deb, $tet);
       
       return $newstring;
       
    }
}
?>
