<?php /**
 * Paterson's functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage prestwick
 * @since Prestwick 1.0
 */

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
  // Add new "Courses" taxonomy to Posts
  register_taxonomy('home-panel-types', 'home-panel', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Home Panel Types', 'taxonomy general name' ),
      'singular_name' => _x( 'Home Panel Type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search by Home Panel Type' ),
      'all_items' => __( 'All Home Panel Types' ),
      'parent_item' => __( 'Parent Item' ),
      'parent_item_colon' => __( 'Parent Item:' ),
      'edit_item' => __( 'Edit Home Panel Type' ),
      'update_item' => __( 'Update Home Panel Type' ),
      'add_new_item' => __( 'Add New Home Panel Type' ),
      'new_item_name' => __( 'New Home Panel Type' ),
      'menu_name' => __( 'Home Panel Types' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'home-panel-types', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );


function home_masthead_init() {
    $args = array(
        'label' => 'Home Masthead Items',
      'labels' => array(
        'name' => __('Home Masthead Items'),
        'singular_name' => __('Home Masthead Item'),
        'add_new_item' => __('Add New Home Masthead Item'),
        'edit_item' => __('Edit Home Masthead Item'),
      'menu_name'          => __('Home Masthead Items'),
      'name_admin_bar'     => __('Home Masthead Item'),
      'add_new'            => __('Add New'),
      'add_new_item'       => __('Add New Home Masthead Item'),
      'new_item'           => __('New Home Masthead Item'),
      'edit_item'          => __('Edit Home Masthead Item'),
      'view_item'          => __('View Home Masthead Item'),
      'all_items'          => __('All Home Masthead Items'),
      'search_items'       => __('Search Home Masthead Items:'),
      'parent_item_colon'  => __('Parent Home Masthead Item:'),
      'not_found'          => __('No home masthead items found.'),
      'not_found_in_trash' => __('No home masthead items found in Trash.')
      ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'home-masthead'),
        'query_var' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
    ),
    'taxonomies' => array(),
    );
    register_post_type( 'home-masthead', $args );
}
add_action( 'init', 'home_masthead_init' );

function home_panels_init() {
    $args = array(
        'label' => 'Home Panels',
      'labels' => array(
        'name' => __('Home Panels'),
        'singular_name' => __('Home Panel'),
        'add_new_item' => __('Add New Home Panel'),
        'edit_item' => __('Edit Home Panel'),
      'menu_name'          => __('Home Panels'),
      'name_admin_bar'     => __('Home Panel'),
      'add_new'            => __('Add New'),
      'add_new_item'       => __('Add New Home Panel'),
      'new_item'           => __('New Home Panel'),
      'edit_item'          => __('Edit Home Panel'),
      'view_item'          => __('View Home Panel'),
      'all_items'          => __('All Home Panels'),
      'search_items'       => __('Search Home Panels:'),
      'parent_item_colon'  => __('Parent Home Panel:'),
      'not_found'          => __('No home panels found.'),
      'not_found_in_trash' => __('No home panels found in Trash.')
      ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'home-panels'),
        'query_var' => true,
        'menu_icon' => 'dashicons-editor-table',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
    ),
    'taxonomies' => array('home-panel-types'),
    );
    register_post_type( 'home-panel', $args );
}
add_action( 'init', 'home_panels_init' );

function footer_init() {
    $args = array(
        'label' => 'Footer Items',
      'labels' => array(
        'name' => __('Footer Items'),
        'singular_name' => __('Footer Item'),
        'add_new_item' => __('Add New Footer Item'),
        'edit_item' => __('Edit Footer Item'),
      'menu_name'          => __('Footer Items'),
      'name_admin_bar'     => __('Footer Item'),
      'add_new'            => __('Add New'),
      'add_new_item'       => __('Add New Footer Item'),
      'new_item'           => __('New Footer Item'),
      'edit_item'          => __('Edit Footer Item'),
      'view_item'          => __('View Footer Item'),
      'all_items'          => __('All Footer Items'),
      'search_items'       => __('Search Footer Items:'),
      'parent_item_colon'  => __('Parent Footer Item:'),
      'not_found'          => __('No footer items found.'),
      'not_found_in_trash' => __('No footer items found in Trash.')
      ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'footer-items'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',
    ),
    'taxonomies' => array('footer-item-types'),
    );
    register_post_type( 'footer-item', $args );
}
add_action( 'init', 'footer_init' );

/* Add featured image support */
add_theme_support( 'post-thumbnails' );

/* Multiple Featured Image Support */
if (class_exists('MultiPostThumbnails')) {
  new MultiPostThumbnails(
      array(
          'label' => 'Post Masthead Image',
          'id' => 'post-masthead-image',
          'post_type' => 'post'
      )
  );

  new MultiPostThumbnails(
    array(
      'label' => 'Masthead Icon Image',
      'id' => 'masthead-icon-image',
      'post_type' => 'page'
    )
  );
}

function the_slug() {
  // The slug of the current page or post
  global $post;
  $slug = '';
  if (is_object($post))
  {
    $slug = $post->post_name;
  }
    return $slug; 
}

function content_after_attach() {
  /*This function was made for usage when there is an attachment loop on the page before the content. (I.E - A page with a slideshow)
  * as it stands the usual wordpress functions will simply return the image because the loop sees get_the_content() and the_content()
  * as the content of the attachment. Simply declare the variable "$content_after_attach = content_after_attach();" at the start of
  * your post while loop and echo out $content_after_attach where needed. */
  
  /* Gets the content as a string */
  $content = get_the_content();
  
  /* Formats this string and returns it for output. These are the same filters used by Wordpress itself for the_content() */
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);  
  $content = str_replace("\r", "<br />", $content);
  return $content;                
}

function limit_words($string, $word_limit){
    $words = explode(" ", $string);
    $words = implode(" ", array_splice($words, 0, $word_limit));

    if(strlen($words) != 0){
      return $words . '...';
    }
}

