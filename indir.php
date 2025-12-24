<?php
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $update = $db->prepare("UPDATE notlar SET indir_sayisi = indir_sayisi + 1 WHERE id = :id");
        $update->execute(['id' => $id]);

        $query = $db->prepare("SELECT dosya_yolu FROM notlar WHERE id = :id");
        $query->execute(['id' => $id]);
        $note = $query->fetch(PDO::FETCH_ASSOC);

        if ($note && !empty($note['dosya_yolu'])) {
            header("Location: yuklemeler/" . $note['dosya_yolu']);
            exit;
        } else {
            echo "Dosya bulunamadı!";
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
