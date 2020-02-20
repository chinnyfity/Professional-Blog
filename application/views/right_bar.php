	<!-- <div class="d-none d-md-block d-lg-none col-md-3"></div> -->
	<div class="col-md-12 col-lg-4">
		<div class="pl-20 pl-md-0">
			<!-- <ul class="list-block list-li-ptb-15 list-btm-border-white bg-primary text-center">
				<li><b>1 BTC = $13,2323</b></li>
				<li><b>1 BCH = $13,2323</b></li>
				<li><b>1 ETH = $13,2323</b></li>
				<li><b>1 LTC = $13,2323</b></li>
				<li><b>1 DAS = $13,2323</b></li>
				<li><b>1 BCC = $13,2323</b></li>
			</ul> -->
			
			<div class="mtb-20">
				<h4 class="p-title font-sm-20"><b>MOST READ</b></h4>

				<?php
				if($most_viewed){
					$cnts=1;
					foreach($most_viewed as $post){
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
					<a class="oflow-hidden pos-relative mb-20 dplay-block brder-blr-grey_b" href="<?=$links?>">
						<div class="wh-100x abs-tlr"><img src="<?=$files?>" alt="<?=ucfirst($titles)?>" class="bg-grad-layer-6i"></div>
						<div class="ml-110 min-h-100x">
							<h5 class="font-10 font-sm-12 lh-20"><b><?=ucfirst($titles)?></b></h5>
							<h6 class="color-lite-black pt-5 font-sm-10"><span class="font-9 color-primary"><b><?=$cats?></b></span> &nbsp; <?=$date_posted?></h6>
						</div>
					</a>
				<?php
				$cnts++;
				}
				}
				?>
			</div>



			<div class='widget Label mtb-50' data-version='2' id='Label2'>
			  <div class='widget-title'>
			    <h3 class='title'>Categories</h3>
			  </div>

			  <table class="tbl_cats">
			  	<?php
			  	if($news_cats):
			  		foreach ($news_cats as $post):
			  			$mycats = $post['cats'];
			  			$mycats1 = strtolower($mycats);
			  			$mycats1 = str_replace(" ", "-", $mycats1);
			  			$c_count = $this->sql_models->fetchEachCatsCounts_cats('', '', $mycats);
			  			$c_count = number_format($c_count);
			  	?>
			  	<tr>
			  		<td><a class='label-name' href='<?=base_url()?>media/<?=$mycats1?>/'><?=ucwords($mycats)?></a></td>
			  		<td><span class='label-count'>(<?=$c_count?>)</span></td>
			  	</tr>

			  	<?php
			  		endforeach;
			  	endif;
			  	?>
			  </table>
			</div>



			<!-- <div class='widget Label mtb-50' data-version='2' id='Label2'>
			  	<div id='adsense' style="display:none">
				    <script type="text/javascript">
				        //enable_page_level_ads: true;
				        google_ad_width = 300;
				        google_ad_height = 250;
				    </script>
				    <script data-ad-client="ca-pub-7956669216486808" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				</div>
				<div id='adslot'></div>
			</div> -->

			<!-- <iframe id="google_esf" name="google_esf" src="https://googleads.g.doubleclick.net/pagead/html/r20200115/r20190131/zrt_lookup.html#" data-ad-client="ca-pub-7956669216486808" style="display: nones; width: 100%; border: 1px solid #ccc;"></iframe> -->



			<p class="mt-20 font-sm-15" style="color: #222;"><b>Sponsored Ads</b></p>
			<div class="row">
				<?php
				if($sponsoredAD){
					$cnts=1;
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

						if($positn_side=="side"){
				?>
							<div class="col-md-6 col-lg-12">
								<div class="mtb-5 pos-relative">
									<a style="z-index: 9; position: relative;" href='<?=$links1?>' <?=$targets?>>
										<img src="<?=base_url()?>sponsoredads/<?=$image_ads?>" alt="Sponsored Ads">
									</a>
									<div class="abs-tblr bg-layer-7_ text-center color-white">
										<div class="dplay-tbl">
											<div class="dplay-tbl-cell">
												<!-- <h4><b>Available for mobile & desktop</b></h4>
												<a class="mt-15 color-primary link-brdr-btm-primary" href="#"><b>Download for free</b></a> -->
											</div>
										</div>
									</div>
								</div>
							</div>
				<?php
						}
					}
				}
				?>

			</div>
			
		</div>
	</div>

</div>
</div>
</section>