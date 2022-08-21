<?php
    /**
    * Company : Nemosofts
    * Detailed : Software Development Company in Sri Lanka
    * Developer : Thivakaran
    * Contact : thivakaran829@gmail.com
    * Contact : nemosofts@gmail.com
    * Website : https://nemosofts.com
    */
 
	if(!isset($_SESSION['admin_name'])){
		session_destroy();
		header( "Location:index.php");
		exit;
	}
?>