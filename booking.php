<?php
	


	$Email = $_POST['email'];
	$Name = $_POST['name'];
	$PhoneNo = $_POST['phnum'];
	$Package = $_POST['package'];
	$Price = $_POST['price'];
	$NoOfTravellers = $_POST['travellers'];
	$From = $_POST['datef'];
	$To = $_POST['datet'];

	if (!empty($Email) || !empty($Name) || !empty($PhoneNo) || !empty($Package) || !empty($Price)|| !empty($NoOfTravellers)|| !empty($From)|| !empty($To))
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

				$insert = "insert into booking(Email,Name,PhoneNo,Package,Price,NoOfTravellers,FromDate,ToDate)values(?,?,?,?,?,?,?,?)";
				$stmt = $conn->prepare($insert);
				$stmt->bind_param("ssisiiss", $Email, $Name, $PhoneNo, $Package, $Price, $NoOfTravellers, $From, $To);
				$stmt->execute();
				
				header("location:payment.html");
				//echo "SUCCESSFULLY BOOKED.";
			}
			else
			{
				header("location:signUp.html");
				 
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
