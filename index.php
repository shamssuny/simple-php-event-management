<?php
include 'db.php';
//object of db class
$d = new db();
$pdo = $d->conn();
session_start();
if($d->getSession()){
  $i = $_SESSION['u'];
  $qr = "select * from user where username='$i'";
  $qq = "select * from manager where username='$i'";
  $c1 = $pdo->query($qr)->rowCount();
  $c2 = $pdo->query($qq)->rowCount();
  if($c1>0){header('location:user.php');}
  if($c2>0){header('location:admin.php');}
}
if (isset($_POST['submit'])) {
  # code...
  $lo=$_POST['log'];
  $unam = $_POST['user_name'];
  $upass = $_POST['password'];
  $uck=$d->login($lo,$unam,$upass);
  if($uck == false){
    echo "<b><p class='bg-danger' style='padding:0;margin:0;text-align:center'>Username or Password does not match</p></b>";
  }

}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Welcome To event Management</title>
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

     <style type="text/css">
     	.main{
     		background:url('event.jpg');
     		height: 100vh;
     		background-size: cover;
     	}
     	.login_form{
     		width: 40%;
     		margin: 0 auto;
     		text-align: center;
     		/*border: 2px solid red;*/
     		margin-top: 10%;
     		padding: 50px;
     		border-radius: 30px;
     		background-color: #d1b152;
     		opacity: 0.95;
     	}
     </style>
   </head>
   <body>

     <!-- login form -->
     <div class="main container-fluid row">

     <div class="login_form form-group" >

     	<h3><b style="color:#0a4154 ;">Welcome To Event Management</b></h3>

       <form action="" method="POST">
          <input class="form-control" type="text" name="user_name" placeholder="User Name" required><br>
          <input class="form-control" type="password" name="password" value="" placeholder="Password" required><br>
          <input type="radio" name="log" value="manager" required><b style="color: blue;">Event Manager</b><br>
          <input type="radio" name="log" value="user" required ><b style="color: red;">Event User</b><br>
          <input style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-primary" type="submit" name="submit" value="Login">
       </form>
       <p style="color: 
       red;">Not Registered ? <b> CLICK </b><a href="register.php"><b>Here</b></a></p>
     </div>

     </div>

   </body>
 </html>
