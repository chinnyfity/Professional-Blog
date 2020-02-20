<?php
$page_name2 = str_replace('_', " ", $page_title);

//echo phpinfo();
//exit;
?>




<div id="page-wrapper" class="page-wrapper1">
    <div class="col-sm-12 float_left" style="padding:0 0 0 8px">
        <h1 class="page-header">
        <?php
        if($page_name == "")
            echo "Administrator";
        else
            echo $page_name2;
        ?>
        </h1>
    </div>

    <!-- <div class="col-sm-6 float_right" style="padding:0">
        <h1 class="page-header">
            
        </h1>
    </div> -->
</div>


<p style="text-align:center; font-size:16px;">
    <?php 
        // $url_seg = $this->uri->segment(3);
        // if($url_seg=="current")
        //     echo "Viewing current cart between interval of 5 days.";
        // else if($url_seg=="unapproved")
        //     echo "Viewing Unapproved Products";
    ?>
</p>


<div class="modal fade" id="delete_dv" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
            </div>

            <div class="modal-body">
                <input type="hidden" id="txtall_id">
                <div class="alert alert-danger" style="font-size:15px; display: block;"><span class="fa fa-warning"></span> Are you sure you want to delete this?</div>
            </div>

            <input type="hidden" id="txt_dbase_table" value="<?=$page_name;?>">

            <div class="modal-footer ">
                <button type="button" class="btn btn-success cmd_remove_adm" data-dismiss="modal" ><span class="fa fa-trash-o"></span>&nbsp;Yes</button>
                <button type="button" class="btn btn-default" id="cmd_close_del_" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;No</button>
            </div>
        </div>
    </div>
</div>