function excerpt_after_attach() {
  /*This function was made for usage when there is an attachment loop on the page before the content. (I.E - A page with a slideshow)
  * as it stands the usual wordpress functions will simply return the image because the loop sees get_the_excerpt() and the_excerpt()
  * as the content of the attachment. Simply declare the variable "$excerpt_after_attach = excerpt_after_attach();" at the start of
  * your post while loop and echo out $content_after_attach where needed. */
  
  /* Gets the content as a string */
  $excerpt = get_the_excerpt();
  $allowed_tags = '<a>,<p>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<strong>,<em>,<ul>,<ol>,<li>,<dl>,<dt>,<dd><br>';
  
  /* Formats this string and returns it for output. These are the same filters used by Wordpress itself for the_content() */
  $excerpt = apply_filters('the_excerpt', $excerpt);
  $excerpt = str_replace(']]>', ']]&gt;', $excerpt);  
  $excerpt = str_replace("\r", "<br />", $excerpt);
  $excerpt = strip_tags($excerpt, $allowed_tags);
  return $excerpt;                
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
  return '<a class="moretag" href="'. get_permalink($post->ID) . '">Read more...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* Make our generic posts sortable */
add_post_type_support( 'post', 'page-attributes' );

/**
* Twitter-API-PHP : Simple PHP wrapper for the v1.1 API
*
* PHP version 5.3.10
*
* @category Awesomeness
* @package  Twitter-API-PHP
* @author   James Mallison <me@j7mbo.co.uk> / Any edits will be done by Ross Hendry at Become Interactive
* @license  MIT License
* @link   http://github.com/j7mbo/twitter-api-php
**/
class TwitterAPIExchange {
  private $oauth_access_token;
  private $oauth_access_token_secret;
  private $consumer_key;
  private $consumer_secret;
  private $postfields;
  private $getfield;
  protected $oauth;
  public $url;

  /**
  * Create the API access object. Requires an array of settings::
  * oauth access token, oauth access token secret, consumer key and consumer secret.
  * These are all available via the Twitter Account's application on dev.twitter.com
  * Requires the cURL library
  *
  * @param array $settings
  **/
  public function __construct(array $settings){
    if(!in_array('curl', get_loaded_extensions())){
      throw new Exception('You need to install cUrl, see: http://curl.haxx.se/docs/install.html');
    }

    if(!isset($settings['oauth_access_token'])
      || !isset($settings['oauth_access_token_secret'])
      || !isset($settings['consumer_key'])
      || !isset($settings['consumer_secret']))
    {
      throw new Exception("Make sure you are passing in the correct parameters.");
    }

    $this->oauth_access_token = $settings['oauth_access_token'];
    $this->oauth_access_token_secret = $settings['oauth_access_token_secret'];
    $this->consumer_key = $settings['consumer_key'];
    $this->consumer_secret = $settings['consumer_secret'];
  }

  /**
  * Set postfields array, example: array('screen_name' => 'simply_become')
  *
  * @param array $array Array of parameters to send to API
  *
  * @return TwitterAPIExchange Instance of self for method chaining
  **/
  public function setPostfields(array $array){
    if(!is_null($this->getGetfield())){
      throw new Exception("You can only choose get OR post fields.");
    }

    if(isset($array['status']) && substr($array['status'], 0, 1) === '@'){
      $array['status'] = sprintf("\0%s", $array['status']);
    }

    $this->postfields = $array;

    return $this;
  }

  /**
  * Set getfield string, example: '?screen_name=simply_become'
  *
  * @param string $string Get key and value pairs as string
  *
  * @return \TwitterAPIExchange Instance of self for method chaining
  **/
  public function setGetfield($string){
    if(!is_null($this->getPostfields())){
      throw new Exception("You can only choose get OR post fields");
    }

    $search = array('#', ',', '+', ':');
    $replace = array('%23', '$2C', '%2B', '%3A');
    $string = str_replace($search, $replace, $string);

    $this->getfield = $string;

    return $this;
  }

  /**
  * Get getfield string (simple getter)
  *
  * @return string $this->getfields
  **/
  public function getGetfield(){
    return $this->getfield;
  }

  /**
  * Get postfields array (simple getter)
  *
  * @return array $this->postfields
  **/
  public function getPostfields(){
    return $this->postfields;
  }

  /**
  * Build the Oauth object using params set in construct and additionals
  * passed to this method. For v.1.1, see: https://dev.twitter.com/docs/api/1.1
  *
  * @param string $url The API url to use. Example: https://api.twitter.com/1.1/search/tweets.json
  * @param string $requestMethod Either POST or GET
  * @return \TwitterAPIExchange Instance of self for method chaining
  **/
  public function buildOauth($url, $requestMethod){
    if(!in_array(strtolower($requestMethod), array('post', 'get'))){
      throw new Exception("Request method must be either POST or GET");
    }

    $consumer_key = $this->consumer_key;
    $consumer_secret = $this->consumer_secret;
    $oauth_access_token = $this->oauth_access_token;
    $oauth_access_token_secret = $this->oauth_access_token_secret;

    $oauth = array(
      'oauth_consumer_key' => $consumer_key,
      'oauth_nonce' => time(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_token' => $oauth_access_token,
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0'
    );

    $getfield = $this->getGetfield();

    if(!is_null($getfield)){
      $getfields = str_replace('?', '', explode('&', $getfield));

      foreach($getfields as $g){
        $split = explode('=', $g);
        $oauth[$split[0]] = $split[1];
      }
    }

    $base_info = $this->buildBaseString($url, $requestMethod, $oauth);
    $composite_key = rawurlencode($consumer_secret) . '&' . rawurldecode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;

    $this->url = $url;
    $this->oauth = $oauth;

    return $this;
  }

  /**
  * Perform the actual data retrieval from the API
  *
  * @param boolean $return If true, returns data.
  *
  * @return string json If $return param is true, returns json data.
  **/
  public function performRequest($return = true){
    if(!is_bool($return)){
      throw new Exception("performRequest parameter must be true or false");
    }

    $header = array($this->buildAuthorizationheader($this->oauth), 'Expect:');

    $getfield = $this->getGetfield();
    $postfields = $this->getPostfields();

    $options = array(
      CURLOPT_HTTPHEADER => $header,
      CURLOPT_HEADER => false,
      CURLOPT_URL => $this->url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 10

    );

    if(!is_null($postfields)){
      $options[CURLOPT_POSTFIELDS] = $postfields;
    }
    else{
      if($getfield !== ''){
        $options[CURLOPT_URL] .= $getfield;
      }
    }

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);

    if($return) { return $json; }
  }

  /**
  * Private method to generate the base string used by cURL
  * @param string $baseURI
  * @param string $method
  * @param array $params
  *
  * @return string Built base string
  **/
  private function buildBaseString($baseURI, $method, $params){
    $return = array();
    ksort($params);

    foreach($params as $key=>$value){
      $return[] = "$key=" . $value;
    }

    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $return));
  }

  /**
  * Private method to generate authorisation header used by cURL
  *
  * @param array $oauth Array of oauth data generated by buildOauth()
  *
  * @return string $return Header used by cURL for request
  **/
  private function buildAuthorizationHeader($oauth){
    $return = 'Authorization: OAuth ';
    $values = array();

    foreach($oauth as $key => $value){
      $values[] = "$key=\"" . rawurlencode($value) . "\"";
    }

    $return .= implode(', ', $values);
    return $return;
  }
}

