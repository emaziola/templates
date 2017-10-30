<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage agile
 * @since Agile 2.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8) & !(IE 9)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php wp_title( '|', true, 'right' ); ?> <?php echo bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- Scripts -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.0.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/plugins.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/main.js"></script>

	<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css">

	<!--[if lt IE 10]>
	<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/ie.css">
	<![endif]-->

	<!--[if IE 10]>
	<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/ie.css">
	<![endif]-->

	<!--[if IE 11]>
	<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/ie11.css">
	<![endif]-->

	<!--[if gte IE 9]>
	  <style type="text/css">
	    .gradient {
	       filter: none;
	    }
	  </style>
	<![endif]-->

	<?php wp_head(); ?>


	<!-- SVG Navigation Sprites -->
	<script type="text/javascript">
		if(Modernizr.svg == true){
			$(document).ready( function(){
				var ajax = new XMLHttpRequest();
				ajax.open("GET", "<?php echo get_stylesheet_directory_uri(); ?>/img/svg-icons.svg", true);
				ajax.send();
				ajax.onload = function(e) {
				  var div = document.createElement("div");
				  div.innerHTML = ajax.responseText;
				  document.body.insertBefore(div, document.body.childNodes[0]);
				  div.style.display = 'none';
				}
			});
		}
	</script>

	<script type="text/javascript">
	(function() {
	  var didInit = false;
	  function initMunchkin() {
	    if(didInit === false) {
	      didInit = true;
	      Munchkin.init('876-GCW-609');
	    }
	  }
	  var s = document.createElement('script');
	  s.type = 'text/javascript';
	  s.async = true;
	  s.src = '//munchkin.marketo.net/munchkin.js';
	  s.onreadystatechange = function() {
	    if (this.readyState == 'complete' || this.readyState == 'loaded') {
	      initMunchkin();
	    }
	  };
	  s.onload = initMunchkin;
	  document.getElementsByTagName('head')[0].appendChild(s);
	})();
	</script>

