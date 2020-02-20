<?php
/*
//$feed_url = "http://saharareporters.com/feeds/latest/feed";
//$feed_url = "https://www.latestnigeriannews.com/feed/allnews/";
//$feed_url = "http://www.nigerianmonitor.com/feed/"; //good
//$feed_url = "https://www.africanews.com/feed"; // good
//$feed_url = "https://www.naijanews.com/feed/"; //better
//$feed_url = "https://www.naijanews.com/feed/";

$feed_url = "https://www.bellanaija.com/feed/"; // perfect

//$feed_url = "https://www.thisdaylive.com/index.php/feed/";


$rss = new DOMDocument();
$rss->load($feed_url);


$x=1;
foreach ($rss->getElementsByTagName('item') as $node) { //informationng
    $item = array (
        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
        'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        'image_uri' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
        //'image_uri' => $node->getElementsByTagName('enclosure')->item(0)->getAttribute('url'),
        'cats' => $node->getElementsByTagName('category')->item(0)->nodeValue,
    );
    $image_uri = $item['image_uri'];
    $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image_uri, $image);
    $immg1 = @$image['src'];
    $immg1 = str_replace("//", "", $immg1);

    $description = $item['content'];
    $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');

    if($x <= 20){
    	//if($item['cats']!="Africa" && $item['cats']!="Sports" && $item['cats']!="In Pictures" && $item['cats']!="Local" && $item['cats']!="World News" && $item['cats']!="Politics"){

	        $title = str_replace(' & ', ' &amp; ', $item['title']);
	        $content = $item['desc'];
	        $link = $item['link'];
	        $date = $item['date'];
	        $cats = $item['cats'];

	        //$data[$x]['session1']       = $session1;
	        $data[$x]['titles']         = $title;
	        $data[$x]['cats']           = $cats;
	        $data[$x]['links']          = $link;
	        $data[$x]['files']          = $immg1;
	        $data[$x]['contents']       = $description;
	        //$data[$x]['views']          = 0;
	        //$data[$x]['date_posted']    = $date;
	    //}
    }
        
    $x++;
}

print_r($data);
exit; */



$item_title="Loading data...";$item_link="";$news_img="";$item_views="";$item_date="Loading data...";$item_cat="Loading data...";

$item_title1=$item_title; $item_link1=$item_link; $news_img1="";$item_date1=$item_date; $item_cat1=$item_cat;

$item_title_sp=$item_title; $item_link_sp=$item_link; $news_img_sp="";$item_date_sp=$item_date; $item_cat_sp=$item_cat; $item_views_sp="";

$item_title_bs=$item_title; $item_link_bs=$item_link; $news_img_bs="";$item_date_bs=$item_date; $item_cat_bs=$item_cat; $item_views_bs="";

$item_title_ls=$item_title; $item_link_ls=$item_link; $news_img_ls="";$item_date_ls=$item_date; $item_cat_ls=$item_cat; $item_views_ls="";

$item_title_st=$item_title; $item_link_st=$item_link; $news_img_st="";$item_date_st=$item_date; $item_cat_st=$item_cat; $item_views_st=""; 

//echo time();

if($recent_news){
	$item_id = $recent_news[0]['id'].substr(time(), -4);
    $item_title = $recent_news[0]['titles'];
    $item_title_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title));
    $item_cat = $recent_news[0]['cats'];
    $item_cati = strtolower($item_cat);
    $item_cati = str_replace(" ", "-", strtolower($item_cat));
    //$item_link = base_url()."$item_cati/news/$item_id/$item_title_f/";
    $item_link = base_url()."$item_cati/news/$item_id/";
    $news_img = $recent_news[0]['files'];
    $item_links = $recent_news[0]['links'];
    if($item_links=="") $news_img = base_url()."news_files/$news_img";
    
    $item_views = $recent_news[0]['views'];
    $item_date = @date("D jS M, Y h:ia", strtotime($recent_news[0]['date_posted']));

    if(isset($recent_news[1])){
    	$item_id1 = $recent_news[1]['id'].substr(time(), -4);
	    $item_title1 = $recent_news[1]['titles'];
	    $item_title1_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title1));
	    $item_cat1 = $recent_news[1]['cats'];
	    $item_cat1i = str_replace(" ", "-", strtolower($item_cat1));
    	//$item_link1 = base_url()."$item_cat1i/news/$item_id1/$item_title1_f/";
	    $item_link1 = base_url()."$item_cat1i/news/$item_id1/";
	    $news_img1 = $recent_news[1]['files'];
	    $item_links1 = $recent_news[1]['links'];
    	if($item_links1=="") $news_img1 = base_url()."news_files/$news_img1";
	    $item_views1 = $recent_news[1]['views'];
	    $item_date1 = @date("D jS M, Y h:ia", strtotime($recent_news[1]['date_posted']));
	}
}


