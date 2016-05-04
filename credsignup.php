<!DOCTYPE html>
<html>
<head>
	<title>Redirecting</title>
	<style type="text/css">
	a:link{
		text-decoration: none;
	}
	</style>
</head>
<body>
	<?php
	include 'connection.php';

	$email = $_POST['email'];
	$uname = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];

	$sql = 'INSERT into USERDETAILS(email,username,password,firstname,lastname) values(:nm,:nl,:np,:no,:nt)';

	oci_parse($conn,$sql);


	oci_bind_by_name($sql,':nm', $email);
	oci_bind_by_name($sql,':nl', $uname);
	oci_bind_by_name($sql,':np', $password);
	oci_bind_by_name($sql,':no', $fname);
	oci_bind_by_name($sql,':nt', $lname);

	oci_execute($sql);

	echo "<h4>You are signed up!</h4>"

?>
	<a href="login.php">Login Page</a>

</body>
</html>