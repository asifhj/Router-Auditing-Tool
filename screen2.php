
<!DOCTYPE html>
<html>

<style>
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

<body bgcolor="#f3f3f6">

<table border="2" cellpadding="0" cellspacing="0">
<col width="750">
<col width="750">

<tr>
<td colspan="2">
<a class="button">
	<span class="shine"></span>
	<span class="text"> <b>File Edit View Help </b></span>
</a>
</td>
</tr>

<tr>
<td colspan="2" ><button style="border: 1px solid darkgreen; width: 100%; background-color: green; border-radius: 4px; box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -o-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -webkit-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; -moz-box-shadow: inset 1px 6px 12px lightgreen, inset -1px -10px 5px darkgreen, 1px 2px 1px black; color: white; text-shadow: 1px 1px 1px black; padding: 0.3% 42%;"> <font size="4">DIAGNOSTIC CENTRE <br></font></button></td>

</tr>

<tr>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Interface View </b></span>
</a>
</td>
<td>
<a class="button">
	<span class="shine"> </span> <span class="text1"> <b>Router Audit Status </b>
	
	</span>
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
          ['Loopback',     11],
          ['Fast Ethernet',      2],
          ['Tunnel',  2]
        ]);

        var options = {
          backgroundColor: '#f3f3f6',
          pieHole: 0.4,
          'is3D':true,
          'width':400,
          'height':200,
          slices: {  
             0: {offset: 0.3},                                              
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
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Criticality', 3]          
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


	<style type="text/css">
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
	</style>

<style type="text/css">
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

<!---->
	
	<?php
//this code parses the file on the server for the failed results and create a new html element.
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile("REPS/YBL-ROUTER-".$_GET['file'].".cfg.html");
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
		echo '</table>';
		break;
	}
	}
	}
?>

<!---->


</td>
</tr>

<tr>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Network View </b></span>
</a>
</td>
<td>
<a class="button">
	<span class="shine"></span>
	<span class="text1"> <b>Router Assessment Tool Report </b></span>
	<p align="right"> <button onclick="myFunction()"; style="border: 1px solid darkred; background-color: red; border-radius: 4px; box-shadow: inset 1px 6px 12px lightred, inset -1px -10px 5px darkred, 1px 2px 1px black; -o-box-shadow: inset 1px 6px 12px lightred, inset -1px -10px 5px darkred, 1px 2px 1px black; -webkit-box-shadow: inset 1px 6px 12px lightred, inset -1px -10px 5px darkred, 1px 2px 1px black; -moz-box-shadow: inset 1px 6px 12px lightred, inset -1px -10px 5px darkred, 1px 2px 1px black; color: white; text-shadow: 1px 1px 1px black; padding: 5px 30px;">Resolve</button> </p> 
</a>
<!---->
<script>
function myFunction()
{
document.getElementById("testForm").submit();
}
</script>
<!---->

</td>
</tr>


<tr height="300">
<td>
<html>
<head>
	
	
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<script language="javascript" type="text/javascript" src="jquery-1.6.1.min.js"></script>
	
  <script language="javascript" type="text/javascript" src="arbor.js"></script>
  <script language="javascript" type="text/javascript" src="arbor-tween.js"></script>
  <script language="javascript" type="text/javascript" src="graphics.js"></script>
  
  <script language="javascript" type="text/javascript" src="renderer.js"></script>

</head>
<body>
  <canvas id="viewport" width="750" height="300" class=""></canvas>

  <!---->  
  <?php
	$con=mysqli_connect("localhost:3306","root","","router");

	// checking for any error in connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$res=array();
	$hostname=$_GET['file'];
	$result = mysqli_query($con,"SELECT destination,ip FROM network WHERE hostname='".$hostname."'");
	$i=0;
	while($row = mysqli_fetch_array($result,MYSQL_BOTH))
	  {
	  $res[$i++]=$row['destination'];
	  echo $row['destination']."Hello";
	  }
	 // mysql_free_result($result);
	  mysqli_close($con);
	  
	$json = json_decode(file_get_contents('data/test.json'), true);
	$rat=array();
	$i=1;
	//define $res as array ccontaining all the neighbor hostname for a particular  
	
	
	foreach ($json as $key1 => $value1) {
		if((string)$key1=="nodes"){
			foreach ($value1 as $key2=>$value2) {
					if (in_array($value2['Hostname'],$res)){
						$rat[$i++]=$json[$key1][$key2]['RAT']; 
					}
					if($value2['Hostname']==$hostname){
						$rat[0]=$json[$key1][$key2]['RAT'];
					}
					
				}
			}
			break;
		}
		//give $rat to shilpa
