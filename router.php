<!DOCTYPE html>
<html>
    <?php
    define("IP", "localhost/solo_rv");
    ?>
<head>
<style type="text/css" href="vendor/css/bootstrap.css"></style>
<script src="http://<?php echo IP; ?>/push/vendor/js/pusher2.1.js" type="text/javascript"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    /*Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };
    var router='';
 	var pusher = new Pusher('c17f5ceb1653f22b7f6e');
    var channel = pusher.subscribe('screen2');
    channel.bind('router_event', function(data) 
    {
      //alert(data.message+data.router);
      router=data.router;
      window.open("http://localhost/myrouter/router.php?file="+data.router,"_self");

    });*/
  </script>

<style>

body {
  margin: 0;
  font-family: Ubuntu, "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 20px;
  color: #333333;
  background-color: #ffffff;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 10px 0;
  font-family: inherit;
  font-weight: bold;
  line-height: 20px;
  color: inherit;
  text-rendering: optimizelegibility;
}
.mac {
  display: block;
  border: none;
  border-radius: 20px;
  padding: 5px 8px;
  color: #333;
  box-shadow: 
    inset 0 2px 0 rgba(0,0,0,.2), 
    0 0 4px rgba(0,0,0,0.1);
}

.mac:focus { 
  outline: none;
  box-shadow: 
    inset 0 2px 0 rgba(0,0,0,.2), 
    0 0 4px rgba(0,0,0,0.1),
    0 0 5px 1px #51CBEE;
}


