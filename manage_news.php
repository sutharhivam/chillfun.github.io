<?php
    $page_title="Manage News";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    if(isset($_POST['data_search'])){
        $qry="SELECT * FROM tbl_news                   
        WHERE tbl_news.category_name like '%".addslashes($_POST['search_value'])."%'
        ORDER BY tbl_news.category_name";
        $result=mysqli_query($mysqli,$qry); 
    
    }else{
    
        $tableName="tbl_news";   
        $targetpage = "manage_category.php"; 
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
        $qry="SELECT * FROM tbl_news
        ORDER BY tbl_news.id DESC LIMIT $start, $limit";
        $result=mysqli_query($mysqli,$qry); 
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
                                <div class="add_btn_primary"> <a href="add_news.php?add=yes">Add News</a> </div>
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
                        <div class="card component-card_2 mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title'];?></h5>
                                
                                <a href="<?php echo $row['url'];?>" target="_blank" class="btn btn-success btn_cust bs-tooltip" data-placement="top" title="News URL" style="padding: 5px 10px !important;">
                                        <i class="fa fa-history"></i>
                                    </a>
                                    
                                <a href="add_news.php?news_id=<?php echo $row['id'];?>"class="btn btn-primary btn_delete bs-tooltip" data-placement="top" title="Edit" style="padding: 5px 10px !important;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-placement="top" title="Delete" class="btn btn-danger btn_delete btn_delete_a bs-tooltip" style="padding: 5px 10px !important;"> 
                                    <i class="fa fa-trash"></i>
                                </a>
                                
                                
                                <?php if($row['status']!="0"){?>
                                    <div class="toggle_btn" style="margin-left: 0px; margin-right: 10px;"><a  href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="deactive" data-column="status" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div>
                                <?php }else{?>
                                    <div class="toggle_btn" style="margin-left: 0px; margin-right: 10px;"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="active" data-column="status" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div>
                                <?php }?>
                                
                            </div>
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
    var _table='tbl_news';

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
    var _table = 'tbl_news';
    
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
                  text: "News is deleted.",
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