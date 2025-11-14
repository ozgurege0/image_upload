<?php
require_once("ayarlar/baglan.php");
require_once("includes/session.php");

if(isset($_POST['ekle'])){

$video = uploadImage('video');

if ($video) {
echo "Dosya başarıyla yüklendi: " . $video;
}

$img = uploadImage('img');

if ($img) {
echo "Dosya başarıyla yüklendi: " . $img;
}
   
$tableName = "videos";

$data = [
    'title' => $_POST['title'],
    'aciklama' => $_POST['aciklama'],
    'category_id' => $_POST['category_id'],
       'metadesc' => $_POST['metadesc'],
    'metakeyw' => $_POST['metakeyw'],
    'video' => $video,
    'img' => $img
];

$success = insertIntoTable($tableName, $data, $db);

if ($success) {
  Header("Location:videos.php?job=ekle");
  exit;
} 
}

if (isset($_POST['duzenle'])) {
  $video = null;
  if (isset($_FILES['video']) && $_FILES['video']['size'] != 0) {
      $video = uploadImage('video');
  }
    $img = null;
  if (isset($_FILES['img']) && $_FILES['img']['size'] != 0) {
      $img = uploadImage('img');
  }


  $tableName = "videos";

 $data = [
    'title' => $_POST['title'],
    'aciklama' => $_POST['aciklama'],
    'category_id' => $_POST['category_id'],
      'metadesc' => $_POST['metadesc'],
    'metakeyw' => $_POST['metakeyw']
];

  if ($video) {
      $data['video'] = $video;
  }
  
  if ($img) {
      $data['img'] = $img;
  }

  $id = $_POST["id"];
  $condition = ['id' => $id];

  $success = updateTable($tableName, $data, $condition, $db);

  if ($success) {
      Header("Location:videos.php?job=duzenle");
      exit;
  } else {
      echo "Güncelleme başarısız.";
  }
}

if(isset($_GET["delete_id"])){
    $sil=$db->prepare("DELETE FROM videos WHERE id=:id");
    $kontrol=$sil->execute(array(
      'id' => @$_GET['delete_id']
    ));
    Header("Location:videos.php?job=sil");
    exit;
}

$limit = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$offset = ($page - 1) * $limit;

// Toplam kayıt sayısı ve veri çekme
if ($q !== '') {
    $totalQuery = $db->prepare("SELECT COUNT(*) FROM videos WHERE title LIKE :search");
    $totalQuery->execute([':search' => "%$q%"]);
    $totalRecords = $totalQuery->fetchColumn();

    $videos = $db->prepare("SELECT * FROM videos WHERE title LIKE :search ORDER BY id DESC LIMIT :offset, :limit");
    $videos->bindValue(':search', "%$q%", PDO::PARAM_STR);
} else {
    $totalQuery = $db->query("SELECT COUNT(*) FROM videos");
    $totalRecords = $totalQuery->fetchColumn();

    $videos = $db->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT :offset, :limit");
}

$videos->bindValue(':offset', $offset, PDO::PARAM_INT);
$videos->bindValue(':limit', $limit, PDO::PARAM_INT);
$videos->execute();
$categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

$totalPages = ceil($totalRecords / $limit);

$main_videos2=$db->prepare("SELECT * FROM categories");
$main_videos2->execute();
?>
<?php 
require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>

           <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="card card-body shadow">
        <div class="d-flex justify-content-between align-items-center">
  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#videos_ekle" style="float: left;">Video Ekle</button>
  <h4 class="text-center" style="margin: 0 auto;">Video Yönetimi</h4>
</div>




     <!-- Arama Formu -->
<form method="get" class="mb-3 d-flex" style="gap:10px;">
    <input type="text" name="q" class="form-control" placeholder="Başlığa göre ara..." value="<?= htmlspecialchars($q); ?>">
    <button type="submit" class="btn btn-primary">Ara</button>
</form>

