<?php
/**
* Company : Nemosofts
* Detailed : Software Development Company in Sri Lanka
* Developer : Thivakaran
* Contact : thivakaran829@gmail.com
* Contact : nemosofts@gmail.com
* Website : https://nemosofts.com
*/ 
$page_title="Dashboard";
include("includes/header.php");

    $qry_cat="SELECT COUNT(*) as num FROM tbl_category";
    $total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
    $total_category = $total_category['num'];
    
    $qry_art="SELECT COUNT(*) as num FROM tbl_artist";
    $total_artist= mysqli_fetch_array(mysqli_query($mysqli,$qry_art));
    $total_artist = $total_artist['num'];
    
    $qry_mp3="SELECT COUNT(*) as num FROM tbl_mp3";
    $total_mp3 = mysqli_fetch_array(mysqli_query($mysqli,$qry_mp3));
    $total_mp3 = $total_mp3['num'];
    
    $qry_album="SELECT COUNT(*) as num FROM tbl_album";
    $total_album = mysqli_fetch_array(mysqli_query($mysqli,$qry_album));
    $total_album = $total_album['num'];
    
    
    $qry_playlist="SELECT COUNT(*) as num FROM tbl_playlist";
    $total_playlist = mysqli_fetch_array(mysqli_query($mysqli,$qry_playlist));
    $total_playlist = $total_playlist['num'];
    
    $qry_users="SELECT COUNT(*) as num FROM tbl_users";
    $total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
    $total_users = $total_users['num'];
    
    $qry_banner="SELECT COUNT(*) as num FROM tbl_banner";
    $total_banner = mysqli_fetch_array(mysqli_query($mysqli,$qry_banner));
    $total_banner = $total_banner['num'];
    
    $qry_dwn2="SELECT SUM(total_views) as num FROM tbl_mp3";
    $total_vi= mysqli_fetch_array(mysqli_query($mysqli,$qry_dwn2));
    $total_vi = $total_vi['num'];
    
    $qry_dwn="SELECT SUM(total_download) as num FROM tbl_mp3";
    $total_download= mysqli_fetch_array(mysqli_query($mysqli,$qry_dwn));
    $total_download = $total_download['num'];
    
    $qry_rat="SELECT COUNT(*) as num FROM tbl_rating";
    $total_rat = mysqli_fetch_array(mysqli_query($mysqli,$qry_rat));
    $total_rat = $total_rat['num'];
    
    $qry_song_suggest="SELECT COUNT(*) as num FROM tbl_song_suggest";
    $total_song_suggest = mysqli_fetch_array(mysqli_query($mysqli,$qry_song_suggest));
    $total_song_suggest = $total_song_suggest['num'];
    
    
    $qry_reports="SELECT COUNT(*) as num FROM tbl_reports";
    $total_reports = mysqli_fetch_array(mysqli_query($mysqli,$qry_reports));
    $total_reports = $total_reports['num'];

    $qry_andmin="SELECT COUNT(*) as num FROM tbl_admin";
    $total_admin= mysqli_fetch_array(mysqli_query($mysqli,$qry_andmin));
    $total_admin = $total_admin['num'];


    $qry_news="SELECT COUNT(*) as num FROM tbl_news";
    $total_news= mysqli_fetch_array(mysqli_query($mysqli,$qry_news));
    $total_news = $total_news['num'];
    
    $qry_video="SELECT COUNT(*) as num FROM tbl_video_list";
    $total_video= mysqli_fetch_array(mysqli_query($mysqli,$qry_video));
    $total_video = $total_video['num'];

    
    $sql_query="SELECT * FROM tbl_users ORDER BY tbl_users.`id` DESC LIMIT 7";
    $result2=mysqli_query($mysqli,$sql_query);

    function thousandsNumberFormat($num){
        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array(' K', ' M', ' B', ' T');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }else{
            if($num==""){
                $num = 0; 
            }else{
                $num = $num; 
            }
        }
        return $num;
    }

    function get_user_info($user_id){
        global $mysqli;
        $user_qry="SELECT * FROM tbl_users where id='".$user_id."'";
        $user_result=mysqli_query($mysqli,$user_qry);
        $user_row=mysqli_fetch_assoc($user_result);
        return $user_row;
   }
    
    $qry5="SELECT tbl_reports.*,tbl_mp3.mp3_title FROM tbl_reports
    LEFT JOIN tbl_mp3 ON tbl_reports.song_id= tbl_mp3.id ORDER BY tbl_reports.id DESC LIMIT 7";   
    $result3=mysqli_query($mysqli,$qry5);
    
    
    $countStr='';
    $no_data_status=false;
    $count=$monthCount=0;
    
    for ($mon=1; $mon<=12; $mon++) {
        if(date('n') < $mon){
            break;
        }
        $monthCount++;
        if(isset($_GET['filterByYear'])){
            $year=$_GET['filterByYear'];
            $month = date('M', mktime(0,0,0,$mon, 1, $year));
            $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%c') = '$mon' AND DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%Y') = '$year'";
        }else{
            $month = date('M', mktime(0,0,0,$mon, 1, date('Y')));
            $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%c') = '$mon'";
        }
        $count=mysqli_num_rows(mysqli_query($mysqli, $sql_user));
        $countStr.="['".$month."', ".$count."], ";
        if($count!=0){
            $count++;
        }
    }
    
    if($count!=0){
        $no_data_status=false;
    }else{
        $no_data_status=true;
    }
    $countStr=rtrim($countStr, ", ");
    
    $sql_smtp="SELECT * FROM tbl_smtp_settings WHERE id='1'";
    $res_smtp=mysqli_query($mysqli,$sql_smtp);
    $row_smtp=mysqli_fetch_assoc($res_smtp);
    $smtp_warning=true;
    
    if(!empty($row_smtp)){
      if($row_smtp['smtp_type']=='server'){
        if($row_smtp['smtp_host']!='' AND $row_smtp['smtp_email']!=''){
          $smtp_warning=false;
        }else{
          $smtp_warning=true;
        }  
      }else if($row_smtp['smtp_type']=='gmail'){
        if($row_smtp['smtp_ghost']!='' AND $row_smtp['smtp_gemail']!=''){
          $smtp_warning=false;
        }else{
          $smtp_warning=true;
        }  
      }
    }
