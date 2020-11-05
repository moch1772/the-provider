<?php

class Database {

    private $host = 'localhost';
    private $db;
    private $username;
    private $password;
    private $conn; 

    public function __construct ($db, $username, $password){
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }


    public function connect(){
        $this->conn = null;


        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $error) {
            echo 'Connection Error: '. $error->getMessage();
        }

        return $this->conn;
    }

}



?>



<?php


$test = new Database("databaseName", "user", "password");
__construct("provider","sås","kkk");
 
/*$ch=curl_init();
    
    $url="http://localhost:8080/t4/bull/kalender/the-provider/api/kalender/createEv.php";

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;*/

?>