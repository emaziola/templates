<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage agile
 * @since Agile 1.0
 */
?>
		</main>
		<!-- End of <main> -->

		<footer id="footer" class="container-fluid">
			<?php
				$tax_args = array(
							'taxonomy' => 'footer-item-types',
							'field'    => 'slug',
							'terms'    => 'footer-banner'
						);

				$args = array(
							'post_type' => 'footer-item',
							'posts_per_page' => 1,
							'tax_query' => array( $tax_args )
						);

				$my_query = new WP_Query($args);

				if($my_query->have_posts()){
					echo '<div id="footer-banner" class="row">';
						while($my_query->have_posts()): $my_query->the_post();
							// The post background image
							$img = '';
							if(has_post_thumbnail()){
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
								$img = $img[0];
							}

							echo '<div id="footer-banner-inner" class="col-md-12"' . (!empty($img) ? ' style="background-image:url(' . $img . ')"' : '') . '>';
								echo '<div id="footer-banner-inner-content">';
									echo '<h3 class="footer-banner-title">' . get_the_title() . '</h3>';
									the_content();

									edit_post_link();
								echo '</div>';
							echo '</div>';
						endwhile;
					echo '</div>';
				}
			?>

			<?php 
				$args = array(
							'post_type' => 'partner',
							'posts_per_page' => -1,
							'order' => 'ASC',
							'orderby' => 'name'
						);

				$my_query = new WP_Query($args);

				if($my_query->have_posts()){
					echo '<div id="footer-partners" class="container-fluid">';
						echo '<div id="footer-partners-inner" class="row">';
							echo '<div id="footer-partners-inner-container" class="col-md-12">';
								while($my_query->have_posts()): $my_query->the_post();
									// The post background image
									$img = '';
									if(has_post_thumbnail()){
										$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
										$img = $img[0];
									}
									
									if(empty($img)){
										continue;
									}

									echo '<div id="' . $post->post_name . '-partner" class="footer-partner">';
										echo '<img src="' . $img . '" alt="' . $post->post_title . ' Logo" title="' . $post->post_title . '">';
									echo '</div>';
								endwhile;
							echo '</div>';
						echo '</div>';
					echo '</div>';

					wp_reset_query();
				}
			?>

			<div id="footer-inner" class="row">
				<div id="footer-logo" class="col-xs-12 col-sm-12 col-md-2">
					<a href="/" title="Agile Solutions">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 14.432" xml:space="preserve">
							<use xlink:href="#agi-logo-flat"></use>
						</svg>
					</a>
				</div>

				<div id="footer-nav" class="col-xs-12 col-sm-9 col-md-8">
					<nav id="footer-nav-container">
						<dl id="footer-nav-list">
							<dt class="sr-only">Footer Navigation</dt>

							<?php 
								$args = array(
											'sort_order' => 'ASC',
											'sort_column' => 'menu_order',
											'hierarchical' => 0,
											'exclude' => '',
											'include' => '',
											'meta_key' => '',
											'meta_value' => '',
											'authors' => '',
											'parent' => get_option('page_on_front'),
											'child_of' => '',
											'exclude_tree' => '',
											'number' => '',
											'offset' => 0,
											'post_type' => 'page',
											'post_status' => 'publish'
										);

								$pages = get_pages($args);
								$current_page = get_the_ID();

								// Output our pages
								foreach($pages as $p){
									$main_nav_parent = $p->ID;
									$redirect = get_post_meta($p->ID, 'redirect', true);
									$exclude = get_post_meta($p->ID, 'Exclude From Nav', true);
									if($exclude === 'Yes') continue;

									$args = array(
										'sort_order' => 'ASC',
										'sort_column' => 'menu_order',
										'hierarchical' => 0,
										'exclude' => '',
										'include' => '',
										'meta_key' => '',
										'meta_value' => '',
										'authors' => '',
										'parent' => $p->ID,
										'child_of' => $p->ID,
										'exclude_tree' => '',
										'number' => '',
										'offset' => 0,
										'post_type' => 'page',
										'post_status' => 'publish'
									);

									$pages_level_2 = get_pages($args);

									echo '<dd id="main-nav-' . $p->post_name . '" class="';
									// Continue adding classes
									echo 'page-' . $p->ID . ' ' . $p->post_name . ' menu-order-' . $p->menu_order . ' level-1' . (empty($pages_level_2) ? ' no-children' : '') . '">';
										echo '<a href="' . ((!empty($redirect)) ? $redirect : get_permalink($p->ID)) . '" title="' . $p->post_title . '" class="main-nav-anchor">';
											echo $p->post_title;
										echo '</a>';

										if(!empty($pages_level_2)){
											$counter_level_2 = 1;
											$pages_level_2_count = count($pages_level_2);

											foreach($pages_level_2 as $p2){
												$col_nav = get_post_meta($p2->ID, 'Column Sub-Nav', true);
												if($counter_level_2 === 1) echo '<dl class="subnav-list level-2' . (!empty($col_nav) ? ' col-nav' : '') . '">';
												$exclude_p2 = get_post_meta($p2->ID, 'Exclude From Nav', true);

												if($exclude_p2 != 'Yes'){ 

													$args = array(
														'sort_order' => 'ASC',
														'sort_column' => 'menu_order',
														'hierarchical' => 0,
														'exclude' => '',
														'include' => '',
														'meta_key' => '',
														'meta_value' => '',
														'authors' => '',
														'parent' => $p2->ID,
														'child_of' => $p2->ID,
														'exclude_tree' => '',
														'number' => '',
														'offset' => 0,
														'post_type' => 'page',
														'post_status' => 'publish'
													);

													$pages_level_3 = get_pages($args);

													echo '<dd id="main-nav-' . $p->post_name . '-child-' . $p2->post_name . '" class="subnav-list-item level-2' . ( !empty($pages_level_3) ? ' has-children' : '' ) . (!empty($col_nav) ? ' col-nav' : '') . '">';
														echo '<a href="' . get_permalink($p2->ID) . '" title="' . $p2->post_title . '">';
															echo $p2->post_title;
														echo '</a>';

/*
														if(!empty($pages_level_3)){
															echo '<dl class="subnav-list level-3">';
																foreach($pages_level_3 as $p3){
																	$exclude_p3 = get_post_meta($p3->ID, 'Exclude From Nav', true);
																	if($exclude_p3 === 'Yes'){ continue; }

																	echo '<dd id="main-nav-' . $p2->post_name . '-child-' . $p3->post_name . '" class="subnav-list-item level-3">';
																		echo '<a href="' . get_permalink($p3->ID) . '" title="' . $p3->post_title . '">';
																			echo $p3->post_title;
																		echo '</a>';
																	echo '</dd>';
																}
															echo '</dl>';
														}
*/
													echo '</dd>';
												}
												else{
													$pages_level_2_count--;
												}

												$counter_level_2++;
												if($counter_level_2 > $pages_level_2_count) echo '</dl>';
											}
										}
									echo '</dd>';
								}
							?>
						</dl>
					</nav>
				</div>

				<?php
					$tax_args = array(
								'taxonomy' => 'footer-item-types',
								'field'    => 'slug',
								'terms'    => 'footer-contact'
							);

					$args = array(
								'post_type' => 'footer-item',
								'posts_per_page' => 1,
								'tax_query' => array( $tax_args )
							);

					$my_query = new WP_Query($args);

					if($my_query->have_posts()){
						echo '<div id="footer-contact" class="col-xs-12 col-sm-3 col-md-2">';
							while($my_query->have_posts()): $my_query->the_post();
								echo '<h4 class="footer-title">' . get_the_title() . '</h4>';
								the_content();

								edit_post_link();
							endwhile;
						echo '</div>';
					}
				?>
			</div>

			<div id="back-to-top" class="footer-to-top">
				<a href="#" title="Back to Top">
					<span class="icon-container">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.576" xml:space="preserve">
							<use xlink:href="#agi-chevron-line-dbl-u"></use>
						</svg>
					</span>
					<span id="back-to-top-text" class="label">Top</span>
				</a>
			</div>
		</footer>
	</div> <!-- End of .container -->
	<?php wp_footer(); ?>

	<!-- Polyfill Scripts -->
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/respond.src.js"></script>

<script type="text/javascript">
  var _pt = ["E8337329-CFD4-493A-A2D4-A65C202BA179"];
  (function(d,t){
  var a=d.createElement(t),s=d.getElementsByTagName(t)[0];a.src=location.protocol+'//a1webstrategy.com/track.js';s.parentNode.insertBefore(a,s);
  }(document,'script'));
</script>

<!-- Google Tag Manager -->
<noscript>
  <iframe src="//www.googletagmanager.com/ns.html?id=GTM-K29LCP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

<script>
  (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-K29LCP');
</script>
<!-- End Google Tag Manager -->
</body>
</html>
