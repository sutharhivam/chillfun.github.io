<?php
    $page_title=(isset($_GET['user_id'])) ? 'Edit User' : 'Add User';
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	if(isset($_POST['submit']) and isset($_GET['add'])){		
    
        $data = array(
                  'user_type'=>'Normal',											 
                  'name'  => addslashes(trim($_POST['name'])),				    
                  'email'  =>  addslashes(trim($_POST['email'])),
                  'password'  =>  md5(trim($get_method['password'])),
                  'phone'  =>  addslashes(trim($_POST['phone'])),
                  'registered_on'  =>  strtotime(date('d-m-Y h:i:s A')),
                  'status'  =>  '1'
        );		
            
        $qry = Insert('tbl_users',$data);
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header("location:manage_users.php");	 
        exit;
    }
    
    if(isset($_GET['user_id'])){
        $user_qry="SELECT * FROM tbl_users where id='".$_GET['user_id']."'";
        $user_result=mysqli_query($mysqli,$user_qry);
        $user_row=mysqli_fetch_assoc($user_result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['user_id'])){
        if($_POST['password']!=""){
            $data = array(
                  'name'  => addslashes(trim($_POST['name'])),				    
                  'email'  =>  addslashes(trim($_POST['email'])),
                  'password'  =>  md5(trim($get_method['password'])),
                  'phone'  =>  addslashes(trim($_POST['phone']))
            );
        }else{
            $data = array(
                'name'  => addslashes(trim($_POST['name'])),				    
                'email'  =>  addslashes(trim($_POST['email'])),
                'phone'  =>  addslashes(trim($_POST['phone']))
            );
        }
        
        $user_edit=Update('tbl_users', $data, "WHERE id = '".$_POST['user_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header("Location:add_user.php?user_id=".$_POST['user_id']);
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
                        echo '<a href="manage_users.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <form action="" name="addedituser" method="post" class="form form-horizontal" enctype="multipart/form-data" >
                    <?php if(isset($_GET['quiz_id'])){ ?>
                       <input  type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>" />           
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="name" id="name" value="<?php if(isset($_GET['user_id'])){echo $user_row['name'];}?>" class="form-control col-md-7" required>
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Phone :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="phone" id="phone" value="<?php if(isset($_GET['user_id'])){echo $user_row['phone'];}?>" class="form-control col-md-7">
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
