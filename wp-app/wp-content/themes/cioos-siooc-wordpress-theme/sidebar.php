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

		<?php 
			dynamic_sidebar( cioos_meta_sidebars() )
		?>

	</div>
	</div><!-- #sidebar -->
			