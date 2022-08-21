<?php
    $page_title="Manage Mp3";
	include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    
    if(isset($_POST['data_search'])){
        $mp3_qry="SELECT * FROM tbl_mp3
        LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
        WHERE tbl_mp3.`mp3_title` like '%".addslashes($_POST['mp3_title'])."%'  
        ORDER BY tbl_mp3.mp3_title";
        
        $result=mysqli_query($mysqli,$mp3_qry);
    
    }else if(isset($_GET['f_category'])){
    
        $cat_id=trim($_GET['f_category']);
        $tableName="tbl_mp3";   
        $targetpage = "manage_mp3.php?f_category=".$cat_id; 
        $limit = 12; 
        
        $query = "SELECT COUNT(*) as num FROM $tableName WHERE cat_id='$cat_id'";
        $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
        $total_pages = $total_pages['num'];
        
        $stages = 3;
        $page=0;
        if(isset($_GET['page'])){
            $page = mysqli_real_escape_string($mysqli,$_GET['page']);
        }
        if($page){
            $start = ($page - 1) * $limit; 
        }else{
            $start = 0; 
        } 
        
        $sql_query = "SELECT tbl_mp3.*, tbl_category.`cid`, tbl_category.`category_name` 
        FROM tbl_mp3 LEFT JOIN tbl_category ON tbl_mp3.`cat_id` = tbl_category.`cid` 
        WHERE tbl_mp3.`cat_id` = '$cat_id' 
        ORDER BY tbl_mp3.`id` DESC LIMIT $start, $limit";
        
        $result=mysqli_query($mysqli,$sql_query); 
    
    }else{
    
        $tableName="tbl_mp3";   
        $targetpage = "manage_mp3.php"; 
        $limit = 12; 
        
        $query = "SELECT COUNT(*) as num FROM $tableName";
        $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
        $total_pages = $total_pages['num'];
        
        $stages = 3;
        $page=0;
        if(isset($_GET['page'])){
            $page = mysqli_real_escape_string($mysqli,$_GET['page']);
        }
        if($page){
            $start = ($page - 1) * $limit; 
        }else{
            $start = 0; 
        } 
        
        $sql_query = "SELECT tbl_mp3.`id`,tbl_mp3.`mp3_title`,tbl_mp3.`total_views`,tbl_mp3.`total_download`,tbl_mp3.`rate_avg`,tbl_mp3.`mp3_thumbnail`,tbl_mp3.`status`, tbl_category.`cid`, tbl_category.`category_name` 
        FROM tbl_mp3 LEFT JOIN tbl_category ON tbl_mp3.`cat_id` = tbl_category.`cid` 
        ORDER BY tbl_mp3.`id` DESC LIMIT $start, $limit";

        $result=mysqli_query($mysqli,$sql_query); 
    }
    
    function get_total_songs($cat_id){ 
        global $mysqli;   
        $qry_songs="SELECT COUNT(*) as num FROM tbl_mp3 WHERE cat_id='".$cat_id."'";
        $total_songs = mysqli_fetch_array(mysqli_query($mysqli,$qry_songs));
        $total_songs = $total_songs['num'];
        return $total_songs;
    } 

?>  

