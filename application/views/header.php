<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?=$page_title?></title>
	<link rel="canonical" href="http://skynewsng.com/" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>images/logofav.png">

	<meta name="keywords" content="africa, african, news, updates, sports, politics, lasema,Lagos,oshodi,fire,house collapse,flood,virus,headlines, business, features, tech, Chelsea,arsenal,Manchester City,nema,Manchester United,Liverpool,Tottenham, ikeja, indecency can lead him to cheat,what men hate, men hate,technology, world, chinny anthony, this week, democracy, south africa, happenings,  news updates, current affairs, current, nigeria,skynews, skynewsng, daily news, videos, platform, lybia, chinny, football, scores, news updates, davido chioma, peruzzi,daddy freeze, APC,PDP, election,elections,Nigerian celebrity,celebrities,womens health,cheating partner,lifestyle">

	<meta name="description" content="SkyNewsNG, is a full-service media African platform which brings you the latest African News, headlines, stories, sports, business, videos and more."/>
	
	
	<meta property="og:locale" content="en_US" />
	
	<?php
	if(isset($news_single)){
		$id = $news_single['id'].substr(time(), -4);
		$titles = $news_single['titles'];

		if(strlen($titles) > 65)
            $titles = substr($titles, 0, 65);

		$titles_f = str_replace(array(" ", "’", "‘"), array("-", "", ""), strtolower($titles));
		$cats = strtoupper($news_single['cats']);
		$catsi = str_replace(" ", "-", strtolower($cats));
		$links = base_url()."$catsi/news/$id/";

		$files = $news_single['files'];
		$contents = $news_single['contents'];
		$contents = strip_tags($contents);

		if(strlen($contents) > 200)
            $contents = substr($contents, 0, 200)."...";

		$views = $news_single['views'];
		$date_posted = @date("D jS M, Y", strtotime($news_single['date_posted']));
	?>
		<meta name="twitter:site" content="@SkyNewsNG" />
		<meta name="twitter:url" content="<?=$links;?>" />
		<meta name="twitter:title" content="<?=$titles;?>" />
		<meta property="twitter:image" content="<?=$files?>" />

		<meta property="og:title" content="<?=$titles;?>" />
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="<?=$links?>" />
		<meta property="og:image" content="<?=$files?>" />
		<meta property="og:image:width" content="800" />
		<meta property="og:image:height" content="400" />
		<meta property="og:site_name" content="SkyNewsNG"/>
		<meta property="og:description" content='<?=$contents;?>' />
		
	<?php }else{ ?>

		<meta property="og:url" content="https://skynewsng.com/" />
		<meta property="og:title" content="SkyNewsNG | Daily news, breaking news and more" />
		<meta property="og:type" content="website"/>
		<meta property="og:image" content="<?=base_url()?>images/big_logo.png" />
		<meta property="og:description" content="SkyNewsNG, is a full-service media African platform which brings you the latest African News, headlines, stories, sports, business, videos and many more." />

	<?php } ?>

	<script data-cfasync="true" type="application/ld+json">{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"http:\/\/skynewsng.com\/","name":"SkyNewsNG | Daily news, headlines, entertainments, sports, breaking news and more","potentialAction":{"@type":"SearchAction","target":"http:\/\/skynewsng.com\/search\/result\/?search={search_term_string}","query-input":"required name=search_term_string"}}</script>

	<script data-cfasync="true" type="application/ld+json">{"@context":"http:\/\/schema.org","@type":"Organization","url":"http://skynewsng.com","sameAs":["https:\/\/www.facebook.com\/Skynewsng-101296461412108","https:\/\/twitter.com\/Skynewsng_com"],"@id":"#organization","name":"SkyNewsNG","logo":"http://skynewsng.com/images/logofav.png"}</script>



	
	<!-- <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="<?=base_url();?>css/font-awesome.min.css">
	<link href="<?=base_url()?>js/bootstrap.css" rel="stylesheet">
	<link href="<?=base_url()?>css/styles.css" rel="stylesheet">
	

<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PNTFZ25');</script> -->
<!-- End Google Tag Manager -->


<!-- PushAlert -->
<script type="text/javascript">
	(function(d, t) {
	        var g = d.createElement(t),
	        s = d.getElementsByTagName(t)[0];
	        g.src = "https://cdn.pushalert.co/integrate_27fbd1de797c6a2946bb921f606c5310.js";
	        s.parentNode.insertBefore(g, s);
	}(document, "script"));
</script>
<!-- End PushAlert -->

