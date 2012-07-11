<!doctype HTML>
<html lang="en">
    
    <head>
        <title>
            <?php
                echo $user[0]['FirstName']." ".$user[0]['LastName'];
            ?>
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
       
         <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
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
            <?php
           

                if($user[0]['UserType'] != 'dept')
                {
                    echo '<div class="row" style="border-bottom: solid #cccccc 1px; margin-bottom: 10px;" >
                <div class="span12" style="height: 60px; margin-bottom: 10px; " align="right">
                    <img src="http://localhost/xcms/images/student.gif" />
                </div>
            </div>';
                    echo "<h2>".$user[0]['FirstName']." ".$user[0]['LastName']."</h2><br/>";
                    echo "Roll: ".$user[0]['Roll']."<br/>";
                    echo "Department: ".$user[0]['Department']."<br/>";
                    echo "Email: ".$user[0]['Email']."<br/>";
                    return;
                }
                else
                {
                    echo '<div class="row" style="border-bottom: solid #cccccc 1px; margin-bottom: 10px;" >
                <div class="span12" style="height: 60px; margin-bottom: 10px; " align="right">
                    <img src="http://localhost/xcms/images/department.gif" />
                </div>
            </div>';
                    echo "<h2>".$user[0]['FirstName']." ".$user[0]['LastName']."</h2><br/>";
                    $num = count($user['events']);
                    echo "Number of events being organised:".$num;
                    if($num>0)
                    {
                        echo "<table class='table table-striped'>";

                        echo "<thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Starting Date</th>
                                    <th>End Date</th>                                
                                </tr>
                        </thead>";

                        for($i = 0; $i < $num; $i++)
                        {
                            echo "<tr>";
                            echo "<td><a href='".site_url()."events/profile/".$user['events'][$i]['EventID']."'>".$user['events'][$i]['EventName']."</a></td>";
                            echo "<td>".$user['events'][$i]['StartDate']."</td>";
                            echo "<td>".$user['events'][$i]['EndDate']."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
            ?>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
    </body>
</html>