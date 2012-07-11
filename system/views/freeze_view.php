<!doctype HTML>
<html lang="en">
    
    <head>
        <title>Freeze Block</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
       
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->    
    </head>
    <body style="padding-top: 50px;">
        
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
                    <img src="http://localhost/xcms/images/codes.gif" />
                </div>
            </div>
            The CR has already been allocated a set. <br />
            If a new set is to be allocated, the unused codes of the previous set have to be frozen.
        <br />The details of the current CR and the set of codes already allocated:
            <h3>CR details:</h3>
            Department: <?php 
            echo $department."<br />";
            ?>
            Year: <?php 
            echo $year."<br />";
            ?>
            Room: <?php 
            echo $room."<br />";
            ?>
            <h3>Serial number of code-set allocated:
            <?php 
            echo $blockID."/".$blockSetID."<br />";
            ?></h3>
            Are you sure you want to freeze the current set?
            <?php $t = "http://localhost/xcms/blocks/freeze/".$blockID."/".$blockSetID;?>
            <br><br>
            <a class="offset1 btn btn-danger" href="<?php echo $t ?>">Freeze Set</a>
            <br><br>
            <a class="btn" href="http://localhost/xcms/main">Home</a>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
    </body>
</html>

