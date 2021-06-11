<?php
/**
 * cioos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cioos
 */
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

define( 'WP_DEBUG', true );
if ( ! function_exists( 'cioos_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cioos_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languagcurrent_page_itemes/ directory.
		 * If you're building a theme based on cioos, use a find and replace
		 * to change 'cioos' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cioos', get_template_directory() . '/languages' ); 
		//not sure how this syncs with polylang.

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'main menu', 'cioos' )
			)
		);

/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'cioos_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		* Don't add support for core custom logo - Make a French, English and Both logo
		*
		* @link https://codex.wordpress.org/Theme_Logo
		*
		* add_theme_support(
		* 	'custom-logo',
		* 	array(
		* 		'height'      => 250,
		* 		'width'       => 250,
		* 		'flex-width'  => true,
		* 		'flex-height' => true,
		* 	)
		* );
		*/
	}
endif;
add_action( 'after_setup_theme', 'cioos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
*/
function cioos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cioos_content_width', 1140 );
}
add_action( 'after_setup_theme', 'cioos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action( 'widgets_init', 'cioos_widgets_init' );
function cioos_widgets_init() {

	register_sidebar(array(
		'name'          => __(  'Pre-nav Top Bar', 'sidebarlogotype-title' ),
		'id'            => 'sidebarlogotype',
		'description'   => __( 'Add the text description that is found on the top header of the site', 'sidebarlogotype-description' ),
		'before_widget' => '<aside class="%1$s widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '', 
	) );
	register_sidebar(array(
		'name'          => __(  'Footer area 1', 'sidebar-footer-1' ),
		'id'            => 'sidebar-footer-1',
		'description'   => __( 'Add widgets here.', 'sidebar-footer-1-description' ),
		'before_widget' => '<aside class="%1$s widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '', 
	) );
	register_sidebar(array(
		'name'          => __(  'Footer area 2', 'sidebar-footer-2' ),
		'id'            => 'sidebar-footer-2',
		'description'   => __( 'Add widgets here.', 'sidebar-footer-2-description' ),
		'before_widget' => '<aside class="%1$s widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '', 
	) );
	register_sidebar(array(
		'name'          => __(  'Footer area 3', 'sidebar-footer-3' ),
		'id'            => 'sidebar-footer-3',
		'description'   => __( 'Add widgets here.', 'sidebar-footer-3-description' ),
		'before_widget' => '<aside class="%1$s widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '', 
	) );
	register_sidebar(array(
		'name'          => __(  'Footer area 4', 'sidebar-footer-4' ),
		'id'            => 'sidebar-footer-4',
		'description'   => __( 'Add widgets here.', 'sidebar-footer-4-description' ),
		'before_widget' => '<aside class="%1$s widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '', 
	) );
}

/**
 * Enqueue scripts and styles.
 */
function cioos_scripts() {
	wp_enqueue_style( 'cioos-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cioos-style', 'rtl', 'replace' );
	wp_enqueue_style('dashicons');
	wp_enqueue_script( 'cioos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cioos_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add unlimited sidebars.
 */
require get_template_directory() . '/inc/SidebarGenerator.php';

add_action("add_meta_boxes", "add_custom_meta_box");

function add_custom_meta_box()
{
    add_meta_box(
			"cioos_sidebar_dropdown", 
			"Custom Meta Box", 
			"custom_meta_box_markup", 
			"page", 
			"normal", 
			"default", 
			null);
}

function custom_meta_box_markup($post)
{
	global $wp_registered_sidebars;
	$sidebar_dropdown = get_post_meta( $post->ID, 'sidebar_dropdown_value', true );
	$meta = get_post_meta( $post->ID );
	$layout = ( isset( $meta['layout'][0] ) && '' !== $meta['layout'][0] ) ? $meta['layout'][0] : '';
	// $saved_term = $this->field->value;
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	

	?>
		<table class="form-table">
			<tbody>
			<tr class="meta_layout">
					<th><label for="sidebar_layout_title">Page Layout</label></th>
					<td>
						<ul style="list-style:none">
							<?php
								echo '<li><input type="radio" id="layout-full" name="layout" value=option1' . checked( $layout, 'option1', false ) . '>';  
								echo '<label for="layout-full">Full Width</label></li>';
								echo '<li><input type="radio" id="layout-left" name="layout" value=option2' . checked( $layout, 'option2', false ) . '>';    
								echo '<label for="layout-left">Left Sidebar</label></li>';
							?>
						</ul>
					</td>				
				</tr>
				<tr class="meta_sidebar">
					<th><label for="sidebar_title">Select a Sidebar</label></th>
					<td>
						<select id="cioos_sidebar_dropdown" name="cioos_sidebar_dropdown">
							<?php
								foreach ( $wp_registered_sidebars as $key => $value ) {
									if ( strpos( $value['id'], 'footer' ) !== false ) {
									} else {
										echo '<option ' . selected( $value['id'], $sidebar_dropdown, false ) . ' value=' . $value['id'] . '>' . $value['name'] . '</option>';
									}    
								}
							?>
						</select>
					</td>				
				</tr>
			</tbody>
		</table>
	<?php  
}

add_action("save_post", "save_custom_meta_box", 10, 3);

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(isset($_POST["cioos_sidebar_dropdown"]))
    {
			update_post_meta($post_id, "sidebar_dropdown_value", $_POST["cioos_sidebar_dropdown"]);
    }
		
		if(isset($_POST["layout"]))
    {
			update_post_meta( $post_id, 'layout', sanitize_text_field( wp_unslash( $_POST['layout'] ) ) ); // Input var okay.
    }    
}

function cioos_scripts_admin($hook_suffix) {
	if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
		wp_enqueue_script( 'custom_js', get_template_directory_uri() . '/js/sidebar.js', array( 'jquery' ));
 }
}
add_action( 'admin_enqueue_scripts', 'cioos_scripts_admin' );



/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
