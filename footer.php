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

	<footer class="site-footer">
		

			<div class="site-footer-logo">
				<?php $alps_logo =  get_theme_mod( 'alps_logo' ); ?>
				<a href="<?php esc_url( home_url ( '/' ) ) ?>" title="<?php bloginfo( 'title' ); ?>">
					<img class="desktop-logo" src="<?php echo $alps_logo;?>" alt="<?php bloginfo( 'title' ); ?>"/>	
				</a>
				
			</div>

			<div class="container-site-footer-contact">
				<p class="footer-title"><?php echo bloginfo( 'title' )?></p>
            	<p class="footer-contact"><?php echo get_theme_mod('alps_contact_number'); ?> <?php echo get_theme_mod('alps_email_address') ?></p>
            	
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
            	<nav>
    				<ul>
    					<?php
    						wp_nav_menu(
    	    						array(
   	        						 'theme_location'    => 'footer',
   	        						 'menu_id'           => 'footer-menu small-text'
   	     							)
  	  						);
   						 ?>
   				
  					</ul>
				</nav>
				
			
			</div>


		

			
	</footer><!-- #colophon -->
	<footer class="third">
		<div class="cont-alt-title">
			<p class="alt-title"><?php echo bloginfo( 'title' )?></p>
		</div>
		<section class="one-half">
			<article class="art-menu">
				<nav>
    				
    					<?php
    						wp_nav_menu(
    	    						array(
   	        						 'theme_location'    => 'footer',
   	        						 'menu_id'           => 'footer-menu small-text'
   	     							)
  	  						);
   						 ?>
   				
				</nav>
			</article>
			<aside class="asd-contact-info">
				<div class="phone-contact">
					<p class="alt-phone-contact"><?php echo get_theme_mod('alps_contact_number'); ?></p>
					<p class="alt-email-contact"><?php echo get_theme_mod('alps_email_address') ?></p>
				</div>
			<section class"sec-extra">
				<article class="art-extra">
					<p id="extra-follow">Follow us</p>   	
				</article>
				<aside class="asd-extra">
					
				</aside>
			</section>
				<div class="social-contacts">		
						
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
			</aside>
		</section>

	</footer>
	<footer class="second">
			<p class="frs">Copyright 2017</p>
			<p class="sec">Copyright 2017-<?php echo bloginfo( 'title' )?></p>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>


