<html>
    <body>
        <?php echo $Err."<br/>";?>
        <table>
            <form method="POST" action="http://localhost/xcms/accounts/changePassword">
                <tr>
                    <td>Enter current Password:</td>
                    <td><input type="password" name="oldPassword"/></td>                    
                </tr>
                <tr>
                    <td>Enter new Password:</td>
                    <td><input type="password" name="newPassword"/></td>                    
                </tr>
                <tr>
                    <td><input type="submit" value="Change Password"/></td>
                </tr>
            </form>
        </table>
    </body>
</html>
