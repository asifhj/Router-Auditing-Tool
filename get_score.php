<?php
/*
This script is a simulation of Rat results. By running this the RAT files will be changed according
to the approved results of the network administrator in the ticketing system. Thus results will reflect on the new screens
*/

//get comma separated rules from Asif's database and make changes correspondingly
//put in array under $rules

	// start of mysql connection
	//error_reporting(0);
	$con=mysqli_connect("localhost","root","root","test");

	// checking for any error in connection
	if (mysqli_connect_errno($con))
	{
		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}	
	mysqli_query($con, "delete from score");

	$dir    = '/var/www/solo_rv/myrouter/InitialData/';
	$files1 = scandir($dir);
	//$files2 = scandir($dir, 1);
	//print count($files1);
	//print_r($files1);
	//print_r($files2);

	$tc=0;
	$p=0;
	$f=0;
	$pp=0;
	$pw=0;
	$aw=0;
	$os=0;
	$c=0;
	for($j=0;$j<count($files1);$j++)
	{
		$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTMLFile('REPS/'.$files1[$j]);
		$table=$dom->getElementsByTagName('table');
		$table1 = $table->item(0);
		$table2 =$table->item(1);
		$table3 =$table->item(2);
		$i=0;
		
		if($j>1 && $j<count($files1)-2)
		{
			
			foreach($table2->childNodes->item(2)->childNodes as $node)
			{
				if($i==0)
				{				
					//echo $node->nodeValue."&nbsp";
					$tc = $node->nodeValue;
				}
				else if($i==1)
				{
					////echo $node->nodeValue."&nbsp";
				}
				else if($i==2)
				{
					//echo $node->nodeValue."&nbsp";
					$p = $node->nodeValue;
				}
				else if($i==3)
				{
					////echo $node->nodeValue."&nbsp";
				}						
				else if($i==4)
				{
					//echo $node->nodeValue."&nbsp";
					$f = $node->nodeValue;
				}
				else if($i==5)
				{
					////echo $node->nodeValue."&nbsp";
				}
				else if($i==6)
				{
					//echo $node->nodeValue."&nbsp";
					$pp = $node->nodeValue;
				}
				$i++;
			}
			$i=0;		
			foreach($table3->childNodes->item(2)->childNodes as $node)
			{
				if($i==0)
				{
					//echo $node->nodeValue."&nbsp";
					$pw = $node->nodeValue;
				}
				else if($i==2)
				{
					//echo $node->nodeValue."&nbsp";
					$aw = $node->nodeValue;
				}
				else if($i==4)
				{
					//echo $node->nodeValue."&nbsp";
					$os = $node->nodeValue;
				}
				$i++;
			}	
			//echo "&nbsp&nbsp&nbsp&nbsp".$files1[$j];
			$ex=explode("-", $files1[$j]);
			//if(count($ex)!=5)
			$ex2=explode(".", $ex[4]);
			//echo count($ex).$files1[$j]."&nbsp".$ex[2]."-".$ex[3]."-".$ex2[0]."<br/>";
			$hostname=$ex[2]."-".$ex[3]."-".$ex2[0];
			/*if ($result=mysqli_query($con, "Select * from host where hostname like '%$hostname%'"))
			{
				// Return the number of rows in result set
				$rowcount=mysqli_num_rows($result);
				if($rowcount<1)
					echo count($ex).$files1[$j]."&nbsp".$ex[2]."-".$ex[3]."-".$ex2[0]."<br/>";
				// Free result set
				mysqli_free_result($result);
				$c++;
			}*/
			$c++;
			mysqli_query($con, "Insert into score(Hostname, Total_Checks, Passed, Failed, Pass_Percentage, Perfect_Weighted_Score, Actual_Weighted_Score, Overall_Score) values('$hostname', $tc, $p, $f, $pp, $pw, $aw, $os)");
			//echo "<br/>";
		}
		//Insert into score(Total_Checks, Passed, Failed, Pass_Percentage, Perfect_Weighted, Actual_Weighted_Score, Overall_Score) values($tc, $p, $f, $pp, $pw, $aw, $os)<br/>";	
		
	}
	echo $c;
	mysqli_close($con);
	//end of mysql connection
?>