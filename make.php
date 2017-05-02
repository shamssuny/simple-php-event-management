<!DOCTYPE html>
<html>
<head>
	<title>Make a event</title>
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

     	.form-main{
     		padding-top: 40px;
     		background-size: cover;
     		background-image: url('event3.jpg');
     		height: 100vh;

     	}

     	.make_form{
     		width: 50%;
     		margin:0 auto;
     		text-align: center;
     		/*border:2px solid red;*/
     		background-color: #aa8b40;
     		padding: 20px;
     		opacity: 0.95;
     		color: white;
     		border-radius: 30px;
     	}
    </style>
</head>
<body>

<?php
	include 'db.php';
	session_start();

	$uid = $_SESSION['u'];
	$d =  new db();
	$pdo = $d->conn();
	if(!$d->getSession()){header('location:index.php');}

	if(isset($_POST['submit'])){
		$ed = $_POST['eid'];
		$ena = $_POST['enam'];
		$eds = $_POST['edes'];
		$chq="select * from event where eid='$ed';";
		$qr = $pdo->query($chq)->rowCount();
		if($qr!=0){
			echo "<b><p class='bg-danger' style='padding:0;margin:0;text-align:center;'>name already Exixst</p></b>";
		}else{
			$r = rand(1,100);
			$file = $_FILES['image']['name'];
			$file = "$r".$file;
			$tmp = $_FILES['image']['tmp_name'];
			move_uploaded_file($tmp,"img/".$file);
			$mqr="insert into admin_$uid values ('$ed','$ena');";
			$mtbl ="create table if not exists admin_reg_$ed (rid varchar(200),name varchar(200));";
			$met = "insert into event values ('$ed','$ena','$ena','$eds','$file');";
			$qr1 = $pdo->query($mqr);
			$qr2 = $pdo->query($mtbl);
			$qr3 = $pdo->query($met);
			echo "<b><p class='bg-success' style='padding:0;margin:0;text-align:center;'>Event Created!</p></b>";
		}
	}
?>

<div class="main container-fluid row">

	<div class="row">
			<div class="header col-md-12">
				<div class="row">
					<div class="he col-md-7">
						<h3 style="float: right;">Admin Dashboard</h3>
					</div>

					<div class="ha col-md-5">
						<p style="float: right;margin-top: 15px;padding: 10px;"><?php echo "Welcome Manager ".$_SESSION['u']." <a style='color:white' href='logout.php'>|| <b>Logout</b></a>"; ?></p>
					</div>
				</div>
				
			</div>
		</div>



	<div class="form-main">
	
		<div class="make_form">
			<form class="form-group" action="" method="POST" enctype="multipart/form-data">
				<h3>Make A Event</h3>
				<input class="form-control" type="text" name="eid" placeholder="event id"><br>
				<input class="form-control" type="text" name="enam" placeholder="event name"><br>
				<textarea class="form-control" name="edes" placeholder="event description"></textarea><br>
				<input style="width: 30%;margin:0 auto;" type="file" name="image"/><br>
				<input class="btn btn-success" type="submit" name="submit" value="submit"/>
			</form>
		</div>

	</div>

</div>


</body>
</html>