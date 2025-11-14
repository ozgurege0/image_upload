<?php 
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

// --- YENİ EKLENEN TEMİZLEME BLOĞU ---

// "clear_image" adında bir butona tıklandıysa bu blok çalışır
if (isset($_POST['clear_image'])) {
    
    // Hangi alanın temizleneceğini butonun 'value' değerinden alıyoruz
    $fieldToClear = $_POST['clear_image'];
    
    // Güvenlik önlemi: Sadece izin verilen veritabanı sütun adlarının
    // işleme alınmasını sağlamak için bir beyaz liste (whitelist) oluşturun.
    $allowedFields = ['top1', 'top2', 'top4', 'top5'];
    
    if (in_array($fieldToClear, $allowedFields)) {
        
        $tableName = "banner_ads";
        $id = "1";
        $condition = ['id' => $id];
        
        // Sadece ilgili alanı NULL olarak güncelleyecek veriyi hazırla
        $data = [
            $fieldToClear => NULL
        ];
        
        // Veritabanı güncelleme fonksiyonunuzu çağırın
        // (Bu fonksiyonların dosyanıza include edildiğini varsayıyorum)
        $success = updateTable($tableName, $data, $condition, $db);
        
        if ($success) {
            // İşlem başarılıysa, sayfayı yeniden yükleyerek
            // formun ve resimlerin güncel halini göster
            Header("Location: banner_ads.php?job=duzenle");
            exit;
        } else {
            echo "Resim temizleme işlemi başarısız oldu.";
        }
    }
}
// --- TEMİZLEME BLOĞU SONU ---


// Mevcut kaydetme (submit) bloğunuz "elseif" olarak güncellendi
elseif (isset($_POST['submit'])) {

    // (MEVCUT KODUNUZUN TAMAMI BURADA YER ALIYOR)
    // (Hiçbir değişiklik yapmanıza gerek yok)

    if (isset($_FILES['top1']) && $_FILES['top1']['size'] != 0) {
        $top1 = uploadImage('top1');
    }

    if (isset($_FILES['top2']) && $_FILES['top2']['size'] != 0) {
        $top2 = uploadImage('top2');
    }



    if (isset($_FILES['top4']) && $_FILES['top4']['size'] != 0) {
        $top4 = uploadImage('top4');
    }
    
    if (isset($_FILES['top5']) && $_FILES['top5']['size'] != 0) {
        $top5 = uploadImage('top5');
    }




    $tableName = "banner_ads";
    
    $data = [
    'top1_link' => $_POST['top1_link'],
    'top2_link' => $_POST['top2_link'],
    'top4_link' => $_POST['top4_link'],
    'top5_link' => $_POST['top5_link']
    ];

    if ($top1) {
        $data['top1'] = $top1;
    }

    if ($top2) {
        $data['top2'] = $top2;
    }


    if ($top4) {
        $data['top4'] = $top4;
    }

    if ($top5) {
        $data['top5'] = $top5;
    }



    $id = "1";
    $condition = ['id' => $id];
    
    $success = updateTable($tableName, $data, $condition, $db);
    
    if ($success) {
        Header("Location:banner_ads.php?job=duzenle");
        exit;
    } else {
        echo "Güncelleme başarısız.";
    }
}


$banner_ads=$db->prepare("SELECT * FROM banner_ads where id=:id");
$banner_ads->execute(array(
  'id'=> 1
));
$banner_adscek=$banner_ads->fetch(PDO::FETCH_ASSOC);

require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>
      


      
      <!-- Main wrapper -->
      
      <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="card card-body shadow">
        <h4 class="text-center">Banner Ads</h4>

       <form action="" method="post" enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-6 mt-3">
            <label>Üst Banner 1: <img src="<?php echo $url; ?>/<?php echo $banner_adscek["top1"] ?>" width="150px"></label>
            <input type="file" class="form-control" name="top1">
            
            <?php if (!empty($banner_adscek["top1"])): ?>
                <button type="submit" name="clear_image" value="top1" class="btn btn-danger btn-sm mt-1">Resmi Temizle</button>
            <?php endif; ?>
            
        </div>

        <div class="col-md-6 mt-3">
            <label>Üst Banner 2: <img src="<?php echo $url; ?>/<?php echo $banner_adscek["top2"] ?>" width="150px"></label>
            <input type="file" class="form-control" name="top2">
            
            <?php if (!empty($banner_adscek["top2"])): ?>
                <button type="submit" name="clear_image" value="top2" class="btn btn-danger btn-sm mt-1">Resmi Temizle</button>
            <?php endif; ?>
            
        </div>
        

        <div class="col-md-6 mt-3">
            <label>Alt Banner 1: <img src="<?php echo $url; ?>/<?php echo $banner_adscek["top4"] ?>" width="150px"></label>
            <input type="file" class="form-control" name="top4">
            
            <?php if (!empty($banner_adscek["top4"])): ?>
                <button type="submit" name="clear_image" value="top4" class="btn btn-danger btn-sm mt-1">Resmi Temizle</button>
            <?php endif; ?>
            
        </div>

        <div class="col-md-6 mt-3">
            <label>Alt Banner 2: <img src="<?php echo $url; ?>/<?php echo $banner_adscek["top5"] ?>" width="150px"></label>
            <input type="file" class="form-control" name="top5">
            
            <?php if (!empty($banner_adscek["top5"])): ?>
                <button type="submit" name="clear_image" value="top5" class="btn btn-danger btn-sm mt-1">Resmi Temizle</button>
            <?php endif; ?>
            
        </div>
        
        
        <div class="col-md-6 mt-3">
            <label>Üst Banner 1 Link:</label>
            <input type="text" class="form-control" name="top1_link" value="<?php echo $banner_adscek["top1_link"] ?>">
        </div>

        <div class="col-md-6 mt-3">
            <label>Üst Banner 2 Link:</label>
            <input type="text" class="form-control" name="top2_link" value="<?php echo $banner_adscek["top2_link"] ?>">
        </div>

        <div class="col-md-6 mt-3">
            <label>Alt Banner 1 Link:</label>
            <input type="text" class="form-control" name="top4_link" value="<?php echo $banner_adscek["top4_link"] ?>">
        </div>
        
        <div class="col-md-6 mt-3">
            <label>Alt Banner 2 Link:</label>
            <input type="text" class="form-control" name="top5_link" value="<?php echo $banner_adscek["top5_link"] ?>">
        </div>


        <div class="col-md-4">
            <button class="btn btn-primary mt-3" name="submit" type="submit">Kaydet</button>
        </div>
    </div>
</form>

        </div>
      </div>
    </div>
  </div>
<?php require_once("includes/footer.php"); ?>