<?php
/*
This script fills all the rules in database and then  add comma separated router names according to the failed rules.
RUN THIS SCRIPT ONLY ONCE.
May take a log time depending on the number of rules
*/

$rules=array("1.1.1.1 - Require AAA Service","1.1.2.3 - Require Timeout for vty Login Sessions","1.1.1.2 - Require AAA Authentication for Login","1.1.1.3 - Require AAA Authentication for Enable Mode","1.1.1.4 - Require AAA Authentication for Local Console and VTY Lines","1.1.2.1 - Require Privilege Level 1 for Local Users","1.1.2.2 - Require VTY Transport SSH","1.1.2.3 - Require Timeout for vty Login Sessions","1.1.2.4 - Forbid Auxiliary Port","1.1.2.5 - Require VTY ACL","1.1.2.6 - Require VTY ACL","1.1.2.7 - Require Timeout for con line Login Sessions","1.1.2.8 - Require Timeout for Aux Line Login Sessions","1.1.3.1 - Require EXEC Banner","1.1.3.2 - Require Login Banner","1.1.3.3 - Require MOTD Banner","1.1.3.4 - Disable Telnet Banner","1.1.4.1 - Require Enable Secret","1.1.4.2 - Require Password Encryption Service","1.1.4.3 - Weak password encryption should not be used","1.1.4.4 - Require Encrypted User Passwords","1.1.4.5 - Disable weak password encryption","1.1.4.6 - Forbid use of default user names","1.1.5.10 - Require Group for SNMPv3 Access","1.1.5.11 - Require AES128 or Better Encryption for SNMPv3 Access","1.1.5.12 - Configure atleast one trap source for SNMP","1.1.5.2 - Forbid SNMP Community String private","1.1.5.3 - Forbid SNMP Community String public","1.1.5.4 - Forbid SNMP Write Access","1.1.5.5 - Forbid SNMP without ACL","1.1.5.1 - Forbid SNMP Read and Write Access","1.1.5.6 - Require a Defined SNMP ACL","1.1.5.7 - Forbid SNMP Traps","1.1.5.8 - Require SNMP Trap Server When Using SNMP","1.1.5.9 - Allow SNMP Traps on When SNMP Trap Server Defined","1.2.1.1 - Require Clock Timezone - UTC","1.2.1.2 - Forbid Daylight Savings Time Clock Adjustments","1.2.1.3.1 - Setup Local Time Zone","1.2.1.3.2 - Set Daylight Savings Dates","1.2.1.3.3 - Set Daylight Savings Recurrence","1.2.2.1.1.1 - Configure the Host Name","1.2.2.1.1.2 - Configure the Domain Name","1.2.2.1.1.3 - Generate the RSA Key Pair","1.2.2.1.1.4 - Generate the SSH Timeout","1.2.2.1.1.5 - Limit the Number of SSH Authentication Tries","1.2.2.1.2 - Require SSH version 2","1.2.2.10 - Require TCP keepalives-out Service","1.2.2.11 - Forbid tcp-small-servers","1.2.2.12 - Forbid udp-small-servers","1.2.2.13 - Required No TFTP Server","1.2.2.13 - Forbid TFTP Server","1.2.2.14 - Forbid PAD Service","1.2.2.15 - Syn Wait time should be set to 10 Seconds.","1.2.2.2 - Forbid CDP Run Globally","1.2.2.3 - Forbid Finger Service - IOS 12.0","1.2.2.3 - Forbid Finger Service - IOS 12.1,2,3,4","1.2.2.4 - Forbid IP BOOTP server","1.2.2.5 - Forbid IP HTTP Server","1.2.2.6 - Forbid Identification Service","1.2.2.7 - Forbid HTTP Services","1.2.2.8 - Forbid Remote Startup Configuration","1.2.2.9 - Require TCP keepalives-in Service","1.2.3.1 - Require System Logging","1.2.3.2 - Require Logging Buffer","1.2.3.3 - Disable Logging to Device Console","1.2.3.4 - Require Logging to Syslog Server","1.2.3.5 - Require Logging Trap Severity Level","1.2.3.6 - Require Service Timestamps for Debug Messages","1.2.3.7 - Require Service Timestamps in Log Messages","1.2.3.8 - Require Binding Logging Service to Interface","1.2.4.1 - Require External Time Source","1.2.4.2.1 - Enable NTP Authentication","1.2.4.2.2 - Define NTP Key Ring and Encryption Key","1.2.4.2.3 - Define the NTP Trusted Key","1.2.4.2.4 - Bind the NTP Key Ring to each NTP server","1.3.1.1 - Forbid Directed Broadcast","1.3.1.2 - Forbid IP source-route","2.1.1.1 - Require AAA Authentication Enable","2.1.1.2 - Require AAA Authentication Login","2.1.1.3 - Require AAA Accounting Commands","2.1.1.4 - Require AAA Accounting Connection","2.1.1.5 - Require AAA Accounting Exec","2.1.1.6 - Require AAA Accounting Network","2.1.1.7 - Require AAA Accounting System","2.2.1.1 - Require Loopback Interface","2.2.1.2 - Forbid Multiple Loopback Interfaces","2.2.1.3 - Require Binding AAA Service to Loopback Interface","2.2.1.4 - Require Binding NTP Service to Loopback Interface","2.2.1.5 - Require Binding TFTP Service to Loopback Interface","2.3.1.1.1 - Apply Inbound Border ACL on External Interface","2.3.1.2 - Forbid External Source Addresses on Outbound Traffic","2.3.1.2.1 - Forbid External Source Addresses on Outbound Traffic","2.3.2.2 - Require BGP Authentication if Protocol is Used","2.3.2.3 - Require EIGRP Authentication if Protocol is Used","2.3.2.3.1 - Establish the EIGRP Address Family","2.3.2.3.2 - Establish the EIGRP Address Family Key Chain","2.3.2.3.3 - Establish the EIGRP Address Family Authentication Mode","2.3.2.3.4 - Configure the Interface with the EIGRP Key Chain","2.3.2.3.5 - Configure the Interface with the EIGRP Authentication Mode","2.3.2.4.1 - Require the Message Digest for OSPF","2.3.2.4.2 - Configure the Interface for Message Digest Authentication","2.3.2.5.1 - Configure the Interface with the RIPv2 Key Chain","2.3.2.5.2 - Configure the Interface with the RIPv2 Authentication Mode","2.3.3.1.1 - Enable Cisco Express Forwarding CEF","2.3.3.1.2 - Enable Unicast Reverse-Path Forwarding uRPF","2.3.3.2 - Forbid IP Proxy ARP","2.3.3.3 - Forbid Tunnel Interfaces","2.3.1.1 - Forbid Private Source Addresses from External Networks");


