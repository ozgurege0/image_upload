<?php 
require_once("ayarlar/baglan.php");
require_once("includes/session.php");






require_once("includes/header.php");
require_once("includes/navbar.php");
require_once("includes/sidebar.php"); 
?>
      
      <div class="body-wrapper">
        
        <div class="container-fluid">
        <div class="row" >

           

           
                        <div class="col-md-12" >
                            <div class=" alert alert-white card  alert-dismissible fade show welcome-area-alert " role="alert" style="box-shadow: none; background-color: #dbedff; ">
                         
                                <div class="card-body d-flex justify-content-start align-items-center flex-wrap welcome-area">
                                    <div style="margin-right: 25px;" class="welcome-area-img" >
                                        <img src="dist/images/dash.png" style="width: 160px">
                                    </div>
                                    <div class="flex-grow-1 ">
                                        <h4 style="font-weight: 400;">Hoşgeldin <strong>Admin,</strong></h4>
                                        <div class="welcomeText" style="font-weight: 400; font-size: 15px;">
                                            "Admin panel size tüm web sitesini yönetme imkanı sunar, bir sorun olursa her zaman yanındayız."

                                    </div>

                                </div>
                             
                            </div>
                        </div>
                    </div> 



      

          </div>
     
        </div>
      </div>
      <div class="dark-transparent sidebartoggler"></div>
    </div>

<?php require_once("includes/footer.php"); ?>