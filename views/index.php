<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>my site</title>
</head>
<body>

<?php
    if(count($employees) == 0){
        ?>
    <h2> There are not any employees</h2>

<?php
    }
else{
    ?>
    <ul>
    <?php
    foreach($employees as $employee){
        ?>
        <li><?php echo $employee['firstName'] ?></li>
        <?php
    }
    ?>
    </ul>
        <?php
}

?>
</body>
</html>