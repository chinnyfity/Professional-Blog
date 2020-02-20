
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
if($positn_side=="fot"){
?>
<div style="text-align: center;" class="mt-0 mb-20 img_ads">
	<a href='<?=$links1?>' <?=$targets?>>
		<img src="<?=base_url()?>sponsoredads/<?=$image_ads?>" alt="Sponsored Ads">
	</a>
</div>
<?php
}
}
}
?>
<footer class="bg-191 color-ccc pt-10 pb-30 pt-sm-0 pb-sm-10">
	<div class="container">
		<div class="brdr-ash-1_ opacty-2"></div>
		<div class="oflow-hidden color-ash font-10 text-sm-center ptb-sm-5">
			
			<div class="mt-10">
				<div class="float-left_ color-primary_j" style="text-align: left; font-size: 15px;"><a href="<?=base_url()?>privacy-policy/">Privacy & Policy</a></div>
			</div>

			<ul class="float-left mt-10 float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
				<div class="color-ash font-85 font-sm-8" style="text-align: left;">
				Copyright &copy; <script>document.write(new Date().getFullYear());</script> SkyNewsNG. Website by <a href="mailto:donchibobo@gmail.com" class="color-primary_j">CATech</a><br>Sources from <a href="https://www.informationng.com/" target="_blank" class="color-primary_j">informationng.com</a>, <a href="https://www.bellanaija.com/" target="_blank" class="color-primary_j">bellanaija.com</a>, <a href="https://www.channelstv.com" target="_blank" class="color-primary_j">channelstv.com</a> & <a href="https://www.africanews.com/" target="_blank" class="color-primary_j">africanews.com</a>
				</div>
			</ul>

			<!-- <ul class="float-right float-sm-none mt-sm-5 font-14 list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5 socials"> -->
			<ul class="float-right float-sm-none mt-sm-5 font-14 socials">
				<li><a class="pl-0" href="https://web.facebook.com/Skynewsng-101296461412108" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/Skynewsng_com" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<!-- <li><a href="#"><i class="fa fa-whatsapp"></i></a></li> -->
			</ul>
			
		</div><!-- oflow-hidden -->
	</div><!-- container -->
</footer>

<!-- SCIPTS -->

<script src="<?=base_url()?>js/jquery-3.2.1.min.js"></script>
<script src="<?=base_url()?>js/tether.min.js"></script>
<script src="<?=base_url()?>js/bootstrap.js"></script>
<script src="<?=base_url()?>js/scripts.js"></script>
<script src="<?=base_url()?>js/jscripts.js"></script>

</body>

<!-- <div id="adsense" style="display:none">
    <script type="text/javascript">
        google_ad_width = 300;
        google_ad_height = 250;
    </script><script data-ad-client="ca-pub-7956669216486808" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</div><div id="adslot"></div> -->

<!-- <iframe id="google_esf" name="google_esf" src="https://googleads.g.doubleclick.net/pagead/html/r20200115/r20190131/zrt_lookup.html#" data-ad-client="ca-pub-7956669216486808" style="display: none;"></iframe> -->

<!-- <iframe id="google_esf" name="google_esf" src="https://googleads.g.doubleclick.net/pagead/html/r20200115/r20190131/zrt_lookup.html#" data-ad-client="ca-pub-7956669216486808" style="display: nones;"></iframe> -->

</html>