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
			'slgo' => __( 'Atlantic' ),
		),
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