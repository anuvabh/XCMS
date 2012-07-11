<!doctype HTML>
<html lang="en">
    <head>
        
        <title>Event Registration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css">
        
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript">
            function validate()
            {
                document.register.submit();
//                
            }
        </script>
    </head>
    <?php
    if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'system'|| $this->session->userdata("UserType") == 'dept') 
    {
        $reg = 0;
    }
    else
    {
        $reg = 1;
    }
    ?>
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
                    <img src="http://localhost/xcms/images/events.gif">
                </div>
            </div>
            <?php 
            if(count($eventDetails[0])==0)
                echo "<h3>No Events Posted Yet</h3>";
            else
            {
            ?>
            <div class="row span11 center">
                <form action='<?php echo site_url()."events/register/".$EventID;?>' name="register" method="POST">
                    <table class="table table-striped">
                        <tr>
                            <td>
                                Event Name:
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['EventName'];
                                ?>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                Start Date:
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['StartDate'];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                End Date:
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['EndDate'];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Department:
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['Department'];
                                ?>
                            </td>
                        </tr>
                        <?php
                        $eventDetails[0]['SocialCredit'] = $eventDetails[0]['SocialCredit']==1 ? "Yes" : "No";
                        ?>
                        <tr>
                            <td>
                                Social Credit awarded for this event?
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['SocialCredit'];
                                ?>
                            </td>
                        </tr>

                        <?php
                        if($eventDetails[0]['Details'])
                        {?>
                        <tr>
                            <td>
                                Details:
                            </td>
                            <td>
                                <?php
                                    echo $eventDetails[0]['Details'];
                                ?>
                            </td>
                        </tr>
                        <?php }?>

<!--                        <tr>
                            <td></td>
                            <td></td>
                        </tr>-->
                        <?php if($reg == 1)
                        {?>
                            <tr>
                                <td>
                                    <strong>Please select a role:</strong>
                                </td>
                                <td></td>
                            </tr>
                            <?php if(isset($roles))
                            {    
                                echo "<tr><td><strong>Role Name</strong></td><td><strong>Credit to be awarded (in ".$eventDetails[0]['Unit']." unit)</strong></td></tr>";
                                for($i=0; $i<count($roles);$i++)
                                {
                                    if($i==0)
                                        echo "<tr><td><input type='radio' value='".$roles[$i]['Role']."' name='roleSelect' checked='checked'>".$roles[$i]['Role']."</td><td>".$roles[$i]['Credit']."</td></tr>";
                                    else
                                        echo "<tr><td><input type='radio' value='".$roles[$i]['Role']."' name='roleSelect'>".$roles[$i]['Role']."</td><td>".$roles[$i]['Credit']."</td></tr>";
                                }
                            }

                        ?>
                    </table>
                    <input type="hidden" value="1" name="Posted">
                </form>
            </div>
            <input type="button" class="offset5 btn btn-success btn-large" value="Register" onClick="validate();"/>
            <?php }
            }
            ?>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-dropdown.js"></script>
    </body>
</html>