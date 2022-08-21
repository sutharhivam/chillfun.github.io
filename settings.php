<?php
    $page_title="Settings";
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
    $_SESSION['class']="success";
    
    if(isset($_POST['submit_admin'])){
        
        $img_res=mysqli_query($mysqli,"SELECT * FROM tbl_settings WHERE id='1'");
        $img_row=mysqli_fetch_assoc($img_res);
        
        if($_FILES['app_logo']['name']!=""){        
            unlink('images/'.$img_row['app_logo']);   
            
            $app_logo=$_FILES['app_logo']['name'];
            $pic1=$_FILES['app_logo']['tmp_name'];
            
            $tpath1='images/'.$app_logo;      
            copy($pic1,$tpath1);
            
            $data = array(      
                'app_name'  =>  $_POST['app_name'],
                'app_logo'  =>  $app_logo                                
            );
        }else{
            $data = array(
                'app_name'  =>  $_POST['app_name']
            );
        } 
        
        // $qry = Insert('tbl_settings',$data);
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
    
        if ($qry > 0){
            $_SESSION['msg']="11";
            header( "Location:settings.php");
            exit;
        }   
    }
  
    if(isset($_POST['submit_about'])){
        $data = array(
            'app_email'  =>  cleanInput($_POST['app_email']),
            'app_version'  =>  cleanInput($_POST['app_version']),
            'app_author'  =>  cleanInput($_POST['app_author']),
            'app_contact'  =>  cleanInput($_POST['app_contact']),
            'app_website'  =>  cleanInput($_POST['app_website']),
            'app_description'  => addslashes($_POST['app_description']),
            'app_developed_by'  =>  cleanInput($_POST['app_developed_by'])
        );

        $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:settings.php");
        exit;
    }
    
    if(isset($_POST['api_submit'])){
        $data = array(
            'api_latest_limit'  =>  $_POST['api_latest_limit'],
            'api_cat_order_by'  =>  $_POST['api_cat_order_by'],
            'api_cat_post_order_by'  =>  $_POST['api_cat_post_order_by'],
            'api_home_latest_cat_id'  =>  $_POST['api_home_latest_cat_id']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;   
    }

    if(isset($_POST['submit_app'])){
        $data = array(
            'isRTL' => ($_POST['isRTL']) ? 'true' : 'false',
            'isSongDownload' => ($_POST['isSongDownload']) ? 'true' : 'false',
            'isMoviePromote' => ($_POST['isMoviePromote']) ? 'true' : 'false',
            'isNews' => ($_POST['isNews']) ? 'true' : 'false',
            'isAppMaintenance' => ($_POST['isAppMaintenance']) ? 'true' : 'false',
            'isScreenshot' => ($_POST['isScreenshot']) ? 'true' : 'false',
            'facebook_login' => ($_POST['facebook_login']) ? 'true' : 'false',
            'google_login' => ($_POST['google_login']) ? 'true' : 'false'
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }

  
    if(isset($_POST['submit_policy'])){
        $data = array(
            'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy']) 
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }
  
    if(isset($_POST['submit_ads'])){
        $data = array(
            'publisher_id'  =>  cleanInput($_POST['publisher_id']),
            'interstital_ad'  => ($_POST['interstital_ad']) ? 'true' : 'false',
            'interstital_ad_type'  =>  cleanInput($_POST['interstital_ad_type']),
            'interstital_ad_id'  =>  cleanInput($_POST['interstital_ad_id']),
            'interstital_facebook_id'  =>  cleanInput($_POST['interstital_facebook_id']),
            'interstital_ad_click'  =>  cleanInput($_POST['interstital_ad_click']),
            'banner_ad'  => ($_POST['banner_ad']) ? 'true' : 'false',
            'banner_ad_type'  =>  cleanInput($_POST['banner_ad_type']),
            'banner_ad_id'  =>  cleanInput($_POST['banner_ad_id']),
            'banner_facebook_id'  =>  cleanInput($_POST['banner_facebook_id']),
            'native_ad'  => ($_POST['native_ad']) ? 'true' : 'false',
            'native_ad_type'  =>  cleanInput($_POST['native_ad_type']),
            'native_ad_id'  =>  cleanInput($_POST['native_ad_id']),
            'native_facebook_id'  =>  cleanInput($_POST['native_facebook_id']),
            'native_position'  =>  cleanInput($_POST['native_position']),
            'banner_size'  =>  cleanInput($_POST['banner_size']),
            'banner_size_fb'  =>  cleanInput($_POST['banner_size_fb']),
            
            'native_startapp_id'  =>  cleanInput($_POST['native_startapp_id']),
            'interstital_startapp_id'  =>  cleanInput($_POST['interstital_startapp_id']),
            'banner_startapp_id'  =>  cleanInput($_POST['banner_startapp_id']),
            
            'native_unity_id'  =>  cleanInput($_POST['native_unity_id']),
            'interstital_unity_id'  =>  cleanInput($_POST['interstital_unity_id']),
            'banner_unity_id'  =>  cleanInput($_POST['banner_unity_id']),
            
            'native_iron_id'  =>  cleanInput($_POST['native_iron_id']),
            'interstital_iron_id'  =>  cleanInput($_POST['interstital_iron_id']),
            'banner_iron_id'  =>  cleanInput($_POST['banner_iron_id']),
            'banner_size_iron'  =>  cleanInput($_POST['banner_size_iron']),
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }
?>
<link rel="stylesheet" type="text/css" href="assets/css/forms/custom-clipboard.css">

<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6">
                                            <h5 class=""><?=$page_title ?></h5>
                                            <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px;"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="admin_settings-tab" data-toggle="tab" href="#admin_settings" role="tab" aria-controls="admin_settings" aria-selected="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                                Admin Settings
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="app_about-tab" data-toggle="tab" href="#app_about" role="tab" aria-controls="app_about" aria-selected="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                                About
                                                            </a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link" id="app_settings-tab" data-toggle="tab" href="#app_settings" role="tab" aria-controls="app_settings" aria-selected="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                                App Settings
                                                            </a>
                                                        </li>
                                                        
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="api_settings-tab" data-toggle="tab" href="#api_settings" role="tab" aria-controls="api_settings" aria-selected="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                                API Settings
                                                            </a>
                                                        </li>


                                                        <li class="nav-item">
                                                            <a class="nav-link" id="privacy_policy-tab" data-toggle="tab" href="#privacy_policy" role="tab" aria-controls="privacy_policy" aria-selected="false">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                               Privacy Policy
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="admob_settings-tab" data-toggle="tab" href="#admob_settings" role="tab" aria-controls="admob_settings" aria-selected="false">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>
                                                               Ads Settings
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    
                                                    
                                                    <div class="tab-content" id="animateLineContent-4">

                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        
                                                        <div class="tab-pane fade show active" id="admin_settings" role="tabpanel" aria-labelledby="admin_settings-tab">
                                                         <form action="" name="settings_admin" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                        
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">App name</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select app logo</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="file" class="form-control-file" name="app_logo" value="fileupload" accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                                                 </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <?php 
                                                                if($settings_row['app_logo']!='' AND file_exists('images/'.$settings_row['app_logo']))
                                                                {
                                                              ?>
                                                              <div class="fileupload_img" id="imagePreview">
                                                                  <img  type="image" src="images/<?=$settings_row['app_logo']?>" style="width: 200px;height: 200px"   alt="image" />
                                                                </div>
                                                              <?php }else{ ?>
                                                                <div class="fileupload_img" id="imagePreview">
                                                                  <img type="image" src="assets/img/300x300.jpg" style="width: 200px;height: 200px"  alt="image" />
                                                                </div>
                                                              <?php } ?>
                                                              </div>
                                                        </div>
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_admin" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>

                                                        
                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        <div class="tab-pane fade" id="app_about" role="tabpanel" aria-labelledby="app_about-tab">
                                                             <form action="" name="settings_about" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                                <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">App Version :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version']; ?>" class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Author :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author']; ?>"  class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Contact :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact']; ?>"  class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email']; ?>" class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Website :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website']; ?>"  class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Developed By :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by']; ?>" class="form-control col-md-7">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row mb-4">
                                                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">App Description :-</label>
                                                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                        <div class="col-md-7" style="padding: 0px;">
                                                                            <textarea name="app_description" id="app_description" class="form-control"><?php echo stripslashes($settings_row['app_description']); ?></textarea>
                                                                          <script>CKEDITOR.replace('app_description');</script>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <div class="col-sm-10">
                                                                        <button type="submit" name="submit_about" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </div> 
                                                             </form>
                                                        </div>
                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        
                                                        
                                                        <div class="tab-pane fade show" id="app_settings" role="tabpanel" aria-labelledby="app_settings-tab">
                                                         <form action="" name="settings_app" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                        
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">RTL</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isRTL" name="isRTL" value="true" class="cbx hidden" <?php if($settings_row['isRTL']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                           <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Song Dowload</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isSongDownload" name="isSongDownload" value="true" class="cbx hidden" <?php if($settings_row['isSongDownload']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Movie Promote</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isMoviePromote" name="isMoviePromote" value="true" class="cbx hidden" <?php if($settings_row['isMoviePromote']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">News</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isNews" name="isNews" value="true" class="cbx hidden" <?php if($settings_row['isNews']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">App Maintenance</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isAppMaintenance" name="isAppMaintenance" value="true" class="cbx hidden" <?php if($settings_row['isAppMaintenance']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                           
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Disable Screenshot</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="isScreenshot" name="isScreenshot" value="true" class="cbx hidden" <?php if($settings_row['isScreenshot']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                             <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Facebook Login</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="facebook_login" name="facebook_login" value="true" class="cbx hidden" <?php if($settings_row['facebook_login']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Google Login</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="google_login" name="google_login" value="true" class="cbx hidden" <?php if($settings_row['google_login']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_app" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>


                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        
                                                        
                                                        <div class="tab-pane fade show" id="api_settings" role="tabpanel" aria-labelledby="api_settings-tab">
                                                         <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                        
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Home Page Latest Songs Category :-</label>
                                                                          <div class="col-sm-8">
                                                                                <select name="api_home_latest_cat_id" id="api_home_latest_cat_id" class="form-control col-md-6 basic">
                                                                                <option value="">--Select Category--</option>
                                                                                <?php 
                                                                                    $cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
                                                                                    $cat_result=mysqli_query($mysqli,$cat_qry); 
                                                                                    while($cat_row=mysqli_fetch_array($cat_result)){ 
                                                                                    ?>
                                                                                    <option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$settings_row['api_home_latest_cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	   
                                                                                <?php } ?>
                                                                                </select>
                                                                          </div>
                                                                    </div>
                                                                    
                                                                     <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Latest Limit :-</label>
                                                                          <div class="col-sm-8">
                                                                            <input type="number" name="api_latest_limit" id="api_latest_limit" value="<?php echo $settings_row['api_latest_limit'];?>" class="form-control"> 
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6"> 
                                                                
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Category List Order By :-</label>
                                                                          <div class="col-sm-8">
                                                                                <select name="api_cat_order_by" id="api_cat_order_by" class="form-control col-md-6 basic">
                                                                                    <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
                                                                                    <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Name</option>
                                                                                </select>
                                                                          </div>
                                                                    </div>
                                                                      
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Category Post Order :-</label>
                                                                          <div class="col-sm-8">
                                                                                <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="form-control col-md-6 basic">
                                                                                    <option value="ASC" <?php if($settings_row['api_cat_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                                                                                    <option value="DESC" <?php if($settings_row['api_cat_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
                                                                                </select>
                                                                          </div>
                                                                    </div>
                                                                </div>
    
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="api_submit" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        
                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        
                                                        <div class="tab-pane fade" id="privacy_policy" role="tabpanel" aria-labelledby="privacy_policy-tab">
                                                             <form action="" name="settings_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                                <?php 
                                                                if(file_exists('privacy_policy.php'))
                                                                {
                                                                ?>
                                                                <div class="form-group">
                                                                 <div class="col-md-12">
                                                                    <div class="clipboard copy-txt">
                                                                        <p class="mb-4">App Privacy Policy URL -> <span id="advanced-paragraph"><?=getBaseUrl().'privacy_policy.php'?></span></p>
                                                                        <a class="mb-1 btn btn-primary" href="javascript:;" data-clipboard-action="copy" data-clipboard-target="#advanced-paragraph"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>Copy Link</a>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                              <?php } ?>
                              
                                                                <div class="col-md-12">
                                                                    <textarea name="app_privacy_policy" id="app_privacy_policy" class="form-control"><?php echo stripslashes($settings_row['app_privacy_policy']);?></textarea>
                                                                    <script>CKEDITOR.replace( 'app_privacy_policy' );</script>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <div class="col-sm-10">
                                                                        <button type="submit" name="submit_policy" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </div> 
                                                             </form>
                                                        </div>
                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                        
                                                        
                                                        <div class="tab-pane fade" id="admob_settings" role="tabpanel" aria-labelledby="admob_settings-tab">
                                                             <form action="" name="settings_ads" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Publisher ID</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id']; ?>"  class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px;"></div>
                                     
                                                            <div class="row">
                                                                
                                                                <div class="col-md-4">
                                                                    <div class="banner_ads_block">
                                                                        <div class="banner_ad_item" style="background: #1a237e;">
                                                                            <label class="control-label">Banner Ads:-</label>
                                                                            <div class="row toggle_btn">
                                                                                <label class="switch">
                                                                                    <input type="checkbox" id="checked1" name="banner_ad" value="true" class="cbx hidden" <?php if($settings_row['banner_ad']=='true'){ echo 'checked'; }?>/>
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="#admob_banner_id">
                                                                                <p class="field_lable">Banner Ad Type :-</p>
                                                                                <div class="col-md-12">
                                                                                    <select name="banner_ad_type" id="banner_ad_type" class="form-control">
                                                                                        <option value="admob" <?php if ($settings_row['banner_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                                                        <option value="facebook" <?php if ($settings_row['banner_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                                                        <option value="startapp" <?php if ($settings_row['banner_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                                                        <option value="unity" <?php if ($settings_row['banner_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                                                        <option value="iron" <?php if ($settings_row['banner_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                                                    </select>
                                                                                </div>
                                                                                <p class="field_lable banner_size_add">AdSize :-</p>
                                                                                <div class="col-md-12 banner_size" style="display: none">
                                                                                    <select name="banner_size" id="banner_size" class="form-control">
                                                                                        <option value="BANNER" <?php if($settings_row['banner_size']=='BANNER'){?>selected<?php }?>>BANNER</option>
                                                                                        <option value="SMART_BANNER" <?php if($settings_row['banner_size']=='SMART_BANNER'){?>selected<?php }?>>SMART_BANNER</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-12 banner_size_fb" style="display: none">
                                                                                    <select name="banner_size_fb" id="banner_size_fb" class="form-control">
                                                                                        <option value="BANNER_HEIGHT_50" <?php if($settings_row['banner_size_fb']=='BANNER_HEIGHT_50'){?>selected<?php }?>>BANNER_HEIGHT_50</option>
                                                                                        <option value="BANNER_HEIGHT_90" <?php if($settings_row['banner_size_fb']=='BANNER_HEIGHT_90'){?>selected<?php }?>>BANNER_HEIGHT_90</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-12 banner_size_iron" style="display: none">
                                                                                    <select name="banner_size_iron" id="banner_size_iron" class="form-control">
                                                                                         <option value="BANNER_HEIGHT_50" <?php if($settings_row['banner_size_iron']=='BANNER_HEIGHT_50'){?>selected<?php }?>>BANNER</option>
                                                                                        <option value="BANNER_HEIGHT_90" <?php if($settings_row['banner_size_iron']=='BANNER_HEIGHT_90'){?>selected<?php }?>>LARGE_BANNER</option>
                                                                                    </select>
                                                                                </div>
                                                                                <p class="field_lable p_ad_id" >Banner Ad ID :-</p>
                                                                                <p class="field_lable p_app_id" >App ID :-</p>
                                                                                <p class="field_lable p_game_id" >Game ID :-</p>
                                                                                <p class="field_lable p_app_key" >APP KEY :-</p>
                                                                             
                                                                                <div class="col-md-12 banner_ad_id" style="display: none">
                                                                                    <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['banner_ad_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 banner_facebook_id" style="display: none">
                                                                                    <input type="text" name="banner_facebook_id" id="banner_facebook_id" value="<?php echo $settings_row['banner_facebook_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 banner_startapp_id" style="display: none">
                                                                                    <input type="text" name="banner_startapp_id" id="banner_startapp_id" value="<?php echo $settings_row['banner_startapp_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 banner_unity_id" style="display: none">
                                                                                    <input type="text" name="banner_unity_id" id="banner_unity_id" value="<?php echo $settings_row['banner_unity_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 banner_iron_id" style="display: none">
                                                                                    <input type="text" name="banner_iron_id" id="banner_iron_id" value="<?php echo $settings_row['banner_iron_id']; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" name="submit_ads" class="btn btn-primary mt-3">Save</button>
                                                                        </div>
                                                                    </div> 
                                                                    
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-4">
                                                                    <div class="interstital_ads_block">
                                                                        <div class="interstital_ad_item" style="background: #1a237e;">
                                                                            <label class="control-label">Interstitial Ads:-</label>
                                                                            <div class="row toggle_btn">
                                                                                <label class="switch">
                                                                                    <input type="checkbox" id="checked2" name="interstital_ad" value="true" class="cbx hidden" <?php if($settings_row['interstital_ad']=='true'){ echo 'checked'; }?>/>
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="interstital_ad_id">
                                                                                <p class="field_lable">Interstitial Ad Type :-</p>
                                                                                <div class="col-md-12">
                                                                                    <select name="interstital_ad_type" id="interstital_ad_type" class="form-control">
                                                                                        <option value="admob" <?php if ($settings_row['interstital_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                                                        <option value="facebook" <?php if ($settings_row['interstital_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                                                        <option value="startapp" <?php if ($settings_row['interstital_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                                                        <option value="unity" <?php if ($settings_row['interstital_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                                                        <option value="iron" <?php if ($settings_row['interstital_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                                                    </select>
                                                                                </div>
                                                                                <p class="field_lable i_ad_id" >Interstitial Ad ID :-</p>
                                                                                <p class="field_lable i_app_id" >App ID :-</p>
                                                                                <p class="field_lable i_game_id" >Game ID :-</p>
                                                                                <p class="field_lable i_app_key" >APP KEY :-</p>

                                                                                <div class="col-md-12 interstital_ad_id" style="display: none">
                                                                                    <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['interstital_ad_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 interstital_facebook_id" style="display: none">
                                                                                    <input type="text" name="interstital_facebook_id" id="interstital_facebook_id" value="<?php echo $settings_row['interstital_facebook_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 interstital_startapp_id" style="display: none">
                                                                                    <input type="text" name="interstital_startapp_id" id="interstital_startapp_id" value="<?php echo $settings_row['interstital_startapp_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 interstital_unity_id" style="display: none">
                                                                                    <input type="text" name="interstital_unity_id" id="interstital_unity_id" value="<?php echo $settings_row['interstital_unity_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 interstital_iron_id" style="display: none">
                                                                                    <input type="text" name="interstital_iron_id" id="interstital_iron_id" value="<?php echo $settings_row['interstital_iron_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <p class="field_lable">Interstitial Ad Clicks :-</p>
                                                                                <div class="col-md-12">
                                                                                    <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['interstital_ad_click']; ?>" class="form-control ads_click">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-4" >
                                                                    <div class="banner_ads_block">
                                                                        <div class="banner_ad_item" style="background: #1a237e;">
                                                                            <label class="control-label">Native Ads:-</label>
                                                                            <div class="row toggle_btn">
                                                                                <label class="switch">
                                                                                    <input type="checkbox" id="checked4" name="native_ad" value="true" class="cbx hidden" <?php if($settings_row['native_ad']=='true'){ echo 'checked'; }?>/>
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="#admob_banner_id">
                                                                                <p class="field_lable">Native Ad Type :-</p>
                                                                                <div class="col-md-12">
                                                                                    <select name="native_ad_type" id="native_ad_type" class="form-control">
                                                                                        <option value="admob" <?php if ($settings_row['native_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                                                        <option value="facebook" <?php if ($settings_row['native_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                                                        <option value="startapp" <?php if ($settings_row['native_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                                                        <option value="unity" <?php if ($settings_row['native_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                                                        <option value="iron" <?php if ($settings_row['native_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                                                    </select>
                                                                                </div>
                                                                                <p class="field_lable n_ad_id" >Native Ad ID :-</p>
                                                                                <p class="field_lable n_app_id" >App ID :-</p>
                                                                                <p class="field_lable n_game_id" >Game ID :-</p>
                                                                                <p class="field_lable n_app_key" >APP KEY :-</p>
                                                                                
                                                                                <div class="col-md-12 native_ad_id" style="display: none">
                                                                                    <input type="text" name="native_ad_id" id="native_ad_id" value="<?php echo $settings_row['native_ad_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 native_facebook_id" style="display: none">
                                                                                    <input type="text" name="native_facebook_id" id="native_facebook_id" value="<?php echo $settings_row['native_facebook_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 native_startapp_id" style="display: none">
                                                                                    <input type="text" name="native_startapp_id" id="native_startapp_id" value="<?php echo $settings_row['native_startapp_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 native_unity_id" style="display: none">
                                                                                    <input type="text" name="native_unity_id" id="native_unity_id" value="<?php echo $settings_row['native_unity_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-12 native_iron_id" style="display: none">
                                                                                    <input type="text" name="native_iron_id" id="native_iron_id" value="<?php echo $settings_row['native_iron_id']; ?>" class="form-control">
                                                                                </div>
                                                                                <p class="field_lable">Position of Ads:- (MUST USE ODD NUMBER)</p>
                                                                                <div class="col-md-12">
                                                                                    <input type="text" name="native_position" id="native_position" value="<?php echo $settings_row['native_position']; ?>" class="form-control ads_click">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </form>
                                                        </div>
                                                        <!---------------------------------------------------------------------------------------------------------------------------->
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include("includes/footer.php");?>
<script> 
    // Bannerbanner
    if ($("select[name='banner_ad_type']").val() === 'facebook') {
        $(".banner_size_fb").show();
        $(".banner_facebook_id").show();
        $(".banner_ad_id").hide();
        $(".banner_size").hide();
        $(".banner_startapp_id").hide();
        $(".banner_size_add").show();
        $(".p_ad_id").show();
        $(".p_app_id").hide();
        $(".p_game_id").hide();
        $(".banner_unity_id").hide();
        $(".banner_size_iron").hide();
        $(".p_app_key").hide();
        $(".banner_iron_id").hide();
    } else if ($("select[name='banner_ad_type']").val() === 'admob') {
        $(".banner_size_fb").hide();
        $(".banner_facebook_id").hide();
        $(".banner_ad_id").show();
        $(".banner_size").show();
        $(".banner_startapp_id").hide();
        $(".banner_size_add").show();
        $(".p_ad_id").show();
        $(".p_app_id").hide();
        $(".p_game_id").hide();
        $(".banner_unity_id").hide();
        $(".banner_size_iron").hide();
        $(".p_app_key").hide();
        $(".banner_iron_id").hide();
    } else if ($("select[name='banner_ad_type']").val() === 'startapp') {
        $(".banner_size_fb").hide();
        $(".banner_facebook_id").hide();
        $(".banner_ad_id").hide();
        $(".banner_size").hide();
        $(".banner_startapp_id").show();
        $(".banner_size_add").hide();
        $(".p_ad_id").hide();
        $(".p_app_id").show();
        $(".p_game_id").hide();
        $(".banner_unity_id").hide();
        $(".banner_size_iron").hide();
        $(".p_app_key").hide();
        $(".banner_iron_id").hide();
    } else if ($("select[name='banner_ad_type']").val() === 'unity') {
        $(".banner_size_fb").hide();
        $(".banner_facebook_id").hide();
        $(".banner_ad_id").hide();
        $(".banner_size").hide();
        $(".banner_startapp_id").hide();
        $(".banner_size_add").hide();
        $(".p_ad_id").hide();
        $(".p_app_id").hide();
        $(".p_app_id").hide();
        $(".p_game_id").show();
        $(".banner_unity_id").show();
        $(".banner_size_iron").hide();
        $(".p_app_key").hide();
        $(".banner_iron_id").hide();
    } else if ($("select[name='banner_ad_type']").val() === 'iron') {
        $(".banner_size_fb").hide();
        $(".banner_facebook_id").hide();
        $(".banner_ad_id").hide();
        $(".banner_size").hide();
        $(".banner_startapp_id").hide();
        $(".banner_size_add").show();
        $(".p_ad_id").hide();
        $(".p_app_id").hide();
        $(".p_app_id").hide();
        $(".p_game_id").hide();
        $(".banner_unity_id").hide();
        
        $(".banner_size_iron").show();
        $(".p_app_key").show();
        $(".banner_iron_id").show();
    }
    
    $("select[name='banner_ad_type']").change(function(e) {
        if ($(this).val() === 'facebook') {
            $(".banner_size_fb").show();
            $(".banner_facebook_id").show();
            $(".banner_ad_id").hide();
            $(".banner_size").hide();
            $(".banner_startapp_id").hide();
            $(".banner_size_add").show();
            $(".p_ad_id").show();
            $(".p_app_id").hide();
            $(".p_game_id").hide();
            $(".banner_unity_id").hide();
            $(".banner_size_iron").hide();
            $(".p_app_key").hide();
            $(".banner_iron_id").hide();
        } else if ($(this).val() === 'admob') {
            $(".banner_size_fb").hide();
            $(".banner_facebook_id").hide();
            $(".banner_ad_id").show();
            $(".banner_size").show();
            $(".banner_startapp_id").hide();
            $(".banner_size_add").show();
            $(".p_ad_id").show();
            $(".p_app_id").hide();
            $(".p_game_id").hide();
            $(".banner_unity_id").hide();
            $(".banner_size_iron").hide();
            $(".p_app_key").hide();
            $(".banner_iron_id").hide();
        } else if ($(this).val() === 'startapp') {
            $(".banner_size_fb").hide();
            $(".banner_facebook_id").hide();
            $(".banner_ad_id").hide();
            $(".banner_size").hide();
            $(".banner_startapp_id").show();
            $(".banner_size_add").hide();
            $(".p_ad_id").hide();
            $(".p_app_id").show();
            $(".p_game_id").hide();
            $(".banner_unity_id").hide();
            $(".banner_size_iron").hide();
            $(".p_app_key").hide();
            $(".banner_iron_id").hide();
        } else if ($(this).val() === 'unity') {
            $(".banner_size_fb").hide();
            $(".banner_facebook_id").hide();
            $(".banner_ad_id").hide();
            $(".banner_size").hide();
            $(".banner_startapp_id").hide();
            $(".banner_size_add").hide();
            $(".p_ad_id").hide();
            $(".p_app_id").hide();
            $(".p_app_id").hide();
            $(".p_game_id").show();
            $(".banner_unity_id").show();
            $(".banner_size_iron").hide();
            $(".p_app_key").hide();
            $(".banner_iron_id").hide();
        } else if ($(this).val() === 'iron') {
            $(".banner_size_fb").hide();
            $(".banner_facebook_id").hide();
            $(".banner_ad_id").hide();
            $(".banner_size").hide();
            $(".banner_startapp_id").hide();
            $(".banner_size_add").show();
            $(".p_ad_id").hide();
            $(".p_app_id").hide();
            $(".p_app_id").hide();
            $(".p_game_id").hide();
            $(".banner_unity_id").hide();
            
            $(".banner_size_iron").show();
            $(".p_app_key").show();
            $(".banner_iron_id").show();
        }
    });
  
    // Interstital
    if ($("select[name='interstital_ad_type']").val() === 'facebook') {
        $(".interstital_ad_id").hide();
        $(".interstital_facebook_id").show();
        $(".interstital_startapp_id").hide();
        $(".i_ad_id").show();
        $(".i_app_id").hide();
        $(".i_game_id").hide();
        $(".i_app_key").hide();
        $(".interstital_unity_id").hide();
        $(".interstital_iron_id").hide();
    }  else if ($("select[name='banner_ad_type']").val() === 'admob') {
        $(".interstital_facebook_id").hide();
        $(".interstital_ad_id").show();
        $(".interstital_startapp_id").hide();
        $(".i_ad_id").show();
        $(".i_app_id").hide();
        $(".i_game_id").hide();
        $(".i_app_key").hide();
        $(".interstital_unity_id").hide();
        $(".interstital_iron_id").hide();
    }  else if ($("select[name='banner_ad_type']").val() === 'startapp') {
        $(".interstital_facebook_id").hide();
        $(".interstital_ad_id").hide();
        $(".interstital_startapp_id").show();
        $(".i_ad_id").hide();
        $(".i_app_id").show();
        $(".i_game_id").hide();
        $(".i_app_key").hide();
        $(".interstital_unity_id").hide();
        $(".interstital_iron_id").hide();
    }  else if ($("select[name='banner_ad_type']").val() === 'unity') {
        $(".interstital_facebook_id").hide();
        $(".interstital_ad_id").hide();
        $(".interstital_startapp_id").hide();
        $(".i_ad_id").hide();
        $(".i_app_id").hide();
        $(".i_game_id").show();
        $(".i_app_key").hide();
        $(".interstital_unity_id").show();
        $(".interstital_iron_id").hide();
    }  else if ($("select[name='banner_ad_type']").val() === 'iron') {
        $(".interstital_facebook_id").hide();
        $(".interstital_ad_id").hide();
        $(".interstital_startapp_id").hide();
        $(".i_ad_id").hide();
        $(".i_app_id").hide();
        $(".i_game_id").hide();
        $(".i_app_key").show();
        $(".interstital_unity_id").hide();
        $(".interstital_iron_id").show();
    }
    
    $("select[name='interstital_ad_type']").change(function(e) {
        if ($(this).val() === 'facebook') {
            $(".interstital_ad_id").hide();
            $(".interstital_facebook_id").show();
            $(".interstital_startapp_id").hide();
            $(".i_ad_id").show();
            $(".i_app_id").hide();
            $(".i_game_id").hide();
            $(".i_app_key").hide();
            $(".interstital_unity_id").hide();
            $(".interstital_iron_id").hide();
        }else if ($(this).val() === 'admob') {
            $(".interstital_facebook_id").hide();
            $(".interstital_ad_id").show();
            $(".interstital_startapp_id").hide();
            $(".i_ad_id").show();
            $(".i_app_id").hide();
            $(".i_game_id").hide();
            $(".i_app_key").hide();
            $(".interstital_unity_id").hide();
            $(".interstital_iron_id").hide();
        }else if ($(this).val() === 'startapp') {
            $(".interstital_facebook_id").hide();
            $(".interstital_ad_id").hide();
            $(".interstital_startapp_id").show();
            $(".i_ad_id").hide();
            $(".i_app_id").show();
            $(".i_game_id").hide();
            $(".i_app_key").hide();
            $(".interstital_unity_id").hide();
            $(".interstital_iron_id").hide();
        }else if ($(this).val() === 'unity') {
            $(".interstital_facebook_id").hide();
            $(".interstital_ad_id").hide();
            $(".interstital_startapp_id").hide();
            $(".i_ad_id").hide();
            $(".i_app_id").hide();
            $(".i_game_id").show();
            $(".i_app_key").hide();
            $(".interstital_unity_id").show();
            $(".interstital_iron_id").hide();
        }else if ($(this).val() === 'iron') {
            $(".interstital_facebook_id").hide();
            $(".interstital_ad_id").hide();
            $(".interstital_startapp_id").hide();
            $(".i_ad_id").hide();
            $(".i_app_id").hide();
            $(".i_game_id").hide();
            $(".i_app_key").show();
            $(".interstital_unity_id").hide();
            $(".interstital_iron_id").show();
        }
    });
    
    
    // Native
    if ($("select[name='native_ad_type']").val() === 'facebook') {
        $(".native_ad_id").hide();
        $(".native_facebook_id").show();
        $(".native_startapp_id").hide();
        $(".n_ad_id").show();
        $(".n_app_id").hide();
        $(".n_game_id").hide();
        $(".n_app_key").hide();
        $(".native_unity_id").hide();
        $(".native_iron_id").hide();
    }else if ($("select[name='native_ad_type']").val() === 'admob') {
        $(".native_facebook_id").hide();
        $(".native_ad_id").show();
        $(".native_startapp_id").hide();
        $(".n_ad_id").show();
        $(".n_app_id").hide();
        $(".n_game_id").hide();
        $(".n_app_key").hide();
        $(".native_unity_id").hide();
        $(".native_iron_id").hide();
    }else if ($("select[name='native_ad_type']").val() === 'startapp') {
        $(".native_facebook_id").hide();
        $(".native_ad_id").hide();
        $(".native_startapp_id").show();
        $(".n_ad_id").hide();
        $(".n_app_id").show();
        $(".n_game_id").hide();
        $(".n_app_key").hide();
        $(".native_unity_id").hide();
        $(".native_iron_id").hide();
    }else if ($("select[name='native_ad_type']").val() === 'unity') {
        $(".native_facebook_id").hide();
        $(".native_ad_id").hide();
        $(".native_startapp_id").hide();
        $(".n_ad_id").hide();
        $(".n_app_id").hide();
        $(".n_game_id").show();
        $(".n_app_key").hide();
        $(".native_unity_id").show();
        $(".native_iron_id").hide();
    }else if ($("select[name='native_ad_type']").val() === 'iron') {
        $(".native_facebook_id").hide();
        $(".native_ad_id").hide();
        $(".native_startapp_id").hide();
        $(".n_ad_id").hide();
        $(".n_app_id").hide();
        $(".n_game_id").hide();
        $(".n_app_key").show();
        $(".native_unity_id").hide();
        $(".native_iron_id").show();
    }
    
    $("select[name='native_ad_type']").change(function(e) {
        if ($(this).val() === 'facebook') {
            $(".native_ad_id").hide();
            $(".native_facebook_id").show();
            $(".native_startapp_id").hide();
            $(".n_ad_id").show();
            $(".n_app_id").hide();
            $(".n_app_key").hide();
            $(".n_game_id").hide();
            $(".native_unity_id").hide();
            $(".native_iron_id").hide();
        }else if ($(this).val() === 'admob') {
            $(".native_facebook_id").hide();
            $(".native_ad_id").show();
            $(".native_startapp_id").hide();
            $(".n_ad_id").show();
            $(".n_app_id").hide();
            $(".n_app_key").hide();
            $(".n_game_id").hide();
            $(".native_unity_id").hide();
            $(".native_iron_id").hide();
        }else if ($(this).val() === 'startapp') {
             $(".native_facebook_id").hide();
            $(".native_ad_id").hide();
            $(".native_startapp_id").show();
            $(".n_ad_id").hide();
            $(".n_app_id").show();
            $(".n_game_id").hide();
            $(".n_app_key").hide();
            $(".native_unity_id").hide();
            $(".native_iron_id").hide();
        }else if ($(this).val() === 'unity') {
             $(".native_facebook_id").hide();
            $(".native_ad_id").hide();
            $(".native_startapp_id").hide();
            $(".n_ad_id").hide();
            $(".n_app_id").hide();
            $(".n_game_id").show();
            $(".n_app_key").hide();
            $(".native_unity_id").show();
            $(".native_iron_id").hide();
        }else if ($(this).val() === 'iron') {
            $(".native_facebook_id").hide();
            $(".native_ad_id").hide();
            $(".native_startapp_id").hide();
            $(".n_ad_id").hide();
            $(".n_app_id").hide();
            $(".n_game_id").hide();
            $(".n_app_key").show();
            $(".native_unity_id").hide();
            $(".native_iron_id").show();
        }
    });
  
    // ActiveTab 
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    document.title = $(this).text()+" | <?=APP_NAME?>";
    });
    
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
</script> 
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/custom-clipboard.js"></script>