<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <div class=" mt-2">
                      <div class="row">
                        <div class="col-sm-8 m-auto p-auto"><h3 class="mr-1"><?=$page_title ?></h3></div>
                        <div class="col-sm-4 m-auto p-auto">
                            <div class="search_list m-auto p-auto">
                                    <div class="search_block">
                                    <form  method="post" action="">
                                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="mp3_title" value="<?php if(isset($_POST['data_search'])){ echo $_POST['mp3_title'];} ?>" required>
                                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                                    </form>  
                                </div>
                                <div class="add_btn_primary"> <a href="add_mp3.php">Add Mp3</a> </div>
                            </div>
                            
                        </div>
                    
                       
                      </div>
                    </div>
                    
                    
                    <div class=" mt-2">
                      <div class="row">
                        <div class="col-sm-8 m-auto p-auto">
                            <h4 style="float: left;">Filter: |</h4>
                                <div class="search_list" style="padding: 0px 0px 5px;float: left;margin-left: 20px">
                                <select name="f_category" class="form-control f_category" style="padding: 5px 10px;height: 40px;">
                                    <option value="">All Category</option>
                                    <?php
                                    $sql="SELECT * FROM tbl_category ORDER BY category_name";
                                    $res=mysqli_query($mysqli,$sql);
                                    while($row=mysqli_fetch_array($res))
                                    {
                                    ?>                       
                                    <option value="<?php echo $row['cid'];?>" <?php if(isset($_GET['f_category']) && $_GET['f_category']==$row['cid']){echo 'selected';} ?>><?php echo $row['category_name'],' ('.get_total_songs($row['cid']).')';?></option>                           
                                    <?php
                                    }
                                    // mysqli_free_result($row);
                                    ?>
                                </select>
                                </div>
                            
                        </div>
                        <div class="col-sm-4 m-auto p-auto">
                            <div class="search_list m-auto p-auto">
                                <div class="col-md-4 col-xs-12 text-right">
                                    
                                    <div class="checkbox " style="right: 50px;position: absolute; margin-top: 5px;	">
                                        <label class="new-control new-checkbox checkbox-outline-info new-checkbox-text m-auto">
                                            <input type="checkbox" id="checkall_input" class="new-control-input chk-parent select-customers-info" >
                                            <span class="new-control-indicator"></span><span class="new-chk-content"><B>Select</B></span>
                                        </label>
                                    </div>
                                    
                                    <div class="btn-group mb-4 mr-2" role="group">
                                        <button id="btndefault" type="button" style="padding: 5px 5px;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action </button>
                                        <div class="dropdown-menu" aria-labelledby="btndefault">
                                            <a href="javascript:void(0)" class="dropdown-item actions" data-action="enable"><i class="flaticon-bell-fill-2 mr-1"></i>Enable</a>
                                            <a href="javascript:void(0)" class="dropdown-item actions" data-action="disable"><i class="flaticon-bell-fill-2 mr-1"></i>Disable</a>
                                            <a href="javascript:void(0)" class="dropdown-item actions" data-action="delete"><i class="flaticon-bell-fill-2 mr-1"></i>Delete !</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      </div>
                    </div>
                
                

              
                
                
                <div style="border-bottom: 1px solid #f1f2f3; margin-bottom: 20px;"></div>
                <div class="row">
                    <?php 
                    $i=0;
                    while($row=mysqli_fetch_array($result))
                    {         
                    ?>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="block_wallpaper">     
                            <div class="wall_category_block" style="padding-right: 5px;">
                                <h2>
                                    <?php 
                                    if(strlen($row['category_name']) > 18){
                                        echo mb_substr(stripslashes($row['category_name']), 0, 17).'...';  
                                    }else{
                                        echo $row['category_name'];
                                    }
                                    ?>
                                </h2> 
                                
                                
                                 <div class="checkbox checkbox-column dt-no-sorting sorting_asc"  style="border: none; vertical-align: inherit; float: right;  position: relative; margin-top: 15px;">
                                    <label  class="new-control new-checkbox new-checkbox-text checkbox-success  m-auto">
                                        <input type="checkbox" class="post_ids new-control-input child-chk" name="post_ids[]" id="checkbox<?php echo $i; ?>" value="<?php echo $row['id']; ?>" style="margin: 0px;">
                                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                                    </label>
                                </div>
                                

                     
                                
                            </div>
                            <div class="wall_image_title">
                                
                                <h3 style="color: #ffffff; font-size: 1.30rem;">
                                    <b>
                                        <?php 
                                        if(strlen($row['mp3_title']) > 30){
                                            echo mb_substr(stripslashes($row['mp3_title']), 0, 29).'...';  
                                        }else{
                                            echo $row['mp3_title'];
                                        }
                                        ?>
                                    </b>
                                </h3>
                                <ul>                
                                    <li>
                                        <a href="edit_mp3.php?mp3_id=<?php echo $row['id'];?>" class=" bs-tooltip" target="_blank"  data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    </li>               
                                    <li>
                                        <a href="" class="btn_delete_a bs-tooltip" data-id="<?php echo $row['id'];?>" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </li>
                                    <?php if($row['status']!="0"){?>
                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="deactive" data-column="status" class=" bs-tooltip" data-placement="top"  title="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div></li>
                                    <?php }else{?>
                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="active" data-column="status" class=" bs-tooltip" data-placement="top"  title="ENABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div></li>
                                    <?php }?>
               
                                </ul>
                            </div>
                            <?php if($row['mp3_thumbnail'] == ""){?>
                                <span><img src="assets/images/300x300.jpg" /></span>
                            <?php }else{?>
                                <span><img src="images/<?php echo $row['mp3_thumbnail'];?>" /></span>
                            <?php }?>
                        </div>
                    </div>
                    <?php
                    $i++;
                    }
                    ?>     
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="paginating-container pagination-default">
                        <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
                    </div>
                </div>
            </div>
            <!----------------------------------------------------------------------------------------------------------------->
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>

