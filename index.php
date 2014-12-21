<?php
    define("IP", "localhost/solo_rv");
    // Create connection
    $con=mysqli_connect("localhost","root","root","router");

    // Check connection
    if (mysqli_connect_errno($con))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $cScore;
    isset($_GET['criticality'])?$cScore=$_GET['criticality']:$cScore=0;
    isset($_GET['severity'])?$sScore=$_GET['severity']:$sScore=0;
    $sql="SELECT hostname FROM host WHERE criticality>=".$cScore." and severity>=".$sScore;
    $result=mysqli_query($con,$sql);
    $criticality=array();
    while($row = mysqli_fetch_array($result,MYSQL_BOTH))
      {
        $criticality[]=$row['hostname'];
      }
    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Router Visualization by CTO Team.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script type="text/javascript" src="assets/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="assets/js/sigma.min.js"></script>
    <script type="text/javascript" src="assets/js/sigmaparseGexf.js"></script>
    <script type="text/javascript" src="assets/js/forceatlas.js"></script>
    <script type="text/javascript" src="assets/js/leaflet.js"></script>    
    <script type="text/javascript" src="assets/js/sigma.min.js"></script>
    <script type="text/javascript" src="assets/js/sigmaparseGexf.js"></script>
    <script type="text/javascript" src="assets/js/forceatlas.js"></script>    
    <script type="text/javascript" src="assets/js/leaflet.js"></script>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/leaflet.css" />
    <link rel="stylesheet" href="assets/css/jquery-ui.css">    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
<style type="text/css">
    /* sigma.js context : */
    body {
        //padding-bottom: 40px;
    }
     
    #sig,#map {
      height: 600px
    }
</style>
<script src="http://<?php echo IP; ?>/push/assets/js/pusher2.1.js" type="text/javascript"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
   /* Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };
    var router='';
    var pusher = new Pusher('c17f5ceb1653f22b7f6e');
    var channel = pusher.subscribe('screen1');
    channel.bind('topology_event', function(data) 
    {
      //alert(data.message+data.router);
      router=data.router;
      window.open("http://<?php echo IP; ?>/myrouter","_self");

    });*/
</script>

<script type="text/javascript">
function toggle(id) {
    var element = document.getElementById(id);

    if (element) {
        var display = element.style.display;

        if (display == "none") {
            element.style.display = "block";
            document.getElementById('toggle-button').childNodes[0].nodeValue = 'Hide Map';
        } else {
            element.style.display = "none";
            document.getElementById('toggle-button').childNodes[0].nodeValue = 'Show Map';
        }
    }
}
//***************start of sigma script***************

//This for rendering the canvas for the graph generated through sigma

