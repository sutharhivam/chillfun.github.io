<?php
    $page_title=(isset($_GET['user_id'])) ? 'Edit User' : 'Add User';
    include("includes/header.php");
    include("includes/admin_check.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$user_id=strip_tags(addslashes(trim($_GET['user_id'])));

	if(!isset($_GET['user_id']) OR $user_id==''){
		header("Location: manage_users.php");
	}

    $user_qry="SELECT * FROM tbl_users WHERE id='$user_id'";
    $user_result=mysqli_query($mysqli,$user_qry);
    
    $sql = "SELECT tbl_mp3.`id`,tbl_mp3.`mp3_title`,tbl_mp3.`total_views`,tbl_mp3.`total_download`,tbl_mp3.`rate_avg`,tbl_mp3.`mp3_thumbnail`,tbl_mp3.`status`, tbl_category.`cid`, tbl_category.`category_name` 
    FROM tbl_mp3 
    LEFT JOIN tbl_favourite ON tbl_mp3.`id` = tbl_favourite.`post_id`
    LEFT JOIN tbl_category ON tbl_mp3.`cat_id` = tbl_category.`cid` 
    WHERE `tbl_favourite`.`user_id`='$user_id' ORDER BY tbl_mp3.`id` DESC";
        

    if(mysqli_num_rows($user_result)==0){
    	header("Location: manage_users.php");
    }

    $user_row=mysqli_fetch_assoc($user_result);

	$user_img='assets/images/user-icons.jpg';

	function getLastActiveLog($user_id){
    	global $mysqli;

    	$sql="SELECT * FROM tbl_active_log WHERE `user_id`='$user_id'";
        $res=mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($res) == 0){
        	echo 'no available';
        }
        else{
        	$row=mysqli_fetch_assoc($res);
			return calculate_time_span($row['date_time'],true);	
        }
    }

?>
<link href="assets/css/stylish-tooltip.css" rel="stylesheet" type="text/css" />
<link href="assets/css/user-profile.css" rel="stylesheet" type="text/css" />
<div id="content" class="main-content">

    <div class="layout-px-spacing">
            <div class="row ayout-spacing mt-3 ml-2">
                           <?php
                    			if(isset($_GET['redirect'])){
                    	          echo '<a href="'.$_GET['redirect'].'"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
                    	        }
                    	        else{
                    	         	echo '<a href="manage_users.php"><h4 class="pull-left" style="font-size: 20px;color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4></a>';
                    	        }
                    		?>
                            </div>
        
<div class="row layout-spacing">

                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Profile</h3>
                                    <a class="mt-2 edit-profile"> </a>
                                </div>
                                <div class="text-center user-info">
                                    <img style="width: 100px;height: 100px;" src="<?php echo $user_img;?>" alt="avatar">
                                    <p class=""><?php echo $user_row['name'];?></p>
                                </div>
                                <div class="user-info-list">
                                    <div class="">
                                        <ul class="contacts-block list-unstyled">

                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                <?php echo date('d-m-Y',$user_row['registered_on']);?>
                                            </li>

                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                <?=$user_row['email']?></a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                <?=$user_row['phone']?>
                                            </li>
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                        <div class="skills layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Notifications</h3>
                                   <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4"
                                role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    <strong>Registered At:</strong> <?php echo date('d-m-Y',$user_row['registered_on']);?>
                                </div>
                                <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4"
                                role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    <strong>Last Activity On:</strong> <?php echo getLastActiveLog($user_id)?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="skills layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Favourite Radio</h3>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">Sr.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                        //     	$sql="SELECT * FROM tbl_mp3
                                    		  //  LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid 
                                    		  //  LEFT JOIN tbl_favorite ON tbl_mp3.`id` = tbl_favorite.`post_id`
                                    		  //  WHERE tbl_favorite.`type`='radio' AND tbl_mp3.status='1' AND tbl_category.`status`='1' AND tbl_favorite.`user_id`='$user_id' ORDER BY tbl_mp3.id DESC ";
                                            
                                            
                                                
                                                $res=mysqli_query($mysqli, $sql);
                                                $no=1;
                                                while ($row=mysqli_fetch_assoc($res)) {
                                            ?>
                                            <tr>
                                                <td style="width: 50px"><?=$no;?></td>
                                                <td nowrap="">
                                                    <?php 
                                                        if(file_exists('images/'.$row['mp3_thumbnail'])){
                                                    ?>
                                                    <span class="mytooltip tooltip-effect-3">
                                                        <span class="tooltip-item">
                                                            <img src="images/<?php echo $row['mp3_thumbnail'];?>" alt="no image" style="width: 50px;height: 50px;border-radius: 5px">
                                                        </span> 
                                                        <span class="tooltip-content clearfix">
                                                            <a href="images/<?php echo $row['mp3_thumbnail'];?>" target="_blank"><img src="images/<?php echo $row['mp3_thumbnail'];?>" alt="no image" style="width: auto;height: 180px;"/></a>
                                                        </span>
                                                    </span>
                                                    <?php }else{
                                                    ?>
                                                        <img src="" alt="no image" style="width: 50px;height: 60px;border-radius: 5px">
                                                    <?php
                                                    } ?>
                                                </td>
                                                <td style="width: 350px" title="<?=$row['mp3_title']?>">
                                                    <?php
                                                        if(strlen($row['mp3_title']) > 40){
                                                        echo substr(stripslashes($row['mp3_title']), 0, 40).'...';  
                                                    }else{
                                                        echo $row['mp3_title'];
                                                    }
                                                    ?>
                                                </td>
                                                <td nowrap=""><?=calculate_time_span($row['created_at'],true);?></td>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            mysqli_free_result($res);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    
                    

                </div>
    </div>
            
<?php include("includes/footer.php");?>
