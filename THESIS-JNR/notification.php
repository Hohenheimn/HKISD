<?php
require_once 'connect.php';
$result_notif = $mysqli->query("SELECT * FROM tbl_installmentaccount WHERE statuss = 'down payment'");
echo $result_notif->num_rows;
?>