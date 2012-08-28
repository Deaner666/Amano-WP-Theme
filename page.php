<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 avia_get_template();


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 	 
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>

				<?php avia_title(); ?>

				<div class='template-page content'>

					<?php
					/* Run the loop to output the posts.
					* If you want to overload this in a child theme then include a file
					* called loop-page.php and that will be used instead.
					*/
					$avia_config['size'] = 'page';
					get_template_part( 'includes/loop', 'page' );
					?>
				
				</div><!--end content-->
				
				<?php 
				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();
				?>
				
			</div><!--end container-->

		</div>
		<!-- ####### END MAIN CONTAINER ####### -->

		<?php if(is_front_page()) { ?>
			<div class="container">
				<ul id="amano-footer-logos">
					<li><a href="/disabled-students-allowance/" class="dsa-logo">Disabled Students Allowance</a></li>
					<li><a href="/about-us/microsoft/" class="microsoft-logo">Microsoft Education Reseller</a></li>
					<li><a href="/about-us/british-assistive-technology-association/" class="bata-logo">The British Assistive Technology Association</a></li>
					<li><a href="/about-us/national-association-of-disability-practitioners/" class="nadp-logo">National Association of Disability Practitioners</a></li>
					<li><a href="/about-us/go-on-uk/" class="go-on-logo">Go On UK</a></li>
				</ul>
			</div>
		<?php } ?>


<?php get_footer(); ?>