<?php
require '../ayarlar/baglan.php'; // veritabanı bağlantısı

$limit = $_GET['length'];
$start = $_GET['start'];
$draw = $_GET['draw'];
$search = $_GET['search']['value'];

// Toplam kayıt sayısı
$totalQuery = $db->query("SELECT COUNT(*) as total FROM videos");
$totalData = $totalQuery->fetch(PDO::FETCH_ASSOC);
$totalFiltered = $totalData['total'];

// Arama varsa filtreli sorgu
if (!empty($search)) {
    $query = $db->prepare("SELECT * FROM videos WHERE title LIKE :search ORDER BY id DESC LIMIT :start, :limit");
    $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
} else {
    $query = $db->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT :start, :limit");
}

$query->bindValue(':start', (int)$start, PDO::PARAM_INT);
$query->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Filtreli kayıt sayısı
if (!empty($search)) {
    $countQuery = $db->prepare("SELECT COUNT(*) as total FROM videos WHERE title LIKE :search");
    $countQuery->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $countQuery->execute();
    $totalFiltered = $countQuery->fetch(PDO::FETCH_ASSOC)['total'];
}

echo json_encode([
    "draw" => intval($draw),
    "recordsTotal" => $totalData['total'],
    "recordsFiltered" => $totalFiltered,
    "data" => $data
]);
?>
