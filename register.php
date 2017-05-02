<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
    	.header{
     		width:100%;
     		/*border:2px solid red;*/
     		/*text-align: center;*/
     		background-color: #ba5e0e;
     		color: white;
     		
     	}

     	.reg-main{
     		background-size: cover;
     		background-image: url('event6.jpg');
     		height: 100vh
     	}

     	.register_form{
     		width : 40%;
     		margin: 0 auto;
     		margin-top: 8%;
     		background-color:lightblue;
     		border-radius: 20px;
     		padding: 10px;
     		text-align: center;
     	}
    </style>
</head>
<body>
<?php
include 'db.php';
$db= new db();
$pdo= $db->conn();
if($db->getSession()){
  $i = $_SESSION['u'];
  $qr = "select * from user where username='$i'";
  $qq = "select * from manager where username='$i'";
  $c1 = $pdo->query($qr)->rowCount();
  $c2 = $pdo->query($qq)->rowCount();
  if($c1>0){header('location:user.php');}
  if($c2>0){header('location:admin.php');}
}




	if(isset($_POST['submit'])){
		$uname = $_POST['user_name'];
		$upass = $_POST['u_pass'];
		$cuser = $_POST['t'];
		if($cuser =='create'){
			$chk = "select * from manager where username='$uname'";
			$cq = $pdo->query($chk)->rowCount();
			if($cq!=0){
				echo "<b><p class='bg-danger' style='padding:0;margin:0;text-align:center;'>Username Exist!</b>";
			}else{
				$inu = "insert into manager values ('$uname','$upass')";
				$crman = "create table if not exists admin_".$uname." (evid varchar(200),name varchar(200));";
				$crm = $pdo->query($crman);
				$inq = $pdo->query($inu);
				echo "<b><p class='bg-success' style='padding:0;margin:0;text-align:center;'>Register Successfull</p></b>";
			}
		}



		if($cuser =='use'){
			$chk = "select * from user where username='$uname'";
			$cq = $pdo->query($chk)->rowCount();
			if($cq!=0){
				echo "<b><p class='bg-danger' style='padding:0;margin:0;text-align:center;'>Username Exist!</b>";
			}else{
				$inu = "insert into user values ('$uname','$upass')";
				$it = "create table if not exists user_".$uname." (evid varchar(200),name varchar(200),confirm varchar(10));";
				$inq = $pdo->query($inu);
				$intt = $pdo->query($it);
				echo "<b><p class='bg-success' style='padding:0;margin:0;text-align:center;'>Register Successfull</p></b>";
			}
		}
	}
 ?>

 <div class="main container-fluid row">


 <div class="row">
			<div class="header col-md-12">
				<div class="row">
					<div class="he">
						<h3 style="text-align: center;">Registration Area</h3>
					</div>
				</div>
				
			</div>
	</div>

<div class="reg-main row">
<div class="register_form">

	<form action="" method="POST" class="form-group">
		<!-- <label>First Name</label>
		<input type="text" name="fname"><br>
		<label>Last Name</label>
		<input type="text" name="name"><br> -->
		<h3>Register For Event</h3>
		<input class="form-control" type="text" name="user_name" placeholder="User Name" required="1"><br>
		
		<input class="form-control" type="password" name="u_pass" placeholder="Password" required="1"><br>
		<!-- <label>Description</label>
		<textarea name="u_desc"></textarea><br> -->
		<label>Register As:</label><br>
		<input type="radio" name="t" value="create"><b>Event Manager</b><br>
    	<input type="radio" name="t" value="use"><b>Event User</b><br>
		<input class="btn btn-success" style="margin-top: 20px;" type="submit" name="submit" value="submit">
	</form>

</div>

</div>
</div>
</body>
</html>
