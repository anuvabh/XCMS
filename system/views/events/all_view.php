<!doctype HTML>
<html lang="en">
    
    <head>
        <title>Current Events</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css">

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <script>
            function setVisible(i)
            {
                document.getElementById(i).style.visibility = 'visible';
            }
            function setHidden(i)
            {
                document.getElementById(i).style.visibility = 'hidden';
            }
        </script>
        <style>
            .table td
            {
                padding: 0px;
                line-height: 300%;
            }
        </style>
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
                        <li class="divider-vertical">
                        </li>
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
                <div class="span12" style="height: 60px; margin-bottom: 10px" align="right">
                    <img src="http://localhost/xcms/images/events.gif" />
                </div>
                
                <?php
                if(count($events)==0)
                {
                    echo "No event Posted yet";
                }
                else
                {?>
                    <h3>Events open for registration:</h3>
            </div>
            
            <div class="row span10" align="center">
                
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Starting Date</th>
                                <th>End Date</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                    <?php

                        $count = 0;
                        foreach ($events as $row)//make register buttons appear on hover
                        {
                            $count++;
                            echo "<tr onmouseover='setVisible(".$count.");' onmouseout='setHidden(".$count.");'>";
                                echo "<td>";
                                    echo $row['EventName'];//link event to its desc
                                echo "</td>";
                                echo "<td>";
                                    echo substr($row['StartDate'],8,2)."/".substr($row['StartDate'],5,2)."/".substr($row['StartDate'],0,4);
                                echo "</td>";
                                echo "<td>";
                                    echo $row['EndDate'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['Department'];
                                echo "</td>";
                                if($this->session->userdata('UserType')=='student' || $this->session->userdata('UserType')=='cr')
                                {
                                    echo "<td  >";
                                        echo "\n<a class='btn btn-success btn-large' id='".$count."' style='visibility: hidden;' type='button' href='".site_url()."events/register/".$row['EventID']."' >Register</a>";
                                    echo "</td>";
                                    
                                }
                            echo "</tr>";
                        }
                    ?>
                    </table>
                <?php
                }?>
            </div>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-dropdown.js"></script>
    </body>
</html>
