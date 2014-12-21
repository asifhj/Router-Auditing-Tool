<div id="tab2">
            <div id="page">
            <div id="rules-list" style="margin:30px;;position:absolute;left:0px;height:600px;width:500px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
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
                        $sql="SELECT * FROM rules where routers!=''";


                        $result = mysqli_query($con,$sql);
                        $routers="";
                        $i = count($routerarray);  
                        while($row = mysqli_fetch_array($result,MYSQL_BOTH))
                        {
                            $routers=$row['routers'];
                            $routerarray=explode(",",$routers);
                            //echo count($routerarray)."\t".$row['rule']."\n";
                            $anchor='data/rules.html#'.str_replace(' ','',$row['rule']);                                   
                            echo "<li class='active'><p class='rule'><span class='badge pull-right'>".count($routerarray);
                            echo "</span><button id='".$row['rule']."' value='".count($routerarray)."' onclick='addRule(this)'>".$row['rule']."</button></p></li>\n";                                                
                        }                                   
                        mysqli_close($con);                        
                    ?>
                    </ul>   
            </div>
            <div id="div1">            
            </div>
           
            <table id="dataTable" class="table table-hover" width="350px" border="1">
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
                <div id="totalfailedrule">Total selected failed rule/s:<p id="totalfailedrulesvalue">0</p></div>
                <div id="totalfailedrouters">Total failed routers on selected rule/s:<p id="totalfailedroutersvalue">0</p></div>
            </div>  
                    
            <!--html for the popup window-->
                
            <div id="dialog" title="List of failed Routers" style="width:550px;height:1000px;">
                <p></p>
            </div>
              
            <style type="text/css">
                #dataTable { padding:50px;position:absolute;margin-top:50px;left:650px;width:550px;padding:10px;border:1px solid #aaaaaa;}
            </style>                    
            <!--asif's script for regex-->
            <script type="text/javascript" src="vendor/js/list.js"></script>
            <script type="text/javascript" src="vendor/js/list.fuzzysearch.js"></script>
            <script type="text/javascript">
                  var monkeyList = new List('rules-list', {  valueNames: ['rule'],  plugins: [ ListFuzzySearch() ] });
            </script>
      
            <!--script for adding rows on dragdrop-->
            <script type="text/javascript">

            //Code is poetry
                function deleteRule(id)
                {
                    var totalfailedrulesvalue = parseInt(document.getElementById('totalfailedrulesvalue').innerHTML);
                    document.getElementById('totalfailedrulesvalue').innerHTML = parseInt(totalfailedrulesvalue) - 1;   
                    var totalfailedroutersvalue = parseInt(document.getElementById('totalfailedroutersvalue').innerHTML);
                    var value = document.getElementById(id.value+id.value).cells[1].innerHTML;
                    document.getElementById('totalfailedroutersvalue').innerHTML = parseInt(totalfailedroutersvalue) - parseInt(value);                    
                    deleteRow('dataTable',id.value);
                    alert(id.value+"\n1.1.2.3 - Require Timeout for vty Login Sessions");
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
                    cell3.appendChild(element2);

                    //Code is poetry
                    var cell4 = row.insertCell(3);                    
                    var span = document.createElement('span');
                    span.innerHTML = '<button id="'+ruleName+'" value="'+ruleName+'" onclick="deleteRule(this)">delete</button>';                    
                    cell4.appendChild(span);   
                    var totalfailedrulesvalue = parseInt(document.getElementById('totalfailedrulesvalue').innerHTML);
                    document.getElementById('totalfailedrulesvalue').innerHTML = parseInt(totalfailedrulesvalue) + 1;                                  
                    var totalfailedroutersvalue = parseInt(document.getElementById('totalfailedroutersvalue').innerHTML);
                    document.getElementById('totalfailedroutersvalue').innerHTML = parseInt(totalfailedroutersvalue) + parseInt(value);
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
                    var row = document.getElementById(rowid+rowid);
                    row.parentNode.removeChild(row);
                }
               
                
               //'s script for popup
                
                function popup(rule)
                {                    
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