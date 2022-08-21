<?php
   $page_title=(isset($_GET['banner_id'])) ? 'Edit Banner' : 'Add Banner';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $mp3_qry="SELECT * FROM tbl_mp3 ORDER BY tbl_mp3.id DESC"; 
    $mp3_result=mysqli_query($mysqli,$mp3_qry); 

    if(isset($_POST['submit']) and isset($_GET['add'])){
        $banner_image=rand(0,99999)."_".$_FILES['banner_image']['name'];
        
        //Main Image
        $tpath1='images/'.$banner_image; 			 
        $pic1=compress_image($_FILES["banner_image"]["tmp_name"], $tpath1, 80);
        
        $data = array( 
            'banner_title'  =>  $_POST['banner_title'],
            'banner_sort_info'  =>  $_POST['banner_sort_info'],
            'banner_image'  =>  $banner_image,
            'banner_songs'  =>  implode(',',$_POST['banner_songs'])
        );		
        
        $qry = Insert('tbl_banner',$data);	
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_banners.php");
        exit;			 
    }
    
    if(isset($_GET['banner_id'])){
        $qry="SELECT * FROM tbl_banner where bid='".$_GET['banner_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['banner_id'])){
        if($_FILES['banner_image']['name']!=""){		
        
        $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_banner WHERE bid='.$_GET['banner_id'].'');
        $img_res_row=mysqli_fetch_assoc($img_res);
        
        if($img_res_row['banner_image']!=""){
            unlink('images/'.$img_res_row['banner_image']);
        }
        
        $banner_image=rand(0,99999)."_".$_FILES['banner_image']['name'];
        
        //Main Image
        $tpath1='images/'.$banner_image; 			 
        $pic1=compress_image($_FILES["banner_image"]["tmp_name"], $tpath1, 80);
        
        $data = array(
            'banner_title'  =>  $_POST['banner_title'],
            'banner_sort_info'  =>  $_POST['banner_sort_info'],
            'banner_image'  =>  $banner_image,
            'banner_songs'  =>  implode(',',$_POST['banner_songs'])
        );
        
        $category_edit=Update('tbl_banner', $data, "WHERE bid = '".$_POST['banner_id']."'");
        
        }else{
        
        $data = array(
            'banner_title'  =>  $_POST['banner_title'],
            'banner_sort_info'  =>  $_POST['banner_sort_info'],
            'banner_songs'  =>  implode(',',$_POST['banner_songs'])
        );	
        
        $artist_edit=Update('tbl_banner', $data, "WHERE bid = '".$_POST['banner_id']."'");
        }
    
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header( "Location:add_banner.php?banner_id=".$_POST['banner_id']);
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
                        echo '<a href="manage_banners.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['banner_id'])){ ?>
                       <input  type="hidden" name="banner_id" value="<?php echo $_GET['banner_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Banner Title</label>
                                    <div class="col-xl-6 col-lg-9 col-sm-6">
                                        <input type="text" name="banner_title" id="banner_title" value="<?php if(isset($_GET['banner_id'])){echo $row['banner_title'];}?>" class="form-control">
                                    </div>
                                </div>
                                        
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Banner Sort Info</label>
                                    <div class="col-xl-6 col-lg-9 col-sm-6">
                                        <input type="text" name="banner_sort_info" id="banner_sort_info" value="<?php if(isset($_GET['banner_id'])){echo $row['banner_sort_info'];}?>" class="form-control">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Add</label>
                                    
                                         <div class="col-xl-6 col-lg-9 col-sm-6">
                                        
                                         <select name="banner_songs[]" id="banner_songs" class="form-control tagging" required multiple="multiple">
                                        <option value="">-- Select --</option>
                                        <?php while($mp3_row=mysqli_fetch_array($mp3_result)){ ?>   
                                                <?php if(isset($_GET['banner_id'])){?>
                                                   <option value="<?php echo $mp3_row['id'];?>" <?php $songs_list=explode(",", $row['banner_songs']);
                                                         foreach($songs_list as $song_id){
                                                         if($mp3_row['id']==$song_id){?>selected<?php }}?>><?php echo $mp3_row['mp3_title'];?>
                                                    </option>
                                                <?php }else{?>  
                                                  <option value="<?php echo $mp3_row['id'];?>"><?php echo $mp3_row['mp3_title'];?></option>
                                                <?php }?>   
                                             
                                        <?php } ?>
                                     </select>
                                    </div>
                                   
                                </div>
                                

                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Banner Image</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="banner_image" value="fileupload" accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <?php if(isset($_GET['banner_id']) AND file_exists('images/'.$row['banner_image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                              <img  class="col-sm-7" type="image" src="images/<?=$row['banner_image']?>"  alt="image" />
                                            </div>
                                        <?php }else{ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                              <img class="col-sm-7" type="image" src="assets/images/600x300.jpg" alt="image" />
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
