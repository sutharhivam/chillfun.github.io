<?php 
    $page_title="Privacy Policy";
    include("includes/connection.php");
?>

<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width"> 
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="32x32">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="images/<?php echo APP_LOGO;?>">
    <meta name="msapplication-TileImage" content="images/<?php echo APP_LOGO;?>">
    <title><?php echo $page_title;?></title>

	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages/privacy.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/main.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body{
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; padding:1em;
		}
		.header {
            border-bottom: 2px solid #ebedf2;
            box-shadow: 0px 5px 10px 0px #fff;
            padding: 10px 20px;
            background: #fff;
        }
		.header img{
			width: 80px;height: 80px;float: left;margin-right: 20px
		}
		.header h1{
			padding: 23px;margin: 0px
		}
		@media screen and (max-width: 768px) {

			.header img{
				width: 60px;
				height: 60px;
			}
			.header > h1 {
				font-size: 20px;
			}
		}

        .invoice .content-section .inv--head-section .company-logo {
            width: auto;
            height: 80px;
        }
	</style>
</head> 
<body>
    <div class="main-container" id="container">
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div id="headerWrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 text-center">
                                <h2 class="main-heading">Privacy Policy</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="privacyWrapper" class="">
                    <div class="privacy-container">
                        <div class="privacyContent">
    
                            <div class="d-flex justify-content-between privacy-head">
                                <div class="privacyHeader">
                                    <h1>Privacy Policy for <?php echo APP_NAME;?></h1>
                                    <p>Updated <?php echo date('D m, Y ');?></p>
                                </div>
    
                                <div class="get-privacy-terms align-self-center">
                                    <button onclick="window.print()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print</button>
                                </div>
    
                            </div>
                            <div class="privacy-content-container">
                                <section>
                                    <?=stripslashes($settings_details['app_privacy_policy'])?>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>