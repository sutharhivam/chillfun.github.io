<?php
    $page_title="Manage Playlist";
    include("includes/header.php");
	require("includes/lb_helper.php");
	require("language/language.php");
    
    if(isset($_POST['search_data'])){
        $data_qry="SELECT * FROM tbl_playlist
        WHERE tbl_playlist.playlist_name like '%".addslashes($_POST['search_value'])."%' ORDER BY tbl_playlist.pid DESC";  
        $result=mysqli_query($mysqli,$data_qry);

    }else{
        
        $tableName="tbl_playlist";   
        $targetpage = "manage_playlist.php"; 
        $limit = 10; 
        
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
        
        $data_qry="SELECT * FROM tbl_playlist
        ORDER BY tbl_playlist.pid DESC LIMIT $start, $limit";
        
        $result=mysqli_query($mysqli,$data_qry); 
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
                                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" value="<?php if(isset($_POST['data_search'])){ echo $_POST['search_value'];} ?>" required>
                                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                                    </form>  
                                </div>
                                <div class="add_btn_primary"><a href="add_playlist.php?add=yes">Add Playlist</a></div>
                            </div>
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
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="block_wallpaper hover14">           
                            <div class="wall_image_title">
                                <h3 style="color: #ffffff; font-size: 1.30rem;"><?php echo $row['playlist_name'];?></3>
                                <ul>                
                                    <li>
                                        <a href="add_playlist.php?playlist_id=<?php echo $row['pid'];?>" class=" bs-tooltip" target="_blank"  data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    </li>               
                                    <li>
                                        <a href="" class="btn_delete_a bs-tooltip" data-id="<?php echo $row['pid'];?>" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </li>
                                    <?php if($row['status']!="0"){?>
                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['pid'];?>" data-action="deactive" data-column="status" class=" bs-tooltip" data-placement="top"  title="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div></li>
                                    <?php }else{?>
                                        <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['pid'];?>" data-action="active" data-column="status" class=" bs-tooltip" data-placement="top"  title="ENABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div></li>
                                    <?php }?>
                                </ul>
                            </div>
                            <?php if($row['playlist_image'] == ""){?>
                                <span><img src="assets/images/300x300.jpg" /></span>
                            <?php }else{?>
                                <span><img src="images/<?php echo $row['playlist_image'];?>" /></span>
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
    var _table='tbl_playlist';

    $.ajax({
      type:'post',
      url:'processData.php',
      dataType:'json',
      data:{id:_id,for_action:_for,column:_column,table:_table,'action':'toggle_status','tbl_id':'pid'},
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
    var _table = 'tbl_playlist';
    
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
                  text: "Playlist is deleted.",
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