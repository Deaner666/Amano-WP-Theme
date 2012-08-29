			<?php 
			global $avia_config;
						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
			 /**
			 *  The footer default dummy widgets are defined in folder includes/register-widget-area.php
			 *  If you add a widget to the appropriate widget area in your wordpress backend the 
			 *  dummy widget will be removed and replaced by the real one previously defined
			 */
			
			
			if(is_front_page() || avia_get_option('footer_logo_where') == 'everywhere')			 
			$attachment_holder = avia_get_post_by_title( "avia_smart-logo-gallery"); 
			
			if(!empty($attachment_holder['ID']))
			{
				$attachments = get_children(array('post_parent' => $attachment_holder['ID'],
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));
                if(is_array($attachments))
                {
                	echo "<div class='footer-logos'><div class='container'>";
	                foreach($attachments as $key => $attachment) 
					{
						echo avia_image_by_id($attachment->ID);
					}
					echo "</div></div>";
				}
			}
		
		


		
			?>
			
			
			
			
			
			<!-- ####### FOOTER CONTAINER ####### -->
			<div class='container_wrap' id='footer'>
				<div class='container'>
				
					<?php 
					//create the footer columns by iterating  
					$columns = avia_get_option('footer_columns');
					
					$firstCol = 'first';
			        switch($columns)
			        {
			        	case 1: $class = ''; break;
			        	case 2: $class = 'one_half'; break;
			        	case 3: $class = 'one_third'; break;
			        	case 4: $class = 'one_fourth'; break;
			        	case 5: $class = 'one_fifth'; break;
			        }
					
					//display the footer widget that was defined at appearenace->widgets in the wordpress backend
					//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
					for ($i = 1; $i <= $columns; $i++)
					{
						echo "<div class='$class $firstCol'>";
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
						echo "</div>";
						$firstCol = "";
					}
					
					?>

					
				</div>
				
			</div>
			<!-- ####### END FOOTER CONTAINER ####### -->
		
		</div><!-- end wrap_all -->
		
		
		
		<?php 
			if(avia_get_option('bg_image') && avia_get_option('bg_image_repeat') == 'fullscreen') 
			{ 
				$image = avia_get_option('bg_image');
			?>
				<!--[if lte IE 8]>
				<style type="text/css" class='bg_fullscreen_ie_rule'>
				body {
				-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image; ?>', sizingMethod='scale')";
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image; ?>', sizingMethod='scale');
				}
				</style>
				<![endif]-->
			<?php
				echo "<div class='bg_container' style='background-image:url(".avia_get_option('bg_image').");'></div>"; 
			}
		?>

		<?php
			/* add javascript */
			wp_enqueue_script( 'jquery' );
		?>
			<script src="<?php get_option("siteurl"); ?>wp-content/themes/abundance/js/jquery.cookie.js" type="text/javascript"></script>
			<script src="<?php get_option("siteurl"); ?>wp-content/themes/abundance/js/jquery.textresizer.js" type="text/javascript"></script>
		<?php
			wp_enqueue_script( 'avia-default' );
			wp_enqueue_script( 'avia-prettyPhoto' );
			wp_enqueue_script( 'avia-html5-video' );
			wp_enqueue_script( 'avia_fade_slider' );
			wp_enqueue_script( 'avia-slider' );
			wp_enqueue_script( 'aviacordion' );


			/* We add some JavaScript to pages with the comment form
			 * to support sites with threaded comments (when in use).
			 */
			if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
		
		?>
		

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	avia_option('analytics', false, true, true);
	wp_footer();
	
	
?>
</body>
</html>