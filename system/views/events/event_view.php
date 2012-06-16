<html>
    <head>
        <script type="text/javascript">
        
            function confirmation(name, eid)
            {
                
                var msg = "Are you sure you want to delete the event "+name+"?";
                var c = confirm(msg);
                if(c)
                {
                    window.location = "http://localhost/xcms/events/delete/"+eid;
                }
            }
        </script>
    </head>
    <table>
        <?php
            foreach ($events as $row)
            {
                echo "<tr>";
                    echo "<td>";
                        echo $row['EventName'];//link event to its desc
                    echo "</td>";
                    echo "<td>";
                        echo "<a href='http://localhost/xcms/events/edit/".$row['EventID']."'>Edit</a>";
                    echo "</td>";
                    echo "<td>";
                        echo "\n<input type='button' value='Delete' onClick=\"confirmation('".$row['EventName']."','".$row['EventID']."');\">";
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <br/>
    <a href='http://localhost/xcms/'>Home</a>
</html>