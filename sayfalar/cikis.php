<?php
// Oturum başlatılmış mı kontrol ediyoruz
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tüm oturum verilerini temizliyoruz
$_SESSION = [];

// Oturumu tamamen yok ediyoruz
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendiriyoruz
header("Location: index.php?sayfa=Giris");
exit();
?>
