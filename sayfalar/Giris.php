<?php
// session başlaması ve hatta olmaması için kontrol etmek
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // giriş bilgileri örneği sonra değiştireceğiz
    $dogru_email = "ogrenci@uni.edu.tr";
    $dogru_sifre = "1234";

    if ($email == $dogru_email && $password == $dogru_sifre) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $email;

        // eğer kullanıcı kurulan sayfaya girmeya çalışırse 
        if (isset($_SESSION['redirect_after_login'])) {
            $hedef = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']); 
            header("Location: index.php?sayfa=$hedef");
            exit();
        }
        header("Location: index.php?sayfa=Anasayfa");
        exit();
    } else {
        $hata = "E-posta veya şifre yanlış!";
    }
}
?>
<section class="login-page">
  <div class="login-container">
    <h1>👩‍🎓 Giriş Yap</h1>
    <p>UniPaylaşım hesabına giriş yaparak notlarını yükle veya indir.</p>

    <?php if (isset($hata)): ?>
      <p style="color:red;"><?php echo $hata; ?></p>
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
