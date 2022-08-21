<?php
    include("includes/connection.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	include("language/app_language.php");
	include("smtp_email.php");
	
	define("APP_FROM_EMAIL", $settings_details['email_from']);
	define("PACKAGE_NAME", $settings_details['package_name']);
	date_default_timezone_set("Asia/Kolkata");
	$file_path = getBaseUrl();
	
	function generateRandomPassword($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	if(isset($_POST['submit'])){
	    
        $email=addslashes(trim($_POST['email']));

		$qry = "SELECT * FROM tbl_admin WHERE email = '$email' AND `id` <> 0"; 
		$result = mysqli_query($mysqli,$qry);
		$row = mysqli_fetch_assoc($result);
		
		if($row['email']!=""){
			$password=generateRandomPassword(7);
			
			$new_password = $password;

			$to = $row['email'];
			$recipient_name=$row['username'];
			// subject
			$subject = str_replace('###', APP_NAME, $app_lang['forgot_password_sub_lbl']);
 			
			$message='<div style="background-color: #f9f9f9;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="'.$file_path.'images/'.APP_LOGO.'" alt="header" style="width:100px;height:auto"/></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td>
					                        	<p style="color: #262626; font-size: 24px; margin-top:0px;"><strong>'.$app_lang['dear_lbl'].' '.$row['username'].'</strong></p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-top:5px;"><br>'.$app_lang['your_password_lbl'].': <span style="font-weight:400;">'.$new_password.'</span></p>
					                          <p style="color:#262626; font-size:17px; line-height:32px;font-weight:500;margin-bottom:30px;">'.$app_lang['thank_you_lbl'].' '.APP_NAME.'</p>

					                        </td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					               
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #262626; padding: 20px 0; font-size: 18px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">'.$app_lang['email_copyright'].' '.APP_NAME.'.</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';

			send_email($to,$recipient_name,$subject,$message);

			$sql="UPDATE tbl_admin SET `password`='$new_password' WHERE `id`='".$row['id']."'";
	      	mysqli_query($mysqli,$sql);
			 	  
			$_SESSION['msg']="20";
            $_SESSION['class']='success'; 
            header("Location:auth_pass_recovery.php");	 
            exit;
		}else{  	 
			$_SESSION['msg']="21";
            $_SESSION['class']='error'; 
            header("location:auth_pass_recovery.php");	 
            exit;
		}
    }
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="32x32">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="images/<?php echo APP_LOGO;?>">
    <meta name="msapplication-TileImage" content="images/<?php echo APP_LOGO;?>">
    <title>:: <?php echo APP_NAME;?></title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/fontawesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/structure.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/authentication.css" rel="stylesheet" type="text/css" />
    
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link rel="stylesheet" type="text/css" href="assets/css/elements/alert.css">

</head>

<body class="form no-image-content">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
                         <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">EMAIL</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" type="text" class="form-control" value="" placeholder="Email" required>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary" value="">Reset</button>
                                    </div>
                                </div>
                                </br>
                                <p class="signup-link register">Go to the login page ? <a href="index.php">Log in</a></p>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>
        </div>
    </div>
    
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/authentication.js"></script>

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

</body>
</html>