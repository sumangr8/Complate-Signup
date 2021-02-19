<?php
include("db.php");
session_start();
if(!isset($_SESSION["email"]))
{
	header("location:index.php");
}
$email=$_SESSION["email"];
$id=$_REQUEST["id"];
$qry=mysqli_query($con,"select * from login where id='$id'");
$row=mysqli_fetch_array($qry);
extract($row);
$b=explode(",", $qualification);
// print_r($b);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="jquery.js"></script>
	<script src="js1.js"></script>
	<script src="js2.js"></script>
</head>
<body>
<div class="container">
	<div class="col-xl-6">
		<form method="post" action="">
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
			</div>
			<div class="form-group">
				<label>Gender : </label>
				<input type="radio" name="gender" class="form-control-inline" value="Male"
				<?php
				if('Male'==$gender)
				{
					echo "checked";
				}
				?>
				> Male
				<input type="radio" name="gender" class="form-control-inline" value="Female"
				<?php
				if('Female'==$gender)
				{
					echo "checked";
				}
				?>
				> Female
			</div>

			<div class="form-group">
				<label>Qualification : </label>
				<input type="checkbox" name="qualification[]" class="form-control-inline" value="MCA"
				<?php
				if(in_array("MCA",$b))
				{
					echo "checked";
				}
				?>
				> MCA
				<input type="checkbox" name="qualification[]" class="form-control-inline" value="BCA"
				<?php
				if(in_array("BCA",$b))
				{
					echo "checked";
				}
				?>
				> BCA
				<input type="checkbox" name="qualification[]" class="form-control-inline" value="B.Tech"
				<?php
				if(in_array("B.Tech",$b))
				{
					echo "checked";
				}
				?>
				> B.Tech
			</div>
			<input type="submit" name="update" value="Update" class="btn btn-success">

		</form>
	</div>
</div>
<?php
if(isset($_POST["update"]))
{
	extract($_POST);
	$qualification=implode(",", $_POST["qualification"]);
	$qry=mysqli_query($con,"update login set name='$name',gender='$gender',qualification='$qualification' where id='$id'");
	if($qry)
	{
		header("location:profile.php");
	}
}
?>
</body>
</html>