<?php /* Template Name: Contact Us */ ?>


<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ALPS
 */

get_header(); 
	
	$page = get_page_by_title(get_the_title());
	$content = apply_filters('the_content', $page->post_content);?>
	<section class"contact-us-banner">
		<div class="contact-us-banner-top">
			<?php the_post_thumbnail('full' ,['class' => 'contact-us-banner-image-bg', 'title' => 'Feature image']); ?>
			<div class="contact-us-banner-text">
				<h1 class="contact-us-top"><?php the_title(); ?></h1>
				<h3 class="contact-us-top"><?php echo $content; ?></h3>
			</div>	
		</div>
	</section>
<!-- End of the Banner -->

	<section class="contact-us-banner-middle">
		<h2 class="contact-us-middle">Connect with us today!</h2>
		<h6 class="contact-us-middle">We will reply within 24 hours</h6>
		<div class="cont-us-media">
			<!-- <ul class="contact-us-social-media-icons"> 
                        <?php
                        $social_media_icons = get_theme_mod('alps_social_media_icons');
                        if (!empty($social_media_icons)) :
                            $social_media_icons_decoded = json_decode($social_media_icons);
                            foreach ($social_media_icons_decoded as $social_media_icon) : ?>
                                <a href="<?php echo esc_url($social_media_icon->link); ?>">
                                    <span class="contact-us-social-icons <?php echo esc_attr($social_media_icon->icon_value); ?>"></span>
                                </a>
                            <?php endforeach;
                        endif; ?>
             </ul>            --> 
		</div>
	</section>
<!-- End of Connect with us section -->

	<section class="contact-us-form-section">
		<div class="contact-us-questions">
			<h3 class="contact-us-heading-question">Have a question?</h3>
		</div>
		<article class="contact-us-form">
			<div class="contact-form-pre-message">
				<h5 class="contact-tags">Let us know your concerns</h5>
			</div>
			<div class="contact-form">
				<form method="POST"  id="contactform">
<!-- action="https://script.google.com/macros/s/AKfycbz7pzJBKLxpQGTIsBClUuoNgyFqN6Wimo8uUEYxus2tfwCzLls/exec" -->
					<label for="fullname">Full Name</label><br>
    				<input type="text" id="fullname" name="fullname" class="form-input" placeholder="John Doe" required></br>
    				<p class="form-name-error">Full name is missing!!!</p>
   					<label for="contact">Contact Number</label><br>
    				<input type="text" id="contact" name="contact" class="form-input" placeholder="+639123456789/111-2222" required></br>
    				<p class="form-contact-error">Contact Number is missing!!!</p>
    			 	<label for="email">Email Address</label><br>
    			 	<input type="email" id="email" name="email" class="form-input" placeholder="johndoe@email.com" required></br>
    			 	<p class="form-email-error">Email Address is missing!!!</p>
    			 	<label for="message">Message</label><br>
    			 	<textarea id="message" name="message" style="width:90%" class="form-textarea" placeholder="Message here..." required></textarea></br>
    			 	<p class="form-message-error">Put some Message for us.</p>
    			 	<input type="submit" value="Send Message" id="form-button" >
				</form>
			
			</div>
		</article>
		<aside class="contact-us-info">
			<div class="contact-get-in-touch">
				<h5 class="contact-tags">Get in touch with us!</h5>				
			</div>
			<section class="contact-us-info-section">
				<article class="contact-information">
					<div class="contact-numbers">
						<h4 class="contact-us-web-title"><?php echo bloginfo( 'title' )?></h4>
						<h4 class="contact-us-web-title"><?php echo get_theme_mod('alps_contact_number'); ?></h4>
						<h5 class="contact-us-web-title"><?php echo get_theme_mod('alps_email_address') ?></h5>
						<h5 class="contact-us-web-title"><span class="contact-emphasis">Smart:</span> +639456788993</h5>
						<h5 class="contact-us-web-title"><span class="contact-emphasis">Globe:</span> +639057699862</h5>
					</div>
					<div class="contact-address">
						<h5 class="contact-us-web-title"><span class="contact-emphasis">Office Address:</span> Knightsbridge Condominium, Brgy. Poblacion, Makati City</h5>
					</div>
				</article>
				<aside>
					<div class="contact-us-map">
						<img class="website-map" src="http://localhost/wordpress/wp-content/uploads/2017/04/samplemap.png" >
					</div>
				</aside>
			</section>
		</aside>
	</section>

<?php
get_footer();