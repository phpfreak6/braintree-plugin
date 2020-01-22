<?php
/**
 * Plugin Name: Brain Tree Manage Payment Plugin
 * Plugin URI: http://www.iamwhiz.com
 * Description: This plugin adds different payment-forms of Braintree payments.
 * Version: 1.3.9
 * Author: Atul
 * Author URI: http://atul.iamwhiz.com
 * License: GPL2
 */
// register jquery and style on initialization


add_action('wp_enqueue_scripts', 'register_script');
function register_script() {
	
	wp_register_style( 'new_styles', plugins_url('/style-plugin.css', __FILE__));
	wp_register_script( 'custom_jquery', plugins_url('/js/bootstrap.min.js', __FILE__), array('jquery'), '1.1', true );
	wp_register_script( 'custom_jquery', plugins_url('/js/jquery.min.js', __FILE__), array('jquery'), '1.1', true );
	//wp_register_script( 'custom_jquerys', plugins_url('/js/captcha.js', __FILE__), array('jquery'), '1.1', true );
	wp_register_script( 'custom_jquery', plugins_url('/js/custom.js', __FILE__), array('jquery'), '1.1', true );
}
// use the registered jquery and style above
add_action('wp_enqueue_scripts', 'enqueue_style');
function enqueue_style(){
	wp_enqueue_style( 'new_styles' );
    wp_enqueue_script('custom_jquery');
	wp_enqueue_script('custom_jquerys');
}

/****
Database Query 
***/
register_activation_hook( __FILE__, 'create_plugin_database_table' );
function create_plugin_database_table() {
 global $wpdb;
 $table_name = $wpdb->prefix . 'braintree_payment_tbl';
 if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	//die('here');
 $sql = "CREATE TABLE IF NOT EXISTS $table_name (
 id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  uk_price varchar(50) NOT NULL,
  usa_price varchar(50) NOT NULL,
  aus_price varchar(50) NOT NULL,
  eur_price varchar(50) NOT NULL,
  postage_uk varchar(50) NOT NULL,
  postage_usa varchar(50) NOT NULL,
  postage_aus varchar(50) NOT NULL,
  postage_eur varchar(50) NOT NULL,
  merchant_id_uk varchar(255) NOT NULL,
  merchant_id_usa varchar(255) NOT NULL,
  merchant_id_aus varchar(255) NOT NULL,
  merchant_id_eur varchar(255) NOT NULL,
  level_id_uk varchar(255) NOT NULL,
  level_id_usa varchar(255) NOT NULL,
  level_id_aus varchar(255) NOT NULL,
  level_id_eur varchar(255) NOT NULL,
  descriptor_name_uk varchar(255) NOT NULL,
  descriptor_name_usa varchar(255) NOT NULL,
  descriptor_name_aus varchar(255) NOT NULL,
  descriptor_name_eur varchar(255) NOT NULL,
  plan_id_uk varchar(255) NOT NULL,
  update_plan_uk  varchar(255) NOT NULL,
  degrade_plan_uk varchar(255) NOT NULL,
  plan_id_usa varchar(255) NOT NULL,
  update_plan_usa  varchar(255) NOT NULL,
  degrade_plan_usa varchar(255) NOT NULL,
  plan_id_aus varchar(255) NOT NULL,
  update_plan_aus  varchar(255) NOT NULL,
  degrade_plan_aus varchar(255) NOT NULL,
  plan_id_eur varchar(255) NOT NULL,
  update_plan_eur varchar(255) NOT NULL,
  degrade_plan_eur varchar(255) NOT NULL,
  billing_address enum('yes','no') NOT NULL DEFAULT 'no',
  form_location varchar(255) NOT NULL,
  form_top_text varchar(255) NOT NULL,
  form_bottom_text varchar(255) NOT NULL,
  redirect_url varchar(255) NOT NULL,
  ex_custom_url varchar(255) NOT NULL,
  custom_url varchar(255) NOT NULL,
  button_label varchar(50) NOT NULL,
  fornt_btn_label varchar(255) NOT NULL,
  front_btn_css varchar(255) NOT NULL,
  course_text_uk varchar(255) NOT NULL,
  course_text_usa varchar(255) NOT NULL,
  course_text_aus varchar(255) NOT NULL,
  course_text_eur varchar(255) NOT NULL,
  
  additional_text_uk text NULL,
  additional_text_usa text NULL,
  additional_text_aus text NULL,
  additional_text_eur text NULL,
  
  custom_btn_css varchar(255) NOT NULL,
  bottom_text_css varchar(255) NOT NULL,
  top_text_css varchar(255) NOT NULL,
  custom_css varchar(255) NOT NULL,
  registrartion enum('yes','no') NOT NULL DEFAULT 'no',
  subscription enum('yes','no') NOT NULL DEFAULT 'no',
  additional_product enum('1','0') NOT NULL DEFAULT '0',
  status enum('enable','disable') NOT NULL DEFAULT 'enable',
  PRIMARY KEY  (id)
 );";
 
 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
 }else{
	//die('there');
	$wpdb->query("ALTER TABLE $table_name ADD ex_custom_url text NULL");
	$wpdb->query("ALTER TABLE $table_name ADD additional_product enum('1','0') NOT NULL DEFAULT '0'");
	$wpdb->query("ALTER TABLE $table_name ADD fornt_btn_label varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD front_btn_css varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD additional_text_uk text NULL");
	$wpdb->query("ALTER TABLE $table_name ADD additional_text_usa text NULL");
	$wpdb->query("ALTER TABLE $table_name ADD additional_text_aus text NULL");
	$wpdb->query("ALTER TABLE $table_name ADD additional_text_eur text NULL");
	
	
	$wpdb->query("ALTER TABLE $table_name ADD update_plan_uk  varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD update_plan_usa varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD update_plan_aus varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD update_plan_eur varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD degrade_plan_uk  varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD degrade_plan_usa varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD degrade_plan_aus varchar(255) NOT NULL");
	$wpdb->query("ALTER TABLE $table_name ADD degrade_plan_eur varchar(255) NOT NULL");
	
 }

}

register_activation_hook( __FILE__, 'create_plugin_database_history_table' );
function create_plugin_database_history_table() {
 global $wpdb;
 $histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
 if($wpdb->get_var("SHOW TABLES LIKE '$histry_table_name'") != $histry_table_name) {
	//die('here');
 $sql = "CREATE TABLE IF NOT EXISTS $histry_table_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  btn_id int(11) NOT NULL,
  country varchar(50) NOT NULL,
  transcation_id varchar(50) NOT NULL,
  subscription_id varchar(50) NOT NULL,
  level_id varchar(50) NOT NULL,
  status enum('active','cancelled') NOT NULL DEFAULT 'active',
  label_status enum('active','cancelled') NOT NULL DEFAULT 'active',
  subs_end_date date NOT NULL,
  PRIMARY KEY  (id)
 );";
 
 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
 }else{
	 
	$wpdb->query("ALTER TABLE $histry_table_name ADD country  varchar(50) NOT NULL");
	$wpdb->query("ALTER TABLE $histry_table_name ADD btn_id int(11) NOT NULL");
	$wpdb->query("ALTER TABLE $histry_table_name ADD status enum('active','cancelled') NOT NULL DEFAULT 'active'");
	$wpdb->query("ALTER TABLE $histry_table_name ADD label_status enum('active','cancelled') NOT NULL DEFAULT 'active'");
	$wpdb->query("ALTER TABLE $histry_table_name ADD subs_end_date date NOT NULL");
	 
 }

}



add_action('admin_menu', 'braintree_payment');
function braintree_payment(){

add_menu_page(' BrainTree Payments', ' BrainTree Payments ', 'administrator','view_payments', 'braintree_payment_menu_page');

add_submenu_page('view_payments', 'Add Button', 'Add Button', 'administrator', 'add_button', 'braintree_payment_sub_menu_page'); 

add_submenu_page('view_payments', 'Settings', 'Settings', 'administrator', 'settings', 'braintree_payment_sub_menu_page2'); 

}

function braintree_payment_menu_page()
{	
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
    include_once "templates/view_all_payments.php";
}

function braintree_payment_sub_menu_page()
{	
	global $wpdb;
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
    include_once "templates/add_new_payment.php";
}

function braintree_payment_sub_menu_page2(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	include_once "templates/settings.php";
	
}



