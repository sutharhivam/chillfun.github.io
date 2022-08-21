<?php
    $page_title="App Update";
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);

    if(isset($_POST['app_update'])){

        $data = array(
            'isUpdate' => ($_POST['isUpdate']) ? 'true' : 'false',
            'version' => trim($_POST['version']),
            'version_name' => trim($_POST['version_name']),
            'description' => trim($_POST['description']),
            'url' => trim($_POST['url']),
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['class']="success";
        $_SESSION['msg']="11";
        header( "Location:app_update.php");
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
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">On / Off</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                         <label class="switch">
                                            <input type="checkbox" id="isUpdate" name="isUpdate" value="true" class="cbx hidden" <?php if($settings_row['isUpdate']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">New App Version Code</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="version" value="<?php echo $settings_row['version'];?>" class="form-control col-md-7" >
                                    </div>
                                </div>
                                
                                 <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">New App Version Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="version_name" value="<?php echo $settings_row['version_name'];?>" class="form-control col-md-7">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Description</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="description" value="<?php echo $settings_row['description'];?>" class="form-control col-md-7" >
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">App Link</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="url" value="<?php echo $settings_row['url'];?>" class="form-control col-md-7" >
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="app_update" class="btn btn-primary mt-3">Save</button>
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
