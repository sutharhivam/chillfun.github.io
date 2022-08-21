<?php
include("../includes/product.php");
require("../includes/lb_helper.php");
$product_info = get_latest_version($item_id);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title><?php echo $product_info['product_name']; ?> - Activator</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://assets.nemosofts.com/Installer/bulma/css/bulma.min.css"/>
    <style type="text/css">
      body, html {
        background: #F4F5F7;
      }
    </style>
  </head>
  <body>
    <div class="container" style="padding-top: 20px;"> 
      <div class="section">
        <div class="columns is-centered">
          <div class="column is-two-fifths">
            <center>
              <h1 class="title" style="padding-top: 20px"><?php echo $product_info['product_name']; ?> - Activator</h1><br>
            </center>
            <div class="box">
             <?php
              $license_code = null;
              $client_name = null;
              if(!empty($_POST['license'])&&!empty($_POST['client'])){
                $license_code = strip_tags(trim($_POST["license"]));
                $client_name = strip_tags(trim($_POST["client"])); 
                $activate_response = activate_license($license_code, $client_name,$item_id);
                if(empty($activate_response)){
                  $msg = 'Server is unavailable.';
                }else{
                  $msg = $activate_response['message'];
                }
                if($activate_response['status'] != true){ ?>
                  <form action="index.php" method="POST">
                    <div class="notification is-danger is-light"><?php echo ucfirst($msg); ?></div>
                    <div class="field">
                    <label class="label">Purchase Code. (<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a>)</label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Enter your purchase/license code" name="license" required>
                      </div>
                    </div>
                    <div class="field">
                      <label class="label">Envato user name</label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Enter your name/envato username" name="client" required>
                      </div>
                    </div>
                    <div style='text-align: right;'>
                      <button type="submit" class="button is-link is-rounded">Activate</button>
                    </div>
                  </form><?php
                }else{ ?>
                <center>
                <div class="notification is-success is-light"><?php echo ucfirst($msg); ?></div>
                  <br>
                  <p><a class='button is-link' href='../index.php'>Login</a></p></strong>
                  <br>
                </center>
                  <?php 
                }
              }else{ ?>
                <form action="index.php" method="POST">
                  <div class="field">
                  <label class="label">Purchase Code. (<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a>)</label>
                    <div class="control">
                      <input class="input" type="text" placeholder="Enter your purchase/license code" name="license" required>
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Envato user name</label>
                    <div class="control">
                      <input class="input" type="text" placeholder="Enter your name/envato username" name="client" required>
                    </div>
                  </div>
                  <div style='text-align: right;'>
                    <button type="submit" class="button is-link is-rounded">Activate</button>
                  </div>
                </form><?php 
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content has-text-centered">
      <p>Copyright © <?php echo date('Y'); ?> nemosofts.com , All rights reserved.</p><br>
    </div>
  </body>
</html>