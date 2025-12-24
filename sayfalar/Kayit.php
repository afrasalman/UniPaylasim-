<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kayit_ol'])) {

  $ad_soyad = htmlspecialchars($_POST['ad_soyad']);
  $eposta   = htmlspecialchars($_POST['eposta']);
  $sifre    = $_POST['sifre'];
  $sifre_t  = $_POST['sifre_tekrar'];

  if (empty($ad_soyad) || empty($eposta) || empty($sifre)) {
    echo "<script>alert('Lütfen tüm alanları doldurun!');</script>";
  } elseif ($sifre !== $sifre_t) {
    echo "<script>alert('Şifreler birbiriyle eşleşmiyor!');</script>";
  } else {
    $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);
    $isim_parcalari = explode(" ", $ad_soyad);
    $ad = $isim_parcalari[0];
    $soyad = isset($isim_parcalari[1]) ? $isim_parcalari[1] : "";

    try {
      $sorgu = $db->prepare("INSERT INTO kullanicilar (ad, soyad, eposta, sifre, rol) VALUES (?, ?, ?, ?, ?)");
      $sonuc = $sorgu->execute([$ad, $soyad, $eposta, $hashed_sifre, 'ogrenci']);

      if ($sonuc) {
        echo "<script>alert('Kayıt başarıyla tamamlandı!'); window.location.href='index.php?sayfa=Giris';</script>";
      }
    } catch (PDOException $e) {
      echo "<script>alert('Hata: Bu e-posta adresi zaten kayıtlı!');</script>";
    }
  }
}
?>
<section class="register-page">
  <div class="register-container">
    <h1>📝 Kayıt Ol</h1>
    <p>Yeni bir UniPaylaşım hesabı oluştur ve hemen not paylaşmaya başla!</p>

    <form class="register-form" method="POST" action="">

      <label for="ad">Ad Soyad:</label>
      <input type="text" id="ad" name="ad_soyad" placeholder="Adınızı ve soyadınızı girin" required>

      <label for="email">E-posta:</label>
      <input type="email" id="email" name="eposta" placeholder="örnek@ogrenci.edu.tr" required>

      <label for="password">Şifre:</label>
      <input type="password" id="password" name="sifre" placeholder="••••••••" required>

      <label for="confirm">Şifre (Tekrar):</label>
      <input type="password" id="confirm" name="sifre_tekrar" placeholder="••••••••" required>

      <button type="submit" name="kayit_ol" class="btn-register">Kayıt Ol</button>

      <p class="login-link">
        Zaten bir hesabın var mı? <a href="index.php?sayfa=Giris">Giriş Yap</a>
      </p>
    </form>
  </div>
</section>