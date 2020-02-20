
<link href="<?=base_url()?>css/video-js.css" rel="stylesheet">
<script src="<?=base_url()?>js/videojs-ie8.min.js"></script>
<script src="<?=base_url()?>js/video.js"></script>

<?php
$page_title1 = explode('|', $page_title);
$page_title1 = $page_title1[0];

//print_r($news_single);

$id = $news_single['id'].substr(time(), -4);
$titles = $news_single['titles'];
$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
$cats = strtoupper($news_single['cats']);
$catsi = str_replace(" ", "-", strtolower($cats));
$links = base_url()."$catsi/news/$id/";

$files = $news_single['files'];
$files_img1 = "<p><img src='$files' alt='$titles' style='margin-bottom:15px;height:auto;width:auto;' /></p>";

$contents = nl2br($news_single['contents']);

//$contents = makeLinks2($contents);
//$contents = str_replace("<iframe", "<iframe style='display:none;'", $contents);

$views = $news_single['views'];
$date_posted = @date("D jS M, Y h:ia", strtotime($news_single['date_posted']));
$linksi = $news_single['links'];

if($linksi==""){ // for manual uploads
	$files = base_url()."news_files/$files";
	$files_img = "<p><img src='$files' alt='$titles' style='margin-bottom:15px;height:auto;width:auto;' /></p>";
	$contents = $files_img.$contents;
}

$media_img = base_url()."images/no-video.jpg";

$ext2 = pathinfo($files, PATHINFO_EXTENSION);
if($ext2=="mp4"){
	$files_img1 = "<video id='my_video_1' style='width:100%; cursor: pointer;' class='video-js vjs-default-skin myVideo1 videos2 vidss video_divs1' controls controlsList='nodownload' preload='auto' poster='$media_img' oncontextmenu='return false;'>
          <source src='$files' type='video/mp4'>
          <source src='$files' type='video/webm'>
          </video><br>";
//}else{
	//$files_img1 = $files_img;
}




// $google_ads = '<div id="adsense" style="display:none">
//     <script type="text/javascript">
//         google_ad_width = 300;
//         google_ad_height = 250;
//     </script><script data-ad-client="ca-pub-7956669216486808" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
// </div><div id="adslot"></div>';
?>



<section class="ptb-0 mt-sm-40">
	<div class="mb-10 brdr-ash-1 opacty-5"></div>
	<div class="container pr-5 pl-5 font-sm-11-5">
		<a class="mt-5" href="<?=base_url()?>"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-5 fa fa-chevron-right"></i></a>
		<a class="mt-10" href="#"><?=$page_cats?><i class="mlr-5 fa fa-chevron-right"></i></a>
		<a class="mt-5 color-ash" href="#">News</a>
	</div><!-- container -->
</section>


