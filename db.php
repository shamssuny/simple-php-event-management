<?php
  include 'config.php';
  class db{
    public function __construct(){
      //create nessary tables in constructor to avoid collsion
      //get pdo connection
      $db=$this->conn();
      $qr = "CREATE TABLE IF NOT EXISTS manager (username varchar(200),password varchar(200));";
      $qq = "CREATE TABLE IF NOT EXISTS user (username varchar(200),password varchar(200));";
      $evt= "CREATE TABLE IF NOT EXISTS event (eid varchar(200),ename varchar(200),name varchar(200),des varchar(2000),img varchar(200));";
      //query occur
      $r = $db->query($qr);
      $q = $db->query($qq);
      $w = $db->query($evt);
    //  if($r){echo "Created";}
    }



    //make connection
    public function conn(){
      try{
        //this comes from config.php
        $dbname = DB_NAME;
        $dbhost = HOST;
        $dbuser = USER;
        $dbpass = PASS;
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;",$dbuser,$dbpass);
        //echo "Connected";
        return $pdo;

        }catch(Exception $e){
          echo $e->getMessage();
        }
    }


    //user login
    public function login($lo,$unam,$upass){
      $pdo = $this->conn();
      //echo $lo."".$unam." ".$upass;
      if($lo == 'manager'){
        $chk = "select * from manager where username='$unam';";
        $mq = $pdo->query($chk);
        $q =  $pdo->query($chk)->rowCount();
        //echo $q;
        if($q == 1){
          session_start();
          foreach ($mq as $value) {
            $_SESSION['log']= "true";
            $_SESSION['u']=$value['username'];
            header('location:admin.php');
          }
        }
      }

      //for user
      if($lo == 'user'){
        $chk = "select * from user where username='$unam';";
        $mq = $pdo->query($chk);
        $q =  $pdo->query($chk)->rowCount();
        //echo $q;
        if($q == 1){
          session_start();
          foreach ($mq as $value) {
            $_SESSION['log']= "true";
            $_SESSION['u']=$value['username'];
            header('location:user.php');
          }
        }
      }

      return false;
    }


  public function getSession(){
    return @$_SESSION['u'];
  }


  }


 ?>
