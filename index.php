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
    include("language/language.php");
    
    if(!file_exists($license_filename)){
        header("Location:$install");
        exit;
    }else{
        if(isset($_SESSION['admin_name'])){
            header("Location:home.php");
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


<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Sign In</h1>
                        <p class="">Log in to your account to continue.</p>
                        

                        
                        <form action="login_db.php" method="post" class="text-left">
                            <div class="form">
                                
                                <?php if(isset($_SESSION['msg'])){?>
                                        <div class="alert alert-danger  alert-dismissible" role="alert"> <?php echo $client_lang[$_SESSION['msg']]; ?> </div>
                                <?php unset($_SESSION['msg']);}?>

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="User name" aria-describedby="basic-addon1" required>
                                </div>
                                

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="auth_pass_recovery.php" class="forgot-pass-link">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="Login">Log In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="signup-link">© 2020 All Rights Reserved. <a href="http://nemosofts.com/">Nemosofts</a>.</p>
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

</body>
</html>