a.button {
	width: 100%;
	height: 8% ;
	background: #333;
	display: block;
	position: relative;
	margin: 0px auto 0;
	overflow: hidden;
	border: 1px solid #333333;
	color: white;
	text-decoration: none;
	
	-webkit-box-shadow: inset 0px 1px 1px 0px rgba(255,255,255,.4);
	-moz-box-shadow: inset 0px 1px 1px 0px rgba(255,255,255,.4);
	box-shadow: inset 0px 1px 1px 0px rgba(255,255,255,.4);
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	
	
	-webkit-transition: all 0.2s ease;
	-moz-transition: all 0.2s ease;
	-ms-transition: all 0.2s ease;
	-o-transition: all 0.2s ease;
	transition: all 0.2s ease;
	
	background-image: -webkit-linear-gradient(bottom, #383838 0%, #444444 49%, #555 50%, #555 100%);
	background-image: -moz-linear-gradient(bottom, #383838 0%, #444444 49%, #555 50%, #555 100%);
	background-image: -ms-linear-gradient(bottom, #383838 0%, #444444 49%, #555 50%, #555 100%);
	background-image: -o-linear-gradient(bottom, #383838 0%, #444444 49%, #555 50%, #555 100%);
	background-image: linear-gradient(bottom, #383838 0%, #444444 49%, #555 50%, #555 100%);
}

a.button span.text {
	position: relative;
	top: 0px;
	left: 0px;
	font: 15px Arial;
}

a.button span.text1 {
	position: relative;
	top: 0px;
	left: 30%;
	font: 15px Arial;
}

a.button span.shine {
	content: '';
	position: absolute;
	height: 400px;
	width: 20px;
	background: white;
	top: -80px;
	left: -20px;
	display: block;
	opacity: 0.8;
	
	-webkit-box-shadow: 0px 0px 20px 10px white; 
	-moz-box-shadow: 0px 0px 20px 10px white; 
	box-shadow: 0px 0px 20px 10px white; 
	
	-webkit-transform: rotate(-45deg);	
	-moz-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	transform: rotate(-45deg);
	
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	-ms-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}
</style>
</head>
<?php
//echo $_SERVER['file'];

//echo $_GET['file'];

if(isset($_REQUEST['file']))
{
	$router_name=$_REQUEST['file'];
	mysql_connect("localhost", "root", "root") or die(mysql_error());
	//echo "Connected to MySQL<br />";
	mysql_select_db("router") or die(mysql_error());
	//echo "Connected to Database";

	// Get all the data from the "example" table
	$r = mysql_query("SELECT * FROM host WHERE hostname='".$router_name."'") 
	or die(mysql_error());  
	$result = mysql_fetch_array($r);

	
	$r2 = mysql_query("SELECT * FROM network WHERE hostname='".$router_name."'") 
	or die(mysql_error());  
	$result2 = mysql_fetch_array( $r2 );
}
else
echo "Not found";
?>
<body bgcolor="#f3f3f6">

<table border="2" cellpadding="0" cellspacing="0">
<col width="750">
<col width="750">

<!-Row 1-->
<tr>
<td colspan="2" ><button style="border: 1px solid darkgreen; width: 100%; background-color: green; border-radius: 4px; box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -o-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -webkit-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -moz-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; color: white; text-shadow: 1px 1px 1px black; padding: 0.3% 42%;"> <font size="4"> <?php echo $result[1];?><br></font></button></td>
</tr>

<tr>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Interface View </b></font></span>
</a>
</td>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Audit Status</b></font></span>
</a>
</td>
</tr>


<tr height="160">

<td>

<table border="0" cellpadding="0" cellspacing="0">
<col width="500">
<col width="250">

<tr>

<td>

<html>
 <head>
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Interfaces', 'Share %'],          
          ['Async', <?php echo $result[5];?>],
          ['Atm', <?php echo $result[6];?>],
          ['Bri', <?php echo $result[7];?>],
          ['Dialer', <?php echo $result[8];?>],
          ['EmbeddedServiceEngine', <?php echo $result[9];?>],
          ['Ethernet', <?php echo $result[10];?>],
          ['Fastethernet', <?php echo $result[11];?>],
          ['Gigabitethernet', <?php echo $result[12];?>],
          ['Gmpls', <?php echo $result[13];?>],
          ['Loopback', <?php echo $result[14];?>],
          ['Serial', <?php echo $result[15];?>],
          ['Tunnel', <?php echo $result[16];?>],
          ['Vlan', <?php echo $result[17];?>]
      ]);

        var options = {
          backgroundColor: '#f3f3f6',
          pieHole: 0.4,
          'is3D':true,
          'width':400,
          'height':200,
          slices: {  
             0: {offset: 0.3},        
             1: {offset: 0.3}, 
             2: {offset: 0.3}, 
             3: {offset: 0.3}, 
             4: {offset: 0.3}, 
             5: {offset: 0.3}, 
             6: {offset: 0.3}, 
             7: {offset: 0.3}, 
             8: {offset: 0.3}, 
             9: {offset: 0.3}, 
             10: {offset: 0.3}, 
             11: {offset: 0.3}, 
             12: {offset: 0.3}, 
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 75%; height: 100%;"></div>
  </body>
</html>

</td>

<td>


<head>
     <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Criticality',  <?php echo $result[19]; ?>]          
        ]);

        var options = {
          width: 150, height: 150,
          max: 10,
          yellowFrom: 4, yellowTo: 10,
          greenFrom:0, greenTo: 4,
          minorTicks: 2
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id='chart_div'></div>
  </body>


</td>

</tr>
</table>

</td>

<td>



	<?php
//this code parses the file on the server for the failed results and create a new html element.
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile("REPS/ACME-ROUTER-".$_GET['file'].".cfg.html");
  $dom->preserveWhiteSpace = false; 
  $tables = $dom->getElementsByTagName('table');
 if (!is_null($tables)) 
  {
	$counter1=0;
  $vals=array();
  foreach ($tables as $table) 
  {	
	if($counter1==1){
    $rows = $table->childNodes;
	echo '<table class="gradienttable" cellpadding>
	<col width="250">
	<col width="250">
	<col width="250">
	<tr>
		<th><p>Total Checks</p></th><th><p>Passed</p></th><th><p>Pass %</p></th>
	</tr>';
	$counter2=0;
    foreach ($rows as $row) 
	{
      if($counter2==2){
	  $cols= $row->childNodes;
			//condition for showing the result
			$i=0;
			
			 foreach($cols as $col){
				$vals[$i++]=$col->nodeValue;
			}
			echo '<tr align="center"><td><p>'.$vals[0].'</p></td><td><p>'.$vals[2].'</p></td><td><p>'.$vals[6].'</p></td></tr>';
			$counter2++;
		}
		else if($counter2==0 or $counter2==1){
			$counter2++;
		}
		else if ($counter2==3){
			break;
		}
	  
	}
	  $counter1++;
	}
	else if($counter1==0){
		$counter1++;
	}
	else if ($counter1==2){
		$rows = $table->childNodes;
		echo '<tr>
				<th><p>Perfect Weighted Score</p></th><th><p>Actual Weighted Score</p></th><th><p>Overall Score %</p></th>
			</tr>';
			$counter2=0;
			foreach ($rows as $row) 
			{
			  if($counter2==2){
			  $cols= $row->childNodes;
					//condition for showing the result
					$i=0;
					
					 foreach($cols as $col){
						$vals[$i++]=$col->nodeValue;
					}
					echo '<tr align="center"><td><p>'.$vals[0].'</p></td><td><p>'.$vals[2].'</p></td><td><p>'.$vals[4].'</p></td></tr>';
					$counter2++;
				}
				else if($counter2==0 or $counter2==1){
					$counter2++;
				}
				else if ($counter2==3){
					break;
				}
		  
		}
		$counter1++;
	}
	else if ($counter1==3){
		echo '</table>';
		break;
	}
	}
	}
	
?>

</td>
</tr>

<tr>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Network View </b></font></span>
</a>
</td>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Assessment Tool Report </b></span>
	
</a>

<script>
/*function myFunction()
{
document.getElementById("testForm").submit();
}*/
</script>

</td>
</tr>
<tr height="300">
<td>
<html>
    <head>
   
       <script language="javascript" type="text/javascript"  src="assets2/js/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="assets2/js/arbor.js" ></script>
        <script language="javascript" type="text/javascript" src="assets2/js/graphics.js" ></script>
        <script language="javascript" type="text/javascript" src="assets2/js/renderer.js" ></script>
        <link rel="stylesheet" href="assets2/css/estilos.css" type="text/css" charset="utf-8">
        
    </head>
  
 <body>
 <div id="rules-list" style="height:auto;width:auto;overflow:auto;">
    <canvas id="viewport" width="500" height="400" border=2px solid black></canvas>
      
      
  <?php
	$con=mysqli_connect("localhost","root","root","router");

	// checking for any error in connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$res=array();
	$hostname=$_GET['file'];
	$res[0]=$hostname;
	$result = mysqli_query($con,"SELECT destination,ip FROM network WHERE hostname='".$hostname."'");
	$result1 = mysqli_query($con,"SELECT destination,target FROM tunnelnetwork WHERE hostname='".$hostname."'");
	$i=1;
	while($row = mysqli_fetch_array($result,MYSQL_BOTH))
	  {
	  $res[$i++]=$row['destination'];
	  //echo $row['destination']."Hello";
	  }
	while($row = mysqli_fetch_array($result1,MYSQL_BOTH))
	  {
	  	$res[$i++]=$row['destination'];
	  
	  }
	 // mysql_free_result($result);
	  mysqli_close($con);
	  
	$json = json_decode(file_get_contents('data/test35.json'), true);
	$rat=array();
	$i=1;
	//define $res as array ccontaining all the neighbor hostname for a particular  
	
	
	foreach ($json as $key1 => $value1) {
		if((string)$key1=="nodes"){
			foreach ($value1 as $key2=>$value2) {
					if (in_array($value2['Hostname'],$res)){
						$rat[$value2['Hostname']]=$json[$key1][$key2]['RAT']; 
					}
					if($value2['Hostname']==$hostname){
						$rat[$hostname]=$json[$key1][$key2]['RAT'];
					}					
				}
			}
			break;
		}

?>

 
<script type="text/javascript">
function myFunction()
{
	//document.getElementById("testForm").submit();
	var xmlhttp='';
    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            if(xmlhttp.responseText==1)
            	window.open("http://<?php echo IP; ?>/incident_management_system_new_regex_demo_purpose/index.php/dashboard/ticket")
        }
    }
    $( "#progressbar" ).progressbar({
			  value: false
			});
    $( "#progressbar" ).removeAttr("style");

    xmlhttp.open("POST","rulesnfix.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var values = [];
    var a="";
	var vehicles = document.getElementsByName("box[]");
	for (var i=0, iLen=vehicles.length; i<iLen; i++) {
	    if (vehicles[i].checked) {
	      values.push(vehicles[i].value);
	     
	    }
	  }
    //alert("file="+document.getElementById("router_name").value+"&box="+values);
    
    xmlhttp.send("file="+document.getElementById("router_name").value+"&box="+values);	
    
}
</script> 
     
      <script language="javascript" type="text/javascript">
            //var sys = arbor.ParticleSystem(1000, 400,1);
            var sys = arbor.ParticleSystem(400, 1000,.5);
            sys.parameters({gravity:true});
            sys.renderer = Renderer("#viewport") ;
			 <?php
			    $r8 = mysql_query("SELECT * FROM host WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result8 = mysql_num_rows($r8);
			 
			 	$r4 = mysql_query("SELECT * FROM externallinks WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result4 = mysql_num_rows($r4);
				
				$r5 = mysql_query("SELECT * FROM network WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result5 = mysql_num_rows( $r5 );
				
				$r6 = mysql_query("SELECT * FROM tunnelnetwork WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result6 = mysql_num_rows( $r6 );
				
				$r7 = mysql_query("SELECT * FROM externallinks2 WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result7 = mysql_num_rows($r7);
				
			 ?>	
			
            var data = {
               nodes:{	
				<?php 
						
                 if($result8>=1){
				while($row = mysql_fetch_row($r8)){
				//echo $row[1];
				$color="";
				if ($rat[$row[1]]=="pass") $color='green'; else $color='red';
				echo "1:{'tipo':'".$color."','shape':'dot','label':'".$row[1]."'}, ";         
				}				
		        }						
               				
				$i=2;
				if($result5>=1){
				while($row = mysql_fetch_row($r5)){
				//echo $row[1];
				$color="";
				if ($rat[$row[2]]=="pass") $color='green'; else $color='red';
				echo $i++.":{'tipo':'".$color."','shape':'dot','label':'".$row[2]."'}, ";         
				}				
		        }
				 if($result6>=1){
				//$i=2;
				while($row = mysql_fetch_row($r6)){
				//echo $row[1];
				$color="";
				if ($rat[$row[3]]=="pass") $color='green'; else $color='red';
				echo $i++.":{'tipo':'".$color."','shape':'dot','label':'".$row[3]."'}, ";         
				}				
		        }
				
				 if($result4>=1){
				//$i=3;
				while($row = mysql_fetch_row($r4)){
				//echo $row[1];
				//echo "hello";
		        echo $i++.":{'tipo':'orange','shape':'','label':'External Link'},"; 
				}
		        }
				
				if($result7>=1){
				//$i=3;
				while($row = mysql_fetch_row($r7)){
				//echo $row[1];
				//echo "hello";
		        echo $i++.":{'tipo':'orange','shape':'','label':'External Link'},"; 
				}
		        }
				
			 ?>
			 },
			  <?php
			 	$r4 = mysql_query("SELECT * FROM externallinks WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result4 = mysql_num_rows($r4);
				
				$r5 = mysql_query("SELECT * FROM network WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result5 = mysql_num_rows( $r5 );
				
				$r6 = mysql_query("SELECT * FROM tunnelnetwork WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result6 = mysql_num_rows( $r6 );
				
				$r7 = mysql_query("SELECT * FROM externallinks2 WHERE hostname='".$router_name."'") 
				or die(mysql_error());  
				$result7 = mysql_num_rows($r7);
				
			 ?>	
			
               edges:{

                 1:{ 
				    				
				<?php	
				$i=2;
				if($result5>=1){                		
                 while($row = mysql_fetch_row($r5)){
					//echo '<strong>'.$row[2].'</strong>';
				echo  $i++.":{'weight':1, 'directed':false, 'desc':'Desc:".$row[3]."', 'neigh_ip': 'Neighbour_IP:".$row[1]."' }, ";	}
				 }
				 
				 if($result6>=1){
                //$i=2;		
                 while($row = mysql_fetch_row($r6)){
					//echo '<strong>'.$row[2].'</strong>';
				echo  $i++.":{'weight':1, 'directed':false, 'desc':'Desc:".$row[2]."', 'neigh_ip': 'Neighbour_IP:".$row[1]."' }, ";	}
				 }
				 
				 if($result4>=1){
                //$i=3;		
                 while($row = mysql_fetch_row($r4)){
					//echo '<strong>'.$row[2].'</strong>';					
					echo  $i++.":{'weight':1, 'directed':false, 'desc':'Desc:".$row[1]."', 'neigh_ip': 'Neighbour_IP:".$row[2]."' }, ";	}
				 }
				 
				 if($result7>=1){
                //$i=3;		
                 while($row = mysql_fetch_row($r7)){
					//echo '<strong>'.$row[2].'</strong>';					
					echo  $i++.":{'weight':1, 'directed':false, 'desc':'Desc:".$row[1]."', 'neigh_ip': 'Neighbour_IP:".$row[2]."' }, ";	}
				 }
				 
				 ?>
				},    
               }
             };             
            sys.graft(data);         
      </script>
      </div>
    </body>
</html>

</td>

<td>
<div style="width: 100%;height: 100%;margin: 0;padding: 0;overflow: auto;">
<html>
<style type="text/css">
	table {
  max-width: 100%;
  background-color: transparent;
  border-collapse: collapse;
  border-spacing: 0;
}

.table {
  width: 100%;
  margin-bottom: 20px;
}

.table th,
.table td {
  padding: 8px;
  line-height: 20px;
  text-align: left;
  vertical-align: top;
  border-top: 1px solid #dddddd;

}

.table th {
  font-weight: bold;
}

.table thead th {
  vertical-align: bottom;
}

.table caption + thead tr:first-child th,
.table caption + thead tr:first-child td,
.table colgroup + thead tr:first-child th,
.table colgroup + thead tr:first-child td,
.table thead:first-child tr:first-child th,
.table thead:first-child tr:first-child td {
  border-top: 0;
}

.table tbody + tbody {
  border-top: 2px solid #dddddd;
}

.table .table {
  background-color: #ffffff;
}

.table-condensed th,
.table-condensed td {
  padding: 4px 5px;
}

.table-bordered {
  border: 1px solid #dddddd;
  border-collapse: separate;
  *border-collapse: collapse;
  border-left: 0;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}

.table-bordered th,
.table-bordered td {
  border-left: 1px solid #dddddd;
}

.table-bordered caption + thead tr:first-child th,
.table-bordered caption + tbody tr:first-child th,
.table-bordered caption + tbody tr:first-child td,
.table-bordered colgroup + thead tr:first-child th,
.table-bordered colgroup + tbody tr:first-child th,
.table-bordered colgroup + tbody tr:first-child td,
.table-bordered thead:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child td {
  border-top: 0;
}

.table-bordered thead:first-child tr:first-child > th:first-child,
.table-bordered tbody:first-child tr:first-child > td:first-child,
.table-bordered tbody:first-child tr:first-child > th:first-child {
  -webkit-border-top-left-radius: 4px;
          border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
}

.table-bordered thead:first-child tr:first-child > th:last-child,
.table-bordered tbody:first-child tr:first-child > td:last-child,
.table-bordered tbody:first-child tr:first-child > th:last-child {
  -webkit-border-top-right-radius: 4px;
          border-top-right-radius: 4px;
  -moz-border-radius-topright: 4px;
}

.table-bordered thead:last-child tr:last-child > th:first-child,
.table-bordered tbody:last-child tr:last-child > td:first-child,
.table-bordered tbody:last-child tr:last-child > th:first-child,
.table-bordered tfoot:last-child tr:last-child > td:first-child,
.table-bordered tfoot:last-child tr:last-child > th:first-child {
  -webkit-border-bottom-left-radius: 4px;
          border-bottom-left-radius: 4px;
  -moz-border-radius-bottomleft: 4px;
}

.table-bordered thead:last-child tr:last-child > th:last-child,
.table-bordered tbody:last-child tr:last-child > td:last-child,
.table-bordered tbody:last-child tr:last-child > th:last-child,
.table-bordered tfoot:last-child tr:last-child > td:last-child,
.table-bordered tfoot:last-child tr:last-child > th:last-child {
  -webkit-border-bottom-right-radius: 4px;
          border-bottom-right-radius: 4px;
  -moz-border-radius-bottomright: 4px;
}

.table-bordered tfoot + tbody:last-child tr:last-child td:first-child {
  -webkit-border-bottom-left-radius: 0;
          border-bottom-left-radius: 0;
  -moz-border-radius-bottomleft: 0;
}

.table-bordered tfoot + tbody:last-child tr:last-child td:last-child {
  -webkit-border-bottom-right-radius: 0;
          border-bottom-right-radius: 0;
  -moz-border-radius-bottomright: 0;
}

.table-bordered caption + thead tr:first-child th:first-child,
.table-bordered caption + tbody tr:first-child td:first-child,
.table-bordered colgroup + thead tr:first-child th:first-child,
.table-bordered colgroup + tbody tr:first-child td:first-child {
  -webkit-border-top-left-radius: 4px;
          border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
}

.table-bordered caption + thead tr:first-child th:last-child,
.table-bordered caption + tbody tr:first-child td:last-child,
.table-bordered colgroup + thead tr:first-child th:last-child,
.table-bordered colgroup + tbody tr:first-child td:last-child {
  -webkit-border-top-right-radius: 4px;
          border-top-right-radius: 4px;
  -moz-border-radius-topright: 4px;
}

.table-striped tbody > tr:nth-child(odd) > td,
.table-striped tbody > tr:nth-child(odd) > th {
  background-color: #f9f9f9;
}

.table-hover tbody tr:hover > td,
.table-hover tbody tr:hover > th {
  background-color: #f5f5f5;
}

table td[class*="span"],
table th[class*="span"],
.row-fluid table td[class*="span"],
.row-fluid table th[class*="span"] {
  display: table-cell;
  float: none;
  margin-left: 0;
}

.table td.span1,
.table th.span1 {
  float: none;
  width: 44px;
  margin-left: 0;
}

.table td.span2,
.table th.span2 {
  float: none;
  width: 124px;
  margin-left: 0;
}

.table td.span3,
.table th.span3 {
  float: none;
  width: 204px;
  margin-left: 0;
}

.table td.span4,
.table th.span4 {
  float: none;
  width: 284px;
  margin-left: 0;
}

.table td.span5,
.table th.span5 {
  float: none;
  width: 364px;
  margin-left: 0;
}

.table td.span6,
.table th.span6 {
  float: none;
  width: 444px;
  margin-left: 0;
}

.table td.span7,
.table th.span7 {
  float: none;
  width: 524px;
  margin-left: 0;
}

.table td.span8,
.table th.span8 {
  float: none;
  width: 604px;
  margin-left: 0;
}

.table td.span9,
.table th.span9 {
  float: none;
  width: 684px;
  margin-left: 0;
}

.table td.span10,
.table th.span10 {
  float: none;
  width: 764px;
  margin-left: 0;
}

.table td.span11,
.table th.span11 {
  float: none;
  width: 844px;
  margin-left: 0;
}

.table td.span12,
.table th.span12 {
  float: none;
  width: 924px;
  margin-left: 0;
}

.table tbody tr.success > td {
  background-color: #dff0d8;
}

.table tbody tr.error > td {
  background-color: #f2dede;
}

.table tbody tr.warning > td {
  background-color: #fcf8e3;
}

.table tbody tr.info > td {
  background-color: #d9edf7;
}

.table-hover tbody tr.success:hover > td {
  background-color: #d0e9c6;
}

.table-hover tbody tr.error:hover > td {
  background-color: #ebcccc;
}

.table-hover tbody tr.warning:hover > td {
  background-color: #faf2cc;
}

.table-hover tbody tr.info:hover > td {
  background-color: #c4e3f3;
}
.btn-primary {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #006dcc;
  *background-color: #0044cc;
  background-image: -moz-linear-gradient(top, #0088cc, #0044cc);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
  background-image: -webkit-linear-gradient(top, #0088cc, #0044cc);
  background-image: -o-linear-gradient(top, #0088cc, #0044cc);
  background-image: linear-gradient(to bottom, #0088cc, #0044cc);
  background-repeat: repeat-x;
  border-color: #0044cc #0044cc #002a80;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-danger {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #da4f49;
  *background-color: #bd362f;
  background-image: -moz-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#bd362f));
  background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: -o-linear-gradient(top, #ee5f5b, #bd362f);
  background-image: linear-gradient(to bottom, #ee5f5b, #bd362f);
  background-repeat: repeat-x;
  border-color: #bd362f #bd362f #802420;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffee5f5b', endColorstr='#ffbd362f', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-danger:hover,
.btn-danger:focus,
.btn-danger:active,
.btn-danger.active,
.btn-danger.disabled,
.btn-danger[disabled] {
  color: #ffffff;
  background-color: #bd362f;
  *background-color: #a9302a;
}

.btn-danger:active,
.btn-danger.active {
  background-color: #942a25 \9;
}

.btn-success {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #5bb75b;
  *background-color: #51a351;
  background-image: -moz-linear-gradient(top, #62c462, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
  background-image: -o-linear-gradient(top, #62c462, #51a351);
  background-image: linear-gradient(to bottom, #62c462, #51a351);
  background-repeat: repeat-x;
  border-color: #51a351 #51a351 #387038;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}
.btn-large {
  padding: 11px 19px;
  font-size: 17.5px;
  -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
}

.btn-large [class^="icon-"],
.btn-large [class*=" icon-"] {
  margin-top: 4px;
}

.btn-lg {
padding: 10px 16px;
font-size: 18px;
line-height: 1.33;
border-radius: 6px;
}

.btn-small {
  padding: 8px 10px;
  font-size: 15px;
  -webkit-border-radius: 3px;
     -moz-border-radius: 3px;
          border-radius: 3px;
}

.btn-small [class^="icon-"],
.btn-small [class*=" icon-"] {
  margin-top: 0;
}
div.scrollable {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: auto;
}

	table.gradienttable th {
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d5e3e4', endColorstr='#b3c8cc',GradientType=0 );
		position: relative;
		z-index: -1;
	}
	table.gradienttable td {
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebecda', endColorstr='#ceceb7',GradientType=0 );
		position: relative;
		z-index: -1;
	}

table.gradienttable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.gradienttable th {
	padding: 0px;
	background: #d5e3e4;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Q1ZTNlNCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQwJSIgc3RvcC1jb2xvcj0iI2NjZGVlMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNiM2M4Y2MiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #d5e3e4 0%, #ccdee0 40%, #b3c8cc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d5e3e4), color-stop(40%,#ccdee0), color-stop(100%,#b3c8cc));
	background: -webkit-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: -o-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: -ms-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: linear-gradient(to bottom,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	border: 1px solid #999999;
}
table.gradienttable td {
	padding: 0px;
	background: #ebecda;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ViZWNkYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQwJSIgc3RvcC1jb2xvcj0iI2UwZTBjNiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjZWNlYjciIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #ebecda 0%, #e0e0c6 40%, #ceceb7 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ebecda), color-stop(40%,#e0e0c6), color-stop(100%,#ceceb7));
	background: -webkit-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: -o-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: -ms-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: linear-gradient(to bottom,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	border: 1px solid #999999;
}
table.gradienttable th p{
	margin:0px;
	padding:8px;
	border-top: 1px solid #eefafc;
	border-bottom:0px;
	border-left: 1px solid #eefafc;
	border-right:0px;
}
table.gradienttable td p{
	margin:0px;
	padding:8px;
	border-top: 1px solid #fcfdec;
	border-bottom:0px;
	border-left: 1px solid #fcfdec;;
	border-right:0px;
}

</style>

</head>
<body>

<?php
$hostname=$_GET['file'];
echo "<form>";
?>
<input type="hidden" id="router_name" value="<?php echo $hostname; ?>"/>
<?php
//this code parses the file on the server for the failed results and create a new html element.
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTMLFile("REPS/ACME-ROUTER-".$_GET['file'].".cfg.html");
$dom->preserveWhiteSpace = false; 
$tables = $dom->getElementsByTagName('table');
$failed=0;
$count=0;
if (!is_null($tables)) 
{
	foreach ($tables as $table) 
	{	
		$vals=array();
		$rows = $table->childNodes;
		$once=0;
		$j=1;
		foreach ($rows as $row) 
		{
			$cols= $row->childNodes;
			$flag=0;
			$i=0;
			$flag2=0;
			foreach($cols as $col){
			$vals[$i++]=$col->nodeValue;

			//the second <tr> has pass or fail results
			//cheking this result and pass the failed results
			if($col->nodeValue=="FAIL")
			{
				//condition for showing the result
				$failed=1;
				$flag=1;
			}	
		}
		if ($failed==1 && $count==0)
		{
			$count=1;
			echo "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Router is not compliant with standards.&nbsp;&nbsp;&nbsp;&nbsp;<img src='vendor/wrong.png' height='50px'/></strong><br/>";
			echo '<link rel="stylesheet" href="vendor/css/jquery-ui.css">
			  <script src="vendor/js/jquery-1.9.1.js"></script>
			  <script src="vendor/js/jquery-ui.js"></script>
			</head>
			<body>
			 <style>
			  .ui-progressbar {
			    position: relative;
			  }
			  .progress-label {
			    position: absolute;
			    left: 50%;
			    top: 4px;
			    font-weight: bold;
			    text-shadow: 1px 1px 0 #fff;
			  }
			  </style><br/>
			<div id="progressbar" style="display:none;"><div class="progress-label">Fixing...</div></div>';

			echo "<br/><table class=\"table table-striped\" ><tr><th>Rule</th><th>Fix</th><th>Desc</th></tr>";
		}
		if(count($vals)>3)
		$a=str_replace(' ','',$vals[4]);
			if($flag==1 and $once!=0)
			{				
				//create new html for failed results
				echo '<tr class="danger"><td>'.$j.'</td><td><input type="checkbox" checked name="box[]" id="box[]" value="'.$vals[4].'"></td><td><a target="_blank" style="color:red;" href="rules.html#'.$a.'">'.$vals[4].'</a></input></td></tr>';
				$once+=1;
				$j=$j+1;
			}
			else if($flag==1 and $once==0)
			{			
				echo '<tr class="danger"><td>'.$j.'</td><td><input type="checkbox" checked name="box[]" id="box[]" value="'.$vals[4].'"></td><td><a target="_blank" style="color:red;" href="rules.html#'.$a.'">'.$vals[4].'</a></input></td></tr>';
				$j=$j+1;
				$once+=1;
			}
		}
		break;
	}
}

if ($failed==0)
{	
	
	echo "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Router is compliant with standards.<img src='vendor/Ok-icon.png'/></strong>";
	echo "</table>";
}
else
{
	echo '<tr><td></td><td><button onclick="myFunction()"; type="button" class="btn btn-success btn-small">Resolve</button></td><td><button type="reset" class="btn btn-danger btn-small">Reset</button></td></tr>';
echo "</table></form>";
}
?>

</body>
</html>
</div>
</td>
</tr>
</table>
<body>
<html>