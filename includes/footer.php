        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <?php echo date('Y');?> <a target="_blank" href="https://nemosofts.com">Nemosofts</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Made with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> in Sri Lanka</p>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app_int.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="assets/js/custom.js"></script>
<script src="plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="plugins/select2/select2.min.js"></script>
<script src="plugins/select2/custom-select2.js"></script>
    
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="assets/js/notify.min.js"></script>
<?php if (isset($_SESSION['msg'])) { ?>
  <script type="text/javascript">
    $('.notifyjs-corner').empty();
    $.notify(
      '<?php echo $client_lang[$_SESSION["msg"]]; ?>', {
        position: "top center",
        className: '<?= $_SESSION["class"] ?>'
      }
    );
  </script>
<?php
  unset($_SESSION['msg']);
  unset($_SESSION['class']);
}
?>
<!--===============================================================================================-->
<script type="text/javascript">
    function fileValidation(){
        var fileInput = document.getElementById('fileupload');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.png|.jpg|.jpeg|.PNG|.JPG|.JPEG)$/i;
        if(!allowedExtensions.exec(filePath)){
            if(filePath!='')
                swal({
                    type: 'error',
                    title: 'Please upload file having extension',
                    text: '.png, .jpg, .jpeg .PNG, .JPG, .JPEG only.',
                    footer: '<a href>Why do I have this issue?</a>',
                    padding: '2em'
                }).then(function(result) {
                     fileInput.value = '';
                });
            return false;
        }else{
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").find("img").attr("src", e.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script>
<!--===============================================================================================-->
</body>
</html>