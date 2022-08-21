<?php
require("../includes/lb_helper.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>MyScript - Deactivator</title>
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
              <h1 class="title" style="padding-top: 20px">MyScript Deactivator</h1><br>
            </center>
            <div class="box">
              <article class="message is-success">
                <div class="message-body">
                  Click on deactivate license to deactivate and remove the currently installed license from this installation, So that you can activate the same license on some other domain.
                </div>
              </article>
              <?php
                if(!empty($_POST)){
                    $deactivate_password = strip_tags(trim($_POST["pass"]));
                    $deactivate_response = deactivate_license($deactivate_password);
                    if(empty($deactivate_response)){
                        $msg='Server is unavailable.';
                    }else{
                        $msg=$deactivate_response['message'];
                    }
                    if($deactivate_response['status'] != true){ ?>
                        <form action="index.php" method="POST">
                          <div class="notification is-danger is-light"><?php echo ucfirst($msg); ?></div>
                          <input type="hidden" name="something">
                          <center>
                            <button type="submit" class="button is-danger">Deactivate License</button>
                          </center>
                        </form><?php
                    }else{ ?>
                        <div class="notification is-success is-light"><?php echo ucfirst($msg); ?></div><?php 
                    }
                }else{ ?>
                  <form action="index.php" method="POST">
                    <input type="hidden" name="something">
                        <div class="field">
                            <label class="label">Deactivate Password</label>
                            <div class="control">
                              <input class="input" type="text" id="pass" placeholder="enter your deactivate password" name="pass">
                            </div>
                        </div>
                    <center>
                      <button type="submit" class="button is-danger is-rounded">Deactivate License</button>
                    </center>
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