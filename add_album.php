<?php
    $page_title=(isset($_GET['album_id'])) ? 'Edit Album' : 'Add Album';
    
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $art_qry="SELECT * FROM tbl_artist ORDER BY artist_name";
    $art_result=mysqli_query($mysqli,$art_qry);
    
    $cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
    $cat_result=mysqli_query($mysqli,$cat_qry); 
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        $album_image=rand(0,99999)."_".$_FILES['album_image']['name'];
        
        $tpath1='images/'.$album_image; 			 
        $pic1=compress_image($_FILES["album_image"]["tmp_name"], $tpath1, 80);
        
        $data = array( 
            'cat_id'  =>  $_POST['cat_id'],
            'album_name'  =>  $_POST['album_name'],
            'album_image'  =>  $album_image,
            'artist_ids'  => implode(',', $_POST['artist_ids'])
        );		
        
        $qry = Insert('tbl_album',$data);	
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_album.php");
        exit;	
    }
    
    if(isset($_GET['album_id'])){
        $qry="SELECT * FROM tbl_album where aid='".$_GET['album_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['album_id'])){
        
        if($_FILES['album_image']['name']!=""){	
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_album WHERE aid='.$_GET['album_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['album_image']!=""){
                unlink('images/'.$img_res_row['album_image']);
            }
            
            $album_image=rand(0,99999)."_".$_FILES['album_image']['name'];
            
            $tpath1='images/'.$album_image; 			 
            $pic1=compress_image($_FILES["album_image"]["tmp_name"], $tpath1, 80);
            
            $data = array(
                'cat_id'  =>  $_POST['cat_id'],
                'album_name'  =>  $_POST['album_name'],
                'album_image'  =>  $album_image,
                'artist_ids'  => implode(',', $_POST['artist_ids'])
            );
            
            $category_edit=Update('tbl_album', $data, "WHERE aid = '".$_POST['album_id']."'");
        }else{
        $data = array(
            'cat_id'  =>  $_POST['cat_id'],
            'album_name'  =>  $_POST['album_name'],
            'artist_ids'  => implode(',', $_POST['artist_ids'])
        );	
        
        $artist_edit=Update('tbl_album', $data, "WHERE aid = '".$_POST['album_id']."'");
        }
        
        $_SESSION['msg']="11"; 
        $_SESSION['class']='success'; 
        header( "Location:add_album.php?album_id=".$_POST['album_id']);
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
                        echo '<a href="manage_album.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['album_id'])){ ?>
                       <input  type="hidden" name="album_id" value="<?php echo $_GET['album_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Album Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text"  name="album_name" id="album_name" value="<?php if(isset($_GET['album_id'])){echo $row['album_name'];}?>" class="form-control col-md-7">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Category :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <select name="cat_id" id="cat_id" class="form-control col-md-6 basic">
                                                <option value="">--Select Category--</option>
                                                <?php while($cat_row=mysqli_fetch_array($cat_result)){ ?>
                                                    <?php if(isset($_GET['album_id'])){ ?>
                              							<option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
                                                    <?php }else{ ?>
                              						    <option value="<?php echo $cat_row['cid'];?>"><?php echo $cat_row['category_name'];?></option>   							 
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Artist :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <select name="artist_ids[]" id="artist_ids" class="form-control tagging" required multiple="multiple">
                                            <option value="">--Select Artist--</option>
                                             <?php while($art_row=mysqli_fetch_array($art_result)){ ?> 
                                                <?php if(isset($_GET['album_id'])){?>
                                                    <option value="<?php echo $art_row['id'];?>" <?php if(in_array($art_row['id'], explode(",",$row['artist_ids']))){?>selected<?php }?>><?php echo $art_row['artist_name'];?></option>                           
                                                <?php }else{?>  
                                                    <option value="<?php echo $art_row['id'];?>"><?php echo $art_row['artist_name'];?></option>
                                                <?php }?>  
                                            <?php }?>
                                         </select>

                                        </div>
                                    </div>
                                </div>
   
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="album_image" value="fileupload" <?=(!isset($_GET['album_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <?php if(isset($_GET['album_id']) AND file_exists('images/'.$row['album_image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img  class="col-sm-3" type="image" src="images/<?=$row['album_image']?>"  alt="image" />
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
<script>
$(".tagging").select2({
    tags: true
});
</script>