<section>
	<div class="container mt--30 pr-5 pl-5">
		<div class="row">
			<div class="col-md-12 col-lg-8">
				<h3 class="mb-5 lh-35 lh-sm-30 font-sm-20"><b><?=ucfirst($titles)?></b></h3>
				<ul class="list-li-mr-10 mb-15 font-sm-12">
					<li><b>Posted: </b><?=$date_posted?></li>
					<li><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$cats?></li>
					<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
				</ul>

				<div class="mt-10 font-sm-12 lh-sm-25 format_links">
					<?=$files_img1?>
					<!-- <?=$google_ads?> -->
					<?=$contents?>
				</div>
				
				<div class="float-left-right text-center mt-25 mt-sm-10">
			
					<?php
					$titles_1 = str_replace(array(" ","/","(",")","*","%","^","%","'","\"","@",",","#","$","=","+","|","\\"), array("_","_or_"), $titles);
					$titles_1 = str_replace("&", "and", $titles_1);

					$sell_title_whatsapp = str_replace("_", " ", $titles_1);
					$sTitle_whatsapp = ucwords($sell_title_whatsapp)."%0A%0A$links";
					?>

					<ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
						<li class="mr-10 ml-0"><b>Share</b></li>
						<li class="mobiles_view"><a href="whatsapp://send?text=<?=$sTitle_whatsapp?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>

						<li class="not_mobiles_view"><a href="https://web.whatsapp.com/send?text=<?=$sTitle_whatsapp?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>

						<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$links?>" target="_blank"><i class="fa fa-facebook"></i></a></li>

						<li><a href="https://twitter.com/share?text=<?=ucwords($sTitle_whatsapp)?>&url=<?=$links?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

					</ul>
					
				</div><!-- float-left-right -->
			
				<div class="brdr-ash-1 opacty-5"></div>
				
				<h4 class="p-title mt-50 font-sm-18"><b>RELATED TOPICS</b></h4>
				<div class="row">


					<?php
					if($related_post){
						$cnts=1;
						foreach($related_post as $post){
							$id = $post['id'].substr(time(), -4);
							$titles = $post['titles'];
							$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
							$cats = strtoupper($post['cats']);
							$cats = str_replace('SCI-TECH', "TECHNOLOGY", $cats);
							$catsi = str_replace(" ", "-", strtolower($cats));
							$links = base_url()."$catsi/news/$id/";
							$files = $post['files'];
							$views = $post['views'];
							$date_posted = @date("D jS M, Y h:ia", strtotime($post['date_posted']));
							$linksi = $post['links'];
							if($linksi=="") $files = base_url()."news_files/$files";
						?>
					
						<div class="col-sm-6">
							<img class="bg-grad-layer-6i" src="<?=$files?>" alt="<?=ucfirst($titles)?>">
							<h4 class="pt-10 font-12 font-sm-13-5"><a href="<?=$links?>"><b><?=ucfirst($titles)?></b></a></h4>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black"><a href="#" class="color-black"><b>Posted:</b></a>
								<?=$date_posted?></li>
								<li><i class="color-primary mr-5 font-12 fa fa-bolt"></i><span class="font-9 color-primary"><b><?=$cats?></b></span></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>

						<?php
						$cnts++;
						}
					}else{

						echo '<div class="col-md-12" style="font-size:20px; color:#666"><b>No related topics found for this.</b></div>';
					}

						?>
					
				</div>
				




			<div class="mt-40 comment_section">
				<h4 class="p-title"><b class="cmt_counts"><?=$cmt_count;?></b> Comments</h4>
				<input type="hidden" id="cmtcnt" value="<?=$cmt_count;?>">
				
				<div class="all_comments">
					<?php
			        if($results){
				        foreach ($results as $key) {
				        	$ids = $key['id'];
				            $names = $key['names'];
				            $message = $key['message'];
				            $created_at = $key['created_at'];
				            $created_at = @date("jS M, Y h:i a", strtotime($created_at));

				            $replies = $this->sql_models->fetchReplies($ids, 1);
				            $repCnt = $this->sql_models->fetchRepliesCount($ids);
				        ?>
							<div class="sided-70 mb-20">
								<div class="s-left rounded">
									<img class="bg-grad-layer-6i" src="<?=base_url()?>images/no_passport.jpg" alt="">
								</div>
								
								<div class="s-right ml-100 ml-xs-85">
									<h5><b><?=ucwords($names);?> </b> <span class="font-8 color-888"><?=$created_at;?></span></h5>
									<p class="mt-0 mb-5 font-10 lh-25 color-333"><?=ucfirst($message);?></p>
									<a class="btn-brdr-grey btn-b-sm plr-15 mt-5 link_reply" id="<?=$ids?>" href="javascript:;"><b>REPLY</b></a>
									<span class="reps1">Replies: <?=$repCnt?></span>
								</div>
							</div>

							<?php
					        if($replies){
						        foreach ($replies as $key) {
						        	$ids1 = $key['id'];
						            $names1 = $key['names'];
						            $message1 = $key['message'];
						            $created_at1 = $key['created_at'];
						            $created_at1 = @date("jS M, Y h:i a", strtotime($created_at1));
						    		?>
										<div class="sided-70 onereply ml-100 ml-xs-20 mb-30">
											<div class="s-left s-left2 rounded">
												<img class="bg-grad-layer-6i" src="<?=base_url()?>images/no_passport.jpg" alt="">
											</div>
											
											<div class="s-right ml-80 ml-xs-85">
												<h5><b><?=ucwords($names1);?> </b> <span class="font-8 color-888"><?=$created_at1;?></span></h5>
												<p class="mtb-5 font-9 lh-20 color-333"><?=ucfirst($message1);?></p>
											</div>
										</div>
								<?php
		                		}
	        				}
	        				?>

					<?php
	                	}
        			}else{
        				echo "<p style='text-align:center;'>No comment yet! Be the first to post a comment.</p>";
        			}
        			?>

				</div>
				<div style="clear: both;"></div>
				<br>
				
				<div class="leave_comment">
					<h4 class="p-title mt-10"><b>LEAVE A COMMENT</b></h4>
					<form action="javascript:;" class="form-block form-plr-15 form-h-45 form-mb-20 include_radius form-brdr-lite-white_ mb-md-50" id="form_comments" autocomplete="off">

						<input type="hidden" name="txtreply_id" id="txtreply_id">
						<input type="hidden" name="txtblogid" id="txtblogid" value="<?=$newsid;?>">

						<input type="text" style="text-transform: capitalize; color: #666" placeholder="Your Name*:" name="txtcname" value="<?=$txtcname?>">
						<input type="email" placeholder="Your Email*:" style="color: #666" name="txtcemail" value="<?=$txtcemail?>">
						
						<p style="margin: -9px 0 11px 0; font-size: 14px; color: #444; font-weight: normal;">Your email will not be visible to public</p>

						<textarea class="ptb-10" placeholder="Your Comment" name="txtcmessage" id="txtcmessage"></textarea>
						<button class="btn-fill-primary plr-30 mt-20 post_comment" type="button"><b>LEAVE A COMMENT</b></button>
					</form>
					<div class="alert alert-danger alert_msg alert_msg1"></div>
				</div>
			</div>
				

			</div><!-- col-md-9 -->