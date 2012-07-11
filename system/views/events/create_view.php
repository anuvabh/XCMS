<!doctype HTML>
<html lang="en">
    
    <head>
        <title>Create Event</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css">
       
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->        
        <script type="text/javascript">
            var i=1;
            var roleCount = <?php if(isset($roles)) echo count($roles); else echo "0";?>;
            var rc = roleCount;
            var JScount = 0;
            function validate(ch)            
            {                
                var f = 1, err="";
                dd = parseInt(document.getElementsByName("dd")[0].value);
                mm = parseInt(document.getElementsByName("mm")[0].value);
                yy = parseInt(document.getElementsByName("yy")[0].value);
                dd1 = parseInt(document.getElementsByName("dd1")[0].value);
                mm1 = parseInt(document.getElementsByName("mm1")[0].value);
                yy1 = parseInt(document.getElementsByName("yy1")[0].value);
                
                if(document.getElementsByName("eName")[0].value.length==0)
                {
                    f = 0;
                    err += "Please enter the Event Name\n";
                }
                if(dd==0 || mm==0 || yy==0)
                {
                    f = 0;
                    err += "Please enter the Starting Date"+document.getElementsByName("dd")[0].value+"/"+document.getElementsByName("mm")[0].value+"/"+yy+"\n";
                }
                if(dd1==0 || mm1==0 || yy1==0)
                {
                    f = 0;
                    err += "Please enter the End Date"+dd1+"/"+mm1+"/"+yy1+"\n";
                }
                
                if (f == 1)
                {
                    err = "";
                    var flag = 0;
                    
                    if(check(dd, mm, yy)!=1)
                    {
                        flag = 1;
                        err += "Please enter a valid start date\n";
                    }
                    if(check(dd1, mm1, yy1)!=1)
                    {
                        flag = 1;
                        err += "Please enter a valid end date\n";
                    }
                    if(flag == 0)
                    {
                        err = "";
                        if(yy > yy1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                        if(yy ==yy1 && mm > mm1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                        if(yy ==yy1 && mm == mm1 && dd > dd1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                    }
                    if(flag==0)
                    {
                        var i;
                        <?php if(!isset($roles))
                        {?>
                            credit0 = document.getElementsByName("credit0")[0];
                            if(isNaN(credit0.value) || credit0.value.length==0)
                            {
                                err = err+"\nEnter a number for each credit field";
                                flag = 1; 
                            }
                            <?php
                        }?>
                        if(JScount>0)
                        {
                            for(i=rc; i>=rc-JScount && flag==0; i--)
                            {
                                var index="role"+i;//alert(index);

                                roleElem = document.getElementsByName(index)[0];
                                if(roleElem)
                                {
                                    index = "credit"+i; 
                                    creditElem = document.getElementsByName(index)[0];
                                    if(roleElem.value.length==0 || creditElem.value.length==0)
                                    {
                                        err = err+"\nNo role/credit field can be empty";
                                        flag = 1;
                                    }
                                    if(isNaN(creditElem.value))
                                    {
                                        err = err+"\nEnter a number for each credit field";
                                        flag = 1; 
                                    }

                                    var j;
                                    for(j=0; j<=rc && flag==0; j++)
                                    {        
                                        if(j!=i)
                                        {
                                            var index1="role"+j; 
                                            roleElem1 = document.getElementsByName(index1)[0];;
                                            if(roleElem1)
                                            {
                                                if(roleElem1.value==roleElem.value)
                                                {
                                                    err = err+"\nRole names should be unique";
                                                    flag=1;
                                                }
                                            }
                                        }
                                    }

                                        //document.getElementById('abc').innerHTML=r;

                                }
                            }
                        }
                        
                        if(flag == 0)
                        {
                            var roleNum = document.getElementsByName('roleCount')[0];
                            roleNum.value = rc;
                            
                            var space = document.getElementById('space');
                            var elm = "";
                            if(ch==0)
                            {
                                elm = "<input type='hidden' name='choice' value='save'/>";
                            }
                            if(ch==1)
                            {
                             	var conf;
                             	<?php
                                if($save == 1)
                             	{?>
                                    conf = confirm("Be advised that once declared open, existing roles cannot be edited");
                                <?php
                                }
                                else
                                {?>
                                    conf = confirm("Be advised that once updated, existing roles cannot be edited");

                                <?php	
                                }?>
                                if(conf)
                                    {
                                        elm = "<input type='hidden' name='choice' value='open'/>";
                                    }
                                    else
                                        return;
                            }
                            space.innerHTML = elm;
                            document.createEvent.submit();
                        }  
                    }
                    if(flag != 0)
                    {
                        alert(err);
                    }
                   
                }
                else
                {
                    alert(err);
                }
            }
            function check ( d, m ,y )
            {
                var months = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
                if(y%100 == 0)
                {
                    if(y%400 == 0)
                    {
                        months[1]++;
                    }
                }
                else
                {
                    if(y%4 == 0)
                    {                        
                        months[1]++;
                    }
                }
                
                if(d <= months[m-1])
                {
                    return 1;
                }
                return 0;
            }
            function addRole()
            {
                var table = document.getElementById('eventInfo');
                var newRow;
                var elem;

                JScount++;
                roleCount++;
                rc++;
                newRow = document.createElement('tr');
                elem = "<td id='role"+rc+"'><input type='text' class='span2' name='role"+rc+"'/></td><td id='credit"+rc+"'><input type='text' class='span2' name='credit"+rc+"'/><td id='check"+rc+"'><input type='checkbox' value='1' name='check"+rc+"'/></td><td id='remove"+rc+"'><input type='button' class='btn btn-danger' title='Remove Role' value='&times;' name='remove"+rc+"'onClick='remove("+rc+");'/></td>";
                newRow.innerHTML = elem;
                table.appendChild(newRow);                
            }
            function remove(c)
            {
                role = document.getElementById("role"+c);
                credit = document.getElementById("credit"+c);
                button = document.getElementById("remove"+c);
                
                JScount--;
                
                p = role.parentNode;                
               
                button.parentNode.removeChild(button);                
                
                p.parentNode.removeChild(p);//to remove the empty row
                roleCount--;
                <?php if(isset($roles))
                {?>
                    if(roleCount==0)
                    {
                        y = document.getElementById('heading');
                        y.parentNode.removeChild(y);
                    }
                <?php
                }
                ?>

            }
            function close()
            {
               document.forms[1].submit();
            }
        </script>
    </head>
    
    <body class="has-navbar">
        
        
        <!-- navbar -->
         <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    
                    <?php
                        echo "<a class='brand' href='".site_url()."'>".$this->session->userdata('FirstName')." ".$this->session->userdata('LastName')."</a>\n";
                    ?>
                    <ul class="nav">
                        
                        <li class="">
                            
                        </li>
                        <li class="">
                           
                        </li>
                        <li class="">
                           
                        </li>
                    </ul>
                    
                    <form class="navbar-search pull-left" action="<?php echo site_url();?>main/search">
                        <input type="text" class=" span2" placeholder="Search" name="search">
                    </form>
                    
                    <ul class="nav pull-right">
                        <li>
                            <a href="<?php echo site_url();?>">
                                <i class="icon-home" style="font-size: 30px;"></i>
                            </a>
                        </li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown" id="options">
                            <a href="#options" class="dropdown-toggle" data-toggle="dropdown">
                                Account
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo site_url().'accounts/changePassword';?>">Change Password</a>                    
                                </li>
                                <li>
                                    <a href="<?php echo site_url().'accounts/logout';?>">Logout</a> 
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row page-header">
                <div class="span12" align="right">
                    <img src="http://localhost/xcms/images/events.gif" />
                </div>
            </div>
            
            <div class="row well">
                <form name="createEvent" class="form-horizontal" method="POST" <?php if(isset($EID)) {echo "action='".site_url()."events/edit/".$EID."'";}?>>
                        <table>
                        <tr>
                            <td>Event Name:</td>
                            <?php 
                            if(isset($roles) && count($roles) != 0)
                            {
                                echo "<td>".$details[0]['EventName']."</td>";
                                echo '<input type="hidden" name="eName" value="'.$details[0]["EventName"].'">';
                            }
                            else
                            {?>
                                <td><input type="text" name="eName" value="<?php if(isset($details)) echo $details[0]['EventName'];?>"></td>
                                <?php
                            }?>
                        </tr>
                        <tr id="rows">
                            <td>Start Date:</td>
                            <?php 
                            if(isset($roles) && count($roles) != 0)
                            {
                                echo "<td>".intval(substr($details[0]['StartDate'],8,2))."/".intval(substr($details[0]['StartDate'],5,2))."/".intval(substr($details[0]['StartDate'],0,4))."</td>";
                                echo '<input type="hidden" name="dd" value="'.intval(substr($details[0]['StartDate'],8,2)).'" />';
                                
                                echo '<input type="hidden" name="mm" value="'.intval(substr($details[0]['StartDate'],5,2)).'" />';
                                echo '<input type="hidden" name="yy" value="'.intval(substr($details[0]['StartDate'],0,4)).'" />';


                            }
                            else
                            {?>
                                <td>
                                    <select name="dd" class="span2">
                                        <option value='0'>Select Day</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
                                    </select>&nbsp;/&nbsp;
                                    <select name="mm" class="span2">
                                        <option value='0'>Select Month</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option></select>&nbsp;/&nbsp;
                                    <select name="yy" class="span2">
                                        <option value='0'>Select Year</option><option>2012</option><option>2013</option><option>2014</option><option>2015</option><option>2016</option><option>2017</option><option>2018</option><option>2019</option><option>2020</option><option>2021</option><option>2022</option><option>2023</option><option>2024</option><option>2025</option><option>2026</option><option>2027</option><option>2028</option><option>2029</option><option>2030</option><option>2031</option><option>2032</option><option>2033</option><option>2034</option><option>2035</option><option>2036</option><option>2037</option><option>2038</option><option>2039</option><option>2040</option><option>2041</option><option>2042</option><option>2043</option><option>2044</option><option>2045</option><option>2046</option><option>2047</option><option>2048</option><option>2049</option>
                                    </select>
                                </td>
                               
                                <?php
                            }?>
                            
                        </tr>

                        
                        
                        
                        
                        
                        <tr id="rows1">
                            <td>End Date:</td>
                            <?php 
                            if(isset($roles) && count($roles) != 0)
                            {
                                echo "<td>".intval(substr($details[0]['EndDate'],8,2))."/".intval(substr($details[0]['EndDate'],5,2))."/".intval(substr($details[0]['EndDate'],0,4))."</td>";
                                echo '<input type="hidden" name="dd1" value="'.intval(substr($details[0]['EndDate'],8,2)).'" />';
                            
                                echo '<input type="hidden" name="mm1" value="'.intval(substr($details[0]['EndDate'],5,2)).'" />';
                                echo '<input type="hidden" name="yy1" value="'.intval(substr($details[0]['EndDate'],0,4)).'" />';


                            }
                            else
                            {?>
                            
                            <td><select name="dd1" class="span2">
                                    <option value='0'>Select Day</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
                                </select>&nbsp;/&nbsp;
                                <select name="mm1" class="span2">
                                <option value='0'>Select Month</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option></select>&nbsp;/&nbsp;
                                <select name="yy1" class="span2">
                                    <option value='0'>Select Year</option><option>2012</option><option>2013</option><option>2014</option><option>2015</option><option>2016</option><option>2017</option><option>2018</option><option>2019</option><option>2020</option><option>2021</option><option>2022</option><option>2023</option><option>2024</option><option>2025</option><option>2026</option><option>2027</option><option>2028</option><option>2029</option><option>2030</option><option>2031</option><option>2032</option><option>2033</option><option>2034</option><option>2035</option><option>2036</option><option>2037</option><option>2038</option><option>2039</option><option>2040</option><option>2041</option><option>2042</option><option>2043</option><option>2044</option><option>2045</option><option>2046</option><option>2047</option><option>2048</option><option>2049</option></select>
                            </td>
                               <?php 
                            }?>
                            
                        </tr>
                        
                        
                        
                        
                        
                        
                        <tr>
                            <td>Credit Type:</td>
                            <?php 
                            if(isset($roles) && count($roles) != 0)
                            {
                                echo "<td>".($cType==0?"Atomic":"Hours")."</td>";
                                echo '<input type="hidden" value="'.$cType.'" name="creditType"/>';
                            }
                            else
                            {?>
                            
                                <td><select name="creditType">
                                        <?php
                                            for($i=0; $i<=1; $i++)
                                            {

                                                if($i==0)
                                                {
                                                    if($i== $cType)  
                                                    echo '<option value = "0" selected="selected">Atomic</option>';
                                                    else
                                                    echo '<option value = "0" >Atomic</option>';
                                                }
                                                if($i==1)
                                                {
                                                    if($i== $cType)  
                                                    echo '<option value = "1" selected="selected">Hours</option>';
                                                    else
                                                    echo '<option value = "1" >Hours</option>';
                                                }
                                            }

                                        ?>
                                    </select>
                                </td>
                                <?php
                            }?>
                        </tr>
                        <tr>
                            <td>Social Credit:</td>
                            <?php 
                            if(isset($roles) && count($roles) != 0)
                            {
                                echo "<td>".($details[0]['SocialCredit'] == 1?"Yes":"No")."</td>";
                                echo '<input type="hidden" value="'.$details[0]['SocialCredit'].'" name="social"/>';
                            }
                            else
                            {?>
                                <td><input type="checkbox" name="social" value="1" <?php if(isset($details) && $details[0]['SocialCredit'] == 1)echo "checked='checked'";?>/></td>
                                <?php
                            }?>
                        </tr>

                        <tr>
                            <td valign="top">Event Description:</td>
                            <td><textarea rows="5" cols="500" name="eDetails"><?php if(isset($details))echo $details[0]['Details'];?></textarea></td>
                        </tr>
                    </table>
                    <div class="row center span6">
                        <table id="eventInfo" class="table">
                            <?php
                                $flag = 0;
                                echo "<tr id='heading'><td>Role Name</td><td>Credit</td><td>Visible to Students?</td></tr>";
                                if(!isset($roles))
                                { ?>
                                    <tr>
                                        <td><input type="text" class="span2" name="role0"/></td>
                                        <td><input type="text" class="span2" name="credit0"/></td>

                                        <td>Yes</td>

                                        <td><input type='hidden' name='check0' value='1'/></td>
                                    </tr>

                                    <?php
                                }

                                if(isset($roles) && count($roles) != 0)
                                {
                                    $disp="";

                                    for($i=0;$i<count($roles);$i++)
                                    {

                                        $row = "<tr>";

                                            $row = $row."<td id='role".$i."'>".$roles[$i]['Role']."</td>\n";
                                            $row = $row."<td id='credit".$i."'>".$roles[$i]['Credit']."</td>\n";

                                            if($roles[$i]['Visible'] == 1)
                                            {

                                                $row = $row."<td>Yes</td>"."\n";
                                                $row = $row."<td><input type='hidden' id='check".$i."' name='check".$i."' value='1'/></td>"."\n";
                                                $flag++;
                                            }
                                            else
                                            {
                                                $row = $row."<td>No</td>"."\n";
                                                $row = $row."<td><input type='hidden' id='check".$i."' name='check".$i."' value='1'/></td>"."\n";
                                            }

                                        $row = $row."</tr>"."\n";

                                        if($roles[$i]['Visible'] == 1 && $flag==1)
                                            $disp = $row.$disp;
                                        else
                                            $disp = $disp.$row;
                                    }
                                    echo $disp;
                                }
                                ?>
                            </table>
                        
                        <input class="btn" type="button" onClick="addRole();" value="Add Role"/><br/>
                        <input type="hidden" name="roleCount" value="0"/>
                        <?php if($save == 1)
                        {?>
                            <br>
                            <input type="button" class=" btn btn-info" onClick="validate(0);" value='Save Event'/>
                            
                            <input type="button" class="offset1 btn btn-success btn-large" onClick="validate(1);" value='Open Event'/>
                        <?php

                        }
                        else
                        {?>
                            <br>
                            <input type="button" class="btn btn-info" onClick="validate(1);" value='Update'/>

                        <?php
                        }                
                       
                        if(isset($EID))
                            echo '<a class="btn btn-danger" href="'.site_url().'events/close/'.$EID.'">Close Event</a>';
                        ?>
                        </div>
                    
                        <span id="space"></span>
                    </form>
            </div>
            

            
            <div class="row">
            
            </div>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-dropdown.js"></script>
    </body>
</html>
