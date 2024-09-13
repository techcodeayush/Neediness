

<?php
//change mysqli_connect(host_name,username, password); 
$connection = mysqli_connect("localhost", "root", "");
if (mysqli_connect_error()) {
    echo "Connection failed: ". mysqli_connect_error();
    exit();
}
$db = mysqli_select_db($connection, 'demo');
if (!$db) {
    echo "Database selection failed: ". mysqli_error($connection);
    exit();
}
?>
