<?php
/**
 *
 *
 * The 404 error page
 *
 *
 * @package WordPress
 * @subpackage agile
 * @since Agile 2.0
 *
 */

/* Seeing as this is a 404 we want to inform Agile that something may have gone awry so let's send them an e-mail! */
$site_name = get_bloginfo('name');
$site_url = get_bloginfo('url');

$admin_email = /* get_bloginfo('admin_email')*/ 'webmaster@agilesolutions.co.uk';
$subject = $site_name . ' (' . $site_url . ') - Error 404 Notification';
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

/* For the sake of security let's take out some global vars that don't need to be sent */
unset($_SERVER['SERVER_SOFTWARE']);
unset($_SERVER['HTTP_COOKIE']);
unset($_SERVER['PATH']);
unset($_SERVER['SERVER_SIGNATURE']);
unset($_SERVER['SERVER_ADMIN']);
unset($_SERVER['DOCUMENT_ROOT']);
unset($_SERVER['SCRIPT_FILENAME']);

$dbg_dat = "<hr><h3 style=\"font-family:helvetica, arial, sans-serif;\">Debug Information:</h3><pre>" . implode( "\n", array_map( function ($v, $k) { return sprintf("[%s] = '%s'", $k, $v); }, $_SERVER, array_keys($_SERVER) ) ) . "\n[HTTP_REFERRER] = " . (isset($_SERVER['HTTP_REFERRER']) ? $_SERVER['HTTP_REFERRER'] : 'Client did not set referrer URL.') . "</pre>";
$headers = array('From:noreply@' . $_SERVER['HTTP_HOST'], 'Content-Type: text/html; charset=UTF-8');

$msg = "<h1 style=\"font-family:helvetica, arial, sans-serif;\">Warning:</h1><p style=\"font-family:helvetica, arial, sans-serif;\">The URL <em><a href=\"http://' . $url . '\" title=\"View 404\">" . $url . "</a></em> returned an <a href=\"https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10.4.5\" title=\"404 Error Explanation\">HTTP 404 Error</a>.</p><p style=\"font-family:helvetica, arial, sans-serif;\">This may be worthy of further investigation. Please ensure that any panels and redirects are using valid URL's. It is also worth checking to see if the site structure has changed or files have been deleted recently that could explain this behaviour.</p><p style=\"font-family:helvetica, arial, sans-serif;\">If necessary you can <a href=\"" . $site_url . "\" title=\"Login to " . $site_name . "\">login here</a> to help diagnose the problem.</p>";
$msg .= $dbg_dat;

/* Send our e-mail! */
if( isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] != 'agile2.adama' || $_SERVER['HTTP_HOST'] != 'agile.becomeclients.com')) wp_mail( $admin_email, $subject, $msg, $headers );

get_header();
?>
<div id="page-body" class="error-404 content-page">
	<div id="page-body-inner">
		<div id="content-container" class="container">
			<div id="content-container-row" class="row">
				<article id="content" class="col-md-12">
					<h2>404</h2>
					<h3>We can't seem to find what you're looking for</h3>
					<p>It may have been deleted or moved, you should be able to find anything you need on the <a href="/" title="Back to the Home Page">homepage</a>.</p>
				</article>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
