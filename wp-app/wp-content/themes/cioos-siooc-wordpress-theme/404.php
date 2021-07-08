<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cioos
 */

get_header();
?>

	<main id="primary" class="site-main">
	<div class="container">
		<section class="error-404 not-found">
			<?php if(ICL_LANGUAGE_CODE=='fr'): ?>
				<div id="notfound">
					<div class="notfound">
						<div class="notfound-404">
							<h1>4<span>0</span>4</h1>
						</div>
						<h2>La page demandée est introuvable</h2>
						<a href="<?php echo home_url(); ?>">Page d'accueil</a>
					</div>
				</div>

				<?php else : ?>

				<div id="notfound">
					<div class="notfound">
						<div class="notfound-404">
							<h1>4<span>0</span>4</h1>
						</div>
						<h2>The page you requested could not found</h2>
						<a href="<?php echo home_url(); ?>">Home page</a>
					</div>
				</div>
			<?php endif; ?>
		</section><!-- .error-404 -->
		</div>
	</main><!-- #main -->

<?php
get_footer();
