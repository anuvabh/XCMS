<html>
    <head>
        <title>Delete Department</title>
        <script type="text/javascript">
            function validate()
            {
                if (document.getElementById('Dcode').value.length==0)
                {
                    alert("Please enter the Department Code");
                    
                }
                else if(!isNaN(document.getElementById('Dcode').value))
                {
                    alert("Please enter the correct Department Code");
                }
                else
                {
                    if(confirm("Are you sure you want to delete "+document.getElementById('Dcode').value+" department?"))
                    {
                        document.deleteDept.submit();
                    }
                    
                }
            }
        </script>
    
    
    </head>
    <b>Delete a Department</b><br/>
    <?php
        echo $err;
    ?>
    <form name="deleteDept" method="POST">
        <table>
            <tr>
                <td>
                    Enter the Department Code:
                </td>
                <td>
                    <input type="text" id="Dcode" name="Dcode"/>
                </td>
                
            </tr>
        </table>
        <input type="button" onClick="validate();" value="Delete"/>
    </form>
</html>
