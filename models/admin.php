<?php
class Admin
{
    private $mConn;
    public function __construct($conn)
    {
        $this->mConn=$conn;

    }
  public function setBloggStatus($blogId, $status)
  {
      echo "status is";
      echo $status;
      $query=$this->mConn->prepare("update blogg set hidden=? where bloggID=?");
      if($query->execute([$blogId, $status]))
      return TRUE;
      else
      return FALSE;
 
    
  }
  public function editUser($userId, )
}
?>