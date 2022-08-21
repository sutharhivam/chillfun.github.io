<?php
    $page_title=(isset($_GET['user_id'])) ? 'Edit User' : 'Add User';
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	if(isset($_POST['submit']) and isset($_GET['add'])){		
    
        if($_FILES['image_user']['name']!=""){		
            
            $image=rand(0,99999)."_".$_FILES['image_user']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["image_user"]["tmp_name"], $tpath1, 80);
        
            $data = array( 
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email'],
                'image'  =>  $image
            );
            
            $qry = Insert('tbl_admin',$data);	
		 }else{
            $data = array( 
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email'] 
            );
            
            $qry = Insert('tbl_admin',$data);
		}
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header("location:manage_admin.php");	 
        exit;
    }
    
    if(isset($_GET['user_id'])){
        $user_qry="SELECT * FROM tbl_admin where id='".$_GET['user_id']."'";
        $user_result=mysqli_query($mysqli,$user_qry);
        $user_row=mysqli_fetch_assoc($user_result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['user_id'])){

        if($_GET['user_id']=="1"){
            
            if($_FILES['image_user']['name']!="" AND $_POST['password']!=""){	
            
                $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_GET['user_id'].'');
                $img_res_row=mysqli_fetch_assoc($img_res);
                
                if($img_res_row['image']!=""){
                    unlink('images/'.$img_res_row['image']);
                }
                $image=rand(0,99999)."_".$_FILES['image_user']['name'];
                $tpath1='images/'.$image; 			 
                $pic1=compress_image($_FILES["image_user"]["tmp_name"], $tpath1, 80);
                
                $data = array(
                    'username'  =>  $_POST['username'],
                    'password'  =>  $_POST['password'],
                    'email'  =>  $_POST['email'],
                    'image'  =>  $image
                );
                
                $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
                
            }
            else if($_FILES['image_user']['name']!=""){	
            
                $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_GET['user_id'].'');
                $img_res_row=mysqli_fetch_assoc($img_res);
                
                if($img_res_row['image']!=""){
                    unlink('images/'.$img_res_row['image']);
                }
                
                $image=rand(0,99999)."_".$_FILES['image_user']['name'];
                $tpath1='images/'.$image; 			 
                $pic1=compress_image($_FILES["image_user"]["tmp_name"], $tpath1, 80);
                
                $data = array(
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email'],
                    'image'  =>  $image
                );
                
                $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
         
            }
            else if($_POST['password']!=""){
                $data = array(
                    'username'  =>  $_POST['username'],
                    'password'  =>  $_POST['password'],
                    'email'  =>  $_POST['email']
                );
            
                $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
            }
            else{
                $data = array(
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email'],
                );
            
                $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
            }
        }
        else if($_FILES['image_user']['name']!="" AND $_POST['password']!=""){	
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_GET['user_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['image']!=""){
                unlink('images/'.$img_res_row['image']);
            }
            $image=rand(0,99999)."_".$_FILES['image_user']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["image_user"]["tmp_name"], $tpath1, 80);
            
            $data = array(
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email'],
                'image'  =>  $image
            );
            
            $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
        }
        else if($_FILES['image_user']['name']!=""){	
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_GET['user_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['image']!=""){
                unlink('images/'.$img_res_row['image']);
            }
            
            $image=rand(0,99999)."_".$_FILES['image_user']['name'];
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["image_user"]["tmp_name"], $tpath1, 80);
            
            $data = array(
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'email'  =>  $_POST['email'],
                'image'  =>  $image
            );
            
            $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
            
        }
        else if($_POST['password']!=""){
            $data = array(
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'password'  =>  $_POST['password'],
                'email'  =>  $_POST['email']
            );
            
            $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
        }
        else{
            $data = array(
                'user_status'  =>  $_POST['user_status'],
                'username'  =>  $_POST['username'],
                'email'  =>  $_POST['email'],
            );
            
            $user_edit=Update('tbl_admin', $data, "WHERE id = '".$_POST['user_id']."'");
        }
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header("Location:admin_user.php?user_id=".$_POST['user_id']);
        exit;
    }
?>
<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                           <div class="row ml-1 mb-2">
                            <?php
                                if(isset($_GET['redirect'])){
                                    echo '<a href="'.$_GET['redirect'].'" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                                }  
                                else{
                                    echo '<a href="manage_admin.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                                }
                            ?>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6">
                                    <form action="" name="addedituser" method="post" class="form form-horizontal" enctype="multipart/form-data" >
                                        <?php if(isset($_GET['user_id'])){ ?>
                                           <input  type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>" />         
                                        <?php }?>
                                            <h5 class=""><?=$page_title ?></h5>
                                            <div style="border-bottom: 1px solid #f1f2f3;  margin-bottom: 20px;"></div>
                                            <div class="row">
                                            
                                                <div class="col-md-11">
                                                    <div class="platform-div">
                                                        <div class="form-group row mb-4"
                                                        <?php if(isset($_GET['user_id'])){ ?>
                                                        	<?php if($user_row['id']=='1'){?>style="display:none;"<?php }else{?>style=";"<?php }?> 
                                                        <?php } ?>>
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Type</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <div class="col-md-7" style="padding: 0;">
                                                                    <select name="user_status" id="user_status" class="form-control" required>  
                                                                    <?php if(isset($_GET['quiz_id'])){ ?>
                                                                    	<option value="0" <?php if($row['user_status']=='0'){?>selected<?php }?>>Editor</option>
                                                                        <option value="1" <?php if($row['user_status']=='1'){?>selected<?php }?>>Lite Admin</option>
                                                                    <?php }else{ ?>
                                                                    	<option value="0">Editor</option>
                                                                        <option value="1">Lite Admin</option>
                                                                    <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-4">
                                                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name :-</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="text" name="username" id="username" value="<?php if(isset($_GET['user_id'])){echo $user_row['username'];}?>" class="form-control col-md-7" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email :-</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="email" name="email" id="email" value="<?php if(isset($_GET['user_id'])){echo $user_row['email'];}?>"  class="form-control col-md-7" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password :-</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="password" name="password" id="password" value="" class="form-control col-md-7" <?php if(!isset($_GET['user_id'])){?>required<?php }?>>
                                                            </div>
                                                        </div>

                                                         <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Select Image</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <input type="file" class="form-control-file" name="image_user" value="fileupload" <?=(!isset($_GET['user_id'])) ? 'required="required"' : '' ?>  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                                             </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group row mb-4">
                                                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">&nbsp;</label>
                                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                                <?php if(isset($_GET['user_id']) AND file_exists('images/'.$user_row['image'])){ ?>
                                                                    <div class="fileupload_img" id="imagePreview">
                                                                      <img  class="col-sm-3" type="image" src="images/<?= $user_row['image']?>"  alt="image" />
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
                    </div>
                </div>
            </div>
            
<?php include("includes/footer.php");?>