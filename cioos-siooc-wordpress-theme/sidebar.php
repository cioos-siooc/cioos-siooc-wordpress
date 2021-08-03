<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cioos
 */
?>

	<div id="sidebar">
	<div id="sidebar-core">
		<?php if ( ! dynamic_sidebar( cioos_meta_sidebars() ) ) : ?>
			<aside class="widget widget_text">
				<h3 class="widget-title"><?php _e( 'Please Add Widgets', 'experon' ); ?></h3>
				<div class="textwidget"><div class="error-icon">
					<p><?php _e( 'Remove this message by adding widgets to the Sidebar from the Widgets section of the Wordpress admin area.', 'experon' ); ?></p>
					<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" title="No Widgets Selected"><?php _e( 'Click here to go to Widget area.', 'experon' ); ?></a>
				</div></div>
			</aside>
		<?php endif; ?>

	</div>
	</div><!-- #sidebar -->
			