if($recent_sports){
	$item_id_sp = $recent_sports[0]['id'].substr(time(), -4);
    $item_title_sp = $recent_sports[0]['titles'];
    $item_title_sp_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title_sp));
    $item_cat_sp = $recent_sports[0]['cats'];
    $item_cat_spi = str_replace(" ", "-", strtolower($item_cat_sp));
    //$item_link_sp = base_url()."$item_cat_spi/news/$item_id_sp/$item_title_sp_f/";
    $item_link_sp = base_url()."$item_cat_spi/news/$item_id_sp/";
    $news_img_sp = $recent_sports[0]['files'];
    $item_links2 = $recent_sports[0]['links'];
    if($item_links2=="") $news_img_sp = base_url()."news_files/$news_img_sp";
    $item_views_sp = $recent_sports[0]['views'];
    $item_date_sp = @date("D jS M, Y h:ia", strtotime($recent_sports[0]['date_posted']));
}

if($recent_lifestyle){
	$item_id_ls = $recent_lifestyle[0]['id'].substr(time(), -4);
    $item_title_ls = $recent_lifestyle[0]['titles'];
    $item_title_ls_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title_ls));
    $item_cat_ls = $recent_lifestyle[0]['cats'];
    $item_cat_lsi = str_replace(" ", "-", strtolower($item_cat_ls));
    //$item_link_ls = base_url()."$item_cat_lsi/news/$item_id_ls/$item_title_ls_f/";
    $item_link_ls = base_url()."$item_cat_lsi/news/$item_id_ls/";
    $news_img_ls = $recent_lifestyle[0]['files'];
    $item_links3 = $recent_lifestyle[0]['links'];
    if($item_links3=="") $news_img_ls = base_url()."news_files/$news_img_ls";
    $item_views_ls = $recent_lifestyle[0]['views'];
    $item_date_ls = @date("D jS M, Y h:ia", strtotime($recent_lifestyle[0]['date_posted']));
}

if($recent_business){
	$item_id_bs = $recent_business[0]['id'].substr(time(), -4);
    $item_title_bs = $recent_business[0]['titles'];
    $item_cat_bs = $recent_business[0]['cats'];
    $item_title_bs_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title_bs));
    $item_cat_bsi = str_replace(" ", "-", strtolower($item_cat_bs));
    //$item_link_bs = base_url()."$item_cat_bsi/news/$item_id_bs/$item_title_bs_f/";
    $item_link_bs = base_url()."$item_cat_bsi/news/$item_id_bs/";
    $news_img_bs = $recent_business[0]['files'];
    $item_links4 = $recent_business[0]['links'];
    if($item_links4=="") $news_img_bs = base_url()."news_files/$news_img_bs";
    $item_views_bs = $recent_business[0]['views'];
    $item_date_bs = @date("D jS M, Y h:ia", strtotime($recent_business[0]['date_posted']));
}

if($recent_tech){
	$item_id_st = $recent_tech[0]['id'].substr(time(), -4);
    $item_title_st = $recent_tech[0]['titles'];
    $item_cat_st = $recent_tech[0]['cats'];
    $item_cat_st = str_replace("Sci-tech", "Technology", $item_cat_st);
	$item_title_st_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title_st));
    $item_cat_sti = str_replace(" ", "-", strtolower($item_cat_st));
    //$item_link_st = base_url()."$item_cat_sti/news/$item_id_st/$item_title_st_f/";
    $item_link_st = base_url()."$item_cat_sti/news/$item_id_st/";
    $news_img_st = $recent_tech[0]['files'];
    $item_links5 = $recent_tech[0]['links'];
    if($item_links5=="") $news_img_st = base_url()."news_files/$news_img_st";
    $item_views_st = $recent_tech[0]['views'];
    $item_date_st = @date("D jS M, Y h:ia", strtotime($recent_tech[0]['date_posted']));
}
?>


<!-- <div id="container">
	<div id="col-sm-6">
  		<p id="texts">ddgddgdg</p>
	</div>
	<div id="col-sm-6">
  		<p id="texts">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non magna ut orci pretium</p>
	</div>
