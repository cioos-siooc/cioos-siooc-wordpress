<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cioos
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(get_theme_mod( 'ra_selector' )); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cioos' ); ?></a>
	<header id="masthead" class="page-header">
		<div class="pre-nav">
			<div class="container">
				<div class="nationallogo"><img src="<?php bloginfo( 'template_url' ); ?>/img/CIOOS-watermark.svg"></div>
				<div class="logotype">
				<?php if ( is_active_sidebar( 'sidebarlogotype' ) ) : ?>
				<?php dynamic_sidebar( 'sidebarlogotype' ); ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="post-nav">
			<div class="container">
				<div class="sitelogo">
					<?php if (function_exists('pll_the_languages')){ ?>
						<?php if ( pll_current_language() == 'en'){ ?>
							<?php if ( get_theme_mod( 'english_logo' )){ ?>
								<a rel="home" href="/"><img src="<?php echo get_theme_mod( 'english_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
							<?php } else {?>
								<a rel="home" href="/"><img src="<?php bloginfo( 'template_url' ); ?>/img/<?php echo get_theme_mod( 'ra_selector' ) ?>/cioos-<?php echo get_theme_mod( 'ra_selector' ) ?>_EN.svg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
							<?php }; ?>
						<?php } else if ( pll_current_language() == 'fr'){?>
							<?php if ( get_theme_mod( 'french_logo' )){ ?>
								<a rel="home" href="/"><img src="<?php echo get_theme_mod( 'french_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
							<?php } else {?>
								<a rel="home" href="/"><img src="<?php bloginfo( 'template_url' ); ?>/img/<?php echo get_theme_mod( 'ra_selector' ) ?>/cioos-<?php echo get_theme_mod( 'ra_selector' ) ?>_FR.svg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
							<?php }; ?>
						<?php } else {?>
							<a rel="home" href="/"><img src="<?php bloginfo( 'template_url' ); ?>/img/<?php echo get_theme_mod( 'ra_selector' ) ?>/cioos-<?php echo get_theme_mod( 'ra_selector' ) ?>_EN_FR.svg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
						<?php }; ?>
					<?php } else {?>
						<?php if ( get_theme_mod( 'defaultlogo' )){ ?>
							<a rel="home" href="<?php esc_url( bloginfo() ); ?>"><img src="<?php echo get_theme_mod( 'DEFAULTLOGO' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
						<?php } else {?>
							<a rel="home" href="<?php esc_url( bloginfo() ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/<?php echo get_theme_mod( 'ra_selector' ) ?>/cioos-<?php echo get_theme_mod( 'ra_selector' ) ?>_EN_FR.svg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>
						<?php }; ?>
					<?php }; ?>
				</div>	
				<nav id="site-navigation" class="site-nav nav main-nav main-navigation">
					<?php if (function_exists('pll_the_languages')){ ?>	
						<?php if ( pll_current_language() == 'en'){ ?>					
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Primary Menu</button>
						<?php } else if( pll_current_language() == 'fr'){  ?>
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">menu primary</button>
						<?php } else {?>
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Primary Menu</button>
						<?php }; ?>
					<?php }; ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>
				<?php if (function_exists('pll_the_languages')){ ?>
					<nav id="language" class="site-nav nav language-nav">
						<div class="menu-default-container">
							<ul class="sitelanguages">
								<?php pll_the_languages(array(
									'hide_current' => 1,
									'display_names_as' => 'slug'
								));?>
							</ul>
						</div>
					</nav>
				<?php }; ?>
			</div>
		</div>
	</header>