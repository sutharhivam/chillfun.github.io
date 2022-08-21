<?php 
	require("includes/connection.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	require("language/app_language.php");
    include("smtp_email.php");
    $file_path = getBaseUrl();

	$response=array();
	$_SESSION['class'] = "success";

	switch ($_POST['action']) {
	    
	    case 'toggle_status':{
	        
    		$id = $_POST['id'];
    		$for_action = $_POST['for_action'];
    		$column = $_POST['column'];
    		$tbl_id = $_POST['tbl_id'];
    		$table_nm = $_POST['table'];
    
    		if ($for_action == 'active') {
    			$data = array($column  =>  '1');
    			$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
    			$_SESSION['msg'] = "13";
    		} else {
    			$data = array($column  =>  '0');
    			$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
    			$_SESSION['msg'] = "14";
    		}
    
    		$response['status'] = 1;
    		$response['action'] = $for_action;
    		echo json_encode($response);
    		break;
    	}
    	
    	case 'removeData':{
    		$id = $_POST['id'];
    		$tbl_nm = $_POST['tbl_nm'];
    		$tbl_id = $_POST['tbl_id'];
    
    		if ($tbl_nm == 'tbl_users') {
    			Delete('tbl_comments', 'user_id=' . $id . '');
    			Delete('tbl_song_suggest', 'user_id=' . $id . '');
    			Delete('tbl_reports', 'user_id=' . $id . '');
    		}
    
    		Delete($tbl_nm, $tbl_id . '=' . $id);
    
    		$_SESSION['msg'] = "12";
    		$response['status'] = 1;
    		echo json_encode($response);
    		break;
	    }

	case 'multi_delete':{

		$ids = implode(",", $_POST['id']);

		if ($ids == '') {
			$ids = $_POST['id'];
		}

		$tbl_nm = $_POST['tbl_nm'];

		if($tbl_nm == 'tbl_mp3') {

			$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['mp3_thumbnail'] != "") {
					unlink('images/' . $row['mp3_thumbnail']);
					unlink('images/thumbs/' . $row['mp3_thumbnail']);
				}

				if ($row['mp3_type'] == "local") {
					$file_name = basename($row['mp3_url']);
					unlink('uploads/' . $file_name);
				}

				Delete('tbl_favourite','post_id='.$row['id']);
				Delete('tbl_rating','post_id='.$row['id']);
				Delete('tbl_reports','song_id='.$row['id']);
				Delete('tbl_mp3_views','mp3_id='.$row['id']);

			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_category') {

			$sql = "SELECT * FROM tbl_mp3 WHERE `cat_id` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['mp3_thumbnail'] != "") {
					unlink('images/' . $row['mp3_thumbnail']);
					unlink('images/thumbs/' . $row['mp3_thumbnail']);
				}

				if ($row['mp3_type'] == "local") {
					$file_name = basename($row['mp3_url']);
					unlink('uploads/' . $file_name);
				}

				Delete('tbl_favourite','post_id='.$row['id']);
				Delete('tbl_rating','post_id='.$row['id']);
				Delete('tbl_reports','song_id='.$row['id']);
				Delete('tbl_mp3_views','mp3_id='.$row['id']);

			}
			$deleteSql = "DELETE FROM tbl_mp3 WHERE `cat_id` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);

			mysqli_free_result($res);

			$sqlCategory = "SELECT * FROM $tbl_nm WHERE `cid` IN ($ids)";
			$res = mysqli_query($mysqli, $sqlCategory);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['category_image'] != "") {
					unlink('images/' . $row['category_image']);
					unlink('images/thumbs/' . $row['category_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `cid` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_album') {

			if ($_POST['yes_no'] == 'yes') {
				$sql = "SELECT * FROM tbl_mp3 WHERE `album_id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['mp3_thumbnail'] != "") {
						unlink('images/' . $row['mp3_thumbnail']);
						unlink('images/thumbs/' . $row['mp3_thumbnail']);
					}

					if ($row['mp3_type'] == "local") {
						$file_name = basename($row['mp3_url']);
						unlink('uploads/' . $file_name);
					}	

					Delete('tbl_favourite','post_id='.$row['id']);
					Delete('tbl_rating','post_id='.$row['id']);
					Delete('tbl_reports','song_id='.$row['id']);
					Delete('tbl_mp3_views','mp3_id='.$row['id']);

				}
				$deleteSql = "DELETE FROM tbl_mp3 WHERE `album_id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);

				mysqli_free_result($res);
			}

			$sqlCategory = "SELECT * FROM $tbl_nm WHERE `aid` IN ($ids)";
			$res = mysqli_query($mysqli, $sqlCategory);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['album_image'] != "") {
					unlink('images/' . $row['album_image']);
					unlink('images/thumbs/' . $row['album_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `aid` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_playlist') {

			$sql = "SELECT * FROM $tbl_nm WHERE `pid` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['playlist_image'] != "") {
					unlink('images/' . $row['playlist_image']);
					unlink('images/thumbs/' . $row['playlist_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `pid` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_banner') {

			$sql = "SELECT * FROM $tbl_nm WHERE `bid` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['banner_image'] != "") {
					unlink('images/' . $row['banner_image']);
					unlink('images/thumbs/' . $row['banner_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `bid` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_song_suggest') {

			$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['song_image'] != "") {
					unlink('images/' . $row['song_image']);
					unlink('images/thumbs/' . $row['song_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} else if ($tbl_nm == 'tbl_artist') {

			$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
			$res = mysqli_query($mysqli, $sql);
			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['artist_image'] != "") {
					unlink('images/' . $row['artist_image']);
					unlink('images/thumbs/' . $row['artist_image']);
				}
			}
			$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

			mysqli_query($mysqli, $deleteSql);
		} 
		else if($tbl_nm=='tbl_admin'){
			$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
			mysqli_query($mysqli, $deleteSql);
		}
		else if($tbl_nm=='tbl_news'){
			$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
			mysqli_query($mysqli, $deleteSql);
		}
		else if($tbl_nm=='tbl_video_list'){
			$sqlVideo="SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
			$res=mysqli_query($mysqli, $sqlVideo);
			while ($row=mysqli_fetch_assoc($res)){
				if($row['video_image']!=""){
					unlink('images/'.$row['video_image']);
				}
				if($row['video_image_thumb']!=""){
					unlink('images/'.$row['video_image_thumb']);
				}
			}
			$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
			mysqli_query($mysqli, $deleteSql);
		}

		$_SESSION['msg'] = "12";
		$response['status'] = 1;
		echo json_encode($response);
		break;
	}
	
	case 'multi_action': {
		$action = $_POST['for_action'];
		$ids = implode(",", $_POST['id']);
		$tbl_nm = $_POST['table'];

		if ($ids == '') {
			$ids = $_POST['id'];
		}

		if ($action == 'enable') {
			$sql = "UPDATE $tbl_nm SET `status`='1' WHERE `id` IN ($ids)";
			mysqli_query($mysqli, $sql);
			$_SESSION['msg'] = "13";

		} else if ($action == 'disable') {
			$sql = "UPDATE $tbl_nm SET `status`='0' WHERE `id` IN ($ids)";
			if (mysqli_query($mysqli, $sql)) {
				$_SESSION['msg'] = "14";
			}
		} else if ($action == 'delete') {

			if($tbl_nm == 'tbl_users') {

				$deleteSql = "DELETE FROM tbl_reports WHERE `user_id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

				$deleteSql = "DELETE FROM tbl_favourite WHERE `user_id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

				$deleteSql = "DELETE FROM tbl_rating WHERE `ip` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

				$sql = "SELECT * FROM tbl_song_suggest WHERE `user_id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);

				while ($row = mysqli_fetch_assoc($res)) {

					if ($row['song_image'] != "") {
						unlink('images/' . $row['song_image']);
					}
				}

				mysqli_free_result($res);

				$deleteSql = "DELETE FROM tbl_song_suggest WHERE `user_id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

				$deleteSql="DELETE FROM tbl_active_log WHERE `user_id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);

				$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}
			else if($tbl_nm == 'tbl_mp3') {

				$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['mp3_thumbnail'] != "") {
						unlink('images/' . $row['mp3_thumbnail']);
						unlink('images/thumbs/' . $row['mp3_thumbnail']);
					}

					if ($row['mp3_type'] == "local") {
						$file_name = basename($row['mp3_url']);
						unlink('uploads/' . $file_name);
					}

					Delete('tbl_favourite','post_id='.$row['id']);
					Delete('tbl_rating','post_id='.$row['id']);
					Delete('tbl_reports','song_id='.$row['id']);
					Delete('tbl_mp3_views','mp3_id='.$row['id']);

				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_category') {

				$sql = "SELECT * FROM tbl_mp3 WHERE `cat_id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['mp3_thumbnail'] != "") {
						unlink('images/' . $row['mp3_thumbnail']);
						unlink('images/thumbs/' . $row['mp3_thumbnail']);
					}

					if ($row['mp3_type'] == "local") {
						$file_name = basename($row['mp3_url']);
						unlink('uploads/' . $file_name);
					}

					Delete('tbl_favourite','post_id='.$row['id']);
					Delete('tbl_rating','post_id='.$row['id']);
					Delete('tbl_reports','song_id='.$row['id']);
					Delete('tbl_mp3_views','mp3_id='.$row['id']);

				}
				$deleteSql = "DELETE FROM tbl_mp3 WHERE `cat_id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);

				mysqli_free_result($res);

				$sqlCategory = "SELECT * FROM $tbl_nm WHERE `cid` IN ($ids)";
				$res = mysqli_query($mysqli, $sqlCategory);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['category_image'] != "") {
						unlink('images/' . $row['category_image']);
						unlink('images/thumbs/' . $row['category_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `cid` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_album') {

				if ($_POST['yes_no'] == 'yes') {
					$sql = "SELECT * FROM tbl_mp3 WHERE `album_id` IN ($ids)";
					$res = mysqli_query($mysqli, $sql);
					while ($row = mysqli_fetch_assoc($res)) {
						if ($row['mp3_thumbnail'] != "") {
							unlink('images/' . $row['mp3_thumbnail']);
							unlink('images/thumbs/' . $row['mp3_thumbnail']);
						}

						if ($row['mp3_type'] == "local") {
							$file_name = basename($row['mp3_url']);
							unlink('uploads/' . $file_name);
						}

						Delete('tbl_rating','post_id='.$row['id']);
						Delete('tbl_favourite','post_id='.$row['id']);
						Delete('tbl_reports','song_id='.$row['id']);
						Delete('tbl_mp3_views','mp3_id='.$row['id']);

					}
					$deleteSql = "DELETE FROM tbl_mp3 WHERE `album_id` IN ($ids)";

					mysqli_query($mysqli, $deleteSql);

					mysqli_free_result($res);
				}

				$sqlCategory = "SELECT * FROM $tbl_nm WHERE `aid` IN ($ids)";
				$res = mysqli_query($mysqli, $sqlCategory);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['album_image'] != "") {
						unlink('images/' . $row['album_image']);
						unlink('images/thumbs/' . $row['album_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `aid` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_playlist') {

				$sql = "SELECT * FROM $tbl_nm WHERE `pid` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['playlist_image'] != "") {
						unlink('images/' . $row['playlist_image']);
						unlink('images/thumbs/' . $row['playlist_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `pid` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_banner') {

				$sql = "SELECT * FROM $tbl_nm WHERE `bid` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['banner_image'] != "") {
						unlink('images/' . $row['banner_image']);
						unlink('images/thumbs/' . $row['banner_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `bid` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_song_suggest') {

				$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['song_image'] != "") {
						unlink('images/' . $row['song_image']);
						unlink('images/thumbs/' . $row['song_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			} else if ($tbl_nm == 'tbl_artist') {

				$sql = "SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
				$res = mysqli_query($mysqli, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['artist_image'] != "") {
						unlink('images/' . $row['artist_image']);
						unlink('images/thumbs/' . $row['artist_image']);
					}
				}
				$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}
			else if($tbl_nm=='tbl_admin'){
    			$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
    			mysqli_query($mysqli, $deleteSql);
    		}
    		else if($tbl_nm=='tbl_news'){
    			$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
    			mysqli_query($mysqli, $deleteSql);
    		}
    		else if($tbl_nm=='tbl_video_list'){
    			$sqlVideo="SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
    			$res=mysqli_query($mysqli, $sqlVideo);
    			while ($row=mysqli_fetch_assoc($res)){
    				if($row['video_image']!=""){
    					unlink('images/'.$row['video_image']);
    				}
    				if($row['video_image_thumb']!=""){
    					unlink('images/'.$row['video_image_thumb']);
    				}
    			}
    			$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
    			mysqli_query($mysqli, $deleteSql);
    		}

			$_SESSION['msg'] = "12";
		} 

		$response['status'] = 1;

		echo json_encode($response);
		break;
	}
	case 'check_smtp':
	{
		$to = trim($_POST['email']);
		$recipient_name='Check User';

		$subject = '[IMPORTANT] '.APP_NAME.' Check SMTP Configuration';

		$message='<div style="background-color: #f9f9f9;" align="center"><br />
		<table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tbody>
		<tr>
		<td colspan="2" bgcolor="#FFFFFF" align="center"><img src="'.$file_path.'images/'.APP_LOGO.'" alt="header" /></td>
		</tr>
		<tr>
		<td width="600" valign="top" bgcolor="#FFFFFF"><br>
		<table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
		<tbody>
		<tr>
		<td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
		<tbody>
		<tr>
		<td>
		<p style="color: #262626; font-size: 24px; margin-top:0px;">Hi, '.$_SESSION['admin_name'].'</p>
		<p style="color: #262626; font-size: 18px; margin-top:0px;">This is the demo mail to check SMTP Configuration. </p>
		<p style="color:#262626; font-size:17px; line-height:32px;font-weight:500;margin-bottom:30px;">'.$app_lang['thank_you_lbl'].' '.APP_NAME.'</p>

		</td>
		</tr>
		</tbody>
		</table></td>
		</tr>

		</tbody>
		</table></td>
		</tr>
		<tr>
		<td style="color: #262626; padding: 20px 0; font-size: 18px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">'.$app_lang['email_copyright'].' '.APP_NAME.'.</td>
		</tr>
		</tbody>
		</table>
		</div>';

		send_email($to,$recipient_name,$subject,$message, true);
		break;
	}
		
	default:
		# code...
		break;
	}
?>