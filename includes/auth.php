<?php


class Authenticator{

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($user){
        $sql = 'SELECT * FROM user';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        if($rowCount > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($user == $row){
                    return "true";
                }
            }
            return "false";
        }
    }

    public function authenticateMod($user){
        $sqlUser = 'SELECT * FROM user';
        $sqlMod = 'SELECT userID FROM moderator WHERE userID = '.$user['ID'];
        $stmt = $this->conn->prepare($sqlUser);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        if($rowCount > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($user == $row){
                    $stmt = null;
                    $stmt = $this->conn->prepare($sqlMod);
                    $stmt->execute();

                    $test = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($test['userID'] == $user['ID']){
                        return "true";
                    } else {
                        return "false";
                    }
                }
            }
            return "false";
        }
    }
}



?>



