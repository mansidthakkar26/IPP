<?php

	if(isset($_POST['email']))
    {
        $Email = $_POST['email'];
		$Password = $_POST['psw'];
    }  

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
		$select = "select Email,Password from signUp where Email='$Email' AND
		 Password='$Password' Limit 1";

		$stmt = $conn->prepare($select);
		$stmt->bind_param("ss", $Email, $Password);
		$stmt->execute();
		
		$result = $stmt->get_result();
        while($row = $result->fetch_array(MYSQLI_ASSOC)) 
        {
        	
        	$uname =  $row["Email"];
	        $pass = $row["Password"];
        	 
    	}

		if($Email==$uname && $Password==$pass)
	    {
	        
	        session_start();
	        $_SESSION['user'] = $uname;
	        
	        header("location: index.html");
	    }
	    else{
	        session_start();
	        $_SESSION['error'] = "set";
	        header("location: signUp.html");
	    }

		$stmt -> close();
		$conn -> close();	
	}
?>
