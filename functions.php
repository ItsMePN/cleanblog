<?php
/**
 * Clean Blog functions and definitions
 *
 * @package Clean Blog
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function cleanblog_register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name' => 'WordPress REST API (Version 2)',
			'slug' => 'rest-api',
			'required' => true,
		)
	);
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id' => 'cleanblog',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu' => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug' => 'themes.php',            // Parent menu slug.
		'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices' => true,                    // Show admin notices or not.
		'dismissable' => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message' => '',                      // Message to output right before the plugins table.


		'strings' => array(
			'page_title' => __('Install Required Plugins', 'cleanblog'),
			'menu_title' => __('Install Plugins', 'cleanblog'),
			/*translators: %s: plugin name.*/
			'installing' => __('Installing Plugin: %s', 'cleanblog'),
			/*translators: %s: plugin name.*/
			'updating' => __('Updating Plugin: %s', 'cleanblog'),
			'oops' => __('Something went wrong with the plugin API.', 'cleanblog'),
			'notice_can_install_required' => _n_noop(
			/*translators: 1: plugin name(s).*/
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'cleanblog'
			),
			'notice_can_activate_required' => _n_noop(
			/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'cleanblog'
			),
			/*
				'notice_can_install_recommended'  => _n_noop(
					/* translators: 1: plugin name(s). * /
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'cleanblog'
				),
				'notice_ask_to_update'            => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'cleanblog'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					/* translators: 1: plugin name(s). * /
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'cleanblog'
				),
				'notice_can_activate_required'    => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'cleanblog'
				),
				'notice_can_activate_recommended' => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'cleanblog'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'cleanblog'
				),
				'update_link' 					  => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'cleanblog'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'cleanblog'
				),
				'return'                          => __( 'Return to Required Plugins Installer', 'cleanblog' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'cleanblog' ),
				'activated_successfully'          => __( 'The following plugin was activated successfully:', 'cleanblog' ),
				/* translators: 1: plugin name. * /
				'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'cleanblog' ),
				/* translators: 1: plugin name. * /
				'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'cleanblog' ),
				/* translators: 1: dashboard link. * /
				'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'cleanblog' ),
				'dismiss'                         => __( 'Dismiss this notice', 'cleanblog' ),
				'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'cleanblog' ),
				'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'cleanblog' ),

				'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
			),
			*/
		)
	);

	tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'cleanblog_register_required_plugins');

