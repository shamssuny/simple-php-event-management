<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
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

     	.be-header{
     		width:100%;
     		background-color: #af822d;
     		color:white;
     		padding: 20px;
     	}

     	.man-main{
     		background-image: url('event2.jpg');
     		padding-top: 40px;
     		height: 100vh;
     		background-size: cover;
     	}

     	.man_event{
     		width: 50%;
     		/*border:2px solid red;*/
     		margin:0 auto;
     		opacity: 0.95;
     		border-radius: 20px;
     		height: 65vh;
     		background-color: #b4b74e;
     		color:white;
     		text-align: center;
     		overflow: scroll;
     	}
     </style>
</head>
<body>
<?php
include 'db.php';
$d = new db();
$pdo = $d->conn();
session_start();
if(!$d->getSession()){header('location:index.php');}

$us = $_SESSION['u'];
?>

	<div class="main container-fluid row">

		<div class="row">
			<div class="header col-md-12">
				<div class="row">
					<div class="he col-md-7">
						<h3 style="float: right;">Admin Dashboard</h3>
					</div>

					<div class="ha col-md-5">
						<p style="float: right;margin-top: 15px;padding: 10px;"><?php echo "Welcome Manager ".$_SESSION['u']; ?></p>
					</div>
				</div>
				
			</div>
		</div>


		<div class="row">
			<div class="be-header col-md-12">
				<div class="row">
					<div class="left col-md-6">
						<a class="btn btn-primary" style="float: left;" href="make.php">Make a event</a>
					</div>

					<div class="right col-md-6">
						<a class="btn btn-danger" style="float: right;" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
		<div class="man-main">
		<div class="man_event">
			
			<h2 style="padding-top: 5px; color: #0e1133;">Event You Make</h2>
			<?php
				$getq = "select * from admin_$us";
				$ge = $pdo->query($getq);
				foreach ($ge as $value) {
					$v = $value['evid'];

					echo "Name: ".$value['evid']."<br>ID: ".$value['name']."<br><a href='sh_ev_ad.php?evid=$v'>Show</a><br><hr>";
				}
			?>

		</div>

		</div>

		</div>

	</div>
</body>
</html>