?>
<!---->
  <script language="javascript" type="text/javascript">

    var colour = {
      orange:"#EEB211",
      darkblue:"#21526a",
      purple:"#941e5e",
      limegreen:"#c1d72e",
      darkgreen:"#619b45",
      lightblue:"#009fc3",
      pink:"#d11b67",    
    }
    var data = {
      nodes:{
        ion:       {    'color':colour.orange, 'shape':'dot', 'radius':39,
                        'alpha':1 },
        innovation:{    'color':colour.darkgreen, 
                        'shape':'dot', 
                        'radius':30, 
                        'image': 'innovation.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 },
        participation:{ 'color':colour.darkgreen, 
                        'shape':'dot',
                        'radius':40, 
                        'image':'participation.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 },
       international:{  'color':colour.darkgreen,               
                        'shape':'dot',
                        'radius':35, 
                        'image':'international.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 },      
       collaboration:{  'color':colour.darkgreen,               
                        'shape':'dot',
                        'radius':22, 
                        'image':'collaboration.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 }, 
       facilitation:{   'color':colour.darkgreen,               
                        'shape':'dot',
                        'radius':47, 
                        'image':'facilitation.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 }, 
       solution:{       'color':colour.darkgreen,               
                        'shape':'dot',
                        'radius':33, 
                        'image':'solution.png',
                        'image_w':130,
                        'image_h':24,
                        'alpha':1 },          
       innovation1:{ 'label':'exploring,  imagining  and actioning new approaches', 
                     'color':colour.darkblue, 'alpha': 0 },    
       innovation2:{ 'label':'a community interest company supporting positive social change ', 
                     'color':colour.darkblue, 'alpha': 0 },      
       innovation3:{ 'label':'innovative learning projects and development services', 
                     'color':colour.darkblue, 'alpha': 0 },  
              
       participation1:{ 'label':'engaging people in discussion and dialogue to promote inclusion and cohesion',
                        'color':colour.purple, 'alpha': 0 },
       participation2:{ 'label':'creating opportunities for the most disadvantaged and disengaged sectors of our communities', 
                        'color':colour.purple, 'alpha': 0 },
       participation3:{ 'label':'projects and services proven to support  participation and engagement', 
                        'color':colour.purple, 'alpha': 0 },
              
       international1:{ 'label':'passionate about the big global issues being faced by urban areas',
                        'color':colour.limegreen, 'alpha': 0 }, 
       international2:{ 'label':'working across the UK and internationally ', 
                        'color':colour.limegreen, 'alpha': 0 }, 
       international3:{ 'label':'supporting learning, community development and cohesion', 
                        'color':colour.limegreen, 'alpha': 0 },     
                                            
       collaboration1:{ 'label':'working on the basis of partnership', 
                        'color':colour.darkgreen, 'alpha': 0 },
       collaboration2:{ 'label':'making connections and facilitating interaction and ideas', 
                        'color':colour.darkgreen, 'alpha': 0 },
       collaboration3:{ 'label':'bringing people together to share, collaborate and connect', 
                        'color':colour.darkgreen, 'alpha': 0 },
       collaboration4:{ 'label':'worked with thousands of children and young people, hundreds of schools, teachers and communities', 
                        'color':colour.darkgreen, 'alpha': 0 },
                                                                        
       facilitation1:{ 'label':'project inception, delivery, evaluation and completion', 
                       'color':colour.lightblue, 'alpha': 0 },
       facilitation2:{ 'label':'facilitating events and networks', 
                       'color':colour.lightblue, 'alpha': 0 },
       facilitation3:{ 'label':'developing and delivering training and evaluation', 
                       'color':colour.lightblue, 'alpha': 0 },
                                                                     
       solution1:{ 'label':'inspiration, reflection and action to support positive change', 
                   'color':colour.pink,'alpha': 0 },
       solution2:{ 'label':'a team of qualified teachers, youth workers, trainers, evaluators, mentors, artists and designers', 
                   'color':colour.pink,'alpha': 0 },
       solution3:{ 'label':'high quality, bespoke and flexible solutions', 
                   'color':colour.pink,'alpha': 0 },                                      
      },
      edges:{
        ion:{ innovation:{}, 
              participation:{}, 
              international:{}, 
              collaboration:{}, 
              facilitation:{}, 
              solution:{}  
        },
        innovation:{ innovation1:{}, innovation2:{}, innovation3:{} },
        participation:{ participation1:{}, participation2:{}, participation3:{} },
        international:{ international1:{}, international2:{}, international3:{} },
        collaboration:{ collaboration1:{}, collaboration2:{}, collaboration3:{},  collaboration4:{}  },
        facilitation:{ facilitation1:{}, facilitation2:{}, facilitation3:{}} ,
        solution:{ solution1:{}, solution2:{}, solution3:{} },
      }
    }
    
     // Initialise arbor
    var sys = arbor.ParticleSystem()
    sys.parameters({stiffness:900, repulsion:2000, gravity:false, dt:0.015})
    sys.renderer = Renderer("#viewport");
    sys.graft(data);
    /*
    var nav = Nav("#nav")
    $(sys.renderer).bind('navigate', nav.navigate)
    $(nav).bind('mode', sys.renderer.switchMode)
    nav.init()*/
  </script>
 
</body>
</html>
</td>
<td>
<html>
	<head>	
	<style class="csscreations">/*custom font for text*/
@import url(http://fonts.googleapis.com/css?family=Nunito);
/*CSS file for fontawesome - an iconfont we will be using. This CSS file imported contains the font-face declaration. More info: http://fortawesome.github.io/Font-Awesome/ */
@import url(http://thecodeplayer.com/uploads/fonts/fontawesome/css/font-awesome.min.css);

/*Basic reset*/
* {margin: 0; padding: 0;}

body {
	background: #f3f3f6;
	font-family: Nunito, arial, verdana;
}
#accordian {
	background: #004050;
	width: 100%;
	margin: 0px auto 0px auto;
	color: white;
	/*Some cool shadow and glow effect*/
	box-shadow: 
		0 5px 15px 1px rgba(0, 0, 0, 0.6), 
             	0 0 200px 1px rgba(255, 255, 255, 0.5);

}
/*heading styles*/
#accordian h3 {
	font-size: 13px;
	line-height: 34px;
	padding: 0 10px;
	cursor: pointer;
	/*fallback for browsers not supporting gradients*/
	background: #003040; 
	background: linear-gradient(#003040, #002535);
}
/*heading hover effect*/
#accordian h3:hover {
	text-shadow: 0 0 1px rgba(255, 255, 255, 0.7);
}
/*iconfont styles*/
#accordian h3 span {
	font-size: 16px;
	margin-right: 10px;
}
/*list items*/
#accordian li {
	list-style-type: none;
}
/*links*/
#accordian ul ul li a {
	color: white;
	text-decoration: none;
	font-size: 13px;
	line-height: 27px;
	display: block;
	padding: 0 15px;
	/*transition for smooth hover animation*/
	transition: all 0.15s;
}
/*hover effect on links*/
#accordian ul ul li a:hover {
	background: #003545;
	border-left: 5px solid lightgreen;
}
/*Lets hide the non active LIs by default*/
#accordian ul ul {
	display: none;
}
#accordian li.active ul {
	display: block;
}

