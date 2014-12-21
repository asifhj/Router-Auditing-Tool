<?php
/*this script takes the rulename from a get request from rules tab in router.php
and returns a comma seperated list of the routers where this has actually failed back to router.php
*/
define("IP", "localhost");
$rulename=$_GET['rulename'];
// Create connection
	$con=mysqli_connect("localhost","root","root","router");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql="SELECT routers FROM rules WHERE rule='".$rulename."'";

		$result = mysqli_query($con,$sql);
		$routers="";
		while($row = mysqli_fetch_array($result,MYSQL_BOTH))
		{
			$routers=$row['routers'];
		}			
		
		mysqli_close($con);
		$routerarray=explode(",",$routers);
		echo "Total Routers Failed:".count($routerarray);
		echo "<br/>";
		echo "<table border='1'>";
		$row_data=0;
		foreach($routerarray as $router)
		{
			if($row_data==0)
				echo "<tr>";
			$row_data++;

			echo "<td><a href='http://".IP."/myrouter/router.php?file=".$router."' target='_blank'>".$router."</a></td>";
			if($row_data==3)
			{
				echo "</tr>";
				$row_data=0;
			}
			
		}
		echo "</table>";
		
?> 