<?php
    $page_title="Manage Admin";
    include("includes/header.php");
    include("includes/admin_check.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $tableName="tbl_admin";   
	$targetpage = "manage_admin.php"; 
	$limit = 15; 

	$keyword='';

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

	$sql_query="SELECT * FROM tbl_admin ORDER BY tbl_admin.`id` DESC LIMIT $start, $limit"; 
	$result=mysqli_query($mysqli,$sql_query) or die(mysqli_error($mysqli));

?>    
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

</Style>

<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class=" mt-2">
                      <div class="row">
                        <div class="col-sm-8 m-auto p-auto"><h3 class="mr-1"><?=$page_title ?></h3></div>
                        <div class="col-sm-4 m-auto p-auto">
                            <div class="search_list m-auto p-auto">
                                
                                 <div class="add_btn_primary"> <a href="admin_user.php?add">Add User</a> </div>
                            </div>
                        </div>
                      </div>
                    </div>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Permission</th>
                            <th class="text-center dt-no-sorting">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        while($users_row=mysqli_fetch_array($result))
                        {
                        ?>
                        <tr>
                            <td>
                                <?php if(file_exists('images/'.$users_row['image'])){ ?>
                                    <img alt="avatar" src="images/<?=$users_row['image']?>" class="rounded-circle  bs-tooltip" style="height: 65px;width: 65px; border: 1px solid #dadce0;" data-original-title="<?php echo $users_row['username'];?>" />
                                <?php }else{ ?>
                                    <img alt="avatar" src="assets/images/90x90.jpg" class="rounded-circle  bs-tooltip " style="height: 65px;width: 65px; border: 1px solid #dadce0;"  data-original-title="<?php echo $users_row['username'];?>" />
                                <?php } ?>
                            </td>
                            <td style="word-break: break-all;"><?php echo $users_row['username'];?></td>
                            <td style="word-break: break-all;"><?php echo $users_row['email']; ?></td>
                            <td >
                                <?php if ($users_row['id'] == "1") { ?>
                                    <div class="text-center"><h6>Admin</h6></div>
                                <?php } else { ?>
                                    <?php if ($users_row['user_status'] == "1") { ?>
                                        <div class="text-center"><h6>Lite Admin</h6></div>
                                    <?php } else { ?>
                                        <div class="text-center"><h6>Editor</h6></div>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td  class="text-center">
                                <a href="admin_user.php?user_id=<?php echo $users_row['id']; ?>"class="btn btn-primary btn_delete bs-tooltip" data-placement="top" title="Edit" style="padding: 5px 10px !important;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php if ($users_row['id'] == "1") { ?>
                                    <a   class="btn btn-dark   disabled" style="padding: 5px 10px !important;"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" data-id="<?php echo $users_row['id']; ?>" data-placement="top" title="Delete" class="btn btn-danger btn_delete btn_delete_a bs-tooltip" style="padding: 5px 10px !important;"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } ?>
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

<script>
	$(".btn_delete_a").on("click", function(e) {

		e.preventDefault();

		var _id = $(this).data("id");
		var _table = 'tbl_admin';

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
		                        title: "Successfully", 
		                        text: "User is deleted.", 
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