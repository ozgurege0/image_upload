   <div class="container mt-4">
    <div class="row">
            <?php if($banner_adscek["top4"]!=""){ ?> 

    <div class="col-md-6 mt-3 banner">
        <a href="<?php echo $banner_adscek["top4_link"] ?>" target="_blank" rel="nofollow"><img src="<?php echo $banner_adscek["top4"] ?>" alt=""></a>
    </div>
      <?php } ?>

         <?php if($banner_adscek["top5"]!=""){ ?> 
       <div class="col-md-6 mt-3 banner">
        <a href="<?php echo $banner_adscek["top5_link"] ?>" target="_blank" rel="nofollow"><img src="<?php echo $banner_adscek["top5"] ?>" alt=""></a>
    </div>
      <?php } ?>
</div>
</div>

 <div class="container mt-5"> 
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"> 
        <div class="col-md-4 d-flex align-items-center">
             <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1" aria-label="Bootstrap"> 
                <svg class="bi" width="30" height="24" aria-hidden="true"><use xlink:href="#bootstrap"></use></svg>
             </a> 

                <span class="mb-3 mb-md-0 text-body-secondary"><?php echo $designcek["home_footer"] ?></span> 
            </div> 
        </footer> 
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>