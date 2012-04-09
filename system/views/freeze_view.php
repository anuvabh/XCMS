<html>
    <title>
        Set Freeze
    </title>
    <body>
        The CR has already been allocated a set. <br />
        If a new set is to be allocated, the unused codes of the previous set have to be frozen.
    <br />The details of the current CR and the set of codes already allocated:
        <h3>CR details:</h3>
        Department: <?php 
        echo $department."<br />";
        ?>
        Year: <?php 
        echo $year."<br />";
        ?>
        Room: <?php 
        echo $room."<br />";
        ?>
        <h3>Serial number of code-set allocated:
        <?php 
        echo $blockID."/".$blockSetID."<br />";
        ?></h3>
        Are you sure you want to freeze the current set?
        <?php $t = "http://localhost/xcms/blocks/freeze/".$blockID."/".$blockSetID;?>
        <a href="<?php echo $t ?>">Click to freeze set</a>
        <br/>
        <a href="http://localhost/xcms/main">Click to go to home page</a>
    </body>
</html>