$(document).ready(function() {
// Instanciate sigma.js and customize rendering :

    $( "#tabs" ).tabs();

sigma.publicPrototype.myCircularLayout = function() {
var R = 50,
i = 0,
L = this.getNodesCount();

this.iterNodes(function(n){
n.x = Math.cos(Math.PI*(i++)/L)*R;
n.y = Math.sin(Math.PI*(i++)/L)*R;
});

return this.position(0,0,1).draw(2,2,2);
};

//size nodes according to degree
sigma.publicPrototype.DegreeToSize = function() {
this.iterNodes(function(node){
node.size = node.degree;
});
return this.position(0,0,1).draw(2,2,2);
};
// The following method will parse the json file and add nodes & edges
// and set its position to as random in a square around the center:
sigma.publicPrototype.parseJson = function(jsonPath,callback) {
var sigmaInstance = this;
jQuery.getJSON(jsonPath, function(data,callback) {

//clustering according to the region 
/*Cluster id N=0,E=1,W=2,S=3*/
//where C is # the no. of cluster to be formed

var C=4,clusters=[];
<?php
function js_str($s)
{
return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function js_array($array)
{
$temp = array_map('js_str', $array);
return '[' . implode(',', $temp) . ']';
}

echo 'var criticality = ', js_array($criticality), ';';
?>

for(i = 0; i < C; i++){

clusters.push({
'id': i,
'nodes': []
});
}


for (i=0; i<data.nodes.length; i++){
var id=data.nodes[i].Hostname;
var res=data.nodes[i].RAT;
var color;
var cluster_id;
if(data.nodes[i].Direction=="NORTH"){
cluster_id=0;
}
else if(data.nodes[i].Direction=="EAST"){
cluster_id=1;
}
else if(data.nodes[i].Direction=="WEST"){
cluster_id=2;
}
else if(data.nodes[i].Direction=="SOUTH"){
cluster_id=3;
}
if(data.nodes[i].RAT==="pass"){
color="#66CD00";
}
else{
color="#FF0000";
}

if(criticality.indexOf(data.nodes[i].Hostname) != -1){
sigInst.addNode(id,{
'x': Math.random(),
'y': Math.random(),
'label': data.nodes[i].Hostname,
'color': color,
'cluster': clusters['cluster_id']
});
}
}

//for removing the unresolved ip address error
sigInst.addNode('External Link',{
    label: 'External Link',
    size: 5,
    color: '#ffffff'
  })
  
var linkcount=0;
for(j=0; j<data.links.length; j++){
var edgeNode = data.links[j];
if(edgeNode.Target=='External Link' || (criticality.indexOf(edgeNode.Target) != -1 && criticality.indexOf(edgeNode.Source) != -1)){
var source = edgeNode.Source;
var target = edgeNode.Target;
sigmaInstance.addEdge(linkcount++,source,target,edgeNode);
}
}
});
};

//called on clicking a node
function onClick(event)
{
var nodes = event.content;
sigInst.iterNodes(function(n)
{
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
            //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
        }
    }
    /*xmlhttp.open("POST","http://<?php echo IP; ?>/push/screen1.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("file="+n.id);
    */
    window.open('http://<?php echo IP; ?>/myrouter/router.php?file='+n.id,'_blank');
    //event.stopPropagation();
},[event.content[0]]);
}


// Instanciate sigma.js and customize it :
var sigInst = sigma.init(document.getElementById('sig')).drawingProperties({
defaultLabelColor: '#fff',edgeColor: 'source',labelThreshold: 6
}).graphProperties({
minNodeSize: 8,
maxNodeSize: 10,
minEdgeSize: 1.3,
maxEdgeSize: 1.5
});
<?php
if($cScore==0 and $sScore==0){
    echo "sigInst.parseJson('data/test35.json',true);";
}
else{
    echo "sigInst.parseJson('data/test.json',true);";
}
?>

//add the search tab feature to the graph created
//sigInst.searchTab();
//add onClink function
sigInst.bind('overnodes',function(event){
var nodes = event.content;
var neighbors = {};
var nrEdges = 0;
sigInst.iterEdges(function(e){
  if(nodes.indexOf(e.source)>=0 || nodes.indexOf(e.target)>=0){
     neighbors[e.source] = 1;
     neighbors[e.target] = 1;
    nrEdges++;
  }
}).iterNodes(function(n){
  if(nrEdges>0) {
     if(!neighbors[n.id]){
     n.hidden = 1;
     }else{
     n.hidden = 0;
     }
 }
}).draw(2,2,2);
}).bind('outnodes',function(){
sigInst.iterEdges(function(e){
  e.hidden = 0;
}).iterNodes(function(n){
  n.hidden = 0;
 }).draw(2,2,2);
});


sigInst.bind('downnodes',onClick).draw();


var isRunning = false;
document.getElementById('start-layout').addEventListener('click',function(){
if(isRunning){
isRunning = false;
sigInst.stopForceAtlas2();
document.getElementById('start-layout').childNodes[0].nodeValue = 'Start Layout';
}else{
isRunning = true;
sigInst.startForceAtlas2();
document.getElementById('start-layout').childNodes[0].nodeValue = 'Stop Layout';
}
},true);


document.getElementById('circular').addEventListener('click',function(){
sigInst.myCircularLayout();
},true);
//sigInst.activateFishEye();
});

//***************end of sigma script*****************


//*********start of map script*************
var map = L.map('map',{
        scrollWheelZoom: false,
        touchZoom: false,
        doubleClickZoom: false,
        zoomControl: false,
        dragging: false
    }).setView([21.8, 81.5], 5);

// add an OpenStreetMap tile layer
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
styleId: 997
}).addTo(map);

// add a marker in the given location, attach some popup content to it and open the popup
L.marker([18.9750, 72.8258]).addTo(map)
.bindPopup('Mumbai').on('click',function onClick(evt){
var id1='MUM-DAKC-R01';
var id2='MUM-DAKC-R02';
var id2='ACME-BANDRA-T1';
var id3='ACME-BANDRA-S1'
sigInst.iterNodes(function(n){
n.hidden=1; 
}).iterNodes(function(n){
n.hidden=0; 
},[id1,id2,id3]).draw(2,2,2);
});