</style>
</head>
	<body>
	
	<div id="accordian">
		<!---->
	
	<?php
	$hostname=$_GET['file'];
	echo "<form id='testForm' action='rulesnfix.php?file=".$hostname."' method='post' target='_blank'>";
	
//this code parses the file on the server for the failed results and create a new html element.
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTMLFile("REPS/YBL-ROUTER-".$_GET['file'].".cfg.html");
  $dom->preserveWhiteSpace = false; 
  $tables = $dom->getElementsByTagName('table');
	$failed=0;
	$rules="";
 if (!is_null($tables)) 
  {

  foreach ($tables as $table) 
  {	$vals=array();
    $rows = $table->childNodes;
	echo "<ul>";
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
		  if($col->nodeValue=="FAIL"){
		  //condition for showing the result
			$failed=1;
			$flag=1;
		  }	
	  }
	  if($flag==1 and $once!=0){
		//create new html for failed results
		echo "<li>";
		echo '<h3><span class="icon-exclamation-sign"></span>Rule Fail   '.$j.' </br>'.'<p align="right">
<input type="checkbox" name="box[]" value="'.$vals[4].'">'.$vals[4].'</input><br>
</p></h3>';
			echo '<ul>';
			echo '<li><a href="#">Description of Issue</a></li>';				
			echo '</ul>';
		echo "</li>";
		
		$once+=1;
		$j=$j+1;
	  }
	  else if($flag==1 and $once==0){
		  echo "<li class='active'>";
			echo '<h3><span class="icon-exclamation-sign"></span>Rule Fail   '.$j.' </br>'.'<p align="right">
<input type="checkbox" name="box[]" value="'.$vals[4].'">'.$vals[4].'</input><br>
</p></h3>';
				echo '<ul>';
				echo '<li><a href="#">Description of Issue</a></li>';				
				echo '</ul>';
			echo "</li>";
			$j=$j+1;
			$once+=1;
			}
	  }
	  break;
	}
		echo "</ul>";
		echo "</form>";
		
	}
	if ($failed==0){
		echo "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Router is compliant with standards.</strong>";
	}
?>

<!---->
</div>

<!-- prefix free to deal with vendor prefixes -->
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript">
</script>

<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript">
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script><script>$(document).ready(function(){
/*jQuery time*/
$(document).ready(function(){
	$("#accordian h3").click(function(){
		//slide up all the link lists
		$("#accordian ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})
});

</script>
</body>

</html>
</td>
</tr>

</table>
</body>
</html>



