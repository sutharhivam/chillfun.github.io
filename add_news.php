<?php
    $page_title=(isset($_GET['news_id'])) ? 'Edit News' : 'Add News';
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	if(isset($_POST['submit']) and isset($_GET['add'])){

        $data = array( 
            'title'  =>  $_POST['title'],
            'url'  =>  $_POST['url']
        );    
        
        $qry = Insert('tbl_news',$data);  
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_news.php");
        exit; 
    }
    
    if(isset($_GET['news_id'])){
        $qry="SELECT * FROM tbl_news where id='".$_GET['news_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['news_id'])){
        
        $data = array(
            'title'  =>  $_POST['title'],
            'url'  =>  $_POST['url']
        );  
        
        $category_edit=Update('tbl_news', $data, "WHERE id = '".$_POST['news_id']."'");
    
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header( "Location:add_news.php?news_id=".$_POST['news_id']);
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
                        echo '<a href="manage_news.php" class="btn_back"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back</h4></a>';
                    } 
                ?>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <!----------------------------------------------------------------------------------------------------------------->
                <form id="work-platforms" name="addeditcategory" method="post"  enctype="multipart/form-data">
                    <?php if(isset($_GET['news_id'])){ ?>
                       <input  type="hidden" name="news_id" value="<?php echo $_GET['news_id'];?>" />                     
                    <?php }?>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="platform-div">
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="title" value="<?php if(isset($_GET['news_id'])){echo $row['title'];}?>" class="form-control col-md-7">
                                    </div>
                                </div>
                                
                                 <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">URL :-</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="url" value="<?php if(isset($_GET['news_id'])){echo $row['url'];}?>" class="form-control col-md-7">
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
