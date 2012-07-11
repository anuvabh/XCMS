<!doctype HTML>
<html lang="en">
    
    <head>
        <title>New Set</title>
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
            <div class="row alert alert-info">
                <?php
                    echo $errorMessage;
                ?>
            </div>
            <form method="POST">
                <table>
                    <tr>
                        <td>CR Username:</td><td><input type="text" name="cr" value="<?php if (isset($_POST['cr'])) echo $_POST['cr'];?>"/></td>
                    </tr>
                    <tr><td>Room No.:</td><td><input type="text" name="Room" value="<?php if (isset($_POST['Room'])) echo $_POST['Room'];?>"/></td></tr>
                        <tr><td>Department:</td>
                            <td><select name="Department"> 
                                <?php
                                    foreach($dept as $row)
                                    {
                                        echo "<option>".$row['Code']."</option>";
                                    }
                                ?>
                                </select>
                            </td></tr>
                        <tr><td>Year:</td>
                            <td><select name="Year"> 
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </td></tr>
                        <tr><td>Number of codes:</td><td><input type="text" name="net" /></td></tr>
                </table>
                <br>
                <input class="btn btn-large btn-info offset1" type="submit" value="Generate" />
                <br/>
                <a class="btn btn-warning" href="http://localhost/xcms/main">Cancel</a>
            </form>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
    </body>
</html>