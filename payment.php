<?php

	$Email = $_POST['email'];
	$CardNo = $_POST['cardnum'];
	$Cvv = $_POST['cvv'];
	$Name = $_POST['cardname'];
	$ExpDate = $_POST['expdate'];

	if (!empty($CardNo) || !empty($Cvv) || !empty($Name) || !empty($ExpDate))
	{
		$host = "localhost";
		$user = "root";
		$pass = "";
		$dB = "ipproject";

		$conn = new mysqli($host,$user,$pass,$dB);
		if($conn->connect_error)
		{
			die("Connection Failed ".$conn->connect_error);
		}
		else
		{
			$select = "select Email from booking where Email='$Email' Limit 1";

			$stmt = $conn->prepare($select);
			$stmt->bind_param("s", $Email);
			$stmt->execute();
			$stmt->bind_result($Email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;

			if($rnum == 1)
			{
				$stmt->close();

				$update= "update booking set Status='Confirmed' where Email='$Email'";
				$stmt = $conn->prepare($update);
				$stmt->bind_param("ss", $Status, $Email);
				$stmt->execute();
				$stmt->bind_result($Status, $Email);

				header("location:index.html");
				//echo "Payment Successfull.";
			}
			else
			{
				echo "Enter Correct Details..."; 
			}

			$stmt -> close();
			$conn -> close();	
		}
	}
	else
	{
		echo "Specify All Fields";
	}
	
	
?>
