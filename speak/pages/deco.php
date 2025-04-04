<?php 
require_once '../../config.php';


session_destroy();
setcookie($id, $row['id_us'], time() - (86400 * 30 * 12)); //year

header("location:index.php");



?>