L.marker([28.6100, 77.2300]).addTo(map)
.bindPopup('Delhi').openPopup(map).on('click',function onClick(evt){
var id1='ACMEDEL-GARI-TC1';
var id2='ACMEDEL-DLFC-R1';
var id3='ACMEDEL-DLFC-S1';
var id4='ACMEDEL-DLFC-S1';
var id6='ACMEDEL-BAH-S1';
var id7='ACMEDEL-BAH-R1';
var id8='ACMEDEL-CHTR-S1';
var id9='ACMEDEL-CHTR-R1';
var id10='ACMEDEL-CANP-S1';
var id11='ACMEDEL-CANP-R1';
var id12='ACMEDEL-GRNP-S1';
var id13='ACMEDEL-GRNP-R1';
var id14='ACMEDEL-JALN-S1';
var id15='ACMEDEL-JALN-R1';
sigInst.iterNodes(function(n){
n.hidden=1; 
}).iterNodes(function(n){
n.hidden=0; 
},[id1,id2,id3,id4,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15]).draw(2,2,2);
});

L.marker([13.08, 80.27]).addTo(map)
.bindPopup('Chennai').openPopup(map).on('click',function onClick(evt){
var id1='ACMECHN-SELM-R1';
var id2='ACMECHN-SELM-S1';
var id3='ACMECHE-COIM-R1';
var id4='ACMECHE-COIM-S1';
var id5='ACMECHE-SRIP-R1';
var id6='ACMECHE-SRIP-S1';
sigInst.iterNodes(function(n){
n.hidden=1; 
}).iterNodes(function(n){
n.hidden=0; 
},[id1,id2,id3,id4,id5,id6]).draw(2,2,2);
});

L.marker([21.14, 81.38]).addTo(map)
.bindPopup('Chattisgarh').openPopup(map).on('click',function onClick(evt){
var id1='ACMECHH-DBHI-R1';
var id2='ACMECHH-DBHI-S1';
var id3='ACMECHH-RAIP-R1';
var id4='ACMECHH-RAIP-S1';
sigInst.iterNodes(function(n){
n.hidden=1; 
}).iterNodes(function(n){
n.hidden=0; 
},[id1,id2,id3,id4]).draw(2,2,2);
});


L.marker([17.36, 78.47]).addTo(map)
.bindPopup('Andhra Pradesh').openPopup(map).on('click',function onClick(evt){
var id1='ACMEAP-VAIZ-R1';
var id2='ACMEAP-VAIZ-S1';
var id3='ACMEAP-SECU-R1';
var id4='ACMEAP-SECU-S1';
var id5='ACMEAP-HYDR-S1';
var id6='ACMEAP-HYDR-R1';
var id7='ACMEAP-VIJW-R1';
var id8='ACMEAP-VIJW-S1';
sigInst.iterNodes(function(n){
n.hidden=1; 
}).iterNodes(function(n){
n.hidden=0; 
},[id1,id2,id3,id4,id5,id6,id7,id8]).draw(2,2,2);
});
//*************end of map script*************

</script>

