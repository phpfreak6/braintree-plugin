﻿<?php
if(isset($_POST['submit'])){
// echo '<pre>'; print_r();
$result = $wpdb->insert($table_name, array(

	'name' 					=> $_POST['name'],

	'uk_price'				=> $_POST['price_uk'],

	'usa_price' 			=> $_POST['price_usa'], // ... and so on

	'aus_price' 			=> $_POST['price_aus'], // ... and so on

	'eur_price' 			=> $_POST['price_eur'], // ... and so on

	'postage_uk' 			=> $_POST['postage_uk'], // ... and so on

	'postage_usa' 			=> $_POST['postage_usa'], // ... and so on

	'postage_aus' 			=> $_POST['postage_aus'], // ... and so on

	'postage_eur' 			=> $_POST['postage_eur'], // ... and so on

	'plan_id_uk' 			=> $_POST['planID_uk'], // ... and so on

	'plan_id_usa' 			=> $_POST['planID_usa'], // ... and so on

	'plan_id_aus' 			=> $_POST['planID_aus'], // ... and so on

	'plan_id_eur' 			=> $_POST['planID_eur'], // ... and so on

	'subscription'			=> $_POST['subs_yes'],  // ... and so on
	
	'additional_product'	=> $_POST['select_additional_product'], // ... and so on

	'merchant_id_uk' 		=> $_POST['merchantID_uk'], // ... and so on

	'merchant_id_usa' 		=> $_POST['merchantID_usa'], // ... and so on

	'merchant_id_aus' 		=> $_POST['merchantID_aus'], // ... and so on

	'merchant_id_eur' 		=> $_POST['merchantID_eur'], // ... and so on

	'level_id_uk' 			=> $_POST['levelID_uk'], // ... and so on

	'level_id_usa' 			=> $_POST['levelID_usa'], // ... and so on

	'level_id_aus' 			=> $_POST['levelID_aus'], // ... and so on

	'level_id_eur' 			=> $_POST['levelID_eur'], // ... and so on

	'descriptor_name_uk' 	=> $_POST['descriptorName_uk'], // ... and so on

	'descriptor_name_usa' 	=> $_POST['descriptorName_usa'], // ... and so on

	'descriptor_name_aus' 	=> $_POST['descriptorName_aus'], // ... and so on

	'descriptor_name_eur' 	=> $_POST['descriptorName_eur'], // ... and so on

	'billing_address' 		=> $_POST['billing'], // ... and so on

	'form_location' 		=> $_POST['form_location'], // ... and so on

	'form_top_text' 		=> $_POST['top_text'], // ... and so on

	'form_bottom_text' 		=> $_POST['bottom_text'], // ... and so on

	//'redirect_url'			=> $_POST['redirect_url'], // ... and so on

	'custom_url' 				=> $_POST['custom_url'], // ... and so on
	
	'ex_custom_url' 			=> $_POST['ex_custom_url'], // ... and so on

	'button_label' 			=> $_POST['button_label'], // ... and so on
	
	'fornt_btn_label' 		=> $_POST['front_button_label'], // ... and so on
	
	'front_btn_css' 		=> $_POST['front_custom_btn_css'], // ... and so on

	//'registrartion' 		=> $_POST['register_user'], // ... and so on
	
	'course_text_uk'		=> $_POST['course_text_uk'],
	
	'course_text_usa'		=> $_POST['course_text_usa'],
	
	'course_text_aus'		=> $_POST['course_text_aus'],
	
	'course_text_eur'		=> $_POST['course_text_eur'],
	
	'update_plan_uk'		=> $_POST['update_plan_uk'],
	'update_plan_usa'		=> $_POST['update_plan_usa'],
	'update_plan_aus'		=> $_POST['update_plan_aus'],
	'update_plan_eur'		=> $_POST['update_plan_eur'],
	
	'degrade_plan_uk'		=> $_POST['degrade_plan_uk'],
	'degrade_plan_usa'		=> $_POST['degrade_plan_usa'],
	'degrade_plan_aus'		=> $_POST['degrade_plan_aus'],
	'degrade_plan_eur'		=> $_POST['degrade_plan_eur'],
	
	'additional_text_uk'	=> $_POST['additional_text_uk'],
	'additional_text_usa'	=> $_POST['additional_text_usa'],
	'additional_text_aus'	=> $_POST['additional_text_aus'],
	'additional_text_eur'	=> $_POST['additional_text_eur'],
	
	'custom_btn_css'		=> $_POST['custom_btn_css'],
	
	'bottom_text_css'		=> $_POST['bottom_text_css'],
	
	'top_text_css'			=> $_POST['top_text_css'],
	
	'custom_css'			=> $_POST['custom_css'],

	'status' 				=> 'enable' // ... and so on

	),array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'));
	
 //echo '<pre>'; print_r($wpdb->last_query).'</br>';
	//print_r($result); die('here');
	
	if($result){

		$success_msg = true;

	}else{

		$error_msg = true;
	}

}
/******* insert duplicate row *********/
if(isset($_POST['add_copy'])){

$result = $wpdb->insert($table_name, array(

	'name' 					=> $_POST['name'],

	'uk_price'				=> $_POST['price_uk'],

	'usa_price' 			=> $_POST['price_usa'], // ... and so on

	'aus_price' 			=> $_POST['price_aus'], // ... and so on

	'eur_price' 			=> $_POST['price_eur'], // ... and so on

	'postage_uk' 			=> $_POST['postage_uk'], // ... and so on

	'postage_usa' 			=> $_POST['postage_usa'], // ... and so on

	'postage_aus' 			=> $_POST['postage_aus'], // ... and so on

	'postage_eur' 			=> $_POST['postage_eur'], // ... and so on

	'plan_id_uk' 			=> $_POST['planID_uk'], // ... and so on

	'plan_id_usa' 			=> $_POST['planID_usa'], // ... and so on

	'plan_id_aus' 			=> $_POST['planID_aus'], // ... and so on

	'plan_id_eur' 			=> $_POST['planID_eur'], // ... and so on

	'subscription'			=> $_POST['subs_yes'],  // ... and so on
	
	'additional_product'	=> $_POST['select_additional_product'],  // ... and so on

	'merchant_id_uk' 		=> $_POST['merchantID_uk'], // ... and so on

	'merchant_id_usa' 		=> $_POST['merchantID_usa'], // ... and so on

	'merchant_id_aus' 		=> $_POST['merchantID_aus'], // ... and so on

	'merchant_id_eur' 		=> $_POST['merchantID_eur'], // ... and so on

	'level_id_uk' 			=> $_POST['levelID_uk'], // ... and so on

	'level_id_usa' 			=> $_POST['levelID_usa'], // ... and so on

	'level_id_aus' 			=> $_POST['levelID_aus'], // ... and so on

	'level_id_eur' 			=> $_POST['levelID_eur'], // ... and so on

	'descriptor_name_uk' 	=> $_POST['descriptorName_uk'], // ... and so on

	'descriptor_name_usa' 	=> $_POST['descriptorName_usa'], // ... and so on

	'descriptor_name_aus' 	=> $_POST['descriptorName_aus'], // ... and so on

	'descriptor_name_eur' 	=> $_POST['descriptorName_eur'], // ... and so on

	'billing_address' 		=> $_POST['billing'], // ... and so on

	'form_location' 		=> $_POST['form_location'], // ... and so on

	'form_top_text' 		=> $_POST['top_text'], // ... and so on

	'form_bottom_text' 		=> $_POST['bottom_text'], // ... and so on

	//'redirect_url'			=> $_POST['redirect_url'], // ... and so on

	'custom_url' 			=> $_POST['custom_url'], // ... and so on
	
	'ex_custom_url' 		=> $_POST['ex_custom_url'], // ... and so on

	'button_label' 			=> $_POST['button_label'], // ... and so on
	
	'fornt_btn_label' 		=> $_POST['front_button_label'], // ... and so on
	
	'front_btn_css' 		=> $_POST['front_custom_btn_css'], // ... and so on

	//'registrartion' 		=> $_POST['register_user'], // ... and so on
	
	'course_text_uk'		=> $_POST['course_text_uk'],
	
	'course_text_usa'		=> $_POST['course_text_usa'],
	
	'course_text_aus'		=> $_POST['course_text_aus'],
	
	'course_text_eur'		=> $_POST['course_text_eur'],
	
	'update_plan_uk'		=> $_POST['update_plan_uk'],
	'update_plan_usa'		=> $_POST['update_plan_usa'],
	'update_plan_aus'		=> $_POST['update_plan_aus'],
	'update_plan_eur'		=> $_POST['update_plan_eur'],
	
	'degrade_plan_uk'		=> $_POST['degrade_plan_uk'],
	'degrade_plan_usa'		=> $_POST['degrade_plan_usa'],
	'degrade_plan_aus'		=> $_POST['degrade_plan_aus'],
	'degrade_plan_eur'		=> $_POST['degrade_plan_eur'],
	
	'additional_text_uk'	=> $_POST['additional_text_uk'],
	'additional_text_usa'	=> $_POST['additional_text_usa'],
	'additional_text_aus'	=> $_POST['additional_text_aus'],
	'additional_text_eur'	=> $_POST['additional_text_eur'],
	
	'custom_btn_css'		=> $_POST['custom_btn_css'],
	
	'bottom_text_css'		=> $_POST['bottom_text_css'],
	
	'top_text_css'			=> $_POST['top_text_css'],
	
	'custom_css'			=> $_POST['custom_css'],

	'status' 				=> 'enable' // ... and so on

	),array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s' ));
	
	// echo '<pre>'; print_r($wpdb->last_query).'</br>';
	// print_r($result); die('here');
	
	if($result){
		?>
		<script>
		window.location.href="admin.php?page=view_payments&msg=1";
		</script>
		<?php
			$success_msg = true;
	
	}else{

		$error_msg = true;
	}

}
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<style>
.wz_user_name{
width: 70%;
margin-top: 20px;
}
.wh_new_form {
border: 1px solid #eee;
display: inline-block;
float: left!important;
width: auto;
margin-top: 10px;
}
.wh_inputs {
float: left;
width: 100%;
}

.wh_head .count {
border-bottom: 1px solid #eee ;
border-right:1px solid #eee;
padding-top:10px;
}

.border1
{
border-right:1px solid #eee;
 padding-top:10px;
padding-bottom:10px;
}

.wz_subscription{

	width:17%;

	float:left;

}	

.wz_register {

  float: left;

  margin-bottom: 10px;

  margin-left: 16px;

  margin-right: 10px;

  margin-top: 20px;

  width: 100%;

}

.wz_register input[type="radio"]{

	line-height: normal;

	margin: 0px 10px 0px 40px;

}

.wz_billing{
	float: left;

  margin-bottom: 10px;

  margin-left: 17px;

  margin-right: 10px;

  margin-top: 20px;

  width: 100%;

}

.wz_billing input[type="radio"]{
line-height: normal;
margin: 0px 10px 0px 40px;
}

.wz_first_lable {
float: left;
width: 25%;
}

.wz_redirect_url {
margin-left: 25px;
}

.wz_redirect_url select{
height: 32px;
}

.custom_url {
width: 100%;
border: 1px solid #ccc;
border-radius: 4px;
height:32px;
}

.button_label{
width: 100%;
border: 1px solid #ccc;
border-radius: 4px;
height:32px;
}

.wz_button_label {
margin-left: 25px;
}

.wh_new_form .btn_submit {
margin-left: 15px;
margin-top: 15px;
margin-bottom:10px;
}
.wz_first_name {
float: left;
width: 22% !important;
}
.msg {
float: left;
margin-left: 20px;
width: 95%;
}
.wz_first_name_input {
float: left;
width: 100%;
height:32px;
border: 1px solid #ccc;
border-radius: 4px;
}
.js .tmce-active .wp-editor-area {
color:#000000 !important; 
}
.wz_redirect_url .wp-editor-area{
	height:100px;
}
.wh_inputs textarea{
	
	height:35px;
	
}
</style>
<?php
/***************** EDIT CODE ******************/
$id = $_GET['did'];
$ids = $_GET['copy'];
if(isset($_POST['update'])){
	
	$updates = $wpdb->update($table_name, array(

	'name' 					=> $_POST['name'],

	'uk_price'				=> $_POST['price_uk'],

	'usa_price' 			=> $_POST['price_usa'], // ... and so on

	'aus_price' 			=> $_POST['price_aus'], // ... and so on

	'eur_price' 			=> $_POST['price_eur'], // ... and so on

	'postage_uk' 			=> $_POST['postage_uk'], // ... and so on

	'postage_usa' 			=> $_POST['postage_usa'], // ... and so on

	'postage_aus' 			=> $_POST['postage_aus'], // ... and so on

	'postage_eur' 			=> $_POST['postage_eur'], // ... and so on

	'plan_id_uk' 			=> $_POST['planID_uk'], // ... and so on

	'plan_id_usa' 			=> $_POST['planID_usa'], // ... and so on

	'plan_id_aus' 			=> $_POST['planID_aus'], // ... and so on

	'plan_id_eur' 			=> $_POST['planID_eur'], // ... and so on

	'subscription'			=> $_POST['subs_yes'],  // ... and so on
	
	'additional_product'	=> $_POST['select_additional_product'],  // ... and so on

	'merchant_id_uk' 		=> $_POST['merchantID_uk'], // ... and so on

	'merchant_id_usa' 		=> $_POST['merchantID_usa'], // ... and so on

	'merchant_id_aus' 		=> $_POST['merchantID_aus'], // ... and so on

	'merchant_id_eur' 		=> $_POST['merchantID_eur'], // ... and so on

	'level_id_uk' 			=> $_POST['levelID_uk'], // ... and so on

	'level_id_usa' 			=> $_POST['levelID_usa'], // ... and so on

	'level_id_aus' 			=> $_POST['levelID_aus'], // ... and so on

	'level_id_eur' 			=> $_POST['levelID_eur'], // ... and so on

	'descriptor_name_uk' 	=> $_POST['descriptorName_uk'], // ... and so on

	'descriptor_name_usa' 	=> $_POST['descriptorName_usa'], // ... and so on

	'descriptor_name_aus' 	=> $_POST['descriptorName_aus'], // ... and so on

	'descriptor_name_eur' 	=> $_POST['descriptorName_eur'], // ... and so on

	'billing_address' 		=> $_POST['billing'], // ... and so on

	'form_location' 		=> $_POST['form_location'], // ... and so on

	'form_top_text' 		=> $_POST['top_text'], // ... and so on

	'form_bottom_text' 		=> $_POST['bottom_text'], // ... and so on

	//'redirect_url'			=> $_POST['redirect_url'], // ... and so on

	'custom_url' 			=> $_POST['custom_url'], // ... and so on
	
	'ex_custom_url' 		=> $_POST['ex_custom_url'], // ... and so on

	'button_label' 			=> $_POST['button_label'], // ... and so on
	
	'fornt_btn_label' 		=> $_POST['front_button_label'], // ... and so on
	
	'front_btn_css' 		=> $_POST['front_custom_btn_css'], // ... and so on

	//'registrartion' 		=> $_POST['register_user'], // ... and so on
	
	'course_text_uk'		=> $_POST['course_text_uk'],
	
	'course_text_usa'		=> $_POST['course_text_usa'],
	
	'course_text_aus'		=> $_POST['course_text_aus'],
	
	'course_text_eur'		=> $_POST['course_text_eur'],
	
	'update_plan_uk'		=> $_POST['update_plan_uk'],
	'update_plan_usa'		=> $_POST['update_plan_usa'],
	'update_plan_aus'		=> $_POST['update_plan_aus'],
	'update_plan_eur'		=> $_POST['update_plan_eur'],
	
	'degrade_plan_uk'		=> $_POST['degrade_plan_uk'],
	'degrade_plan_usa'		=> $_POST['degrade_plan_usa'],
	'degrade_plan_aus'		=> $_POST['degrade_plan_aus'],
	'degrade_plan_eur'		=> $_POST['degrade_plan_eur'],
	
	'additional_text_uk'	=> $_POST['additional_text_uk'],
	'additional_text_usa'	=> $_POST['additional_text_usa'],
	'additional_text_aus'	=> $_POST['additional_text_aus'],
	'additional_text_eur'	=> $_POST['additional_text_eur'],
	
	'custom_btn_css'		=> $_POST['custom_btn_css'],
	
	'bottom_text_css'		=> $_POST['bottom_text_css'],
	
	'top_text_css'			=> $_POST['top_text_css'],

	'custom_css'			=> $_POST['custom_css'],
	'status' 				=> 'enable' // ... and so on

	),

	array( 'id' => $id ),array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'), array( '%d' ) 

	);
	//print_r($updates);
	
	if($updates || $updates == 0){

		$success_msg = true;

	}else{

		$error_msg = true;
	}
}

?>

<div class="container wz_main_div">
<form method="post" action="">
<?php
if($id != ''){
	
		$total = $wpdb->get_results( "SELECT * FROM $table_name where id = $id");

	?>

	<?php
	
		if(isset($success_msg)){

			

			echo '<div class="alert alert-success msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

			Thanks Your Updates are saved!.</div>';

			

		} elseif(isset($error_msg)){

			

			echo '<div class="alert alert-danger msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Error.</div>';

		}

	?>
	<div class="wz_user_name">

	<h3 style="margin-bottom:20px;">Edit Form </h3>

	<div class="col-sm-4 wz_first_name">

		<label for="inputEmail">Name</label>

		</div>

	<div class="col-sm-6">

	   <input class="wz_first_name_input" type="text" name="name" id="name" value="<?php echo $total[0]->name;?>" required>

	</div>

	</div>

<div class="wh_new_form">


	<div class="wh_head">

		<div class="col-sm-1 count">

		<label for="inputEmail">Country</label>

		</div>

	 

		<div class="col-sm-1 count">

		<label for="inputEmail">Price</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">AccountID</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Level ID</label>

		</div>

		<div class="col-sm-2 count">

		<label for="inputEmail">Descriptor Name</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Postage</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">PlanID</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Course Text</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Additional Text</label>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" name="country_uk" id="country" value="UK">UK</label>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_uk" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->uk_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_uk" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_uk;?>" required>

	  </div>

	  

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_uk" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_uk;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_uk" placeholder="Enter Descriptior name" class="form-control"  type="text" value="<?php echo $total[0]->descriptor_name_uk;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_uk" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_uk;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_uk" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_uk;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_uk" class="form-control" value="<?php echo $total[0]->course_text_uk;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_uk" class="form-control" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_uk;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_usa" value="USA">USA</label>

	   

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_usa" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->usa_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_usa" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_usa;?>" required>

	  </div>

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_usa" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_usa;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_usa" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_usa;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_usa" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_usa;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_usa" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_usa;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_usa" class="form-control" value="<?php echo $total[0]->course_text_usa;?>" placeholder="Enter Text"  type="text" required>

		</div>
		
		
		<div class="col-sm-2 border1" id="wz_subs_id">

		<textarea id="price" name="additional_text_usa" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_usa;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_aus" value="AUS">AUS</label>

	   

	  </div>

	  

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_aus" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->aus_price;?>" required>

	  </div>

	 <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_aus" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_aus;?>" required>

	  </div>

		

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_aus" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_aus;?>">

	  </div>

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_aus" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_aus;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_aus" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_aus;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_aus" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_aus;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_aus" class="form-control" value="<?php echo $total[0]->course_text_aus;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_aus" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_aus;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_eur" value="EUR">EUR</label>

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_eur" placeholder="Enter price" class="form-control" type="text" value="<?php echo $total[0]->eur_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_eur" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_eur;?>" required>

	  </div>

		

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_eur" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_eur;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_eur" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_eur;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_eur" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_eur;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_eur" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_eur;?>" type="text">

	  </div>

	
	<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_eur" class="form-control" value="<?php echo $total[0]->course_text_eur;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_eur" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_eur;?></textarea>
			

		</div>
	

	</div>

 
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_uk" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_uk; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_usa" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_usa; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_aus" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_aus; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_eur" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_eur; ?>">

	  </div>

	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_uk" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_uk; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_usa" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_usa; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_aus" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_aus; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_eur" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_eur; ?>">

	  </div>

	</div>

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Subscription</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="subs_yes" value="yes" <?php if ($total[0]->subscription == 'yes') {echo ' checked ';} ?>> Yes

		</label>

		<label class="form-check-label">

		 <input class="form-check-input wz_radio" type="radio" name="subs_yes" value="no" <?php if ($total[0]->subscription == 'no') {echo ' checked ';} ?>> No

		</label>

	</div>

	 <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Additional Product</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="select_additional_product" value="1" <?php if ($total[0]->additional_product == '1') {echo ' checked ';} ?>> Yes

		  
		</label>

		<label class="form-check-label">

		 <input class="form-check-input wz_radio" type="radio" name="select_additional_product" value="0" <?php if ($total[0]->additional_product == '0') {echo ' checked ';} ?>> No

		</label>

	</div>

	<!--<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Register User</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" value="yes" <?php //if ($total[0]->registrartion == 'yes') {echo ' checked ';} ?>required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" value="no" <?php //if ($total[0]->registrartion == 'no') {echo ' checked ';} ?> required> No

		</label>

	</div>-->

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_billing">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Delivery Address</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" value="yes" <?php if ($total[0]->billing_address == 'yes') {echo ' checked ';} ?> required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" <?php if ($total[0]->billing_address == 'no') {echo ' checked ';} ?> value="no"> No

		</label>

	</div>

	

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Location</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <select class="custom-select mb-2 mr-sm-2 mb-sm-0 form-control" id="inlineFormCustomSelect" name="form_location">

		<option <?php echo ($total[0]->form_location == "top" )? 'selected'  :  ''?> value="top">Top</option>

		<option <?php echo ($total[0]->form_location == "center" )? 'selected'  :  ''?> value="center">Center</option>

		

	  </select>

	  </div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Top text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <?php 
	//$content = mb_encode_numericentity($total[0]->form_top_text,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"top_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $total[0]->form_top_text, $editor_id, $settings); ?>
	   <!-- <input type="text" class="custom_url custom_style" value="<?php echo $total[0]->form_top_text;?>" placeholder="Enter form top text" name="top_text">-->

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->top_text_css; ?>" name="top_text_css">

	</div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Bottom text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	<?php 
	// $content = mb_encode_numericentity($total[0]->form_bottom_text,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"bottom_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $total[0]->form_bottom_text, $editor_id, $settings); ?>
	
	   <!--<input type="text" class="custom_url custom_style" value="<?php //echo $total[0]->form_bottom_text;?>" placeholder="Enter form bottom text" name="bottom_text">-->

	  </div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->bottom_text_css; ?>" name="bottom_text_css">

	</div>

	</div>

 
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="custom_url" name="custom_url" placeholder="Enter redirect label" value="<?php echo $total[0]->custom_url;?>">

	  </div>

  </div>
  
  
  
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Existing Customer Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="custom_url" name="ex_custom_url" placeholder="Enter redirect url" value="<?php echo $total[0]->ex_custom_url;?>">

	  </div>

  </div>
  
  

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="button_label" placeholder="Enter button label" value="<?php echo $total[0]->button_label; ?>">

	  </div>
	  
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->custom_btn_css; ?>" name="custom_btn_css">

	</div>

	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Front Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="front_button_label" placeholder="Enter Front button label" value="<?php echo $total[0]->fornt_btn_label; ?>">

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->front_btn_css; ?>" name="front_custom_btn_css">

	</div>

  </div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Custom Front button Style</label>

	</div>

    <div class="col-sm-1 wz_button_label">

	   <input type="color" class="button_label" name="custom_css" value="<?php echo $total[0]->custom_css; ?>">

	  </div>

	</div>


  <div style="float:left; width:100%;">

 <input class="btn btn-primary btn_submit" name="update" type="submit" value="Update"/>

 </div>

</div>

<script>

    function yesnoCheck(that) {

        if (that.value == "custom_url") {

            //alert("check");

            document.getElementById("ifYes").style.display = "block";

        } else {

            document.getElementById("ifYes").style.display = "none";

        }

    }

</script>

<?php
}elseif($ids != ''){
		
		$total = $wpdb->get_results( "SELECT * FROM $table_name where id = $ids");

	?>

	<div class="wz_user_name">

	<h3 style="margin-bottom:20px;">Edit Form </h3>

	<div class="col-sm-4 wz_first_name">

		<label for="inputEmail">Name</label>

		</div>

	<div class="col-sm-6">

	   <input class="wz_first_name_input" type="text" name="name" id="name" value="<?php echo $total[0]->name;?>" required>

	</div>

	</div>

<div class="wh_new_form">


	<div class="wh_head">

		<div class="col-sm-1 count">

		<label for="inputEmail">Country</label>

		</div>

	 

		<div class="col-sm-1 count">

		<label for="inputEmail">Price</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">AccountID</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Level ID</label>

		</div>

		<div class="col-sm-2 count">

		<label for="inputEmail">Descriptor Name</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Postage</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">PlanID</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Course Text</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Additional Text</label>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" name="country_uk" id="country" value="UK">UK</label>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_uk" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->uk_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_uk" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_uk;?>" required>

	  </div>

	  

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_uk" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_uk;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_uk" placeholder="Enter Descriptior name" class="form-control"  type="text" value="<?php echo $total[0]->descriptor_name_uk;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_uk" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_uk;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_uk" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_uk;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_uk" class="form-control" value="<?php echo $total[0]->course_text_uk;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_uk" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_uk;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_usa" value="USA">USA</label>

	   

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_usa" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->usa_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_usa" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_usa;?>" required>

	  </div>

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_usa" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_usa;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_usa" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_usa;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_usa" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_usa;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_usa" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_usa;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_usa" class="form-control" value="<?php echo $total[0]->course_text_usa;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_usa" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_usa;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_aus" value="AUS">AUS</label>

	   

	  </div>

	  

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_aus" placeholder="Enter Price" class="form-control" type="text" value="<?php echo $total[0]->aus_price;?>" required>

	  </div>

	 <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_aus" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_aus;?>" required>

	  </div>

		

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_aus" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_aus;?>">

	  </div>

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_aus" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_aus;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_aus" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_aus;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_aus" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_aus;?>" type="text">

	  </div>

		<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_aus" class="form-control" value="<?php echo $total[0]->course_text_aus;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_aus" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_aus;?></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_eur" value="EUR">EUR</label>

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_eur" placeholder="Enter price" class="form-control" type="text" value="<?php echo $total[0]->eur_price;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_eur" placeholder="Enter MerchantID" class="form-control" type="text" value="<?php echo $total[0]->merchant_id_eur;?>" required>

	  </div>

		

		<div class="col-sm-1 border1">

	   <input id="price" name="levelID_eur" placeholder="Enter LevelID" class="form-control" type="text" value="<?php echo $total[0]->level_id_eur;?>">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_eur" placeholder="Enter Descriptior name" class="form-control" type="text" value="<?php echo $total[0]->descriptor_name_eur;?>" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_eur" class="form-control" placeholder="price" value="<?php echo $total[0]->postage_eur;?>" type="text">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_eur" class="form-control" placeholder="Plan" value="<?php echo $total[0]->plan_id_eur;?>" type="text">

	  </div>

	
	<div class="col-sm-2 border1" id="wz_subs_id">

	   <input id="price" name="course_text_eur" class="form-control" value="<?php echo $total[0]->course_text_eur;?>" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  
		<div class="col-sm-2 border1" id="wz_subs_id">

			<textarea id="price" name="additional_text_eur" class="form-control" value="" placeholder="Enter Additional Text"><?php echo $total[0]->additional_text_eur;?></textarea>

		</div>
	

	</div>

 
 	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_uk" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_uk; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_usa" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_usa; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_aus" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_aus; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_eur" placeholder="Enter upgrade plan ID" value="<?php echo $total[0]->update_plan_eur; ?>">

	  </div>

	</div>
	
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_uk" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_uk; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_usa" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_usa; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_aus" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_aus; ?>">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_eur" placeholder="Enter degrade plan ID" value="<?php echo $total[0]->degrade_plan_eur; ?>">

	  </div>

	</div>

 

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Subscription</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="subs_yes" value="yes" <?php if ($total[0]->subscription == 'yes') {echo ' checked ';} ?>> Yes

		</label>

		<label class="form-check-label">

		 <input class="form-check-input wz_radio" type="radio" name="subs_yes" value="no" <?php if ($total[0]->subscription == 'no') {echo ' checked ';} ?>> No

		</label>

	</div>

	
     <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Additional Product</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="select_additional_product" value="1" <?php if ($total[0]->additional_product == '1') {echo ' checked ';} ?>> Yes

		</label>

		<label class="form-check-label">

		 <input class="form-check-input wz_radio" type="radio" name="select_additional_product" value="0" <?php if ($total[0]->additional_product == '0') {echo ' checked ';} ?>> No

		</label>

	</div>
	<!--<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Register User</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" value="yes" <?php //if ($total[0]->registrartion == 'yes') {echo ' checked ';} ?>required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" value="no" <?php //if ($total[0]->registrartion == 'no') {echo ' checked ';} ?> required> No

		</label>

	</div>-->

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_billing">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Delivery Address</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" value="yes" <?php if ($total[0]->billing_address == 'yes') {echo ' checked ';} ?> required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" <?php if ($total[0]->billing_address == 'no') {echo ' checked ';} ?> value="no"> No

		</label>

	</div>

	

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Location</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <select class="custom-select mb-2 mr-sm-2 mb-sm-0 form-control" id="inlineFormCustomSelect" name="form_location">

		<option <?php echo ($total[0]->form_location == "top" )? 'selected'  :  ''?> value="top">Top</option>

		<option <?php echo ($total[0]->form_location == "center" )? 'selected'  :  ''?> value="center">Center</option>

		

	  </select>

	  </div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Top text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	<?php 
	// $content = mb_encode_numericentity($total[0]->form_top_text,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"top_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $total[0]->form_top_text, $editor_id, $settings); ?>
	  <!-- <input type="text" class="custom_url custom_style" value="<?php //echo $total[0]->form_top_text;?>" placeholder="Enter form top text" name="top_text">-->

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->top_text_css; ?>" name="top_text_css">

	</div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Bottom text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	<?php 
	// $content = mb_encode_numericentity($total[0]->form_bottom_text,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"bottom_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $total[0]->form_bottom_text, $editor_id, $settings); ?>
	<!--<input type="text" class="custom_url custom_style" value="<?php //echo $total[0]->form_bottom_text;?>" placeholder="Enter form bottom text" name="bottom_text">-->

	  </div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->bottom_text_css; ?>" name="bottom_text_css">

	</div>

	</div>

 
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="custom_url" name="custom_url" placeholder="Enter redirect label" value="<?php echo $total[0]->custom_url;?>">

	  </div>

  </div>
  
  
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Existing Customer Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="button_label" name="ex_custom_url" placeholder="Enter redirect url" value="<?php echo $total[0]->ex_custom_url;?>">

	  </div>

  </div>

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="button_label" placeholder="Enter button label" value="<?php echo $total[0]->button_label; ?>">

	  </div>
	  
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->custom_btn_css; ?>" name="custom_btn_css">

	</div>

	</div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Front Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="front_button_label" placeholder="Enter Front button label" value="<?php echo $total[0]->fornt_btn_label; ?>">

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="<?php echo $total[0]->front_btn_css; ?>" name="front_custom_btn_css">

	</div>

  </div>
	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Custom Front button Style</label>

	</div>

    <div class="col-sm-1 wz_button_label">

	   <input type="color" class="button_label" name="custom_css" value="<?php echo $total[0]->custom_css; ?>">

	  </div>

	</div>


  <div style="float:left; width:100%;">
	<?php 
	if($ids){
	?>
	<input class="btn btn-primary btn_submit" name="add_copy" type="submit" value="Add"/>
	<?php
	}else{
	?>
	<input class="btn btn-primary btn_submit" name="update" type="submit" value="Update"/>
	<?php
	}
	?>

 </div>

</div>
<?php
}else{
?>
	<?php

		if(isset($success_msg)){

			

			echo '<div class="alert alert-success msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

			Thanks Your Settings are saved!.</div>';

			

		} elseif(isset($error_msg)){

			

			echo '<div class="alert alert-danger msg"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Error.</div>';

		}

	?>

	<div class="wz_user_name">

	<h3 style="margin-bottom:20px;">Add New Button </h3>

	<div class="col-sm-4 wz_first_name">

		<label for="inputEmail">Name</label>

	</div>

	<div class="col-sm-6">

	   <input class="wz_first_name_input" type="text" name="name" id="name" placeholder="Enter Name" required>

	</div>

	</div>

<div class="wh_new_form">

	<div class="wh_head">

		<div class="col-sm-1 count">

		<label for="inputEmail">Country</label>

		</div>

	 

		<div class="col-sm-1 count">

		<label for="inputEmail">Price</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">AccountID</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Level ID</label>

		</div>

		<div class="col-sm-2 count">

		<label for="inputEmail">Descriptor Name</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">Postage</label>

		</div>

		<div class="col-sm-1 count">

		<label for="inputEmail">PlanID</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Course Text</label>

		</div>
		
		<div class="col-sm-2 count">

		<label for="inputEmail">Additional Text</label>

		</div>

	</div>

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" name="country_uk" id="country" value="UK">UK</label>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_uk" class="form-control" type="text" placeholder="price" required>

	  </div>


	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_uk" class="form-control" placeholder="Merchant Account ID" required type="text">

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="levelID_uk" class="form-control" placeholder="Level ID" type="text">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_uk" class="form-control" placeholder="Descriptor Name" required type="text">

	  </div>

	   <div class="col-sm-1 border1">

	   <input id="price" name="postage_uk" class="form-control" type="text" placeholder="price">

	  </div>

	  

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_uk" class="form-control" placeholder="Plan"  type="text">

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

	   <input name="course_text_uk" class="form-control" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

		<textarea id="" name="additional_text_uk" class="form-control" value="" placeholder="Enter Additional Text"  type="text" ></textarea>

		</div>

	  

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_usa" value="USA">USA</label>

	   

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_usa" class="form-control" type="text" placeholder="price" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_usa" class="form-control" placeholder="Merchant Account ID" required type="text">

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="levelID_usa" class="form-control" placeholder="Level ID" type="text">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_usa" class="form-control" placeholder="Descriptor Name" required type="text">

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_usa" class="form-control" type="text" placeholder="price">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_usa" class="form-control" placeholder="Plan"  type="text">

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

	   <input name="course_text_usa" class="form-control" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

		<textarea id="" name="additional_text_usa" class="form-control" value="" placeholder="Enter Additional Text"  type="text" ></textarea>

		</div>

	  

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_aus" value="AUS">AUS</label>

	   

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_aus" class="form-control" type="text" placeholder="price" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_aus" class="form-control" placeholder="Merchant Account ID" required type="text">

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="levelID_aus" class="form-control" placeholder="Level ID" type="text">

	  </div>

	  

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_aus" class="form-control" placeholder="Descriptor Name" required type="text">

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_aus" class="form-control" type="text" placeholder="price">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_aus" class="form-control" placeholder="Plan"  type="text">

	  </div>

	  <div class="col-sm-2 border1" id="wz_subs_id">

	   <input name="course_text_aus" class="form-control" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

		<textarea id="" name="additional_text_aus" class="form-control" value="" placeholder="Enter Additional Text"  type="text" ></textarea>

		</div>

	</div>

 

	<div class="wh_inputs ">

	  <div class="col-sm-1 border1">

	  <label for="inputEmail" id="country" name="country_eur" value="EUR">EUR</label>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="price_eur" class="form-control" type="text" placeholder="price" required>

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="merchantID_eur" class="form-control" placeholder="Merchant Account ID" required="" type="text">

	  </div>

	  

	  <div class="col-sm-1 border1">

	   <input id="price" name="levelID_eur" class="form-control" placeholder="Level ID" type="text">

	  </div>

	  <div class="col-sm-2 border1">

	   <input id="price" name="descriptorName_eur" class="form-control" placeholder="Descriptor Name" required type="text">

	  </div>

	  <div class="col-sm-1 border1">

	   <input id="price" name="postage_eur" class="form-control" type="text" placeholder="price">

	  </div>

	  <div class="col-sm-1 border1" id="wz_subs_id">

	   <input id="price" name="planID_eur" class="form-control" placeholder="Plan" type="text">

	  </div>

	  <div class="col-sm-2 border1" id="wz_subs_id">

	   <input name="course_text_eur" class="form-control" placeholder="Enter Text"  type="text" required>

	  </div>
	  
	  <div class="col-sm-2 border1" id="wz_subs_id">

		<textarea id="" name="additional_text_eur" class="form-control" value="" placeholder="Enter Additional Text"  type="text" ></textarea>

		</div>

	</div>

	
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_uk" placeholder="Enter upgrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_usa" placeholder="Enter upgrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_aus" placeholder="Enter upgrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Upgrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="update_plan_eur" placeholder="Enter upgrade plan ID" value="">

	  </div>

	</div>
 
 
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID UK</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_uk" placeholder="Enter degrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID USA</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_usa" placeholder="Enter degrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID AUS</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_aus" placeholder="Enter degrade plan ID" value="">

	  </div>

	</div>
	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Degrade Plan ID EUR</label>

		</div>

		<div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="degrade_plan_eur" placeholder="Enter degrade plan ID" value="">

	  </div>

	</div>


	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Subscription</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="subs_yes" value="yes" required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="subs_yes" checked value="no"> No

		</label>

	</div>

	
         <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Additional Product</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="select_additional_product" value="1"> Yes

		</label>

		<label class="form-check-label">

		 <input class="form-check-input wz_radio" type="radio" name="select_additional_product" checked value="0"> No

		</label>

	</div>
	
	
	<!--<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Register User</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" value="yes" required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="register_user" checked value="no"> No

		</label>

	</div>-->

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_billing">

		<div class="wz_first_lable">

		<label for="inputEmail" style="margin-right:10px;margin-left10px;">Delivery Address</label>

		</div>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" value="yes" required> Yes

		</label>

		<label class="form-check-label">

		  <input class="form-check-input wz_radio" type="radio" name="billing" checked value="no"> No

		</label>

	</div>

  

  

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Location</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <select class="custom-select mb-2 mr-sm-2 mb-sm-0 form-control" id="inlineFormCustomSelect" name="form_location">

		<!--option value="">Select Form Position</option-->

		<option value="top" selected>Top</option>

		<option value="center">Center</option>

		

	  </select>

	  </div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Top text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">
	<?php 
	$content = '';
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"top_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $content, $editor_id, $settings); ?>
	   <!--<input type="text" class="custom_url custom_style" placeholder="Enter your text" name="top_text">-->

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" name="top_text_css">

	</div>

	</div>

	

	<div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Payment Form Bottom text</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">
	<?php 
	$content = '';
	$editor_id = '';
	$settings = array('class'=>"custom_url custom_style",'textarea_name'=>"bottom_text",'media_buttons' => false,'quicktags'=>false);
	wp_editor( $content, $editor_id, $settings); ?>
	   <!--<input type="text" class="custom_url custom_style" placeholder="Enter your text" name="bottom_text">-->

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" name="bottom_text_css">

	</div>

	</div>

	

  

  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="custom_url" placeholder="Enter redirect URl" name="custom_url">

	  </div>

  </div>

    <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register" id="ifYes">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Existing Customer Redirect URL</label>

	</div>

    <div class="col-sm-4 wz_redirect_url">

	   <input type="url" pattern="https?://.+" class="button_label" name="ex_custom_url" placeholder="Enter redirect url">

	  </div>

  </div>

  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="button_label" placeholder="Enter button label">

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="#f7b977" name="custom_btn_css">

	</div>

  </div>
  
  
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Front Button label</label>

	</div>

    <div class="col-sm-4 wz_button_label">

	   <input type="text" class="button_label" name="front_button_label" placeholder="Enter Front button label">

	</div>
	
	<div class="col-sm-1 wz_button_label">

	   <input type="color" style="height:32px;" value="" name="front_custom_btn_css">

	</div>

  </div>
  
  <div class="form-check mb-2 mr-sm-2 mb-sm-0 wz_register">

	<div class="wz_first_lable">

	<label for="inputEmail" style="margin-right:10px;margin-left10px;">Custom Front button Style</label>

	</div>

    <div class="col-sm-1 wz_button_label">

	   <input type="color" class="button_label" name="custom_css" value="#C0C0C0">

	  </div>

	</div>

  <div style="float:left; width:100%;">

 <input class="btn btn-primary btn_submit" name="submit" type="submit" value="Add"/>

 </div>


</div>

</div>

<script>

    function yesnoCheck(that) {

        if (that.value == "custom_url") {

            //alert("check");

            document.getElementById("ifYes").style.display = "block";

        } else {

            document.getElementById("ifYes").style.display = "none";

        }

    }

</script>
<?php
}
?>