function brainTreePayment($atts)
{ 
 //echo $id = $atts['id'];
	ob_start();
    // normalize attribute keys, lowercase
	global $wpdb;
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	$id = $atts['id'];
	$total = $wpdb->get_row( "SELECT * FROM $table_name where id = $id");
	$topcolor = $total->top_text_css;
	$bottomcolor = $total->bottom_text_css;
	$btncolor = $total->custom_btn_css;
	$front_btncolor = $total->custom_css;
	$front_btn_text = ($total->fornt_btn_label) ? $total->fornt_btn_label : 'Pay Now';
	$front_btn_css = $total->front_btn_css;
	if(empty($topcolor)){
		$topcolor = '#23282D';
	}elseif(empty($bottomcolor)){
		$bottomcolor = '#23282D';
	}elseif(empty($btncolor)){
		$btncolor = '#f7b977';
	}elseif(empty($front_btncolor)){
		$front_btncolor = '#7E7E7E';
	}
	elseif(empty($front_btn_css)){
		$front_btn_css = '#fff';
	}
	require 'vendor/autoload-new.php';
	
 		// include braintree configuration
	require_once 'vendor/productionconfig.php'; 
	// wp localize script (to share php with JS)
	
	$user_ID = get_current_user_id();
		if(get_option('braintree_payment_mode') == 'sandbox'){
			$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
		}else{
			$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
		}
	
	if($customer_id){
		$clientToken = Braintree_ClientToken::generate(['customerId'=>$customer_id]);
	}else{			
		$clientToken = Braintree_ClientToken::generate();	
	}
	
	$wk_logged_user = wp_get_current_user();
	$payName	 = '';
	$paylastName = '';
	$payEmail	 = '';
	if($wk_logged_user){
		$payName 	 = $wk_logged_user->user_firstname;
		$paylastName = $wk_logged_user->user_lastname ;
		$payEmail 	 = $wk_logged_user->user_email;
	}
	
	
    // for show first product price etc.
	global $wpdb;
	$tablename = $wpdb->prefix . 'braintree_payment_tbl';
	$total = $wpdb->get_row( "SELECT * FROM $tablename where id = $id");		
	
	// for show extra product price etc.
	global $wpdb;
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	$add_prod_total = $wpdb->get_row( "SELECT * FROM $table_name where additional_product  = '1'");
		
	
	
	
	
	if(get_option('payment_form_popup') == 'page'){
		$captcha_toggle= get_option('captcha_toggle');
		 $payment_form_on_page = get_option('payment_form_popup');
		   $additional_product= $add_prod_total->additional_product;
		  $additional_product_id= $add_prod_total->id;
		  $price;
       
		$html.='<form id="fullcourse on_page" class="wk_form payment-form-'.$id.'"   data-id="'.$id.'" method="post">
				<div class="modal-body">';
				$html .=($total->form_location == "top")?
					'<div class="wz_user_detail">
						<div class="one_half">
						<input name="firstname" placeholder="First Name" required="" type="text" value="'.$payName.'">
						</div>
						<div class="one_half et_column_last">
						<input name="lastname" placeholder="Last Name" required="" type="text" value="'.$paylastName.'"> </div>
						<div class="clear"></div>
						<div class="on_2 hide_left"><input name="email" placeholder="Email" required="" type="email" value="'.$payEmail.'">
						</div>
					</div>':'';
						$html .='<div id="dropin-container-'.$id.'"></div>';
						$html .='<div class="row">';
						$html .='<div id="payment-form-'.$id.'"> </div>';
						$html .=($total->form_location == "center")?
						'<div class="wz_user_detail" style="margin-top:25px;">
							<div class="one_half">	
							<input name="firstname" placeholder="First Name" required="" type="text" value="'.$payName.'">
							</div>
							<div class="one_half et_column_last"> 
							<input name="lastname" placeholder="Last Name" required="" type="text" value="'.$paylastName.'"> </div>
							<div class="clear"></div>
							<div class="on_2 hide_left"><input name="email" placeholder="Email" required="" type="email" value="'.$payEmail.'">
							</div>
						</div>':'';
						 if( $additional_product_id != $id && $additional_product =='1' ){ 
						 
						$html .='<div id="add_prod" style="border:1px solid grey; width:50%;padding:10px;"> <h4> Additional Product</h4> <p><input type="checkbox" name="addition_product_check" id="'.$id.'"  class="addition_product_check" value="'.$additional_product_id.'"> '.$add_prod_total->name.' (<b class="exr_pro_pri_chk-'.$id.'">'.$ex_prod_totalprice.'</b>)</p> 
                  				
						</div>';
						$html .='<table >
						<tr>
						<th>Item</th>
						<th>Amount</th>
						</tr>
						<tr>
						
						<td>'.$total->name.' </td>
						<td class="total_price-'.$id.'">'.$totalprice.'</td>
																
						</tr>';
                    					
						$html .='<tr id="exr_pro_detail-'.$id.'" style="display:none;">
						
						<td>'.$add_prod_total->name.' </td>
						<td id="exr_pro_pr-'.$id.'">'.$ex_prod_totalprice.'</td>
																
						</tr>';	
					 							
			            $html .='</table>';
						}
						 
						if($captcha_toggle == "on"){
						 $html .='<div class="g-recaptcha" data-sitekey="'.get_option('captcha_site_key').'"></div>';
					    }
						
						$html .=($total->billing_address == "yes")?
						
						'<div class="wz_delivery_address">
						<h4>Delivery Address</h4>
						<p>                
						<label>Address:</label>
								<input type="text" name="address" placeholder="address" required="">
								<label>City: </label>
								<input type="text" name="city" placeholder="city">
								<label>State / County: </label>
								<input type="text" name="state" placeholder="state" required="">
								<label>Zip / Postcode:</label>
								<input type="text" name="zip" placeholder="zip" required="">
								<label>Country:</label>
								<input type="text" name="country" placeholder="country" required="">
								<!--<input type="submit" class="btn" value="?? Pre-Order My Certificate">--><br>
							</p>
						</div>':"";
						$html .='</div>
						</form>
							<div class="server-error">
							  <div class="server-error-message-container">
								<div class="server-error-message" style="text-align:center;">
								
								</div>
								<div class="response_message" style="text-align:center;">
								
								</div>
							  </div>
							</div>
							
			<div class="new_btn">';
			$html .=(empty($total->button_label))?
				'<input class="btn lock_wh pk_subbtn" value="Unlock My Course >>" type="submit" style="background-color:'.$btncolor.' !important;">':
				'<input class="btn pk_subbtn" value="'.$total->button_label .'" type="submit" style="background-color:'.$btncolor.' !important;">';
				$html .='<ul>
				<li><img src="'.plugins_url('/images/card.png', __FILE__).'"</li>

				</ul>

				<small class="custom_style_text" style="color:'.$bottomcolor.' !important;">';
				$html .=(empty($total->form_bottom_text))?
				'60-day money-back guarantee.<br> Lifetime access.':
				$total->form_bottom_text;
				$html .='</small>
			</div>	
					<input name="payment_method_nonce" class="payment_method_nonce" value="" type="hidden">
					<input type="hidden" name="form_id" value="'.$id.'">
					<input type="hidden" name="country" value="" class="country">
					<input type="hidden" name="action" class="action" value="braintreeCharge">
					
					
					
					<input type="hidden" name="ex_prod_form_id" id="ex_prod_form_id-'.$id.'" value="">
					<input type="hidden" name="ex_prod_country" value="" class="country">
					<input type="hidden" name="ex_prod_level" class="ex_prod_level"  value="" >
					<input type="hidden" name="ex_prod_plan" class="ex_prod_plan" value="" >
					<input type="hidden" name="ex_prod_descname" class="ex_prod_descname"  value="" >
					<input type="hidden" name="ex_prod_merchantID" class="ex_prod_merchantID"  value="" >
					
					<input type="hidden" name="f_pro_price" class="f_pro_price-'.$id.'" value="" >
					<input type="hidden" name="ex_prod_price" class="ext_pro_price-'.$id.'" value="" >
					<input type="hidden" name="totalAmount" class="f_pro_price-'.$id.' totalAmount-'.$id.'" value="" >
				</div>
				</form>';
	}
			?>
		<script type="text/javascript">
		
jQuery(document).ready(function($){
	
	$('.addition_product_check').click(function(){
	var F_ID = $(this).attr("id");
	
     
	 
		$('.totalAmount-'+ F_ID).removeClass("f_pro_price-"+ F_ID);
		var checkbox = $(this).val();

		if($(this).is(':checked') ){
		$('#exr_pro_detail-'+ F_ID).show();
		
	    $('#ex_prod_form_id-'+ F_ID).val(checkbox);
		var f_pro_price =  parseInt($(".f_pro_price-"+ F_ID).val());
		
	    var ext_pro_price =  parseInt($(".ext_pro_price-"+ F_ID).val());
	    var totalAmount = f_pro_price + ext_pro_price;
	    $('.totalAmount-'+ F_ID).val(totalAmount);
	
		}else{
			
		$('#exr_pro_detail-'+ F_ID).hide();
		
		$('#ex_prod_form_id-'+ F_ID).val('');
		var f_pro_price =  parseInt($(".f_pro_price-"+ F_ID).val());
	    var totalAmount = f_pro_price;
	    $('.totalAmount-'+ F_ID).val(totalAmount);
	 
	
		}
		
	});
	
	
});
</script>
<?php
	
		if(get_option('payment_form_popup') == 'popup'){
		  $captcha_toggle= get_option('captcha_toggle');
		  $additional_product= $add_prod_total->additional_product;
	      $additional_product_id= $add_prod_total->id;
	      $price;
	$html .= '<button type="button" data-id="'.$id.'" style="background-color:'.$front_btncolor.' !important;color:'.$front_btn_css.' !important;" class="et_pb_button wk_cl_btn wk_btn" data-toggle="modal" data-target="#wz_show_pay_form_'.$id.'">'.$front_btn_text.'</button>';
	
	$html .='<!-- Modal -->
			<div class="pk_loader" style="display:none;">
				<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
			</div>
	<div class="modal fade wz_show_pay_form wz_show_pay_form_'.$id.'" id="wz_show_pay_form_'.$id.'" role="dialog">
		<div class="modal-dialog">
    
		  <!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" style="float:right;">&times;</button>
				  <h4 class="modal-title custom_style_text" style="color:'.$topcolor.' !important;margin-left:15px;text-align:justify;">';
				  $html .=(empty($total->form_top_text))?
					"You're One Step Away from World-Class Training.<img class='emoji' draggable='false' alt='ðŸ”’' src='https://s.w.org/images/core/emoji/2.2.1/svg/1f512.svg'> Spread the cost with PayPal or Credit Card:":
				  $total->form_top_text;
				  
				  $html .='</h4>
				</div>
				<form id="fullcourse on_popup" class="wk_form payment-form-'.$id.'"   data-id="'.$id.'" method="post">
				<div class="modal-body">';
				$html .=($total->form_location == "top")?
					'<div class="wz_user_detail">
						<div class="one_half">
						<input name="firstname" placeholder="First Name" required="" type="text" value="'.$payName.'">
						</div>
						<div class="one_half et_column_last">
						<input name="lastname" placeholder="Last Name" required="" type="text" value="'.$paylastName.'"> </div>
						<div class="clear"></div>
						<div class="on_2 hide_left"><input name="email" placeholder="Email" required="" type="email" value="'.$payEmail.'">
						</div>
					</div>':'';
					$html .='
						<div class="row">
						';
						$html .='<div id="payment-form-'.$id.'"> </div>';
						$html .=($total->form_location == "center")?
						'<div class="wz_user_detail" style="margin-top:25px;">
							<div class="one_half">	
							<input name="firstname" placeholder="First Name" required="" type="text" value="'.$payName.'">
							</div>
							<div class="one_half et_column_last"> 
							<input name="lastname" placeholder="Last Name" required="" type="text" value="'.$paylastName.'"> </div>
							<div class="clear"></div>
							<div class="on_2 hide_left"><input name="email" placeholder="Email" required="" type="email" value="'.$payEmail.'">
							</div>
						</div>':'';
						$html .='<div id="dropin-container-'.$id.'"></div>';
						if( $additional_product_id != $id && $additional_product =='1' ){ 
						$html .='<div id="add_prod" style="border:1px solid grey; width:50%;padding:10px;"> <h4> Additional Product</h4> <p><input type="checkbox" name="addition_product_check" id="'.$id.'" value="'.$additional_product_id.'" class="addition_product_check"> '.$add_prod_total->name.' (<b class="exr_pro_pri_chk-'.$id.'">'.$ex_prod_totalprice.'</b>)</p> 
                  				
						</div>';
						$html .='<table >
						<tr>
						<th>Item</th>
						<th>Amount</th>
						</tr>
						<tr>
						
						<td>'.$total->name.' </td>
						<td class="total_price-'.$id.'">'.$totalprice.'</td>
																
						</tr>';
                    					
						$html .='<tr id="exr_pro_detail-'.$id.'" style="display:none;">
						
						<td>'.$add_prod_total->name.' </td>
						<td id="exr_pro_pr-'.$id.'">'.$ex_prod_totalprice.'</td>
																
						</tr>';	
					 							
			            $html .='</table>';
						 }
						 if($captcha_toggle == "on"){
						 $html .='<div class="g-recaptcha" data-sitekey="'.get_option('captcha_site_key').'"></div>';
					     }
						$html .=($total->billing_address == "yes")?
						'<div class="wz_delivery_address">
						<h4>Delivery Address</h4>
						<p>                
						<label>Address:</label>
								<input type="text" name="address" placeholder="address" required="">
								<label>City: </label>
								<input type="text" name="city" placeholder="city">
								<label>State / County: </label>
								<input type="text" name="state" placeholder="state" required="">
								<label>Zip / Postcode:</label>
								<input type="text" name="zip" placeholder="zip" required="">
								<label>Country:</label>
								<input type="text" name="country" placeholder="country" required="">
								<!--<input type="submit" class="btn" value="?? Pre-Order My Certificate">--><br>
							</p>
						</div>':"";
						$html .='</div>
						</form>
							<div class="server-error">
							  <div class="server-error-message-container">
								<div class="server-error-message" style="text-align:center;">
								
								</div>
								<div class="response_message" style="text-align:center;">
								
								</div>
							  </div>
							</div>
							
			<div class="new_btn">';
			$html .=(empty($total->button_label))?
				'<input class="btn lock_wh pk_subbtn" value="Unlock My Course >>" type="submit" style="background-color:'.$btncolor.' !important;">':
				'<input class="btn pk_subbtn" value="'.$total->button_label .'" type="submit" style="background-color:'.$btncolor.' !important;">';
				$html .='<ul>
				<li><img src="'.plugins_url('/images/card.png', __FILE__).'"</li>

				</ul>

				<small class="custom_style_text" style="color:'.$bottomcolor.' !important;">';
				$html .=(empty($total->form_bottom_text))?
				'60-day money-back guarantee.<br> Lifetime access.':
				$total->form_bottom_text;
				$html .='</small>
			</div>	
					<input name="payment_method_nonce" class="payment_method_nonce" value="" type="hidden">
					<input type="hidden" name="form_id" value="'.$id.'">
					<input type="hidden" name="country" value="" class="country">
					<input type="hidden" name="action" class="action" value="braintreeCharge">
					
					<input type="hidden" name="ex_prod_form_id" id="ex_prod_form_id-'.$id.'" value="">
			    	<input type="hidden" name="ex_prod_country" value="" class="country">
					<input type="hidden" name="ex_prod_level" class="ex_prod_level"  value="" >
					<input type="hidden" name="ex_prod_plan" class="ex_prod_plan" value="" >
					<input type="hidden" name="ex_prod_descname" class="ex_prod_descname"  value="" >
					<input type="hidden" name="ex_prod_merchantID" class="ex_prod_merchantID"  value="" >
				
					<input type="hidden" name="f_pro_price" class="f_pro_price-'.$id.'" value="" >
					<input type="hidden" name="ex_prod_price" class="ext_pro_price-'.$id.'" value="" >
					<input type="hidden" name="totalAmount" class="f_pro_price-'.$id.' totalAmount-'.$id.'" value="" >
					
					
				</div>
				</form>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
      
		</div>
	</div>';
	}
	/****
	Payment script
	****/
	$html .='<script src="https://js.braintreegateway.com/web/dropin/1.19.0/js/dropin.min.js"></script>
			<script src = "https://js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js" type ="text/javascript"></script>
			<script>
			var form_new_id = "'.$id.'";
				
				
				if(form_new_id == form_id){
					jQuery(document).ready(function() {
						jQuery(".wz_show_pay_form_'.$id.'").not(":last").remove();
						jQuery(".wk_btn").on("click", function() {
							jQuery(".payment_method_nonce").val("");
							
						});
						
					});

				}else{
								var form_id = "'.$id.'";
							
								jQuery(document).ready(function() {
								
								var payment_form = "'.$payment_form_on_page.'";

									if(payment_form == "page")
									{
										jQuery(".wk_btn").hide();
										jQuery("#on_popup").remove();

										var braintdrop = braintree.dropin.create({
											authorization: \''.$clientToken.'\',
											container: "#dropin-container-'.$id.'",
											vaultManager: true,
											 paypal: {
												flow: "vault"
											},
											threeDSecure: true
										})
										braintdrop.then(function(instance) {
											dropin = instance;
										}).catch(function (err) {
											if(err.message=="3D Secure failed to set up."){
												jQuery(".payment-form-'.$id.'").find(".server-error-message").html(err.message);
											}
											console.log("component error:", err);
										});

									}else{
										jQuery("#on_page").remove();
										
										jQuery(".et_pb_button").click(function(){
											
											jQuery("form").each(function(){                  //to show only one payment form on clicks
												var form_idd = jQuery(this).attr("data-id");
												if(form_idd != "'.$id.'"){
													jQuery("#dropin-container-"+form_idd).empty();
												}
											});
																			
											var button_id = jQuery(this).attr("data-id");
											var braintdrop = braintree.dropin.create({
											authorization: \''.$clientToken.'\',
											container: "#dropin-container-"+button_id,
											vaultManager: true,
											 paypal: {
												flow: "vault"
											},
											threeDSecure: true
											})
											braintdrop.then(function(instance) {
											dropin = instance;
											}).catch(function (err) {
												if(err.message=="3D Secure failed to set up."){
												jQuery(".payment-form-'.$id.'").find(".server-error-message").html(err.message);
												}
												console.log("component error:", err);
											});

										});
									}   
								
									 
								 jQuery( ".payment-form-'.$id.'" ).submit(function( e ) {
											e.preventDefault();
											var totalAmount = jQuery(".totalAmount-'.$id.'").val();
											var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
											
											dropin.requestPaymentMethod({
											  threeDSecure: {
												amount: totalAmount
											  }
											}, function (err, payload) {
												if (err) {
													jQuery(".payment-form-'.$id.'").find(".server-error-message").html(err.message);
													console.log("tokenization error:");
													return;
												}else{
													jQuery(".payment-form-'.$id.'").find(".server-error-message").html("");
													jQuery(".payment-form-'.$id.'").find(".payment_method_nonce").val(payload.nonce);
													//jQuery(".payment-form-'.$id.'").submit();
													jQuery(".pk_loader").show();
													jQuery(".pk_subbtn").prop("disabled", true);
													jQuery.ajax({
													  url	: ajaxurl,
													  type  : "POST",
													  action:jQuery(".payment-form-'.$id.'").find(".action").val(),
													  data:jQuery(".payment-form-'.$id.'").serialize(),
													  success: function(html){
														 html = jQuery.parseJSON(html);
														
														//jQuery(".payment-form-'.$id.'").find(".server-error-message").append(html);
														if(html.status == true){
															jQuery(".pk_loader").hide();
															jQuery(".payment-form-'.$id.'").find(".response_message").html(html.message);
															jQuery(".payment-form-'.$id.'").find(".response_message").css("color","green");
															window.location = html.redirect;
														}else{
															jQuery(".pk_loader").hide();
															jQuery(".payment-form-'.$id.'").find(".response_message").html(html.message);
															jQuery(".payment-form-'.$id.'").find(".response_message").css("color","red");
															jQuery(".pk_subbtn").prop("disabled", false);
															
														}
													  }
													});
												}
											});
											
									 });
								
							
							});
							
							jQuery(document).ready(function() {
							try { 
								var onSuccess = function(location) {
								jQuery(".payment-form-'.$id.'").find(".country").val(location.country.iso_code);
								var dyn_country = jQuery(".payment-form-'.$id.'").find(".country").val(location.country.iso_code);
                                    
								};
								var onError = function(error) {
									jQuery(".payment-form-'.$id.'").find(".country").val("usa");
									var dyn_country = jQuery(".payment-form-'.$id.'").find(".country").val("usa");
								};
								 geoip2.country(onSuccess, onError);
								} catch (err) {
									
									jQuery(".payment-form-'.$id.'").find(".country").val("usa");
									
								}
								
							 });
					
				}
				var form_id = "'.$id.'";
	
			</script>';		 
	
	
	
	if(isset($_POST['id'])){
		
		echo $html;
		die();
	}else{
	echo  $html;
	$output_string = ob_get_clean();
	return $output_string; 
	}
	
	
}

