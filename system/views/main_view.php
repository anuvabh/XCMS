<!doctype html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script>
            $(document).ready(function (){
                $('.carousel').carousel({interval :3000})  
                <?php
                    if($errorcode != 0)
                        echo "$('#login-box').modal('show')";
                ?>
            }); 
        </script>
    </head>

    <body>

        <div class="container">

            <div class="row">
                <div class="span12 page-header center" id="heading">
                    <img src="http://localhost/xcms/images/150yrsLogo.gif" style="width:125px; height:120px;">
                    <h2>St. Xavier's College(Autonomous), Kolkata</h2>
                    <h3>Credits Management System</h3>
                </div>
            </div>
            <div class="row">
               
                <!-- the awesome carousel-->
                <div class="span7 shadow" id="carousel-div">
                     
                    <div id="feature-show" class="carousel slide">
                       
                        <div class="carousel-inner">

                            <div class="active item">
                                <img src="http://localhost/xcms/images/carousel1.gif" alt="">							
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel2.gif" alt="">								
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel3.gif" alt="">								
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel4.gif" alt="">
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel5.gif" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#feature-show" data-slide="prev">&lsaquo;</a>
                        <a class="right carousel-control" href="#feature-show" data-slide="next">&rsaquo;</a>
                    </div>
                </div>
                <!---carousel-->

                <!--signup-in buttons container-->
                <div class="span3 offset1 shadow center" id="login" style="height: 230px;">

                    <h2 style="color:#FFFFFF; text-shadow:5px 2px 10px #000;">Join <em>Xaverians</em> In The Cloud</h2><br />
                    <div id="login-box" class="modal hide fade">
                        <div class="modal-header">
                                <button class="close" data-dismiss="modal">&times;</button>
                                <?php
                                if($errorcode == 0)
                                    echo "<h3>".$message."</h3><br />";
                                else
                                    echo "<h3>".$message."</h3><br />Error Code=".$errorcode;
                                ?>
                        </div>

                        <div class="modal-body">
                            
                            <form class="well" method="POST" action=<?php echo "'".site_url()."accounts/login'";?>>
                                <table>
                                    <tr>
                                        <td>Username:</td>
                                        <td><input type="text" name="username" /></td>
                                    </tr>
                                    <tr>
                                        <td>Password:</td>
                                        <td><input type="password" name="password" /></td>
                                    </tr>
                                </table>
                                <input type="submit" class="btn btn-success btn-large" value="Log In" name="submit" />
                            </form>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" data-dismiss="modal" >Close</a>
                        </div>
                    </div>
                    <a data-toggle="modal" href="#login-box" class="span2 btn btn-info btn-large">Login</a>
                    <br><br><br>
                    <a href="<?php echo site_url().'accounts/register';?>" class="span2 btn btn-info btn-large">Register</a>
                </div>

            </div>
            <div class="row center" style="font-family: Arial;margin-top: 70px;">
                <a href="#">About</a>
                -
                <a href="http://sxccal.edu">&copy;St. Xavier's College(Autonomous), Kolkata</a>
                -
                <a href="#">Blog</a>
            </div>
        </div>
        
        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.min.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-transition.js"></script>
        
    </body>
</html>