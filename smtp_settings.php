<?php
    $page_title="SMTP Settings";
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$qry = "SELECT * FROM tbl_smtp_settings where id='1'";
    $result = mysqli_query($mysqli, $qry);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {

      $key = ($_POST['smtpIndex'] == 'gmail') ? '0' : '1';

      $password = '';
      if ($_POST['smtp_password'][$key] != '') {
        $password = $_POST['smtp_password'][$key];
      } else {
        if ($key == 0) {
          $password = $row['smtp_gpassword'];
        } else {
          $password = $row['smtp_password'];
        }
      }

      if ($key == 0) {

        $data = array(
          'smtp_type'  =>  'gmail',
          'smtp_ghost'  =>  $_POST['smtp_host'][$key],
          'smtp_gemail'  =>  $_POST['smtp_email'][$key],
          'smtp_gpassword'  =>  $password,
          'smtp_gsecure'  =>  $_POST['smtp_secure'][$key],
          'gport_no'  =>  $_POST['port_no'][$key]
        );
      } else {

        $data = array(
          'smtp_type'  =>  'server',
          'smtp_host'  =>  $_POST['smtp_host'][$key],
          'smtp_email'  =>  $_POST['smtp_email'][$key],
          'smtp_password'  =>  $password,
          'smtp_secure'  =>  $_POST['smtp_secure'][$key],
          'port_no'  =>  $_POST['port_no'][$key]
        );
      }

      $sql = "SELECT * FROM tbl_smtp_settings WHERE id='1'";
      $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

      if (mysqli_num_rows($res) > 0) {
        $update = Update('tbl_smtp_settings', $data, "WHERE id = '1'");
      } else {
        $insert = Insert('tbl_smtp_settings', $data);
      }

      $_SESSION['class'] = "success";
      $_SESSION['msg'] = "11";
      header("Location:smtp_settings.php");
      exit;
    }

?>

