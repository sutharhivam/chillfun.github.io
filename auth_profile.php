<?php
    $page_title="User Profile";
    include("includes/header.php");
    require("includes/lb_helper.php");
	require("language/language.php");
	
	if(isset($_SESSION['id'])){
		$qry="select * from tbl_admin where id='".$_SESSION['id']."'";
		$result=mysqli_query($mysqli,$qry);
		$row=mysqli_fetch_assoc($result);
	}
	
	if(isset($_POST['submit'])){
		if($_FILES['image']['name']!=""){		
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_SESSION['id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['image']!=""){
                unlink('images/'.$img_res_row['image']);
            }
            
            $image="profile.png";
            $pic1=$_FILES['image']['tmp_name'];
            $tpath1='images/'.$image;
            
            copy($pic1,$tpath1);
            
            $data = array( 
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email'],
                'image'  =>  $image
            );
            
            $channel_edit=Update('tbl_admin', $data, "WHERE id = '".$_SESSION['id']."'"); 
        }else{
            $data = array( 
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email'] 
            );
            
            $channel_edit=Update('tbl_admin', $data, "WHERE id = '".$_SESSION['id']."'"); 
		}
		$_SESSION['msg']="11"; 
		header( "Location:auth_profile.php");
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
                    <?php if(isset($_GET['user_id'])){ ?>
                       <input  type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="username" id="username" value="<?php echo $row['username'];?>" class="form-control col-md-7" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="password" name="password" id="password" value="<?php echo $row['password'];?>" class="form-control col-md-7" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="email" id="email" value="<?php echo $row['email'];?>"  class="form-control col-md-7" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="image" value="fileupload" <?=(!isset($_GET['user_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                     </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <?php if(file_exists('images/'.$row['image'])){ ?>
                                            <div class="fileupload_img" id="imagePreview">
                                                <img  class="col-sm-3" type="image" src="images/<?=$row['image']?>"  alt="image" />
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
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>