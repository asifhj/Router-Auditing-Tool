<?php
//to check which of the following fixes are checked
	
	/*
	  $collection = $_POST['collection'];
	  if(empty($collection))
	  {
		//nothing selected
	  }
	  else
	  {
		$n = count($collection);
		for($i=0; $i < $n; $i++)
		{
		  //collection has selected rules
		  echo $collection[$i];
		}
	  }
	  */
	  
	  $rules="";
	  $fixes="";

	if(isset($_POST['box']))
	    $a= $_POST['box'];
	
	  $flag=0;
	  $rules=$a;
	  //echo $rules;
	  /*echo $a;
	  foreach($a as $value)
	  {
		if($flag==1){
			$rules.=",".$value;
			echo $value;
		}
		else if($flag==0){
			$rules=$value;
			$flag=1;
			echo $value;
		}
		
	  }*/

	  //echo $rules;

	  //parse html and get the fixes
	  
	  //put it in the database
	  	mysql_connect("localhost","root","root");
	  	mysql_select_db("router");
		// checking for any error in connection
		
		$res=array();
		$hostname=$_POST['file'];
		//echo $hostname;
		mysql_query("INSERT INTO fix_router(router,issue) VALUES('".$hostname."','".$rules."');") or die(mysql_error());
		//echo "INSERT INTO fix_router(router,issue) VALUES('".$hostname."','".$rules."')";
		//echo $result;
		
		
		//redirect to the ticketing system.
		//require('pusher-php-server-master/lib/Pusher.php');
		//class MyLogger {
		//    public function log( $msg ) {
		//        print_r( $msg . "<br/><br/>" );
		 //   }
		//}

		//$app_id = '62443';
		//$key = 'c17f5ceb1653f22b7f6e';
		//$secret = '425dec22eb7c68ac55e4';
		//$pusher = new Pusher($key, $secret, $app_id, true );
		//$pusher->set_logger( new MyLogger() );

		//$pusher->trigger('screen3', 'ticketing_event', array( 'message' => 'hello world', 'router' => $_POST['file']));
		
	  	//header('Location:http://localhost/solo_rv/incident_management_system_new_regex_demo_purpose/index.php/dashboard/ticket', '_blank');
	  	echo 1;
?>