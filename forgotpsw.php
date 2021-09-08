<?php
	


	$Email = $_POST['email'];
	$NewPassword = $_POST['psw'];
	$ConfirmPass = $_POST['pswrepeat'];

		$host = "localhost";
		$user = "root";
		$pass = "";
		$dB = "ipproject";

		$conn = new mysqli($host,$user,$pass,$dB);
		if (mysqli_connect_error()) 
		{
     		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    	}
		else
		{
			
			if ($NewPassword == $ConfirmPass)
			{

				$update= "update signUp set Password='$NewPassword' where Email='$Email'";
				$stmt = $conn->prepare($update);
				$stmt->bind_param("ss", $Email, $NewPassword);
				$stmt->execute();
				$stmt->bind_result($Email,$NewPassword);

				header("location:signIn.html");
			}
			else
			{
				echo "Password Not Matching..";
			}
			
	
			$stmt->close();
			$conn->close();	
		}
	
?>
