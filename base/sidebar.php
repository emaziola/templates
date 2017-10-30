<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage agile
 * @since Agile 2.0
 */
?>
<div class="sub-content-inner subnav <?php echo the_slug(); ?>-subnav-list pages-list child-pages">
	<dl id="sub-content-social-list">
		<dt>Share:</dt>
		<?php /**/ ?>
		<dd id="sub-content-social-list-email">
			<!-- a href="<?php echo(get_permalink()); ?>emailpopup/" title="E-mail us via:" onclick="email_popup(this.href); return false;" -->
			<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>" title="Share via e-mail">
				<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 23.812" xml:space="preserve">
					<use xlink:href="#agi-envelope-o"></use>
				</svg>

				<span class="sr-only">E-mail</span>
			</a>
		</dd>
		<?php /**/ ?>
		<dd id="sub-content-social-list-twitter">
			<a href="https://twitter.com/home?status=<?php echo(urlencode(get_permalink())); ?>" title="Follow us on Twitter!">
				<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 26.006" xml:space="preserve">
					<use xlink:href="#agi-twitter-o"></use>
				</svg>

				<span class="sr-only">Twitter</span>
			</a>
		</dd>

		<dd id="sub-content-social-list-linkedin">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo(urlencode(get_permalink())); ?>&title=<?php echo(urlencode(get_the_title())); ?>" title="Follow us on LinkedIn!">
				<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 30.585" xml:space="preserve">
					<use xlink:href="#agi-linkedin-o"></use>
				</svg>

				<span class="sr-only">LinkedIn</span>
			</a>
		</dd>
		<?php /** ?>
		<dd id="sub-content-social-list-facebook">
			<a href="" title="Add us on Facebook!">
				<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17.826 32" xml:space="preserve">
					<use xlink:href="#agi-facebook-o"></use>
				</svg>

				<span class="sr-only">Facebook</span>
			</a>
		</dd>
		<?php **/ ?>
		<dd id="sub-content-social-list-google-plus">
			<a href="https://plus.google.com/share?url=<?php echo(urlencode(get_permalink())); ?>" title="Connect with us on Google Plus!">
				<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 31.998" xml:space="preserve">
					<use xlink:href="#agi-google-plus-o"></use>
				</svg>

				<span class="sr-only">Google Plus</span>
			</a>
		</dd>
	</dl>

	<?php
		$show_related_posts = get_post_meta(get_the_ID(), 'Show Related Posts Sidebar', true);

		if(class_exists('yuzo_related_post') && $show_related_posts === 'Yes'){
			$related = new yuzo_related_post();

			echo '<div id="related-content" class="yuzo-related-posts">';
				echo $related->create_post_related();
			echo '</div>';
		}
		else{
			?>
				<div id="sub-content-contact">
					<h3>Call us today on <br><a class="tel-link" href="tel:+441413329785" title="Call us today on 0141 332 9785!">0141 332 9785</a> <br>or</h3>
					<a href="/who-we-are/contact-us/" class="button">
						<span class="text">Contact Us</span>

						<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 23.812" xml:space="preserve">
							<use xlink:href="#agi-envelope-o"></use>
						</svg>
					</a>
				</div>

				<div class="sub-content-footer hidden-xs">
					<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 4.861" xml:space="preserve">
						<use xlink:href="#agi-sidebar-bottom"></use>
					</svg>
				</div>
			<?php
		}
	?>
</div>

<div class="sub-content-sidebar-user-content">
	<?php
		$sidebar_content = get_post_meta($post->ID, 'Sidebar Content', true);

		if(!empty($sidebar_content)){
			echo wpautop(apply_filters('the_content', $sidebar_content));
		}

	?>
</div>
