<?php
    $ProfileStatus = PROFILE_STATUS;
    if($ProfileStatus == "0"){
        session_destroy();
		header( "Location:index.php");
		exit;
    }
?>