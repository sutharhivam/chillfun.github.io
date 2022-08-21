<?php
    $page_title="Edit Mp3";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");;
    
    //Get Category
    $cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
    $cat_result=mysqli_query($mysqli,$cat_qry); 
    
    //Get Album
    $album_qry="SELECT * FROM tbl_album ORDER BY album_name";
    $album_result=mysqli_query($mysqli,$album_qry); 
    
    //Get Artist
    $art_qry="SELECT * FROM tbl_artist ORDER BY artist_name";
    $art_result=mysqli_query($mysqli,$art_qry); 
    
    $qry="SELECT * FROM tbl_mp3 where id='".$_GET['mp3_id']."'";
    $result=mysqli_query($mysqli,$qry);
    $row=mysqli_fetch_assoc($result);
    
    
    if(isset($_POST['submit'])){
        
        $mp3_type=trim($_POST['mp3_type']);
        
        if($mp3_type=='server_url'){
            $mp3_url=htmlentities(trim($_POST['mp3_url']));
            if($row['mp3_type']=='local'){
                unlink('uploads/'.basename($row['mp3_url']));
            }
        }
        else{
            $path = "uploads/"; //set your folder path
            
            if($_FILES['mp3_local']['name']!=""){
                
                unlink('uploads/'.basename($row['mp3_url']));
                
                $ext = pathinfo($_FILES['mp3_local']['name'], PATHINFO_EXTENSION);
                $mp3_local=rand(0,99999).$_POST['mp3_id']."_mp3.".$ext;
                $tmp = $_FILES['mp3_local']['tmp_name'];
                
                if (move_uploaded_file($tmp, $path.$mp3_local)) {
                    $mp3_url=$mp3_local;
                } else {
                    echo "Error in uploading mp3 file !!";
                    exit;
                }
            }
            else{
                $mp3_url=basename($row['mp3_url']);
            }
        }
        
        if($_FILES['mp3_thumbnail']['name']!=""){
        
            unlink('images/'.$row['mp3_thumbnail']);
            
            $ext = pathinfo($_FILES['mp3_thumbnail']['name'], PATHINFO_EXTENSION);
            $mp3_thumbnail=rand(0,99999)."_mp3_thumb.".$ext;
            $tpath1='images/'.$mp3_thumbnail;   
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["mp3_thumbnail"]["tmp_name"], $tpath1, 80);
            }
            else{
                $tmp = $_FILES['mp3_thumbnail']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
        }
        else{
            $mp3_thumbnail=$row['mp3_thumbnail'];
        }
        
        $data = array( 
            'cat_id'  =>  $_POST['cat_id'],
            'album_id'  =>  $_POST['album_id'],
            'mp3_title'  =>  $_POST['mp3_title'],
            'mp3_type'  =>  $_POST['mp3_type'],
            'mp3_url'  =>  $mp3_url,
            'mp3_thumbnail'  =>  $mp3_thumbnail,
            'mp3_duration'  =>  '-',
            'mp3_artist'  => implode(',', $_POST['mp3_artist']),
            'mp3_description'  =>  addslashes(trim($_POST['mp3_description']))
        );
        
        $qry=Update('tbl_mp3', $data, "WHERE id = '".$_POST['mp3_id']."'");
        
        $_SESSION['msg']="11"; 
        $_SESSION['class']="success"; 
        
        if(isset($_GET['redirect'])){
            header("Location:".$_GET['redirect']);
        }
        else{
            header( "Location:edit_mp3.php?mp3_id=".$_POST['mp3_id']);
        }
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
                        echo '<a href="manage_mp3.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="add_form" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['mp3_id'])){ ?>
                       <input  type="hidden" name="mp3_id" value="<?php echo $_GET['mp3_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Title</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="mp3_title" id="mp3_title" value="<?php echo $row['mp3_title']?>" class="form-control col-md-7" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Category :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <select name="cat_id" id="cat_id" class="form-control col-md-6 basic">
                                                <option value="">--Select Category--</option>
                                                <?php while($cat_row=mysqli_fetch_array($cat_result)){ ?>
                                                    <option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Album :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <select name="album_id" id="album_id" class="form-control col-md-6 basic">
                                                <option value="">--Select Album--</option>
                                                <?php while($album_row=mysqli_fetch_array($album_result)){ ?>
                                                    <option value="<?php echo $album_row['aid'];?>" <?php if($album_row['aid']==$row['album_id']){?>selected<?php }?>><?php echo $album_row['album_name'];?></option>   
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Artist :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <select name="mp3_artist[]" id="mp3_artist" class="form-control tagging" required multiple="multiple">
                                            <option value="">--Select Artist--</option>
                                             <?php while($art_row=mysqli_fetch_array($art_result)){ ?> 
                                                  <option value="<?php echo $art_row['artist_name'];?>" <?php if(in_array($art_row['artist_name'], explode(",",$row['mp3_artist']))){?>selected<?php }?>><?php echo $art_row['artist_name'];?></option>
                                            <?php }?>
                                         </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Upload From :-</label>
                                     <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="mp3_type" id="mp3_type"  class="form-control col-md-7 ">
                                            <option value="server_url" <?php if($row['mp3_type']=='server_url'){?>selected<?php }?>>From Server(URL)</option>
                                            <option value="local" <?php if($row['mp3_type']=='local'){?>selected<?php }?>>Browse From Device</option>
                                        </select>
                                    </div>
                                 </div>
                                 
                                 <div id="mp3_url_display" class="form-group row mb-4" <?php if($row['mp3_type']=='local'){?>style="display:none;"<?php }else{?><?php }?> >
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Song URL :-</label>
                                     <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="mp3_url" id="mp3_url" value="<?php echo $row['mp3_url']?>" class="form-control col-md-7">
                                        <div class="col-md-7" style=" border-radius: 5px; margin-top: 10px; background: rgb(0 0 0 / 33%); text-align: center;margin-bottom: 10px;padding: 1em">
                                            <audio controls src="<?php echo $row['mp3_url']?>"></audio>  
                                        </div>
                                    </div>
                                 </div>
                                 
                                 <div id="mp3_local_display" class="form-group row mb-4" <?php if($row['mp3_type']=='local'){?><?php }else{?>style="display:none;"<?php }?>>
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Song Upload :-</label>
                                     <div class="col-xl-10 col-lg-9 col-sm-10">
                                          <?php 
                                              $mp3_file=$row['mp3_url'];
                                              if($row['mp3_type']=='local'){
                                                  $mp3_file=$file_path.'uploads/'.basename($row['mp3_url']);
                                              } 
                                            ?>
                                        <input type="file" class="form-control-file" name="mp3_local" value=""  accept=".mp3" id="mp3_local">
                                        <p><strong>Current URL:</strong> <?=$mp3_file?></p>
                                        <div class="col-md-7" id="uploadPreview" style="display: none; border-radius: 5px; margin-top: 10px; background: rgb(0 0 0 / 33%); text-align: center;margin-bottom: 10px;padding: 1em">
                                            <audio id="audio" controls src="<?=$mp3_file?>"></audio>  
                                        </div>
                                    </div>
                                 </div>
                                
                                <div class="form-group row mb-4 ">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Song Description :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10 ">
                                        <div class="col-md-7" style="padding: 0;">
                                            <textarea name="mp3_description" id="mp3_description" class="form-control col-md-7"><?php echo stripslashes($row['mp3_description']);?></textarea>
                                            <script>CKEDITOR.replace( 'mp3_description' );</script>
                                        </div>
                                    </div>
                                </div>
   
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="mp3_thumbnail" value="fileupload" <?=(!isset($_GET['mp3_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <div class="fileupload_img" id="imagePreview">
                                            <?php 
                                                if($row['mp3_thumbnail']!='' AND file_exists('images/'.$row['mp3_thumbnail'])){
                                            ?>
                                            <img class="col-sm-3" type="image" src="images/<?=$row['mp3_thumbnail']?>" alt="image" />
                                            <?php }else{ ?>
                                            <img class="col-sm-3" type="image" src="assets/images/300x300.jpg" alt="image" />
                                            <?php } ?>
                                        </div>
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
<script src="assets/js/moment.min.js"></script>
<script>
$(".tagging").select2({
    tags: true
});
</script>
<script type="text/javascript">

  $(document).ready(function(e) {
    $("#mp3_type").change(function(){
      var type=$("#mp3_type").val();
      if(type=="server_url"){
          $("#mp3_url_display").show();
          $("#thumbnail").show();
          $("#mp3_local_display").hide();
          $("#mp3_local").val('');
          $("#audio").attr('src','');
      }
      else{
          $("#mp3_url_display").hide();               
          $("#mp3_local_display").show();
          $("#thumbnail").show();
      }
    });
  });

  var objectUrl;
  
  $("#mp3_local").change(function(e){
      var file = e.currentTarget.files[0];
     
      $("#filesize").text(file.size);
      
      objectUrl = URL.createObjectURL(file);
      $("#audio").prop("src", objectUrl);
      $("#uploadPreview").show();

  });
</script>