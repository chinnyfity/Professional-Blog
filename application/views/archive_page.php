
<?php
$page_title1 = explode('|', $page_title);
$page_title1 = trim($page_title1[0]);

$page_title1 = str_replace(array("_", "-"), " ", $page_title1);
?>

<input type="hidden" id="txtpg_name" value="<?=strtolower($page_title1)?>">
<input type="hidden" id="txtnewscnt" value="<?=$newsCatCount?>">

<section class="ptb-0 mt-sm-40">
	<div class="mb-10 brdr-ash-1 opacty-5"></div>
	<div class="container pr-5 pl-5">
		<a class="mt-5" href="<?=base_url()?>"><i class="mr-5 fa fa-home"></i>Home<i class="mlr-5 fa fa-chevron-right"></i></a>
		<a class="mt-5 color-888" href="#"><?=ucwords($page_title1)?></a>
	</div>
</section>

<?php
if(strlen($page_title1)>20)
	$myfontsize = "font-14 font-sm-16";
else
	$myfontsize = "font-16 font-sm-20";

?>

<section>
	<div class="container mt--30 pr-5 pl-5">
		<div class="row">
			<div class="col-md-12 col-lg-8">
				<h4 class="p-title <?=$myfontsize?>"><b><?=strtoupper($page_title1)?></b></h4>
				<div class="row" id="ajax_table_bma">
					<?php
					if($fetchNews):
						$cnts=1;
						foreach ($fetchNews as $post):
							$id = $post['id'].substr(time(), -4);
							$titles = $post['titles'];
							$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
							$cats = strtoupper($post['cats']);
							$catsi = str_replace(" ", "-", strtolower($cats));
    						$links = base_url()."$catsi/news/$id/";
							$files = $post['files'];
							$views = $post['views'];
							$date_posted = @date("D jS M, Y h:ia", strtotime($post['date_posted']));
							$linksi = $post['links'];
    						if($linksi=="") $files = base_url()."news_files/$files";

    						$ext2 = pathinfo($files, PATHINFO_EXTENSION);
    						if($ext2=="mp4"){
    							$files1 = base_url()."images/no-video.jpg";
    						}else{
    							$files1 = $files;
    						}
						
						?>
					<div class="col-sm-6 mt-20">
						<a href="<?=$links?>">
						<img class="bg-grad-layer-6i" src="<?=$files1?>" alt="">
						<h4 class="pt-5 font-12 lh-25 lh-sm-23 font-sm-16"><b><?=ucfirst($titles)?></b></h4></a>
						<ul class="list-li-mr-10 pt-0 mb-25 font-sm-12">
							<li class="color-lite-black color-black"><b>Posted:</b>
							<?=$date_posted?></li>
							<li><i class="color-primary mr-5 font-10 fa fa-bolt"></i><?=$cats?></li>
							<li><i class="color-primary mr-5 font-11 fa fa-eye"></i><?=$views?></li>
						</ul>
					</div>

					<?php
						$cnts++;
						endforeach;
					endif;
					?>
				</div>
				
				<a class="dplay-block btn-brdr-primary mt-20 mb-sm-20 load_more_bt col-lg-11 col-md-8" style="text-align: center; margin: 0 auto;" data-val = "1" id="load_more_mba" href="javascript:;"><b>LOAD MORE</b></a>

				<a class="dplay-block btn-brdr-primary mt-20 mb-sm-80 load_more_bt col-lg-11 col-md-8" id="load_more_mba1" style="color:#999; display:none; border:1px solid #ccc; background: #eee; text-align: center; margin: 0 auto;" href="javascript:;">
					<b><i>Loading...</i> <img src="<?=base_url()?>images/ajax-loader.gif" style="width: 18px !important"></b>
				</a>

			</div>