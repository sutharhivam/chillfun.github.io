<?php
    $page_title=(isset($_GET['cat_id'])) ? 'Edit Category' : 'Add Category';
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	if(isset($_POST['submit']) and isset($_GET['add'])){
	    
	     if($_FILES['category_image']['name']!=""){ 
	        $category_image=rand(0,99999)."_".$_FILES['category_image']['name'];
            $tpath1='images/'.$category_image;        
            $pic1=compress_image($_FILES["category_image"]["tmp_name"], $tpath1, 80);
	     }else{
	         $category_image = "";
	     }

        $data = array( 
            'category_name'  =>  $_POST['category_name'],
            'category_image'  =>  $category_image
        );    
        
        $qry = Insert('tbl_category',$data);  
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_category.php");
        exit; 
    }
    
    if(isset($_GET['cat_id'])){
        $qry="SELECT * FROM tbl_category where cid='".$_GET['cat_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['cat_id'])){
        if($_FILES['category_image']['name']!=""){    
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_category WHERE cid='.$_GET['cat_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['category_image']!=""){
                unlink('images/'.$img_res_row['category_image']);
            }
            
            $category_image=rand(0,99999)."_".$_FILES['category_image']['name'];
            
            //Main Image
            $tpath1='images/'.$category_image;        
            $pic1=compress_image($_FILES["category_image"]["tmp_name"], $tpath1, 80);
            
            $data = array(
                'category_name'  =>  $_POST['category_name'],
                'category_image'  =>  $category_image
            );
            
            $category_edit=Update('tbl_category', $data, "WHERE cid = '".$_POST['cat_id']."'");
            
        }else{
            $data = array(
                'category_name'  =>  $_POST['category_name']
            );  
            
            $category_edit=Update('tbl_category', $data, "WHERE cid = '".$_POST['cat_id']."'");
        }
    
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header( "Location:manage_category.php?cat_id=".$_POST['cat_id']);
        exit;
    }

?>

<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
             <div class="row ml-1 mb-2">
                <?php 
                    if(isset($_GET['redirect'])){
                        echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    }else {
                        echo '<a href="manage_category.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['cat_id'])){ ?>
                       <input  type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="category_name" value="<?php if(isset($_GET['cat_id'])){echo $row['category_name'];}?>" class="form-control col-md-7">
                                    </div>
                                </div>
   
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="category_image" value="fileupload" <?=(!isset($_GET['cat_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <?php if(isset($_GET['cat_id']) AND file_exists('images/'.$row['category_image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img  class="col-sm-3" type="image" src="images/<?=$row['category_image']?>"  alt="image" />
                                            </div>
                                        <?php }else{ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img class="col-sm-3" type="image" src="assets/images/300x300.jpg" alt="image" />
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" id="submit"class="btn btn-primary mt-3">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                 <!----------------------------------------------------------------------------------------------------------------->
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
