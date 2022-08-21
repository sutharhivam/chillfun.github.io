<?php
    $page_title="Send Notification";
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
    if(isset($_POST['submit'])){

        if($_POST['external_link']!=""){
        $external_link = $_POST['external_link'];
        }else{
        $external_link = false;
        } 
        
        $cat_name='';
        $artist_name='';
        $song_name='';
        $album_name='';
        
        
        if($_FILES['big_picture']['name']!=""){   
        
        $big_picture=rand(0,99999)."_".$_FILES['big_picture']['name'];
        $tpath2='images/'.$big_picture;
        move_uploaded_file($_FILES["big_picture"]["tmp_name"], $tpath2);
        
        if( isset($_SERVER['HTTPS'] ) ) {  
          $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.$big_picture;
        }else{
          $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.$big_picture;
        }
          
        $content = array(
            "en" => $_POST['notification_msg']                                                 
        );
        
        $fields = array(
            'app_id' => ONESIGNAL_APP_ID,
            'included_segments' => array('All'),                                            
            'data' => array("foo" => "bar","cat_id"=>$_POST['cat_id'],"cat_name"=>$cat_name,"artist_id"=>$_POST['artist_id'],"artist_name"=>$artist_name,"album_id"=>$_POST['album_id'],"album_name"=>$album_name,"song_id"=>$_POST['song_id'],"song_name"=>$song_name,"external_link"=>$external_link),
            'headings'=> array("en" => $_POST['notification_title']),
            'contents' => $content,
            'big_picture' =>$file_path                    
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.ONESIGNAL_REST_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
    }else{

        $content = array(
            "en" => $_POST['notification_msg']
        );
        
        $fields = array(
            'app_id' => ONESIGNAL_APP_ID,
            'included_segments' => array('All'),                                      
            'data' => array("foo" => "bar","cat_id"=>$_POST['cat_id'],"cat_name"=>$cat_name,"artist_id"=>$_POST['artist_id'],"artist_name"=>$artist_name,"album_id"=>$_POST['album_id'],"album_name"=>$album_name,"song_id"=>$_POST['song_id'],"song_name"=>$song_name,"external_link"=>$external_link),
            'headings'=> array("en" => $_POST['notification_title']),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.ONESIGNAL_REST_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        
        curl_close($ch);
    }
        
    $_SESSION['class'] = "success";
    $_SESSION['msg']="16";
    header( "Location:send_notification.php");
    exit; 
    }
  
 
    
    else if(isset($_POST['notification_submit'])) {
    
        $data = array(
          'onesignal_app_id' => trim($_POST['onesignal_app_id']),
          'onesignal_rest_key' => trim($_POST['onesignal_rest_key']),
        );
        
        $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['class'] = "success";
        $_SESSION['msg'] = "11";
        header("Location:send_notification.php");
        exit;
    }
    

?>

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
                                                    
                                                    <ul class="nav nav-tabs  mb-4" id="animateLine" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                            Notification Settings</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                                                            Send Notification</a>
                                                        </li>
                                                    
                                                    </ul>

                                                    <div class="tab-content" id="animateLineContent-4">
                                                        
                                                        <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                                            <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">OneSignal App ID</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="onesignal_app_id" id="onesignal_app_id" value="<?php echo $settings_details['onesignal_app_id']; ?>"  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">OneSignal Rest Key</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text"  name="onesignal_rest_key" id="onesignal_rest_key" value="<?php echo $settings_details['onesignal_rest_key']; ?>" class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="notification_submit" class="btn btn-primary mt-3">Save</button>
                                                                </div>
                                                            </div> 
                                                            </form>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                                            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="text" name="notification_title" id="notification_title" value="" placeholder=""  class="form-control col-md-7">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Title</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <textarea name="notification_msg" id="notification_msg" class="form-control col-md-7" required></textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row mb-4">
                                                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                    <input type="file" class="form-control-file" name="category_image" value="fileupload" accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                                                 </div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-10">
                                                                    <button type="submit" name="submit"  class="btn btn-primary mt-3">Send</button>
                                                                </div>
                                                            </div> 
                                                            
                                                        </div>
                                                        </form>
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
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    document.title = $(this).text()+" | <?=APP_NAME?>";
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }
  </script>