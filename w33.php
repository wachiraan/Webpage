<?php 
	include("connect.php");

	$fname = $lname = $email = $pword = $cpword = "";

	$errors = array('fname' => "", "lname" => "", "email" => "", "pword" => "", "cpword" => "");

	if(isset($_POST['submit'])){
		$fname = $_POST['first_name'];
		$lname = $_POST["last_name"];
		$email = $_POST['email'];
		$pword = $_POST['password'];
		$cpword = $_POST['confirm_password'];

		if(empty($_POST['first_name'])){
			$errors["fname"] = "Firstname field cannot be blank.";
		} 
		if(empty($lname)){
			$errors["lname"] = "Lastname field cannot be blank.";
		} 
		if(empty($email)){
			$errors["email"] = "Email input required.";
		} 
		if(empty($pword)){
			$errors["pword"] = "Password cannot be blank.";
		} 
		if($cpword != $pword){
			$errors["cpword"] = "Passwords do not match.";
		}

		if(!array_filter($errors)){
			$sql = "INSERT INTO registration(first_name, last_name, email, password) VALUES('$fname', '$lname', '$email', '$pword')";

			$query = mysqli_query($connect, $sql);

			if(!$query){
				echo $connect->error;
			} else {
				$fname = $lname = $email = $pword = $cpword = "";
				header("Location: dash.php");
			}
		}
		mysqli_close($connect);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background-color: burlywood;
			padding-top: 60px;
		}

		#overlay{
			background-color: white;
			border-radius: 20px;
			outline: none;
			border: none;
			width: 400px;
			align-self: left;
			align-content: left;
			box-align: left;
			text-align: left;
		}

		label{
			margin-top: 20px;
			color: grey;
		}

		input[type="text"]{
			width: 90%;
			height: 35px;
			border-radius: 7px;
			outline: none;
			border: none;
			padding-left: 20px;
			border-bottom: 1px solid gray;
		}

		input[type="text"].active{
			width: 90%;
			height: 35px;
			border-radius: 7px;
			outline: none;
			border: none;
			padding-left: 20px;
			border-bottom: 2px solid blue;
		}

		input[type="password"]{
			width: 90%;
			height: 35px;
			border-radius: 7px;
			outline: none;
			border: none;
			padding-left: 20px;
			border-bottom: 1px solid gray;
		}

		input[type="button"]{
			width: 30%;
			height: 40px;
			background-color: lightblue;
			outline: none;
			border: none;
			border-radius: 30px;
		}

		input [type="checkbox"]{
			padding-right: 20px;
		}

		#error_text{
			color: red;
			font-size: 14px;
		}
	</style>
</head>
<body>
	<center><section id="overlay" style="padding: 10px;">
	<center><h1>Login Form</h1></center><hr>
	<form method="POST" action="index.php">
	<label for="first_name"><b>First name</b></label><br>
		<input type="text" placeholder="Enter Username" name="first_name" value="<?php echo htmlspecialchars($fname); ?>">
		<p id="error_text"><?php echo $errors["fname"]; ?></p>
	<label for ="last_name"><b>Last name</b></label><br>
		<input type="text" placeholder="Enter password" name="last_name" value="<?php echo htmlspecialchars($lname); ?>">
		<p id="error_text"><?php echo $errors["lname"]; ?></p>
	<label for="email"><b>E-MAIL</b></label><br>
		<input type="text" placeholder="Enter email" name="email" value="<?php echo htmlspecialchars($email); ?>">
		<p id="error_text"><?php echo $errors["email"]; ?></p>
	<label for="password"><b>Password</b></label><br>
		<input type="password" placeholder="Enter password" name="password" value="<?php echo htmlspecialchars($pword); ?>">
		<p id="error_text"><?php echo $errors["pword"]; ?></p>
	<label for="confirm_password"><b>Confirm password</b></label><br>
		<input type="password" placeholder="Confirm password" name="confirm_password" value="<?php echo htmlspecialchars($cpword); ?>">
		<p id="error_text"><?php echo $errors["cpword"]; ?></p>
	<center><input type="submit" name="submit" value="submit" style="width: 150px; height: 30px; border-radius: 12px; outline: none; border: none;"></input></center>
		<br>
	<label> <br>
		<input type="checkbox" name="remember">   Remember me
	</label>
	
</form>
</section>
</body>
</html>