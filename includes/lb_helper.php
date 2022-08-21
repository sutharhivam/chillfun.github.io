<?php if(count(get_included_files()) == 1) exit("No direct script access allowed");
/**
 * Copyright 2017 nemosofts.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 
define("LB_API_DEBUG", false);
define("LB_TEXT_CONNECTION_FAILED", 'Server is unavailable at the moment, please try again.');
define("LB_TEXT_INVALID_RESPONSE", 'Server returned an invalid response, please contact support.');
define("LB_TEXT_VERIFIED_RESPONSE", 'Verified! Thanks for purchasing.');
define("LB_TEXT_PREPARING_MAIN_DOWNLOAD", 'Preparing to download main update...');
define("LB_TEXT_MAIN_UPDATE_SIZE", 'Main Update size:');
define("LB_TEXT_DONT_REFRESH", '(Please do not refresh the page).');
define("LB_TEXT_DOWNLOADING_MAIN", 'Downloading main update...');
define("LB_TEXT_UPDATE_PERIOD_EXPIRED", 'Your update period has ended or your license is invalid, please contact support.');
define("LB_TEXT_UPDATE_PATH_ERROR", 'Folder does not have write permission or the update file path could not be resolved, please contact support.');
define("LB_TEXT_MAIN_UPDATE_DONE", 'Main update files downloaded and extracted.');
define("LB_TEXT_UPDATE_EXTRACTION_ERROR", 'Update zip extraction failed.');
define("LB_TEXT_PREPARING_SQL_DOWNLOAD", 'Preparing to download SQL update...');
define("LB_TEXT_SQL_UPDATE_SIZE", 'SQL Update size:');
define("LB_TEXT_DOWNLOADING_SQL", 'Downloading SQL update...');
define("LB_TEXT_SQL_UPDATE_DONE", 'SQL update files downloaded.');
define("LB_TEXT_UPDATE_WITH_SQL_IMPORT_FAILED", 'Application was successfully updated but automatic SQL importing failed, please import the downloaded SQL file in your database manually.');
define("LB_TEXT_UPDATE_WITH_SQL_IMPORT_DONE", 'Application was successfully updated and SQL file was automatically imported.');
define("LB_TEXT_UPDATE_WITH_SQL_DONE", 'Application was successfully updated, please import the downloaded SQL file in your database manually.');
define("LB_TEXT_UPDATE_WITHOUT_SQL_DONE", 'Application was successfully updated, there were no SQL updates.');
define("LB_TEXT_PURCHASE_CODE_IS_WRONG", 'Envato username or purchase code is wrong!');
define("LB_TEXT_API_FILE_MISSING", 'Api File Missing!');
define("LB_TEXT_INVALID_PACKAGE_NAME", 'Invalid Package Name');

#Admin Login
function adminUser($username, $password){
    global $mysqli;
    $sql = "SELECT id,username FROM tbl_admin where username = '".$username."' and password = '".md5($password)."'";       
    $result = mysqli_query($mysqli,$sql);
    $num_rows = mysqli_num_rows($result);
     
    if ($num_rows > 0){
        while ($row = mysqli_fetch_array($result)){
            echo $_SESSION['ADMIN_ID'] = $row['id'];
            echo $_SESSION['ADMIN_USERNAME'] = $row['username'];
        return true; 
        }
    }
}

#Insert Data 
function Insert($table, $data){
    global $mysqli;
    
    //print_r($data);
    $fields = array_keys( $data );  
    $values = array_map( array($mysqli, 'real_escape_string'), array_values( $data ) );
    
   //echo "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";
   //exit;  
    mysqli_query($mysqli, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($mysqli) );

}

#Update Data, Where clause is left optional
function Update($table_name, $form_data, $where_clause=''){   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value){
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
         
    // run and return the query result
    return mysqli_query($mysqli,$sql);
}

#Delete Data, the where clause is left optional incase the user wants to delete every row!
function Delete($table_name, $where_clause=''){   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
     
    // run and return the query result resource
    return mysqli_query($mysqli,$sql);
}

//Get User Info
function user_info($user_id,$field_name) {
    
    global $mysqli;

    $qry_user="SELECT * FROM tbl_users WHERE id='".$user_id."'";
    $query1=mysqli_query($mysqli,$qry_user);
    $row_user = mysqli_fetch_array($query1);

    $num_rows1 = mysqli_num_rows($query1);

    if ($num_rows1 > 0){     
        // return the result
        return $row_user[$field_name];
    }else{
      return "";
    }
}

//Clean Input
function cleanInput($inputText){
    return htmlentities(addslashes(trim($inputText)));
}

#Check Sign
function checkSign($data_info){
    
    $APP_NAME = 'TAMIL_AUDIO_PRO';
    
    $data_json = $data_info;
    $data_arr = json_decode(urldecode(base64_decode($data_json)), true);
    if($data_arr['package_name']==PACKAGE_NAME){
        if (!file_exists('speed_api.php')){
            //$data['data'] = array("success" => -1, "MSG" => "Invalid.");
            $set[$APP_NAME][] = array("success" => -1, "msg" => LB_TEXT_API_FILE_MISSING);   
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit(); 
        }else if (APP_STATUS == 0){
            //$data['data'] = array("success" => -1, "MSG" => "Invalid.");
            $set[$APP_NAME][] = array("success" => -1, "msg" => LB_TEXT_PURCHASE_CODE_IS_WRONG);   
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit(); 
        }else if (file_exists('.lic')){
            //$data['data'] = array("success" => -1, "MSG" => "Invalid.");
            $set[$APP_NAME][] = array("success" => -1, "msg" => LB_TEXT_PURCHASE_CODE_IS_WRONG);   
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit(); 
        }
    } else{
        //$data['data'] = array("success" => -1, "MSG" => "Invalid.");
        $set[$APP_NAME][] = array("success" => -1, "msg" => LB_TEXT_INVALID_PACKAGE_NAME);   
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        exit();  
    }
    return $data_arr;
}
    
#Image compress
function compress_image($source_url, $destination_url, $quality) {

    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

#Create Thumb Image
function create_thumb_image($target_folder ='',$thumb_folder = '', $thumb_width = '',$thumb_height = ''){  
    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;  
    
    $thumbnail = $thumb_path;
    $upload_image = $target_path;

    list($width,$height) = getimagesize($upload_image);
    $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
    switch($file_ext){
      case 'jpg':
          $source = imagecreatefromjpeg($upload_image);
          break;
      case 'jpeg':
          $source = imagecreatefromjpeg($upload_image);
          break;
      case 'png':
          $source = imagecreatefrompng($upload_image);
          break;
      case 'gif':
          $source = imagecreatefromgif($upload_image);
           break;
      default:
          $source = imagecreatefromjpeg($upload_image);
    }

    imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width,$height);
    switch($file_ext){
        case 'jpg' || 'jpeg':
            imagejpeg($thumb_create,$thumbnail,80);
            break;
        case 'png':
            imagepng($thumb_create,$thumbnail,80);
            break;
        case 'gif':
            imagegif($thumb_create,$thumbnail,80);
             break;
        default:
            imagejpeg($thumb_create,$thumbnail,80);
    }
}

#Image compress User
function compress_image_user($source_url, $destination_url, $quality){

    $info = getimagesize($source_url);
    $exif = exif_read_data($source_url);
    
    if ($info['mime'] == 'image/jpeg'){
        $imageResource = imagecreatefromjpeg($source_url);
    }else if ($info['mime'] == 'image/gif'){
        $imageResource = imagecreatefromgif($source_url);
    }else if ($info['mime'] == 'image/png'){
        $imageResource = imagecreatefrompng($source_url);
    }else{
        $imageResource = imagecreatefromjpeg($source_url);
    }
        
    //Image Orientation
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3:
            $image = imagerotate($imageResource, 180, 0);
            break;
            case 6:
            $image = imagerotate($imageResource, -90, 0);
            break;
            case 8:
            $image = imagerotate($imageResource, 90, 0);
            break;
            default:
            $image = $imageResource;
        }
    }else{
        $image = $imageResource;
    }
    
    imagejpeg($image, $destination_url, $quality);
    // return the result
    return $destination_url;
}

#Thousands Number
function thousandsNumberFormat($num) {
    if($num > 1000) {
      $x = round($num);
      $x_number_format = number_format($x);
      $x_array = explode(',', $x_number_format);
      $x_parts = array(' K', ' M', ' B', ' T');
      $x_count_parts = count($x_array) - 1;
      $x_display = $x;
      $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
      $x_display .= $x_parts[$x_count_parts - 1];
      return $x_display;
    }
    // return the result
    return $num;
}

#Calculate Time
function calculate_time_span($post_time,$flag=false){  
    if($post_time!=''){
        $seconds = time() - $post_time;
        $year = floor($seconds /31556926);
        $months = floor($seconds /2629743);
        $week=floor($seconds /604800);
        $day = floor($seconds /86400); 
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60); 
        $secs = floor($seconds % 60);
        
        if($seconds < 60) $time = $secs." sec ago";
        else if($seconds < 3600 ) $time =($mins==1)? $mins." min ago" : $mins." mins ago";
        else if($seconds < 86400) $time = ($hours==1)?$hours." hour ago":$hours." hours ago";
        else if($seconds < 604800) $time = ($day==1)?$day." day ago":$day." days ago";
        else if($seconds < 2629743) $time = ($week==1)?$week." week ago":$week." weeks ago";
        else if($seconds < 31556926) $time =($months==1)? $months." month ago":$months." months ago";
        else $time = ($year==1)? $year." year ago":$year." years ago";
        
        if($flag){
            if($day > 1){
                $time=date('d-m-Y',$post_time);
            }
        }
        // return the result
        return $time;
    }else{
        // return the result not available
        return 'not available';
    }
}

#Call API
function call_api($data){
    // Open connection
    $curl = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($curl, CURLOPT_POST, $data);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://api.nemosofts.com/api_helper.php");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// Connection Timeout
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30); 
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	$result = curl_exec($curl);
	// Close connection
	curl_close($curl);
	// run and return the query result
	return $result;
}

#Get Latest Version Data
function get_latest_version($item_id){
    // $message = array($data);
    $data_array =  array(
    	'method_name' => "latest_version",
        'item_id' => $item_id
    );
    $get_data = call_api($data_array);
    $response = json_decode($get_data, true);
    // run and return the query result
    return $response;
}

#Activate
function activate_license($license,$client,$item_id,$create_lic = true){
	return array('status' => true, 'message' => 'Valid license');
    // $message = array($data);
    $data_array =  array(
        'method_name' => "activate_license",
		"item_id"  => $item_id,
		"license_code" => $license,
		"client_name" => $client
	);
	// call api and return the result
	$get_data = call_api($data_array);
	$response = json_decode($get_data, true);
	$current_path = realpath(__DIR__);
	$license_file = $current_path.'/.lic';
	if(!empty($create_lic)){
		if($response['status']){
			$licfile = trim($response['lic_response']);
			file_put_contents($license_file, $licfile, LOCK_EX);
		}else{
			@chmod($license_file, 0777);
			if(is_writeable($license_file)){
				unlink($license_file);
			}
		}
	}
	// run and return the query result
	return $response;
}

#Deactivate
function deactivate_license($deactivate_password){
    $current_path = realpath(__DIR__);
	$license_file = $current_path.'/.lic';
	// $message = array($data);
	$data_array =  array(
	    'method_name' => "deactivate_license",
		"deactivate_password" => $deactivate_password
	);
	// call api and return the result
	$get_data = call_api($data_array);
	$response = json_decode($get_data, true);
	if($response['status']){
		@chmod($license_file, 0777);
		if(is_writeable($license_file)){
			unlink($license_file);
		}
	}
	// run and return the query result
	return $response;
}

#Verify Data On Server
function verify_data_on_server($method_name,$purchase_code,$nemosofts_key,$package_name){
    $get_base_url = getBaseUrl();
    // $message = array($data);
    $data_array =  array('method_name' => $method_name,'envato_purchase_code' => $purchase_code,'nemosofts_key' => $nemosofts_key,'buyer_admin_url' => $get_base_url,'package_name' => $package_name);
    // call api and return the result
    $get_data = call_api($data_array);
    $response = json_decode($get_data, true);
    if ($get_data == "success") { echo "done1"; } else { echo "fail!";}     
}

#Verify Data On Server
function verify_data_on_admin_panel($purchase_code){
    $get_base_url = getBaseUrl();
    $envato = verify_envato_purchase_code($purchase_code);
    if($envato->buyer!="" AND $envato->item->id!=""){
        // $message = array($data);
        $data_array =  array('method_name' => 'admin_panel','envato_product_id' => $envato->item->id,'envato_buyer_name' => $envato->buyer,'envato_purchase_code' => $purchase_code,'envato_license_type' => $envato->license,'buyer_admin_url' => $get_base_url);
        // call api and return the result
        $get_data = call_api($data_array);
        $response = json_decode($get_data, true);
    }
}

#Check Update
function check_update($item_id){
    // $message = array($data);
	$data_array =  array(
		"item_id"  => $item_id
	);
	// call api and return the result
	$get_data = call_api($data_array);
	$response = json_decode($get_data, true);
	// run and return the query result
	return $response;
}

#Check IP
function get_ip_from_third_party(){
	$curl = curl_init ();
	curl_setopt($curl, CURLOPT_URL, "http://ipecho.net/plain");
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); 
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	$response = curl_exec($curl);
	curl_close($curl);
	// run and return the query result
	return $response;
}

#Verify Envato Purchase Code
function verify_envato_purchase_code($product_code){
    $url = "https://api.envato.com/v3/market/author/sale?code=" . $product_code;
    $curl = curl_init($url);
    $personal_token = "1Mi77qTS4nSI0kBlkwDD9ljTFY4srKzR";
    $header = array();
    $header[] = 'Authorization: Bearer ' . $personal_token;
    $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
    $header[] = 'timeout: 20';
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    $envatoRes = curl_exec($curl);
    curl_close($curl);
    $envatoRes = json_decode($envatoRes);
    // run and return the query result
    return $envatoRes;
}

#Generate KEY
function generateStrong($length = 4, $available_sets = 'ld'){
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghijklmnopqrstuvwxyz';

	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';

	$all = '';
	$password = '';
	foreach($sets as $set){
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}

	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];

	$password = str_shuffle($password);
    return $password;
}

#Generate API KEY
function generateStrongPassword(){
	$key = generateStrong(8)."-".generateStrong(4,"d")."-".generateStrong()."-".generateStrong()."-".generateStrong(12);
	return $key;
}

#Get BaseUrl
function getBaseUrl($array=false) {
    $protocol = "http";
    $host = "";
    $port = "";
    $dir = "";  

    // Get protocol
    if(array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] != "") {
        if($_SERVER["HTTPS"] == "on") { $protocol = "https"; }
        else { $protocol = "http"; }
    }
    else if(array_key_exists("REQUEST_SCHEME", $_SERVER) && $_SERVER["REQUEST_SCHEME"] != "") { 
      $protocol = $_SERVER["REQUEST_SCHEME"]; 
    }

    // Get host
    if(array_key_exists("HTTP_X_FORWARDED_HOST", $_SERVER) && $_SERVER["HTTP_X_FORWARDED_HOST"] != ""){ 
      $host = trim(end(explode(',', $_SERVER["HTTP_X_FORWARDED_HOST"]))); 
    }
    elseif(array_key_exists("SERVER_NAME", $_SERVER) && $_SERVER["SERVER_NAME"] != ""){ 
      $host = $_SERVER["SERVER_NAME"]; 
    }
    elseif(array_key_exists("HTTP_HOST", $_SERVER) && $_SERVER["HTTP_HOST"] != ""){ 
      $host = $_SERVER["HTTP_HOST"]; 
    }
    elseif(array_key_exists("SERVER_ADDR", $_SERVER) && $_SERVER["SERVER_ADDR"] != ""){ 
      $host = $_SERVER["SERVER_ADDR"]; 
    }

    // Get port
    if(array_key_exists("SERVER_PORT", $_SERVER) && $_SERVER["SERVER_PORT"] != ""){ 
      $port = $_SERVER["SERVER_PORT"]; 
    }
    elseif(stripos($host, ":") !== false){ 
      $port = substr($host, (stripos($host, ":")+1)); 
    }

    // Remove port from host
    $host = preg_replace("/:\d+$/", "", $host);

    // Get dir
    if(array_key_exists("SCRIPT_NAME", $_SERVER) && $_SERVER["SCRIPT_NAME"] != "") { $dir = $_SERVER["SCRIPT_NAME"]; }
    elseif(array_key_exists("PHP_SELF", $_SERVER) && $_SERVER["PHP_SELF"] != "") { $dir = $_SERVER["PHP_SELF"]; }
    elseif(array_key_exists("REQUEST_URI", $_SERVER) && $_SERVER["REQUEST_URI"] != "") { $dir = $_SERVER["REQUEST_URI"]; }
    // Shorten to main dir
    if(stripos($dir, "/") !== false) { $dir = substr($dir, 0, (strripos($dir, "/")+1)); }

    // Create return value
    if(!$array) {
    if($port == "80" || $port == "443" || $port == "") { $port = ""; }
    else { $port = ":".$port; } 
    return htmlspecialchars($protocol."://".$host.$port.$dir, ENT_QUOTES); 
    } else { return ["protocol" => $protocol, "host" => $host, "port" => $port, "dir" => $dir]; }
}
?>