<?php 
if($page_name == ""){ 
?>

<div id="page-wrapper" class="small_box">

    <div class="row">
        <!--quick info section -->
        <div class="col-lg-3 col-sm-6 boxes">
            <div class="alert alert-danger text-center">
                <i class="fa fa-edit fa-3x"></i>&nbsp;Total of <b><?=@number_format($news);?></b> News Posts
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 boxes">
            <div class="alert alert-success text-center">
                <i class="fa  fa-tachometer fa-3x"></i>&nbsp;<b><?=@number_format($adverts);?> </b> Sponsored Adverts Uploaded
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 boxes" style="margin-top: -10px;">
            <div class="alert alert-info text-center">
                <i class="fa fa-eye fa-3x"></i><b><?=@number_format($webviews);?></b> Website Views

            </div>
        </div>
    
        <div class="col-lg-3 col-sm-6 boxes" style="margin-top: -10px;">
            <div class="alert alert-success text-center">
                <i class="fa fa-tachometer fa-3x"></i>Next News Update: Every 1 hour
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 boxes" style="margin-top: -10px;">
            <div class="alert alert-info text-center">
                <div class='widget Label mt-10 mb-40 flag_counters'>
                    <a href="https://info.flagcounter.com/bGOY"><img src="https://s11.flagcounter.com/countxl/bGOY/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_18/viewers_Site+Visitors/labels_1/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> News Updates (Last 8 News Updates)
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12_">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped tbl_color">
                                    <thead>
                                        <tr>
                                            <th>Titles</th>
                                            <th>Category</th>
                                            <th>Date Uploaded</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php
                                        $j=1;
                                        if(!empty($fetchLast10News)): foreach($fetchLast10News as $post): ?>
                                        <?php
                                            $titles = $post['titles'];
                                            $cats = $post['cats'];
                                            $dates = $post['date_posted'];
                                            $dates = date("D jS M Y h:ia", strtotime($dates));
                                        ?>
                                        <tr>
                                            <td><?=ucfirst($titles);?></td>
                                            <td><?=$cats;?></td>
                                            <td><?=$dates;?></td>
                                        </tr>
                                    <?php $j++; endforeach; else: ?>
                                    <tr><td colspan="6" style="text-align:center;">No news yet!</td></tr>
                                    <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Sponsored Ads (Last 4 sponsored Ads)
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12_">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped tbl_color">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Expiry</th>
                                            <th>Duration</th>
                                            <th>Date Uploaded</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php
                                        $j=1;
                                        if(!empty($adverts1)): foreach($adverts1 as $post): ?>
                                        <?php
                                            $images = $post['image'];
                                            $expiry = $post['expiry'];
                                            $duration = $post['durations'];
                                            $created_at = $post['created_at'];
                                            $expiry = date("D jS M Y h:ia", $expiry);
                                            $dates = date("D jS M Y h:ia", strtotime($created_at));

                                            $files = "";
                                            if($images!="")
                                                $files = base_url()."sponsoredads/$images";
                                            $files = "<img src='$files' style='width:120px;'>";

                                            if($expiry <= 0){
                                                $expiry1 = "<i style='color:#777; font-weight:normal'>No Expiry</i>";
                                                $duration1 = "----";
                                            }else{
                                                if($expiry < time())
                                                    $expiry1 = "<label style='color:red; font-weight:normal'>(Expired)</label>";
                                                else
                                                    $expiry1 = "(".date("D jS M, Y h:ia", $expiry).")";
                                                $duration1 = $duration;
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td><?=$files;?></td>
                                            <td><?=$expiry1;?></td>
                                            <td><?=$duration1;?></td>
                                            <td><?=$dates;?></td>
                                        </tr>
                                    <?php $j++; endforeach; else: ?>
                                    <tr><td colspan="6" style="text-align:center;">No members yet!</td></tr>
                                    <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

<br><br>
</div>


<?php } ?>





<?php if($page_name == "view_advert"){ ?>
    <div class="content mt-3" id="page-wrapper" style="">
        <div class="col-lg-12 container containerx house_tbl_">
            <div class="card hide_overflow_ _hide_overflow1" style="overflow:hiddens;">
                <div class="card-body all_tables">
                    <table id="adverts" class="table table-striped table-bordered display responsive wrap all_tables1_" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Uploaded</th>
                            <th>Links</th>
                            <th>Expiry</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
 
                        </tbody>

                    </table>
                </div>
            </div>
            <br><br><br><br>
        </div>

        
    </div>

<?php } ?>





<?php if($page_name == "viewNews"){ ?>
    <div class="content mt-3" id="page-wrapper" style="">
        <div class="col-lg-12 container containerx house_tbl_">
            <div class="card hide_overflow_ _hide_overflow1" style="overflow:hiddens;">
                <div class="card-body all_tables">
                    <table id="all_blogs" class="table table-striped table-bordered display responsive wrap all_tables1_" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Views</th>
                            <th>Date Uploaded</th>
                            <th class="none">Links</th>
                            <th class="none">Content</th>
                            <th class="none">Media</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
 
                        </tbody>

                    </table>
                </div>
            </div>
            <br><br><br><br>
        </div>
    </div>

<?php } ?>




<?php if($page_name == "uploadnews" || $page_name == "edit_news"){ ?>
    <div class="content mt-3 container" id="page-wrapper">
        <div class="col-md-12 col-sm-10 nopad1">
            <p class="inner_links"><a href="<?=base_url();?>admin/viewNews/">Click To View NewsUpdates</a></p>
            <div class="card col-md-8 nopad" style="border:1px #ccc solid !important;">
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                                <?php
                                //echo md5(38);
                                if($url_id!="")
                                echo '<h3 class="text-center ttl"><b>Update This Post</b></h3>';
                                else
                                echo '<h3 class="text-center"><b>Create A New Update Post</b></h3>';
                                ?>
                                <p>All news contents/media uploaded here will be seen on the news update page
                                </p>
                            </div>
                            <hr>
                            <?php
                                if($url_id!=""){
                                    $id1 = md5($getId['id']);
                                    $titles = $getId['titles'];
                                    $cats = $getId['cats'];
                                    $files = $getId['files'];
                                    $contents = $getId['contents'];
                                    //$contents = str_replace("\"", "m", $contents);
                                    $captions1 = "Update News";
                                    //$getFiles = $this->sql_models->getFiles('blog_media', $rands);

                                    $files1 = "<div class='update_imgs1 update_imgs2$id1'>
                                                <img src='".base_url()."news_files/$files' id='im10'>
                                                <font class='delete_imgs' id='delete_imgs$id1' files='$files' ids='$id1'>Delete</font>
                                            </div>";
                                }else{
                                    $id1="";$cats="";$files="";$files1="";$contents="";$titles="";
                                    $captions1 = "Upload News";
                                }
                            ?>
                                
                                <div class="first_create_form" style="display:nones;">
                                    <?php //echo form_open('', array('autocomplete'=>'off', 'id'=>'create_evts')); ?>
                                    <?php echo form_open_multipart('', array('class'=>'uploadnews', 'autocomplete'=>'off')); ?>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select id="txtcats" name="txtcats">
                                                <option value="" <?php if($cats=="") echo "selected"; ?> >-Select Category-</option>

                                                <?php
                                                if(!empty($cate)): foreach($cate as $post):
                                                $mycats = $post['cats'];
                                                ?>
                                                <option value="<?=$mycats?>" <?php if($cats==$mycats) echo "selected"; ?> ><?=ucwords($mycats)?></option>
                                                <?php
                                                endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Title</label>
                                            <input type="text" value="<?=$titles;?>" placeholder="Enter title of event" name="txttitle" id="txttitle" class="form-control" style="text-transform:capitalize;">
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-name" class="control-label mb-1">Contents</label>
                                            <div id="editor" name="editor" style="height: 300px;">
                                                <?=$contents;?>
                                            </div>
                                            <textarea name="txtdescrip" style="display: none;" id="txtdescrip"><?=$contents;?></textarea>
                                        </div>

                                        <div class="form-group for_photos">
                                            <input id="former_file_ph" name="former_file_ph" value="<?=$files; ?>" class="form-control" style="display:none;" />

                                            <?=$files1?>
                                            
                                            <div style="clear: both;"></div>
                                            <label for="cc-number" class="control-label mb-1">Upload Media</label>
                                            <input type="file" name="blog_img" id="blog_img" style="padding:4px; font-size:16px;" />
                                            <p>Accepted formats: jpg, png, mp4. Max: 50MB</p>
                                        </div>

                                        <input type="hidden" name="blogid" id="blogid" value="<?php echo $id1; ?>" />

                                        <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
                                            <div style="text-align:center; margin-top:1em;" id="buttons1">
                                                <input type="submit" value="<?=$captions1;?>" actid="<?=$id1;?>" id="cmd_upload_media" class="btn btn-lg btn-info btn-block inlines_">
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div class="alert alert-danger alert_msg"></div>
                                    <?php echo form_close(); ?>
                                </div>



                                <div class="third_create_form" style="display:none; text-align:center;">
                                    <p>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                          <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                          <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                        </svg>
                                    </p>
                                    <?php if($url_id!=""){ ?>
                                        <p style="font-size:20px; color:#093;"><b>NewsUpdates post has been updated successfully</b></p>
                                    <?php }else{ ?>
                                        <p style="font-size:20px; color:#093;"><b>NewsUpdates post has been uploaded successfully</b></p>
                                    <?php } ?>

                                    <p style="font-size:16px; color:#555;">
                                        This will reflect immediately and can be seen on the platform on the platform
                                    </p>

                                    <div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
                                        <div style="text-align:center; margin-top:1em;" id="buttons1">
                                            <input type="button" value="Done" id="cmd_goto_firstform" class="btn btn-lg btn-info btn-block">
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>

                                <br><br>

                        </div>
                    </div>

                </div>
            </div> 

        </div>

        <div style="clear:both;"></div>
        <br><br><br><br>
    </div>
    

<?php } ?>




<?php if($page_name == "upload_advert" || $page_name == "edit_advert"){ ?>
    <div class="content mt-3 container" id="page-wrapper">
        <div class="col-md-9 col-sm-10 nopad1">
            <p class="inner_links"><a href="<?=base_url();?>admin/view_advert/">Click To View/Edit Advert</a></p>
            <div class="card col-md-8 nopad" style="border:1px #ccc solid !important;">
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                                <?php
                                    if($getId!="")
                                    echo '<h3 class="text-center ttl"><b>Update This Advert</b></h3>';
                                    else
                                    echo '<h3 class="text-center"><b>Upload A Sponsored Advert</b></h3>';
                                ?>

                            </div>
                            <hr>
                            <?php
                            echo form_open('', array('autocomplete'=>'off', 'id'=>'upload_adv_form'));
                                //$new1 = "";
                                if($getId!=""){
                                    $id1 = md5($getId['id']);
                                    $images = $getId['image'];
                                    $links = $getId['links'];
                                    $expiry = $getId['expiry'];
                                    $duration = $getId['durations'];
                                    $created_at = $getId['created_at'];
                                    $captions1 = "Update Ad";

                                    if($expiry <= 0)
                                        $expiry1 = "<i style='color:#777; font-weight:normal'>No Expiry</i>";
                                    else{
                                        if($expiry < time())
                                            $expiry1 = "<label style='color:red; font-weight:normal'>(Expired)</label>";
                                        else
                                            $expiry1 = "(".date("D jS M, Y h:ia", $expiry).")";
                                    }
                                    
                                }else{
                                    $id1="";$images="";$banner="";$expiry="";$created_at=""; $expiry1="";
                                    $duration=""; $links=""; $captions1 = "Upload Advert";
                                }

                            ?>
                                
                                <div class="first_create_form" style="display:nones;">

                                    <div class="form-group for_photos">
                                        <input id="former_file_ph" name="former_file_ph" value="<?php echo $images; ?>" class="form-control" style="display:none;" />
                                        <?php
                                        if($url_id!=""){
                                            echo "<p class='update_imgs1'>";
                                            if($images=='')
                                            echo "";
                                            else
                                            echo "<img src='".base_url()."sponsoredads/$images' src1='".base_url()."img/ads-banner.jpg' id='im10'>";
                                            echo "</p><br>";
                                        }
                                        ?>
                                        <div style="clear: both;"></div>
                                        <label for="cc-number" class="control-label mb-1">Upload Image</label>
                                        <input type="file" name="adv_image" id="adv_image" style="padding:4px; font-size:16px; display:nones" />
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="cc-payment" class="control-label mb-1">
                                            Link to advert
                                        </label>
                                        <input type="text" value="<?=$links;?>" placeholder="Enter link for this Ad" name="txtlinks" id="txtlinks" class="form-control" style="text-transform: lowercase;">
                                        
                                    </div>


                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="cc-payment" class="control-label mb-1">
                                            Appear On
                                        </label>
                                        <select id="txtpositn" name="txtpositn">
                                            <option value="" <?php if($duration=="") echo "selected"; ?> >-Select Position-</option>
                                            <option value="top" <?php if($duration=="top") echo "selected"; ?> >Top of Page</option>
                                            <option value="mid" <?php if($duration=="mid") echo "selected"; ?> >Middle of Page</option>
                                            <option value="fot" <?php if($duration=="fot") echo "selected"; ?> >Footer</option>
                                            <option value="side" <?php if($duration=="side") echo "selected"; ?> >Side of Page</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="cc-payment" class="control-label mb-1">
                                            Expiry Date <?=$expiry1;?>
                                        </label>
                                        <select id="txtexp" name="txtexp">
                                            <option value="noexp" <?php if($duration=="noexp") echo "selected"; ?> >No Expiry</option>
                                            <option value="3 days" <?php if($duration=="3 days") echo "selected"; ?> >3 Days</option>
                                            <option value="7 days" <?php if($duration=="7 days") echo "selected"; ?> >7 Days</option>
                                            <option value="2 weeks" <?php if($duration=="2 weeks") echo "selected"; ?> >2 weeks</option>
                                            <option value="1 month" <?php if($duration=="1 month") echo "selected"; ?> >1 month</option>
                                        </select>
                                    </div>

                                    
                                    <div style="clear:both"></div>
                                    <input type="hidden" name="adv_id" id="adv_id" value="<?php echo $id1; ?>" />


                                    <div class="col-sm-offset-3 col-sm-6">
                                        <div style="text-align:center; margin-top:1em;" id="buttons1">
                                            <input type="submit" value="<?=$captions1;?>" actid="<?=$id1;?>" id="cmd_upload_ad" class="btn btn-lg btn-info btn-block inlines_">
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="alert alert-danger alert_msg"></div>
                                </div>



                                <div class="success_form" style="display:none; text-align:center;">
                                    <p>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                          <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                          <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                        </svg>
                                    </p>

                                    <?php if($getId!=""){ ?>
                                        <p style="font-size:20px; color:#093;"><b>Advert Updated Successfully</b></p>
                                        <p style="font-size:16px; color:#555;">Changes have been made. Make changes again or click the <b>view button</b> to view records.
                                        
                                    <?php }else{ ?>
                                        <p style="font-size:20px; color:#093;"><b>Ad Uploaded Successfully</b></p>
                                        <p style="font-size:16px; color:#555;">It will be seen immediately on the platform. You can also edit or delete if there's any mistake
                                        </p>
                                    <?php } ?>

                                    <div class="col-lg-offset-4 col-lg-4">
                                        <div style="text-align:center; margin-top:1em;" id="buttons1">
                                            <input type="button" value="Go Back" id="cmd_back_tofirst" class="btn btn-lg btn-info btn-block">
                                        </div>
                                        <p style="margin: 1.2em 0 0 0;">
                                            <span class="view_changes_ad" style="cursor: pointer;">View Changes</span>
                                        </p>
                                    </div>

                                    <div style="clear:both"></div>
                                </div>

                                <br><br>
                            <?php echo form_close(); ?>

                        </div>
                    </div>

                </div>
            </div> 

        </div>

        <div style="clear:both;"></div>
        <br><br><br><br>
    </div>
<?php } ?>





<?php if($page_name == "settings"){ ?>
    <div class="content mt-3 container" id="page-wrapper" style="">
    

        <div class="col-lg-4 col-sm-7" style="border:1px #ccc solid;">
            <div class="card">
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center">Update your password</h3>
                            </div>
                            <hr>
                            <?php
                                echo form_open('', array('autocomplete'=>'off', 'id'=>'edit_pass'));
                            ?>
                            <!-- <input type="hidden" value="<?=$this->admin_type;?>" name="admin_type"> -->

                                
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="txtpass1" type="password" class="form-control" placeholder="Enter your old password">
                                </div>
                                <div class="form-group">
                                    <label for="cc-name" class="control-label mb-1">New Password</label>
                                    <input id="cc-name" name="txtpass2" type="password" class="form-control cc-name" placeholder="Enter your new password">
                                </div>
                                <div class="form-group">
                                    <label for="cc-number" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-number" name="txtpass3" type="password" class="form-control cc-number" placeholder="Confirm your new password">
                                </div>
                                <div>
                                    <div style="text-align:center; margin-top:2em;" id="buttons1">
                                        <input type="button" value="Update Password" id="cmd_update_pass_admin" class="btn btn-lg btn-info btn-block">
                                    </div>
                                </div>
                                <div class="alert alert-danger alert_msg1"></div>
                                <br><br>
                            <?php echo form_close(); ?>

                        </div>
                    </div>

                </div>
            </div> 
        </div>

        <div style="clear:both;"></div>
        <br><br>
    </div>
    

<?php } ?>

    </div><!-- /#right-panel -->
    <!-- <input type="hidden" id="txturl1" name="txturl1" value="<?=$url_id;?>" /> -->
    
    

    <script src="<?=base_url();?>assets/js/jquery-1.12.4.js" type="text/javascript"></script>

    <script src="<?=base_url();?>assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url();?>assets/plugins/pace/pace.js"></script>
    <script src="<?=base_url();?>assets/scripts/siminta.js"></script>
    
    <script src="<?=base_url();?>assets_texteditor/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins.js"></script>

    <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/js/fnReloadAjax.js"></script>
    <script src="<?=base_url();?>assets/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/responsive.bootstrap.min.js" type="text/javascript"></script>

    <script src="<?=base_url();?>js/jquery.nice-select.min.js"></script>
    <script src="<?=base_url();?>js/jscripts.js"></script>
    
    
    <script src="<?=base_url();?>assets_texteditor/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/select2/dist/js/select2.min.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="<?=base_url();?>assets_texteditor/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    



    <script src="<?=base_url();?>assets_texteditor/libs/quill/dist/quill.min.js"></script>
    <script>
        
        $(".select2").select2();
        $('.demo').each(function() {
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        var toolbarOptions = [
          ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          //['blockquote', 'code-block'],

          //[{ 'header': 1 }, { 'header': 2 }],               // custom button values
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
          //[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
          //[{ 'direction': 'rtl' }],                         // text direction

          [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
          //[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

          [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean']                                         // remove formatting button
        ];

        var quill = new Quill('#editor', {
            // modules: {
            //     toolbar: toolbarOptions
            // },
            theme: 'snow'
        });
    </script>


    <script>
        var site_urls = $('#txtsite_url').val();
        var txt_pagename = $('#txt_pagename').val();
        var txt_pagename1 = $('#txt_pagename1').val();
        var txtqry = $('#txtqry').val();
        var txturl1 = $('#txturl1').val();
        //alert(txt_pagename)
        //alert(txtqry)

        // if(txt_pagename == "view_scholarship"){
        //     if(txtqry=="")
        //         var urls = site_urls+"admin/fetch_scholarship";
        //     else
        //         var urls = site_urls+"admin/fetch_scholarship/"+txtqry+"/";

        if(txt_pagename == "view_advert")
            var urls = site_urls+"admin/fetch_adverts";

        else if(txt_pagename == "viewNews")
            var urls = site_urls+"admin/fetch_all_blogs";

        var dataTable = $('#all_blogs, #adverts').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "order":[],
            "ajax":{
                url : urls,
                type: "post"
            },
            "columnDefs":[
            {
                "target":[0,3,4],
                "orderable": false
            }
            ]
        });

        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
    </script>


</body>

</html>
