<html>
    <?php
        echo $errorMessage;
    ?>
<form method="POST">
    <table>
        <tr>
            <td>CR Username:</td><td><input type="text" name="cr"/></td>
        </tr>
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
             <tr><td>Number of codes:</td><td><input type="text" name="net" /></td></tr>
    </table>
    <input type="submit" value="Generate" />
</form>
</html