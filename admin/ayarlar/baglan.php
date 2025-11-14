<?php 
try{
    $db=new PDO("mysql:host=localhost;dbname=image_upload;charset=utf8","root","mysql");

}catch(PDOEXception $hata){
    echo $hata->getMessage();
}
$url = "http://localhost/image_upload";



function permalink($text)
{
   $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.', ',', ';', ':', '!', '?', '&', '=', '@', '<', '>', '(', ')', '[', ']', '{', '}');
   $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
   $text = strtolower(str_replace($find, $replace, $text));
   $text = preg_replace("@[^A-Za-z0-9\-_]@i", ' ', $text);
   $text = trim(preg_replace('/\s+/', ' ', $text));
   $text = str_replace(' ', '-', $text);

   return $text;
}

function insertIntoTable($tableName, $data, $db) {
    // Tablo sütunlarını ve yer tutucuları oluştur
    $columns = implode(',', array_keys($data));
    $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($data)));

    // SQL sorgusunu hazırla
    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $db->prepare($sql);

    // Verileri temizle ve yer tutuculara bağla
    $sanitizedData = [];
    foreach ($data as $key => $value) {
        $sanitizedData[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    // Sorguyu çalıştır
    return $stmt->execute($sanitizedData);
}

function updateTable($tableName, $data, $condition, $db) {
    // Sütunları dinamik olarak ayarla: "column=:column" formatında
    $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

    // Şart (WHERE) kısmını oluştur
    $whereClause = implode(' AND ', array_map(fn($key) => "$key = :where_$key", array_keys($condition)));

    // SQL sorgusunu oluştur
    $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
    $stmt = $db->prepare($sql);

    // Verileri bağla ve temizle
    $sanitizedData = [];
    foreach ($data as $key => $value) {
        $sanitizedData[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    foreach ($condition as $key => $value) {
        $sanitizedData["where_$key"] = $value; // WHERE şartlarını ekle
    }

    // Sorguyu çalıştır
    return $stmt->execute($sanitizedData);
}
function uploadImage($fileInputName, $uploadsDir = '../assets/img') {
    // Check if file input is set and there is no upload error
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        return false; // Return false if no file is uploaded or an error occurs
    }

    $tmpName = $_FILES[$fileInputName]["tmp_name"];
    $name = $_FILES[$fileInputName]["name"];
    
    // Get the file extension
    $ext = strtolower(substr($name, strpos($name, ".") + 1));
    
    // Generate a unique name
    $uniqueId = rand(20000, 32000) . rand(20000, 32000);
    $newFileName = $uniqueId . $name;
    
    // Define the reference image path
    $refImgPath = substr($uploadsDir, 3) . "/" . $newFileName;
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($tmpName, "$uploadsDir/$newFileName")) {
        return $refImgPath; // Return the file path if upload is successful
    }

    return false; // Return false if upload fails
}

function uploadImage2($fileInputName, $uploadsDir = 'assets/upload_images') {
    // Dosya yüklendi mi kontrol et
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        return false;
    }

    $tmpName = $_FILES[$fileInputName]["tmp_name"];
    $name = $_FILES[$fileInputName]["name"];

    // İzin verilen uzantılar
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Dosya uzantısını al
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    // Uzantı kontrolü
    if (!in_array($ext, $allowedExtensions)) {
        return false; // Geçersiz dosya türü
    }

    // MIME türünü de kontrol et (ek güvenlik)
    $mimeType = mime_content_type($tmpName);
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowedMimeTypes)) {
        return false; // Gerçek MIME türü de resim değilse reddet
    }

    // Benzersiz dosya adı oluştur
    $uniqueId = rand(20000, 32000) . rand(20000, 32000);
    $newFileName = $uniqueId . '.' . $ext;

    // Hedef dosya yolu
    $refImgPath = $uploadsDir . "/" . $newFileName;

    // Klasör yoksa oluştur
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
    }

    // Dosyayı klasöre taşı
    if (move_uploaded_file($tmpName, $refImgPath)) {
        return $refImgPath; // Başarılıysa dosya yolunu döndür
    }

    return false;
}

?>