<script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
        <?php
            $con=mysqli_connect("localhost","root","root","router");

            // Check connection
            if (mysqli_connect_errno($con))
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            $sql="SELECT avg(Overall_Score) as avg_cr FROM score";
            $result=mysqli_query($con,$sql);
            
            while($row = mysqli_fetch_array($result,MYSQL_BOTH))
            {
                $criticality=$row['avg_cr'];
            }
            mysqli_close($con);
            echo "['Compliance', ".substr($criticality,0,5)."],";          

        ?>
          
        ]);

        var options = {
          width: 400, height: 200,
          max:100,
          redFrom: 0, redTo: 30,
          yellowFrom:30, yellowTo: 50,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

</head>

<body >
    <div id="map" name="map" style="width: 500px;border:1px solid black;display:none;"></div>                         
    <div id="tabs">
        <ul>
            <li><a href="#tab1">Topology</a></li>
            <li><a href="#tab2">Rules</a></li>
            <li><a href="#tab3">Preferences</a></li>
        </ul>

    
        <div id="tab1">
            <div class="row-fluid">        
                <div class="span2">                    
                    <div class="heading" style="margin:20px 0 0 0;">

                        <div id='chart_div'></div><br/>
                        
                        <button id="circular" class="btn btn-primary">Circular Layout</button><br/><br/>
                        <button id="start-layout" class="btn btn-primary">Start Layout</button><br/><br/>
                        <!--<button id="toggle-button" class="btn btn-primary" onClick="toggle('map');">Show Map</button><br/><br/>-->
                       
                        <div class="slider" style="padding:10px;width:200px;background-image:none;">
                            <label for="amount1"><span style="font-weight:bold;">Criticality:</span>
                                <input type="text" id="amount1" style="border:0; color:#f6931f; font-weight:bold;">
                            </label>
                            <div id="slider-criticality" style="width:200px;background-image:none;" ></div><br/>

                            <label for="amount2"><span style="font-weight:bold;background-image:none;">Severity:</span>                      
                                <input type="text" id="amount2" style="border:0; color:#f6931f; font-weight:bold;">
                            </label>
                            <div id="slider-severity" style="width:200px;float: left;clear: left;margin: 15px;" ></div>    
                        </div>
                    </div>
                </div>
                <div class="span10">                                            
                        <div id="sig" style="border:1px solid black;background-color:black;"></div>    
                </div>        
            </div>            
        </div>
        <div id="tab2" >
            <div class="row-fluid">        
                <div class="span7">                
                    <div id="rules-list" style="margin:30px;position:absolute;left:0px;height:600px;overflow:auto;">
                        <input type="text" class="search" />
                            <ul class="list">                    
                                <li class="active"><p class='rule'><span class='badge pull-right'>Count</span><a href='data/rules.html#ConfigRuleName' target='_blank' id="drag1">ConfigRuleName</a></p></li>
                            <?php
                                // Create connection
                                $con=mysqli_connect("localhost","root","root","router");

                                // Check connection
                                if (mysqli_connect_errno($con))
                                {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                                //Code is poetry
                                $sql="SELECT * FROM rules where routers!=''";
                                
                                $result = mysqli_query($con,$sql);
                                $routers="";
                                
                                while($row = mysqli_fetch_array($result,MYSQL_BOTH))
                                {
                                    $routerarray = array();
                                    $routers=$row['routers'];
                                    $routerarray=explode(",",$routers);
                                    //echo count($routerarray)."\t".$row['rule']."\n";
                                    $anchor='data/rules.html#'.str_replace(' ','',$row['rule']);
                                                                
                                    //echo "<li class='active'><p class='rule'><span class='badge pull-right'>".count($routerarray)."</span><a href='$anchor' target='_blank' id='drag2' draggable='true' ondragstart='drag(event)'>".$row['rule']."</a></p></li>\n";
                                    $anchor='data/rules.html#'.str_replace(' ','',$row['rule']);                                   
                                    echo "<li class='active'><p class='rule'><span class='badge pull-right btn btn-danger' style='color:black;'>".count($routerarray);
                                    echo "</span><button class='btn btn-warning' style='color:black;' id='".$row['rule']."' value='".count($routerarray)."' onclick='addRule(this)'>".$row['rule']."</button></p></li>\n";                                                
                                }           
                                mysqli_close($con);
                            ?>
                            </ul>   
                    </div>
                </div>
            <div class="span5">
                <div id="div1">                            
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin-bottom:0;padding:5px;">
                            <div class="row-fluid"> 
                                <div class="span8"><p class="btn btn-primary">Total selected failed rule/s:</p></div> 
                                <div class="span2">                        
                                    <p id="totalfailedrulesvalue" class="btn btn-primary disabled">0</p>
                                </div>        
                                <div class="span2"></div>
                            </div>   <br/>
                            <div class="row-fluid">                                 
                                <div class="span8"><p class="btn btn-primary">Total failed routers on selected rule/s:</p></div> 
                                <div class="span2">                        
                                    <p id="totalfailedroutersvalue" class="btn btn-primary disabled">0</p>                        
                                </div>        
                                <div class="span2"></div>
                            </div>   
                        </div>
                    </div>
                </div>

                
                <div class="row-fluid">                     
                    <div class="span12">
                        <table id="dataTable" class="table btn" style="margin-top:70px;position:absolute;overflow:auto;">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Count</th>
                                <th>Rule/s</th>                    
                                <th>Remove</th>                                
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>                                          
                </div>               
                <div class="row-fluid">
                    <div class="span3"></div>
                    <div class="span5">
                        <button class='btn btn-success' style="position:absolute;overflow:auto;">Fix All</button> 
                    </div>
                    <div class="span4"></div>
                </div>
                </div>               
            </div>
        
        </div>
        <div id="tab3">   
            <div class="row-fluid">        
                <div class="span5">                    
                    
                </div>
                <div class="span2">                                            
                        
                        <a href="http://<?php echo IP; ?>/myrouter/rollBack.php" class="btn btn-info">Rollback</a>
                </div>
                <div class="span5">                    
                    
                </div>        
            </div>     
        </div>
    </div>

            <!--html for the popup window-->
                
            <div id="dialog" title="List of failed Routers" style="width:550px;height:1000px;">
                <p></p>
            </div>
              
            <style type="text/css">
                #dataTable { padding:50px;position:absolute;margin-top:50px;left:52%;width:550px;padding:10px;border:1px solid #aaaaaa;}
            </style>                    
            <!--asif's script for regex-->
            <script type="text/javascript" src="assets/js/list.js"></script>
            <script type="text/javascript" src="assets/js/list.fuzzysearch.js"></script>
            <script type="text/javascript">
                  var monkeyList = new List('rules-list', {  valueNames: ['rule'],  plugins: [ ListFuzzySearch() ] });
            </script>
      
            <!-- script for adding rows on dragdrop-->
            <script type="text/javascript">
                //Code is poetry
                var r="";
                function deleteRule(id)
                {
                    var totalfailedrulesvalue = parseInt(document.getElementById('totalfailedrulesvalue').innerHTML);
                    document.getElementById('totalfailedrulesvalue').innerHTML = parseInt(totalfailedrulesvalue) - 1;   
                    var totalfailedroutersvalue = parseInt(document.getElementById('totalfailedroutersvalue').innerHTML);
                    var value = document.getElementById(id.value+id.value).cells[1].innerHTML;
                    //document.getElementById('totalfailedroutersvalue').innerHTML = parseInt(totalfailedroutersvalue) - parseInt(value);                    
                    deleteRow('dataTable',id.value);
                    //alert(id.value+"\n1.1.2.3 - Require Timeout for vty Login Sessions");
                    document.getElementById(id.value).disabled = false;  
                    //document.getElementById(id.value).innerHTML = "hi";
                }
                function addRule(id)
                {
                    id.disabled=true;
                    addRow('dataTable',id.innerHTML, id.value);
                }
                function addRow(tableID,ruleName, value)
                {

                    var table = document.getElementById(tableID);

                    var rowCount = table.rows.length;
                    var row = table.insertRow(rowCount);

                    //Code is poetry
                    row.setAttribute("id",ruleName+ruleName);
                    //
                    var cell1 = row.insertCell(0);
                    var element1 = document.createElement("input");
                    element1.type = "checkbox";
                    element1.name="chkbox[]";
                    cell1.appendChild(element1);

                   
                    var cell2 = row.insertCell(1);
                    cell2.innerHTML = value;


                    var cell3 = row.insertCell(2);
                    //Code is poetry
                    var element2 = document.createElement("a");
                    element2.href = "javascript:popup('"+ruleName+"')";
                    element2.innerHTML =ruleName;
                    r = r + ruleName + ",";
                    cell3.appendChild(element2);
                    if (window.XMLHttpRequest)
                    {
                      xmlhttp=new XMLHttpRequest();
                    }
                    else
                    {
                      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function()
                    {
                      if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            // get the screen height and width
                            pelement=document.getElementById("totalfailedroutersvalue");
                            pelement.innerHTML=xmlhttp.responseText;
                            //alert(xmlhttp.responseText);
                            //$( "#dialog" ).dialog(xmlhttp.responseText);
                        }
                    }
                    //alert(r);

                    xmlhttp.open("GET","http://<?php echo IP; ?>/myrouter/getdistinctrouters.php?rules="+r,true);
                    xmlhttp.send();
                    
                    
                    //Code is poetry
                    var cell4 = row.insertCell(3);                    
                    var span = document.createElement('span');
                    span.innerHTML = '<button class="btn btn-success" id="'+ruleName+'" value="'+ruleName+'" onclick="deleteRule(this)">delete</button>';                    
                    cell4.appendChild(span);   
                    var totalfailedrulesvalue = parseInt(document.getElementById('totalfailedrulesvalue').innerHTML);
                    document.getElementById('totalfailedrulesvalue').innerHTML = parseInt(totalfailedrulesvalue) + 1;                                  
                    //var totalfailedroutersvalue = parseInt(document.getElementById('totalfailedroutersvalue').innerHTML);
                    //document.getElementById('totalfailedroutersvalue').innerHTML = parseInt(totalfailedroutersvalue) + parseInt(value);
                }

                function deleteRow(tableID, rowid) 
                {                    
                    /*try 
                    {
                        var table = document.getElementById(tableID);
                        var rowCount = table.rows.length;
                        for(var i=0; i<rowCount; i++) 
                        {
                            var row = table.rows[i];
                            var chkbox = row.cells[0].childNodes[0];
                            if(null != chkbox && true == chkbox.checked) 
                            {
                                table.deleteRow(i);
                                rowCount--;
                                i--;
                            }else
                            alert("Please select the rule!"); 
                        }
                    }
                    catch(e) 
                    {
                        alert(e);
                    }*/
                    //Code is poetry
                    //alert(r);
                    r=r.replace(rowid,"");
                    //alert(r);
                    if (window.XMLHttpRequest)
                    {
                      xmlhttp=new XMLHttpRequest();
                    }
                    else
                    {
                      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function()
                    {
                      if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            // get the screen height and width
                            pelement=document.getElementById("totalfailedroutersvalue");
                            
                            if(xmlhttp.responseText=="1")
                                pelement.innerHTML=0;
                            else
                                pelement.innerHTML=xmlhttp.responseText;
                            //alert();
                            //$( "#dialog" ).dialog(xmlhttp.responseText);
                        }
                    }
                    //alert(r);

                    xmlhttp.open("GET","http://<?php echo IP; ?>/myrouter/getdistinctrouters.php?rules="+r,true);
                    xmlhttp.send();

                    var row = document.getElementById(rowid+rowid);
                    row.parentNode.removeChild(row);

                }
               

               //'s script for popup
                
                function popup(rule){
                    
                //making the ajax call
                if (window.XMLHttpRequest)
                {
                  xmlhttp=new XMLHttpRequest();
                }
                else
                {
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        // get the screen height and width
                        pelement=document.getElementById("dialog");
                        pelement.innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","http://<?php echo IP; ?>/myrouter/addRow.php?rulename="+rule,true);
                xmlhttp.send();
                $( "#dialog" ).dialog();
                }
            </script>      
    </div>    
</div>
   
      <!--<div class="jumbotron">
        <h1>Super awesome marketing speak!</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <a class="btn btn-large btn-success" href="#">Sign up today</a>
      </div>-->    
     
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
     <script type="text/javascript">

        //slider-criticality script

        $(function() {
        $( "#slider-criticality" ).slider({
        animate:"fast",
        orientation:"horizontal",
        range: "max",
        min: 0,
        max: 10,
        value: <?php echo isset($_GET['criticality'])? $_GET['criticality']:0?>,
        slide: function( event, ui ) {
        $( "#amount1" ).val( ui.value );
        },
        stop: function( event, ui ) {
        window.open('http://<?php echo IP; ?>/myrouter/index.php?criticality='+$( "#amount1" ).val()+'&severity='+$( "#amount2" ).val(),"_self");
        }
        }
        );
        });
        $( "#amount1" ).val( <?php echo isset($_GET['criticality'])? $_GET['criticality']:0?>);
                            //slider-severity script
        $(function() {
            $( "#slider-severity" ).slider({
                animate:"fast",
                orientation:"horizontal",
                range: "max",
                min: 0,
                max: 10,
                step: 0.2,
                value: <?php echo isset($_GET['severity'])? $_GET['severity']:0?>,
                slide: function( event, ui ) {
                $( "#amount2" ).val( ui.value );
                },
                stop: function( event, ui ) {
                    window.open('http://<?php echo IP; ?>/myrouter/index.php?criticality='+$( "#amount1" ).val()+'&severity='+$( "#amount2" ).val(),"_self");
                }
                }
            );
        });
        $( "#amount2" ).val( <?php echo isset($_GET['severity'])? $_GET['severity']:0?>);
    </script>
  </body>
</html>