/*****
Brain Tree Payment Shortcode
****/
function wporg_shortcodes_init()
{
    add_shortcode('brainTreePayment', 'brainTreePayment');
}
add_action('init', 'wporg_shortcodes_init');


/**********************************************************
ajax function to delete the payment card
**********************************************************/
add_action( 'wp_ajax_del_card', 'del_card' );
add_action( 'wp_ajax_nopriv_del_card', 'del_card' );

function del_card(){
	
	require 'vendor/autoload-new.php';
	require_once 'vendor/productionconfig.php';
	
	// Get user ID
	$user_ID = get_current_user_id();
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	$creditCardToken = $_POST['token'];
	
	if($customer_id){
		
		try{
			$token = \Braintree\CreditCard::delete($creditCardToken);
			echo json_encode(array("status"=>true,"message"=>"Card Delete Successfully !"));
		
		}catch(Exception $e) {
			echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
		}
		
	}
	die;
}

/**********************************************************
ajax function to set card as default 
**********************************************************/
add_action( 'wp_ajax_default_card', 'default_card' );
add_action( 'wp_ajax_nopriv_default_card', 'default_card' );

function default_card(){
	require 'vendor/autoload-new.php';
	require_once 'vendor/productionconfig.php';
	
	// Get user ID
	global $wpdb;
	$user_ID = get_current_user_id();
	$table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	$creditCardToken = $_POST['token'];
	
	if($customer_id){
		
		try{
			$token = \Braintree\CreditCard::update($creditCardToken, [
				'options' => ['makeDefault' => true]
			]);
		//echo json_encode(array("status"=>true,"message"=>"Card set as default successfully!"));
		
		}catch(Exception $e) { 
			//echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
		}
		$subscriptions = $wpdb->get_results( "SELECT * FROM $table_name where user_id = $user_ID AND status='active' AND subscription_id !=''", ARRAY_A);
		
		if(!empty($subscriptions)){
			try{
				foreach($subscriptions as $subscription){
					$subscription = \Braintree\Subscription::update($subscription['subscription_id'], [
							'id' => $subscription['subscription_id'],
							'paymentMethodToken' => $creditCardToken
						]);
								
				}
				echo json_encode(array("status"=>false,"message"=>"Card set as default successfully!"));
				
			}catch(Exception $e) {
				echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"message"=>"Card set as default successfully!"));
		}
		
	}
	die;
}


/**********************************************************
ajax function to Cancel the payment subscription
**********************************************************/
add_action( 'wp_ajax_del_subscription', 'del_subscription' );
add_action( 'wp_ajax_nopriv_del_subscription', 'del_subscription' );

function del_subscription(){
	
	require 'vendor/autoload-new.php';
	
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	
	$api = new wlmapiclass(($api_website) ? $api_website : 'https://www.writestorybooksforchildren.com', ($api_ky) ? $api_ky : '15f0e0f4bb1d3d109fa6f6f732a941c3');
	$api->return_format = 'php';
	
	global $wpdb;
	
	// Get user ID
	$user_ID = get_current_user_id();
	
	$cancel_subscription = $_POST['subscription'];
	$find = Braintree_Subscription::find($cancel_subscription);
	$cancel_date = $find->nextBillingDate->format('Y-m-d'); // Get subscription cancel date and change date format.
	
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	// Get level ID
	$table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	$total = $wpdb->get_row( "SELECT * FROM $table_name where user_id = $user_ID AND subscription_id = '$cancel_subscription'");
	$total->level_id;
	$id = $total->id;
	if($customer_id){
		$userInfo = wp_get_current_user();
		$userEmail = $userInfo->user_email;
		$userName = $userInfo->user_nicename;
		try{
			$subscription = Braintree_Subscription::cancel($cancel_subscription);
			
			// $user_levels = array_keys(WLMAPI::GetUserLevels($user_ID));
			// $result = WLMAPI:: CancelLevel($user_ID,$total->level_id);
			// $wpdb->query("UPDATE $table_name SET status='cancelled' WHERE id = $id");
			$wpdb->query("UPDATE $table_name SET status='cancelled',subs_end_date='$cancel_date' WHERE id = $id");
			echo json_encode(array("status"=>true,"message"=>"Subscription Cancel Successfully !"));
			user_cancel_subs_notification($userEmail,$userName);
			admin_cancel_subs_notification($userEmail,$userName);
		
		}catch(Exception $e) {
			echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
		}
		
	}
	die;
}


/*****************************************************
ajax function for upgrade the monthly plan to annually
*****************************************************/
add_action( 'wp_ajax_upgradePlan', 'upgradePlan' );
add_action( 'wp_ajax_nopriv_upgradePlan', 'upgradePlan' );

function upgradePlan(){
	
	require 'vendor/autoload-new.php';
	
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	
	$api = new wlmapiclass(($api_website) ? $api_website : 'https://www.writestorybooksforchildren.com', ($api_ky) ? $api_ky : '15f0e0f4bb1d3d109fa6f6f732a941c3');
	$api->return_format = 'php';
	
	global $wpdb;
	$user_ID = get_current_user_id(); // Get current user ID
	
	$plan = $_POST['upgrade_planid'];
	$cancel_subscription = $_POST['subscription'];
	$html = '';
	
	$find = Braintree_Subscription::find($cancel_subscription); // Find subscription using subscription ID.
	
	$token = $find->paymentMethodToken; // Get token.
	
	// check if payment mode is in sandbox mode or in production mode.
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	//Define table name
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	
	// Get level ID
	$total = $wpdb->get_row( "SELECT * FROM $histry_table_name where user_id = $user_ID AND subscription_id = '$cancel_subscription'");
	
	
	$label_ID = $total->level_id;
	$btn_id = $total->btn_id;
	$country = $total->country;
	$subsscription = $total->subscription_id;
	$id = $total->id;
	
	// get plan name and country name using button ID.
	$joins = $wpdb->get_row("SELECT * FROM $histry_table_name INNER JOIN $table_name ON $histry_table_name.btn_id = $table_name.id where subscription_id = '$subsscription'");
	
	$update_plan = 'update_plan_'.$joins->country;
	$degrade_plan = 'degrade_plan_'.$joins->country;
	if(isset($customer_id)){
		
		$userInfo = wp_get_current_user();
		$userEmail = $userInfo->user_email;
		$userName = $userInfo->user_nicename;
		
		try{
			
			$subscription = Braintree_Subscription::cancel($cancel_subscription); // Cancel subscription
			
			$wpdb->query("UPDATE $histry_table_name SET status='cancelled' WHERE id = $id");
			
			$create_subs = Braintree_Subscription::create([
							'paymentMethodToken' => $token,
							'planId' => $plan
			]);
			
			if($create_subs->subscription->id){
				
				$subscription_id = $create_subs->subscription->id;
				
				//Insert new plan with subscription
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id,country,btn_id) VALUES ('$user_ID', '', '$subscription_id', '$label_ID', '$country','$btn_id')");
				// echo '<pre>'; print_r($create_subs); echo '</br>'; print_r($create_subs->subscription->id);
				$StartDate = $create_subs->subscription->billingPeriodStartDate;
				$EndDate = $create_subs->subscription->billingPeriodEndDate; 
				$newdate = $StartDate->diff($EndDate);
				
				
				$html .='<tr id="'.$subscription_id .'" class="new_row">
						<td>'.$subscription_id .'</td>
						<td>'.ucfirst($create_subs->subscription->planId).'</td>';
						if($newdate->days < '32'){
							if($joins->$update_plan){
							$html .='<td><a href="javascript:void(0)" data-upgrade="'.$subscription_id .'" data-pid="'.$joins->$update_plan .'" class="pk_upgrade_plan">Upgrade to Annually</a></td>';
							}
						}else{
							if($joins->$degrade_plan){
							$html .='<td><a href="javascript:void(0)" data-degrade="'.$subscription_id .'" data-deid="'.$joins->$degrade_plan .'" class="pk_degrade_plan">Downgrade to Monthly</a></td>';
							}
						}
				$html .='</tr>';
				
				echo json_encode(array("status"=>true,"message"=>"Subscription Upgrade Successfully !","display"=>$html));
				
			}else{
				
				echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
				
			}
			
		}catch(Exception $e) {
			echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
		}
	}
	
	die;
}

/******************************************************
ajax function for degrade the annually plan to monthly
******************************************************/
add_action( 'wp_ajax_degradePlan', 'degradePlan' );
add_action( 'wp_ajax_nopriv_degradePlan', 'degradePlan' );

function degradePlan(){
	
	require 'vendor/autoload-new.php';
	
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	
	$api = new wlmapiclass(($api_website) ? $api_website : 'https://www.writestorybooksforchildren.com', ($api_ky) ? $api_ky : '15f0e0f4bb1d3d109fa6f6f732a941c3');
	$api->return_format = 'php';
	
	$table_name = $wpdb->prefix . 'braintree_payment_tbl'; // Define table name.
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl'; // Define table name.
	
	global $wpdb;
	
	$user_ID = get_current_user_id(); // Get current user ID;
	$action = $_POST['action'];
	$cancel_subscription = $_POST['subscription'];
	$find = Braintree_Subscription::find($cancel_subscription);
	$token = $find->paymentMethodToken;
	// $html = '';
	$plan = $_POST['degrade_planid'];
	$cancel_subscription = $_POST['subscription'];
	$html = '';
	
	
	
	// check if payment mode is in sandbox mode or in production mode.
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	//Define table name
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	
	// Get level ID
	$total = $wpdb->get_row( "SELECT * FROM $histry_table_name where user_id = $user_ID AND subscription_id = '$cancel_subscription'");
	// echo "SELECT * FROM $histry_table_name where user_id = $user_ID AND subscription_id = '$cancel_subscription'"; echo '<pre>'; print_r($total); die("okay");
	$label_ID = $total->level_id;
	$btn_id = $total->btn_id;
	$country = $total->country;
	$subsscription = $total->subscription_id;
	$id = $total->id;
	
	// get plan name and country name using button ID.
	$joins = $wpdb->get_row("SELECT * FROM $histry_table_name INNER JOIN $table_name ON $histry_table_name.btn_id = $table_name.id where subscription_id = '$subsscription'");
	
	$update_plan = 'update_plan_'.$joins->country;
	$degrade_plan = 'degrade_plan_'.$joins->country;
	if(isset($customer_id)){
		
		$userInfo = wp_get_current_user();
		$userEmail = $userInfo->user_email;
		$userName = $userInfo->user_nicename;
		
		try{
			
			$subscription = Braintree_Subscription::cancel($cancel_subscription); // Cancel subscription
			
			$wpdb->query("UPDATE $histry_table_name SET status='cancelled' WHERE id = $id");
			
			$create_subs = Braintree_Subscription::create([
							'paymentMethodToken' => $token,
							'planId' => $plan
			]);
			
			if($create_subs->subscription->id){
				
				$subscription_id = $create_subs->subscription->id;
				
				//Insert new plan with subscription
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id,country,btn_id) VALUES ('$user_ID', '', '$subscription_id', '$label_ID', '$country','$btn_id')");
				
				$StartDate = $create_subs->subscription->billingPeriodStartDate;
				$EndDate = $create_subs->subscription->billingPeriodEndDate; 
				$newdate = $StartDate->diff($EndDate);
				
				
				$html .='<tr id="'.$subscription_id .'" class="new_row">
						<td>'.$subscription_id .'</td>
						<td>'.ucfirst($create_subs->subscription->planId).'</td>';
						if($newdate->days < '32'){
							if($joins->$update_plan){
							$html .='<td><a href="javascript:void(0)" data-upgrade="'.$subscription_id .'" data-pid="'.$joins->$update_plan .'" class="pk_upgrade_plan">Upgrade to Annually</a></td>';
							}
						}else{
							if($joins->$degrade_plan){
							$html .='<td><a href="javascript:void(0)" data-degrade="'.$subscription_id .'" data-deid="'.$joins->$degrade_plan .'" class="pk_degrade_plan">Downgrade to Monthly</a></td>';
							}
						}
				$html .='</tr>';
				
				echo json_encode(array("status"=>true,"message"=>"Subscription Upgrade Successfully !","display"=>$html));
				
			}else{
				
				echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
				
			}
			
		}catch(Exception $e) {
			echo json_encode(array("status"=>false,"message"=>"Something went wrong."));
		}
	}
	die;
}

