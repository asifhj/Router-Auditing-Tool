<?php
	$rule=rtrim($_GET['rules'], ",");
	
	$rules=explode(",", $rule);
	$q="select * from rules where ";
	//echo $_GET['rules'];
	//array_pop($rules);
	for($i=0; $i<count($rules); $i++)
	{
		if($i==0)
			$q = $q . " rule='$rules[$i]'";
		else
			$q = $q . " or rule='$rules[$i]'";
	}
	//echo $q;
	$con=mysqli_connect("localhost","root","root","router");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//echo $q;
		$result = mysqli_query($con,$q);
		$routers="";
		while($row = mysqli_fetch_array($result,MYSQL_BOTH))
		{
			$routers=$routers.$row['routers'].",";
		}			
		//echo $routers;
		mysqli_close($con);
		//echo $routers;
		$routerarray=explode(",",$routers);
		//echo count($routerarray);
		echo count(array_unique($routerarray))-1;	
	
?>