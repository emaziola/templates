<?php
/**
 * Template Name: Redirect
 */
if(($location = get_post_meta($post->ID, 'redirect', true)))
{
	header('Location: ' . $location);
}
?>