</head>
<body <?php body_class(); ?>>
<div id="container" class="container-fluid">
	<header id="header" class="container-fluid">
		<div id="cookies-notice" class="container-fluid">
			<div id="cookies-notice-inner" class="row">
				<div id="cookies-notice-inner-content" class="col-md-12">
					<p>We use cookies to ensure that we give you the best experience on our website. By using our website without changing your settings, you agree that you are happy to receive all cookies.</p>

					<button id="cookies-notice-button">
						I agree
					</button>
				</div>
			</div>
		</div>

		<div id="header-inner" class="row">
			<div id="header-logo">
				<h1>
					<!-- Desktop logo -->
					<a href="/" title="Agile Solutions">
						<?php /* <img id="desktop-logo" class="hidden-xs" src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-desktop.png" alt="Glasgow Prestwick Airport" title="Glasgow Prestwick Airport"> */ ?>

						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 14.432" xml:space="preserve">
							<use xlink:href="#agi-logo"></use>
						</svg>

						<span class="sr-only">Agile Solutions</span>
					</a>

					<?php
						/*
						<!-- Logo for retina displays -->
						<a href="/" title="Glasgow Prestwick Airport">
							<img id="retina-logo" class="visible-xs" src="<?php echo get_stylesheet_directory_uri() ?>/img/logo-retina-@1.5x.png" alt="Glasgow Prestwick Airport" title="Glasgow Prestwick Airport">

							<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
								<use xlink:href="#agi-logo" />
							</svg>
						</a>
						*/
					?>
				</h1>
			</div>

			<div id="header-contact" class="hidden-xs">
				<ul id="header-contact-list">
					<li id="header-contact-list-sales">
						<a href="/who-we-are/contact-us/" title="Contact Us">
							Contact Us
						</a>
					</li>

					<li id="header-contact-list-contact-tel">
						<a href="tel:+441413329785" title="Call us via: 0141 332 9785">
							<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
								<use xlink:href="#agi-phone-o" class="white"></use>
							</svg>

							<span class="text">0141 332 9785</span>
						</a>
					</li>
				</ul>
			</div>

			<div id="main-nav-wrap" class="hidden-xs">
				<nav id="main-nav">
					<ul id="main-nav-list">
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
								$main_nav_content_block = get_post_meta($p->ID, 'Main Nav Content Block', true);

								/* Get mega-dropdown if there's child pages */
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

								echo '<li id="main-nav-' . $p->post_name . '" class="';
								// Continue adding classes
								echo 'page-' . $p->ID . ' ' . $p->post_name . ' menu-order-' . $p->menu_order . ' main-nav-item level-1">';
									echo '<a href="' . ((!empty($redirect)) ? $redirect : get_permalink($p->ID)) . '" title="' . $p->post_title . '" class="main-nav-anchor">';
										echo $p->post_title;

										echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 16" xml:space="preserve">';
											echo '<use xlink:href="#agi-caret-down" class="main-nav-caret-level-1"></use>';
										echo '</svg>';

										if(!empty($pages_level_2)){
											echo '<svg class="has-children icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 16" xml:space="preserve">';
												echo '<use xlink:href="#agi-caret-up" class="main-nav-caret-level-1"></use>';
											echo '</svg>';
										}
									echo '</a>';

									/* If there's a second-level then let's get it! */
									if(!empty($pages_level_2)){
										echo '<div id="main-nav-' . $p->post_name . '-dropdown" class="mega-dropdown-menu mega-dropdown">';
											echo '<div id="main-nav-' . $p->post_name . '-dropdown-inner" class="mega-dropdown-menu-inner dropdown-menu-inner">';
												echo '<div id="main-nav-' . $p->post_name . '-dropdown-inner-container" class="container-fluid">';
													echo '<div id="main-nav-' . $p->post_name . '-dropdown-inner-row" class="mega-dropdown-menu-inner-row row">';
														if(!empty($main_nav_content_block)){
															echo '<div id="main-nav-' . $p->post_name . '-content-block" class="main-nav-content-block content-block main-nav-block col-xs-12 col-sm-3 col-md-3">';
																echo '<h3 id="main-nav-' . $p->post_name . '-content-block-title" class="main-nav-content-block-title content-block-title mega-dropdown-menu-title">';
																	echo '<a href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '">';
																		echo $p->post_title;
																	echo '</a>';
																echo '</h3>';

																echo '<div id="main-nav-' . $p->post_name . '-content-block-content" class="main-nav-content-block-content content-block-content">';
																	echo wpautop($main_nav_content_block);

																	edit_post_link('Edit This', '', '', $p->ID);
																echo '</div>';
															echo '</div>';
														}

														/* Encapsulate our blocks into rows */
														$pages_level_2_count = count($pages_level_2);
														$counter = 1;
														$loop = 1;
														$limit = !empty($main_nav_content_block) ? 3 : 4;

														echo '<div id="main-nav-' . $p->post_name . '-nav-blocks" class="main-nav-blocks ' . (!empty($main_nav_content_block) ? 'col-xs-12 col-sm-9 col-md-9' : 'col-xs-12 col-sm-12 col-md-12') . '">';
															foreach($pages_level_2 as $p2){
																$redirect = get_post_meta($p2->ID, 'redirect', true);
																$exclude_p2 = get_post_meta($p2->ID, 'Exclude From Nav', true);

																if($exclude_p2 != 'Yes'){
																	if($counter === 1) echo '<div id="main-nav-' . $p->post_name . '-nav-blocks-inner-row" class="main-nav-blocks-inner-row row">';
																	echo '<div id="main-nav-' . $p2->post_name . '-nav-block" class="main-nav-block nav-block col-xs-12 col-sm-3 col-md-3">';
																		echo '<dl id="main-nav-' . $p2->post_name . '-nav-block-list" class="main-nav-block-list nav-block-list">';
																			echo '<dt id="main-nav-block-' . $p2->post_name . '-nav-block-title" class="main-nav-block-title nav-block-title">';
																				echo '<a href="' . (!empty($redirect) ? $redirect : get_permalink($p2->ID) ) . '" title="' . $p2->post_title . '">';
																					echo $p2->post_title;
																				echo '</a>';
																			echo '</dt>';

																			/* Get third-level pages */
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

																			if(!empty($pages_level_3)){
																				foreach($pages_level_3 as $p3){
																					$redirect = get_post_meta($p3->ID, 'redirect', true);
																					$exclude_p3 = get_post_meta($p3->ID, 'Exclude From Nav', true);
																					if($exclude_p3 === 'Yes'){ continue; }

																					echo '<dd id="main-nav-' . $p3->post_name . '-block-item" class="main-nav-block-item nav-block-item">';
																						echo '<a href="' . (!empty($redirect) ? $redirect : get_permalink($p3->ID) ) . '" title="' . $p3->post_title . '">';
																							echo $p3->post_title;
																						echo '</a>';
																					echo '</dd>';
																				}
																			}
																		echo '</dl>';
																	echo '</div>';
																}
																else{
																	$pages_level_2_count--;
																}

																if(
																	$counter === 3 &&  !empty($main_nav_content_block) || 
																	$counter === 4 && empty($main_nav_content_block) ||
																	$counter === $pages_level_2_count 
																){ 
																	echo '</div><!-- .end of .main-nav-blocks-inner-row counter:' . $counter . 'content_block:' . !empty($main_nav_content_block) . ' ' . ' -->'; // End of .main-nav-blocks-inner-row
																	$counter = 1;
																} 
																else { 
																	$counter++;
																	$loop++;
																}
															}
														if(!empty($main_nav_content_block)) echo '</div>';
													echo '</div>';
												echo '</div>';

												echo '<button id="main-nav-' . $p->post_name . '-dropdown-close-button" class="mega-dropdown-close-button">';
													echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 16" xml:space="preserve">';
														echo '<use xlink:href="#agi-chevron-line-d"></use>';
													echo '</svg>';
												echo '</button>';
											echo '</div>';
										echo '</div>';
									}
								echo '</li>';
							}
						?>
					</ul>
				</nav>
			</div>

			<ul id="header-support-list" class="hidden-xs">
				<li id="header-support-list-linkedin">
					<a href="https://www.linkedin.com/company/1277009" title="Connect with us on LinkedIn!" target="_blank">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 30.585" xml:space="preserve">
							<use xlink:href="#agi-linkedin-o" class="white"></use>
						</svg>

						<span class="sr-only">LinkedIn</span>
					</a>
				</li>

				<li id="header-support-list-twitter">
					<a href="https://twitter.com/AgileIM" title="Follow us on Twitter!" target="_blank">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
							<use xlink:href="#agi-twitter-o" class="white"></use>
						</svg>

						<span class="sr-only">Twitter</span>
					</a>
				</li>

				<li id="header-support-list-envelope">
					<a href="mailto:info@agilesolutions.co.uk" title="E-mail us">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 23.812" xml:space="preserve">
							<use xlink:href="#agi-envelope-o" class="white"></use>
						</svg>

						<span class="sr-only">E-mail us</span>
					</a>
				</li>

				<li id="header-support-list-search">
					<a href="#" title="Search" id="header-search-anchor" class="header-search-anchor">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 31 32" xml:space="preserve">
							<use xlink:href="#agi-search-o" class="white"></use>
						</svg>

						<span class="sr-only">Search</span>
					</a>
				</li>
			</ul>

			<div id="mobile-nav-button-wrap" class="visible-xs hidden-md hidden-lg mobile-button">
				<div id="mobile-nav-button">
					<a href="#" title="Click here to show the mobile navigation" id="mobile-nav-button-anchor" class="menu mobile-nav-menu">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 28.275" xml:space="preserve">
							<use xlink:href="#agi-navicon-o"></use>
						</svg>

						<span class="sr-only">Menu</span>
					</a>
				</div>
			</div>
		</div>

		<div id="mobile-nav-active-overlay"></div>

		<section id="main-nav-pulldown-menus">
			<div id="main-nav-pulldown-menus-inner" class="container-fluid">
				<div id="main-nav-pulldown-menus-row" class="row-fluid">
					<?php
						$args = array(
									'sort_order' => 'ASC',
									'sort_column' => 'menu_order',
									'hierarchical' => 1,
									'exclude' => '',
									'include' => '',
									'meta_key' => '',
									'meta_value' => '',
									'authors' => '',
									'exclude_tree' => '',
									'number' => '',
									'offset' => 0,
									'parent' => get_option('page_on_front'),
									'child_of' => '',
									'post_type' => 'page',
									'post_status' => 'publish'
								);

						$pages = get_pages($args);

						// Our counter variable to add new rows for our child-page blocks where applicable
						$blocks_per_row = 1;

						// Output our top-level pages and their second-level children
						foreach($pages as $p){
							// Child page query arguments - 2nd level down pages
							$args = array(
											'post_parent' => $p->ID,
											'post_type'   => 'page', 
											'posts_per_page' => -1,
											'post_status' => 'publish',
											'order' => 'ASC',
											'orderby' => 'menu_order'
									);

							// Get the child pages of this 2nd level page
							$pages_level_2 = get_children($args);

							// The amount of list blocks and a counter to keep track of them
							$total_blocks = count($pages_level_2);

							// MOVE THIS TO WHERE THE SECOND LEVEL OUTPUTS ITS <dd>
							$total_block_count = 1;
							$redirect_p1 = get_post_meta($p->ID, 'redirect', true);

							echo '<div id="' . $p->post_name . '-pulldown-menu" class="pulldown-menu">';
								echo '<div id="' . $p->post_name . '-pulldown-menu-inner' . '" class="pulldown-menu-inner col-xs-12 col-sm-12 col-md-12">';
									echo '<div class="pulldown-menu-inner-row pulldown-parent-page-header-row row-fluid">';
										echo '<h3 class="pulldown-parent-page-header ' . $p->post_name . '-pulldown-header' . '">';
											echo '<a href="' . (($redirect_p1) ? $redirect_p1 : get_permalink($p->ID)) . '" title="' . $p->post_title . '" class="mobile-nav-top-header">';
												echo $p->post_title;
												if(!empty($pages_level_2)) echo '<svg class="icon svg-canvas dropdown-status-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 19.674" xml:space="preserve"><use xlink:href="#agi-caret-down" class="pulldown-nav-mobile-icon"></use></svg>';
											echo '</a>';
										echo '</h3>';
									echo '</div>';

									/* This is here because the mobile navigation needs the above header to work, otherwise we will have to have two blocks of markup with long lists - that would be bad! */
									if($total_blocks != 0){
										// The variable to acknowledge whether this is the first iteration of the loop or not
										$first = true;

										foreach($pages_level_2 as $p2){
											$redirect = get_post_meta($p2->ID, 'redirect', true);

											// Start our row
											if($blocks_per_row == 1){
												echo '<div class="pulldown-menu-inner-row pulldown-menu-inner-subnav-row row">';
											}

											if($first === true && $redirect != '#'){
												echo '<h4 class="' . $p->post_name . '-mobile-top-level-header mobile-top-level-header visible-xs hidden-sm hidden-md hidden-lg"><a href="' . (($redirect_p1) ? $redirect_p1 : get_permalink($p->ID)) . '" title="' . $p->post_title . '" class="' . $p->post_name . '-mobile-top-level-link mobile-top-level-link">View ' . $p->post_title . ' page</a></h4>';
											}

											// Like Highlander there can only be one :)
											$first = false;

											echo '<div id="pulldown-menu-nav-level-2-' . $p2->post_name . '" class="pulldown-menu-nav-level-2 col-xs-12 col-sm-12 col-md-3">';
												echo '<dl class="pulldown-menu-nav-level-2-list">';
													echo '<dt class="pulldown-menu-nav-level-2-header"><a href="' . (($redirect) ? $redirect : get_permalink($p2->ID)) . '" title="' . $p2->post_title . '">' . $p2->post_title . '</a></dt>';

													// Child page query arguments - 3rd level down pages
													$args = array(
																	'post_parent' => $p2->ID,
																	'post_type'   => 'page', 
																	'posts_per_page' => -1,
																	'post_status' => 'publish',
																	'order' => 'ASC',
																	'orderby' => 'menu_order',
																	'parent' => 0
															);

													// Get the child pages of this 2nd level page
													$pages_level_3 = get_posts($args);

													if($pages_level_3){
														foreach($pages_level_3 as $p3){
															$redirect = get_post_meta($p3->ID, 'redirect', true);

															echo '<dd><a href="' . (($redirect) ? $redirect : get_permalink($p3->ID)) . '" title="' . $p3->post_title . '">' . $p3->post_title . '</a></dd>';
														}
													}
													else{
														echo '<dd class="no-children sr-only">No children</dd>';
													}

												echo '</dl>';
											echo '</div>';

											// If we have output 4 list blocks OR the total number of blocks is less than 4 then start a new row, if not then update the total number of list blocks
											if($blocks_per_row == 4 || $total_block_count == $total_blocks){
												echo '</div>'; // END OF .pulldown-menu-inner-row

												$blocks_per_row = 1;
											}
											else{
												$blocks_per_row++;
											}

											// Add to the total number of blocks output
											$total_block_count++;
										}
									}
								echo '</div>';
							echo '</div>';
						}

						/* The search pulldown menu */
						echo '<div id="search-pulldown-menu" class="pulldown-menu">';
							echo '<div id="search-pulldown-menu-inner" class="pulldown-menu-inner col-xs-12 col-sm-12 col-md-12">';
								if(is_search()){
									echo '<header id="search-header" class="col-md-12">';
										?>
											<section id="breadcrumbs">
												<div id="breadcrumbs-inner">
													<div id="breadcrumbs-inner-row">
														<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs-inner-content">','</div>'); } ?>
													</div>
												</div>
											</section>
										<?php
										echo '<h2 class="page-title">Search</h2>';
									echo '</header>';
								}

								echo '<div class="pulldown-menu-inner-row pulldown-parent-page-header-row row-fluid">';
									get_search_form();
								echo '</div>';
							echo '</div>';
						echo '</div>';
					?>
				</div>
			</div>
		</section>

		<div id="header-dropdown-search" class="hidden-xs">
			<form id="header-dropdown-search-form" class="search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
				<?php
					echo '<div id="pulldown-menu-nav-level-2-search-filters" class="col-sm-6 col-md-8">';
						$args = array(
									'hide_empty' => true,
									'parent' => get_cat_ID('filterable')
								);

						$cats = get_categories($args);
						$selected_cat = isset($_GET['cat']) ? $_GET['cat'] : -1;

						if(!empty($cats)){
							echo '<div id="header-dropdown-search-listings-filters" class="row">';
								echo '<div id="header-dropdown-search-listings-filters-inner" class="col-md-12">';
									echo '<ul id="header-dropdown-search-listings-filters-form-list" class="row">';
										echo '<li id="header-dropdown-search-listings-category-all" class="search-listings-category-item col-md-3' . ($selected_cat == -1 ? ' selected' : '') . '">';
											echo '<label for="header-dropdown-search-listings-category-all-input">';
												echo '<input id="header-dropdown-search-listings-category-all-input" type="radio" value="-1" name="cat"' . ($selected_cat == -1 ? ' checked' : '') . '>';
												echo 'All';
											echo '</label>';
										echo '</li>';

										foreach($cats as $cat){
											echo '<li id="header-dropdown-search-listings-category-' . $cat->slug . '" class="search-listings-category-item col-md-3' . ($selected_cat == $cat->cat_ID ? ' selected' : '') . '">';
												echo '<label for="header-dropdown-search-listings-category-' . $cat->slug . '-input">';
													echo '<input id="header-dropdown-search-listings-category-' . $cat->slug . '-input" type="radio" value="' . $cat->cat_ID . '" name="cat"' . ($selected_cat == $cat->cat_ID ? ' checked' : '') . '>';
													echo $cat->name;
												echo '</label>';
											echo '</li>';
										}
									echo '</ul>';
									echo '<button id="header-dropdown-search-listings-filters-submit" type="submit">Filter</button>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				?>

				<div id="pulldown-menu-nav-level-2-search" class="col-sm-4 col-md-4">
					<label for="s" class="sr-only">
						<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
					</label>
					<input id="header-search-input" class="search-field" type="search" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
					<button type="submit" title="Click here to search the Agile site" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>">
						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 31 32" xml:space="preserve">
							<use xlink:href="#agi-search-o"></use>
						</svg>
					</button>
				</div>
			</form>
		</div>	
	</header>
	<!-- End of <header> -->

	<main id="surround" role="main">
