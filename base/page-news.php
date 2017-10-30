<?php
/**
 *
 * Template Name: News Listings Page
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
<div id="page-body" class="content-page news<?php if(!empty($theme)) echo ' ' . $theme . '-theme'; ?>">
	<div id="page-body-inner">
		<div id="content-container" <?php echo empty($img) ? ' class="no-masthead"' : ''; ?>>
			<div id="content-container-row" class="row">
				<article id="content" class="col-md-12">
					<div id="content-inner">
						<?php
							if(!empty($img)){
								echo '<section id="masthead" class="masthead-inner-content row"' . ((!empty($img)) ? ' style="background-image:url(' . $img . ');"' : '' ) . '>';
									echo '<div class="masthead-inner col-sm-6 col-md-6 col-sm-push-2 col-md-push-2">';
										echo '<div class="masthead-inner-content">';
											echo '<header class="masthead-header row-fluid">';
												echo '<h2 class="page-title col-xs-10">' . get_the_title() . '</h2>';
												if(class_exists('WPSubtitle')){
													$subtitle = get_the_subtitle($post->ID, '<h3 class="section-title hidden-xs">', '</h3>', false);
													if( $subtitle != null ) echo $subtitle;
												}

												if(!empty($icon)) echo '<div class="masthead-icon-container col-xs-2"><img src="' . $icon . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="icon"></div>';
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
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</section>';
							}
						?>
						<?php
							$args = array(
										'hide_empty' => true,
										'parent' => get_cat_ID('news')
									);

							$cats = get_categories($args);
							$selected_cat = isset($_GET['cat']) ? $_GET['cat'] : -1;

							echo '<div id="news-listings-filters" class="row">';
								if(!empty($cats)){
										echo '<div id="news-listings-filters-inner" class="col-sm-6 col-md-6 col-sm-push-2 col-md-push-2">';
											echo '<form id="news-listings-filters-form" method="get">';
												echo '<ul id="news-listings-filters-form-list" class="row">';
													foreach($cats as $cat){
														echo '<li id="news-listings-category-' . $cat->slug . '" class="news-listings-category-item col-sm-3 col-md-3' . ($selected_cat == $cat->cat_ID ? ' selected' : '') . '">';
															echo '<label for="news-listings-category-' . $cat->slug . '-input">';
																echo '<input id="news-listings-category-' . $cat->slug . '-input" type="radio" value="' . $cat->cat_ID . '" name="cat"' . ($selected_cat == $cat->cat_ID ? ' checked' : '') . '>';
																echo $cat->name;
															echo '</label>';
														echo '</li>';
													}
												echo '</ul>';
												echo '<button id="news-listings-filters-submit" type="submit">Filter</button>';
											echo '</form>';
										echo '</div>';
								}
							echo '</div>';
						?>

						<div id="content-inner-row" class="row">
							<div id="content-inner-row-main" class="col-sm-8 col-md-8">
								<?php
									$args = array(
												'category_name' => (($selected_cat != -1) ? get_category($selected_cat)->slug : 'news'),
												'posts_per_page' => 12,
												'order' => 'DESC',
												'orderby' => 'date',
                    							'paged' => $paged
											);

									$my_query = new WP_Query($args);

									if($my_query->have_posts()){
										echo '<ul id="news-listings" class="row">';
										while($my_query->have_posts()): $my_query->the_post();
											$author = get_the_author();
											$author_link = get_the_author_link();
											$cats = get_the_category();
											$cats_no = count($cats);
											$counter = 1;
											$date = get_the_date();
											$thumb_id = get_post_thumbnail_id();
											$thumb_src = wp_get_attachment_image_src($thumb_id, 'full');
											$thumb_src = $thumb_src[0];

											echo '<li id="news-listing-item-' . $post->ID . '" class="news-listing-item col-md-12">';
												echo '<div class="news-listing-item-inner row">';
													echo '<figure class="news-listing-item-image col-sm-3 col-md-3 hidden-xs">';
														if( $thumb_id != false ){
															echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
															echo '<img src="' . $thumb_src . '" class="news-entry-image image-wrap" alt="' . get_the_title() . '" title="' . get_the_title() . '">';
															echo '</a>';
														}
														else{
															echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
															echo '<img src="' . get_stylesheet_directory_uri() . '/img/placeholder.png" class="news-entry-image image-wrap" alt="' . get_the_title() . '" title="' . get_the_title() . '">';
															echo '</a>';
														}
													echo '</figure>';

													echo '<div class="news-listing-item-content col-sm-9 col-md-9">';
														echo '<header class="news-listing-item-header">';
															echo '<div class="news-listing-item-header-inner-top-row row">';
																echo '<h3 class="news-listing-item-title col-sm-8 col-md-8">';
																	echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
																echo '</h3>';
															?>
																<dl class="news-listing-item-social-list social-list col-md-4 hidden-xs">
																	<dt class="sr-only">Share this article:</dt>

																	<dd class="news-listing-item-social-linkedin social-linkedin">
																		<a href="https://www.linkedin.com/company/1277009" title="Connect with us on LinkedIn!" target="_blank">
																			<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 30.585" xml:space="preserve">
																				<use xlink:href="#agi-linkedin-o"></use>
																			</svg>
																		</a>
																	</dd>

																	<dd class="news-listing-item-social-twitter social-twitter">
																		<a href="https://twitter.com/AgileIM" title="Follow us on Twitter!" target="_blank">
																			<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
																				<use xlink:href="#agi-twitter-o"></use>
																			</svg>
																		</a>
																	</dd>

																	<dd class="news-listing-item-social-google-plus social-google-plus" target="_blank">
																		<a href="#" title="Add us on Google Plus!">
																			<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 18.396" xml:space="preserve">
																				<use xlink:href="#agi-google-plus-new-o"></use>
																			</svg>
																		</a>
																	</dd>

																	<dd class="news-listing-item-social-pinterest social-pinterest" target="_blank">
																		<a href="#" title="Add us on Pinterest!">
																			<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 25.54 32" xml:space="preserve">
																				<use xlink:href="#agi-pinterest-o"></use>
																			</svg>
																		</a>
																	</dd>

																	<?php
																		/*
																			<dd class="news-listing-item-social-email social-email">
																				<a href="#" title="Add us on E-mail!">
																					<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 23.812" xml:space="preserve">
																						<use xlink:href="#agi-envelope-o"></use>
																					</svg>
																				</a>
																			</dd>
																		*/
																	?>
																</dl>
															</div>
														<?php
															echo '<div class="news-listing-item-meta-row">';
																echo 'Posted in ';
																foreach($cats as $cat){
										                          echo '<a href="/category/news/' . $cat->slug . '" title="View ' . $cat->name . '">' . $cat->name . '</a>';

										                          if($counter < $cats_no){ echo ', '; }

										                          $counter++;
										                        }
										                        echo ' by ' . $author . ' on ' . $date;
															echo '</div>';
														echo '</header>';

														echo '<div class="news-listing-item-excerpt hidden-xs">';
															the_excerpt();

															edit_post_link();
														echo '</div>';

														echo '<footer class="news-listing-item-footer">';
									                        echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="button">';
									                        	echo 'Read more';
									                        echo '</a>';
														echo '</footer>';
													echo '</div>';
												echo '</div>';
											echo '</li>';
										endwhile;
										echo '</ul>';


										/* Pagination */
										$big = 999999999; // need an unlikely integer

										echo '<div class="pagination-row row">';
											echo '<nav class="pagination col-sm-8 col-md-8 col-sm-push-3 col-md-push-3">';
											  echo paginate_links(
											    array(
											      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
											      'format' => '?paged=%#%',
											      'current' => max( 1, get_query_var('paged') ),
											      'total' => $my_query->max_num_pages,
											      'prev_text' => '&lt; Previous',
											      'next_text' => 'Next &gt;'
											    ));
											echo '</nav>';
										echo '</div>';
									}
									else{
										echo '<p>There are currently no items to show.</p>';
									}
								?>
							</div>

							<aside id="sub-content-right" class="right-sidebar col-sm-4 col-md-4">
								<div class="sub-content-inner right-sidebar-inner <?php echo the_slug(); ?>-right-sidebar">
									<div class="twitter-feed">
										<?php
											$_path = get_template_directory() . '/twitter-feed-block.php';
											if (file_exists($_path)){
												include($_path);
											}
										?>
									</div>
								</div>
							</aside>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>