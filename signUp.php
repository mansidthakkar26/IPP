<?php
	


	$Email = $_POST['email'];
	$Password = $_POST['psw'];
	$PhoneNo = $_POST['phnum'];
	$Age = $_POST['age'];

	if (!empty($Email) || !empty($Password) || !empty($PhoneNo) || !empty($Age))
	{
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
			$select = "select Email from signUp where Email=? Limit 1";
			//$insert = "insert into signUp(Email,Password,PhoneNo,Age)values(?,?,?,?)";

			$stmt = $conn->prepare($select);
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->bind_result($Email);
			$stmt->store_result();
			$rnum= $stmt->num_rows;
			
			
			if($rnum == 0 )
			{
				$stmt->close();

				$insert = "insert into signUp(Email,Password,PhoneNo,Age)values(?,?,?,?)";
				$stmt = $conn->prepare($insert);
				$stmt->bind_param("ssii", $Email, $Password, $PhoneNo, $Age);
				$stmt->execute();
				
				header("location:signIn.html");
			}
			else
			{
				echo "EMAIL ALREADY REGISTERED !!!"; 
			}

			$stmt->close();
			$conn->close();	
		}
	}
	else
	{
		echo "All fields are required";
	}
	
?>