<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                
                                 <form action="" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Type <span style="color: red">*</span>:-</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="smtp_type" id="gmail" class="custom-control-input" value="gmail" <?php if ($row['smtp_type'] == 'gmail') {
                                                                        echo ' checked="" id="disabledFieldsetCheck"';
                                                                      } ?>>
                                                                    <label class="custom-control-label" for="gmail"> Gmail SMTP</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                     <input type="radio" name="smtp_type" id="server" class="custom-control-input" value="server" <?php if ($row['smtp_type'] == 'server') {
                                                                        echo ' checked="" disabled="disabled"';
                                                                      } ?>>
                                                                    <label class="custom-control-label" for="server">Server SMTP</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="smtpIndex" value="<?= $row['smtp_type'] ?>">
                                                        
                                                        
                                                        <div class="gmailContent" <?php if ($row['smtp_type'] == 'gmail') {
                                                              echo 'style="display:block"';
                                                            } else {
                                                              echo 'style="display:none"';
                                                            } ?>>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Host <span style="color: red">*</span>:-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                       <input type="text" name="smtp_host[]" class="form-control col-md-7" value="<?= $row['smtp_ghost'] ?>" placeholder="mail.example.in" <?php if ($row['smtp_type'] == 'gmail') {
                                                                          echo 'required';
                                                                        } ?>> 
                                                                    </div>
                                                            </div>

                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email <span style="color: red">*</span>:-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="smtp_email[]" class="form-control col-md-7" value="<?= $row['smtp_gemail'] ?>" placeholder="info@example.com" <?php if ($row['smtp_type'] == 'gmail') {
                                                                          echo 'required';
                                                                        } ?>>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password <span style="color: red">*</span>:-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="password" name="smtp_password[]" class="form-control col-md-7" value="" placeholder="********">
                                                                    </div>
                                                            </div>
                                            
                                                            <div class="form-group row mb-4">
                                                              <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTPSecure :-</label>
                                                              <div class="col-md-3">
                                                                <select name="smtp_secure[]" class="select2 form-control" <?php if ($row['smtp_type'] == 'gmail') {
                                                                  echo 'required';
                                                                } ?>>
                                                                <option value="tls" <?php if ($row['smtp_gsecure'] == 'tls') {
                                                                  echo 'selected';
                                                                } ?>>TLS</option>
                                                                <option value="ssl" <?php if ($row['smtp_gsecure'] == 'ssl') {
                                                                  echo 'selected';
                                                                } ?>>SSL</option>
                                                              </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                              <input type="text" name="port_no[]" class="form-control" value="<?= $row['gport_no'] ?>" placeholder="Enter Port No." <?php if ($row['smtp_type'] == 'gmail') {
                                                                echo 'required';
                                                              } ?>>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        
                                                        <div class="serverContent" <?php if ($row['smtp_type'] == 'server') {
                                                          echo 'style="display:block"';
                                                        } else {
                                                          echo 'style="display:none"';
                                                        } ?>>
                                                            
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Host <span style="color: red">*</span>:-</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                     <input type="text" name="smtp_host[]" id="smtp_host" class="form-control col-md-7" value="<?= $row['smtp_host'] ?>" placeholder="mail.example.in" <?php if ($row['smtp_type'] == 'server') {
                                                              echo 'required';
                                                            } ?>>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email <span style="color: red">*</span>:-</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="smtp_email[]" id="smtp_email" class="form-control col-md-7" value="<?= $row['smtp_email'] ?>" placeholder="info@example.com" <?php if ($row['smtp_type'] == 'server') {
                                                              echo 'required';
                                                            } ?>>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password <span style="color: red">*</span>:-</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="password" name="smtp_password[]" id="smtp_password" class="form-control col-md-7" value="" placeholder="********">
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTPSecure :-</label>
                                                            <div class="col-md-3">
                                                                    <select name="smtp_secure[]" class="select2 form-control" <?php if ($row['smtp_type'] == 'server') {
                                                                      echo 'required';
                                                                    } ?>>
                                                                    <option value="tls" <?php if ($row['smtp_secure'] == 'tls') {
                                                                      echo 'selected';
                                                                    } ?>>TLS</option>
                                                                    <option value="ssl" <?php if ($row['smtp_secure'] == 'ssl') {
                                                                      echo 'selected';
                                                                    } ?>>SSL</option>
                                                                  </select>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                  <input type="text" name="port_no[]" id="port_no" class="form-control" value="<?= $row['port_no'] ?>" placeholder="Enter Port No." <?php if ($row['smtp_type'] == 'server') {
                                                                    echo 'required';
                                                                  } ?>>
                                                                </div>
                                                        </div>
                                                        

                                                    </div>
                                            
                                                    <input type="hidden" id="server_data" data-stuff='<?php echo htmlentities(json_encode($row)); ?>'>

                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary mt-3">Save</button>
                                                        </div>
                                                    </div>
                                                        
                                                    </br>
                                                    <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                                        <h4 id="oh-snap!-you-got-an-error!">Note:<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
                                                        <p style="margin-bottom: 10px"><i class="fa fa-hand-o-right"></i> This email required otherwise <strong>forgot password</strong> OR <strong>email</strong> feature will not be work.</p>
                                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>

<script type="text/javascript">
  $("input[name='smtp_type']").on("click", function(e) {

    var checkbox = $(this);

    $("input[name='smtp_password[]']").attr("required", false);

    e.preventDefault();
    e.stopPropagation();

    var _val = $(this).val();
    if (_val == 'gmail') {

      swal({
        title: "Are you sure?",
        type: "warning",
		confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: false
      }).then(function(result) {
        if (result.value) {

          checkbox.attr("disabled", true);
          checkbox.prop("checked", true);
          $("#server").attr("disabled", false);
          $("#server").prop("checked", false);


          $(".serverContent").hide();
          $(".gmailContent").show();

          $(".serverContent").find("input").attr("required", false);
          $(".gmailContent").find("input").attr("required", true);

          $("input[name='smtpIndex']").val('gmail');

          swal.close();

        } else {
          swal.close();
        }

      });
    } else {

      swal({
        title: "Are you sure?",
        type: "warning",
		confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: false
        
      }).then(function(result) {
        if (result.value) {

          checkbox.attr("disabled", true);
          checkbox.prop("checked", true);
          $("#gmail").attr("disabled", false);
          $("#gmail").prop("checked", false);

          $(".gmailContent").hide();
          $(".serverContent").show();

          $("input[name='smtpIndex']").val('server');

          $(".serverContent").find("input").attr("required", true);
          $(".gmailContent").find("input").attr("required", false);

          swal.close();

        } else {
          swal.close();
        }

      });

    }

  });
</script>