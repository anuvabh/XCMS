<html>
    <head>
         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
    </head>
    <body>
        <div class="container">
            DEPARTMENT ADMIN VIEW PAGE
            <br />
            <?php
                echo "Welcome, ".$FirstName." ".$LastName;
                echo "<br />";
            ?>
                <br />
            <a href="http://localhost/xcms/events/create">Create an event</a><br />
            <a href="http://localhost/xcms/events/view">View events</a><br /> 
            <a href="http://localhost/xcms/accounts/changePassword">Click to change password</a><br />
            <a href="http://localhost/xcms/accounts/logout">Click to logout</a>

        </div>
    </body>
</html>