<!-- Tablo -->
<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Başlık</th>
            <th>Düzenle</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = $offset + 1; foreach ($videos as $video): ?>
        <tr>
            <td><?= $video["id"] ?></td>
            <td><?= htmlspecialchars($video['title']); ?></td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $video['id']; ?>">Düzenle</button>
            </td>
            <td>
                <a href="videos.php?delete_id=<?= $video['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
            </td>
        </tr>

        <!-- Modal: Video Düzenle -->
        <div class="modal fade" id="editModal<?= $video['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $video['id']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Video Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="">
                  <div class="row">

                    <div class="col-md-6 mt-3">
                      <label class="form-label">Video Dosyası:</label><br>
                      <a href="<?= $video['video']; ?>" target="_blank"><?= $video['video']; ?></a>
                      <input class="form-control mt-1" type="file" name="video">
                    </div>

                    <div class="col-md-6 mt-3">
                      <label class="form-label">Kapak Resmi:</label><br>
                      <a href="<?= $video['img']; ?>" target="_blank"><?= $video['img']; ?></a>
                      <input class="form-control mt-1" type="file" name="img">
                    </div>

                    <div class="col-md-6 mt-3">
                      <label>Başlık</label>
                      <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($video['title']); ?>">
                    </div>

                    <div class="col-md-6 mt-3">
                      <label>Kategori</label>
                      <select class="form-select" name="category_id">
                        <?php foreach ($categories as $cat): ?>
                          <option value="<?= $cat['id']; ?>" <?= $video['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($cat['title']); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-12 mt-3">
                      <label>Açıklama</label>
                      <textarea class="form-control" name="aciklama" rows="3"><?= htmlspecialchars($video['aciklama']); ?></textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                      <label>SEO Keyword</label>
                      <input type="text" class="form-control" name="metakeyword" value="<?= htmlspecialchars($video['metakeyword']); ?>">
                    </div>

                    <div class="col-md-6 mt-3">
                      <label>SEO Description</label>
                      <input type="text" class="form-control" name="metadesc" value="<?= htmlspecialchars($video['metadesc']); ?>">
                    </div>

                    <div class="col-md-3 mt-3">
                      <input type="hidden" name="id" value="<?= $video['id']; ?>">
                      <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>

                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <?php if ($totalRecords == 0): ?>
        <tr><td colspan="4" class="text-center">Kayıt bulunamadı.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<?php if ($totalPages > 1): ?>
<nav>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
        <a class="page-link" href="?page=<?= $i; ?>&q=<?= urlencode($q); ?>"><?= $i; ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>

    </div>



<!-- Modal -->
<div class="modal fade" id="videos_ekle" tabindex="-1" aria-labelledby="videos_ekle" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="post" enctype="multipart/form-data">       
    <div class="row">


             <div class="col-md-6 mt-3">
        <label class="form-label">Video</label>
        <input class="form-control" type="file" name="video">
        </div>
        
        <div class="col-md-6 mt-3">
        <label class="form-label">Resim</label>
        <input class="form-control" type="file" name="img">
        </div>

    <div class="col-md-6 mt-3">
        <label class="form-label">Video Başlığı</label>
        <input class="form-control" type="text" name="title">
        </div>

     <div class="col-md-6 mt-3">
        <label class="form-label">Kategorisi</label>
        <select id="altResim" name="category_id" style="width: 100% !important;">
          <?php foreach ($main_videos2 as $main_videos2cek) { ?>
            <option value="<?php echo $main_videos2cek["id"] ?>" <?php if($main_videos2cek["id"]=="27"){ echo "selected"; } ?>><?php echo $main_videos2cek["title"] ?></option>
          <?php } ?>
</select>
        </div>

        
        <div class="col-md-12 mt-3">
        <label class="form-label">Açıklaması</label>
        <textarea class="form-control" type="text" name="aciklama" style="height: 100px;"></textarea>
        </div>

            <div class="col-md-12 mt-3">
        <label>Seo Keyword:</label>
        <input type="text" class="form-control" name="metakeyword">
        </div>

        <div class="col-md-12 mt-3">
        <label>Seo Description:</label>
        <input type="text" class="form-control" name="metadesc">
        </div>

        <div class="col-md-3 mt-3">
        <button class="btn btn-primary" type="submit" name="ekle">Ekle</button>
        </div>

        </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
    </div>

    <script>
    $(document).ready(function() {
      $('#altResim').select2({
        dropdownParent: $("#videos_ekle")
      });
    });
  </script>

<?php require_once("includes/footer.php"); ?>