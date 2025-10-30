<?php

// Kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: index.php?sayfa=Giris");
    exit();
}

// Geçici örnek veriler (ileride veritabanından alınacak)
$isim = $_SESSION['user_name'] ?? "Afra Salman";
$email = $_SESSION['user_email'] ?? "ogrenci@uni.edu.tr";
$tarih = "Ekim 2025";
$universite = "Bartın Üniversitesi";
$bolum = "Bilgisayar Programcılığı";
?>

<section class="profile-page">
  <div class="profile-container">
    <h1>👩‍🎓 Merhaba, <?php echo htmlspecialchars($isim); ?>!</h1>
    <p class="profile-subtitle">Hesap bilgilerini aşağıda görebilirsin.</p>

    <div class="profile-card">
      <img src="images/profile.png" alt="Profil Fotoğrafı" class="profile-img">

      <div class="profile-info">
        <p><strong>📧 E-posta:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>🏫 Üniversite:</strong> <?php echo $universite; ?></p>
        <p><strong>🔬 Bölüm:</strong> <?php echo $bolum; ?></p>
        <p><strong>📅 Kayıt Tarihi:</strong> <?php echo $tarih; ?></p>
      </div>
    </div>

    <div class="profile-actions">
      <a href="index.php?sayfa=Upload" class="btn primary">📤 Yeni Not Yükle</a>
      <a href="index.php?sayfa=Notlar" class="btn secondary">📚 Notlara Göz At</a>
      <a href="index.php?sayfa=Cikis" class="btn logout">🚪 Çıkış Yap</a>
    </div>
  </div>
</section>
