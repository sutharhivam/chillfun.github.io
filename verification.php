<?php
    $page_title="Envato Verify Purchase";
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
    
    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
    if(isset($_POST['verify_envato'])){

        $key = generateStrongPassword();
        $envato_buyer= verify_envato_purchase_code(trim($_POST['envato_purchase_code']));

        if($_POST['envato_buyer_name']!='' AND $envato_buyer->buyer==$_POST['envato_buyer_name'] AND $envato_buyer->item->id==$item_id){
            
            $key2 = $key;
            
            $data = array(
                'envato_buyer_name' => trim($_POST['envato_buyer_name']),
                'envato_purchase_code' => trim($_POST['envato_purchase_code']),
                'envato_purchased_status' => 1,
                'app_api_key' => $key2,
                'package_name' => trim($_POST['package_name'])
            );

            $settings_edit =Update('tbl_settings', $data, "WHERE id = '1'");

            $config_file_path= $config_file_name;
            $config_file = file_get_contents($config_file_default);
            $f = @fopen($config_file_path, "w+");
            if(@fwrite($f, $config_file) > 0){
            }
            
            verify_data_on_server("android_app", trim($_POST['envato_purchase_code']), $key2, trim($_POST['package_name']));

            $_SESSION['class']="success";
            $_SESSION['msg']="19";
            header( "Location:verification.php");
            exit;
        }
        else{
        
            $data = array(
                'envato_buyer_name' => trim($_POST['envato_buyer_name']),
                'envato_purchase_code' => trim($_POST['envato_purchase_code']),
                'envato_purchased_status' => 0,
                'app_api_key' => '',
                'package_name' => trim($_POST['package_name'])
            );

            $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

            $_SESSION['class']="error";
            $_SESSION['msg']="18";
            header( "Location:verification.php");
            exit;
        }
    }
?>

<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <form action="" name="verify_envato_code" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Envato Username</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="envato_buyer_name" value="<?php echo $settings_row['envato_buyer_name'];?>" class="form-control col-md-7" placeholder="nemosofts" value="">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Envato Purchase Code</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="envato_purchase_code" value="<?php echo $settings_row['envato_purchase_code'];?>" class="form-control col-md-7" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                                        <small id="sh-text1" class="form-text text-muted"><a style="color: #f44336;" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a></small>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">ApiKey</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <input type="text" name="app_api_key" value="<?php echo $settings_row['app_api_key'];?>"  class="form-control col-md-7 " placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" readonly>
                                        <small id="sh-text1" class="form-text text-muted col-md-6" style="padding: 0px;">Click the Save button This key will be generated automatically. This key protects your API URL. No need to copy this key.</small>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Android Package Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="package_name" id="package_name" value="<?php echo $settings_row['package_name'];?>"  class="form-control col-md-7" placeholder="com.example.myapp">
                                        <small id="sh-text1" class="form-text text-muted">(More info in Android Doc)</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="verify_envato" class="btn btn-primary mt-3">Save</button>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>