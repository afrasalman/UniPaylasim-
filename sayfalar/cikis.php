<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = array();
session_destroy();
echo "<script>window.location.href='index.php?sayfa=Giris';</script>";
exit();
?>