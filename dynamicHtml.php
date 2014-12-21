<?php
/*
This script is a simulation of Rat results. By running this the RAT files will be changed according
to the approved results of the network administrator in the ticketing system. Thus results will reflect on the new screens
*/

//get comma separated rules from Asif's database and make changes correspondingly
//put in array under $rules

// start of mysql connection
	error_reporting(0);
	$con=mysqli_connect("localhost","root","root","incident_management_system_demo_purpose");

	// checking for any error in connection
	if (mysqli_connect_errno($con))
	{
		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT ConfigRuleName,HostName,TicketNo FROM tickets ORDER BY TicketNo DESC LIMIT 1");
	$rule;
	$hostname="Hello";
	while($row = mysqli_fetch_array($result,MYSQL_BOTH))
	  {
	  $rules=explode(":",$row['ConfigRuleName']);
	  $hostname=$row['HostName'];
	  }
	  //echo $hostname;
	  
	  
	  $list=array();
	  $size=count($rules)-2;
	  foreach($rules as $rule){
		$list[$size]=explode(" ",$rule)[0];
		$size--;
		if($size<0){
			break;
		}
	  }
	  $size=count($rules)-1;
	
	  foreach($list as $ru){
		
	  }
	mysqli_close($con);
	$con=mysqli_connect("localhost","root","root","router");
	$con->query("update host set Criticality='0' where hostname='$hostname'");  	
	mysqli_close($con);
//end of mysql connection

/*Entire array is considered here assuming
the ticket has changes pertaining to the rules present in RAT only.
*/

  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile("REPS/ACME-ROUTER-".$hostname.".cfg.html");
  $table=$dom->getElementsByTagName('table');
  $table1 = $table->item(0);
  $table2 =$table->item(1);
  $table3 =$table->item(2);
  $i=0;
  $val=0;
  $fail=0;
  $cumweight=0;
  $changes=0;
  foreach($table1->childNodes as $node){				//array traversing over rules
  
	if(in_array(explode(" ",$node->childNodes->item(4)->nodeValue)[0],$list))
	{
		$node->childNodes->item(2)->nodeValue="pass";
		$cumweight+=$node->childNodes->item(0)->nodeValue;
		$changes++;
	}			
	if($node->childNodes->item(2)->nodeValue=="FAIL"){
		$fail=1;
	}
}	//looping at odd numbers
  $pass;
  $total;
  foreach($table2->childNodes->item(2)->childNodes as $node){
	if($i==0){
	$total=$node->nodeValue;
	}
	else if($i==2){
	$pass=$node->nodeValue+$changes;
	$node->nodeValue=$pass;
	}
	else if($i==4){
	$node->nodeValue=($node->nodeValue)-$changes;
	}
	else if($i==6){
	$node->nodeValue=(string)floor(($pass/$total)*100);
	}
	$i++;
  }		
  
  $i=0;
 // echo $cumweight."end";
  foreach($table3->childNodes->item(2)->childNodes as $node){
	if($i==0){
	$total=$node->nodeValue;
	}
	else if($i==2){
		$pass=$node->nodeValue+$cumweight;
		$node->nodeValue=$pass;
	}
	else if($i==4){
		$node->nodeValue=(string)floor(($pass/$total)*100);
	}
	$i++;
  }		
  $dom->saveHTMLFile("REPS/ACME-ROUTER-".$hostname.".cfg.html");
 
//Code is poetry

$con=mysqli_connect("localhost","root","root","router");
$result = mysqli_query($con,"SELECT * FROM score where Hostname like '%$hostname'");
echo "hello";
$tc=0;
$p=0;
$f=0;
$pp=0;
$pw=0;
$aw=0;
$os=0;

while($row = mysqli_fetch_array($result,MYSQL_BOTH))
{
	$tc=$row['Total_Checks'];
	$p=$row['Passed'];
	$f=$row['Failed'];
	$pp=$row['Passed_Percentage'];
	$pw=$row['Perfect_Weighted_Score'];
	$aw=$row['Actual_Weighted_Score'];;
	$os=$row['Overall_Score'];;
	//$host=$row['HostName'];
}
//echo "UPDATE score SET Overall_Score=100, Passed=$p, Failed=0, Pass_Percentage=100, Actual_Weighted_Score=$pw WHERE Hostname LIKE '%$hostname'";
$con->query("UPDATE score SET Overall_Score=100, Passed=$p, Failed=0, Pass_Percentage=100, Actual_Weighted_Score=$pw WHERE Hostname LIKE '%$hostname'");  	
mysqli_close($con);

  /*Now changing the json data in the static json file when all the results are pass*/
 
 if($fail==0){
  $json = json_decode(file_get_contents('data/test35.json'), true);
  
	
	foreach ($json as $key1 => $value1) {
		if((string)$key1=="nodes"){
			foreach ($value1 as $key2=>$value2) {
					if ($value2['Hostname'] == $hostname){
						$json[$key1][$key2]['RAT']="pass";
					}
				}
			}
			break;
		}
	$newJsonString = json_encode($json);
	file_put_contents('data/test35.json', $newJsonString);
	}
header( 'Location: http://localhost/solo_rv/myrouter/router.php?file='.$hostname ) ;
 
?>