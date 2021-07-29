<?php
/**
 * cioos Theme Customizer
 *
 * @package cioos
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cioos_customize_register( $wp_customize ) {
	
	// ---------
	// To add another control and option - like this colour picker
	// ---------
	// $wp_customize->add_setting( 'accent_color', array(
	// 	'default' => '#f72525',
	// 	'sanitize_callback' => 'sanitize_hex_color',
	//   ) );
	// $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
	// 	'label' => __( 'Accent Color', 'theme_textdomain' ),
	// 	'section' => 'title_tagline',
	// 	'settings' => 'accent_color'
	// ) ) );

	$wp_customize->remove_control('logo'); //remove the default logo, add 1 for each language.
	$wp_customize->remove_control('blogname');	
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_control('display_header_text');

	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('header_image');
	//$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('colors');
	// $wp_customize->remove_section('custom_css');	

	$wp_customize->add_setting( 'ra_selector', array(
		'default' => 'national',
  		'transport' => 'refresh'
	  ) );
	$wp_customize->add_control( 'ra_selector', array(
		'type' => 'radio',
		'section' => 'title_tagline', 
		'label' => __( 'R.A. Theme selector' ),
		'choices' => array(
			'national' => __( 'National' ),
			'pacific' => __( 'Pacific' ),
			'atlantic' => __( 'Atlantic' ),
			'slgo' => __( 'SLGO' ),
		),
	) );

	$wp_customize->add_setting( 'search_enable', array(
		'default' => false,
  		'transport' => 'refresh'
	  ) );

	$wp_customize->add_control( 'search_enable', array(
		'type' => 'radio',
		'section' => 'title_tagline', 
		'label' => __( 'Enable search' ),
		'choices' => array(
			true => __( 'Yes' ),
			false => __( 'No' ),
		),
	) );

	function tag_display($control) {
    if ( $control->manager->get_setting('google_analytics')->value() === 'tag' ) {
      return true;
		} else {
			return false;
		}
	}

	function custom_display($control) {
    if ( $control->manager->get_setting('google_analytics')->value() === 'custom' ) {
      return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting( 'google_analytics', array(
		'default' => 'tag',
  		'transport' => 'refresh'
	  ) );

	$wp_customize->add_control( 'google_analytics', array(
		'type' => 'radio',
		'section' => 'title_tagline', 
		'label' => __( 'Google Analytics integration' ),
		'choices' => array(
			'tag' => __( 'Tag' ),
			'custom' => __( 'Custom' ),
		),
	) );

	$wp_customize->add_setting( 'tag_google_analytics', array(
		'capability' => 'edit_theme_options',
		'default' => ''
	) );

	$wp_customize->add_control( 'tag_google_analytics', array(
		'type' => 'text',
		'section' => 'title_tagline',
		'label' => __( 'Tag Google Analytics' ),
		'active_callback' => 'tag_display',
		'description' => __( 'Integration of tag google analytics' ),
	) );

	$wp_customize->add_setting( 'custom_google_analytics', array(
		'capability' => 'edit_theme_options',
		'default' => ''
	) );
	
	$wp_customize->add_control( 'custom_google_analytics', array(
		'type' => 'textarea',
		'section' => 'title_tagline',
		'label' => __( 'Custom Google Analytics' ),
		'active_callback' => 'custom_display',
		'description' => __( 'Integration of custom google analytics' ),
	) );

	$wp_customize->add_setting( 'defaultlogo', array(
		'default' => '',
  		'transport' => 'refresh'
	  ) );
	  
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'defaultlogo', array(
		'label' => __( 'Alternate logos: Dual language logo', 'theme_textdomain' ),
		'description' => __( 'Alternate logos to replace the default ones that come with the theme, if needed.' ),
		'section' => 'title_tagline',
		'settings' => 'defaultlogo'
	) ) );

	$wp_customize->add_setting( 'english_logo', array(
		'default' => '',
  		'transport' => 'refresh'
	  ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'english_logo', array(
		'label' => __( 'Alternate logos: English logo', 'theme_textdomain' ),
		'section' => 'title_tagline',
		'settings' => 'english_logo'
	) ) );

	$wp_customize->add_setting( 'french_logo', array(
		'default' => '',
  		'transport' => 'refresh'
	  ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'french_logo', array(
		'label' => __( 'Alternate logos: French logo', 'theme_textdomain' ),
		'section' => 'title_tagline',
		'settings' => 'french_logo'
	) ) );



}
add_action( 'customize_register', 'cioos_customize_register' );