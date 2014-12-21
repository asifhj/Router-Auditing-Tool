<?php
	// Create connection
	$con=mysqli_connect("localhost","root","root","router");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql="SELECT * FROM rules";

	$result = mysqli_query($con,$sql);
	$routers="";
	
	while($row = mysqli_fetch_array($result,MYSQL_BOTH))
	{
		$routers=$row['routers'];
		$routerarray=explode(",",$routers);
		//echo count($routerarray)."\t".$row['rule']."\n";
		$anchor='data/rules.html#'.str_replace(' ','',$row['rule']);
									
		echo "<li><p class='rule'>".count($routerarray)."<a href='$anchor' target='_blank' id='drag2' draggable='true' ondragstart='drag(event)'>".$row['rule']."</a></p></li>\n";
                            
	}			
	
	mysqli_close($con);
	
?>