function getTweets($settings, $url, $getfield, $requestMethod) {
  /*** 
  * ==========================================
  *  Twitter User Timeline Request & Response
  * ==========================================
  *
  * Access the data returned from the function like so:
  *
  * $twitter_response = getTweets();
  * $twitter_array = json_decode($twitter_response, $assoc = TRUE);
  *
  * ========================================
  * Example of required function parameters
  * ========================================
  *
  * $settings = array(
  *         'oauth_access_token' => "857953658-UBgvkLcEuz5RxR9roLed9fbPEi0szGfgZmweu2rD",
  *         'oauth_access_token_secret' => "u5d1vdYn9gHyK3eofkpZMAMDVWQrfpgqPYR7cgdZiaIel",
  *         'consumer_key' => "sy4QZ0ZImBauniYWWBw7Vn9uM",
  *         'consumer_secret' => "Ag5h3yMrKzl4XlJv7FqXsCkYPQyuWaLZMg3MseDIx84zGnGrwB"
  *       );
  *
  * URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ 
  * Note: Set the GET field BEFORE calling buildOauth();
  * 
  * $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
  * $getfield = '?screen_name=Viola_FC&count=1';
  * $requestMethod = 'GET';
  ***/

  /** POST fields required by the URL above. See relevant docs as above. **/
  $twitter = new TwitterAPIExchange($settings);
  $twitter_response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

  return $twitter_response;
}

// See the __() WordPress function for valid values for $text_domain.
register_sidebar( array(
    'id'          => 'right-sidebar',
    'name'        => __( 'Right Sidebar (Default)', 'text_domain' ),
    'description' => __( 'The sidebar that is located on the right hand side of content pages.', 'text_domain' ),
    'before_widget' => '',
    'after_widget' => ''
));

function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
}

function get_custom_cat_template($single_template) {
     global $post;

        if ( in_category( 'vacancies' )) {
          $single_template = dirname( __FILE__ ) . '/single-vacancy.php';
      }
     return $single_template;
}

add_filter( "single_template", "get_custom_cat_template" );

function jetpackme_custom_related( $atts ) {
    $posts_titles = array();

    if ( class_exists( 'Jetpack_RelatedPosts' ) && method_exists( 'Jetpack_RelatedPosts', 'init_raw' ) ) {
        $related = Jetpack_RelatedPosts::init_raw()
            ->set_query_name( 'jetpackme-shortcode' ) // Optional, name can be anything
            ->get_for_post_id(
                get_the_ID(),
                array( 'size' => 3 )
            );

        if ( $related ) {
            foreach ( $related as $result ) {
                // Get the related post IDs
                $related_post = get_post( $result[ 'id' ] );
                // From there you can do just about anything. Here we get the post titles
                $posts_titles[] = $related_post->post_title;
            }
        }
    }

    // Return a list of post titles separated by commas
    return implode( ', ', $posts_titles );
}

function str2xml($str){
  $str = str_replace("\r", "\n", $str);
  $str = '<p>' . str_replace("\n", "</p><p>", $str) . '</p>';
  $str = str_replace( ']]>', ']]&gt;', $str);

  return $str;
}

