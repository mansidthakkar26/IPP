<?php
	
	$Email = $_POST['email'];
	$Name = $_POST['name'];
	$Suggestion = $_POST['suggest'];
	$FeedbackType = $_POST['fdbtype'];
	$Feedback = $_POST['feedback'];

	if (!empty($Email) || !empty($Name) || !empty($Suggestion) || !empty($FeedbackType) || !empty($Feedback))
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
			
			
			if($rnum == 1 )
			{
				$stmt->close();

				$insert = "insert into feedback(Email,Name,Suggestion,FeedbackType,Feedback)values(?,?,?,?,?)";
				$stmt = $conn->prepare($insert);
				$stmt->bind_param("sssss", $Email, $Name, $Suggestion, $FeedbackType, $Feedback);
				$stmt->execute();
				
				echo "Thank you for your Feedback ".($Name);
				//header("location:index.html");
				
			}
			else
			{
				echo "Enter your correct Email address"; 
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
