<?php
include 'dbconn.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['not_yukle'])) {

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Lütfen önce giriş yapın!'); window.location.href='login.php';</script>";
        exit;
    }
    $ders_adi     = $_POST['ders'];
    $hoca_adi     = $_POST['hoca'];
    $bolum        = $_POST['bolum'];
    $sinif        = (int)$_POST['sinif'];
    $donem        = $_POST['donem'];
    $aciklama     = $_POST['aciklama'];
    $kullanici_id = $_SESSION['user_id'];

    $dosya_adi   = time() . "_" . basename($_FILES["dosya"]["name"]);
    $hedef_dizin = "yuklemeler/";
    $hedef_dosya = $hedef_dizin . $dosya_adi;

    if (!is_dir($hedef_dizin)) {
        mkdir($hedef_dizin, 0777, true);
    }

    if (move_uploaded_file($_FILES["dosya"]["tmp_name"], $hedef_dosya)) {

        $sql = "INSERT INTO notlar (kullanici_id, ders_adi, hoca_adi, bolum, sinif, donem, aciklama, dosya_yolu) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $sonuc = $stmt->execute([$kullanici_id, $ders_adi, $hoca_adi, $bolum, $sinif, $donem, $aciklama, $dosya_adi]);

        if ($sonuc) {
            echo "<script>alert('Not başarıyla yüklendi!'); window.location.href='index.php?sayfa=notlar';</script>";
        } else {
            echo "<script>alert('Veritabanı hatası oluştu!');</script>";
        }
    } else {
        echo "<script>alert('Dosya yüklenirken bir hata oluştu!');</script>";
    }
}
?>

<section class="upload-page">
    <div class="upload-container">
        <h1>📤 Not Yükle</h1>
        <p>Ders notlarını، PDF veya Word dosyalarını yükleyerek paylaş!</p>

        <form class="upload-form" method="POST" action="" enctype="multipart/form-data">

            <label for="ders">Ders Adı:</label>
            <input type="text" id="ders" name="ders" placeholder="Örn: Internet Tabanlı programlama" required>

            <label for="hoca">Hoca Adı:</label>
            <input type="text" id="hoca" name="hoca" placeholder="Örn: Dr. Öğr. Üyesi Serkan Aksu" required>

            <label for="bolum">Bölüm:</label>
            <input type="text" id="bolum" name="bolum" placeholder="Örn: Bilgisayar Programcılığı" required>

            <label for="sinif">Sınıf:</label>
            <select id="sinif" name="sinif" required>
                <option value="" disabled selected>Sınıf Seçiniz</option>
                <option value="1">1. Sınıf</option>
                <option value="2">2. Sınıf</option>
                <option value="3">3. Sınıf</option>
                <option value="4">4. Sınıf</option>
            </select>

            <label for="donem">Dönem:</label>
            <select id="donem" name="donem" required>
                <option value="" disabled selected>Dönem Seçiniz</option>
                <option value="Güz">Güz Dönemi</option>
                <option value="Bahar">Bahar Dönemi</option>
            </select>

            <label for="aciklama">Not Hakkında Açıklama (Opsiyonel):</label>
            <textarea id="aciklama" name="aciklama" rows="4" placeholder="Örn: Bu not 3. hafta dersini kapsamaktadır..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;"></textarea>

            <label for="dosya">Dosya Yükle:</label>
            <input type="file" id="dosya" name="dosya" accept=".pdf,.doc,.docx" required>

            <button type="submit" name="not_yukle" class="btn-upload">Yükle</button>
        </form>
    </div>
</section>