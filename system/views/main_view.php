<!doctype html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
    </head>

    <body>
        <div class="container" id="wrapper">

            <div class="row">
                <div class="span12 page-header center" id="heading">
                    <img src="http://localhost/xcms/images/logo.jpg" style="width:125px; height:120px;">
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
                                <img src="http://localhost/xcms/images/carousel1.jpg" alt="">							
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel2.jpg" alt="">								
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel3.jpg" alt="">								
                            </div>
                            <div class="item">
                                <img src="http://localhost/xcms/images/carousel4.jpg" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#feature-show" data-slide="prev">&lsaquo;</a>
                        <a class="right carousel-control" href="#feature-show" data-slide="next">&rsaquo;</a>
                    </div>
                </div>
                <!---carousel-->

                <!--signup-in buttons container-->
                <div class="span3 offset1 shadow center" id="login">

                    <h2 style="color:#FFFFFF; text-shadow:5px 2px 10px #000;">Join <em>Xaverians</em> In The Cloud</h2><br />
                    <div id="login-box" class="modal hide fade">
                        <div class="modal-header">
                                <button class="close" data-dismiss="modal">&times;</button>
                                <h3>Enter Account Details</h3>
                        </div>

                        <div class="modal-body">
                            <form class="well" method="POST" action="http://localhost/xcms/accounts/login">
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
                                <input type="submit" class="btn btn-success" value="Log In" name="submit" />
                            </form>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" data-dismiss="modal" >Close</a>
                        </div>
                    </div>
                    <a data-toggle="modal" href="#login-box" class="btn btn-info btn-large">Login</a>
                    <br /><br />
                    <a href="http://localhost/xcms/accounts/register" class="btn btn-info btn-large">Register</a>
                </div>

            </div>
        </div>

        <script src="http://localhost/xcms/js/jquery.js"></script>
        <script src="http://localhost/xcms/js/bootstrap.js"></script>
        <script src="http://localhost/xcms/js/bootstrap-transition.js"></script>

        <!-- <script src="js/bootstrap-carousel.js"></script>
        <script src="js/bootstrap-modal.js"></script> -->
    </body>
</html>



<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SXC-CMS</title>

        <link rel="stylesheet" type="text/css" href="http://localhost/xcms/styles/960gs.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/xcms/styles/home.css" />
    </head>

    <body>
        <div class="container_16" id="wrapper">

            <div class="grid_16" id="header">

                <div class="grid_4" id="emblem">
                    <img src="http://localhost/xcms/images/150yrsLogo.jpg" style="height:190px;width: 200px;" />
                </div>

                <div class="grid_11" id="banner"></div>
            </div>

            <div class="grid_10" id="info">
                <p> lorem ipsum dorel set amet </p>
            </div>

            <div class="grid_5" id="form">

            <p><?php
                if($errorcode == 0)
                {
                    echo $message."<br />";
                }
                else
                {
                    echo $message."<br />Error Code=".$errorcode;
                }
                ?>
            </p>
            <form method="post" action="http://localhost/xcms/accounts/login">
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
                <input type="submit" value="Log In" name="submit" />
            </form>

            <p><strong>New</strong> to the College? <br />
            <a style="text-decoration:none;color:#900;" href="http://localhost/xcms/accounts/register">Register Here</a></p>
            </div>

            <div class="grid_16" id="footer">
            &copy St. Xavier's College 2012
            </div> 

        </div>
    </body>
</html>-->