</div> -->

<div class="container plr-sm-5 mobiles_view1" style="margin: 50px 0 -4.5em 0">
	<p><span class="headlines1">Headlines</span></p>
	<div id="displays">
		<p id='texts'>
		<?php
		if($headlines1){
			$cnts=1;
			foreach($headlines1 as $post){
				$id = $post['id'].substr(time(), -4);
				$titles = $post['titles'];
				$cats = strtoupper($post['cats']);
				$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
				$catsi = str_replace(" ", "-", strtolower($cats));
				//$links = base_url()."$catsi/news/$id/$titles_f/";
				$links = base_url()."$catsi/news/$id/";
				//echo "<p id='texts'><a href='$links'>$titles ...</a></p>";
				echo "<a href='$links'>$cnts. $titles</a> ... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$cnts++;
			}
		}
			?>
		</p>
	</div>	
</div>





<div class="container plr-sm-0 plr-0_ mt-sm-50">
	<div class="h-600x h-sm-auto">
		<div class="h-2-3 h-sm-auto oflow-hidden">
	
			<div class="pb-0 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-340x">
				<a class="pos-relative h-100 dplay-block" href="<?=$item_link?>">
					<div class="img-bg img-bg1 bg-grad-layer-6 bg-grad-layer-6j"><img alt="<?=$item_title?>" src="<?=$news_img?>"></div>

					<div class="abs-blr color-white p-10 pl-10 pr-10 bg-sm-color-7 bg-sm-color-7i">
						<h3 class="mb-5 mb-sm-0 font-13 font-sm-14 lh-25"><b><?=ucfirst($item_title)?></b></h3>
						<ul class="list-li-mr-10">
							<li class="font-9 font-sm-11 color-primary_i"><?=$item_date?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-11 fa fa-bolt"></i><?=$item_cat?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views?></li>
						</ul>
					</div>
				</a>
			</div>
			

			<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-420x">

				<?php
				if(strlen($item_title1) > 65)
        			$item_title1 = substr($item_title1, 0, 65)."...";
				?>

				<div class="pl-5 pb-0 pl-sm-0 ptb-sm-5 pos-relative h-50 mt-0 mt-sm-15">
					<a class="pos-relative h-100 dplay-block" href="<?=$item_link1?>">
						<div class="img-bg img-bg2 bg-2_ bg-grad-layer-6"><img src="<?=$news_img1?>" alt="<?=$item_title1;?>"></div>

						<div class="abs-blr color-white p-5 pl-10 pr-10 bg-sm-color-7">
							<h4 class="mb-5 mb-sm-0 font-11 font-sm-13 lh-25 lh-sm-23"><b><?=ucfirst($item_title1)?></b></h4>
							<ul class="list-li-mr-10">
								<li class="font-85 font-sm-11 color-primary_i"><?=$item_date1?></li>
								<li class="color-primary_i font-85 font-sm-11"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$item_cat1?></li>
								<li class="color-primary_i font-85 font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views1?></li>
							</ul>
						</div>
					</a>
				</div>

				<?php
				if(strlen($item_title_sp) > 65)
        			$item_title_sp = substr($item_title_sp, 0, 65)."...";
				?>
				
				<div class="pl-5 pb-10 pl-sm-0 ptb-sm-5 pos-relative h-50 mt-10">
					<a class="pos-relative h-100 dplay-block" href="<?=$item_link_sp?>">
						<div class="img-bg img-bg2 bg-grad-layer-6"><img src="<?=$news_img_sp?>" alt="<?=$item_title_sp?>"></div>
						<div class="abs-blr color-white p-5 pl-10 pr-10 bg-sm-color-7">
						<h4 class="mb-5 mb-sm-0 font-11 font-sm-13 lh-25 lh-sm-23"><b><?=ucfirst($item_title_sp)?></b></h4>
						<ul class="list-li-mr-10">
							<li class="font-85 font-sm-11 color-primary_i"><?=$item_date_sp?></li>
							<li class="color-primary_i font-85 font-sm-11"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$item_cat_sp?></li>
							<li class="color-primary_i font-85 font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views_sp?></li>
						</ul>
						</div>
					</a>
				</div>
			</div><!-- float-left -->

		</div><!-- h-2-3 -->
		
		<div class="h-1-3 mt-2 oflow-hidden mt-10">

			<?php
			if(strlen($item_title_ls) > 65)
    			$item_title_ls = substr($item_title_ls, 0, 65)."...";
			?>
	
			<div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-205x">
				<a class="pos-relative h-100 dplay-block" href="<?=$item_link_ls?>">
					<div class="img-bg img-bg2 bg-2_ bg-grad-layer-6"><img src="<?=$news_img_ls?>" alt="<?=$item_title_ls?>"></div>
					<div class="abs-blr color-white p-5 pl-10 pr-10 bg-sm-color-7">
						<h4 class="mb-5 mb-sm-0 font-11 font-sm-13 lh-25 lh-sm-23"><b><?=ucfirst($item_title_ls)?></b></h4>
						<ul class="list-li-mr-10">
							<li class="font-9 font-sm-11 color-primary_i"><?=$item_date_ls?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$item_cat_ls?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views_ls?></li>
						</ul>
					</div>
				</a>
			</div>
			
			<?php
			if(strlen($item_title_bs) > 65)
    			$item_title_bs = substr($item_title_bs, 0, 65)."...";
			?>

			<div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-205ix">
				<a class="pos-relative h-100 dplay-block" href="<?=$item_link_bs?>">
					<div class="img-bg img-bg2 bg-2_ bg-grad-layer-6"><img src="<?=$news_img_bs?>" alt="<?=$item_title_bs?>"></div>
					<div class="abs-blr color-white p-5 pl-10 pr-10 bg-sm-color-7">
						<h4 class="mb-5 mb-sm-0 font-11 font-sm-13 lh-25 lh-sm-23"><b><?=ucfirst($item_title_bs)?></b></h4>
						<ul class="list-li-mr-10">
							<li class="font-9 font-sm-11 color-primary_i"><?=$item_date_bs?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$item_cat_bs?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views_bs?></li>
						</ul>
					</div>
				</a>
			</div>
			
			<div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-205ix">
				<a class="pos-relative h-100 dplay-block" href="<?=$item_link_st?>">
					<div class="img-bg img-bg2 bg-2_ bg-grad-layer-6"><img src="<?=$news_img_st?>" alt="<?=$item_title_st?>"></div>
					<div class="abs-blr color-white p-5 pl-10 pr-10 bg-sm-color-7">
						<h4 class="mb-5 mb-sm-0 font-11 font-sm-13 lh-25 lh-sm-23"><b><?=ucfirst($item_title_st)?></b></h4>
						<ul class="list-li-mr-10">
							<li class="font-9 font-sm-11 color-primary_i"><?=$item_date_st?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><?=$item_cat_st?></li>
							<li class="color-primary_i font-sm-11"><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$item_views_st?></li>
						</ul>
					</div>
				</a>
			</div>
			
		</div><!-- h-2-3 -->
	</div><!-- h-100vh -->
