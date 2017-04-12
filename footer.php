<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ALPS
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<div class="site-footer-logo">
				<img id="foot-logo" src="<?php echo get_theme_mod('alps_logo'); ?>" alt="ALPs"> 
			</div>

			<div class="site-footer-contact">
				<p id="footer-title"><?php echo bloginfo( 'title' )?></p>
            	<p id="footer-contact"><?php echo get_theme_mod('alps_contact_number'); ?> <?php echo get_theme_mod('alps_email_address') ?></p>
            	
            </div>


            	
        
            <div class="container-social-media">
            
            		<p id="footer-follow">Follow us on</p>
            
            	<ul class="social-icons">
     				
            			<?php
           					 $social_media_icons = get_theme_mod('alps_social_media_icons');
           					 if (!empty($social_media_icons)) :
            				    $social_media_icons_decoded = json_decode($social_media_icons);
                				foreach ($social_media_icons_decoded as $social_media_icon) : ?>

                    				<a href="<?php echo esc_url($social_media_icon->link); ?>">
                        				<span class="fa <?php echo esc_attr($social_media_icon->icon_value); ?>"></span>
                    				</a>

                		<?php endforeach;
           				 endif; ?>
            	</ul>
            </div>

            <div class="site-footer-menus" id="site-footer-font">
            	<nav id="site-navigation" >
    				
    					<?php
    						wp_nav_menu(
    	    						array(
   	        						 'theme_location'    => 'footer',
   	        						 'menu_id'           => 'footer-menu small-text'
   	     							)
  	  						);
   						 ?>
   				
  					
				</nav>
				<div class="footer-copyryt">
					<p>Copyright 2017</p>
				</div>
			
			</div>


		</div><!-- .site-info -->

			
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
