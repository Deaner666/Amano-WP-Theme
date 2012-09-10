<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500' rel='stylesheet' type='text/css'>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php 
		global $avia_config;

		/*
		 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
		 * located in framework/php/function-set-avia-frontend.php
		 */
		 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }
		 
	?>


	<!-- page title, displayed in your browser bar -->
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>


	<!-- add feeds, pingback and stuff-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<!-- add css stylesheets -->	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/<?php avia_option('stylesheet', 'minimal-skin.css'); ?>" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css" type="text/css" media="screen"/>


	<!-- plugin and theme output with wp_head() -->
	<?php 

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		 
		wp_head();
	?>

	<!-- custom.css file: use this file to add your own styles and overwrite the theme defaults -->
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>
	<!--[if lt IE 8]>
	<style type='text/css'> .one_fourth	{ width:21.5%;} div{zoom:1;}</style>
	<![endif]-->
</head>



<?php 
/*
 * prepare big slideshow if available
 * If we are displaying a dynamic template the slideshow might already be set
 * therefore we dont need to call it here
 */

if(!avia_special_dynamic_template())
{
	avia_template_set_page_layout();
	$slider = new avia_slideshow(avia_get_the_ID());
	$avia_config['slide_output'] =  $slider->display();
}


$style = avia_get_option('boxed','boxed');
?>


<body id="top" <?php body_class($style." ".avia_get_browser()); ?>>
	
	
	<!-- ####### MASTHEAD BY DAVE ####### -->
	<div id="masthead">

		<div id="logo">
			<h1><a href="<?php echo get_option("siteurl"); ?>">Amano Technologies Ltd.</a></h1>
		</div>

		<ul id="social_bookmarks">
			<li class='rss'><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
			<?php 
				if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>Twitter</a></li>";
				if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>Facebook</a></li>";
			 ?>
			 <li class='youtube'><a href="http://www.youtube.com">YouTube</a></li>
		</ul>
		<!-- end social_bookmarks-->

		<div id="phone-number">Tel. 01822 600060</div>

		<?php
			/*
			*	display the main navigation menu
			*   check if a description for submenu items was added and change the menu class accordingly
			*   modify the output in your wordpress admin backend at appearance->menus
			*/
			echo "<div class='sub_menu'>";
			$args = array('theme_location'=>'avia2', 'fallback_cb' => '');
			if(avia_woocommerce_enabled()) $args['fallback_cb'] ='avia_shop_nav';
			wp_nav_menu($args); 
			echo "</div>";
		?>

		<div id="acc-pane">
			<div class="text-size">
				<!-- <label class="text">Text Size &rarr;</label> -->
				<ul class="acc-icons">
					<li class="small"><a href="#">Small</a></li>
					<li class="medium"><a href="#">Medium</a></li>
					<li class="big"><a href="#">Large</a></li>
				</ul>
			</div>
			<div id="choose-style">
				<!-- <label class="colour">&larr; Colour scheme</label> -->
				<ul class="acc-style">
					<li class="amano"><a href="#">Amano style</a></li>
					<li class="black-on-white"><a href="#" class="black-on-white-style">Black on White</a></li>
					<li class="black-on-yellow"><a href="#" class="black-on-yellow-style">Black on Yellow</a></li>
					<li class="yellow-on-black"><a href="#" class="yellow-on-black-style">Yellow on Black</a></li class="black-on-white-a">
					<li class="black-on-cream"><a href="#" class="black-on-cream-style">Black on Cream</a></li>
				</ul>
			</div>
		</div><!-- end acc-pane -->

		<?php
			// Temporarily removed whilst we wait for shop to go live
			// if(avia_woocommerce_enabled()) echo avia_woocommerce_cart_dropdown();
			// echo "</div>";
		?>

		<!-- Temporary whilst we wait for shop to go live -->
		<ul class = 'cart_dropdown' data-success='Product added'>
			<li class='cart_dropdown_first'>
				<a class='cart_dropdown_link' href='http://localhost:8888/amano/?page_id=6'>Cart</a>
				<span class='cart_subtotal'>
					<span class="amount">&pound;0</span>
				</span>
				<div class='dropdown_widget dropdown_widget_cart'>
					<span class="hidden">Cart</span><!--mfunc woocommerce_mini_cart() -->
					<ul class="cart_list product_list_widget ">
						<li class="empty">Online shop coming soon</li>
					</ul>
				<!-- end product list --><!--/mfunc-->
				</div>
			</li>
		</ul>
		</div><!-- Remove to here -->

		<?php
			echo "<div class='main_menu'>";
			$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'max_columns'=>4);
			wp_nav_menu($args); 
		?>

	</div>
	<!-- ####### END MASTHEAD BY DAVE ####### -->
	
	
	<div id='wrap_all'>	

		<?php  	
			//display slideshow big if one is available	
			if(!empty($avia_config['slide_output'])) echo "<div class='container slideshow_big'>".$avia_config['slide_output']."</div>";	
		?>
			