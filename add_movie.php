<?php
    $page_title=(isset($_GET['movie_id'])) ? 'Edit Movie' : 'Add Movie';
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	
	if(isset($_POST['submit']) and isset($_GET['add'])){
	    
	    $video_url = $_POST['video_url'];
	    
	    if($_FILES['video_image']['name']!="" and $_FILES["video_image"]["tmp_name"]!=""){
	        $image=rand(0,99999)."_".$_FILES['video_image']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["video_image"]["tmp_name"], $tpath1, 80);
	    }else{
	        $image = "";
	    }
	    
	    if($_FILES['video_image_thumb']['name']!="" and $_FILES["video_image_thumb"]["tmp_name"]!=""){
	        $imageThumb=rand(0,99999)."_".$_FILES['video_image_thumb']['name'];
            $tpath2='images/'.$imageThumb; 			 
            $pic2=compress_image($_FILES["video_image_thumb"]["tmp_name"], $tpath2, 80);
	    }else{
	        $imageThumb = "";
	    }
        
        $data = array( 
            'video_title'  =>  $_POST['video_title'],
            'video_description'  =>  addslashes($_POST['video_description']),
            'video_image'  =>  $image,
            'video_image_thumb'  =>  $imageThumb,
            'video_url'  =>  $video_url
        );	
            
        
        $qry = Insert('tbl_video_list',$data);	
        
        $_SESSION['msg']="10"; 
        $_SESSION['class']='success';
        header( "Location:add_movie.php?add=yes");
        exit;	
     
    }
    
    if(isset($_GET['movie_id'])){
    	$qry="SELECT * FROM tbl_video_list where id='".$_GET['movie_id']."'";
    	$result=mysqli_query($mysqli,$qry);
    	$row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['movie_id'])){
        
        $video_url = $_POST['video_url'];
        
        if($_FILES['video_image']['name']!="" and $_FILES["video_image"]["tmp_name"]!="" and $_FILES['video_image_thumb']['name']!="" and $_FILES["video_image_thumb"]["tmp_name"]!=""){		
        
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_video_list WHERE id='.$_GET['movie_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['video_image']!=""){
             unlink('images/'.$img_res_row['video_image']);
            }
            
            if($img_res_row['video_image_thumb']!=""){
             unlink('images/'.$img_res_row['video_image_thumb']);
            }
            
            $image=rand(0,99999)."_".$_FILES['video_image']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["video_image"]["tmp_name"], $tpath1, 80);
            
            $imageThumb=rand(0,99999)."_".$_FILES['video_image_thumb']['name'];
            $tpath2='images/'.$imageThumb; 			 
            $pic2=compress_image($_FILES["video_image_thumb"]["tmp_name"], $tpath2, 80);
            
            $data = array( 
                'video_title'  =>  $_POST['video_title'],
                'video_description'  =>  addslashes($_POST['video_description']),
                'video_image'  =>  $image,
                'video_image_thumb'  =>  $imageThumb,
                'video_url'  =>  $video_url
            );	
            
            $category_edit=Update('tbl_video_list', $data, "WHERE id = '".$_POST['movie_id']."'");
            
        } else if($_FILES['video_image']['name']!="" and $_FILES["video_image"]["tmp_name"]!="" ){
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_video_list WHERE id='.$_GET['movie_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['video_image']!=""){
             unlink('images/'.$img_res_row['video_image']);
            }
            
            $image=rand(0,99999)."_".$_FILES['video_image']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["video_image"]["tmp_name"], $tpath1, 80);
            
            $data = array( 
                'video_title'  =>  $_POST['video_title'],
                'video_description'  =>  addslashes($_POST['video_description']),
                'video_image'  =>  $image,
                'video_url'  =>  $video_url
            );	
            
            $category_edit=Update('tbl_video_list', $data, "WHERE id = '".$_POST['movie_id']."'");
            
        }else if($_FILES['video_image_thumb']['name']!="" and $_FILES["video_image_thumb"]["tmp_name"]!=""){
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_video_list WHERE id='.$_GET['movie_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['video_image_thumb']!=""){
             unlink('images/'.$img_res_row['video_image_thumb']);
            }
            
            $imageThumb=rand(0,99999)."_".$_FILES['video_image_thumb']['name'];
            $tpath2='images/'.$imageThumb; 			 
            $pic2=compress_image($_FILES["video_image_thumb"]["tmp_name"], $tpath2, 80);
        
            $data = array( 
                'video_title'  =>  $_POST['video_title'],
                'video_description'  =>  addslashes($_POST['video_description']),
                'video_image_thumb'  =>  $imageThumb,
                'video_url'  =>  $video_url
            );	
            
            $category_edit=Update('tbl_video_list', $data, "WHERE id = '".$_POST['movie_id']."'");
            
        }
        else{
            
            $data = array( 
                'video_title'  =>  $_POST['video_title'],
                'video_description'  =>  addslashes($_POST['video_description']),
                'video_url'  =>  $video_url,
            );	

            $category_edit=Update('tbl_video_list', $data, "WHERE id = '".$_POST['movie_id']."'");
        }
        
        $_SESSION['msg']="11"; 
        $_SESSION['class']='success';
        header( "Location:add_movie.php?movie_id=".$_POST['movie_id']);
        exit;
    }

