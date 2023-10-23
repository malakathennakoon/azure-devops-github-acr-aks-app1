<?php
include("../Login/dbcon.php");

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	if ($stmt = $con->prepare("DELETE FROM newsalerts_tbl WHERE id = ? LIMIT 1"))
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
	header("Location: newsalerts.php");
}
else
{
	header("Location: newsalerts.php");
}

mysqli_close($con);
?>