function wp_get_archives_custom( $args = '' ) {
  global $wpdb, $wp_locale;

  $defaults = array(
    'type' => 'monthly', 'limit' => '',
    'format' => 'html', 'before' => '',
    'after' => '', 'show_post_count' => false,
    'echo' => 1, 'order' => 'DESC', 'category_name' => '',
    'join' => '', 'post_type' => 'post', 'is_events_page' => false
  );

  $r = wp_parse_args( $args, $defaults );

  if ( '' == $r['type'] ) {
    $r['type'] = 'monthly';
  }

  if ( ! empty( $r['limit'] ) ) {
    $r['limit'] = absint( $r['limit'] );
    $r['limit'] = ' LIMIT ' . $r['limit'];
  }

  $order = strtoupper( $r['order'] );
  if ( $order !== 'ASC' ) {
    $order = 'DESC';
  }

  $cat_id = ( !empty($args['category_name']) ? get_category_by_slug( $args['category_name'] ) : get_category_by_slug( $r['category_name']) );
  $cat_id = (!empty($args['category_name'])) ? $cat_id->term_id : false;

  $join = ( !empty($r['join']) ? $r['join'] : '' );

  if($cat_id != 0) $join = 'INNER JOIN ' . $wpdb->prefix . 'term_relationships ON ' . $wpdb->prefix . 'posts.ID = ' . $wpdb->prefix . 'term_relationships.object_id';

  $post_type = ( !empty($r['post_type']) ? $r['post_type'] : 'post');

  $is_events_page = $r['is_events_page'];
  $events_page = get_option('dbem_events_page');

  if($is_events_page != false && is_page($events_page)){
    $events_page = get_permalink($events_page);
  }
  else{
    $is_events_page = false;
  }

  // this is what will separate dates on weekly archive links
  $archive_week_separator = '&#8211;';

  // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
  $archive_date_format_over_ride = 0;

  // options for daily archive (only if you over-ride the general date format)
  $archive_day_date_format = 'Y/m/d';

  // options for weekly archive (only if you over-ride the general date format)
  $archive_week_start_date_format = 'Y/m/d';
  $archive_week_end_date_format = 'Y/m/d';

  if ( ! $archive_date_format_over_ride ) {
    $archive_day_date_format = get_option( 'date_format' );
    $archive_week_start_date_format = get_option( 'date_format' );
    $archive_week_end_date_format = get_option( 'date_format' );
  }

  /**
   * Filter the SQL WHERE clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_where Portion of SQL query containing the WHERE clause.
   * @param array  $r         An array of default arguments.
   */
  $where = apply_filters( 'getarchives_where', "WHERE post_type = '" . $post_type . "' AND post_status = 'publish'" . ( ( $cat_id != 0 ) ? " AND " . $wpdb->prefix . "term_relationships.term_taxonomy_id = " . $cat_id : "" ), $r );

  /**
   * Filter the SQL JOIN clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_join Portion of SQL query containing JOIN clause.
   * @param array  $r        An array of default arguments.
   */
  $join = apply_filters( 'getarchives_join', $join, $r );

  $output = '';

  $last_changed = wp_cache_get( 'last_changed', 'posts' );
  if ( ! $last_changed ) {
    $last_changed = microtime();
    wp_cache_set( 'last_changed', $last_changed, 'posts' );
  }

  $limit = $r['limit'];

  if ( 'monthly' == $r['type'] ) {
    if($is_events_page){
      $query = "
      SELECT YEAR(" . $wpdb->prefix . "em_events.event_start_date) AS 'year', MONTH(" . $wpdb->prefix . "em_events.event_start_date) AS 'month', count(" . $wpdb->prefix . "em_events.post_id) as posts 
      FROM " . $wpdb->prefix . "em_events INNER JOIN $wpdb->posts 
      ON " . $wpdb->prefix . "em_events.post_id = $wpdb->posts.ID 
      WHERE $wpdb->posts.post_status = 'publish' 
      GROUP BY YEAR(" . $wpdb->prefix . "em_events.event_start_date), MONTH(" . $wpdb->prefix . "em_events.event_start_date) 
      ORDER BY " . $wpdb->prefix . "em_events.event_start_date " . $order . $limit;
    }
    else{
      $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
    }
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }

    if ( $results ) {
      if($is_events_page) global $EM_Event;
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        if($is_events_page){
          // The format the Events Manager plugin expects its url structure, the 00 is so we can identify it as purely a monthly query
          // BY DATE POSTED $url = $events_page . $result->year . '-' . ( (strlen($result->month) < 2) ? '0' . $result->month : $result->month ) . '-00/';
          // BY EVENT START DATE
          $url = $events_page . $result->year . '-' . ( (strlen($result->month) < 2) ? '0' . $result->month : $result->month ) . '-00/';
        }
        else{
          $url = get_month_link( $result->year, $result->month );
        }

        /* translators: 1: month name, 2: 4-digit year */
        $text = sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $result->month ), $result->year );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url . ( ($cat_id != 0) ? '?cat=' . $cat_id : ''), $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'yearly' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result) {
        if($is_events_page){
          // The format the Events Manager plugin expects its url structure, the 00 is so we can identify it as purely a yearly query
          $url = $events_page . $result->year . '-00-00/';
        }
        else{
          $url = get_year_link( $result->year );
        }
        $text = sprintf( '%d', $result->year );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url . ( ($cat_id != 0) ? '?cat=' . $cat_id : ''), $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'daily' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        if($is_events_page){
          // The format the Events Manager plugin expects its url structure, the 00 is so we can identify it as purely a yearly query
          $url = $events_page . $result->year . '-' . ( (strlen($result->month) < 2) ? '0' . $result->month : $result->month ) . '-' . $result->dayofmonth . '/';
        }
        else{
          $url  = get_day_link( $result->year, $result->month, $result->dayofmonth );
        }
        $date = sprintf( '%1$d-%2$02d-%3$02d 00:00:00', $result->year, $result->month, $result->dayofmonth );
        $text = mysql2date( $archive_day_date_format, $date );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url . ( ($cat_id != 0) ? '?cat=' . $cat_id : ''), $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'weekly' == $r['type'] ) {
    $week = _wp_mysql_week( '`post_date`' );
    $query = "SELECT DISTINCT $week AS `week`, YEAR( `post_date` ) AS `yr`, DATE_FORMAT( `post_date`, '%Y-%m-%d' ) AS `yyyymmdd`, count( `ID` ) AS `posts` FROM `$wpdb->posts` $join $where GROUP BY $week, YEAR( `post_date` ) ORDER BY `post_date` $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    $arc_w_last = '';
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        if ( $result->week != $arc_w_last ) {
          $arc_year       = $result->yr;
          $arc_w_last     = $result->week;
          $arc_week       = get_weekstartend( $result->yyyymmdd, get_option( 'start_of_week' ) );
          $arc_week_start = date_i18n( $archive_week_start_date_format, $arc_week['start'] );
          $arc_week_end   = date_i18n( $archive_week_end_date_format, $arc_week['end'] );
          $url            = sprintf( '%1$s/%2$s%3$sm%4$s%5$s%6$sw%7$s%8$d', home_url(), '', '?', '=', $arc_year, '&amp;', '=', $result->week );
          $text           = $arc_week_start . $archive_week_separator . $arc_week_end;
          if ( $r['show_post_count'] ) {
            $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
          }
          $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
        }
      }
    }
  } elseif ( ( 'postbypost' == $r['type'] ) || ('alpha' == $r['type'] ) ) {
    $orderby = ( 'alpha' == $r['type'] ) ? 'post_title ASC ' : 'post_date DESC, ID DESC ';
    $query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      foreach ( (array) $results as $result ) {
        if ( $result->post_date != '0000-00-00 00:00:00' ) {
          $url = get_permalink( $result );
          if ( $result->post_title ) {
            /** This filter is documented in wp-includes/post-template.php */
            $text = strip_tags( apply_filters( 'the_title', $result->post_title, $result->ID ) );
          } else {
            $text = $result->ID;
          }
          $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
        }
      }
    }
  }
  if ( $r['echo'] ) {
    echo $output;
  } else {
    return $output;
  }
}

/* 
 * This is a fork of wp_get_archives() that allows archive links - i.e, showing archives by month for 
 * the events post type only. As of WP 4.4 you can do this with wp_get_archives() but Agile is on a previous version. 
 */
