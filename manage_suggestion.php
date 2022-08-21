<?php
    $page_title="Songs Suggestion";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
  
    function get_user_info($user_id){
        global $mysqli;
        $user_qry="SELECT * FROM tbl_users where id='".$user_id."'";
        $user_result=mysqli_query($mysqli,$user_qry);
        $user_row=mysqli_fetch_assoc($user_result);
        return $user_row;
    }
    
    // Get page data
    $tableName="tbl_song_suggest";    
    $targetpage = "manage_suggestion.php";  
    $limit = 15; 
    
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

    $qry="SELECT * FROM tbl_song_suggest ORDER BY tbl_song_suggest.id DESC LIMIT $start, $limit";   
    $result=mysqli_query($mysqli,$qry);
?>

<link href="assets/css/stylish-tooltip.css" rel="stylesheet" type="text/css" />
<link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    
<Style>
    .table > tbody tr {
        border: 1px solid #83c3f95e;
    }
    
    .table > tbody > tr > td {
        border: 1px solid #83c3f95e;
    }
    
    .table > thead tr {
        border: 1px solid #83c3f95e;
    }
    .tooltip-content img {
        position: relative;
        height: 200px;
        display: block;
        float: left;
        border-radius: 5px;
    }
</Style>
    
<div id="content" class="main-content">
           <div class="layout-px-spacing">
        <div class="row layout-spacing mt-3">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area">
                                <div class="row">
                                <div class="col-6"><h3 class=""><?=$page_title ?></h3></div>
                              </div>
                                
                            <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                                
                               <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Song Title</th>
                                        <th>Image</th> 
                                        <th>Message</th>
                                        <th class="text-center dt-no-sorting">Actions</th>
                                    </tr>
                        
                                </thead>
                                <tbody>
                                <?php
      						    $i=0;
      						    while($row=mysqli_fetch_array($result))
      						    {
				            ?>
                                <tr role="row">
                                    <td width="50"><?=$i++?></td>
                                    <td style="word-wrap: break-all;"><?php echo get_user_info($row['user_id'])['name'];?></td>
                                    <td style="word-wrap: break-all;"><?php echo $row['song_title'];?></td>
                                    <td nowrap="">
                                    <?php 
                                    if(file_exists('images/'.$row['song_image'])){
                                      ?>
                                      <span class="mytooltip tooltip-effect-3">
                                        <span class="tooltip-item">
                                          <img src="images/<?php echo $row['song_image'];?>" alt="no image" style="width: 100px;height: auto;max-height: 100px;border-radius: 5px">
                                        </span> 
                                        <span class="tooltip-content clearfix">
                                          <a href="images/<?php echo $row['song_image'];?>" target="_blank"><img src="images/<?php echo $row['song_image'];?>" alt="no image" /></a>
                                        </span>
                                      </span>
                                    <?php }else{
                                      ?>
                                      <img src="" alt="no image" style="width: 100px;height: auto;border-radius: 5px">
                                      <?php
                                    } ?>
                                  </td>
                                  <td style="word-wrap: break-all;"><?php echo $row['message'];?></td> 
             
                                    
                                    <td class="text-center">
                                          <a href="" data-id="<?php echo $row['id'];?>"  data-placement="top"  title="Delete" class="btn btn-danger btn_delete btn_delete_a bs-tooltip my" style="padding: 5px 10px !important;">
                                            <i class="fa fa-trash" style="font-size: 13px;"></i>
                                          </a>
                                    </td>
                                </tr>
                            <?php
        						$i++;
        						}
    			            ?>

                            </tbody>
                        
                               
                            </table>

                            <div class="col-md-12 col-xs-12">
                                <div class="paginating-container pagination-default">
                                        <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
        
    </div>
<?php include("includes/footer.php");?>
 
<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $(".btn_delete_a").on("click", function(e) {

		e.preventDefault();

        var _ids=$(this).data("id");
        var _table='tbl_song_suggest';

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
					data:{id:_ids,'action':'multi_delete','tbl_nm':_table},
					success: function(res) {
						console.log(res);
						$('.notifyjs-corner').empty();
						if(res.status=='1'){
		                    swal({
		                        title: "Successfully", 
		                        text: "Song Suggest is deleted.", 
		                        type: "success"
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

</script>