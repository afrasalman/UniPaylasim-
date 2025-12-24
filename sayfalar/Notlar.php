<?php
include 'dbconn.php';

$sql = "SELECT n.*, CONCAT(k.ad, ' ', k.soyad) AS ad_soyad FROM notlar n 
        LEFT JOIN kullanicilar k ON n.kullanici_id = k.id 
        ORDER BY n.id DESC";
$sorgu = $db->query($sql);
$notlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="notes-page">
  <h1 class="page-title">📘 Ders Notları</h1>
  <p class="page-subtitle">İhtiyacın olan ders notlarını ara, incele ve kolayca indir.</p>

  <div class="search-box">
    <input type="text" placeholder="Ders adı, kodu veya not başlığı ara...">
    <button class="btn-search">Ara</button>
  </div>

  <div class="note-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
    <?php foreach ($notlar as $not): ?>
      <div class="note-card" style="min-height: 450px; padding: 20px;">

        <div class="note-header">
          <span class="note-tag" style="font-size: 11px; padding: 5px 10px;">
            <?php echo htmlspecialchars($not['bolum']); ?> <?php echo htmlspecialchars($not['sinif']); ?> / <?php echo htmlspecialchars($not['donem']); ?>
          </span>
          <h3 style="margin-top: 10px;"><?php echo htmlspecialchars($not['ders_adi']); ?></h3>
        </div>

        <p class="note-description" style="margin: 15px 0; min-height: 50px;">
          <?php echo !empty($not['aciklama']) ? htmlspecialchars($not['aciklama']) : "Bu ders notu hakkında ek bir açıklama bulunmamaktadır."; ?>
        </p>

        <div class="note-info" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; font-size: 13px; border-top: 1px solid #f0f0f0; padding-top: 10px;">
          <span style="white-space: nowrap;">👨‍🏫 Hoca: <?php echo htmlspecialchars($not['hoca_adi']); ?></span>
          <span style="white-space: nowrap;">📅 <?php echo date('d.m.Y', strtotime($not['yukleme_tarihi'])); ?></span>
          <span style="width: 100%;">👤 Yükleyen: <?php echo htmlspecialchars($not['ad_soyad']); ?></span>
        </div>

        <div class="stats-container" style="margin-bottom: 10px;">
          <span style="color: #666; font-size: 14px;">
            <i class="fas fa-download"></i> <?php echo $not['indir_sayisi']; ?> İndirilme
          </span>
        </div>

        <div class="download-container" style="margin-bottom: 15px;">
          <a href="indir.php?id=<?php echo $not['id']; ?>" class="btn-download" target="_blank"
            style="background-color: #4a90e2; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; display: inline-block;">
            İndir
          </a>
        </div>

        <div class="comment-section" style="margin-top: 15px;">
          <h4>💬 Yorumlar</h4>
          <div class="comments-list" style="margin-bottom: 10px;">
            <small style="color: #999;">Henüz yorum yok.</small>
          </div>
          <form class="comment-form">
            <input type="text" placeholder="Yorum ekle..." required style="width: 70%;">
            <button type="submit">Gönder</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>