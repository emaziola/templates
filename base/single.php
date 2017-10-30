<?php
/**
 *
 * 
 * The template for displaying all posts
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

if($EM_Event){
	$start_date = $EM_Event->start;
	$end_date = $EM_Event->end;
}
?>
<div id="page-body" class="content-page<?php if(!empty($theme)) echo ' ' . $theme . '-theme'; if($EM_Event) echo ' single-event'; ?>">
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
					else{
						$img = get_stylesheet_directory_uri() . '/img/placeholder-masthead.jpg';
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
									$event_timeline_list_title = get_post_meta($post->ID, 'Milestones List Title');
									$event_timeline_milestones_times = get_post_meta($post->ID, 'Milestones Time List');
									$event_timeline_milestones_txt = get_post_meta($post->ID, 'Milestones List');
									$event_contact = get_post_meta($post->ID, 'Event Contact');
									$event_booking_url = get_post_meta($post->ID, 'Event Registration URL');
									if(!empty($event_booking_url)) $event_booking_url = $event_booking_url[0];

									// The post background image
									$img;
									$icon;
									$event_sidebar_img;
									if(has_post_thumbnail()){
										$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
										$img = $img[0];
									}

									if (class_exists('MultiPostThumbnails')) {
										$post_mh_alt = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'post-masthead-image', $post->ID);
									}

									if (class_exists('MultiPostThumbnails')) {
										$icon = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'masthead-icon-image', $post->ID);
										$event_sidebar_img = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'event-sidebar-image', $post->ID);
									}

									if(!empty($img) || !empty($post_mh_alt)){
										/* If a post masthead image (secondary) has been attached then use that instead for the masthead */
										if(!empty($post_mh_alt)) $img = $post_mh_alt;

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

								<div id="content-inner-row" class="row">
									<?php
										if($EM_Event == null && (get_post_type() !== 'event-booking')){
											echo '<aside id="sub-content-left" class="sub-content col-md-2">';
											echo '</aside>';
										}
									?>

									<div id="content-inner-row-main" class="col-xs-12 <?php echo (($EM_Event || get_post_type() === 'event-booking') ? 'col-sm-8 col-md-8' : 'col-sm-6 col-md-6' ); ?>">
										<?php
											if($EM_Event){
												echo '<dl class="event-listing-item-social-list social-list">
													<dt class="sr-only">Share this article:</dt>

													<dd class="social-listing-item-social-linkedin social-linkedin">
														<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . (urlencode(get_permalink())) . '&title=' . (urlencode(get_the_title())) . '" title="Share this event on LinkedIn!">
															<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 30.585" xml:space="preserve">
																<use xlink:href="#agi-linkedin-o"></use>
															</svg>
														</a>
													</dd>

													<dd class="social-listing-item-social-twitter social-twitter">
														<a href="https://twitter.com/home?status=' . (urlencode(get_permalink())) . '" title="Share this event on Twitter!">
															<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
																<use xlink:href="#agi-twitter-o"></use>
															</svg>
														</a>
													</dd>

													<dd class="social-listing-item-social-google-plus social-google-plus">
														<a href="https://plus.google.com/share?url=' . (urlencode(get_permalink())) . '" title="Share this event on Google Plus!">
															<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 18.396" xml:space="preserve">
																<use xlink:href="#agi-google-plus-new-o"></use>
															</svg>
														</a>
													</dd>

													<dd class="event-listing-item-social-pinterest social-pinterest">
														<a href="https://pinterest.com/pin/create/button/?url=' . (urlencode($thumb_src)) . '&media=' . (urlencode(get_the_title())) . '" title="Share this on Pinterest!">
															<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 25.54 32" xml:space="preserve">
																<use xlink:href="#agi-pinterest-o"></use>
															</svg>
														</a>
													</dd>

													<dd class="event-listing-item-social-email social-email">
														<a href="mailto:?subject=' . get_the_title() . '&amp;body=' . get_the_permalink() . '" title="Share this event via E-mail!">
															<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 23.812" xml:space="preserve">
																<use xlink:href="#agi-envelope-o"></use>
															</svg>
														</a>
													</dd>
												</dl>';
											}

											if(in_category('blog')){
												echo '<header class="post-item-header">';
													echo '<span class="post-item-meta">Posted ' . ((in_category(array('informatica', 'netezza', 'microstrategy' ))) ? '' : ' by ' . $author ) . ' on ' . get_the_time('l d F, H:i e', $post->ID) . '</span>';
												echo '</header>';
											}

											// Get the content
											the_content();

											// Get the edit page link
											edit_post_link();

											if(!empty($event_booking_url)) echo '<a href="' . $event_booking_url . '" title="Register Now" class="button event-registration-button">Register Now</a>';
										?>
									</div>

									<aside id="sub-content-right" class="right-sidebar col-xs-12 col-sm-4 col-md-4">
										<div class="sub-content-inner right-sidebar-inner <?php echo the_slug(); ?>-right-sidebar">
											<?php
												if(!$EM_Event){
													get_sidebar();
												}
												else if($EM_Event){
													echo '<div id="event-details">';
														echo '<h3 class="event-title sub-content-title">' . get_the_title() . '</h3>';

														echo '<div class="event-time-container">';
															echo '<h3 class="event-time-title">When</h3>';
															if($EM_Event->event_all_day == 1){
																echo '<span class="start-time">' . gmdate("d F Y" , $start_date) . '</span> to <span class="end-time">' . ( ( $EM_Event->event_start_date !== $EM_Event->event_end_date ) ? gmdate("d F Y" , $end_date) : substr($EM_Event->event_end_time, 0, 5) ) . ' (All day)</span>';
															}
															else{
																echo '<span class="start-time">' . gmdate("d F Y, H:i" , $start_date) . '</span> to <span class="end-time">' . ( ( $EM_Event->event_start_date !== $EM_Event->event_end_date ) ? gmdate("d F Y, H:i" , $end_date) : substr($EM_Event->event_end_time, 0, 5) ) . '</span>';
															}
														echo '</div>';

														if(!empty($event_sidebar_img)){
															echo '<div class="event-image-container">';
																echo '<img src="' . $event_sidebar_img . '" alt="' . get_the_title() . '" title="' . get_the_title() . '">';
															echo '</div>';
														}

														echo '<div class="event-location-container">';
															echo '<h3 class="event-location-title">Where</h3>';
															$loc = $EM_Event->get_location();
															$args = array('width'=> '100%', 'height' => '240px');
															$template = em_locate_template('placeholders/locationmap.php', true, array('args' => $args, 'EM_Location' => $loc));

															echo '<address class="event-location-address">';
																	echo ((!empty($EM_Event->location->location_name) ) ? $EM_Event->location->location_name . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_address) ) ? $EM_Event->location->location_address . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_town) ) ? $EM_Event->location->location_town . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_state) ) ? $EM_Event->location->location_state . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_postcode) ) ? $EM_Event->location->location_postcode . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_region) ) ? $EM_Event->location->location_region . '<br>' : '');
																	echo ((!empty($EM_Event->location->location_country) ) ? $EM_Event->location->location_country . '<br>' : '');
																echo '</address>';
														echo '</div>';

														echo '<div class="event-contact-container">';
															if(
																!empty($event_contact)
															){
																echo '<h3 class="event-contact-title">Event Contact</h3>';
																echo '<div class="event-contact-details">';
																	echo $event_contact[0];
																echo '</div>';
															}
														echo '</div>';
													echo '</div>';
												}
											?>
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