/*************************************
user email for cancel subscription
*************************************/
function user_cancel_subs_notification($userEmail,$userName){

	$mail = new PHPMailer(true);
	$mail->SMTPAuth   = true;
	$mail->Mailer = "smtp";
	$mail->Host= get_option('mail_host_name');
	$mail->Port = get_option('mail_port');
	$mail->Username = get_option('mail_username');
	$mail->Password = get_option('mail_password');
	$form_email = get_option('custom_email_from');
	$custom_email_txt = str_replace('https://', '', get_option( 'custom_email_url' ));
	$mail->SetFrom(($form_email) ? $form_email : 'noreply@writestorybooksforchildren.com');
	$mail->Subject = 'Cancelled Subscription';
	$message .= 'Hello, '.$userName.'<br><br><br>';
	$message .= 'We are sorry to see you go <br><br><br>';
	$message .= 'Your subscription has been cancelled and your card will not be charged again.<br><br><br>';
	$message .= 'If this cancellation was an error, please reply to this email so that we can reactivate your account.<br><br><br>';
	$message .= 'Thank you.<br><br><br>';
	$message .= (get_option('custom_email_url')) ?  '<a href="'.get_option('custom_email_url').'">'.$custom_email_txt.'</a>':'<a href="https://www.writestorybooksforchildren.com/">www.writestorybooksforchildren.com</a>';
	$mail->MsgHTML($message);
	$mail->AddAddress($userEmail);
	if(!$mail->Send())
		return false;
	else
		return true;
}

/**************************************
admin email for cancel subscription
**************************************/
function admin_cancel_subs_notification($userEmail,$userName){
	$mail2 = new PHPMailer(true);
	$mail2->IsSMTP(true);
	$mail2->SMTPAuth   = true;
	$mail2->Mailer = "smtp";
	$mail2->Host= get_option('mail_host_name');
	$mail2->Port = get_option('mail_port');
	$mail2->Username = get_option('mail_username');
	$admin_email = get_option('custom_admin_to_email');
	$sender_email = get_option('custom_admin_email_from');
	$from = ($sender_email) ? $sender_email : "mail@velocitelearning.com";
	$to = ($admin_email) ? $admin_email : 'admin@digitalsea.co.uk';
	// $to = 'testing.whizkraft2@gmail.com';
	$mail2->Password = get_option('mail_password');
	$mail2->SetFrom($from, 'noreply');
	$mail2->AddReplyTo($from,'mail@velocitelearning.com');
	$subject = 'Cancelled Subscription';
	$mail2->Subject = $subject;
	$body = $userName.'('.$userEmail.') has been cancelled there Subscription !';
	$mail2->MsgHTML($body);
	$address = $to;
	$mail2->AddAddress($address);
	if(!$mail2->Send())
		return false;
	else
		return true;
}

/*****************************************
Brain Tree Download PDF Script
*****************************************/
add_action( 'init', 'pdf_downloads' );
function pdf_downloads(){

if(isset($_POST['pdf_actions']) && $_POST['pdf_actions'] == 'pdf_downloads'){
	
	require 'pdf-invoicr-master/phpinvoice.php';
	$invoice = new phpinvoice('A4',$_POST['pdf_currencys']);
	
	$siteurl = get_site_url();
	$_url = wp_parse_url($siteurl);
	
	/* Header Settings */
		$image_url = wp_get_attachment_url(get_option('custom_admin_logo_id'));
		$image_url = str_replace("////","//",$image_url);
		$image_url = strtok($image_url,'?');
		$invoice->setLogo($image_url);
		$invoice->setColor("#AA3939");
		$invoice->setDate(date('M dS ,Y',time()));
		$invoice->setFrom(array("Purchaser Name",$_POST['pdf_fnames'],$_POST['pdf_lnames']));
		/* Adding Items in table */
		$invoice->addItem($_POST['pdf_products'],$_POST['pdf_txnIDs'],1,false,$_POST['pdf_amounts'],false,$_POST['pdf_amounts']);
		/* Add totals */
		$invoice->addTotal("Total",$_POST['pdf_amounts'],true);
		$invoice->setFooternote($_url['host']);
		/* Render */
		
		$invoice->render('invoice.pdf','D'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
		return;
}

}


/***********************************************************
Brain Tree View Transaction and Cancel Subscription Shortcode
************************************************************/

function braintree_view_cancel_subscription(){
	
	ob_start();
	global $wpdb;
	require 'vendor/autoload-new.php';
	
	// include braintree configuration
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	
	$slug = basename(get_permalink());
	$pkredirect_url = get_site_url().'/'.$slug;

	// Get user ID
	$user_ID = get_current_user_id();
	
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	if($customer_id){
	$html .= '
	<div class="pk_cardloader" style="display:none;">
		<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
	</div>
	<div class="pk_subsloader" style="display:none;">
		<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
	</div>
	<div class="container">
    <div class="row">
		<div class="col-md-6">
			<h3></h3>
			<!-- tabs -->
			<div class="wk_tabbable">
				<ul class="nav nav-tabs wk_cstm_tab">
					<li class="active"><a href="javascript:;" data-value="#viewTransctions">View Transaction</a></li>
					<li><a href="javascript:;" data-value="#changeCard">Change Card</a></li>
					<li><a href="javascript:;" data-value="#twee">Cancel Subscription</a></li>
					<li><a href="javascript:;" data-value="#tweee1">Change Subscription</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="viewTransctions">
						<table class="table">
							<thead>
							<tr>
							  <th>Transaction ID</th>
							  <th>Customer Name</th>
							  <th>Amount</th>
							  <th>Product Name</th>
							  <th>Download PDF</th>
							</tr>
							</thead>
							<tbody>';
							if($customer_id){
								
							$collection = Braintree_Transaction::search([
								Braintree_TransactionSearch::customerId()->is($customer_id),
							]);
							
							$member_levels = WLMAPI::GetLevels(); 
							foreach($collection as $transaction) {
								// echo '<pre>' ; print_r($transaction);echo '</pre>';
							if(isset($transaction->subscriptionId) && $transaction->subscriptionId){
								
								$txn_level = $wpdb->get_row( "SELECT * FROM $histry_table_name where user_id = $user_ID AND subscription_id LIKE '".$transaction->subscriptionId ."'");
								
							}else{
								
								$txn_level  = $wpdb->get_row( "SELECT * FROM $histry_table_name where user_id = $user_ID AND transcation_id LIKE '".$transaction->id ."'");
								
							}
								
								$fName = $transaction->customer['firstName'];
								$lName = $transaction->customer['lastName'];
								$amount = $transaction->amount;
								if($transaction->currencyIsoCode == 'USD'){
									$currency = '&#36;';
								}elseif($transaction->currencyIsoCode == 'AUD'){
									$currency = '&#36;';
								}elseif($transaction->currencyIsoCode == 'GBP'){
									$currency = '&#163;';
								}elseif($transaction->currencyIsoCode == 'EUR'){
									$currency = '&#8364; ';
								}
								$currencyIsoCode = $transaction->currencyIsoCode;
								$expireMonth = $transaction->creditCard['expirationMonth'];
								$expireYear = $transaction->creditCard['expirationYear'];
								if($transaction->status == 'settled' || $transaction->status == 'submitted_for_settlement'){
									$statusshow = true;
									$html .= '<tr>
										<td>'.$transaction->id .'</td>
										<td>'.$fName.'&nbsp'.$lName.'</td>
										<td>'.$currency.'&nbsp'.$amount.'</td>';
									$html .='<td>'.$member_levels[$txn_level->level_id]['name'].'</td>';
									$html .='<td>
											<form action="" method="post">
												<input type="hidden" name="pdf_products" value="'.$member_levels[$txn_level->level_id]['name'].'">
												<input type="hidden" name="pdf_txnIDs" value="'.$transaction->id .'">
												<input type="hidden" name="pdf_amounts" value="'.$amount.'">
												<input type="hidden" name="pdf_fnames" value="'.$fName.'">
												<input type="hidden" name="pdf_lnames" value="'.$lName.'">
												<input type="hidden" name="pdf_currencys" value="'.$currency.'">
												<input type="hidden" name="pdf_actions" value="pdf_downloads">
												<input type="submit" name="pdf_dwns" value="Download PDF">
											</form>
											</td>';
									$html .='</tr>';
								}
							}
							
								if($statusshow != true){
									$html .='<td colspan="4">No Transaction found.</td>';
								}
							}
							$html .= '</tbody>
							</table>
					</div>
					
					
					<!------- change card ----------------->
					<div class="tab-pane fade pk-delCard" id="changeCard">
					
					<table class="table">
						<thead>
						<tr>
							<th>Old Card</th>
							<th>Expiry Date</th>
							<th>Delete card</th>
							<th>Default Card</th>
						</tr>
						</thead>
						<tbody id="table-cards">';
						if($customer_id){
							$customersssCards = Braintree_Customer::search([
								Braintree_CustomerSearch::id()->is($customer_id)
							]);
							foreach($customersssCards as $_customersssCards) {
								foreach($_customersssCards->creditCards as $_creditCard){
									// echo '<pre>'; print_r($_creditCard);
									if($_creditCard != ''){
										$showStatuss = true;
										$last4 = '************'.$_creditCard->last4;
										$expireMonth = $_creditCard->expirationMonth;
										$expireYear = $_creditCard->expirationYear;
										if($_creditCard->default ==1){
											$last4  = $last4." (Default)";
										}
										$html .='<tr id="'.$_creditCard->token .'">
											<td>'.$last4.'</td>
											<td>'.$expireMonth.' / '.$expireYear.'</td>
											<td><a href="javascript:void(0)" data-token="'.$_creditCard->token .'" class="pk-del-token">Delete Card</a></td>
											<td><a href="javascript:void(0)" data-defaulttoken="'.$_creditCard->token .'" class="pk-set-default">Set Default Card</a></td>
										</tr>';
									}
								}
							}
							if($showStatuss != true){
								$html .='<td colspan="4">No Card found.</td>';
							}
							
						}
						$html .='</tbody>
						<script>
						jQuery(document).ready(function() {
							jQuery(".wk_cstm_tab a").click(function(){
								jQuery(".wk_cstm_tab li").removeClass("active");
								jQuery(".tab-content").find(".tab-pane").removeClass("active").removeClass("in");
								
								jQuery(this).closest("li").addClass("active");
								jQuery(".tab-content").find(jQuery(this).data("value")).addClass("active").addClass("in");
								
							});
		
							jQuery(".pk-del-token").click(function(){
								var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
								var tokens = jQuery(this).data("token");
								jQuery(".pk_cardloader").show();
								jQuery.ajax({
									url	: ajaxurl,
									type  : "POST",
									data: {token: tokens,action:"del_card"},
									success: function(html){
										html = jQuery.parseJSON(html);
										if(html.status == true){
											jQuery(".pk_cardloader").hide();
											jQuery(".pk-delCard").find(".pk_card_msg").html(html.message);
											jQuery(".pk-delCard").find(".pk_card_msg").css("color","green");
										}else{
											jQuery(".pk_cardloader").hide();
											jQuery(".pk-delCard").find(".pk_card_msg").html(html.message);
											jQuery(".pk-delCard").find(".pk_card_msg").css("color","red");
										}
										setTimeout(function() {
											jQuery("#"+tokens).remove();
											if(jQuery("#table-cards").children("tr").length == 0){
												jQuery("#table-cards").append(\'<tr><td colspan="4">You have delete your all cards.</td></tr>\');
											}
											jQuery(".pk_card_msg").hide(); 
										}, 2000);
									}
								});
							});
							jQuery(".pk-set-default").click(function(){
								var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
								var tokens = jQuery(this).data("defaulttoken");
								jQuery(".pk_cardloader").show();
								jQuery.ajax({
									url	: ajaxurl,
									type  : "POST",
									data: {token: tokens,action:"default_card"},
									success: function(html){
										html = jQuery.parseJSON(html);
										if(html.status == true){
											jQuery(".pk-delCard").find(".pk_card_msg").html(html.message);
											jQuery(".pk-delCard").find(".pk_card_msg").css("color","green");
											setTimeout(function() {
												location.reload();
											}, 2000);
										}else{
											jQuery(".pk-delCard").find(".pk_card_msg").html(html.message);
											jQuery(".pk-delCard").find(".pk_card_msg").css("color","red");
											
										}
										jQuery(".pk_cardloader").hide();
									}
								});
							});
							
						});
						</script>
					
					</table>
					<form id="" class="" method="post">
						<div class="container" id="addNew_Card">
						</div>
					</form>
					
					<a href="javascript:void(0)" class="pk-add-card" data-toggle="modal" data-target="#addnewCard">Add New Card</a>
					
					<div class="pk_card_msg" style="text-align:center;margin-top:10px;"></div>
								
					</div>';
					
					// Add new card script
					if($customer_id){
						$clientToken = Braintree_ClientToken::generate(['customerId'=>$customer_id]);
					}else{			
						$clientToken = Braintree_ClientToken::generate();	
					}
					$html .='<script src="https://js.braintreegateway.com/js/braintree-2.23.0.min.js"></script>
							<script>
							jQuery(document).ready(function() {
								jQuery(".pk-add-card").click(function(){
									braintree.setup(\''.$clientToken.'\', "dropin", {
										container: "addNew_Card",
										onPaymentMethodReceived: function (obj) {
											location.reload();
										}
									});
								});
							});
							</script>';
					
					// cancel subscription
					
					$html .='<div class="tab-pane fade pk_subs_del" id="twee">
					
					<table class="table append_thead">
						<thead>
						<tr>
						  <th>Subscription ID</th>
						  <th>Plan Name</th>
						  <th>Subscription</th>
						</tr>
						</thead>
						<tbody id="table-subscriptions">';
						if($customer_id){
							$customersss = Braintree_Customer::search([
								Braintree_CustomerSearch::id()->is($customer_id)
							]);
							
							foreach($customersss as $_customersss) {
								// echo '<pre>'; print_r($_customersss);
								if($_customersss->creditCards){
								
									foreach($_customersss->creditCards as $_creditCards){
										// echo '<pre>'; print_r($_creditCards);
										// if($_creditCards->subscriptions){
											foreach($_creditCards->subscriptions as $_subscriptions){
												// echo '<pre>'; print_r($_subscriptions);
												if($_subscriptions->status == 'Active'){
													$showStatus = true;
													//print_r($_subscriptions);
													$html .='<tr id="'.$_subscriptions->id .'">
													
														<td>'.$_subscriptions->id .'</td>
														<td>'.ucfirst($_subscriptions->planId).'</td>
														<td><a href="javascript:void(0)" data-subs="'.$_subscriptions->id .'" class="pk_del_subs">Cancel Subscription</a></td>';
														
													$html .='</tr>';
												}
												
												/* if(empty($_subscriptions->id)){
													
													$html .='<td colspan="4">No subscription found.</td>';
													
												} */
											}
					
										// }
										// die('okk');
									}
								}
							}
							if($showStatus != true){
								$html .='<td colspan="4">No subscription found.</td>';
							}
						}
						$html .='</tbody>
						
						
						<script>
						jQuery(document).ready(function() {
							jQuery(".pk_del_subs").click(function(){
								var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
								var subs = jQuery(this).data("subs");
								jQuery(".pk_subsloader").show();
								jQuery.ajax({
									url	: ajaxurl,
									type  : "POST",
									data: {subscription: subs,action:"del_subscription"},
									success: function(html){
										html = jQuery.parseJSON(html);
										if(html.status == true){
											jQuery(".pk_subsloader").hide();
											jQuery(".pk_subs_del").find(".pk_subs_msg").html(html.message);
											jQuery(".pk_subs_del").find(".pk_subs_msg").css("color","green");
										}else{
											jQuery(".pk_subsloader").hide();
											jQuery(".pk_subs_del").find(".pk_subs_msg").html(html.message);
											jQuery(".pk_subs_del").find(".pk_subs_msg").css("color","red");
										}
										setTimeout(function() {
											jQuery("#"+subs).remove();
											if(jQuery("#table-subscriptions").children("tr").length == 0){
												jQuery("#table-subscriptions").append(\'<tr><td colspan="4">You have cancelled your all subscriptions.</td></tr>\');
											}
											jQuery(".pk_subs_msg").hide(); 
										}, 2000);
									}
								});
							});
							
						});
						
						</script>
						
					</table>
					<div class="pk_subs_msg" style="text-align:center;margin-top:10px;"></div>
					</div>';
					
					$html .='<div class="tab-pane fade pk_can_subss_del" id="tweee1">
					<div class="pk_can_subsloader" style="display:none;">
						<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
					</div>
					<table class="table">
						<thead>
						<tr>
						  <th>Subscription ID</th>
						  <th>Plan Name</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody id="table-subscription">';
						
						if($customer_id){
							$customersss = Braintree_Customer::search([
								Braintree_CustomerSearch::id()->is($customer_id)
							]);
							foreach($customersss as $_customersss) {
								// echo '<pre>'; print_r($_customersss);
								if($_customersss->creditCards){
								
									foreach($_customersss->creditCards as $_creditCards){
										
										foreach($_creditCards->subscriptions as $_subscriptions){
											// echo '<pre>'; print_r($_subscriptions);
											if($_subscriptions->status == 'Active'){
											$showStatus = true;
											$html .='<tr id="'.$_subscriptions->id .'">
												<td>'.$_subscriptions->id .'</td>
												<td>'.ucfirst($_subscriptions->planId).'</td>';
												
												$joins = $wpdb->get_row("SELECT * FROM $histry_table_name INNER JOIN $table_name ON $histry_table_name.btn_id = $table_name.id where subscription_id = '$_subscriptions->id'");
												
												$update_plan = 'update_plan_'.$joins->country;
												$degrade_plan = 'degrade_plan_'.$joins->country;
												
												$StartDate = $_subscriptions->billingPeriodStartDate;
												$EndDate = $_subscriptions->billingPeriodEndDate; 
												$newdate = $StartDate->diff($EndDate);
												$newdate->days;
												
												if($newdate->days < '32'){
													if($joins->$update_plan){ 
													$html .='<td><a href="javascript:void(0)" data-upgrade="'.$_subscriptions->id .'" data-pid="'.$joins->$update_plan .'" class="pk_upgrade_plan">Upgrade to Annually</a></td>';
													}
												}else{
													if($joins->$degrade_plan){
													$html .='<td><a href="javascript:void(0)" data-degrade="'.$_subscriptions->id .'" data-deid="'.$joins->$degrade_plan .'" class="pk_degrade_plan">Downgrade to Monthly</a></td>';
													}
												}
												
											$html .='</tr>';
											}
												
										}
									// die('okk');
									}
								}
							}
						}
						$html .='</tbody>
						
						
						<script>
						
						jQuery(".pk_upgrade_plan").click(function(){
							
							var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
							var upgrade = jQuery(this).data("upgrade");
							var pk_plan = jQuery(this).data("pid");
							var dis_html = jQuery(this).parent("td").parent("tr");
					
							jQuery(".pk_can_subsloader").show();
							jQuery.ajax({
									url	: ajaxurl,
									type  : "POST",
									data: {subscription: upgrade,upgrade_planid: pk_plan,action:"upgradePlan"},
									success: function(html){
										//debugger;
										html = jQuery.parseJSON(html);
										if(html.status == true){
											jQuery(".pk_can_subsloader").hide();
											dis_html.replaceWith(html.display);
											// dis_html.remove();
											// dis_html.append(html.display);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").html(html.message);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").css("color","green");
										}else{
											jQuery(".pk_can_subsloader").hide();
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").html(html.message);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").css("color","red");
										}
									}
							});
							
						});
						
						jQuery(".pk_degrade_plan").click(function(){
							
							var ajaxurl = "'.admin_url("admin-ajax.php" ).'";
							var degrade = jQuery(this).data("degrade");
							var pk_plan = jQuery(this).data("deid");
							var dis_html = jQuery(this).parent("td").parent("tr");
							jQuery(".pk_can_subsloader").show();
							jQuery.ajax({
									url	: ajaxurl,
									type  : "POST",
									data: {subscription: degrade,degrade_planid: pk_plan,action:"degradePlan"},
									success: function(html){
										//debugger;
										html = jQuery.parseJSON(html);
										if(html.status == true){
											jQuery(".pk_can_subsloader").hide();
											// dis_html.remove();
											dis_html.replaceWith(html.display);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").html(html.message);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").css("color","green");
										}else{
											jQuery(".pk_can_subsloader").hide();
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").html(html.message);
											jQuery(".pk_can_subss_del").find(".pk_subs_msgs").css("color","red");
										}
									}
							});
							
						});
						</script>
						
					</table>
					<div class="pk_subs_msgs" style="text-align:center;margin-top:10px;"></div>
					</div>
					
					
				</div>
			</div>
			<!-- /tabs -->
		</div>
	</div>
	</div>';
	}
	echo  $html;
	$output_stringss = ob_get_clean();
	return $output_stringss;
}

