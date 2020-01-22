<?php
global $wpdb;
if(isset($_POST['save'])){
	if($_POST['captcha_toggle'] == 'on' && ($_POST['captcha_site_key'] =='' ||  $_POST['captcha_secret_key'] =='' )){
		 if($_POST['captcha_site_key'] =='' &&  $_POST['captcha_secret_key'] =='' ){
			$keyError= 'Please Add Site Key And Secret Key Both For On Captcha Toggle.';
		}
		else if($_POST['captcha_site_key'] =='')
		{
			$keyError= 'Please Add Site Key For On Captcha Toggle.';
		}
		else if($_POST['captcha_secret_key'] ==''){
			
			$keyError= 'Please Add Secret Key For On Captcha Toggle.';
		}
		
		echo  '<div class="alert alert-success msg" style="margin-top:10px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

		'.$keyError.'</div>';
    
		
	}else{
	foreach($_POST as $k => $v){
		if($k != 'save'){
			
			if ( get_option( $k ) !== false ) {

				// The option already exists, so we just update it.
				if(update_option( $k, $v )){
					
					$success_msg = true;

				 }
				//else{

					// $error_msg = true;
				// }
                  
			} else {

				// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				if(add_option( $k, $v )){
					
					$success_msg = true;

				}else{

					$error_msg = true;
				}
				 
			}
		}
	}
	
	}
	
}



?>
<style>
.pay_method {
  margin-top: 20px;
}
.wz_key {
  margin-left: -10px !important;
  margin-top: 20px;
}
.wz_registers {
  float: left;
  margin: 20px 10px 10px -32px;
  width: 100%;
}
.wz_registers input[type="radio"]{
	
	line-height: normal;
	margin: 0px 10px 0px 40px;
}
.wh_pay_inputs {
  float: left;
  margin-bottom: 20px;
  width: 100%;
}
.btn_save {
  margin-left: 15px;
  margin-top: 15px;
  margin-bottom:10px;
}
.wz_mail_host {
  float: left;
  margin-bottom: 10px;
  margin-left: 16px;
  margin-right: 10px;
  margin-top: 20px;
  width: 100%;
}
.wz_host {
  float: left;
  width: 20%;
}
.wz_host_input {
  margin-left: 25px;
}
.custom_host {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  height:32px;
}
#image-preview, #image-preview1 {
  margin-bottom: 5px;
}
</style>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<div class="container">
<div class="pay_method">
<form method="post" action="">

<h3>Set Keys </h3>
<?php
	
		if(isset($success_msg)){

			

			echo '<div class="alert alert-success msg" style="margin-top:10px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

			Thanks Your Updates are saved!.</div>';

			

		}elseif(isset($error_msg)){

			

			echo '<div class="alert alert-danger msg" style="margin-top:10px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error.</div>';

		}

	?>
