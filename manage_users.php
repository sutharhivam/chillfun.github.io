<?php
    $page_title="Manage Users";
    include("includes/header.php");
    include("includes/admin_check.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $tableName="tbl_users";   
	$targetpage = "manage_users.php"; 
	$limit = 15; 

	$keyword='';

	if(!isset($_GET['keyword'])){
		$query = "SELECT COUNT(*) as num FROM $tableName";
	}
	else{

		$keyword=addslashes(trim($_GET['keyword']));

		$query = "SELECT COUNT(*) as num FROM $tableName WHERE (`name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' OR `phone` LIKE '%$keyword%')";

		$targetpage = "manage_users.php?keyword=".$_GET['keyword'];

	}

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

	if(!isset($_GET['keyword'])){
		$sql_query="SELECT * FROM tbl_users ORDER BY tbl_users.`id` DESC LIMIT $start, $limit"; 
	}
	else{

		$sql_query="SELECT * FROM tbl_users WHERE (`name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' OR `phone` LIKE '%$keyword%') ORDER BY tbl_users.`id` DESC LIMIT $start, $limit"; 
	}

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
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="widget-content widget-content-area br-6">
                <div class=" mt-2">
                      <div class="row">
                        <div class="col-sm-8 m-auto p-auto"><h3 class="mr-1"><?=$page_title ?></h3></div>
                        <div class="col-sm-4 m-auto p-auto">
                            <div class="search_list m-auto p-auto">
                                
                                 <div class="add_btn_primary"> <a href="add_user.php?add">Add User</a> </div>
                            </div>
                        </div>
                      </div>
                    </div>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                
                <table class="table table-bordered table-hover">
                     <thead>
                            <tr>
                                <th class="checkbox-column dt-no-sorting sorting_asc">
                                    <label class="new-control new-checkbox checkbox-outline-info m-auto">
                                        <input type="checkbox" id="checkall_input" class="new-control-input chk-parent select-customers-info" >
                                    <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th class="text-center">Status</th>
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
                                
                                <th class="checkbox-column dt-no-sorting sorting_asc"  style="border: none; vertical-align: inherit; ">
                                    <label  class="new-control new-checkbox checkbox-outline-info m-auto">
                                        <input type="checkbox" class="post_ids new-control-input child-chk" name="post_ids[]" id="checkbox<?php echo $i; ?>" value="<?php echo $users_row['id']; ?>" style="margin: 0px;">
                                        <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                                    </label>
                                </th>
                                <td style="word-break: break-all;"><?php echo $users_row['name'];?></td>
                                <td style="word-break: break-all;"><?php echo $users_row['email']; ?></td>
                                <td style="word-break: break-all;"><?php echo $users_row['phone']; ?></td>
                                
                                <td class="text-center" >
                                    <?php if ($users_row['status'] != "0") { ?>
                                        <a title="Change Status" class="toggle_btn_a" href="javascript:void(0)" data-id="<?= $users_row['id'] ?>" data-action="deactive" data-column="status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Enable</span></span></a>
                                    <?php } else { ?>
                                        <a title="Change Status" class="toggle_btn_a" href="javascript:void(0)" data-id="<?= $users_row['id'] ?>" data-action="active" data-column="status"><span class="badge badge-danger badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Disable </span></span></a>
                                    <?php } ?>
                                </td>
                                
                                <td class="text-center">
                                    <a href="user_profile.php?user_id=<?php echo $users_row['id'];?>&redirect=<?=$redirectUrl?>" class="btn btn-success btn_cust bs-tooltip" data-placement="top" title="User Profile" style="padding: 5px 10px !important;">
                                        <i class="fa fa-history"></i>
                                    </a>
                                    <a href="add_user.php?user_id=<?php echo $users_row['id']; ?>&redirect=<?=$redirectUrl?>"class="btn btn-primary btn_delete bs-tooltip" data-placement="top" title="Edit" style="padding: 5px 10px !important;">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="<?php echo $users_row['id']; ?>" data-placement="top" title="Delete" class="btn btn-danger btn_delete btn_delete_a bs-tooltip" style="padding: 5px 10px !important;"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
    						$i++;
    						}
    		            ?>
    
                </tbody>
            
                   
                </table>
                
                <div class="btn-group mb-4 mr-2" role="group">
                    <button id="btndefault" type="button" style="padding: 5px 5px;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action </button>
                    <div class="dropdown-menu" aria-labelledby="btndefault">
                        <a href="" class="dropdown-item actions" data-action="enable"><i class="flaticon-home-fill-1 mr-1"></i>Enable</a>
                        <a href="" class="dropdown-item actions" data-action="disable"><i class="flaticon-gear-fill mr-1"></i>Disable</a>
                        <a href="" class="dropdown-item actions" data-action="delete"><i class="flaticon-bell-fill-2 mr-1"></i>Delete !</a>
                    </div>
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

<script>
    $(".toggle_btn_a").on("click", function(e) {
		e.preventDefault();

		var _for = $(this).data("action");
		var _id = $(this).data("id");
		var _column = $(this).data("column");
		var _table = 'tbl_users';

		$.ajax({
			type: 'post',
			url: 'processData.php',
			dataType: 'json',
			data: {
				id: _id,
				for_action: _for,
				column: _column,
				table: _table,
				'action': 'toggle_status',
				'tbl_id': 'id'
			},
			success: function(res) {
				console.log(res);
				if (res.status == '1') {
					location.reload();
				}
			}
		});

	});

	$(".btn_delete_a").on("click", function(e) {

		e.preventDefault();

		var _id = $(this).data("id");
		var _table = 'tbl_users';

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
    
    $(".actions").click(function(e) {
		e.preventDefault();

		var _ids = $.map($('.post_ids:checked'), function(c) {
			return c.value;
		});
		var _action = $(this).data("action");

		if (_ids != '') {
			swal({
				title: "Do you really want to perform?",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				closeOnConfirm: false,
				closeOnCancel: false,
				showLoaderOnConfirm: true
			}).then(function(result) {
                if (result.value) {

					var _table = 'tbl_users';

					$.ajax({
						type: 'post',
						url: 'processData.php',
						dataType: 'json',
						data: {
							id: _ids,
							for_action: _action,
							table: _table,
							'action': 'multi_action'
						},
						success: function(res) {
							console.log(res);
							$('.notifyjs-corner').empty();
							if (res.status == '1') {
								swal({
									title: "Successfully",
									text: "You have successfully done",
									type: "success"
								}).then(function(result) {
									location.reload();
								});
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
</script> 