function wporg_shortcodes_view_cancel_subs_init()
{
    add_shortcode('view_cancel_subscription', 'braintree_view_cancel_subscription');
}
add_action('init', 'wporg_shortcodes_view_cancel_subs_init');

/*****************************************************************/

/**************View logged in user card details start*************/

function braintree_view_card(){
	
	ob_start();
	global $wpdb;
	require 'vendor/autoload-new.php';
	
	echo '<style>
	.alert {
  padding: 20px;
  background-color: #48C9B0;
  color: white;
  text-align:center;
  font-size:17px;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
	
	</style>';
	
	// include braintree configuration
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	
	$slug = basename(get_permalink());
	$pkredirect_url = get_site_url().'/'.$slug;

	// Get user ID
	$user_ID = get_current_user_id();
	
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	$table_name = $wpdb->prefix . 'braintree_payment_tbl';
	
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	
	if($customer_id){
	$html .= '
	<div class="pk_cardloader" style="display:none;">
		<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
	</div>
	<div class="pk_subsloader" style="display:none;">
		<img src="'.plugins_url('/images/loderr.gif', __FILE__).'" style="display:inline"/>
	</div>
	<div class="container">
    <div class="row">
		<div class="col-md-6">
			
						<tbody id="table-cards">';
						if($customer_id){
							$customersssCards = Braintree_Customer::search([
								Braintree_CustomerSearch::id()->is($customer_id)
							]);
							$date1 = date('Y-m-d');
							$counter = 0;
							foreach($customersssCards as $_customersssCards) {
								foreach($_customersssCards->creditCards as $_creditCard){
									// echo '<pre>'; print_r($_creditCard);
									if($_creditCard != ''){
										$showStatuss = true;
										$defaultday ='01';
										
										$last4 = '************'.$_creditCard->last4;
										$expireMonth = $_creditCard->expirationMonth;
										$expireYear = $_creditCard->expirationYear;
										
										if ($counter == 0){
											
											 $date2 = "$expireYear-$expireMonth-$defaultday"; 
											 
											 //echo $date2,'<br>' ;
											
											
											$diff = abs(strtotime($date2) - strtotime($date1));

											$years = floor($diff / (365*60*60*24));
											$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
											$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

											//printf("%d years, %d months, %d days\n", $years, $months, $days);
											
										if ($days < 31 && $months == 0 ){
											
											//echo "your card ".$last4." has been expired this month";
											
											?>
											<div class="alert">
												<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  Your card <?php echo $last4 ;?> has been expiry soon.Please add new card.
											</div>
											
									<?php	}
										}
										 
									 //$exfulldate = $expireYear,'/',$expireMonth,'/',$defaultday ; 
											 
										 
										// $diff=date_diff($exfulldate,$cdate);
										// echo $diff->format("%R%a days");
										
										
										$html .='';
									}
								$counter++;}
							}
							if($showStatuss != true){
								$html .='<td colspan="4">No Card found.</td>';
							}
							
						}
						$html .='</tbody>
						
					
					</table>
					
							
					</div>';
					
					
					
					// cancel subscription
					
					
					
					
	'</div>';
	}else{
		$html .="Please login to view your card details.";
	}
	echo  $html;
	$output_stringss = ob_get_clean();
	return $output_stringss;
}



function wporg_shortcodes_view_card_subs_init()
{
    add_shortcode('view_card_details', 'braintree_view_card');
}
add_action('init', 'wporg_shortcodes_view_card_subs_init');

/**************View logged in user card details end*************/

add_action( 'wp_ajax_braintreeCharge', 'braintreeCharge' );
add_action( 'wp_ajax_nopriv_braintreeCharge', 'braintreeCharge' );

function braintreeCharge(){
	
	//error_reporting(0);
	$ex_prod_levelID = $_POST['ex_prod_level'];
	$ex_prod_descname = $_POST['ex_prod_descname'];
	$ex_prod_merchantID = $_POST['ex_prod_merchantID'];
	$ex_prod_plan = $_POST['ex_prod_plan'];
	$ex_prod_price = $_POST['ex_prod_price'];
	$ex_prod_form_id = $_POST['ex_prod_form_id']; 
	$ex_prod_country = $_POST['ex_prod_country'];
	
	if(isset($_POST['g-recaptcha-response'])){
		if(empty($_POST['g-recaptcha-response'])){
			echo json_encode(array("status"=>false,"message"=>'Please check the robot checkbox.'));
			exit;					 
		}else if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
			$secret = get_option('captcha_secret_key');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			
			$captchaResult =$responseData->success;
			if(!$responseData->success){
				echo json_encode(array("status"=>false,"message"=>'Captcha failed.'));
				exit;
			}
	   }		
	}
	
	require 'vendor/autoload-new.php';
 	// include braintree configuration
	$api_website = get_option('wlm_website');
	$api_ky = get_option('wlm_api');
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	session_start();
	$api = new wlmapiclass(($api_website) ? $api_website : 'https://www.writestorybooksforchildren.com', ($api_ky) ? $api_ky : '15f0e0f4bb1d3d109fa6f6f732a941c3');
	$api->return_format = 'php';
	
	$id = $_POST['form_id'];
	
	$current_user = wp_get_current_user();
	$user_ID = get_current_user_id();
	
	global $wpdb;
	
	$tablename = $wpdb->prefix . 'braintree_payment_tbl';
	$total = $wpdb->get_row( "SELECT * FROM `$tablename` where `id` = $id");		
	$_POST["country"] = strtoupper($_POST["country"]);
	if($_POST["country"] == 'UK' || $_POST["country"] == 'GB' || $_POST["country"] == 'IM' || $_POST["country"] == 'JE' || $_POST["country"] == 'GG'){
		
		$price 	= $total->uk_price;
		$totalprice = $priceorig =  '&#163; '.$total->uk_price;
		if($total->postage_uk){
			
			$price 		= $price+$total->postage_uk;
			$totalprice =  '&#163; '.$price;
		}
		$uemail 		= $_POST["email"];
	    
		$email			= $total->email_uk;
		$merchantID 	= $total->merchant_id_uk; 
		$levelID		= $total->level_id_uk;
		$planID			= $total->plan_id_uk;
		$update_planID	= $total->update_plan_uk;
		$countryname 	= 'uk';
		$btnID			= $total->id;
		if($total->postage_uk){
		$postage	= '&#163;'.$total->postage_uk;
		}else{
			$postage = '';
		}
		$descname	= $total->descriptor_name_uk;
		$content	= $total->course_text_uk;
		$additional_content	= $total->additional_text_uk;
		$redirecturl = $total->custom_url; 
		
	}else if($_POST["country"] == 'EUR' || $_POST["country"] == 'AT' || $_POST["country"] == 'BE' || $_POST["country"] == 'CY' || $_POST["country"] == 'DE' || $_POST["country"] == 'DK' || $_POST["country"] == 'EE' || $_POST["country"] == 'FI' || $_POST["country"] == 'FR' || $_POST["country"] == 'GR' || $_POST["country"] == 'IS' || $_POST["country"] == 'IE' || $_POST["country"] == 'IT' || $_POST["country"] == 'LV' || $_POST["country"] == 'LT' || $_POST["country"] == 'LU' || $_POST["country"] == 'PT' || $_POST["country"] == 'SK' || $_POST["country"] == 'SI' || $_POST["country"] == 'NL' || $_POST["country"] == 'NO' || $_POST["country"] == 'ES'){
		$price 	= $total->eur_price;
		$totalprice =  $priceorig =  '&#8364; '.$total->eur_price;
		if($total->postage_eur){
			
			$price 		= $price+$total->postage_eur;
			$totalprice =  '&#8364; '.$price;
		}
		$uemail 		= $_POST["email"];
		
		
		$email 			= $total->email_eur;
		$merchantID 	= $total->merchant_id_eur;
		$levelID		= $total->level_id_eur;
		$planID			= $total->plan_id_eur;
		$update_planID	= $total->update_plan_eur;
		$countryname 	= 'eur';
		$btnID			= $total->id;
		if($total->postage_eur){
		$postage	= '&#8364; '.$total->postage_eur;
		}else{
			$postage = '';
		}
		$descname	= $total->descriptor_name_eur;
		$content	= $total->course_text_eur;
		$additional_content	= $total->additional_text_eur;
		$redirecturl = $total->custom_url; 
		
	}else if($_POST["country"] == 'AUS' || $_POST["country"] == 'AU'){
		
		$price 	= $total->aus_price;
		$totalprice =  $priceorig =  '&#36; '.$total->aus_price;
		if($total->postage_aus){
			
			$price 		= $price+$total->postage_aus;
			$totalprice =  '&#36; '.$price;
		}
		$uemail 		= $_POST["email"];
		
		$email 			= $total->email_aus;
		$merchantID 	= $total->merchant_id_aus;
		$levelID		= $total->level_id_aus;
		$planID			= $total->plan_id_aus;
		$update_planID	= $total->update_plan_aus;
		$countryname 	= 'aus';
		$btnID			= $total->id;
		if($total->postage_aus){
		$postage	= '&#36;'.$total->postage_aus;
		}else{
			$postage = '';
		}
		$descname	 = $total->descriptor_name_aus;
		$content	= $total->course_text_aus;
		$additional_content	= $total->additional_text_aus;
		$redirecturl = $total->custom_url;
		
	}else{
		$price = $total->usa_price;
		$totalprice = $priceorig =  '&#36; '.$total->usa_price;
		if($total->postage_usa){
			
			$price 		= $price+$total->postage_usa;
			
			$totalprice =  '&#36; '.$price;
		}
		$uemail 		= $_POST["email"];
		
		$email 			= $total->email_usa;
		$merchantID 	= $total->merchant_id_usa;
		$levelID		= $total->level_id_usa;
		$planID			= $total->plan_id_usa;
		$update_planID	= $total->update_plan_usa;
		$countryname 	= 'usa';
		$btnID			= $total->id;
		if($total->postage_usa){
		$postage	= '&#36;'.$total->postage_usa;
		}else{
			$postage = '';
		}
		$descname	= $total->descriptor_name_usa;
		$content	= $total->course_text_usa;
		$additional_content	= $total->additional_text_usa;
		$redirecturl = $total->custom_url;
		
		
	}
	
	if(!$redirecturl){
		$redirecturl = get_site_url();
	}	
	$user_ID = get_current_user_id();
	if(get_option('braintree_payment_mode') == 'sandbox'){
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_sandbox', true);
	}else{
		$customer_id = get_user_meta($user_ID, 'braintree_customer_id_production', true);
	}
	$nonce = $_POST["payment_method_nonce"];
	if(empty($customer_id)){
		
		 // without login
		$dataarray['firstName'] = $_POST["firstname"];
		$dataarray['lastName'] = $_POST["lastname"];
		 $dataarray['email'] = $_POST["email"];
	
		$dataarray['paymentMethodNonce'] = $nonce;
		if($total->billing_address == 'yes'){
			$dataarray['creditCard']['billingAddress']['firstName'] = $_POST["firstname"];
			$dataarray['creditCard']['billingAddress']['lastName'] = $_POST["lastname"];
			$dataarray['creditCard']['billingAddress']['streetAddress'] = $_POST["address"];
			$dataarray['creditCard']['billingAddress']['locality'] = $_POST["state"];
			$dataarray['creditCard']['billingAddress']['region'] = $_POST["country"];
			$dataarray['creditCard']['billingAddress']['postalCode'] = $_POST["zip"];
		}
		$result = Braintree_Customer::create($dataarray);
		$customer_id  =  $result->customer->id;
		$_SESSION['customer_id'] = $customer_id;
		$_SESSION['paymentgateway'] = 'braintree';
		
		
		
		
		
		if($user_ID){
			if(get_option('braintree_payment_mode') == 'sandbox'){
				update_user_meta($user_ID, 'braintree_customer_id_sandbox', $customer_id);
			}else{
				update_user_meta($user_ID, 'braintree_customer_id_production', $customer_id);
			}
		}
		
		
			
			global $wpdb;	
			$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
			$chk_total = $wpdb->get_row( "SELECT * FROM `$histry_table_name` where `user_id` = $user_ID && `btn_id` = $id && `status` = 'active' && `level_id` = $levelID && `subscription_id` !=''");		
		  

			if($chk_total){
				echo json_encode(array("status"=>false,"message"=>"Already Exist Subscription!"));	
				exit;
				
			}
			
				// subscripton
				if($total->subscription == 'yes'){
					
					$result = Braintree_Subscription::create([
						'paymentMethodToken' => $result->customer->paymentMethods[0]->token,
						'planId' => $planID,
						'merchantAccountId' => $merchantID,
						'descriptor' => [
							'name' => $descname,
						]
					]); 
					
				 
				}else{
				
					$result = Braintree_Transaction::sale([
						'amount' => $price,
						'merchantAccountId' => $merchantID,
						'paymentMethodToken' => $result->customer->paymentMethods[0]->token,
						'options' => [
							'submitForSettlement' => True
						],
						'descriptor' => [
							'name' => $descname,
						]
					]);
				
				}
				if($ex_prod_form_id !=''){
					
					global $wpdb;	
					$tablename = $wpdb->prefix . 'braintree_payment_tbl';
					$extra_pro_total = $wpdb->get_row( "SELECT * FROM `$tablename` where `id` = $ex_prod_form_id ");
					if($extra_pro_total->subscription == 'yes'){
							
						$find_customer = Braintree_Customer::find($customer_id);
						$extra_pro_result = Braintree_Subscription::create([
							'paymentMethodToken' => $find_customer->paymentMethods[0]->token,
							'planId' => $ex_prod_plan,
							'merchantAccountId' => $ex_prod_merchantID,
							'descriptor' => [
								'name' => $ex_prod_descname,
							]
						]);
						
						$extra_pro_subscription_ID = $extra_pro_result->subscription->id;
						$extra_pro_transaction_id= '';
							
						$_SESSION['ex_prod_transaction_id'] = '';
						$_SESSION['ex_prod_subscription_ID'] = $extra_pro_subscription_ID;
								
					}else{
						
						$extra_pro_result = Braintree_Transaction::sale([
							'amount' => $ex_prod_price,
							'merchantAccountId' => $ex_prod_merchantID,
							'customerId' => $customer_id,
							'options' => [
								'submitForSettlement' => True
							],
							'descriptor' => [
								'name' => $descname,
							]
						]);
					 
						$extra_pro_transaction_id = $extra_pro_result->transaction->id;
						$_SESSION['ex_prod_transaction_id'] = $extra_pro_transaction_id;
						$_SESSION['ex_prod_subscription_ID'] = '';
						
						
					}
	
					$_SESSION['ex_prod_country_name'] = $countryname;
					$_SESSION['ex_prod_btn_ids'] = $ex_prod_form_id;
					$_SESSION['ex_prod_levelID'] = $ex_prod_levelID;
						
				}
				
				
				
		}else{
			
			// with login

			global $wpdb;	
			$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
			$chk_total = $wpdb->get_row( "SELECT * FROM `$histry_table_name` where `user_id` = $user_ID && `btn_id` = $id && `status` = 'active' && `level_id` = $levelID && `subscription_id` !=''");	

			if($chk_total){
				echo json_encode(array("status"=>false,"message"=>"Already Exist Subscription!"));	
				exit;
				
			}
			
		          
			
		
				if($total->subscription == 'yes'){
					
					$result = Braintree_Subscription::create([
				
						//'paymentMethodToken' => $result->customer->paymentMethods[0]->token,
						'planId' => $planID,
						'paymentMethodNonce' =>$nonce,
						'merchantAccountId' => $merchantID,
						'descriptor' => [
							'name' => $descname,
						]
					]);
 
				}else{
					
					$result = Braintree_Transaction::sale([
						'amount' => $price,
						'merchantAccountId' => $merchantID,
						'customerId' => $customer_id,
						'options' => [
							'submitForSettlement' => True
						],
						'descriptor' => [
							'name' => $descname,
						]
					]);
					
				}
				
				
					 
				if($ex_prod_form_id !=''){
				
					
					global $wpdb;	
					$tablename = $wpdb->prefix . 'braintree_payment_tbl';
					$extra_pro_total = $wpdb->get_row( "SELECT * FROM `$tablename` where `id` = $ex_prod_form_id ");
		
					if($extra_pro_total->subscription == 'yes'){
                        //sleep(30);
				     	$find_customer = Braintree_Customer::find($customer_id);
						$extra_pro_result = Braintree_Subscription::create([
							'paymentMethodToken' => $find_customer->paymentMethods[0]->token,
							'planId' =>  $ex_prod_plan,
							'merchantAccountId' => $ex_prod_merchantID,
							'descriptor' => [
								'name' => $ex_prod_descname,
							]
						]);
						
					    $extra_pro_subscription_ID = $extra_pro_result->subscription->id;
                        $_SESSION['ex_prod_transaction_id'] = '';
						$_SESSION['ex_prod_subscription_ID'] = $extra_pro_subscription_ID;
				   	   
					}
					else{
						
						$extra_pro_result = Braintree_Transaction::sale([
							'amount' => $ex_prod_price,
							'merchantAccountId' => $ex_prod_merchantID,
							'customerId' => $customer_id,
							'options' => [
								'submitForSettlement' => True
							],
							'descriptor' => [
								'name' => $ex_prod_descname,
							]
						]);
						$extra_pro_transaction_id = $extra_pro_result->transaction->id;
						$_SESSION['ex_prod_transaction_id'] = $extra_pro_transaction_id;
						$_SESSION['ex_prod_subscription_ID'] = '';
						
					}
					
						$_SESSION['ex_prod_country_name'] = $countryname;
						$_SESSION['ex_prod_btn_ids'] = $ex_prod_form_id;
						$_SESSION['ex_prod_levelID'] = $ex_prod_levelID;
									
				}
				
				
				
		}
		
		$_SESSION['country_name'] = '';
		$_SESSION['btn_ids'] = '';
		
		$_SESSION['country_name'] = $countryname;
		$_SESSION['btn_ids'] = $btnID;
		$_SESSION['transaction_id'] = '';
		$_SESSION['subscription_ID'] = '';
		
		
		if ($result->success == 1) {
			
			if(isset($result->transaction->id)){
				
				$_SESSION['transaction_id'] = $result->transaction->id;
				send_admin($result->transaction->id);
			}else{
				
				send_admin($result->subscription->id);
				$_SESSION['subscription_ID'] = $result->subscription->id;
			}
			// die;
			$_SESSION['lebel_ID'] = $level_id = $levelID;
			$user_ID = get_current_user_id();
			
			
			/* if(is_user_logged_in()){
				
				$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
				$transaction_id = $_SESSION['transaction_id'];
				$subscription_ID = $_SESSION['subscription_ID'];
				$btn_ids = $_SESSION['btn_ids'];
				$country_name = $_SESSION['country_name'];
				$lebel_ID = $_SESSION['lebel_ID'];
				// echo '<pre>'; print_r($_SESSION);
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$user_ID', '$transaction_id', '$subscription_ID', '$lebel_ID', '$btn_ids', '$country_name')"  );
				
			} */
			
			
			if ( email_exists( $uemail ) || is_user_logged_in() ) {
    
			$user = get_user_by( 'email', $uemail);
			$userId = $user->ID;
		 
			$_SESSION['lebel_ID'] = $level_id = $levelID;
		
			if(isset($_SESSION['lebel_ID'])){
		
				$data = array('Users' => $userId);
				$response = $api->post('/levels/'.$_SESSION['lebel_ID'].'/members', $data);
				$response = unserialize($response);
				
				$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
				$transaction_id = $_SESSION['transaction_id'];
				$subscription_ID = $_SESSION['subscription_ID'];
				$btn_ids = $_SESSION['btn_ids'];
				$country_name = $_SESSION['country_name'];
				$lebel_ID = $_SESSION['lebel_ID'];
				
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$userId', '$transaction_id', '$subscription_ID', '$lebel_ID', '$btn_ids', '$country_name')"  );
				
				
				if($ex_prod_form_id !=''){
			     
					$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
					$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$userId', '$extra_pro_transaction_id', '$extra_pro_subscription_ID', '$ex_prod_levelID', '$ex_prod_form_id', '$ex_prod_country')"  );	
				}
				
					
				if(isset($response['success']) && $response['success'] && $userId){
					// $wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id) VALUES ('$user_ID', '$transaction_id', '$subscription_ID', '$lebel_ID')"  );
					session_unset($_SESSION['transaction_id']);
					session_unset($_SESSION['subscription_ID']);
					session_unset($_SESSION['lebel_ID']);
					session_unset($_SESSION['country_name']);
					session_unset($_SESSION['btn_ids']);
				}
				$check = WLMAPI:: GetUserLevels($userId,$_SESSION['lebel_ID'],'','','',1);
				
				if($check){
					
					$check = WLMAPI:: UnCancelLevel($userId,$_SESSION['lebel_ID']);
					
				}
			
			}
			
		$exredirecturl = $total->ex_custom_url; 
		if (!empty($exredirecturl)) {
		
			$redirecturl = $total->ex_custom_url;
		}else {
			$redirecturl = get_site_url();
		}
		
		
		}else {
			$redirecturl = $total->custom_url; 
		}
			
			
			
			if(isset($_SESSION['lebel_ID'])){			
				$data = array('Users' => $user_ID);
				$response = $api->post('/levels/'.$_SESSION['lebel_ID'].'/members', $data);
				$response = unserialize($response);
				
				if(isset($response['success']) && $response['success'] && $user_ID){
					// $wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id) VALUES ('$user_ID', '$transaction_id', '$subscription_ID', '$lebel_ID')"  );
					session_unset($_SESSION['transaction_id']);
					session_unset($_SESSION['subscription_ID']);
					session_unset($_SESSION['lebel_ID']);
					session_unset($_SESSION['country_name']);
					session_unset($_SESSION['btn_ids']);
				}
				$check = WLMAPI:: GetUserLevels($user_ID,$_SESSION['lebel_ID'],'','','',1);
				
				if($check){
					
					$check = WLMAPI:: UnCancelLevel($user_ID,$_SESSION['lebel_ID']);
					// $wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id) VALUES ('$user_ID', '$transaction_id', '$subscription_ID', '$lebel_ID')"  );
					
					// session_unset($_SESSION['transaction_id']);
					// session_unset($_SESSION['subscription_ID']);
					// session_unset($_SESSION['lebel_ID']);
					
				}
				
			}	
			
			if(Send_Reciept($priceorig,$content,$additional_content,$postage,$totalprice)){
				
			/* 	if(is_user_logged_in()){
					
					$redirecturl = get_site_url();
					
				} */
				echo json_encode(array("status"=>true,"message"=>"Payment Received !","redirect"=>$redirecturl));	
				
			}else{

        	
				echo json_encode(array("status"=>false,"message"=>"Something went wrong."));	
				
			}
			
			
			
			
		}else{
			
		echo json_encode(array("status"=>false,"message"=>$result->message));
		
		}
		exit;
	}

	function send_admin($transaction_id){
		
		$id = $_POST['form_id'];
		global $wpdb;
		$tablename = $wpdb->prefix . 'braintree_payment_tbl';
		$total = $wpdb->get_row( "SELECT * FROM $tablename where id = $id");	
		$admin_email = get_option('custom_admin_to_email');
		$sender_email = get_option('custom_admin_email_from');
		$admin_sub	 = get_option('custom_admin_email_subject_txt');
		$email_logo	 = get_option('custom_admin_logo_id');
		$to 		 = ($admin_email) ? $admin_email : 'testing.whizkraft@gmail.com';
		// $to 		 = ($admin_email) ? $admin_email : 'admin@digitalsea.co.uk';
		$subject 	 = $total->name;
		$body = '<html><body>';
		$body .= ($email_logo) ? '<img src="'.wp_get_attachment_url(get_option('custom_admin_logo_id')).'"/>' : 
				'<img src="https://www.writestorybooksforchildren.com/wp-content/themes/WBSC-1.1.1/images/home_logo.png"/>';
		$body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$body .= "<tr style='background: #eee;'><td><strong>Order:</strong> </td><td>".$total->name ."</td></tr>";
		$body .= "<tr style='background: #eee;'><td><strong> Name:</strong> </td><td>".$_POST['firstname'].', '.$_POST['lastname'].'</td></tr>';
		$body .= '<tr><td><strong> Email:</strong> </td><td>'.$_POST['email'].'</td></tr>';
		$body .= '<tr><td><strong> Transaction ID:</strong> </td><td>'.$transaction_id .'</td></tr>';
		$body .= '<tr><td><strong> Country:</strong> </td><td>'.$_POST["country"].'</td></tr>';
		$body .= ($total->billing_address == "yes") ? '<tr><td><strong> Address:</strong> </td><td>'.$_POST['address'].', '.$_POST['city'].', '.$_POST['state'].', '.$_POST['zip'].', '.$_POST['country'].'</td></tr>' : '';
		$body .= '</table>';
		$body .= '</body></html>';
		$from = ($sender_email) ? $sender_email : "mail@velocitelearning.com";
		$mail = new PHPMailer();
		
		$mail->IsSMTP(true);
		$mail->SMTPAuth   = true;
		$mail->Mailer = "smtp";
		$mail->Host= get_option('mail_host_name');
		$mail->Port = get_option('mail_port');
		$mail->Username = get_option('mail_username');
		$mail->Password = get_option('mail_password');
		$mail->SetFrom($from, 'noreply');
		$mail->AddReplyTo($from,'mail@velocitelearning.com');
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$address = $to;
		$mail->AddAddress($address);
		
		if(!$mail->Send())
			
		return false;
		else
			
		return true;
		
	}
	
	function Send_Reciept($priceorig,$content,$additional_content,$postage,$totalprice) {
			
	require_once("vendor/autoload-new.php");
	
	$custom_email_txt = str_replace('https://', '', get_option( 'custom_email_url' ));

	$maildata .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


		<style type="text/css">
			img {
				max-width: 100%;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				height: 100%;
				line-height: 1.6em;
			}

			body {
				background-color: #f6f6f6;
			}

			@media only screen and (max-width: 640px) {
				body {
					padding: 0 !important;
				}
				h1 {
					font-weight: 800 !important;
					margin: 20px 0 5px !important;
				}
				h2 {
					font-weight: 800 !important;
					margin: 20px 0 5px !important;
				}
				h3 {
					font-weight: 800 !important;
					margin: 20px 0 5px !important;
				}
				h4 {
					font-weight: 800 !important;
					margin: 20px 0 5px !important;
				}
				h1 {
					font-size: 22px !important;
				}
				h2 {
					font-size: 18px !important;
				}
				h3 {
					font-size: 16px !important;
				}
				.container {
					padding: 0 !important;
					width: 100% !important;
				}
				.content {
					padding: 0 !important;
				}
				.content-wrap {
					padding: 10px !important;
				}
				.invoice {
					width: 100% !important;
				}
			}
		</style>
	</head>

	<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;"
		bgcolor="#f6f6f6">

		<table class="body-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
			<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
				<td class="container" width="600" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
					valign="top">
					<div class="content" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							bgcolor="#fff">
							<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;" align="center" valign="top">
									<table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
									$maildata .= (get_option('custom_logo_id')) ? '<img style="background-color:black" src="'.wp_get_attachment_url(get_option('custom_logo_id')).'">':
										'<img style="background-color:black" src="http://d73wf1flin6eu.cloudfront.net/wp-content/uploads/2015/09/11143407/WSBC_Logo_small.png">';
										$maildata .= '<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
												<h1 class="aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 32px; color: #000; line-height: 1.2em; font-weight: 500; text-align: center; margin: 40px 0 0;" align="center">'.$totalprice.' Paid</h1>
											</td>
										</tr>
										<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
											<td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
												<h2 class="aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;" align="center">Thanks for your Order.</h2>
											</td>
										</tr>
										<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
											<td class="content-block aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0;"
												align="center" valign="top">
												<table class="invoice" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;">
													<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
														<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
															<table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
																<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
																	$maildata .= ($content) ?  '<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;"
                                                                    valign="top">'.$content.'</td>':'<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;"
                                                                    valign="top">Write Story Books For Children</td>';
															$maildata .= ($postage) ? '<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																	<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;"
																		valign="top">Postage</td>
																	<td class="alignright" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;"
																		align="right" valign="top">'.$postage.'</td>
																</tr>' : '';
															$maildata .=   ' <tr class="total" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																	<td class="alignright" width="80%" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;"
																		align="right" valign="top">Total</td>
																	<td class="alignright" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;"
																		align="right" valign="top">'.$totalprice.'</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										
										<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
										$maildata .= (($additional_content) ?  '<td clas="content-block aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0px 0px 20px;"
										valign="top">'.$additional_content.'</td>' : '').' 
										</tr>
										
										<tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
											<td class="content-block aligncenter" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;"
												align="center" valign="top">
												<small>Barn Studios, High Street, Farndon, Chester, CH3 6PT, United Kingdom.</small>
												  <br>';
												$maildata .= (get_option('custom_email_url')) ?  '<a href="'.get_option('custom_email_url').'">'.$custom_email_txt.'</a>':'<a href="https://www.writestorybooksforchildren.com/">www.writestorybooksforchildren.com</a>';
											$maildata .= '</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						
					</div>
				</td>
				<td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
			</tr>
		</table>
	</body>

	</html>';
	
	// echo $maildata; die('here');
	$form_email = get_option('custom_email_from');
	$repecit_sub = get_option('custom_email_subject_txt');
	$message = $maildata;
	$mail = new PHPMailer();
	$mail->IsSMTP(true);
	$mail->SMTPAuth   = true;
	$mail->Mailer = "smtp";
	$mail->Host= get_option('mail_host_name');
	$mail->Port = get_option('mail_port');
	$mail->Username = get_option('mail_username');
	$mail->Password = get_option('mail_password');
	$mail->SetFrom(($form_email) ? $form_email : 'noreply@writestorybooksforchildren.com');
	$mail->Subject = ($repecit_sub) ? $repecit_sub : 'Receipt - writestorybooksforchildren.com';
	$mail->MsgHTML($message);
	$mail->AddAddress($_POST['email']);	
	if(!$mail->Send())
	return false;
	else
	return true;

	}
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {
	
	session_start();
	global $wpdb;
	if(isset($_SESSION['paymentgateway']) && $_SESSION['paymentgateway'] == 'braintree'){
		
		$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
		$transaction_id = $_SESSION['transaction_id'];
		$subscription_ID = $_SESSION['subscription_ID'];
		$btn_ids = $_SESSION['btn_ids'];
		$country_name = $_SESSION['country_name'];
		$lebel_ID = $_SESSION['lebel_ID'];
		
		 $ex_prod_form_id = $_SESSION['ex_prod_btn_ids'];
		
		// echo '<pre>'; print_r($_SESSION);
		if ( isset( $_SESSION['customer_id'] ) && !empty ( $_SESSION['customer_id'] )){
			if(get_option('braintree_payment_mode') == 'sandbox'){
				update_user_meta($user_id, 'braintree_customer_id_sandbox', $_SESSION['customer_id']);
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$user_id', '$transaction_id', '$subscription_ID', '$lebel_ID', '$btn_ids', '$country_name')"  );
			}else{
				update_user_meta($user_id, 'braintree_customer_id_production', $_SESSION['customer_id']);
				$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$user_id', '$transaction_id', '$subscription_ID', '$lebel_ID', '$btn_ids', '$country_name')"  );
			}
			
			if($ex_prod_form_id != ''){
				
				$ex_prod_transaction_id = $_SESSION['ex_prod_transaction_id']; 
				$ex_prod_subscription_ID = $_SESSION['ex_prod_subscription_ID']; 
				$ex_prod_country_name = $_SESSION['ex_prod_country_name']; 
				$ex_prod_levelID = $_SESSION['ex_prod_levelID']; 
				
				
				if(get_option('braintree_payment_mode') == 'sandbox'){
					
					update_user_meta($user_id, 'braintree_customer_id_sandbox', $_SESSION['customer_id']);
					$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$user_id', '$ex_prod_transaction_id', '$ex_prod_subscription_ID', '$ex_prod_levelID', '$ex_prod_form_id', '$ex_prod_country_name')"  );
				}else{
					update_user_meta($user_id, 'braintree_customer_id_production', $_SESSION['customer_id']);
					$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id, btn_id, country) VALUES ('$user_id', '$ex_prod_transaction_id', '$ex_prod_subscription_ID', '$ex_prod_levelID', '$ex_prod_form_id', '$ex_prod_country_name')"  );
				}
					
				
			}
			session_unset($_SESSION['customer_id']);
			session_unset($_SESSION['transaction_id']);
			session_unset($_SESSION['subscription_ID']);
			session_unset($_SESSION['lebel_ID']);
			session_unset($_SESSION['btn_ids']);
			session_unset($_SESSION['country_name']);
			
			session_unset($_SESSION['ex_prod_country_name']);
			session_unset($_SESSION['ex_prod_transaction_id']);
			session_unset($_SESSION['ex_prod_subscription_ID']);
			session_unset($_SESSION['ex_prod_btn_ids']);
			session_unset($_SESSION['ex_prod_levelID']);
		}
		session_unset($_SESSION['paymentgateway']);
	}
}

