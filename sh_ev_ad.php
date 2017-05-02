<!DOCTYPE html>
<html>
<head>
	<title>Show event</title>
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

     	.ev-all{
     		background-image: url('event3.jpg');
     		background-size: cover;
     		height: 100vh;
     	}

     	.reg-user{
     		width: 30%;

     		/*border:2px solid red;*/
     		float:left;
     		margin-left:10%;
     		margin-top: 5%;
     		height: 65vh;
     		border-radius: 20px;
     		padding: 10px;
     		opacity: 0.75;

     		background-color: white;
     	}

     	.ev-det{
     		/*border:2px solid red;*/
     		width: 30%;
     		padding: 10px;
     		float: right;
     		height: 65vh;
     		background-color: white;
     		margin-top: 5%;
     		opacity: 0.75;
     		border-radius: 20px;
     		margin-right: 10%;
     	}
    </style>
</head>
<body>
<?php
session_start();

include 'db.php';
$d = new db();
if(!$d->getSession()){header('location:index.php');}
$pdo = $d->conn();

if(isset($_GET['c'])){
		$e = $_GET['e'];
		$k=$_GET['id'];
		$up = "update user_$k set confirm='yes' where evid='$e'";
		$r = $pdo->query($up);
		echo "<script>alert('confirmed!');</script>";
		header('location:sh_ev_ad.php?evid='.$e);
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

	<div class="ev-all row">
		<div class="reg-user">
		<h3>Registered Users List</h3>
			<?php
				if(isset($_GET['evid'])){
					$e = $_GET['evid'];
					$qq = "select * from admin_reg_$e;";
					$qr = $pdo->query($qq);	


					foreach ($qr as $key => $value) {
						$i = $value['rid'];
						echo "--> <b>".$value['name']."</b> <a href='sh_ev_ad.php?id=$i&c=1&e=$e'>confirm</a>"."<br>";
					}
				}
			?>
		</div>

		<div class="ev-det">

		<h3>Event Details</h3>

		<?php
			if(isset($_GET['evid'])){
				$e = $_GET['evid'];
				$se = "select * from event where eid='$e';";
				$see= $pdo->query($se);
				foreach ($see as $value) {
					$img=$value['img'];
					echo "<img style='height:150px;' src='img/$img'/><br>";
					echo "<b>Event Name:</b> ".$value['ename']."<br><b>Description:</b> ".$value['des']."<br>";
				}
			}

		?>
			
		</div>
	</div>

</div>

</body>
</html>