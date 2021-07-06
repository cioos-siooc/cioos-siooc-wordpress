<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cioos
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container <?php if ( cioos_meta_layout()== "option2" and cioos_meta_sidebars()) : echo "with-sidebar"; endif;?>">
			<?php
				if ( cioos_meta_layout()== "option2" and cioos_meta_sidebars()) :
					get_sidebar();
				endif;
				if ( cioos_meta_layout()== "option2" and cioos_meta_sidebars()) : echo '<div class="sidebar-content">'; endif;
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				if ( cioos_meta_layout()== "option2" and cioos_meta_sidebars()) : echo '</div>'; endif;
			?>
		</div>
	</main><!-- #main -->
<?php
get_footer();
