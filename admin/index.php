<?php
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style1.css">
	<script src="../jquery.js"></script>
	<script src="../js1.js"></script>
	<script src="../js2.js"></script>
</head>
<body>
<div class="container">
	<form method="post" action="">
		<input type="submit" name="delete" value="Delete" class="btn btn-success">
	<table class="table">
		<tr>
			<td>Select</td>
			<td>Name</td>
			<td>Email</td>
			<td>Gender</td>
			<td>Image</td>
			<td>Delete</td>
		</tr>
		<?php
		$qry=mysqli_query($con,"select * from login");
		while($row=mysqli_fetch_array($qry))
		{
			extract($row);
		?>
		<tr>
			<td><input type="checkbox" name="remove[]" value="<?php echo $id; ?>"></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $gender; ?></td>
			<td><img src="../img/<?php echo $pic; ?>" style="width: 50px; height: 50px;"></td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
</div>
<?php
if(isset($_POST["delete"]))
{
	extract($_POST);
	$remove=implode(",", $_POST["remove"]);
	$qry=mysqli_query($con,"select * from login where id in ($remove)");
	while($row=mysqli_fetch_array($qry))
	{
		extract($row);
		unlink("../img/".$pic);
	}
	$qry2=mysqli_query($con,"delete from login where id in ($remove)");
	if($qry2)
	{
		header("location:index.php");
	}
}
?>
</body>
</html>