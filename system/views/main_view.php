<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SXC-CMS</title>
    
    <link rel="stylesheet" type="text/css" href="http://localhost/XCMS/styles/960gs.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/XCMS/styles/home.css" />
</head>

<body>
<div class="container_16" id="wrapper">

  <div class="grid_16" id="header">
  
  	<div class="grid_4" id="emblem">
    	<img src="http://localhost/XCMS/images/150yrsLogo.jpg" style="height:190px;width: 200px;" />
    </div>
  	<div class="grid_11" id="banner"></div>
  </div>
    
  <div class="grid_10" id="info">
  	<p> lorem ipsum dorel set amet </p>
  </div>
  
	<div class="grid_5" id="form">
		
        <p><?php
			echo $message."<br />".$errorcode;
		?></p>
        <form method="post" action="accounts/login">
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
        <a style="text-decoration:none;color:#900; "href="">Register Here</a></p>
  	</div>
	
    <div class="grid_16" id="footer">
    	&copy St. Xavier's College 2012
    </div> 
    
</div>
</body>
</html>
