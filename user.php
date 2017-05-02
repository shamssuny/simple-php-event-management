<!DOCTYPE html>
<html>
<head>
	<title>User Panel</title>
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

     	.u-events{
     		background-image: url('event5.jpg');
     		background-size: cover;
     		height: 100vh;
     	}

     	.show_all{
     		float: left;
     		/*border:2px solid red;*/
     		margin-left: 8%;
     		background-color: #dd9735;
     		height: 65vh;
     		margin-top: 50px;
     		padding: 10px;
     		width: 40%;
     		color:white;
     		border-radius: 20px;
     		text-align: center;
     		overflow: scroll;
     		opacity: 0.95;

     	}

     	.show_reg_event{
     		/*border:2px solid red;*/
     		background-color: #dd9735;
     		border-radius: 20px;
     		text-align: center;
     		padding: 10px;
     		opacity: 0.95;
     		color:white;
     		float: right;
     		margin-right: 8%;
     		height: 65vh;
     		margin-top: 50px;
     		width: 30%;
     		overflow: scroll;
     	}
    </style>
</head>
<body>
<?php
include 'db.php';
$d= new db();
$pdo = $d->conn();
session_start();
//echo "WELCOME ".$_SESSION['u'];
$usr = $_SESSION['u'];

if(isset($_GET['eid'])){
	$evd=$_GET['eid'];
	$evn=$_GET['en'];

	$chk="select * from admin_reg_$evd where rid='$usr';";
	$cq = $pdo->query($chk)->rowCount();

	if($cq!=0){
		echo "<b><p class='bg-success' style='text-align:center;margin:0;padding:0'>Already Registered!</p></b>";
	}else{
		$uq="insert into user_$usr values ('$evd','$evn','no');";
		$mq = "insert into admin_reg_$evd values ('$usr','$usr');";
		$mqq = $pdo->query($mq);
		$uuq = $pdo->query($uq);
		echo "<b><p class='bg-danger' style='text-align:center;margin:0;padding:0'>Register Successfull!</p></b>";
	}
}

?>
	<div class="main container-fluid row">
		
		<div class="row">
			<div class="header col-md-12">
				<div class="row">
					<div class="he col-md-7">
						<h3 style="float: right;">User Dashboard</h3>
					</div>

					<div class="ha col-md-5">
						<p style="float: right;margin-top: 15px;padding: 10px;"><?php echo "Welcome User ".$_SESSION['u']." <a style='color:white' href='logout.php'>|| <b>Logout</b></a>"; ?></p>
					</div>
				</div>
				
			</div>
		</div>
		<!-- <div class="search">
			<form action="" method="POST">
				<input type="text" name="search">
				<input type="submit" name="">
			</form>
		</div> -->
		<div class="u-events row">

		<div class="show_all">
			<h3>All Available events</h3>
			<?php
				$qr = "select * from event";
				$qs = $pdo->query($qr);
				foreach ($qs as $value) {
					$im =  $value['img'];
					$v = $value['eid'];
					$vm =$value['name'];
					echo "<img style='height:100px;' src='img/$im'/><br>";
					echo "<b>Name:</b> ".$value['name']."<br><b>Description:</b> ".$value['des']."<br><a class='btn btn-primary btn-xs' href='user.php?eid=$v&en=$vm'>Register</a><br><hr>";
				}
			?>
		</div>

		<div class="show_reg_event">
			<h3>Your Registered Events</h3>
			<?php 
				$fe = "select * from user_$usr;";
				$ffe = $pdo->query($fe);
				foreach ($ffe as $value) {
					$e = $value['evid'];
					echo "<b>Name:</b> ".$value['name']."<br><b>Confirm:</b> ".$value['confirm']." <a class='btn btn-primary btn-xs' href='sh_dt_usr.php?ev=$e'>view</a>"."<br><hr>";
				}
			 ?>
		</div>

		</div>
	</div>

</body>
</html>