function events_get_archives( $args = '' ) {
  global $wpdb, $wp_locale;

  $defaults = array(
    'type' => 'monthly', 'limit' => '',
    'format' => 'html', 'before' => '',
    'after' => '', 'show_post_count' => false,
    'echo' => 1, 'order' => 'DESC',
  );

  $r = wp_parse_args( $args, $defaults );

  if ( '' == $r['type'] ) {
    $r['type'] = 'monthly';
  }

  if ( ! empty( $r['limit'] ) ) {
    $r['limit'] = absint( $r['limit'] );
    $r['limit'] = ' LIMIT ' . $r['limit'];
  }

  $order = strtoupper( $r['order'] );
  if ( $order !== 'ASC' ) {
    $order = 'DESC';
  }

  // this is what will separate dates on weekly archive links
  $archive_week_separator = '&#8211;';

  // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
  $archive_date_format_over_ride = 0;

  // options for daily archive (only if you over-ride the general date format)
  $archive_day_date_format = 'Y/m/d';

  // options for weekly archive (only if you over-ride the general date format)
  $archive_week_start_date_format = 'Y/m/d';
  $archive_week_end_date_format = 'Y/m/d';

  if ( ! $archive_date_format_over_ride ) {
    $archive_day_date_format = get_option( 'date_format' );
    $archive_week_start_date_format = get_option( 'date_format' );
    $archive_week_end_date_format = get_option( 'date_format' );
  }

  /**
   * Filter the SQL WHERE clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_where Portion of SQL query containing the WHERE clause.
   * @param array  $r         An array of default arguments.
   */
  $where = apply_filters( 'getarchives_where', "WHERE post_type = 'event' AND post_status = 'publish'", $r );

  /**
   * Filter the SQL JOIN clause for retrieving archives.
   *
   * @since 2.2.0
   *
   * @param string $sql_join Portion of SQL query containing JOIN clause.
   * @param array  $r        An array of default arguments.
   */
  $join = apply_filters( 'getarchives_join', '', $r );

  $output = '';

  $last_changed = wp_cache_get( 'last_changed', 'posts' );
  if ( ! $last_changed ) {
    $last_changed = microtime();
    wp_cache_set( 'last_changed', $last_changed, 'posts' );
  }

  $limit = $r['limit'];
  $events_page = get_option('dbem_events_page');
  $events_page = get_permalink($events_page);

  if ( 'monthly' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        //$url = get_month_link( $result->year, $result->month );
        // The format the Events Manager plugin expects its url structure, the 00 is so we can identify it as purely a monthly query
        $url = $events_page . $result->year . '-' . ( (strlen($result->month) < 2) ? '0' . $result->month : $result->month ) . '-00/';
        /* translators: 1: month name, 2: 4-digit year */
        $text = sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $result->month ), $result->year );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'yearly' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result) {
        $url = get_year_link( $result->year );
        $text = sprintf( '%d', $result->year );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'daily' == $r['type'] ) {
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        $url  = get_day_link( $result->year, $result->month, $result->dayofmonth );
        $date = sprintf( '%1$d-%2$02d-%3$02d 00:00:00', $result->year, $result->month, $result->dayofmonth );
        $text = mysql2date( $archive_day_date_format, $date );
        if ( $r['show_post_count'] ) {
          $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
        }
        $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
      }
    }
  } elseif ( 'weekly' == $r['type'] ) {
    $week = _wp_mysql_week( '`post_date`' );
    $query = "SELECT DISTINCT $week AS `week`, YEAR( `post_date` ) AS `yr`, DATE_FORMAT( `post_date`, '%Y-%m-%d' ) AS `yyyymmdd`, count( `ID` ) AS `posts` FROM `$wpdb->posts` $join $where GROUP BY $week, YEAR( `post_date` ) ORDER BY `post_date` $order $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    $arc_w_last = '';
    if ( $results ) {
      $after = $r['after'];
      foreach ( (array) $results as $result ) {
        if ( $result->week != $arc_w_last ) {
          $arc_year       = $result->yr;
          $arc_w_last     = $result->week;
          $arc_week       = get_weekstartend( $result->yyyymmdd, get_option( 'start_of_week' ) );
          $arc_week_start = date_i18n( $archive_week_start_date_format, $arc_week['start'] );
          $arc_week_end   = date_i18n( $archive_week_end_date_format, $arc_week['end'] );
          $url            = sprintf( '%1$s/%2$s%3$sm%4$s%5$s%6$sw%7$s%8$d', home_url(), '', '?', '=', $arc_year, '&amp;', '=', $result->week );
          $text           = $arc_week_start . $archive_week_separator . $arc_week_end;
          if ( $r['show_post_count'] ) {
            $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
          }
          $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
        }
      }
    }
  } elseif ( ( 'postbypost' == $r['type'] ) || ('alpha' == $r['type'] ) ) {
    $orderby = ( 'alpha' == $r['type'] ) ? 'post_title ASC ' : 'post_date DESC, ID DESC ';
    $query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
    $key = md5( $query );
    $key = "wp_get_archives:$key:$last_changed";
    if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
      $results = $wpdb->get_results( $query );
      wp_cache_set( $key, $results, 'posts' );
    }
    if ( $results ) {
      foreach ( (array) $results as $result ) {
        if ( $result->post_date != '0000-00-00 00:00:00' ) {
          $url = get_permalink( $result );
          if ( $result->post_title ) {
            /** This filter is documented in wp-includes/post-template.php */
            $text = strip_tags( apply_filters( 'the_title', $result->post_title, $result->ID ) );
          } else {
            $text = $result->ID;
          }
          $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
        }
      }
    }
  }
  if ( $r['echo'] ) {
    echo $output;
  } else {
    return $output;
  }
}

