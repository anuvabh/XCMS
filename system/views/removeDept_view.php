<!doctype html>
<html lang="en">
    <head>
        <title>Delete Department</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />        
       
        <!--[if lte IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript">
            function validate()
            {
                if (document.getElementById('Dcode').value.length==0)
                {
                    alert("Please enter the Department Code");
                    
                }
                else if(!isNaN(document.getElementById('Dcode').value))
                {
                    alert("Please enter the correct Department Code");
                }
                else
                {
                    if(confirm("Are you sure you want to delete "+document.getElementById('Dcode').value+" department?"))
                    {
                        document.deleteDept.submit();
                    }
                    
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
                    <img src="http://localhost/xcms/images/department.gif" />
                </div>
            </div>
            <b>Delete a Department</b><br/>
            <?php
                echo $err;
            ?>
            <form name="deleteDept" method="POST">
                <table>
                    <tr>
                        <td>
                            Department Code:
                        </td>
                        <td>
                            <input type="text" id="Dcode" name="Dcode"/>
                        </td>

                    </tr>
                </table>
                <br>
                <input class="btn btn-large btn-danger offset1" type="button" onClick="validate();" value="Delete"/>
            </form>
        </div>
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
    </body>
</html>
