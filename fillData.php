<?php
	// Create connection
	$con=mysqli_connect("localhost:3306","root","","routerdemo");

	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	echo "<strong>The script is running.....</strong>";
	foreach(glob("YBL-ROUTER-YBLUP-MODI-S1/*.cfg") as $file) {
		$txt=file_get_contents($file);
		$rows= explode("\n",$txt);
		$flag1=0;
		$flag2=0;
		$i;
		$var=array();
		$acl_name="";
		$neighbor="";
		$hostname;
		$description="";
		foreach($rows as $row)
		{	
			if(preg_match("/^interface.*/",$row)){
			$flag1=1;
				$var[0]="Not defined";
				$var[1]="Not defined";
				$var[2]=0;
				$var[3]="Not defined";
				$var[4]="Not defined";
				$var[5]="Not defined";
				$var[6]="Not defined";
				$var[7]="Not defined";
				$var[0]=explode(" ",$row)[1];
			}
			else if(preg_match("/^ description.*/",$row)){
				$var[1]=substr($row,strpos($row," ",10)+1);
			}
			else if(preg_match("/^ bandwidth.*/",$row)){
				$var[2]=explode(" ",$row)[2];
			}
			else if(preg_match("/^ ip address.*/",$row)){
				$var[3]=explode(" ",$row)[3];
			}
			else if(preg_match("/^ ip access-group.*/",$row)){
				$var[4]=explode(" ",$row)[3];
			}
			else if(preg_match("/^ tunnel source.*/",$row)){
				$var[5]=explode(" ",$row)[3];
			}
			else if(preg_match("/^ tunnel destination.*/",$row)){
				$var[6]=explode(" ",$row)[3];
			}
			else if(preg_match("/^ crypto map.*/",$row)){
				$var[7]=$row;
			}
			else if(preg_match("/^hostname.*/",$row)){
					//insert
					
					$hostname=explode(" ",$row)[1];
					$sql="INSERT INTO host(hostname) VALUES('$hostname')";
					if (!mysqli_query($con,$sql))
					{
						echo "host";
						die('Error: ' . mysqli_error($con));
					}					
			}
			else if(preg_match("/^router.*/",$row)){
				$protocol=explode(" ",$row)[1]." ".explode(" ",$row)[2];
			}
			else if(preg_match("/^ neighbor.*/",$row)){
			$flag2=1;
				if(strcmp($neighbor,explode(" ",$row)[2])!=0 and $neighbor!=""){
				//insert neighbor details in the database

						$sql="INSERT INTO neighbor (neighbor_ip,description,hostname,protocol) VALUES('$neighbor','$description','$hostname','$protocol')";
						if (!mysqli_query($con,$sql))
						{
							echo "neighbor";
							die('Error: ' . mysqli_error($con));
						}
					$description="";
 				}
					$neighbor=explode(" ",$row)[2];
					if($description==""){
						//for first description of the new neighbor
						$description =substr($row,strpos($row," ",15)+1);
					}
					else{
						
						//appending on description as comma seperated string
						$description .=",".substr($row,strpos($row," ",15)+1);
						
					}
			}
			else if(preg_match("/^ no auto-summary.*/",$row)){
				if($flag2==1){
						//insert neighbor details in the database

						$sql="INSERT INTO neighbor (neighbor_ip,description,hostname,protocol) VALUES('$neighbor','$description','$hostname','$protocol')";
						if (!mysqli_query($con,$sql))
						{
							echo "neighbor";
							die('Error: ' . mysqli_error($con));
						}						
				}
			}
			else if(preg_match("/^ip access-list.*/",$row)){
				$acl_name=explode(" ",$row)[3];
				$acl_type=explode(" ",$row)[2];
				$flag3=1;
			}
			else if(preg_match("/^ip access-list.*/",$row)){
				//enter the previous values
				
				$acl_name=explode(" ",$row)[3];
				$acl_type=explode(" ",$row)[2];
				$acl_access="Not defined";
				$acl_mode="Not defined";
				$acl_ip="Not defined";
			}
			else if(preg_match("/^ permit.*/",$row)){
				$acl_access=explode(" ",$row)[1];
				$acl_mode=explode(" ",$row)[2];
				$acl_ip=substr($row,strpos($row," ",10)+1);
				
				//insert permit details in the database
				
						$sql="INSERT INTO acl (hostname,name,no,access,type,ip,mode)
						VALUES('$hostname','$acl_name','Not Defined','$acl_access','$acl_type','$acl_ip','$acl_mode')";
						
						if (!mysqli_query($con,$sql))
						{
							echo "acl";
							die('Error: ' . mysqli_error($con));
						}				
			}
			else if(preg_match("/^ deny.*/",$row)){
				$acl_access=explode(" ",$row)[1];
				$acl_mode=explode(" ",$row)[4];
				$acl_ip=substr($row,strpos($row," ",9)+1);
				
				//insert permit details in the database

						$sql="INSERT INTO acl (hostname,name,no,access,type,ip,mode)
						VALUES('$hostname','$acl_name','Not Defined','$acl_access','$acl_type','$acl_ip','$acl_mode')";
						if (!mysqli_query($con,$sql))
						{
							echo "acl";
							die('Error: ' . mysqli_error($con));
						}				
				
			}
			else if(preg_match("/^!$/",$row)){
			if($flag1==1){
				//insert interface details in the database
				
					$sql="INSERT INTO interface(hostname,type,description,bandwidth,ip,acl,source,target,crypto_map)VALUES('$hostname','$var[0]','$var[1]',$var[2],'$var[3]','$var[4]','$var[5]','$var[6]','$var[7]')";
					
					if (!mysqli_query($con,$sql))
					{
						echo "interface";
						die('Error: ' . mysqli_error($con));
					}
					
					$flag1=0;
				}
			}
		}
	}
	mysqli_close($con);
	echo "<strong>The script is finished.....</strong>";
	echo "Go to <strong>http://localhost/phpmyadmin/</strong> to check the data";
?>