</div><!-- container -->


<?php
if($sponsoredAD){
foreach($sponsoredAD as $post){
$image_ads = $post['image'];
$positn_side = $post['positn'];
$links = $post['links'];
if($links=="") {
    $links1="javascript:;";
    $targets = "";
}else{
    $links1=$links;
    $targets = "target='_blank'";
}

if($positn_side=="top"){
?>
<div style="text-align: center;" class="mt-30 mb--20 img_ads">
	<a href='<?=$links1?>' <?=$targets?>>
		<img src="<?=base_url()?>sponsoredads/<?=$image_ads?>" alt="">
	</a>
</div>
<?php
}
}
}
?>

<section>
	<div class="container plr-sm-10 mt-10">
		<div class="row">
		
			<div class="col-md-12 col-lg-8">
				<h4 class="p-title font-sm-18"><b>RECENT NEWS</b></h4>
				<div class="row">
					<?php
					//print_r($recent_news_one);
					$item_title_one=""; $item_cat_one=""; $item_link_one=""; $news_img_one=""; 
					$item_views_one=""; $item_date_one="";$item_contents_one="";
					if($recent_news_one){
						$item_id_one = $recent_news_one[0]['id'].substr(time(), -4);
						$item_title_one = $recent_news_one[0]['titles'];
					    $item_cat_one = $recent_news_one[0]['cats'];
					    $item_title_one_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($item_title_one));
					    
					    $item_cat_onei = str_replace(" ", "-", strtolower($item_cat_one));
    					$item_link_one = base_url()."$item_cat_onei/news/$item_id_one/";
					    
						//$item_link_one = base_url()."news/$item_id_one/$item_title_one_f/";
					    $news_img_one = $recent_news_one[0]['files'];
					    $item_views_one = $recent_news_one[0]['views'];
					    $item_contents1 = $recent_news_one[0]['contents'];
					    $item_links = $recent_news_one[0]['links'];
    					if($item_links=="") $news_img_one = base_url()."news_files/$news_img_one";

					    $item_contents1 = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $item_contents1), '');

					    if(strlen($item_contents1) > 150)
                			$item_contents_one = substr($item_contents1, 0, 150)."...";
					    $item_date_one = @date("D jS M, Y h:ia", strtotime($recent_news_one[0]['date_posted']));

						if(strlen($item_title_one) > 75)
		    				$item_title_one = substr($item_title_one, 0, 75)."...";
					?>
				
						<div class="col-sm-6">
							<a href="<?=$item_link_one?>" class="lh-25 lh-sm-25">
							<img src="<?=$news_img_one?>" class="bg-grad-layer-6i" alt="<?=$item_title_one?>">
							<h4 class="pt-10 font-sm-16"><b><?=ucfirst($item_title_one)?></b></a></h4>
							<ul class="list-li-mr-10 pt-0 pb-5 font-sm-11">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$item_date_one?></li>
								<li class="color-primary"><i class="color-primary mr-5 font-11 fa fa-bolt"></i><b><?=strtoupper($item_cat_one)?></b></li>
							</ul>
							<p class="font-10 font-sm-12 lh-25 lh-sm-22"><?=$item_contents_one?></p>
						</div>

					<?php
					}
					?>
					

					<div class="col-sm-6 pt-sm-30">
					<?php
					if($recent_news1){
						$cnts=1;
						foreach($recent_news1 as $post){
							$id = $post['id'].substr(time(), -4);
							$titles = $post['titles'];
							$cats = strtoupper($post['cats']);
							$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
							$catsi = str_replace(" ", "-", strtolower($cats));
    						$links = base_url()."$catsi/news/$id/";
							
							$files = $post['files'];
							$views = $post['views'];
							$date_posted = @date("D jS M, Y h:ia", strtotime($post['date_posted']));
							$linksi = $post['links'];
    						if($linksi=="") $files = base_url()."news_files/$files";

							if(strlen($titles) > 70)
				    			$titles = substr($titles, 0, 70)."...";
					?>
							<a class="oflow-hidden pos-relative mb-20 dplay-block brder-blr-grey_b" href="<?=$links?>">
								<div class="wh-100x abs-tlr"><img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i"></div>
								<div class="ml-110 min-h-90x">
									<h5 class="lh-20 font-9 font-sm-11-5"><b><?=ucfirst($titles)?></b></h5>
									<h6 class="color-lite-black pt-5 font-sm-10"><span class="color-primary font-9"><b><?=$cats?></b></span> &nbsp;<?=$date_posted?></h6>
								</div>
							</a>
					<?php
					$cnts++;
						}
					}
					?>
					</div>
					
				</div><!-- row -->
				
				<h4 class="p-title mt-30"><b class="font-sm-18">LIFESTYLE/EVENTS</b>
					<div class="float-right show_more mt-10 font-7 font-sm-9 pr-10" style="color: #FF8000;"><a href="<?=base_url()?>media/lifestyle/"><b>Show more &raquo;</b></a></div>
				</h4>
				<div class="row">
					<?php
					if($recent_lifestyle1){
						$cnts=1;
						foreach($recent_lifestyle1 as $post){
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
					?>
						<div class="col-sm-6">
							<a href="<?=$links?>">
							<img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i">
							<h4 class="pt-10 font-sm-14 lh-25"><b><?=ucfirst($titles)?></b></h4></a>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$date_posted?></li>
								<li class="font-8 color-primary"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><b><?=$cats?></b></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>
					<?php
					$cnts++;
						}
					}
					?>
				</div>


