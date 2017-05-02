<!DOCTYPE html>
<html>
<head>
	<title>Event Details</title>
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

     	.fin{
     		background-color: #7c5d31;
     		height: 100vh;
     	}

     	.det{
     		width: 60%;
     		margin:0 auto;
     		margin-top: 5%;
     		background-color: #dd9735;
     		border-radius: 20px;
     		color: white;
     		padding: 10px;
     		text-align: center;
     	}
    </style>
</head>
<body>

<?php
	session_start();
	include "db.php";
	$d = new db();
	$pdo = $d->conn();
	
?>

<div class="main container-fluid row">
	<div class="row">
			<div class="header col-md-12">
				<div class="row">
					<div class="he col-md-7">
						<h3 style="float: right;">Admin Dashboard</h3>
					</div>

					<div class="ha col-md-5">
						<p style="float: right;margin-top: 15px;padding: 10px;"><?php echo "Welcome User ".$_SESSION['u']." <a style='color:white' href='logout.php'>|| <b>Logout</b></a>"; ?></p>
					</div>
				</div>
				
			</div>
	</div>


	<div class="fin row">
		<div class="det">
			<h3>Event Details</h3>
			<?php
			  if(isset($_GET['ev'])){
					$ee =  $_GET['ev'];
					$she = "select * from event where eid='$ee';";
					$sheq = $pdo->query($she);

					foreach ($sheq as $value) {
						$img=$value['img'];
						echo "<img style='height:150px;' src='img/$img'/><br>";
						echo "<b>Name:</b> ".$value['name']."<br><b>Description:</b> ".$value['des']."<br>";
					}
				}
			?>
		</div>
	</div>
</div>
</body>
</html>