?>    

<div id="content" class="main-content">
<div class="layout-px-spacing">
    
    <?php if($smtp_warning){ ?>
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                    <h4 style="color: #e7515a;"><i class="fa fa-exclamation-triangle"></i>SMTP Setting is not config</h4>
                    <p style="margin-bottom: 10px; color: #e7515a; ">Config the smtp setting otherwise <strong>forgot password</strong> OR <strong>email</strong> feature will not be work.</p> 
                </div> 
            </div>
        </div>
    <?php } ?>

    <div class="row layout-top-spacing">
            
        <div class="col-lg-3 col-xs-6">  <a href="manage_category.php">
            <div class="rad-info-box color_1 widget-content widget-content-area br-6">
                <i class="icon fa fa-sitemap"></i>
                <span class="heading">Categories</span>
                <span class="value"><?php echo thousandsNumberFormat($total_category); ?></span>
            </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-xs-6"> <a href="manage_artist.php">
            <div class="rad-info-box color_2 widget-content widget-content-area br-6">
                <i class="fa fa-buysellads"></i>
                <span class="heading">Artist</span>
                <span class="value"><?php echo thousandsNumberFormat($total_artist); ?></span>
            </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-xs-6"> <a href="manage_album.php">
            <div class="rad-info-box color_3 widget-content widget-content-area br-6">
                <i class="fa fa fa-image"></i>
                <span class="heading">Album</span>
                <span class="value"><?php echo thousandsNumberFormat($total_album); ?></span>
            </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-xs-6"> <a href="manage_mp3.php">
            <div class="rad-info-box color_4 widget-content widget-content-area br-6">
                <i class="fa fa-music"></i>
                <span class="heading">Mp3 Songs</span>
                <span class="value"><?php echo thousandsNumberFormat($total_mp3); ?></span>
            </div>
            </a>
        </div>
        
        
        <div class="col-lg-3 my col-xs-6"> <a href="manage_banners.php">
            <div class="rad-info-box color_5 widget-content widget-content-area br-6">
                <i class="fa fa-sliders"></i>
                <span class="heading">Banners</span>
                <span class="value"><?php echo thousandsNumberFormat($total_banner); ?></span>
            </div>
            </a>
        </div>
        
        
        <div class="col-lg-3 my col-xs-6"> <a href="manage_playlist.php">
            <div class="rad-info-box color_1 widget-content widget-content-area br-6">
                <i class="fa fa-list"></i>
                <span class="heading">Playlist</span>
                <span class="value"><?php echo thousandsNumberFormat($total_playlist); ?></span>
            </div>
            </a>
        </div>
        
         <div class="col-lg-3 col-xs-6">
            <div class="rad-info-box color_2 widget-content widget-content-area br-6">
                <i class="fa fa-newspaper-o"></i>
                <span class="heading">News</span>
                <span class="value"><?php echo thousandsNumberFormat($total_news); ?></span>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
            <div class="rad-info-box color_3 widget-content widget-content-area br-6">
                <i class="fa fa-film"></i>
                <span class="heading">Movie Promote</span>
                <span class="value"><?php echo thousandsNumberFormat($total_video); ?></span>
            </div>
        </div>
        
        <div class="col-lg-3 my col-xs-6"> <a href="manage_users.php">
            <div class="rad-info-box color_4 widget-content widget-content-area br-6">
                <i class="fa fa-users"></i>
                <span class="heading">Users</span>
                <span class="value"><?php echo thousandsNumberFormat($total_users); ?></span>
            </div>
            </a>
        </div>
        
        <div class="col-lg-3 my col-xs-6">
            <div class="rad-info-box color_5 widget-content widget-content-area br-6">
                <i class="fa fa-cloud-download"></i>
                <span class="heading">Download</span>
                <span class="value"><?php echo thousandsNumberFormat($total_download); ?></span>
            </div>
        </div>
        
        <div class="col-lg-3 my col-xs-6">
            <div class="rad-info-box color_1 widget-content widget-content-area br-6">
                <i class="fa fa-eye"></i>
                <span class="heading">Total views</span>
                <span class="value"><?php echo thousandsNumberFormat($total_vi); ?></span>
            </div>
        </div>
        
        <div class="col-lg-3 my col-xs-6">
            <div class="rad-info-box color_2 widget-content widget-content-area br-6">
                <i class="fa fa-road"></i>
                <span class="heading">Total Rating</span>
                <span class="value"><?php echo thousandsNumberFormat($total_rat); ?></span>
            </div>
        </div>
        
        <div class="col-lg-3 my col-xs-6"> <a href="manage_suggestion.php">
            <div class="rad-info-box color_3 widget-content widget-content-area br-6">
                <i class="fa fa-comments"></i>
                <span class="heading">Suggestion</span>
                <span class="value"><?php echo thousandsNumberFormat($total_song_suggest); ?></span>
            </div>
            </a>
        </div>
        
        <div class="col-lg-3 my col-xs-6"> <a href="manage_reports.php">
            <div class="rad-info-box color_4 widget-content widget-content-area br-6">
                <i class="fa fa-bug"></i>
                <span class="heading">Reports</span>
                <span class="value"><?php echo thousandsNumberFormat($total_reports); ?></span>
            </div>
            </a>
        </div>
        
        
        
        <div class="col-lg-3 my col-xs-3">
            <div class="rad-info-box color_5 widget-content widget-content-area br-6">
                <i class="fa fa-user-md"></i>
                <span class="heading">Admin</span>
                <span class="value"><?php echo thousandsNumberFormat($total_admin); ?></span>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="container-fluid" style="padding-top: 20px; background: #FFF;border: 1px solid #dadce0;border-radius: 10px;">
                <div class="col-lg-10">
                    <h3 style="font-weight: 900;">Users Analysis</h3>
                    <p style="font-weight: 200;">New registrations</p>
                </div>
                <div class="col-lg-2" style="padding-top: 20px">
                    <form method="get" id="graphFilter">
                        <select class="form-control" name="filterByYear" style="box-shadow: none;height: auto;border-radius: 8px;font-size: 16px;">
                        <?php 
                            $currentYear=date('Y');
                            $minYear=2020;
                            for ($i=$currentYear; $i >= $minYear ; $i--) { 
                        ?>
                        <option value="<?=$i?>" <?=(isset($_GET['filterByYear']) && $_GET['filterByYear']==$i) ? 'selected' : ''?>><?=$i?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </form>
                </div>
                <div class="col-lg-12">
                    <?php if($no_data_status){ ?>
                        <h3 class="text-muted text-center" style="padding-bottom: 2em">No data found !</h3>
                    <?php } else{ ?>
                        <div id="registerChart"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row layout-top-spacing">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">
                <div class="widget-heading">
                    <h5 class="">Songs Reports</h5>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-scroll">
                            <thead>
                                <tr>
                                    <th><div class="th-content">#</div></th>
                                    <th><div class="th-content">User Name</div></th>
                                    <th><div class="th-content">Song Title</div></th>
                                    <th><div class="th-content">Report</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=0;
                                while($row=mysqli_fetch_array($result3))
                                {         
                                ?>
                                    <tr>
                                        <td><div class="td-content"><?php echo $i+1;?></div></td>
                                        <td><div class="td-content"><?php echo get_user_info($row['user_id'])['name'];?></div></td>
                                        <td><div class="td-content"><?php echo $row['mp3_title'];?></div></td>
                                        <td><div class="td-content"><?php echo $row['report'];?></div></td>
                                    </tr>
                                <?php
                                $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">
                <div class="widget-heading">
                    <h5 class="">New Users</h5>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-scroll">
                            <thead>
                                <tr>
                                    <th><div class="th-content">Name</div></th>
                                    <th><div class="th-content th-heading">Email</div></th>
                                    <th><div class="th-content">Status</div></th>
                                    <th><div class="th-content">Type</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                while($users_row=mysqli_fetch_array($result2))
                                {
                                ?>
                                <tr>
                                    <td>
                                        <div class="td-content">
                                            <?php 
                                            if(strlen($users_row['name']) > 10){
                                                echo mb_substr(stripslashes($users_row['name']), 0, 10).'...';  
                                            }else{
                                                echo $users_row['name'];
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-content">
                                            <?php 
                                            if(strlen($users_row['email']) > 15){
                                                echo mb_substr(stripslashes($users_row['email']), 0, 16).'...';  
                                            }else{
                                                echo $users_row['email'];
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="th-content">
                                            <?php if ($users_row['status'] != "0") { ?>
                                                <a title="Change Status" class="toggle_btn_a" href="javascript:void(0)" data-id="<?= $users_row['id'] ?>" data-action="deactive" data-column="status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Enable</span></span></a>
                                            <?php } else { ?>
                                                <a title="Change Status" class="toggle_btn_a" href="javascript:void(0)" data-id="<?= $users_row['id'] ?>" data-action="active" data-column="status"><span class="badge badge-danger badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Disable </span></span></a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-content">Normal</div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                }
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


<?php 
if(!$no_data_status){ ?>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Month');
      data.addColumn('number', 'Users');

      data.addRows([<?=$countStr?>]);

      var options = {
        curveType: 'function',
        fontSize: 15,
        hAxis: {
          title: "Months of <?=(isset($_GET['filterByYear'])) ? $_GET['filterByYear'] : date('Y')?>",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false
          },
        },
        vAxis: {
          title: "Nos of Users",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false,
          },
          gridlines: { count: 5},
          format: '#',
          viewWindowMode: "explicit", viewWindow:{ min: 0 },
        },
        height: 400,
        chartArea:{
          left:100,top:20,width:'100%',height:'auto'
        },
        legend: {
          position: 'none'
        },
        lineWidth:4,
        animation: {
          startup: true,
          duration: 1200,
          easing: 'out',
        },
        pointSize: 5,
        pointShape: "circle",
        colors: ['#2196f3']

      };
      var chart = new google.visualization.LineChart(document.getElementById('registerChart'));

      chart.draw(data, options);
    }

    $(document).ready(function () {
      $(window).resize(function(){
        drawChart();
      });
    });
  </script>

<?php } ?>

<script type="text/javascript">

  // filter of graph
  $("select[name='filterByYear']").on("change",function(e){
    $("#graphFilter").submit();
  });

</script>      