if (!function_exists('cleanblog_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cleanblog_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Clean Blog, use a find and replace
		 * to change 'cleanblog' to the name of your theme in all the template files
		 */
		load_theme_textdomain('cleanblog', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'cleanblog'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		//	add_theme_support( 'post-formats', array(
		//		'aside',
		//		'image',
		//		'video',
		//		'quote',
		//		'link',
		//	) );

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('cleanblog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
	}
endif; // cleanblog_setup
add_action('after_setup_theme', 'cleanblog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cleanblog_content_width()
{
	$GLOBALS['content_width'] = apply_filters('cleanblog_content_width', 750);
}

add_action('after_setup_theme', 'cleanblog_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function cleanblog_scripts()
{
	wp_enqueue_style('cleanblog-style', get_stylesheet_uri());
	wp_enqueue_style('cleanblog-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('cleanblog-theme', get_template_directory_uri() . '/css/clean-blog.min.css');
	wp_enqueue_style('cleanblog-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
	wp_enqueue_style('cleanblog-lora', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
	wp_enqueue_style('cleanblog-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');

	wp_enqueue_script('cleanblog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20150803', true);
	wp_enqueue_script('cleanblog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150803', true);
	wp_enqueue_script('cleanblog-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20150803', true);
	wp_enqueue_script('cleanblog-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20150803', true);
	wp_enqueue_script('cleanblog-theme', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true);

	/* Enqueue for REST theme. Sequence matters a lot */
	wp_register_script('envjs', get_stylesheet_directory_uri() . '/js/env.js');
	wp_register_script('angularjs', get_stylesheet_directory_uri() . '/js/angular.min.js');
	wp_register_script('angularjs-route', get_stylesheet_directory_uri() . '/js/angular-route.min.js');
	wp_register_script('angularjs-sanitize', get_stylesheet_directory_uri() . '/js/angular-sanitize.min.js');
	wp_register_script('dirdisqusjs', get_stylesheet_directory_uri() . '/js/dirDisqus.js');
	wp_enqueue_script('pn-scripts', get_stylesheet_directory_uri() . '/js/app.js', array('jquery', 'angularjs', 'angularjs-route', 'angularjs-sanitize', 'dirdisqusjs', 'envjs', 'cleanblog-bootstrap'));

	wp_localize_script(
		'pn-scripts',
		'pnLocalized',
		array(
			'parts' => trailingslashit(get_template_directory_uri()) . 'template-parts/',
			'siteUrl' => trailingslashit(get_site_url()),
			'siteImgs' => trailingslashit(get_template_directory_uri()) . 'img/',
			'defaultHeaderImg' => trailingslashit(get_template_directory_uri()) . 'img/home-bg.jpg',
		)
	);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

}

add_action('wp_enqueue_scripts', 'cleanblog_scripts');


add_filter('contact-form-7', 'do_shortcode');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Remove container DIV from navigation menu in header.
 */
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');

/**
 * Customizing the excerpt
 */

// Customize the excerpt length
function custom_excerpt_length($length)
{
	return 60;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

// Add a Read More link to the end of the excerpt
function custom_excerpt_more($more)
{
	return ' ... <a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'cleanblog') . '</a>';
}

add_filter('excerpt_more', 'custom_excerpt_more');

// Add a class to the <p> wrap around the excerpt
function add_class_to_excerpt($excerpt)
{
	return str_replace('<p', '<p class="excerpt"', $excerpt);
}

add_filter("the_excerpt", "add_class_to_excerpt");

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
	add_theme_support('woocommerce');
}


//function cleanblog_rest_prepare_post( $data, $post, $request ) {
//    $_data = $data->data;
//    $thumbnail_id = get_post_thumbnail_id( $post->ID );
//    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, full );
//    $_data['featured_image_url'] = $thumbnail[0];
//
//    $post_categories = wp_get_post_categories( $post->ID );
//    $cats = array();
//
//    foreach($post_categories as $c){
//        $cat = get_category( $c );
//        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'link' => $cat->link );
//    }
//    $_data['postcats'] = $cats;
//
//    $data->data = $_data;
//    return $data;
//}
//add_filter( 'rest_prepare_post', 'cleanblog_rest_prepare_post', 10, 3 );

/* This function customizes /posts endpoint resopnse and adds featured image to it */

function cleanblog_post_extra_fields()
{
	register_rest_field('post',
		'featured_image_url',
		array(
			'get_callback' => 'cleanblog_add_featured_img_url',
			'update_callback' => null,
			'schema' => null,
		)
	);
	register_rest_field('post',
		'postcats',
		array(
			'get_callback' => 'cleanblog_add_postcats',
			'update_callback' => null,
			'schema' => null,
		)
	);
	register_rest_field('post',
		'posttags',
		array(
			'get_callback' => 'cleanblog_add_posttags',
			'update_callback' => null,
			'schema' => null,
		)
	);
	register_rest_field('post',
		'postclasses',
		array(
			'get_callback' => 'cleanblog_add_postclasses',
			'update_callback' => null,
			'schema' => null,
		)
	);
}

add_action('rest_api_init', 'cleanblog_post_extra_fields');

/**
 * Get the value of the "featured_image_url" field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function cleanblog_add_featured_img_url($object, $field_name, $request)
{

	$thumbnail_id = get_post_thumbnail_id($object['id']);
	$thumbnail = wp_get_attachment_image_src($thumbnail_id, full);

	return $thumbnail[0];
}

function cleanblog_add_postcats($object, $field_name, $request)
{

	$post_categories = wp_get_post_categories($object['id']);
	$cats = array();

	foreach ($post_categories as $c) {
		$cat = get_category($c);
		$cats[] = array('name' => $cat->name, 'slug' => $cat->slug);
	}

	return $cats;
}

function cleanblog_add_posttags($object, $field_name, $request)
{

	$post_tags = wp_get_post_tags($object['id']);
	$tags = array();

	foreach ($post_tags as $t) {
		$tag = get_category($t);
		$tags[] = array('name' => $tag->name, 'slug' => $tag->slug);
	}

	return $tags;
}

function cleanblog_add_postclasses($object, $field_name, $request)
{

	$postclasses = get_post_class($object['id']);

	return $postclasses;
}

function cleanblog_menu_atts($atts, $item, $args)
{
	// The ID of the target menu item
	//var_dump($atts);

	// inspect $item
	if ($item->type_label === "Page") {
		$atts['data-post-type'] = 'page';
	} elseif ($item->type_label === "Post") {
		$atts['data-post-type'] = 'post';
	} elseif ($item->type_label === "Custom Link") {
		$atts['data-post-type'] = 'custom-link';
	}
	return $atts;
}

add_filter('nav_menu_link_attributes', 'cleanblog_menu_atts', 10, 3);


function change_page_default_url()
{
	global $wp_rewrite;
	$wp_rewrite->page_structure = 'pages/%pagename%';
	$wp_rewrite->flush_rules();
}

add_action('init', 'change_page_default_url', 1);

