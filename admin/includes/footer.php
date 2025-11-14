<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
var table = new DataTable('#example', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json',
    },
    pageLength: 99,
    order: [[0, 'desc']] // 0. sütuna (ID sütunu) göre azalan sıralama
});
</script>


<?php
if(isset($_GET["job"])){ ?>
  <script>
Swal.fire({
  icon: 'success',
  title: 'Başarılı!',
  text: 'İşlem başarıyla gerçekleştirildi!',
  confirmButtonText: 'Tamam',
  timer: 2000
});
setTimeout(function() {
  var currentURL = window.location.href;
  var cleanURL = currentURL.split('?')[0]; // ? işaretinden önceki kısmı alır
  window.location.href = cleanURL;
}, 2000);
</script>

<?php  } ?>



  <script src="dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    
    <!-- core files -->
    
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.horizontal.init.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.js"></script>

    
    <!-- current page js files -->
    
    <script src="dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="dist/js/dashboard2.js"></script>

  </body>

</html>
