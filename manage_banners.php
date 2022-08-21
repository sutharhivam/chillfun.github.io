<?php
/**
 * Company : Nemosofts
 * Detailed : Software Development Company in Sri Lanka
 * Developer : Thivakaran
 * Contact : thivakaran829@gmail.com
 * Contact : nemosofts@gmail.com
 * Website : https://nemosofts.com
 */
    $page_title="Manage Promos";
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	date_default_timezone_set("Asia/Colombo");
    
    $tableName="tbl_banner";   
    $targetpage = "manage_banners.php"; 
    $limit = 6; 
    
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
    
    $data_qry="SELECT * FROM tbl_banner ORDER BY tbl_banner.bid DESC LIMIT $start, $limit";
    
    $result=mysqli_query($mysqli,$data_qry); 
?>
<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6">
                                             <div class="row">
                                                <div class="col-6"><h3 class=""><?=$page_title ?></h3></div>
                                                <div class="col-6 text-right">
                                                    <div class="search_list">
                                                         <div class="add_btn_primary"> <a href="add_banner.php?add=yes">Add Banner</a> </div>
                                                    </div>
                                                </div>
                                              </div>
                                              <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>

                                            <div class="row">
                                                
                                                <?php 
                                                        $i=0;
                                                        while($row=mysqli_fetch_array($result))
                                                        {         
                                                        ?>
                                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="block_wallpaper">           
                                                                <div class="wall_image_title">
                                                                    <h3 style="color: #ffffff; font-size: 1.30rem;"><?php echo $row['banner_title'];?></3>
                                                                    <ul>    
                                                                        <li>
                                                                            <a href="add_banner.php?banner_id=<?php echo $row['bid'];?>" class="bs-tooltip" target="_blank"  data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                                        </li>    
                                                                         <li>
                                                                            <a href="" class="btn_delete_a bs-tooltip" data-id="<?php echo $row['bid'];?>" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                                        </li>

                                                                        <?php if($row['status']!="0"){?>
                                                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['bid'];?>" data-action="deactive" data-column="status" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div></li>
                                                                        <?php }else{?>
                                                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['bid'];?>" data-action="active" data-column="status" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div></li>
                                                                        <?php }?>
                                                                    </ul>
                                                                </div>
                                                                
                                                                <?php if($row['banner_image']==""){?>
                                                                <span><img src="assets/img/600x300.jpg" /></span>
                                                                <?php }else{?>
                                                                <span><img src="images/<?php echo $row['banner_image'];?>" /></span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
<!--  BEGIN NAVBAR  -->
<?php include("includes/footer.php");?>
<!--  END NAVBAR  -->

<script type="text/javascript">
  $(".toggle_btn a").on("click",function(e){
    e.preventDefault();
    
    var _for=$(this).data("action");
    var _id=$(this).data("id");
    var _column=$(this).data("column");
    var _table='tbl_banner';

    $.ajax({
      type:'post',
      url:'processData.php',
      dataType:'json',
      data:{id:_id,for_action:_for,column:_column,table:_table,'action':'toggle_status','tbl_id':'bid'},
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
    var _table = 'tbl_banner';
    
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
			showLoaderOnConfirm: true,
			padding: '1em'
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
                  text: "Banner is deleted",
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

</script>       
