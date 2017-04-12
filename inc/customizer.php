<?php
/**
 * ALPS Theme Customizer
 *
 * @package ALPS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alps_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /*
     * WP CONTROLS
     */

    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('background_color');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('colors');


    /*
     * Section: Logo
     */

    $wp_customize->add_panel('alps_logo_panel', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Logo', 'alps')
    ));

    $wp_customize->add_section('alps_logo_section', array(
        'title' => esc_html__('Logo', 'alps'),
        'panel' => 'alps_logo_panel'
    ));

    $wp_customize->add_setting( 'alps_logo', array(
        'default' => get_template_directory() . '/images/logo-nav.png' ,
        'sanitize_callback' => 'esc_url',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'alps_logo',
            array(
                'label'    => esc_html__( 'Logo', 'alps' ),
                'section'  => 'alps_logo_section',
                'priority'    => 1,
            )
        )
    );


   /*
    * Footer
    */

    require_once( 'class/general-customizer-control.php' );


    $wp_customize->add_panel('alps_footer_panel', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Footer Section', 'alps')
    ));

    $wp_customize->add_section('alps_contact_number_section', array(
        'title' => esc_html__('Contact Number', 'alps'),
        'panel' => 'alps_footer_panel',
    ));

    $wp_customize->add_setting( 'alps_contact_number', array (
        'sanitize_callback' => 'alps_sanitize_input',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control( 'alps_contact_number', array (
        'label' => esc_html__( 'Contact Number', 'alps' ),
        'section' => 'alps_contact_number_section',
    ));


    $wp_customize->add_section( 'alps_social_media_link_section' , array(
        'title' => esc_html__( 'Social Media Link', 'alps' ),
        'panel' => 'alps_footer_panel',
    ));


    /*

    Footer
    Socials icons

    */

    $wp_customize->add_setting( 'alps_social_media_icons', array(
        'sanitize_callback' => 'alps_sanitize_repeater',
        'default' => json_encode(
            array(
                array( 'icon_value' => 'icon-social-facebook' , 'link' => '#' ),
                array( 'icon_value' => 'icon-social-twitter' , 'link' => '#' ),
                array( 'icon_value' => 'icon-social-googleplus' , 'link' => '#' ),
            )
        ),

    ));
    $wp_customize->add_control( new General_Customizer_Control( $wp_customize, 'alps_social_media_icons', array(
        'label'   => esc_html__( 'Add new social icon','alps' ),
        'section' => 'alps_social_media_link_section',
        'customizer_image_control' => false,
        'customizer_icon_control' => true,
        'customizer_text_control' => false,
        'customizer_link_control' => true,
    )));

    /**
     * Footer
     * Email Address
     */
     $wp_customize->add_section('alps_email_address_section', array(
        'title' => esc_html__('Email Address', 'alps'),
        'panel' => 'alps_footer_panel',
    ));

    $wp_customize->add_setting( 'alps_email_address', array (
        'sanitize_callback' => 'alps_sanitize_input',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control( 'alps_email_address', array (
        'label' => esc_html__( 'Email Address', 'alps' ),
        'section' => 'alps_email_address_section',
    ));


}
add_action( 'customize_register', 'alps_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alps_customize_preview_js() {
    wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ),
        '20151215', true );
}
add_action( 'customize_preview_init', 'alps_customize_preview_js' );



function alps_sanitize_input( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
/**
 * Sanitize repeater
 *
 * @param string $input Json to sanitize.
 */
function alps_sanitize_repeater( $input ) {

    $input_decoded = json_decode( $input, true );
    $allowed_html = array(
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'a' => array(
            'href' => array(),
            'class' => array(),
            'id' => array(),
            'target' => array(),
        ),
        'button' => array(
            'class' => array(),
            'id' => array(),
        ),
        'ul' => array(
            'class' => array(),
            'id' => array(),
            'style' => array(),
        ),
        'li' => array(
            'class' => array(),
            'id' => array(),
            'style' => array(),
        ),
    );

    if ( ! empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxk => $box ) {
            foreach ( $box as $key => $value ) {
                if ( $key == 'text' ) {
                    $value = html_entity_decode( $value );
                    $input_decoded[ $boxk ][ $key ] = wp_kses( $value, $allowed_html );
                } else {
                    $input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );
                }
            }
        }

        return json_encode( $input_decoded );
    }

    return $input;
}

