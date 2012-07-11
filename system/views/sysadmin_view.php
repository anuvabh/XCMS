<!doctype HTML>
<html lang="en">
    <head>
        <title>System Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="http://localhost/xcms/css/site.css" />

        <!--[if lte IE 9]>
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
            <div class="row">
                
                <div class="span12" style="height: 60px; margin-bottom: 10px; " align="right">
                    <img src="http://localhost/xcms/images/home.gif" />
                </div>
                <div class="row page-header">
                
                <h2>Welcome</h2>
                </div>
            </div>
<!--            <div class="row"  >
                <div class="span12" style="height: 60px; margin-bottom: 10px; " align="right">
                    <img src="http://localhost/xcms/images/home.gif" />
                </div>
            </div>
            <div class="page-header">
                <h2>Welcome</h2>
                
            </div>-->
            
            <div class="row">
                <div class="span8">
                    <div class="row  link-group">

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/admin/createCR">
                                <i class="icon-user icon-large"></i>
                                Create new CR
                            </a>
                        </div>

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/accounts/viewUsers">
                                <i class="icon-asterisk icon-large"></i>
                                View all users
                            </a>
                        </div>
                    </div>

                    <div class="row  link-group">

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/blocks/create">
                                <i class="icon-tasks icon-large"></i>
                                Create Block
                            </a>
                        </div>

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/blocks/generateSet">
                                <i class="icon-tag icon-large"></i>
                                Generate Codes
                            </a>
                        </div>
                    </div>

                    <div class="row  link-group">

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/admin/createDepartment">
                                <i class="icon-briefcase icon-large"></i>
                                Create Department
                            </a>
                        </div>

                        <div class="span4 icon-container">
                            <a href="http://localhost/xcms/admin/deleteDepartment">
                                <i class="icon-remove icon-large"></i>
                                Delete Department
                            </a>
                        </div>
                    </div>

                    <div class="row  link-group">

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/events/create">
                                <i class="icon-beaker icon-large"></i>
                                Create an event
                            </a>
                        </div>

                        <div class="span4 icon-container">

                            <a href="http://localhost/xcms/events/view">
                                <i class="icon-wrench icon-large"></i>
                                Manage events
                            </a>
                        </div>

                    </div>
                </div>
                
            </div>
            
        </div>
        
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
    </body>
</html>