function page_post_output_list(){
  global $post;
  $page_list = get_post_meta($post->ID, 'Page Footer List Items');
  $page_list_title = get_post_meta($post->ID, 'Page Footer List Title');

  if(!empty($page_list)){
    ob_start();
      $list = (!empty($page_list_title) ? 'dl' : 'ul' );
      $item_type = (!empty($page_list_title) ? 'dd' : 'li' );;
      echo '<' . $list . ' class="page-footer-list">';
        if(!empty($page_list_title)) echo '<dt class="page-footer-list-title">' . $page_list_title[0] . '</dt>';
        foreach($page_list as $key=>$value){
          echo '<' . $item_type . ' class="footer-list-item">';
            echo '<span class="icon-container">';
              echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                <use xlink:href="#agi-bullet-tick"></use>
              </svg>';
            echo '</span>';

            echo '<span class="text">' . $value . '</span>';
          echo '</' . $item_type . '>';
        }
      echo '</' . $list . '>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    // Output our list
    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('list_block', 'page_post_output_list');

function event_single_output_timeline_list(){
  global $post;
  $event_timeline_list_title = get_post_meta($post->ID, 'Milestones List Title');
  $event_timeline_milestones_times = get_post_meta($post->ID, 'Milestones Time List');
  $event_timeline_milestones_txt = get_post_meta($post->ID, 'Milestones List');

  if(!empty($event_timeline_milestones_times) && !empty($event_timeline_milestones_txt)){
    ob_start();
      $list = (!empty($event_timeline_list_title) ? 'dl' : 'ul' );
      $item_type = (!empty($event_timeline_list_title) ? 'dd' : 'li' );;
      echo '<' . $list . ' class="page-footer-list event-timeline-list">';
        if(!empty($event_timeline_list_title)) echo '<dt class="page-footer-list-title">' . $event_timeline_list_title[0] . '</dt>';
        foreach($event_timeline_milestones_times as $key=>$value){
          echo '<' . $item_type . ' class="footer-list-item event-timeline-list-item">';
            echo '<span class="icon-container">';
              echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 25.034" xml:space="preserve">
                <use xlink:href="#agi-bullet-tick-o"></use>
              </svg>';
            echo '</span>';

            echo '<div class="text row">';
              echo '<div class="time col-md-5th">' . ((!empty($value)) ? $value : '') . '</div>';
              echo '<div class="milestone col-md-5thx4">' . ((!empty($event_timeline_milestones_txt[$key])) ? $event_timeline_milestones_txt[$key] : '') . '</div>';
            echo '</div>';
          echo '</' . $item_type . '>';
        }
      echo '</' . $list . '>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    // Output our list
    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('milestone_list_block', 'event_single_output_timeline_list');

function vacancy_single_output_key_reqs(){
  global $post;
  $key_reqs_list = get_post_meta($post->ID, 'Key Requirements List');
  $key_reqs_title = get_post_meta($post->ID, 'Key Requirements List Title');

  if(!empty($key_reqs_list)){
    ob_start();
      $list = (!empty($key_reqs_title) ? 'dl' : 'ul' );
      $item_type = (!empty($key_reqs_title) ? 'dd' : 'li' );;
      echo '<' . $list . ' class="page-footer-list vacancy-key-reqs-list">';
        if(!empty($key_reqs_title)) echo '<dt class="page-footer-list-title">' . $key_reqs_title[0] . '</dt>';
        foreach($key_reqs_list as $key=>$value){
          echo '<' . $item_type . ' class="footer-list-item vacancy-key-reqs-list-item">';
            echo '<span class="icon-container">';
              echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 25.034" xml:space="preserve">
                <use xlink:href="#agi-bullet-tick-o"></use>
              </svg>';
            echo '</span>';

            echo '<span class="text">';
              echo ((!empty($value)) ? $value : '');
            echo '</span>';
          echo '</' . $item_type . '>';
        }
      echo '</' . $list . '>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    // Output our list
    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('vacancy_key_reqs', 'vacancy_single_output_key_reqs');

function quote_block_output($atts){
  global $post;
  $id = (!empty($atts['id'])) ? intval($atts['id'] - 1) : -1; // Add one onto the id because of array indexes starting at zero which is likely counter-intuitive behaviour for most users
  $quotes = get_post_meta($post->ID, 'Quote');
  $quote_authors = get_post_meta($post->ID, 'Quote Author');

  if(!empty($quotes) && $id != -1){
    ob_start();
      echo '<blockquote class="quote-' . $id . '">';
        echo wpautop($quotes[$id]);
        if(!empty($quote_authors)) echo '<footer>' . $quote_authors[$id] . '</footer>';
      echo '</blockquote>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('quote_block', 'quote_block_output');

// Buttons - AE - copied from original agile theme
function buttons( $atts, $content = null ) {
  extract( shortcode_atts( array(
          'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
          'size' => 'default', /* mini, small, default, large */
          'url'  => '',
                'text' => '',
        ), $atts ) );
        if($type == "default"){
                $type = "";
        }
        else{
                $type = "btn-" . $type;
        }
        if($size == "default"){
                $size = "";
        }
        else {
                $size = "btn-" . $size;
        }
        $output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '"><span class="text-grad">';
        $output .= $text;
        $output .= '</span></a>';
        return $output;
}
add_shortcode('button', 'buttons');

function cta_button_output($atts){
  global $post;
  $url = (!empty($atts['url'])) ? $atts['url'] : -1;
  $text = (!empty($atts['text'])) ? $atts['text'] : 'View Link';

  if($url != -1){
    ob_start();
      echo '<a href="' . $url . '" title="' . $text . '" class="button">';
        echo $text;
      echo '</a>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('cta_button', 'cta_button_output');

function key_skills_output_list(){
  global $post;
  $key_skills = get_post_meta($post->ID, 'Key Skills');

  if(!empty($key_skills)){
    ob_start();
      echo '<div id="key-skills">';
        echo '<dl id="key-skills-list">';
          echo '<dt id="key-skills-list-title">Key Skills</dt>';
          foreach($key_skills as $skill){
            echo '<dd class="key-skills-list-item">';
              echo '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 25.034" xml:space="preserve">
                <use xlink:href="#agi-bullet-tick-o"></use>
              </svg>';
              echo $skill;
            echo '</dd>';
          }
        echo '</dl>';
      echo '</div>';

      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    // Output our list
    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('key_skills', 'key_skills_output_list');

function clockdown_timer_output($atts){
  $id = !empty( $atts['id'] ) ? $atts['id'] : 'null';
  $class = !empty( $atts['class']) ? $atts['class'] : '';
  $date = !empty( $atts['date'] ) ? $atts['date'] : -1;
  $show_years = !empty( $atts['show_years'] ) ? $atts['show_years'] : -1;
  $show_months = !empty( $atts['show_months'] ) ? $atts['show_months'] : 1;
  $show_days = !empty( $atts['show_days'] ) ? $atts['show_days'] : 1;
  $show_hours = !empty( $atts['show_hours'] ) ? $atts['show_hours'] : 1;
  $show_minutes = !empty( $atts['show_minutes'] ) ? $atts['show_minutes'] : 1;
  $show_seconds = !empty( $atts['show_seconds'] ) ? $atts['show_seconds'] : 1;
  $countdown_title = !empty( $atts['title'] ) ? $atts['title'] : 'Time Remaining:';
  $show_title = !empty( $atts['show_title'] ) ? $atts['show_title'] : -1;

  if(!empty($date)){
    ob_start();

      echo '<div id="countdownClockContainer" class="countdown-clock-container">';
        echo '<dl class="countdown-clock-list">';
          echo '<dt class="countdown-clock-title' . ($show_title != -1 ? '' : ' sr-only') . '">' . $countdown_title . '</dt>';

          if($show_years != -1){
            echo '<dd class="countdown-clock-years">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Years</span>';
            echo '</dd>';
          }

          if($show_months != -1){
            echo '<dd class="countdown-clock-months">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Months</span>';
            echo '</dd>';
          }

          if($show_days != -1){
            echo '<dd class="countdown-clock-days">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Days</span>';
            echo '</dd>';
          }

          if($show_hours != -1){
            echo '<dd class="countdown-clock-hours">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Hrs</span>';
            echo '</dd>';
          }

          if($show_minutes != -1){
            echo '<dd class="countdown-clock-minutes">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Mins</span>';
            echo '</dd>';
          }

          if($show_seconds != -1){
            echo '<dd class="countdown-clock-seconds">';
              echo '<span class="text time-unit"></span>';
              echo '<span class="label">Secs</span>';
            echo '</dd>';
          }
        echo '</dl>';
      echo '</div>';

      ?>
        <script type="text/javascript">
          if(typeof countdownClock === 'undefined'){
            countdownClock = function (){
              this.initialising = null;
              this.clocks = [];
            };

            countdownClock.prototype = {

              getDiffYears: function(dt1, dt2){
                // Params must be timestamps, d1 is the later date
                var diff = (dt1 - dt2) / 1000;
                diff /= (60 * 60 * 24);
                return Math.floor(diff / 365.25);
              },

              getTimeRemaining: function(endtime){
                /*
                  var t = Date.parse(endtime) - Date.parse(new Date());
                  var years = this.getDiffYears(Date.parse(endtime), Date.parse(new Date()));
                  var months = Math.floor( new Date(endtime).getMonth() - new Date().getMonth() );
                  var days = Math.floor( t / (1000 * 60 * 60 * 24));
                  var hours = Math.floor( (t / (1000 * 60 * 60)) % 24 );
                  var minutes = Math.floor( ( t / 1000 / 60 ) % 60 );
                  var seconds = Math.floor( (t / 1000) % 60 );
                */

                var now = window.moment(new Date());
                var then = window.moment(endtime);
                var t = then.diff(now);
                var timestamp_diff = Date.parse(endtime) - Date.parse(new Date());
                var total_days = Math.floor( timestamp_diff / (1000 * 60 * 60 * 24));
                var diff = window.moment(t).toObject(); // Based on the difference between the two timestamps we get an object of the difference in time

                /*
                 * We then get an object like:
                 *
                 * date: 1
                 * hours: 7
                 * milliseconds: 420
                 * minutes: 27
                 * months: 1
                 * seconds: 7
                 * years: 1971 (We subtract 1970 from this integer to get the number of years from a date)
                 *
                 */

                var years = diff.years === 1970 ? 0 : diff.years - 1970;
                var months = diff.months;
                var days = (diff.date - 1 >= 0 ? (diff.date - 1) : diff.date); // Strange bug in Moment seems to add calculate an extra full day, let's fix that
                var hours = diff.hours;
                var minutes = diff.minutes;
                var seconds = Math.floor( diff.seconds % 60 );

                return {
                  'total': t,
                  'years': years,
                  'months': months,
                  'totalDays': total_days,
                  'days': days,
                  'hours': hours,
                  'minutes': minutes,
                  'seconds': seconds
                }
              },

              initialiseClock: function(endtime, id, options){
                var that = this, clock;
                if(typeof options === 'undefined' || typeof options != 'object'){ opt = {} } else{ opt = options };

                /* We need to push this first to  */
                this.clocks.push({
                  id: '',
                  classes: opt.class,
                  el: null,
                  endtime: endtime,
                  interval: null,
                  options: opt
                });

                var index = this.clocks.length - 1;
                if(typeof id != 'string') id = index;

                if(document.getElementById('countdown-clock-container-' + id) === null || document.getElementById(id) === null){ 
                  el_id = typeof id === 'string' ? id : 'countdown-clock-container-' + id;
                  document.getElementById('countdownClockContainer').id = el_id;

                  clock = document.getElementById(el_id);
                  if(opt.class != '') clock.className = clock.className + ' ' + opt.class;
                }
                else{
                  console.error('A clock with the ID countdown-clock-container-' + id + ' already exists.');
                  return false;
                }

                var updateInterval = setInterval( function(){ that.updateClock(endtime, clock, index) }, 1000);

                this.clocks[index].id = id;
                this.clocks[index].el = clock;
                this.clocks[index].interval = updateInterval;

                this.initialising = false;
              },

              updateClock: function(endtime, clock, index){
                var t = this.getTimeRemaining(endtime);

                var years = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-years .time-unit');
                var years_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-years .label');

                var mon = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-months .time-unit');
                var mon_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-months .label');

                var d = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-days .time-unit');
                var d_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-days .label');

                var h = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-hours .time-unit');
                var h_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-hours .label');

                var min = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-minutes .time-unit');
                var min_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-minutes .label');

                var s = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-seconds .time-unit');
                var s_label = clock.querySelector('#' + clock.id + '.countdown-clock-container .countdown-clock-seconds .label');

                if(this.clocks[index].options.showYears === 1) years.innerHTML = t.years;
                if(this.clocks[index].options.showYears === 1) years_label.innerHTML = t.years > 1 ? 'Years' : 'Year';

                if(this.clocks[index].options.showMonths === 1) mon.innerHTML = t.months;
                if(this.clocks[index].options.showMonths === 1) mon_label.innerHTML = t.months > 1 ? 'Months' : 'Month';

                if(this.clocks[index].options.showDays === 1) d.innerHTML = t.days;
                if(this.clocks[index].options.showDays === 1) d_label.innerHTML = t.days > 1 ? 'Days' : 'Day';

                if(this.clocks[index].options.showHours === 1) h.innerHTML = t.hours;
                if(this.clocks[index].options.showHours === 1) h_label.innerHTML = t.hours > 1 ? 'Hrs' : 'Hr';

                if(this.clocks[index].options.showMinutes === 1) min.innerHTML = t.minutes;
                if(this.clocks[index].options.showMinutes === 1) min_label.innerHTML = t.minutes > 1 ? 'Mins' : 'Min';

                if(this.clocks[index].options.showSeconds === 1) s.innerHTML = t.seconds;
                if(this.clocks[index].options.showSeconds === 1) s_label.innerHTML = t.seconds > 1 ? 'Secs' : 'Sec';

                if(t.total <= 0 || (t.years === 0 && t.months === 0 && t.days === 0 && t.hours === 0 && t.minutes === 0 && t.seconds === 1)){
                  console.log('countdownClock (index: ' + index + ', id: #countdown-clock-container-' + this.clocks[index].id + ') has finished counting down.');

                  clearInterval(this.clocks[index].interval);

                  // Hide our clock if it runs out
                  if(typeof jQuery != 'undefined'){ jQuery(this.clocks[index].el).slideUp(); } else { this.clocks[index].el.style = 'display:none;'; }
                }
              },

              newClock: function(endtime, id, options){

                var that = this;

                if(typeof endtime === 'undefined') return console.error('countdownClock "endtime" parameter is undefined.');
                if(Date.parse(endtime) === 'NaN') return console.error('countdownClock "endtime" parameter is not a valid date string.');
                if(typeof id === 'undefined' || id === '' || id === 'null') id = null;
                if(typeof id === 'string') id = id.replace('/"/g', '\"');
                if(Date.parse(endtime) - Date.parse(new Date()) <= 0) console.log('countdownClock with the end time of ' + endtime + ' and ID: ' + id + ', has already passed its countdown date.');

                this.initialiseClock(endtime, id, options);
              }
            }

            countdownClock = new countdownClock();
          }

          var options = {
            id: <?= "'" . $id . "'" ?>,
            class: <?= '"' . $class . '"' ?>,
            showYears:<?= $show_years ?>,
            showMonths:<?= $show_months ?>,
            showDays:<?= $show_days ?>,
            showHours:<?= $show_hours ?>,
            showMinutes:<?= $show_minutes ?>,
            showSeconds:<?= $show_seconds ?>,
            title: <?= '"' . $countdown_title . '"' ?>,
            showTitle: <?= $show_title ?>
          };

          countdownClock.newClock(<?php echo "'" . $date . "'"; ?>, <? echo '"' . $id . '"'; ?>, options);
        </script>
      <?php
      // Store our output
      $output = ob_get_contents();

    ob_end_clean();

    return $output;
  }
  else{
    return false;
  }
}
add_shortcode('countdown_clock', 'clockdown_timer_output');

function bcm_dropdown_output($atts, $content = null){
  global $post;
  $title = (!empty($atts['title'])) ? $atts['title'] : 'Dropdown List';

  ob_start();

    echo '<dl class="dropdown-list">';
      echo '<dt class="dropdown-title" title="Toggle ' . $title . ' Dropdown">';
        echo '<span class="text">' . $title . '</span>';

        echo '<svg class="icon svg-canvas dropdown-status-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 32" xml:space="preserve">
                  <use xlink:href="#agi-caret-right"></use>
              </svg>';
      echo '</dt>';

      echo '<dd class="dropdown-item">';
        echo wpautop($content);
      echo '</dd>';
    echo '</dl>';

    // Store our output
    $output = ob_get_contents();

  ob_end_clean();

  return $output;
}
add_shortcode('bcm_dropdown', 'bcm_dropdown_output');

function key_vacancies_list_output($atts){

  global $post;
  $title = (!empty($atts['title'])) ? $atts['title'] : 'Key Vacancies';

  ob_start();

    $key_vacancies_tax_args = array(
            'taxonomy' => 'vacanciestypes',
            'field'    => 'slug',
            'terms'    => 'key-vacancies'
          );

    $key_vacancies_args = array(
          'post_type' => 'vacancies',
          'order' => 'ASC',
          'orderby' => 'date',
          'posts_per_page' => 2,
          'tax_query' => array( $key_vacancies_tax_args )
        );

    $key_vacancies_query = new WP_Query($key_vacancies_args);

    if($key_vacancies_query->have_posts()){
      echo '<div id="key-vacancies">';
        echo '<dl id="key-vacancies-list" class="row">';
          echo '<dt class="col-xs-12 col-sm-12 col-md-12">' . $title . '</dt>';
          while($key_vacancies_query->have_posts()): $key_vacancies_query->the_post();
            // The post background image
            $img;
            if (class_exists('MultiPostThumbnails')) {
              $img = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'vacancy-listing-image', $post->ID);
            }

            echo '<dd id="key-vacancy-' . $post->ID . '" class="key-vacancy col-xs-12 col-sm-12 col-md-12">';
              /*
                echo '<div class="key-vacancy-image image-wrap">';
                  echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    echo '<img src="' . (!empty($img) ? $img : get_stylesheet_directory_uri() . '/img/placeholder.png') . '" alt="' . get_the_title() . ' Image" title="' . get_the_title() . '">';
                  echo '</a>';
                echo '</div>';

                echo '<h4 class="key-vacancy-title">';
                  echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    echo get_the_title();
                  echo '</a>';
                echo '</h4>';

                edit_post_link();
              */

              echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                echo get_the_title();
              echo '</a>';
            echo '</dd>';
          endwhile;
          wp_reset_query();
        echo '</dl>';
      echo '</div>';
    }

    // Store our output
    $output = ob_get_contents();

  ob_end_clean();

  return $output;
}
add_shortcode('key_vacancies_list', 'key_vacancies_list_output');


/*
 * post_has_terms() - Added by Ross @ Become 2017/08/18
 *
 * Pass it a single WP_Term object or an array of WP_Term objects to check if a post has been categorised under a term in a *specific* taxonomy.
 * It checks this by making a boolean comparison of term ID's or slugs.
 *
 * The supplied data in $post_terms is assumed to be the output of get_terms() relevant to that post but can simply be a list of WP_Term objects.
 * 
 * If required it can return an array of all the terms a post is categorised under.
 */
function post_has_terms($post_terms, $term_id_slug, $taxonomy = '', $return_data = false){
  if(empty($post_terms)) return null;
  if(empty($term_id_slug)) return null;
  if(empty($taxonomy)) $taxonomy = 'category';
  $data = array();

  if(is_array($post_terms)){
    foreach($post_terms as $post_term) {
        if (($term_id_slug == $post_term->term_id || $term_id_slug == $post_term->slug) && $taxonomy == $post_term->taxonomy) {
            if($return_data == false) return true;

            $data[$post_term->ID] = $post_term;
        }
    }
  }
  else if(is_object($post_terms)){
    if(($term_id_slug == $post_terms->term_id || $term_id_slug == $post_terms->slug) && $taxonomy == $post_terms->taxonomy){
      return true;
    }
  }
  else{
    return false;
  }
}