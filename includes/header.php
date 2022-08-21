<?php  
    /**
    * Company : Nemosofts
    * Detailed : Software Development Company in Sri Lanka
    * Developer : Thivakaran
    * Contact : thivakaran829@gmail.com
    * Contact : nemosofts@gmail.com
    * Website : https://nemosofts.com
    */
    
    include("includes/connection.php");
    include("includes/product.php");
    include("includes/session_check.php");
    
    //Get file name
  $currentFile = $_SERVER["SCRIPT_NAME"];
  $parts = Explode('/', $currentFile);
  $currentFile = $parts[count($parts) - 1];

  $requestUrl = $_SERVER["REQUEST_URI"];
  $urlparts = Explode('/', $requestUrl);
  $redirectUrl = $urlparts[count($urlparts) - 1];
  $_SESSION['class']="success"; 
  $mysqli->set_charset("utf8mb4"); 
  
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="32x32">
    <link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="images/<?php echo APP_LOGO;?>">
    <meta name="msapplication-TileImage" content="images/<?php echo APP_LOGO;?>">
    <title><?php echo (isset($page_title)) ? $page_title.' | '.APP_NAME : APP_NAME; ?></title></title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/fontawesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/structure.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/elements/alert.css" rel="stylesheet" type="text/css">
    <link href="assets/css/elements/custom-pagination.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/tooltip.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/theme-checkbox-radio.css">
    
     
    <link href="assets/css/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dash.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/nemosofts_310802021050715.css" rel="stylesheet" type="text/css" />
    
    
    <!-- BEGIN SWEET ALERT -->
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END SWEET ALERT -->
    
    <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" >
    
    <!-- BEGIN CKEDITER -->
    <script src="plugins/ckeditor/ckeditor.js"></script>
    <!-- END CKEDITER -->
</head>
<body>
    
<Style>
.widget-content .row.padding35 .col-md-4 {
  margin-bottom: 20px; }

.btn {
  margin-right: 5px; }
</Style>
    
<Style>
    .badge.badge-success.badge-icon i {
    background-color: rgba(41, 199, 95, 0.1);
}
.badge.badge-danger.badge-icon i {
    background-color: rgba(231, 76, 60, 0.1);
}
.badge.badge-icon span {
    padding: 5px;
}
.badge.badge-icon i {
    padding: 5px;
}

.badge.badge-success {
    color: #1782de;
    background-color: rgba(41, 199, 95, 0.2);
    box-shadow: none;
}
.badge.badge-danger {
    color: #e91e63;
    background-color: rgba(231, 76, 60, 0.2);
    box-shadow: none;
}

.badge {
    margin: 0px;
    padding: 0px;
	display: inline-block;
	min-width: 10px;
	font-size: 12px;
	font-weight: bold;
	line-height: 1;
	color: #fff;
	text-align: center;
	white-space: nowrap;
	vertical-align: middle;
	background-color: #777;
	border-radius: 2px;
}


.add_btn_primary {
    float: left;
}
.add_btn_primary a {
    background-color: #1782de;
    box-shadow: 0 2px 3px rgb(9 80 119 / 30%);
    border: 1px solid transparent;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    border-radius: 50px;
    border-style: 1px solid;
    margin-bottom: 7px;
    transition: all 0.3s ease 0s;
    padding: 10px 20px;
    color: #ffffff;
}
    
.select2-container  {
	margin: 0px;
	padding: 0px;
}
.select2-container .select2-selection--single {
margin: 0px;
	padding: 0px;
}
.main-container {
    padding: 0 0 0 0;
}

.sidebar-theme {
    background: #fff;
}
.sub-header-container .navbar {
    box-shadow: none;
    background: #fff;
    border-bottom: 1px solid #ebedf2;
}
.sidebar-wrapper {
    border-radius: 0 0 0 0;
    top: 106px;
}
#sidebar ul.menu-categories.ps {
    margin-right: 0;
    padding-right: 15px;
    padding-left: 15px;
    border-right: 1px solid #e0e6ed;
}
#sidebar ul.menu-categories li.menu > .dropdown-toggle[data-active="true"] {
    background: #03a9f4;
}
.widget-content-area  {
    border: 1px solid #dadce0;
    border-radius: 10px;

}

.widget {
    box-shadow : none;
}

.swal2-icon.swal2-warning {
    color: #ffbb44 !important;
    border: 5px solid #ffbb44 !important;
    box-shadow: none;
}
.swal2-icon:not(.swal2-animate-error-icon):not(.swal2-animate-success-icon) {
    width: 2em !important;
    line-height: 119px !important;
    height: 2em !important;
    margin: 0.1em auto 0.1em !important;
}
thead {
    background: #e1f5fe;
}
.table > tbody > tr > td {
    color: #141414;
    font-weight: 600;
}
</Style>

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="index.php">
                 <img src="images/<?php echo APP_LOGO;?>" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="index.php" class="nav-link"> <?php echo APP_NAME;?></a> </a>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                   <img src="images/<?php echo PROFILE_IMG;?>" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="auth_profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Edit Profile</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span><?=$page_title ?></span></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>
    </header>
</div>
<div class="main-container" id="container">
<?php include("sidebar.php");?>