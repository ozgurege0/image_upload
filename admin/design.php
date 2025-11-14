<?php 
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if (isset($_POST['submit'])) {

    if (isset($_FILES['logo']) && $_FILES['logo']['size'] != 0) {
        $logo = uploadImage('logo');
    }
  
    if (isset($_FILES['favicon']) && $_FILES['favicon']['size'] != 0) {
        $favicon = uploadImage('favicon');
    }

    $tableName = "design";
  
    $data = [
        'title' => $_POST['title'],
        'metadesc' => $_POST['metadesc'],
        'metakeyword' => $_POST['metakeyword'],
          'home_footer' => $_POST['home_footer'],
        'home_title' => $_POST['home_title'],
        'home_content' => $_POST['home_content']
    ];

    if ($logo) {
        $data['logo'] = $logo;
    }

    if ($favicon) {
        $data['favicon'] = $favicon;
    }

    $id = "1";
    $condition = ['id' => $id];
  
    $success = updateTable($tableName, $data, $condition, $db);
  
    if ($success) {
        Header("Location:design.php?job=duzenle");
        exit;
    } else {
        echo "Güncelleme başarısız.";
    }
  }

$design=$db->prepare("SELECT * FROM design where id=:id");
$design->execute(array(
  'id'=> 1
));
$designcek=$design->fetch(PDO::FETCH_ASSOC);

require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>
      


      
      <!-- Main wrapper -->
      
      <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="card card-body shadow">
        <h4 class="text-center">Genel Ayarlar</h4>

        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">

        <div class="col-md-6 mt-3">
        <label>Logo: <img src="<?php echo $url; ?>/<?php echo $designcek["logo"] ?>" width="150px"></label>
        <input type="file" class="form-control" name="logo">
        </div>

        <div class="col-md-6 mt-3">
        <label>Favicon: <img src="<?php echo $url; ?>/<?php echo $designcek["favicon"] ?>" width="32px" height="32px"></label>
        <input type="file" class="form-control" name="favicon">
        </div>

        <div class="col-md-12 mt-3">
        <label>Seo Title:</label>
        <input type="text" class="form-control" name="title" value="<?php echo $designcek["title"] ?>">
        </div>

        <div class="col-md-12 mt-3">
        <label>Seo Keyword:</label>
        <input type="text" class="form-control" name="metakeyword" value="<?php echo $designcek["metakeyword"] ?>">
        </div>

        <div class="col-md-12 mt-3">
        <label>Seo Description:</label>
        <input type="text" class="form-control" name="metadesc" value="<?php echo $designcek["metadesc"] ?>">
        </div>

           <div class="col-md-12 mt-3">
        <label>Footer Yazısı:</label>
        <input type="text" class="form-control" name="home_footer" value="<?php echo $designcek["home_footer"] ?>">
        </div>

           <div class="col-md-12 mt-3">
        <label>Ana Sayfa Metin Başlığı:</label>
        <input type="text" class="form-control" name="home_title" value="<?php echo $designcek["home_title"] ?>">
        </div>

            <div class="col-md-12 mt-3">
        <label>Ana Sayfa Metini:</label>
        <textarea type="text" class="form-control" name="home_content" style="height: 250px;"><?php echo $designcek["home_content"] ?></textarea>
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