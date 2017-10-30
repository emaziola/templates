<?php
/**
 * 
 * The template for displaying Search results
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage agile2
 * @since Agile 2.0
 *
 */

// Exclude header/footer elements from search
// Our excluded search categories

global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

if( strlen($query_string) > 0 ) {
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach
} //if

$search = new WP_Query($search_query);

get_header();

// This solution isn't exactly semantic but it's the best way to achieve the full-width background and position the page header in the desired way ?>
<div id="page-body" class="content-page search-page">
	<div id="page-body-inner">
		<div id="content-container">
			<div id="content-container-row" class="row">
				<aside id="sub-content-left" class="sub-content col-sm-2 col-md-2">
				</aside>

				<article id="content" class="col-sm-8 col-md-8">
					<div id="content-inner" class="content-panel">
						<h2 class="page-title search-title hidden-xs">Results</h2>
						<?php
							if(have_posts()){
								global $wp_query;
								$selected_cat = isset($_GET['cat']) ? $_GET['cat'] : -1;
								echo '<dl id="search-results">';
									echo '<dt id="search-results-title">Found ' . $wp_query->found_posts . ' results for &quot;<em>' . get_search_query() . '</em>&quot;' . (($selected_cat != -1) ? ' in <em>&quot;' . get_category($selected_cat)->name . '&quot;</em>' : '') . ':</dt>';
									while ( have_posts() ) : the_post();
										$author = get_the_author();
										$author_link = get_the_author_link();
										$cats = get_the_category();
										$cats_no = count($cats);
										$counter = 1;
										$date = get_the_date();

										echo '<dd class="search-result result post-' . get_the_ID() . ' ' . the_slug();
										// Output the categories
										foreach($cats as $c){ echo ' category-' . get_category($c)->slug; }
										echo '">';
											// Get the post title
											echo '<h4 class="search-result-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';

											echo '<footer class="search-result-item-meta">';
												echo '<span class="meta">';
													echo 'Posted in ';
													foreach($cats as $cat){
							                          echo '<a href="/category/blog/' . $cat->slug . '" title="View ' . $cat->name . '">' . $cat->name . '</a>';

							                          if($counter < $cats_no){ echo ', '; }

							                          $counter++;
							                        }
							                        echo ' by ' . $author . ' on ' . $date;
						                        echo '</span>';

						                        echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="button">';
						                        	echo 'Read more';
						                        echo '</a>';
											echo '</footer>';

											// Get the edit page link
											edit_post_link();
										echo '</dd>';
									endwhile;
								echo '</dl>';
							} // End have_posts() if

							$args = array(
								'base'               => '%_%',
								'format'             => '?paged=%#%',
								'total'              => 1,
								'current'            => 0,
								'show_all'           => false,
								'end_size'           => 1,
								'mid_size'           => 2,
								'prev_next'          => true,
								'prev_text'          => __('« Previous'),
								'next_text'          => __('Next »'),
								'type'               => 'plain',
								'add_args'           => false,
								'add_fragment'       => '',
								'before_page_number' => '',
								'after_page_number'  => ''
							);

							echo paginate_links($args);
						?>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
