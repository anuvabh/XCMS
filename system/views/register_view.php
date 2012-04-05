<html>
    <p><?php echo $errorMessage?></p>
    <form method="post" action="http://localhost/xcms/accounts/register">
        <table>
   
            <tr><td>First Name:</td><td><input type="text" name="FirstName" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName'];?>"/></td></tr>
            <tr><td>Last Name:</td><td><input type="text" name="LastName" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName'];?>"/></td></tr>
            <tr><td>Email ID:</td><td><input type="text" name="Email" /></td></tr>
            <tr><td>Roll Number:</td><td><input type="text" name="Roll" /></td></tr>
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
            <tr><td>Password:</td><td><input type="password" name="Password1" /></td></tr>
            <tr><td>Confirm Password:</td><td><input type="password" name="Password" /></td></tr>
        </table>
        <input type="submit" value="Register" />
    </form>
</html>