<script type="text/javascript">

  $(".toggle_btn a").on("click",function(e){
    e.preventDefault();

    var _for=$(this).data("action");
    var _id=$(this).data("id");
    var _column=$(this).data("column");
    var _table='tbl_mp3';

    $.ajax({
      type:'post',
      url:'processData.php',
      dataType:'json',
      data:{id:_id,for_action:_for,column:_column,table:_table,'action':'toggle_status','tbl_id':'id'},
      success:function(res){
        console.log(res);
        if(res.status=='1'){
          location.reload();
        }
      }
    });

  });

 $(".btn_delete_a").on("click", function(e) {

    e.preventDefault();

    var _id = $(this).data("id");
    var _table = 'tbl_mp3';
    
    swal({
        title: "Are you sure to delete this?",
		type: "warning",
	    confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
		showCancelButton: true,
		confirmButtonText: "Yes",
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
    }).then(function(result) {
      if (result.value) {
          
         $.ajax({
          type: 'post',
          url: 'processData.php',
          dataType: 'json',
          data: {id: _id, for_action: 'delete', table: _table, 'action': 'multi_action'},
          success: function(res) {
            console.log(res);
            $('.notifyjs-corner').empty();
            if(res.status=='1'){
                swal({
                  title: 'Successfully',
                  text: "MP3 is deleted.",
                  type: 'success',
                }).then(function(result) {
                     location.reload();
                });
            }
            else if(res.status=='-2'){
                swal(res.message);
            }
          }
        });
      } else {
            swal.close();
      }
      
    });

});

$(".actions").on("click", function(e) {
    e.preventDefault();
    
    var _ids = $.map($('.post_ids:checked'), function(c) {
		return c.value;
	});
	var _action = $(this).data("action");
	
    if (_ids != '') {
        
    swal({
        title: "Do you really want to perform?",
		type: "warning",
	    confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
		showCancelButton: true,
		confirmButtonText: "Yes",
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
    }).then(function(result) {
      if (result.value) {
          
          var _table = 'tbl_mp3';
          
         $.ajax({
          type: 'post',
          url: 'processData.php',
          dataType: 'json',
          data: {id: _ids, for_action: _action, table: _table, 'action': 'multi_action'},
          success: function(res) {
            console.log(res);
            $('.notifyjs-corner').empty();
            if(res.status=='1'){
                swal({
                  title: 'Successfully',
                  text: "You have successfully Done",
                  type: 'success',
                }).then(function(result) {
                     location.reload();
                });
            }
            else if(res.status=='-2'){
                swal(res.message);
            }
          }
        });
      } else {
            swal.close();
      }
      
    });
        
    } else {
		swal("Sorry no users selected !!")
	}
});


var totalItems = 0;

	$("#checkall_input").click(function() {

		totalItems = 0;

		$('input:checkbox').not(this).prop('checked', this.checked);
		$.each($("input[name='post_ids[]']:checked"), function() {
			totalItems = totalItems + 1;
		});

		if ($('input:checkbox').prop("checked") == true) {
			$('.notifyjs-corner').empty();
			$.notify(
				'Total ' + totalItems + ' item checked', {
					position: "top center",
					className: 'success',
					clickToHide: false,
					autoHide: false
				}
			);
		} else if ($('input:checkbox').prop("checked") == false) {
			totalItems = 0;
			$('.notifyjs-corner').empty();
		}
	});

	$(".post_ids").click(function(e) {

		if ($(this).prop("checked") == true) {
			totalItems = totalItems + 1;
		} else if ($(this).prop("checked") == false) {
			totalItems = totalItems - 1;
		}

		if (totalItems == 0) {
			$('.notifyjs-corner').empty();
			exit();
		}

		$('.notifyjs-corner').empty();

		$.notify(
			'Total ' + totalItems + ' item checked', {
				position: "top center",
				className: 'success',
				clickToHide: false,
				autoHide: false
			}
		);
	});
	
	 $("select[name='f_category']").on("change",function(e){
    if($(this).val()!=''){
      window.location.href="manage_mp3.php?f_category="+$(this).val();
    }else{
      window.location.href="manage_mp3.php";
    }
  });

</script>  