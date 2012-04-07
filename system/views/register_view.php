<html>
    <p><?php echo $errorMessage?></p>
    <form method="post" action="http://localhost/xcms/accounts/register">
        <table>
   
            <tr><td>Registration Code:</td><td><input type="text" name="Code" /></td></tr>
            <tr><td>First Name:</td><td><input type="text" name="FirstName" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName'];?>"/></td></tr>
            <tr><td>Last Name:</td><td><input type="text" name="LastName" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName'];?>"/></td></tr>
            <tr><td>Email ID:</td><td><input type="text" name="Email" value="<?php if (isset($_POST['Email'])) echo $_POST['Email'];?>"/></td></tr>
            <tr><td>Roll Number:</td><td><input type="text" name="Roll" value="<?php if (isset($_POST['Roll'])) echo $_POST['Roll'];?>"/></td></tr>
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
            <tr><td>Password:</td><td><input type="password" name="Password1" /></td></tr>
            <tr><td>Confirm Password:</td><td><input type="password" name="Password" /></td></tr>
        </table>
        <input type="submit" value="Register" />
    </form>
</html>