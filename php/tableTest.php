<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Table</title>
</head>
<body>
<form action="" method="get">
    ROWS <input type="text" name="rows"> COLUMNS <input type="text" name="cols"><input type="submit" value="Generate">
</form>
<?php
// Just a check you can change as your needs
if(isset($_GET['rows'])){

    $rows=$_REQUEST['rows'];
    $cols=$_REQUEST['cols'];
    echo '<table border="1">';
    for($row=1;$row<=$rows;$row++){
        echo '<tr>';

        for($col=1;$col<=$cols;$col++){
            echo '<td> sample value </td>';
        }

        echo '</tr>';
    }
    echo '</table>';

}


?>
</body>
</html>