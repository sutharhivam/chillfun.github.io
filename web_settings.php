<?php
    $page_title="Web Settings";
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$qry="SELECT * FROM tbl_web_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
    $_SESSION['class']="success";
    
    if(isset($_POST['submit_general'])){
        
        if($_POST['web_favicon']==''){

          $ext = pathinfo($_FILES['web_favicon']['name'], PATHINFO_EXTENSION);

          $favicon_image=rand(0,99999)."_".date('dmYhis').".".$ext;

          //Main Image
          $tpath1='images/'.$favicon_image;   

          if($ext!='png')  {
            $pic1=compress_image($_FILES["web_favicon"]["tmp_name"], $tpath1, 80);
          }
          else{
            $tmp = $_FILES['web_favicon']['tmp_name'];
            move_uploaded_file($tmp, $tpath1);
          }
        }
        
        $data = array(
            'admin_panel'  =>  $_POST['admin_panel'],
            'site_name'  =>  cleanInput($_POST['site_name']),
            'site_description'  =>  cleanInput($_POST['site_description']),
            'site_keywords'  =>  cleanInput($_POST['site_keywords']),
            'web_favicon'  =>  $favicon_image,
            'copyright_text'  =>  cleanInput($_POST['copyright_text']),
            'header_code'  =>  htmlentities(trim($_POST['header_code'])),
            'footer_code'  => htmlentities(trim($_POST['footer_code']))
        );

        $settings_edit = Update('tbl_web_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:web_settings.php");
        exit;
    }
    
    
    if(isset($_POST['submit_contact_us'])){

        $data = array(
            
            'contact_page_title'  =>  cleanInput($_POST['contact_page_title']),
            'address'  =>  cleanInput($_POST['address']),
            'contact_number'  =>  cleanInput($_POST['contact_number']),
            'contact_email'  =>  cleanInput($_POST['contact_email']),
            
            'android_app_url'  =>  $_POST['android_app_url'],
            'ios_app_url'  =>  $_POST['ios_app_url'],
            
            'facebook_url'  =>  $_POST['facebook_url'],
            'twitter_url'  =>  $_POST['twitter_url'],
            'youtube_url'  =>  $_POST['youtube_url'],
            'instagram_url'  => $_POST['instagram_url']
            
        );

        $settings_edit = Update('tbl_web_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:web_settings.php");
        exit;
    }
    
    
    if(isset($_POST['submit_about_us'])){

        $data = array(
            'about_page_title'  =>  cleanInput($_POST['about_page_title']),
            'about_content'  =>  addslashes($_POST['about_content']),
            'about_status' => ($_POST['about_status']) ? 'true' : 'false'
        );

        $settings_edit = Update('tbl_web_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:web_settings.php");
        exit;
    }
    
    
    if(isset($_POST['submit_privacy'])){

        $data = array(
            'privacy_page_title'  =>  cleanInput($_POST['privacy_page_title']),
            'privacy_content'  =>  addslashes($_POST['privacy_content']),
            'privacy_page_status' => ($_POST['privacy_page_status']) ? 'true' : 'false'
        );

        $settings_edit = Update('tbl_web_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:web_settings.php");
        exit;
    }
    
    if(isset($_POST['submit_terms'])){

        $data = array(
            'terms_of_use_page_title'  =>  cleanInput($_POST['terms_of_use_page_title']),
            'terms_of_use_content'  =>  addslashes($_POST['terms_of_use_content']),
            'terms_of_use_page_status' => ($_POST['terms_of_use_page_status']) ? 'true' : 'false'
        );

        $settings_edit = Update('tbl_web_settings', $data, "WHERE id = '1'");

        $_SESSION['msg'] = "11";
        header("Location:web_settings.php");
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
                                                        <a class="nav-link active" id="web_settings-tab" data-toggle="tab" href="#web_settings" role="tab" aria-controls="web_settings" aria-selected="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                             General Settings
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="contact_us-tab" data-toggle="tab" href="#contact_us" role="tab" aria-controls="contact_us" aria-selected="false">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                           Contact Us
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="about_us-tab" data-toggle="tab" href="#about_us" role="tab" aria-controls="about_us" aria-selected="false">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                           About Us
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="privacy-tab" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                           Privacy Policy
                                                        </a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="terms-tab" data-toggle="tab" href="#terms" role="tab" aria-controls="terms" aria-selected="false">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                                           Terms
                                                        </a>
                                                    </li>
                                                </ul>
                                                
                                                
                                                <div class="tab-content" id="animateLineContent-4">
                                                    
                                                    <!---------------------------------------------------------------------------------------------------------------------------->
                                                    <div class="tab-pane fade show active" id="web_settings" role="tabpanel" aria-labelledby="web_settings-tab">
                                                     <form action="" name="settings_general" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                         
                                                         <div class="form-group row mb-4 mt-5">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">This admin panel URl</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="text" name="admin_panel" id="admin_panel" value="<?php echo $settings_row['admin_panel']; ?>"  class="form-control col-md-7" required="required">
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="form-group row mb-4 mt-5">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Site Name</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="text" name="site_name" id="site_name" value="<?php echo $settings_row['site_name']; ?>"  class="form-control col-md-7" required="required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Site Description</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="col-md-7" style="padding: 0px;">
                                                                    <textarea rows="6" name="site_description" class="form-control" required=""><?php echo stripslashes($settings_row['site_description']); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Site Keywords</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="text" name="site_keywords" id="site_keywords" value="<?php echo $settings_row['site_keywords']; ?>"  class="form-control col-md-7" required="required">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Site Favicon</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="file" class="form-control-file" name="web_favicon" value="fileupload" accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                                                        <p class="control-label-help hint_lbl">(Recommended resolution: 16x16 or 32x32)</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <?php if($settings_row['web_favicon']!='' AND file_exists('images/'.$settings_row['web_favicon'])) { ?>
                                                                            <div class="fileupload_img" id="imagePreview">
                                                                                <img  type="image" src="images/<?=$settings_row['web_favicon']?>" style="width: 50px;height: 50px"   alt="image" />
                                                                            </div>
                                                                        <?php }else{ ?>
                                                                            <div class="fileupload_img" id="imagePreview">
                                                                                <img type="image" src="assets/img/300x300.jpg" style="width: 200px;height: 200px"  alt="image" />
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                        </div>

                                                        <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Copyright Text</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="text" name="copyright_text" id="copyright_text" value="<?php echo $settings_row['copyright_text']; ?>"  class="form-control col-md-7" required="required">
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Header Code</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="col-md-7" style="padding: 0px;">
                                                                    <textarea rows="6" name="header_code" class="form-control"  placeholder="Custom CSS or JS Script" ><?php echo html_entity_decode($settings_row['header_code']); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Footer Code</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="col-md-7" style="padding: 0px;">
                                                                    <textarea rows="6" name="footer_code" class="form-control" placeholder="Custom CSS or JS Script"><?php echo html_entity_decode($settings_row['footer_code']); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-10">
                                                                <button type="submit" name="submit_general" class="btn btn-primary mt-3">Save</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <!---------------------------------------------------------------------------------------------------------------------------->
                                                    <div class="tab-pane fade" id="contact_us" role="tabpanel" aria-labelledby="contact_us-tab">
                                                        <form action="" name="settings_contact_us" method="post" class="form form-horizontal" enctype="multipart/form-data">

                                                            <div class="form-group row mb-4 mt-5">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="contact_page_title" id="contact_page_title" value="<?php echo $settings_row['contact_page_title']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Address</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="address" id="address" value="<?php echo $settings_row['address']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Contact number</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="contact_number" id="contact_number" value="<?php echo $settings_row['contact_number']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Contact email</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="contact_email" id="contact_email" value="<?php echo $settings_row['contact_email']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                            <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">App Link</h4>
                                                            <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Android App Link</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="android_app_url" id="android_app_url" value="<?php echo $settings_row['android_app_url']; ?>"  class="form-control col-md-7" >
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">iOS App Link</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="ios_app_url" id="ios_app_url" value="<?php echo $settings_row['ios_app_url']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                            <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">Social Media</h4>
                                                            <div class="mb-3 mt-3" style="border-bottom: 1px solid #f1f2f3;"></div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Facebook</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo $settings_row['facebook_url']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Twitter</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo $settings_row['twitter_url']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">YouTube</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="youtube_url" id="youtube_url" value="<?php echo $settings_row['youtube_url']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Instagram</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="instagram_url" id="instagram_url" value="<?php echo $settings_row['instagram_url']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>

                                                        
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_contact_us" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div> 
                                                            
                                                         </form>
                                                    </div>
                                                    <!---------------------------------------------------------------------------------------------------------------------------->
                                                    <div class="tab-pane fade" id="about_us" role="tabpanel" aria-labelledby="about_us-tab">
                                                        <form action="" name="settings_about_us" method="post" class="form form-horizontal" enctype="multipart/form-data">

                                                            <div class="form-group row mb-4 mt-5">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="about_page_title" id="about_page_title" value="<?php echo $settings_row['about_page_title']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Content</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7" style="padding: 0px;">
                                                                        <textarea name="about_content" id="about_content" class="form-control"><?php echo stripslashes($settings_row['about_content']);?></textarea>
                                                                <script>CKEDITOR.replace( 'about_content' );</script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Status</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="about_status" name="about_status" value="true" class="cbx hidden" <?php if($settings_row['about_status']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_about_us" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div> 
                                                            
                                                         </form>
                                                    </div>
                                                    <!---------------------------------------------------------------------------------------------------------------------------->
                                                    <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                                                        <form action="" name="settings_privacy" method="post" class="form form-horizontal" enctype="multipart/form-data">

                                                            <div class="form-group row mb-4 mt-5">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="privacy_page_title" id="privacy_page_title" value="<?php echo $settings_row['privacy_page_title']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Content</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7" style="padding: 0px;">
                                                                        <textarea name="privacy_content" id="privacy_content" class="form-control"><?php echo stripslashes($settings_row['privacy_content']);?></textarea>
                                                                        <script>CKEDITOR.replace( 'privacy_content' );</script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Status</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="privacy_page_status" name="privacy_page_status" value="true" class="cbx hidden" <?php if($settings_row['privacy_page_status']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_privacy" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div> 
                                                            
                                                         </form>
                                                    </div>
                                                    <!---------------------------------------------------------------------------------------------------------------------------->
                                                    <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                                                        <form action="" name="settings_terms" method="post" class="form form-horizontal" enctype="multipart/form-data">

                                                            <div class="form-group row mb-4 mt-5">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="terms_of_use_page_title" id="terms_of_use_page_title" value="<?php echo $settings_row['terms_of_use_page_title']; ?>"  class="form-control col-md-7" required="required">
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Content</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7" style="padding: 0px;">
                                                                        <textarea name="terms_of_use_content" id="terms_of_use_content" class="form-control"><?php echo stripslashes($settings_row['terms_of_use_content']);?></textarea>
                                                                        <script>CKEDITOR.replace( 'terms_of_use_content' );</script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Page Status</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <div class="col-md-7">
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="terms_of_use_page_status" name="terms_of_use_page_status" value="true" class="cbx hidden" <?php if($settings_row['terms_of_use_page_status']=='true'){ echo 'checked'; }?>/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit_terms" class="btn btn-primary mt-3">Save</button>
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
    // ActiveTab 
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTabWeb', $(e.target).attr('href'));
    document.title = $(this).text()+" | <?=APP_NAME?>";
    });
    
    var activeTab = localStorage.getItem('activeTabWeb');
    if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
</script> 
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/custom-clipboard.js"></script>