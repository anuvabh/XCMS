<!doctype html>
<html lang="en">
    <head>
        <title>Current Events</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://localhost/xcms/css/site.css" />
    </head>
    <body>
        <div class="container">
            <div class="row" align="right" style="border-bottom: solid #cccccc 1px;">
                <img src="http://localhost/xcms/images/pageHeader11.gif">
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Starting Date</th>
                            <th>End Date</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                <?php

                    foreach ($events as $row)
                    {
                        echo "<tr>";
                            echo "<td>";
                                echo $row['EventName'];//link event to its desc
                            echo "</td>";
                            echo "<td>";
                                echo substr($row['StartDate'],8,2)."/".substr($row['StartDate'],5,2)."/".substr($row['StartDate'],0,4);
                            echo "</td>";
                            echo "<td>";
                                echo $row['EndDate'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['Department'];
                            echo "</td>";
                            echo "<td>";
                                echo "\n<a class='btn btn-success' type='button' href='http://localhost/xcms/events/register/".$row['EventID']."'>Register</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                ?>
                </table>
            </div>
        </div>
    </body>
</html>
