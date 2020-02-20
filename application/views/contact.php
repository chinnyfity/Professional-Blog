
<section class="ptb-0 mt-sm-40">
	<div class="mb-10 brdr-ash-1 opacty-5"></div>
	<div class="container pr-5 pl-5 font-sm-11-5">
		<a class="mt-5" href="<?=base_url()?>"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-5 fa fa-chevron-right"></i></a>
		<a class="mt-10" href="#">Contact Us</a>
	</div>
</section>


<section>
	<div class="container mt--30 pr-5 pl-5">
		<div class="row">
			<div class="col-md-10 col-lg-8">
				<h3><b>SEND US A MESSAGE</b></h3>
				<p class="mb-40 mt-10 mr-100 mr-sm-0 font-sm-12" style="line-height: 23px;">We'd love to hear from you, please get in touch for comments, requests, advertising partnerships or any other inquiries.</p>
				<form class="form-block form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0 from_contact">
					<div class="row">
						<div class="col-sm-6">
							<p class="color-555">Full Names*</p>
							<div class="pos-relative">
								<input class="pr-20 color-555" style="text-transform: capitalize;" type="text" value="" name="txtnames" placeholder="Full Names">
								<i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
							</div>
						</div>
						
						<div class="col-sm-6">							
							<p class="color-555">Email Address*</p>
							<div class="pos-relative">
								<input class="pr-20" type="email" name="txtemail" placeholder="Email Address">
							</div>
						</div>
						
						<div class="col-sm-6">	
							<p class="color-555">Your Phone*</p>
							<div class="pos-relative">
								<input class="pr-20" type="number" name="txtphone" placeholder="Phone Number">
							</div>
						</div>
						
						<div class="col-sm-6">	
							<p class="color-555">Please Select*</p>
							<div class="pos-relative">
								<select class="pr-20" name="txtsubj" style="background: #fff !important">
									<option value="1">Advertise</option>
									<option value="2">Complaints & Reports</option>
									<option value="3">Suggestions & Feedback</option>
									<option value="4">Others</option>
								</select>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="pos-relative pr-80">
								<p class="color-555">Message*</p>
								<textarea style="height: 12em" name="txtmsg" placeholder="Write your message" class="mb-0"></textarea>

								<button class="abs-br font-15 plr-20 btn-fill-primary cmd_send_msg" type="submit"><i class="fa fa-paper-plane"></i></button>
							</div>
							<br>
							<div class="alert alert_msg1"></div>
						</div>
						
					</div><!-- row -->
				</form>
			</div>
		</div>
	</div>
</section>
		