/******************************
login authenticate function
******************************/
/*function customcode($user, $data, $mw) {
	
	session_start();
	global $wpdb;
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	$transaction_id = $_SESSION['transaction_id'];
	$subscription_ID = $_SESSION['subscription_ID'];
	$lebel_ID = $_SESSION['lebel_ID'];
	
    //$check = WLMAPI:: GetUserLevels($user,$_SESSION['lebel_ID'],'','','',1);
				
	//if($check){
		
		//$check = WLMAPI:: UnCancelLevel($user,$_SESSION['lebel_ID']);
		$wpdb->query("INSERT INTO $histry_table_name (user_id, transcation_id, subscription_id, level_id) VALUES ('$user', '$transaction_id', '$subscription_ID', '$lebel_ID')"  );
		
		session_unset($_SESSION['transaction_id']);
		session_unset($_SESSION['subscription_ID']);
		session_unset($_SESSION['lebel_ID']);
		
	//}
}
add_action('wishlistmember_user_registered', 'customcode',10,3);*/


add_action( 'admin_footer', 'media_selector_print_scripts' );
function media_selector_print_scripts() {
	wp_enqueue_media();
	$my_saved_attachment_post_id = get_option( 'custom_logo_id', 0 );
	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			$('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				if ( file_frame ) {
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					file_frame.open();
					return;
				} else {
					wp.media.model.settings.post.id = set_to_post_id;
				}
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				file_frame.on( 'select', function() {
					attachment = file_frame.state().get('selection').first().toJSON();
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					file_frame.open();
			});
			$( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script><?php
}


add_action( 'admin_footer', 'media_selector_admin_logo' );
function media_selector_admin_logo() {
	wp_enqueue_media();
	$my_saved_attachment_post_ids = get_option( 'custom_admin_logo_id', 0 );
	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_ids; ?>; // Set this
			$('#upload_image_button1').on('click', function( event ){
				event.preventDefault();
				if ( file_frame ) {
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					file_frame.open();
					return;
				} else {
					wp.media.model.settings.post.id = set_to_post_id;
				}
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				file_frame.on( 'select', function() {
					attachment = file_frame.state().get('selection').first().toJSON();
					$( '#image-preview1' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id1' ).val( attachment.id );
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					file_frame.open();
			});
			$( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
			$(".close").click(function(){
				$(".alert").hide();
			});
		});
	</script><?php 
}



/**************************************************************************
Web-hook function for check if card is expired or subscription is cancelled
**************************************************************************/
function wporg_shortcodes_my_braintree_webhook_init(){
	
	require 'vendor/autoload-new.php';
	require_once 'vendor/productionconfig.php';
	require_once 'vendor/wlmapiclass.php';
	global $wpdb;
	$histry_table_name = $wpdb->prefix . 'braintree_payment_history_tbl';
	$user_ID = get_current_user_id();
	$cookie_name = "brainTreePayment_cookie";
	$cookie_value = "brainTreePayment_cookie_value";
	
	if($user_ID && !isset($_COOKIE[$cookie_name])){
		
		$sql = $wpdb->get_results( "SELECT * FROM $histry_table_name where user_id = $user_ID AND subscription_id != '' AND status = 'active'");
		
		foreach($sql as $_sql){
			
			$id = $_sql->id;
			$user_ids = $_sql->user_id;
			$subscription_id = $_sql->subscription_id;
			$status = $_sql->status;
			$level_id = $_sql->level_id;
			
			$subs = Braintree_Subscription::find($subscription_id);
			
			if($subs && $subs->status != 'Active'){
		
				$result = WLMAPI:: CancelLevel($user_ids,$level_id);
				$wpdb->query("UPDATE $histry_table_name SET status='cancelled' WHERE id = $id");
				
			}
		}
		
		// check if subscription date is end and equal to the current date,
		$date1 = date("Y-m-d"); // current date
		
		$totalwk = $wpdb->get_results( "SELECT * FROM $histry_table_name where user_id = '$user_ID' AND status = 'cancelled' AND label_status = 'active' AND subs_end_date <= '$date1'");
		
		foreach($totalwk as $_totalwk){
			
			$id = $_totalwk->id;
			$users_id = $_totalwk->user_id;
			$levels_id = $_totalwk->level_id;
			$status = $_totalwk->status;
			$label_status = $_totalwk->label_status;
			$subs_end_date = $_totalwk->subs_end_date;
			WLMAPI::CancelLevel($users_id,$levels_id); // Cancel member level.
			$wpdb->query("UPDATE $histry_table_name SET level_id='$levels_id',status='cancelled',label_status='cancelled' WHERE id = $id");
			
		}
		
		
		setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
	}
	return;
}
add_action('init', 'wporg_shortcodes_my_braintree_webhook_init');



function change_price() {  

   $data = array();

  $country = $_POST['country'];
  $country = $_POST['country'];
  $addtional = $_POST['addtional'];
  $totalAmount= $_POST['totalAmount'];
  
  global $wpdb;
  $id = $_POST['id'];
  $addtional = $_POST['addtional'];

    $tablename = $wpdb->prefix . 'braintree_payment_tbl';
	$total = $wpdb->get_row( "SELECT * FROM `$tablename` WHERE `id` = '$id'");	
	
	$_POST["country"] = strtoupper($_POST["country"]);
	
	if($_POST["country"] == 'UK' || $_POST["country"] == 'GB' || $_POST["country"] == 'IM' || $_POST["country"] == 'JE' || $_POST["country"] == 'GG' || $_POST["country"] == 'IN'){
		
		$price 	= $total->uk_price;
		$symbol= '&#163;';
		$totalprice = $priceorig =  '&#163;'.$total->uk_price;
		if($total->postage_uk){
			
			$price 		= $price+$total->postage_uk;
			$totalprice =  '&#163;'.$price;
		}
		
		
	}else if($_POST["country"] == 'EUR' || $_POST["country"] == 'AT' || $_POST["country"] == 'BE' || $_POST["country"] == 'CY' || $_POST["country"] == 'DE' || $_POST["country"] == 'DK' || $_POST["country"] == 'EE' || $_POST["country"] == 'FI' || $_POST["country"] == 'FR' || $_POST["country"] == 'GR' || $_POST["country"] == 'IS' || $_POST["country"] == 'IE' || $_POST["country"] == 'IT' || $_POST["country"] == 'LV' || $_POST["country"] == 'LT' || $_POST["country"] == 'LU' || $_POST["country"] == 'PT' || $_POST["country"] == 'SK' || $_POST["country"] == 'SI' || $_POST["country"] == 'NL' || $_POST["country"] == 'NO' || $_POST["country"] == 'ES'){
		$price 	= $total->eur_price;
		$symbol= '&#8364;';
		$totalprice =  $priceorig =  '&#8364;'.$total->eur_price;
		if($total->postage_eur){
			
			$price 		= $price+$total->postage_eur;
			$totalprice =  '&#8364; '.$price;
		}

	}else if($_POST["country"] == 'AUS' || $_POST["country"] == 'AU'){
		
		$price 	= $total->aus_price;
		$symbol= '&#36;';
		$totalprice =  $priceorig =  '&#36;'.$total->aus_price;
		if($total->postage_aus){
			
			$price 		= $price+$total->postage_aus;
			$totalprice =  '&#36;'.$price;
		}
		
		
	}else{
		$price = $total->usa_price;
		$symbol= '&#36;';
		$totalprice = $priceorig =  '&#36;'.$total->usa_price;
		if($total->postage_usa){
			
			$price 		= $price+$total->postage_usa;
			
			$totalprice =  '&#36;'.$price;
		}
		
		
		
	}
	
	
	$data['totalAmount'] =$totalAmount= $price;
	
 
  $addtional_table = $wpdb->prefix . 'braintree_payment_tbl';

  $add_prod_total = $wpdb->get_row( "SELECT * FROM `$addtional_table` WHERE `id` = '$id'");
  $add_prod_id = $add_prod_total->id;
  
  $_POST["country"] = strtoupper($_POST["country"]);
	if($_POST["country"] == 'UK' || $_POST["country"] == 'GB' || $_POST["country"] == 'IM' || $_POST["country"] == 'JE' || $_POST["country"] == 'GG' || $_POST["country"] == 'IN'){
		
		$ex_prod_price 	= $add_prod_total->uk_price;
		$ex_prod_totalprice = $ex_prod_priceorig =  '&#163;'.$add_prod_total->uk_price;
		if($add_prod_total->postage_uk){
			
			$ex_prod_price 		= $ex_prod_price+$add_prod_total->postage_uk;
			$ex_prod_totalprice =  '&#163;'.$ex_prod_price;
		}
		
		
		$ex_prod_merchantID 	= $add_prod_total->merchant_id_uk; 
		$ex_prod_levelID		= $add_prod_total->level_id_uk;
		$ex_prod_planID			= $add_prod_total->plan_id_uk;
		
		$ex_prod_countryname 	= 'uk';
		$ex_prod_btnID			= $add_prod_total->id;
		
		$ex_prod_descname	= $add_prod_total->descriptor_name_uk;
		
		
	}else if($_POST["country"] == 'EUR' || $_POST["country"] == 'AT' || $_POST["country"] == 'BE' || $_POST["country"] == 'CY' || $_POST["country"] == 'DE' || $_POST["country"] == 'DK' || $_POST["country"] == 'EE' || $_POST["country"] == 'FI' || $_POST["country"] == 'FR' || $_POST["country"] == 'GR' || $_POST["country"] == 'IS' || $_POST["country"] == 'IE' || $_POST["country"] == 'IT' || $_POST["country"] == 'LV' || $_POST["country"] == 'LT' || $_POST["country"] == 'LU' || $_POST["country"] == 'PT' || $_POST["country"] == 'SK' || $_POST["country"] == 'SI' || $_POST["country"] == 'NL' || $_POST["country"] == 'NO' || $_POST["country"] == 'ES'){
		$ex_prod_price 	= $add_prod_total->eur_price;
		$ex_prod_totalprice =  $ex_prod_priceorig =  '&#8364; '.$add_prod_total->eur_price;
		if($add_prod_total->postage_eur){
			
			$ex_prod_price 		= $ex_prod_price+$add_prod_total->postage_eur;
			$ex_prod_totalprice =  '&#8364; '.$ex_prod_price;
		}
		
		$ex_prod_merchantID 	= $add_prod_total->merchant_id_eur;
		$ex_prod_levelID			= $add_prod_total->level_id_eur;
		$ex_prod_planID			= $add_prod_total->plan_id_eur;
		
		$ex_prod_countryname 	= 'eur';
		$ex_prod_btnID			= $add_prod_total->id;
		
		$ex_prod_descname	= $add_prod_total->descriptor_name_eur;
		
		
	}else if($_POST["country"] == 'AUS' || $_POST["country"] == 'AU'){
		
		$ex_prod_price 	= $add_prod_total->aus_price;
		$ex_prod_totalprice =  $ex_prod_priceorig =  '&#36; '.$add_prod_total->aus_price;
		if($add_prod_total->postage_aus){
			
			$ex_prod_price 		= $ex_prod_price+$add_prod_total->postage_aus;
			$ex_prod_totalprice =  '&#36; '.$ex_prod_price;
		}
		
		$ex_prod_merchantID 	= $add_prod_total->merchant_id_aus;
		$ex_prod_levelID			= $add_prod_total->level_id_aus;
		$ex_prod_planID			= $add_prod_total->plan_id_aus;
		
		$ex_prod_countryname 	= 'aus';
		$ex_prod_btnID			= $add_prod_total->id;
		
		$ex_prod_descname	 = $add_prod_total->descriptor_name_aus;
		
	}else{
		$ex_prod_price = $add_prod_total->usa_price;
		$ex_prod_totalprice = $ex_prod_priceorig =  '&#36; '.$add_prod_total->usa_price;
		if($add_prod_total->postage_usa){
			
			$ex_prod_price 		= $ex_prod_price+$add_prod_total->postage_usa;
			
			$ex_prod_totalprice =  '&#36; '.$ex_prod_price;
		}
		
		$ex_prod_merchantID 	= $add_prod_total->merchant_id_usa;
		$ex_prod_levelID			= $add_prod_total->level_id_usa;
		$ex_prod_planID			= $add_prod_total->plan_id_usa;
		
		$ex_prod_countryname 	= 'usa';
		$ex_prod_btnID			= $add_prod_total->id;
		
		$ex_prod_descname	= $add_prod_total->descriptor_name_usa;
		
	}
  
  
  
  
  if($_POST['check'] == "additional"){	
		
		 $data['totalAmount'] =$totalAmount= $price + $ex_prod_price;
	}
    $data['total'] = $totalprice;
    $data['additional'] = $ex_prod_totalprice;
    $data['f_pro_price'] = $price;
    $data['ext_pro_price'] = $ex_prod_price;
	
    $data['ex_prod_merchantID'] = $ex_prod_merchantID;
    $data['ex_prod_levelID'] = $ex_prod_levelID;
    $data['ex_prod_planID'] = $ex_prod_planID;
    $data['ex_prod_btnID'] = $ex_prod_btnID;
    $data['ex_prod_descname'] = $ex_prod_descname;
    $data['ex_prod_countryname'] = $ex_prod_countryname;
 
   echo json_encode($data);


   
  die();

}
 
add_action('wp_ajax_change_price', 'change_price');
add_action('wp_ajax_nopriv_change_price', 'change_price');



/*********************************
Add stripe modal script in footer
*********************************/
function immi_footer_brain(){
?>
<script src='https://www.google.com/recaptcha/api.js?ver=3434'></script>
	<script>
		jQuery(document).ready(function(){
			
			
			// jQuery(".wk_cl_btn").click(function(){
				// var id = jQuery(this).attr('data-id');
				// call_ajax('no',id);
			// }) 
			jQuery("form").each(function(){
				
				if(jQuery(this).attr('role') != "search"){
					
					var form_idd = jQuery(this).attr('data-id');
				call_ajax('no',form_idd);
					
				}
				
			});
			
			jQuery(".wz_show_pay_form").each(function(){
				jQuery(this).appendTo('body');
			})
			
			
			jQuery(".addition_product_check").click(function(){
			var F_ID = jQuery(".addition_product_check").attr("id");
			if(jQuery(".addition_product_check").is(':checked') ){
				  call_ajax('additional');
				}
			});
			
	

function call_ajax(check,id){	
	
	setTimeout(function() {
		
		var country = jQuery(".country").val();
		
		var addtional = jQuery(".addition_product_check").val();
        
		jQuery.ajax({
              type:'POST',
              dataType:'json',
              url: "<?php echo admin_url('admin-ajax.php');?>",
              data: {
                  action: 'change_price',
                  country: country,
                  id: id,
				  addtional: addtional,
				  check: check,
               
               },
              success:function(data){
				
                   jQuery(".total_price-"+ id).html(data.total);
                   jQuery("#exr_pro_pr-"+ id).html(data.additional);
                   jQuery(".exr_pro_pri_chk-"+ id).html(data.additional);
                   jQuery(".f_pro_price-"+ id).val(data.f_pro_price);
                   jQuery(".ext_pro_price-"+ id).val(data.ext_pro_price);
				 

				   jQuery(".ex_prod_merchantID").val(data.ex_prod_merchantID);
				   jQuery(".ex_prod_level").val(data.ex_prod_levelID);
				   jQuery(".ex_prod_plan").val(data.ex_prod_planID);
				   
				   jQuery(".ex_prod_descname").val(data.ex_prod_descname);
				   jQuery(".ex_prod_country").val(data.ex_prod_countryname);
  
               }
      });
	 

		
		}, 1000);
		
		
}
//call_ajax('no');
	
		});
	</script>
	

	
<?php
}
add_action('wp_footer','immi_footer_brain');
?>