<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_registers">
		
		<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="braintree_payment_mode" <?php echo (get_option('braintree_payment_mode') == 'production') ? 'checked' : 'required'; ?> value="production"> Live Mode
		</label>
		
		<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="braintree_payment_mode" <?php echo (get_option('braintree_payment_mode') == 'sandbox') ? 'checked' : 'required'; ?> value="sandbox"> Sandbox Mode
		</label>
		
	</div>
	
	<div class="wh_pay_inputs">
	  <div class="col-sm-5 borders2">
	  <label for="inputEmail" id="sandbox_publish_key">View Transcations & Cancel Subscription Shortcode</label>
	   <span>[view_cancel_subscription]</span>
	  </div>
	</div>
	
	<div class="wh_pay_inputs">
	  <div class="col-sm-5 borders2">
	  <label for="inputEmail" id="sandbox_publish_key">View logged in user card details</label><br>
	   <span>[view_card_details]</span>
	  </div>
	</div>
	
	<div id="sandbox_keys">
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="sandbox_publish_key">Sandbox Merchant Key</label>
	   <input id="sandbox-publish-key" name="sandbox_merchant_key" value="<?php echo get_option('sandbox_merchant_key') ?>" class="form-control" type="text" placeholder="Enter Your sandbox Account Merchant Key" required>
	  </div>
	</div>
	
	<div class="wh_pay_inputs">
	
	  
	  <div class="col-sm-4 borders1">
	  <label for="inputEmail" id="sandbox_secret_key">Sandbox Public Key</label>
	  <input id="sandbox-secret-key" name="sandbox_public_key" value="<?php echo get_option('sandbox_public_key') ?>" class="form-control" type="text" placeholder="Enter Your sandbox Account Public Key" required>
	  </div>
	  
	</div>
	  
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="sandbox_publish_key">Sandbox Private Key</label>
	   <input id="sandbox-publish-key" name="sandbox_private_key" value="<?php echo get_option('sandbox_private_key') ?>"  class="form-control" type="text" placeholder="Enter Your sandbox Account Private Key" required>
	  </div>
	</div>
	</div>
	<div id="live_keys">
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="live_publish_key">Live Merchant Key</label>
	   <input id="live-publish-key" name="live_merchant_key" value="<?php echo get_option('live_merchant_key') ?>" class="form-control" type="text" placeholder="Enter Your Live Account Merchant Key" required>
	  </div>
	</div>
	
	<div class="wh_pay_inputs">
	
	  
	  <div class="col-sm-4 borders1">
	  <label for="inputEmail" id="live_secret_key">Live Public Key</label>
	  <input id="live-secret-key" name="live_public_key" value="<?php echo get_option('live_public_key') ?>" class="form-control" type="text" placeholder="Enter Your Live Account Public Key" required>
	  </div>
	  
	</div>
	  
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="live_publish_key">Live Private Key</label>
	   <input id="live-publish-key" name="live_private_key" value="<?php echo get_option('live_private_key') ?>"  class="form-control" type="text" placeholder="Enter Your Live Account Private Key" required>
	  </div>
	</div>
	
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="live_publish_key">Wishlist Member Website Name</label>
	   <input id="live-publish-key" pattern="https?://.+" name="wlm_website" value="<?php echo get_option('wlm_website') ?>"  class="form-control" type="url" placeholder="Enter Wishlist Member Website Name">
	  </div>
	</div>
	
	<div class="wh_pay_inputs">
	  <div class="col-sm-4 borders2">
	  <label for="inputEmail" id="live_publish_key">WLM API Key</label>
	   <input id="live-publish-key" name="wlm_api" value="<?php echo get_option('wlm_api') ?>"  class="form-control" type="text" placeholder="Enter Your Wishlist Member API Key">
	  </div>
	</div>
	
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Host</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" placeholder="Enter Host" name="mail_host_name" value="<?php echo get_option('mail_host_name') ?>" type="text" required>
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Port</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" placeholder="Enter Port" name="mail_port" value="<?php echo get_option('mail_port') ?>" type="text" required>
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Username</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" placeholder="Enter username" name="mail_username" value="<?php echo get_option('mail_username') ?>" type="text" required>
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Password</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" placeholder="Enter password" name="mail_password" value="<?php echo get_option('mail_password') ?>" type="password" required>
		</div>
	</div>
	
	<!---- Admin email template options ------->
	
	<?php
	if ( isset( $_POST['save'] ) && isset( $_POST['custom_admin_logo'] ) ) :
		update_option( 'custom_admin_logo_id', absint( $_POST['custom_admin_logo'] ) );
	endif;
	wp_enqueue_media();
	?>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Admin Upload Logo Image</label>
	</div>
		<div class="col-sm-4 wz_host_input">
		<?php
		if(get_option( 'custom_admin_logo_id' )){
		?>
		<div class='image-preview-wrapper'>
			<img id='image-preview1' src='<?php echo wp_get_attachment_url( get_option( 'custom_admin_logo_id' ) ); ?>' height='100'>
		</div>
		<?php
		}
		?>
		<input id="upload_image_button1" type="button" class="button" value="<?php _e( 'Upload Logo Image' ); ?>" />
		<input type='hidden' name='custom_admin_logo' id='image_attachment_id1' value='<?php echo get_option( 'custom_admin_logo_id' ); ?>'>
		
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Admin Email Template URL</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_admin_email_url" type="text" placeholder="Enter Admin Email Custom URL" value="<?php echo get_option( 'custom_admin_email_url' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Admin Email Subject</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_admin_email_subject_txt" type="text" placeholder="Enter Admin Email Subject Text" value="<?php echo get_option( 'custom_admin_email_subject_txt' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Admin Receiver Email</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_admin_to_email" type="text" placeholder="Enter Admin Receiver Email" value="<?php echo get_option( 'custom_admin_to_email' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Admin Sender Email</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_admin_email_from" type="text" placeholder="Enter Admin Sender Email" value="<?php echo get_option( 'custom_admin_email_from' ) ?>">
		</div>
	</div>
	
	<!-------------- Recepit email template options ------------------>
	
	<?php
	if ( isset( $_POST['save'] ) && isset( $_POST['custom_logo'] ) ) :
		update_option( 'custom_logo_id', absint( $_POST['custom_logo'] ) );
	endif;
	wp_enqueue_media();
	?>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Recepit Upload Logo Image</label>
	</div>
		<div class="col-sm-4 wz_host_input">
		<?php
		if(get_option( 'custom_logo_id' )){
		?>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'custom_logo_id' ) ); ?>' height='100'>
		</div>
		<?php
		}
		?>
		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload Logo Image' ); ?>" />
		<input type='hidden' name='custom_logo' id='image_attachment_id' value='<?php echo get_option( 'custom_logo_id' ); ?>'>
		
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Recepit Email Template URL</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_email_url" type="text" placeholder="Enter Email Custom URL" value="<?php echo get_option( 'custom_email_url' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Recepit Email Subject</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_email_subject_txt" type="text" placeholder="Enter Email Subject Text" value="<?php echo get_option( 'custom_email_subject_txt' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Recepit Email From</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="custom_email_from" type="text" placeholder="Enter Sender Email" value="<?php echo get_option( 'custom_email_from' ) ?>">
		</div>
	</div>
	
    <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Show Payment Form</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="payment_form_popup" <?php echo (get_option('payment_form_popup') == 'popup') ? 'checked' : 'required'; ?> value="popup"> On PopUp
		</label>
		
		<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="payment_form_popup" <?php echo (get_option('payment_form_popup') == 'page') ? 'checked' : 'required'; ?>
		  value="page"> On Page
		</label>
		
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Captcha Site Key</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="captcha_site_key" type="text" placeholder="Enter Site Key" value="<?php echo get_option( 'captcha_site_key' ) ?>">
		</div>
	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Captcha Secret Key</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<input class="custom_host" name="captcha_secret_key" type="text" placeholder="Enter Secret Key" value="<?php echo get_option( 'captcha_secret_key' ) ?>">
		</div>
	</div>
	
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_mail_host" id="ifYes" style="display: block;">
	<div class="wz_host">
	<label  style="margin-right:10px;margin-left10px;">Captcha Toggle</label>
	</div>
		<div class="col-sm-4 wz_host_input">
			<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="captcha_toggle" <?php echo (get_option('captcha_toggle') == 'on') ? 'checked' : 'required'; ?> value="on"> ON
		</label>
		
		<label class="form-check-label">
		  <input class="form-check-input wz_radios" type="radio" name="captcha_toggle" <?php echo (get_option('captcha_toggle') == 'off') ? 'checked' : 'required'; ?>
		  value="off"> OFF
		</label>
		
		</div>
	</div>
	
	<input type="submit" name="save" value="Save" class="btn btn-primary btn_save">
</div>

</form>
</div>