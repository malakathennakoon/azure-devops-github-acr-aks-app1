<?php
include("../Login/dbcon.php");

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	if ($stmt = $con->prepare("DELETE FROM workforce_tbl WHERE userID = ? LIMIT 1"))
	{
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
	}
	else
	{
		echo "ERROR: could not prepare SQL statement.";
	}
	$con->close();
	header("Location: usermanage.php");
}
else
{
	header("Location: usermanage.php");
}

mysqli_close($con);
?>