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

	$wp_customize->add_setting( 'ra_catalogue_api_url', array(
		'default' => '',
  		'transport' => 'refresh'
	  ) );
	$wp_customize->add_control( 'ra_catalogue_api_url', array(
		'type' => 'text',
		'section' => 'title_tagline', 
		'label' => __( 'R.A. CKAN Base URL' ),
		'description' => __( 'Pulls a list of data contributors from the referenced CKAN organization list that contain at least 1 dataset.  Example: https://catalogue.[hostname]/ or https://[hostname]/ckan/.  Use the [ckan_organizations] shortcode to place the list in a page/post.' ),
	) );
	
	$ra_menus = array();
	// print("<pre>");
	foreach(wp_get_nav_menus() as $ra_menu_item){
		$ra_menus[$ra_menu_item->slug] = $ra_menu_item->name;
		// print($ra_menu_item->slug);
	}
	// print("</pre>");
	
	$wp_customize->add_setting( 'ra_menu_en', array() );
	$wp_customize->add_control( 'ra_menu_en', array(
		'type' => 'select',
		'section' => 'title_tagline', 
		'label' => __( 'R.A. English menu selector' ),
		'choices' => $ra_menus,
		'description' => __( 'Makes the contents of the selected menu available via the Wordpress REST API in JSON format for consumption by CKAN to create consistent menus' ),
	) );
	
	$wp_customize->add_setting( 'ra_menu_fr', array() );
	$wp_customize->add_control( 'ra_menu_fr', array(
		'type' => 'select',
		'section' => 'title_tagline', 
		'label' => __( 'R.A. French menu selector' ),
		'choices' => $ra_menus,
		'description' => __( 'Makes the contents of the selected menu available via the Wordpress REST API in JSON format for consumption by CKAN to create consistent menus' ),
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

function fetch_ckan_organizations(){

	$return_value = "<p>NO CKAN API URL SPECIFIED!</p>";

	// Strip trailing slash to ensure consistency in generated URLs, i.e. no double slashes in API calls.
	$base_url = rtrim(get_theme_mod("ra_catalogue_api_url"), '/');

	if(!empty($base_url)){
		// Get language code for currently selected language
		$lang = strtolower(substr(get_locale(), 0, 2));

		// Configure Base URL to use current locale setting of Wordpress to 
		// ensure that when linking to organizations in CKAN the selected 
		// language is preserved
		$base_url = $base_url . "/" . $lang; 

		$curl = curl_init();

		$org_list = $base_url . "/api/3/action/organization_list";

		curl_setopt($curl, CURLOPT_URL, $org_list);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
	
		$output = curl_exec($curl);

		$organizations = json_decode($output, true)["result"];
		$org_details = [];
		foreach($organizations as $key => $org_id){
			$org_detail_url = $base_url . "/api/3/action/organization_show?id=" . $org_id;
			curl_setopt($curl, CURLOPT_URL, $org_detail_url);
			
			$org_detail_output = curl_exec($curl);
			$info = json_decode($org_detail_output, true)["result"];
			
			// Add organizations with at least 1 dataset
			if ($info["package_count"] >= 1) {
				$org_details[$org_id]["id"] = $org_id;
				$org_details[$org_id]["name"] = $info["title_translated"];
				$org_details[$org_id]["logo"] = $info["image_url_translated"];
				$org_details[$org_id]["site_url"] = $info["external_home_url"];
				$org_details[$org_id]["ckan_org_url"] = $base_url . "/organization/" . $org_id;
			}
		}
		
		$_org_detail_template  = "  <div class=\"wp-block-column\">";
		$_org_detail_template .= "    {org_logo_link}";
		$_org_detail_template .= "  </div>";

		$_org_logo_link_template = "<figure class=\"wp-block-image size-large\"><a href=\"{ckan_org_url}\"><img src=\"{logo}\" loading=\"lazy\" alt=\"{name}\" /></a></figure>";
		$_org_link_template = "<a href=\"{ckan_org_url}\" class=\"btn btn--solid\">{name}</a>";

		$return_value = "<div class=\"wp-block-columns ra_ckan_org_list partners bottom-3\">";
		foreach($org_details as $key => $org){
			$_org_detail = $_org_detail_template;
			
			$logo_path =  $org["logo"][$lang];
			
			// Determine if a logo path is a full URL or if it is a relative 
			// URL, which implies that it a path relative to the root of the 
			// CKAN base URL.
			if(!filter_var($logo_path, FILTER_VALIDATE_URL) && !empty($logo_path)){
				$source_url = parse_url($base_url);
				$logo_path = sprintf("%s://%s/%s", $source_url["scheme"], $source_url["host"], $logo_path);
			}
			
			// If logo emtpy then create a text link, otherwise insert logo + link
			if(empty($logo_path)){
				$_org_detail = str_replace("{org_logo_link}", $_org_link_template, $_org_detail);
			}
			else{
				$_org_detail = str_replace("{org_logo_link}", $_org_logo_link_template, $_org_detail);
			}

			// With template created, replace values and add to output
			$_org_detail = str_replace("{name}", $org["name"][$lang], $_org_detail);
			$_org_detail = str_replace("{ckan_org_url}", $org["ckan_org_url"], $_org_detail);
			$_org_detail = str_replace("{site_url}", $org["site_url"], $_org_detail);
			$_org_detail = str_replace("{logo}", $logo_path, $_org_detail);
			
			$return_value .= $_org_detail;
		}
		
		$return_value .= "</div>";
		curl_close($curl);
	}

	return $return_value;
}

add_shortcode('ckan_organizations', 'fetch_ckan_organizations');

function get_menu_en() {
    # uses slug as set in the RA menu selector options
    return wp_get_nav_menu_items(get_theme_mod('ra_menu_en'));
}

function get_menu_fr() {
    # uses slug as set in the RA menu selector options
    return wp_get_nav_menu_items(get_theme_mod('ra_menu_fr'));
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'ra', '/menu/en', array(
		'methods' => 'GET',
		'callback' => 'get_menu_en',
	) );

	register_rest_route( 'ra', '/menu/fr', array(
		'methods' => 'GET',
		'callback' => 'get_menu_fr',
	) );
} );
