<html>
    <title>
        Set of Codes
    </title>
    <body>
        <h2>The Set of codes:</h2>
        <h3>Set Number:<?php echo $blockID."/".$blockSetID?></h3>
        <br />
        <table>
            <tr><td>Code</td>
                <td>Signature of Student</td>
            </tr>
            
            <?php             
            for ($i = 0; $i<$limit; $i++)
            {
                echo "<tr><td>".$codes[$i]."</td><td>_____________________</td></tr>";
            }
        
        ?>
            
        </table>
        <br/>
        <a href ="http://localhost/xcms/main">Click to go to home page </a>
    </body>
</html>