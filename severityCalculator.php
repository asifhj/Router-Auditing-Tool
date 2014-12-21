<?php

$con=mysqli_connect("localhost","root","root","router");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$dom = new DOMDocument();
  libxml_use_internal_errors(true);
  foreach(glob("REPS/*.html") as $file) {
  $dom->loadHTMLFile($file);
  $hostname=substr($file,17, -9);
  $table=$dom->getElementsByTagName('table');
  $table3 =$table->item(2);
  $i=0;
 foreach($table3->childNodes->item(2)->childNodes as $node){
	if($i==4){
		$severity= (($node->nodeValue)/10);
		$sql="UPDATE host SET Severity='".$severity."' WHERE hostname='".$hostname."'";
						
						if (!mysqli_query($con,$sql))
						{
							die('Error: ' . mysqli_error($con));
						}			
	}
	$i++;
	
  }		
  }
?>