<?php
    $page_title="API URL";
    include("includes/header.php");
    require("includes/lb_helper.php");
    
    $file_path = getBaseUrl();

?>
<link rel="stylesheet" type="text/css" href="assets/css/forms/custom-clipboard.css">
<div id="content" class="main-content">
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h3 class=""><?=$page_title ?></h3>
                <div style="border-bottom: 1px solid #f1f2f3; margin-top: 20px; margin-bottom: 20px;"></div>
                <form>
                    <div class="row">
                         <div class="col-md-12">
                            <div class="clipboard copy-txt">
                                <p class="mb-4">Link -> <span id="advanced-paragraph"><?php echo $file_path;?></span></p>
                                <a class="mb-1 btn btn-primary" href="javascript:;" data-clipboard-action="copy" data-clipboard-target="#advanced-paragraph"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>Copy API URL</a>
                             </br>
                             </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/custom-clipboard.js"></script>