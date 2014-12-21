<?php 

//copy the initial configurations in REPS and test.json
//$shell_result_output = shell_exec("copy InitialData REPS");
//shell_exec("sudo chmod -R 777 /var/www/myrouter/REPS/");
//copy("InitialData/test.json","data/test.json");
//copy("InitialData/test.json","data/test35.json");

//Code is poetry
shell_exec("sudo rm -rf /var/www/myrouter/REPS/*");
shell_exec("sudo rm -rf /var/www/myrouter/data/*");
$shell_result_output = shell_exec("cp -r InitialData/*.* REPS/");
shell_exec("sudo chmod -R 777 /var/www/myrouter/REPS/");
copy("InitialData/test.json","data/test.json");
copy("InitialData/test35.json","data/test35.json");
shell_exec("sudo chmod -R 777 /var/www/myrouter/data/");


$con=mysqli_connect("localhost","root","root","router");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="delete from host";
$result=mysqli_query($con,$sql);

$sql="insert into host select * from host_original";
$result=mysqli_query($con,$sql);

$sql="delete from score";
$result=mysqli_query($con,$sql);

$sql="insert into score select * from score_original";
$result=mysqli_query($con,$sql);

mysqli_close($con);

header( 'Location: http://localhost/solo_rv/myrouter');
?>