// Create connection
	$con=mysqli_connect("localhost:3306","root","","routerdemo");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
foreach($rules as $rule1){
$sql="INSERT INTO rules(rule) VALUES('$rule1')";
					if (!mysqli_query($con,$sql))
					{
						die('Error: ' . mysqli_error($con));
					}			
}

foreach(glob("REPS/*.html") as $file) {
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile($file);
  $table=$dom->getElementsByTagName('table');
  $table1 = $table->item(0);
  $i=0;
  $val=0;
  $fail=0;
  $cumweight=0;
  foreach($table1->childNodes as $node){				//array traversing over rules
	if($node->childNodes->item(2)->nodeValue=="FAIL"){
		$key=array_search($node->childNodes->item(4)->nodeValue,$rules);
		$sql="SELECT routers FROM rules WHERE rule='".$rules[$key]."'";
						
						if (!mysqli_query($con,$sql))
						{
							die('Error: ' . mysqli_error($con));
						}
		while($row = mysqli_fetch_array($result,MYSQL_BOTH))
		{
			$routers=$row['routers'];
		}				
		if($routers==null){
		$routers=substr($file,17,-9);
		}
		else{
			$dummyarray=explode(",",$routers);
			if(in_array(substr($file,17,-9), explode(",",$routers))){
			}
			else{
			$routers.=",".substr($file,17,-9);
			}
		}
		$sql="UPDATE rules SET routers='".$routers."' WHERE rule='".$rules[$key]."'";
						
						if (!mysqli_query($con,$sql))
						{
							die('Error: ' . mysqli_error($con));
						}			
		
	}
  }	
}
mysqli_close($con);
?>