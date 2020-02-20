<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>images/logofav.png">
    <title><?=$page_title;?> | SkyNewsNG</title>


    <link href="<?=base_url();?>assets/css2/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="<?=base_url();?>css/bootstrap-3.min.css" rel="stylesheet"> <!--This is the main thing that causes the table to have good looking-->
    <link href='<?=base_url();?>assets/css2/responsive.bootstrap.min.css' rel='stylesheet' type='text/css'>
    
    <link href="<?=base_url();?>assets/css2/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="<?=base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?=base_url();?>assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />
    <link href="<?=base_url();?>assets/css/main-style.css" rel="stylesheet" />

    <link href="<?=base_url();?>css/style1.css" rel="stylesheet">
    <link href="<?=base_url();?>css/elegant_font/elegant_font.min.css" rel="stylesheet">

    <script src="<?=base_url();?>js/jquery-1.7.1.min.js"></script>
    <script src="<?=base_url();?>js/jscripts.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets_texteditor/libs/quill/dist/quill.snow.css">

    <link href="<?=base_url();?>css/select2.min.css" rel="stylesheet" />
    <script src="<?=base_url();?>js/select2.min.js"></script>


   </head>

<?php $url_seg = $this->uri->segment(3); ?>
<body style="background:#fff;">
<input type="hidden" value="<?=base_url();?>" id="txtsite_url">
<input type="hidden" value="<?php echo $page_name; ?>" id="txt_pagename">
<input type="hidden" value="<?php echo $page_title; ?>" id="txt_pagename1">
<input type="hidden" value="<?php echo $url_seg; ?>" id="txtqry">
    <!--  wrapper -->
    <div id="wrapper">

    
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar_toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url();?>">
                    <img src="<?=base_url();?>images/logo-white.png" alt="" />
                </a>


                <ul class="nav_ navbar-top-links_ navbar-right_ user_acct">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-2x"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?=base_url();?>admin/settings/">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=base_url();?>admin/logout/">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                
            </div>

        </nav>



        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <?php $pics1 = base_url()."img/no_passport.jpg"; ?>
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-info">
                                <div>&nbsp;Admin</div>
                                <div class="user-text-online">
                                    <span class="user-circle-online "></span>&nbsp;
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li <?php if($page_name=="") echo 'class="active"'; ?>><a href="<?=base_url();?>admin/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

                    <li <?php if($page_name=="uploadnews") echo 'class="active"'; ?>><a href="<?=base_url();?>admin/uploadnews/"><i class="fa fa-edit fa-fw"></i> Upload News</a></li>

                    <li <?php if($page_name=="upload_advert") echo 'class="active"'; ?>><a href="<?=base_url();?>admin/upload_advert/"><i class="fa fa-edit fa-fw"></i> Upload Advert</a></li>

                    <li <?php if($page_name=="settings") echo 'class="active"'; ?>><a href="<?=base_url();?>admin/settings/"><i class="fa fa-gears fa-fw"></i> Settings</a></li>

                    <li><a href="<?=base_url();?>admin/logout/"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
                    
                </ul>
            </div>
        </nav>
        <div style="clear:both;"></div>

    