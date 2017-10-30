<?php
/**
 *
 * Template Name: Content Page
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage agile
 * @since Agile 2.0
 *
 */

get_header();
$theme = get_post_meta($post->ID, 'Page Theme Colour', true);
$theme = strtolower($theme);
$theme = preg_replace('/\s+/', '-', $theme);
?>
<div id="page-body" class="content-page<?php if(!empty($theme)) echo ' ' . $theme . '-theme' ?>">
	<div id="page-body-inner">
		<?php 
			if(have_posts()){
				while ( have_posts() ) : the_post();
					// The post background image
					$img;
					if(has_post_thumbnail()){
						$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
						$img = $img[0];
					}

					if (class_exists('MultiPostThumbnails')) {
						$icon = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'masthead-icon-image', $post->ID);
					}
		?>
				<div id="content-container" <?php echo empty($img) ? ' class="no-masthead"' : ''; ?>>
					<div id="content-container-row" class="row">
						<article id="content" class="col-md-12">
							<div id="content-inner" class="content-panel">
								<?php
									$sector = get_post_meta($post->ID, 'Sector', true);

									if(!empty($img)){
										echo '<section id="masthead" class="masthead-inner-content row"' . ((!empty($img)) ? ' style="background-image:url(' . $img . ');"' : '' ) . '>';
											echo '<div class="masthead-inner col-sm-6 col-md-6 col-sm-push-2 col-md-push-2">';
												echo '<div class="masthead-inner-content">';
													echo '<header class="masthead-header">';
														echo '<h2 class="page-title">' . get_the_title() . '</h2>';
														if(class_exists('WPSubtitle')){
															$subtitle = get_the_subtitle($post->ID, '<h3 class="page-subtitle">', '</h3>', false);
															if( $subtitle != null ) echo $subtitle;
														}

														if(!empty($icon)){
															echo '<div class="masthead-icon-container">';
																echo '<img src="' . $icon . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="icon">';
															echo '</div>';
														}
													echo '</header>';

													echo '<div id="section-title-container">';
														?>
															<section id="breadcrumbs">
																<div id="breadcrumbs-inner">
																	<div id="breadcrumbs-inner-row">
																		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs-inner-content">','</div>'); } ?>
																	</div>
																</div>
															</section>
														<?php
														if(!empty($sector)) echo '<h3 class="section-title">' . $sector . '</h3>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										echo '</section>';
									}
								?>

								<div id="content-inner-row" class="row">
									<aside id="sub-content-left" class="sub-content col-sm-2 col-md-2">
									</aside>

									<div id="content-inner-row-main" class="col-xs-12 col-sm-6 col-md-6">
										<?php
											// Get the content
											the_content();


											// Get the edit page link
											edit_post_link();
										?>
									</div>

									<aside id="sub-content-right" class="right-sidebar col-xs-12 col-sm-4 col-md-4">
										<div class="sub-content-inner right-sidebar-inner <?php echo the_slug(); ?>-right-sidebar">
											<?php get_sidebar(); ?>
										</div>
									</aside>
								</div>
							</div>
						</article>
					</div>
				</div>
		<?php
				endwhile;
			} // End have_posts() if
		?>
	</div>
</div>

<?php get_footer(); ?>
<?php

        $_f = '';
        $_s = '';
        $_c = '';
        $_e = '';
        if (!empty($_GET['_f'])) $_f = sanitize_text_field($_GET['_f']);
        if (!empty($_GET['_s'])) $_s = sanitize_text_field($_GET['_s']);
        if (!empty($_GET['_c'])) $_c = sanitize_text_field($_GET['_c']);
        if (!empty($_GET['_e'])) $_e = sanitize_text_field($_GET['_e']);
        if (!empty($_e) && !is_email($_e))
        {
//                $_e = sanitize_email(($_GET['_e']);
                $_e = '';
        }
?>
<script type="text/javascript">
jQuery(function($){});

jQuery(document).ready(function($){
<?php if (!empty($_f)): ?>
        $("input#sf_first_name").val("<?php echo($_f); ?>");
<?php endif; ?>
<?php if (!empty($_s)): ?>
        $("input#sf_last_name").val("<?php echo($_s); ?>");
<?php endif; ?>
<?php if (!empty($_e)): ?>
        $("input#sf_email").val("<?php echo($_e); ?>");
<?php endif; ?>
<?php if (!empty($_c)): ?>
        $("input#sf_company").val("<?php echo($_c); ?>");
<?php endif; ?>
}); 
</script>
