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

        <div class="container-footer">
             <div class="site-footer-logo">
                <?php $alps_logo =  get_theme_mod( 'alps_logo' ); ?>
                <a href="<?php esc_url( home_url ( '/' ) ) ?>" title="<?php bloginfo( 'title' ); ?>">
                    <img class="desktop-logo" src="<?php echo $alps_logo;?>" alt="<?php bloginfo( 'title' ); ?>"/>
                </a>
            </div>

            <div class="site-footer-menus" id="site-footer-font">
                <nav class="footer-nav">
                    <ul>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'footer',
                                'menu_id'           => 'footer'
                            )
                        );
                        ?>
                    </ul>
                </nav>

                <div class="container-social-media">
                    <p id="footer-follow">Follow us on</p>
                    <ul class="social-icons">
                        <?php
                        $social_media_icons = get_theme_mod('alps_social_media_icons');
                        if (!empty($social_media_icons)) :
                            $social_media_icons_decoded = json_decode($social_media_icons);
                            foreach ($social_media_icons_decoded as $social_media_icon) : ?>
                                <a href="<?php echo esc_url($social_media_icon->link); ?>">
                                    <span class="footer-social-media-icons <?php echo esc_attr($social_media_icon->icon_value); ?>"></span>
                                </a>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                </div>

            </div>
                

            <div class="site-footer-contact">
                <p class="footer-contact"><?php echo get_theme_mod('alps_contact_number'); ?></p>
                <p><a href="mailto:<?php echo get_theme_mod('alps_email_address');?>" class="alt-email-contact"><?php echo get_theme_mod('alps_email_address') ?></a></p>             
                    
                    	<p id="tablet-footer-follow">follow us</p>                
                    	<ul class="tablet-social-icons"> 
                        <?php
                        $social_media_icons = get_theme_mod('alps_social_media_icons');
                        if (!empty($social_media_icons)) :
                            $social_media_icons_decoded = json_decode($social_media_icons);
                            foreach ($social_media_icons_decoded as $social_media_icon) : ?>
                                <a href="<?php echo esc_url($social_media_icon->link); ?>">
                                    <span class="footer-social-media-icons <?php echo esc_attr($social_media_icon->icon_value); ?>"></span>
                                </a>
                            <?php endforeach;
                        endif; ?>
                    </ul>               
            </div>
        </div>
    </footer><!-- #colophon -->   
            <div class="container-copyright">
                    <p class="sec">Copyright 2017-<?php echo bloginfo( 'title' )?></p>
            </div>
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    $('#contactform').submit(function() {
        var fullname=$('#fullname').val();
        var contact=$('#contact').val();
        var email=$('#email').val();
        var message=$('#message').val();

             $.ajax({
                url:"https://docs.google.com/a/alprograms.com/forms/d/e/1FAIpQLSeWepPNs84BapOChYt0DEAM1p3TzCnaFAUytpHUxAF5emQlmA/formResponse",
                data:{"entry_1582939635":fullname,"entry_553551918":contact,"entry_183305459":email,"entry_524141743":message},
                type:"POST",
                dataType:"xml",
                statusCode: {
                    0:function() { 
                        window.location.replace("contact-us");
                        alert('Thank you for contacting us! Click "OK" to continue.');
                    },
                    200:function(){
                        window.location.replace("contact-us");
                        alert('Thank you for contacting us! Click "OK" to continue.');
                    }
                }
            });
        
    });

       
    
</script>
</body>
</html>