<?php
if($sponsoredAD){
foreach($sponsoredAD as $post){
$image_ads = $post['image'];
$positn_side = $post['positn'];
$links = $post['links'];
if($links=="") {
    $links1="javascript:;";
    $targets = "";
}else{
    $links1=$links;
    $targets = "target='_blank'";
}
if($positn_side=="mid"){
?>
<div style="text-align: center;" class="mt-0 mb-30 img_ads">
	<a href='<?=$links1?>' <?=$targets?>>
		<img src="<?=base_url()?>sponsoredads/<?=$image_ads?>" alt="Sponsored ADs">
	</a>
</div>
<?php
}
}
}
?>



				<h4 class="p-title mt-0 font-sm-18"><b>SPORTS</b>
					<div class="float-right show_more mt-10 font-7 font-sm-9 pr-10" style="color: #FF8000;"><a href="<?=base_url()?>media/sports/"><b>Show more &raquo;</b></a></div>
				</h4>
				<div class="row">
					<?php
					if($recent_sports1){
						$cnts=1;
						foreach($recent_sports1 as $post){
							$id = $post['id'].substr(time(), -4);
							$titles = $post['titles'];
							$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
							$cats = strtoupper($post['cats']);
							$catsi = str_replace(" ", "-", strtolower($cats));
    						$links = base_url()."$catsi/news/$id/";
							//$links = base_url()."news/$id/$titles_f/";
							$files = $post['files'];
							$views = $post['views'];
							$date_posted = @date("D jS M, Y h:ia", strtotime($post['date_posted']));
							$linksi = $post['links'];
    						if($linksi=="") $files = base_url()."news_files/$files";
					?>
						<div class="col-sm-6">
							<a href="<?=$links?>">
							<img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i">
							<h4 class="pt-10 font-sm-14 lh-25"><b><?=ucfirst($titles)?></b></h4></a>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$date_posted?></li>
								<li class="font-8 color-primary"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><b><?=$cats?></b></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>
					<?php
					$cnts++;
						}
					}
					?>
				</div>


				<h4 class="p-title mt-0 font-sm-18"><b>BUSINESS</b>
					<div class="float-right show_more mt-10 font-7 font-sm-9 pr-10" style="color: #FF8000;"><a href="<?=base_url()?>media/business/"><b>Show more &raquo;</b></a></div>
				</h4>
				<div class="row">
					<?php
					if($recent_business1){
						$cnts=1;
						foreach($recent_business1 as $post){
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
					?>
						<div class="col-sm-6">
							<a href="<?=$links?>">
							<img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i">
							<h4 class="pt-10 font-sm-14 lh-25"><b><?=ucfirst($titles)?></b></h4></a>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$date_posted?></li>
								<li class="font-8 color-primary"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><b><?=$cats?></b></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>
					<?php
					$cnts++;
						}
					}
					?>
				</div>


				<h4 class="p-title mt-0 font-sm-18"><b>POLITICS</b>
					<div class="float-right show_more mt-10 font-7 font-sm-9 pr-10" style="color: #FF8000;"><a href="<?=base_url()?>media/politics/"><b>Show more &raquo;</b></a></div>
				</h4>
				<div class="row">
					<?php
					if($recent_poli){
						$cnts=1;
						foreach($recent_poli as $post){
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
					?>
						<div class="col-sm-6">
							<a href="<?=$links?>">
							<img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i">
							<h4 class="pt-10 font-sm-14 lh-25"><b><?=ucfirst($titles)?></b></h4></a>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$date_posted?></li>
								<li class="font-8 color-primary"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><b><?=$cats?></b></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>
					<?php
					$cnts++;
						}
					}
					?>
				</div>


				<h4 class="p-title mt-0 font-sm-18"><b>WEDDINGS</b>
					<div class="float-right show_more mt-10 font-7 font-sm-9 pr-10" style="color: #FF8000;"><a href="<?=base_url()?>media/tech/"><b>Show more &raquo;</b></a></div>
				</h4>
				<div class="row">
					<?php
					if($recent_tech1){
						$cnts=1;
						foreach($recent_tech1 as $post){
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
					?>
						<div class="col-sm-6">
							<a href="<?=$links?>">
							<img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i">
							<h4 class="pt-10 font-sm-14 lh-25"><b><?=ucfirst($titles)?></b></h4></a>
							<ul class="list-li-mr-10 pt-0 mb-30 font-sm-12">
								<li class="color-lite-black color-black"><b>Posted:</b>
								<?=$date_posted?></li>
								<li class="font-8 color-primary"><i class="color-primary mr-5 font-12 fa fa-bolt"></i><b>EDUCATION</b></li>
								<li><i class="color-primary mr-5 font-12 fa fa-eye"></i><?=$views?></li>
							</ul>
						</div>
					<?php
					$cnts++;
						}
					}
					?>
				</div>
				
			</div><!-- col-md-9 -->
			
			
