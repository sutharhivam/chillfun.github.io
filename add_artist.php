<?php
     $page_title=(isset($_GET['artist_id'])) ? 'Edit Artist' : 'Add Artist';
    
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");

    if(isset($_POST['submit']) and isset($_GET['add'])){
    
        $artist_image=rand(0,99999)."_".$_FILES['artist_image']['name'];
        
        //Main Image
        $tpath1='images/'.$artist_image; 			 
        $pic1=compress_image($_FILES["artist_image"]["tmp_name"], $tpath1, 80);
        
        $data = array( 
            'artist_name'  =>  $_POST['artist_name'],
            'artist_image'  =>  $artist_image
        );		
        
        $qry = Insert('tbl_artist',$data);	
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_artist.php");
        exit;	

    }
    
    if(isset($_GET['artist_id'])){
        $qry="SELECT * FROM tbl_artist where id='".$_GET['artist_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['artist_id'])){
    
        if($_FILES['artist_image']['name']!=""){		
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_artist WHERE id='.$_GET['artist_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['artist_image']!=""){
            unlink('images/'.$img_res_row['artist_image']);
            }
            
            $artist_image=rand(0,99999)."_".$_FILES['artist_image']['name'];
            
            //Main Image
            $tpath1='images/'.$artist_image; 			 
            $pic1=compress_image($_FILES["artist_image"]["tmp_name"], $tpath1, 80);
    
            $data = array(
                'artist_name'  =>  $_POST['artist_name'],
                'artist_image'  =>  $artist_image
            );
            
            $category_edit=Update('tbl_artist', $data, "WHERE id = '".$_POST['artist_id']."'");
        
        }else{
        
            $data = array(
                'artist_name'  =>  $_POST['artist_name']
            );	
            $artist_edit=Update('tbl_artist', $data, "WHERE id = '".$_POST['artist_id']."'");
        }
    
    
        $_SESSION['msg']="11"; 
        $_SESSION['class']='success'; 
        header( "Location:add_artist.php?artist_id=".$_POST['artist_id']);
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
                        echo '<a href="manage_artist.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['artist_id'])){ ?>
                       <input  type="hidden" name="artist_id" value="<?php echo $_GET['artist_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Artist Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="artist_name" value="<?php if(isset($_GET['artist_id'])){echo $row['artist_name'];}?>" class="form-control col-md-7">
                                    </div>
                                </div>
   
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="artist_image" value="fileupload" <?=(!isset($_GET['artist_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <?php if(isset($_GET['artist_id']) AND file_exists('images/'.$row['artist_image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img  class="col-sm-3" type="image" src="images/<?=$row['artist_image']?>"  alt="image" />
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
