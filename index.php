<?php
session_start();

$korumali_sayfalar = ['Notlar', 'Upload'];
$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'anasayfa';

// kullanıcı giriş yapmadıysa ve o sayfayı kurunuyorsa
if (in_array($sayfa, $korumali_sayfalar) && !isset($_SESSION['user_logged_in'])) {
    // giriş yapmak istediği sayfaya geçici olarak kaydetmek için 
    $_SESSION['redirect_after_login'] = $sayfa;

    // giriş sayfasına yolloyoruz
    header("Location: index.php?sayfa=Giris");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniPaylaşım</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

  <!-- Üst Menü -->
  <header class="site-header">
    <nav class="navbar">
      <div class="logo">
        <h2>UniPaylaşım</h2>
      </div>
      <ul class="nav-links">
        <li><a href="index.php?sayfa=Anasayfa">Ana Sayfa</a></li>
        <li><a href="index.php?sayfa=Notlar">Notlar</a></li>
        <li><a href="index.php?sayfa=Upload">Not Yükle</a></li>
        <li><a href="index.php?sayfa=Giris">Giriş Yap</a></li>
        <li><a href="index.php?sayfa=Kayit">Kayit Ol</a></li>
        <li><a href="index.php?sayfa=Hakkinda">Hakkında</a></li>
        <li><a href="index.php?sayfa=profile">profile</a></li>
      </ul>
    </nav>
  </header>

  <!-- Sayfa İçeriği -->
  <main>
   <?php
if(isset($_GET['sayfa'])){
    $sayfa = $_GET['sayfa'];
    include("sayfalar/".$sayfa.".php");
}else{
    include("sayfalar/Anasayfa.php");
}
?>
  </main>

  <!-- Alt Bilgi -->
  <footer>
    <p>&copy; 2025 UniPaylaşım. Tüm hakları saklıdır.</p>
  </footer>

</body>
</html>