<!-- BEGIN SHAREAHOLIC CODE -->
<link rel="preload" href="https://cdn.shareaholic.net/assets/pub/shareaholic.js" as="script" />
<meta name="shareaholic:site_id" content="8880aa9ef71e536a6c2edfc8f33a108c" />
<script data-cfasync="false" async src="https://cdn.shareaholic.net/assets/pub/shareaholic.js"></script>
<!-- END SHAREAHOLIC CODE -->

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PNTFZ25"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->


	<input type="hidden" value="<?=base_url();?>" id="txtsite_url">
	<input type="hidden" value="<?=$page_name;?>" id="txtpage_name">
	
	
	<header>
		<div class="bg-191 hide_header fixed">
			<div class="container">	
				<div class="oflow-hidden color-ash font-9 font-sm-10 text-sm-center ptb-sm-0">

					<a href="<?=base_url()?>" class="float-left">
						<img src="<?=base_url()?>images/logo-white.png" alt="Logo" style="display: none" class="while_logo while_logo1 float-sm-none ml-80 mt-5">
					</a>
				
					<ul class="links2 float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10" style="display: nones">
						<li><a class="pl-0 pl-sm-10" href="javascript:;">About SkyNewsNG</a></li>
						<li><a href="<?=base_url()?>contact/">Contact Us</a></li>
					</ul>

					<!-- <ul class="float-right float-sm-none font-11 font-sm-13 list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-pt-sm-0 list-a-pb-sm-5 mt-sm--5 socials1"> -->
					<ul class="float-right float-sm-none font-11 font-sm-13 mt-10 mt-sm--5 socials1">
						<li><a class="pl-0 pl-sm-10" href="https://web.facebook.com/Skynewsng-101296461412108" target="_blank"><i class="fa fa-facebook"></i></a></li>

						<li><a href="https://twitter.com/Skynewsng_com" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<!-- <li><a href="#"><i class="fa fa-whatsapp"></i></a></li> -->
					</ul>
					
				</div><!-- top-menu -->
			</div><!-- container -->
		</div>
		
		<div class="container bg-191_i fixed1">
			<div class="mt-40 mt-sm-0">
			<a class="logo" href="<?=base_url()?>">
				<img src="<?=base_url()?>images/logo-black.png" alt="Logo" class="black_logo">
				<img src="<?=base_url()?>images/logo-white.png" alt="Logo" style="display: none" class="while_logo">
			</a>

			<a class="menu-nav-icon pr-sm-25" data-menu="#main-menu" href="javascript:;"><i class="fa fa-navicon"></i></a>
			
			<a class="right-area src-btn pr-sm-0" href="javascript:;" >
				<i class="active src-icn_ mt-20 color-primary fa fa-search"></i>
				<i class="close-icn mt-20 fa fa-close"></i>
			</a>

			<a class="right-area pr-sm-0 mobiles_view" style="margin-top: -15px; margin-right: 9px;" href="<?=base_url()?>contact/" >
				<i class="active mt-20 color-primary font-16 fa fa-envelope"></i>
			</a>

			<div class="src-form">
				<form action="javascript:;">
					<input type="text" placeholder="Search here" id="txt_srch">
					<button type="button"><i class="fa fa-search cmd_srch"></i></button>
				</form>
			</div>
			
			
			
			<ul class="main-menu" id="main-menu">
				<li><a href="<?=base_url()?>media/trending/">TRENDING</a></li>
				<li><a href="<?=base_url()?>media/news/">NEWS</a></li>
				<li><a href="<?=base_url()?>media/business/">BUSINESS</a></li>
				<li><a href="<?=base_url()?>media/lifestyle/">LIFESTYLE</a></li>
				<li><a href="<?=base_url()?>media/sports/">SPORTS</a></li>
				<li><a href="<?=base_url()?>media/entertainment/">ENTERTAINMENTS</a></li>
				<li class="drop-down pb-sm-20 brder-blr-grey_b1"><a href="javascript:;">MORE<i class="fa fa-chevron-down"></i></a>
					<ul class="drop-down-menu drop-down-inner_ mobile_menus">
						<li><a href="<?=base_url()?>media/features/">FEATURES</a></li>
						<li><a href="<?=base_url()?>media/gossip/">GOSSIP</a></li>
						<li><a href="<?=base_url()?>media/politics/">POLITICS</a></li>
						<!-- <li><a href="<?=base_url()?>media/science-technology/">TECHNOLOGY</a></li> -->
						<li><a href="<?=base_url()?>media/relationships/">RELATIONSHIPS</a></li>
						<li><a href="<?=base_url()?>media/weddings/">WEDDINGS</a></li>
						<li><a href="<?=base_url()?>media/style/">STYLE</a></li>
						<li><a href="<?=base_url()?>media/africa/">AFRICA</a></li>
						<li><a href="<?=base_url()?>media/local/">LOCAL</a></li>
						<li><a href="<?=base_url()?>media/in-pictures/">IN PICTURES</a></li>
						<!-- <li class="last_link"><a href="<?=base_url()?>media/mobile-leadstory/">MOBILE LEADSTORY</a></li> -->
					</ul>
				</li>
			</ul>
			<div class="clearfix"></div>

			</div>
		</div>
	</header>

	<div class="fetching_data" style="display: none; position: absolute; padding: 0 0 0 10px;">Fetching data...please wait...</div>