<!doctype HTML>
<html lang="en">
    <head>
        <title>Assign CR</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
       
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
                            <a href=""></a>
                        </li>
                        <li class="">
                            <a href=""></a>
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
                    <img src="http://localhost/xcms/images/register.gif" />
                </div>
            </div>
            <?php
            if(!isset($CR))
            {?>
            <div class="row span12" style="margin-top: 10px"  align="center">
                <form method="POST" action="<?php echo site_url();?>accounts/register/cr">
                         <input type ="hidden" name="modify" value="1"/>
                         <br>
                         <input class="btn" type="submit" value="Make an existing student a CR"/>
                         <br><br>
                         <a class="btn" href="<?php echo site_url();?>accounts/register/cr">Create a New CR</a>
                         
                </form>
                
            </div>
            
                
            
            
            <?php
            }
            else 
            {?>
                 <div class="row" style="margin-top: 10px">
                     <?php
                        echo $CR['FirstName']." ".$CR['LastName']." is already a CR"."<br/>";
                        
                     ?>
                     <form method="POST" action="<?php echo site_url();?>accounts/register/cr">
                         <input type ="hidden" name="modify" value="3"/>
                         <input type ="hidden" name="CRID" value="<?php echo $CR['UserID'];?>"/>
                         <input type="hidden" name="Year" value="<?php echo $Year;?>"/>
                         <input type="hidden" name="Room" value="<?php echo $Room;?>"/>
                         <input type="hidden" name="Department" value="<?php echo $Department;?>"/>
                         <input type="hidden" name="Email" value="<?php echo $Email;?>"/>
                         <input type="submit" value="Replace this CR"/> 
                     </form>
                </div>
            <?php
            }?>
            
        </div>
    </body>
    <script src="http://localhost/xcms/js/jquery.js"></script>
    <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
</html>