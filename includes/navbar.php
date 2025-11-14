  <body data-bs-theme="dark">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    
    <a class="navbar-brand" href="<?php echo $url; ?>/"><img src="<?php echo $designcek["logo"] ?>"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $url; ?>/">Ana Sayfa</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url; ?>/iletisim">İletişim</a>
        </li>

   
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
    <?php if($banner_adscek["top1"]!=""){ ?> 
      <div class="col-md-6 mt-3 banner">
        <a href="<?php echo $banner_adscek["top1_link"] ?>" target="_blank" rel="nofollow"><img src="<?php echo $banner_adscek["top1"] ?>" alt=""></a>
    </div>
      <?php } ?>

          <?php if($banner_adscek["top2"]!=""){ ?> 
       <div class="col-md-6 mt-3 banner">
        <a href="<?php echo $banner_adscek["top2_link"] ?>" target="_blank" rel="nofollow"><img src="<?php echo $banner_adscek["top2"] ?>" alt=""></a>
    </div>
         <?php } ?>
</div>
</div>