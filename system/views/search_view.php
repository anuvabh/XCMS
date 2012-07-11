<!doctype HTML>
<html lang="en">
    
    <head>
        <title>Search Results</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css">

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
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
                <div class="span12" align="right">
                    <img src="http://localhost/xcms/images/search.gif" />
                </div>
            </div>
            <div class="row">
                <?php
                    echo "<h3>Search results for: ".$keyword." </h3>";
                    if(!$events && !$users)
                    {
                        echo "No Search results to view";
                        return;
                    }
                    $eventsLength = count($events);
                    $usersLength = count($users);
                    $total = $eventsLength + $usersLength;
                    echo $total." results in ".$time." seconds";
                    ?>
            </div>
            
            <div class="row" style="margin-top: 30px;">
            
                <div class="tabbable tabs-left"> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#events" data-toggle="tab">Events (<?php echo $eventsLength?>)</a></li>
                        <li><a href="#users" data-toggle="tab">Users/Departments (<?php echo $usersLength?>)</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="events">
                            <table class="table table-bordered">

                                <?php

                                for( $i = 0; $i<$eventsLength; $i++)
                                {
                                    echo "<tr><td>";
                                    if(isset($events[$i]))
                                    echo "<a href='".site_url()."events/profile/".$events[$i]['EventID']."'>".$events[$i]['EventName']."</a>";

                                    echo "</td></tr>";
                                }
                                ?>
                            </table>

                        </div>

                        <div class="tab-pane" id="users">

                            <table class="table table-bordered">

                                <?php

                                for( $i = 0; $i<$usersLength; $i++)
                                {
                                    echo "<tr><td>";
                                    if(isset($users[$i]))
                                        echo "<a href='".site_url()."accounts/view/".$users[$i]['UserID']."'>".$users[$i]['FirstName']." ".$users[$i]['LastName']."</a>";

                                    echo "</td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-dropdown.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-tab.js"></script>
    </body>
</html>