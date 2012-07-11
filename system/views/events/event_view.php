<!doctype HTML>
<html lang="en">
    
    <head>
        <title>Events</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css">
       
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->        
        <script type="text/javascript">
        
            function confirmDelete(name, eid)
            {
                
                var msg = "Are you sure you want to delete the event "+name+"?";
                var c = confirm(msg);
                if(c)
                {
                    window.location = "http://localhost/xcms/events/delete/"+eid;
                }
            }
            function confirmOpen(eid)
            {
                
                if(confirm("Be advised that once declared open, existing roles cannot be edited"))
                {
                    window.location = "http://localhost/xcms/events/open/"+eid;
                }
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
            <div class="row" >
                <div class="span9">
                    <?php
                    if(count($events)==0)
                    {
                        echo "<h2>No event Posted yet</h2>";
                    }
                    else
                    {
                        echo "<h2>Department Events:</h2>";?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>                                
                                </tr>
                            </thead>
                            <?php

                                foreach ($events as $row)
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $row['EventName'];//link event to its desc
                                        echo "</td>";
                                        if($row['open']==1)
                                        {
                                        ?>
                                            <td>
                                                <?php echo "Event Open";?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
                                                        Actions
                                                        <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                        <a href='<?php echo site_url()."events/viewAssociated/".$row['EventID'];?>'>Manage</a>
                                                        </li>
                                                        <li>
                                                            <a href='<?php echo site_url()."events/edit/".$row['EventID'];?>'>Add roles</a>
                                                        </li>
                                                        <li>
                                                            <?php echo "<a href='#' onClick='confirmDelete(\"".$row['EventName']."\",\"".$row['EventID']."\");'>Delete</a>"; ?>
                                                        <li>
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>

                                        <?php
                                        }
                                        else if($row['open']==-1) 
                                        {
                                        ?>
                                            <td>
                                                <?php echo "Event Not Declared Open";?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php echo "<a href='#' class='btn btn-success' onClick='confirmOpen(\"".$row['EventID']."\");'>Open Event</a>"; ?>
                                                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                                                        
                                                    <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href='<?php echo site_url()."events/edit/".$row['EventID'];?>'>Edit Details</a>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>

                                        <?php
                                        }
                                        else 
                                        {
                                            echo "<td>";
                                                echo "This event has been closed";?>
                                            
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-danger" onClick="confirmDelete(<?php echo "'".$row['EventName']."','".$row['EventID']."'"; ?>);" href="#">
                                                        Delete
                                                        
                                                    </a>                                                    
                                                </div>
                                            </td>

                                       <?php }
                                }
                            ?>
                        </table>
                    <?php
                    }?>



                </div>
                
                <div class="row span2 offset1">
                    <a class="btn btn-primary btn-large" href='<?php echo site_url();?>events/create'>Create New Event</a>
                </div>
            </div>
            
        </div>
        
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-dropdown.js"></script>
    </body>
</html>