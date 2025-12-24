<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
  echo "<script>window.location.href='index.php?sayfa=Anasayfa';</script>";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];
  if (!empty($email) && !empty($password)) {
    try {
      $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE eposta = ?");
      $sorgu->execute([$email]);
      $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

      if ($kullanici && password_verify($password, $kullanici['sifre'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $kullanici['id'];
        $_SESSION['user_name'] = $kullanici['ad'] . " " . $kullanici['soyad'];

        echo "<script>window.location.href='index.php?sayfa=Anasayfa';</script>";
        exit();
      } else {
        $hata = "E-posta veya şifre yanlış! Kayıtlı değilseniz lütfen Kayıt Ol sayfasından yeni bir hesap oluşturun.";
      }
    } catch (PDOException $e) {
      $hata = "Hata oluştu.";
    }
  }
}
?>
<section class="login-page">
  <div class="login-container">
    <h1>👩‍🎓 Giriş Yap</h1>
    <p>UniPaylaşım hesabına giriş yaparak notlarını yükle veya indir.</p>

    <?php if (isset($hata)): ?>
      <p style="color:red; text-align:center; font-weight:bold;"><?php echo $hata; ?></p>
    <?php endif; ?>

    <form class="login-form" method="POST" action="">
      <label for="email">E-posta:</label>
      <input type="email" name="email" id="email" placeholder="örnek@ogrenci.edu.tr" required>

      <label for="password">Şifre:</label>
      <input type="password" name="password" id="password" placeholder="••••••••" required>

      <button type="submit" class="btn-login">Giriş Yap</button>

      <p class="register-link">
        Hesabın yok mu? <a href="index.php?sayfa=Kayit">Kayıt Ol</a>
      </p>
    </form>
  </div>
</section>