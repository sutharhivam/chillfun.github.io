<?php
/**
 * Company : Nemosofts
 * Detailed : Software Development Company in Sri Lanka
 * Developer : Thivakaran
 * Contact : thivakaran829@gmail.com
 * Contact : nemosofts@gmail.com
 * Website : https://nemosofts.com
 */
session_start();
unset($_SESSION["adminuser"]);
session_destroy();
echo "<script language=javascript>location.href='index.php';</script>";
?>