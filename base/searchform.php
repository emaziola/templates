<form id="header-search-form" class="search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<?php
		echo '<div id="pulldown-menu-nav-level-2-search-filters" class="col-sm-6 col-md-6">';
			$args = array(
						'hide_empty' => true,
						'parent' => get_cat_ID('filterable')
					);

			$cats = get_categories($args);
			$selected_cat = isset($_GET['cat']) ? $_GET['cat'] : -1;

			if(!empty($cats)){
				echo '<div id="search-listings-filters" class="row">';
					echo '<div id="search-listings-filters-inner" class="col-md-12">';
						echo '<ul id="search-listings-filters-form-list" class="row">';
							echo '<li id="search-listings-category-all" class="search-listings-category-item col-md-3' . ($selected_cat == -1 ? ' selected' : '') . '">';
								echo '<label for="search-listings-category-all-input">';
									echo '<input id="search-listings-category-all-input" type="radio" value="-1" name="cat"' . ($selected_cat == -1 ? ' checked' : '') . '>';
									echo 'All';
								echo '</label>';
							echo '</li>';

							foreach($cats as $cat){
								echo '<li id="search-listings-category-' . $cat->slug . '" class="search-listings-category-item col-md-3' . ($selected_cat == $cat->cat_ID ? ' selected' : '') . '">';
									echo '<label for="search-listings-category-' . $cat->slug . '-input">';
										echo '<input id="search-listings-category-' . $cat->slug . '-input" type="radio" value="' . $cat->cat_ID . '" name="cat"' . ($selected_cat == $cat->cat_ID ? ' checked' : '') . '>';
										echo $cat->name;
									echo '</label>';
								echo '</li>';
							}
						echo '</ul>';
						echo '<button id="search-listings-filters-submit" type="submit">Filter</button>';
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