?>

<Style>

.form-group label, label {
     padding-top: calc(.375rem + 1px);
    padding-bottom: calc(.375rem + 1px);
    font-size: inherit;
    color: #000000;
    letter-spacing: none;
    line-height: 1.5;
    font-weight: 500;
}
label.col-sm-3.col-form-label {
    font-weight: 500;
}
</Style>
<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
             <div class="row ml-1 mb-2">
                <?php 
                    if(isset($_GET['redirect'])){
                        echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    }else {
                        echo '<a href="manage_tv.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['movie_id'])){ ?>
                       <input  type="hidden" name="movie_id" value="<?php echo $_GET['movie_id'];?>" />                     
                    <?php }?>
                    
                    <div class="row">
                        
                        <div class="col-md-6">
                            <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">Movie Info</h4>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Title :-</label>
                                  <div class="col-sm-8">
                                        <input type="text" name="video_title" id="video_title" value="<?php if(isset($_GET['movie_id'])){echo $row['video_title'];}?>" class="form-control" required>
                                  </div>
                            </div>
                              
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                  <div class="col-sm-8">
                                        <textarea name="video_description" id="video_description" class="form-control">
                                            <?php if(isset($_GET['movie_id'])){ ?>
                                                <?php echo stripslashes($row['video_description']);?>
                                            <?php } ?>
                                        </textarea>
                                        <script>CKEDITOR.replace( 'video_description' );</script>
                                  </div>
                            </div>
                              
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trailer<small id="emailHelp" class="form-text text-muted"></small></label>
                                 <div class="col-sm-8 mb-2">
                                  <input type="text" name="video_url" value="<?php if(isset($_GET['movie_id'])){echo $row['video_url'];}?>" class="form-control" >
                                  <p><small id="emailHelp" class="form-text text-muted">Supported Youtube Regular URL </small></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6"> 
                        
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Movie Thumbnail* <small id="emailHelp" class="form-text text-muted">(Recommended resolution : 270X390)</small></label>
                                  <div class="col-sm-8">
                                         <input type="file" class="form-control-file" name="video_image" value="fileupload" <?=(!isset($_GET['movie_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                  </div>
                              </div>
                              
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                  <div class="col-sm-8">
                                        <?php if(isset($_GET['movie_id']) AND file_exists('images/'.$row['video_image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img src="images/<?=$row['video_image']?>" alt="video thumb" class="img-thumbnail" style="width: 270px; height: 390px;">
                                            </div>
                                        <?php }else{ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                 <img src="assets/images/350x250.jpg" alt="video thumb" class="img-thumbnail"style="width: 270px; height: 390px;">
                                            </div>
                                        <?php } ?>
                                  </div>
                              </div>
                              
                              
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Movie Poster <small id="emailHelp" class="form-text text-muted">(Recommended resolution : 600x300)</small></small></label>
                                  <div class="col-sm-8">
                                         <input type="file" class="form-control-file" name="video_image_thumb" value="fileupload2" <?=(!isset($_GET['movie_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation2()" id="fileupload2">
                                  </div>
                              </div>
                              
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                  <div class="col-sm-8">
                                        <?php if(isset($_GET['movie_id']) AND file_exists('images/'.$row['video_image_thumb'])){ ?>
                                            <div class="fileupload_img" id="imagePreview2">
                                                <img src="images/<?=$row['video_image_thumb']?>" alt="video thumb" class="img-thumbnail" style="width: 600px; height: 300px;">
                                            </div>
                                        <?php }else{ ?>
                                            <div class="fileupload_img" id="imagePreview2">
                                                 <img src="assets/images/600x300.jpg" alt="video thumb" class="img-thumbnail" style="width: 600px; height: 300px;">
                                            </div>
                                        <?php } ?>
                                  </div>
                              </div>
                              
                        </div>

    
                        <div class="col-md-11">
                            <div class="platform-div">
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

 <script type="text/javascript">
    function fileValidation2(){
        var fileInput = document.getElementById('fileupload2');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.png|.jpg|.jpeg|.PNG|.JPG|.JPEG)$/i;
        if(!allowedExtensions.exec(filePath)){
            if(filePath!='')
                swal({
                    type: 'error',
                    title: 'Please upload file having extension',
                    text: '.png, .jpg, .jpeg .PNG, .JPG, .JPEG only.',
                    footer: '<a href>Why do I have this issue?</a>',
                    padding: '2em'
                }).then(function(result) {
                     fileInput.value = '';
                });
            return false;
        }else{
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview2').innerHTML = '<img src="'+e.target.result+'" class="img-thumbnail" />';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script>