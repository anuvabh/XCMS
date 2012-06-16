<html>
    <title>All Users in the System</title>
    <h2>All users in the system:</h2><br/>
    <table border="1">
        
        <tr>
            <td>
                <?php
                    echo '<b>UserID<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>UserType<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>FirstName<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>LastName<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>Department<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>Roll<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>Username<b/>';
                ?>
            </td>
            <td>
                <?php
                    echo '<b>Status of the account<b/>';
                ?>
            </td>
            
        </tr>
        
        <?php
        foreach($users as $x)
        {?>
        <tr>
            <td>
                <?php
                    echo $x['UserID'];
                ?>
            </td>
            <td>
                <?php
                    if($x['UserType'] == 'system')
                        echo "System Administrator";
                    if($x['UserType'] == 'student')
                        echo "Student";
                    if($x['UserType'] == 'dept')
                        echo "Department Administrator";
                    if($x['UserType'] == 'cr')
                        echo "CR";
                ?>
            </td>
            <td>
                <?php
                    echo $x['FirstName'];
                ?>
            </td>
            <td>
                <?php
                    echo $x['LastName'];
                ?>
            </td>
            <td>
                <?php
                    echo $x['Department'];
                ?>
            </td>
            <td>
                <?php
                    echo $x['Roll'];
                ?>
            </td>
            <td>
                <?php
                    echo $x['Email'];
                ?>
            </td>
            <td>
                <?php
                    if($x['Status']==1)
                        echo "Normal";
                    else
                        echo "Frozen";
                ?>
            </td>
            
        </tr>
        <?php
        }?>
    </table>
</html>