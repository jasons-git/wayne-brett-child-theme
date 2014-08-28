<?php

/************************************************
* @package WayneBrettMetroChildTheme
* @author  Nate Lewis & Jason Lewis
* @license GPL-2.0+
* @link    http://practicalit.info/
************************************************/
// original author - NeilGee
// original authors URI - http://coolestguidesontheplanet.com/

// Start the engine the other way around - set up child after parent - add in theme supports, actions and filters

add_action( 'genesis_setup', 'genesischild_theme_setup' );

function genesischild_theme_setup() {

	add_theme_support( 'html5' );
	add_theme_support( 'genesis-responsive-viewport' );
	add_theme_support( 'genesis-footer-widgets', 3 );
	add_theme_support( 'custom-background' );
	add_theme_support( 'genesis-after-entry-widget-area' );
	//add_theme_support( 'genesis-connect-woocommerce' ); //Uncomment if using woocommerce

	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_after_header','genesis_do_nav' );

	add_action( 'wp_enqueue_scripts', 'genesischild_ie_styles', 999 );	//IE conditional styles load last
	add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 998 ); //Main style sheet 2nd last
	add_action( 'wp_enqueue_scripts', 'genesischild_scripts_styles', 997 ); //All the rest load before
	add_action( 'wp_enqueue_scripts', 'backstretch_background_scripts' );
	add_action( 'wp_enqueue_scripts', 'genesischild_responsive_scripts' );
	add_action( 'widgets_init', 'genesischild_extra_widgets' );
	add_action( 'genesis_before_loop','genesischild_before_entry_widget' );
	add_action( 'genesis_before_footer','genesischild_footerwidgetheader', 5 );
	add_action( 'genesis_footer','genesischild_footer_widget' );
	add_action( 'genesis_after_footer','genesischild_postfooter_widget' );
	add_action( 'genesis_before_header','genesischild_preheader_widget' );
	add_action( 'genesis_after_header','genesischild_optin_widget', 9 );
	add_action( 'genesis_header_right','genesis_do_nav' );
	//add_action( 'genesis_before', 'likebox_facebook_script' ); //Uncomment if using facebook likebox function below

	add_filter( 'widget_text', 'do_shortcode' );
	add_filter( 'widget_text','genesis_execute_php_widgets' );
	add_filter( 'excerpt_more', 'genesischild_read_more_link' );
	add_filter( 'comment_form_defaults', 'genesischild_comment_form_defaults' );
	add_filter( 'comment_form_defaults', 'genesischild_remove_comment_form_allowed_tags' );
	add_filter( 'genesis_post_info', 'genesischild_post_info' );
	add_filter( 'theme_page_templates', 'genesis_remove_blog_archive' );
	add_filter( 'genesis_do_nav','themeprefix_modify_genesis_do_nav', 10, 3 );
}



//Child Theme Functions Go Here

//Script-tac-ulous -> All the Scripts and Styles Registered and Enqueued, scripts first - then styles
function genesischild_scripts_styles() {
	wp_register_script ( 'placeholder' , get_stylesheet_directory_uri() . '/js/placeholder.js', array( 'jquery' ), '1', true );
	wp_register_style ( 'googlefonts' , '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,700,300,800', '', '2', 'all' );
	wp_register_style ( 'fontawesome' , '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', '' , '4.1.0', 'all' );

	wp_enqueue_script( 'placeholder' );//version 3.0.2
	wp_enqueue_style( 'googlefonts' );
	wp_enqueue_style( 'fontawesome' );
	//wp_enqueue_style( 'dashicons' ); //Uncomment if DashIcons required in front end
}

//IE Conditional Styles - gotta load last
function genesischild_ie_styles() {
	wp_register_style( 'ie8', get_stylesheet_directory_uri() . '/css/ie8.css' );//target IE8 and Lower
	$GLOBALS['wp_styles']->add_data( 'ie8', 'conditional', 'lte IE 8' );
	wp_register_style( 'ieall', get_stylesheet_directory_uri() . '/css/ieall.css' );//target IE9 and lower
	$GLOBALS['wp_styles']->add_data( 'ieall', 'conditional', 'IE' );

	wp_enqueue_style( 'ie8' );
	wp_enqueue_style( 'ieall' );
}

//Responsive Nav - adjust target currently set to .menu-primary and location currently set appear just after body tag - adjust to suit needs
//Ref - https://github.com/ComputerWolf/SlickNav
function genesischild_responsive_scripts() {

		wp_register_style ( 'slicknavcss', '//cdn.jsdelivr.net/jquery.slicknav/0.1/slicknav.css','', '1', 'all' );
		wp_register_script ( 'slicknav', '//cdn.jsdelivr.net/jquery.slicknav/0.1/jquery.slicknav.min.js', array( 'jquery' ), '1',true );
		wp_register_script ( 'slicknav-initialise', get_stylesheet_directory_uri() . '/js/slicknav-initialise.js', array( 'jquery', 'slicknav' ), '1', true );

		wp_enqueue_style( 'slicknavcss' );
		wp_enqueue_script( 'slicknav' );
		wp_enqueue_script( 'slicknav-initialise' );
}

//Backstretch for Custom Background Image

 function backstretch_background_scripts() {
	//* Load scripts only if custom background is being used
	if ( ! get_background_image() )
		return;

	wp_enqueue_script( 'backstretch', get_stylesheet_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '2.0.4', true );
	wp_enqueue_script( 'backstretch-image', get_stylesheet_directory_uri().'/js/backstretch-initialise.js' , array( 'jquery', 'backstretch' ), '1', true );
	wp_localize_script( 'backstretch-image', 'BackStretchImage', array( 'src' => get_background_image() ) );
}

//Add in new Widget areas
function genesischild_extra_widgets() {
	// PREHEADER LEFT WIDGET
	genesis_register_sidebar( array(
		'id'          => 'preheaderleft',
		'name'        => __( 'Alt Pre-Header Left 50%', 'genesischild' ),
		'description' => __( 'This is the home page pre-header area 1/2 left widget.', 'genesischild' ),
		'before_widget' => '<div class="first one-half preheaderleft">',
		'after_widget' => '</div>',
	) );
	// PREHEADER RIGHT WIDGET
	genesis_register_sidebar( array(
		'id'          => 'preheaderright',
		'name'        => __( 'Alt Pre-Header Right 50%', 'genesischild' ),
		'description' => __( 'This is the home page pre-header area 1/2 right widget.', 'genesischild' ),
		'before_widget' => '<div class="one-half preheaderright">',
		'after_widget' => '</div>',
	) );
	// HERO FULL WODGET
	genesis_register_sidebar( array(
		'id'          => 'hero',
		'name'        => __( 'Alt Hero Full Length 100%', 'genesischild' ),
		'description' => __( 'This is the home page full hero width widget.', 'genesischild' ),
		'before_widget' => '<div class="wrap hero">',
		'after_widget' => '</div>',
	) );
        //
	genesis_register_sidebar( array(
		'id'          => 'home-left-1',
		'name'        => __( 'Alt Main Content 1 Top Left 33%', 'genesischild' ),
		'description' => __( 'This is the home page top left content 1/3 width widget (Row 1).', 'genesischild' ),
		'before_widget' => '<div class="first one-third homeleft">',
		'after_widget' => '</div>',
	) );
		//
	genesis_register_sidebar( array(
		'id'          => 'home-middle-2',
		'name'        => __( 'Alt Main Content 2 Top Middle 33%', 'genesischild' ),
		'description' => __( 'This is the home page top middle content 1/3 width widget (Row 1).', 'genesischild' ),
		'before_widget' => '<div class="one-third homemiddle">',
		'after_widget' => '</div>',
	) );
		//
	genesis_register_sidebar( array(
		'id'          => 'home-right-3',
		'name'        => __( 'Alt Main Content 3 Top Right 33%', 'genesischild' ),
		'description' => __( 'This is the home page top right content 1/3 width widget (Row 1).', 'genesischild' ),
		'before_widget' => '<div class="one-third homeright">',
		'after_widget' => '</div>',
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-left-4',
		'name'        => __( 'Alt Main Content 4 Bottom Left 33%', 'genesischild' ),
		'description' => __( 'This is the home page bottom left content 1/3 width widget (Row 2).', 'genesischild' ),
		'before_widget' => '<div class="first one-third homeleft">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-middle-5',
		'name'        => __( 'Alt Main Content 5 Bottom Middle 33%', 'genesischild' ),
		'description' => __( 'This is the home page bottom middle content 1/3 width widget (Row 2).', 'genesischild' ),
		'before_widget' => '<div class="one-third homemiddle">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-right-6',
		'name'        => __( 'Alt Main Content 6 Bottom Right 33%', 'genesischild' ),
		'description' => __( 'This is the home page bottom right 1 column content 1/3 width widget (Row 2).', 'genesischild' ),
		'before_widget' => '<div class="one-third homeright">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-top-1-2',
		'name'        => __( 'Alt Main Content 1-2 combined Top left 66%', 'genesischild' ),
		'description' => __( 'This is the home page top left 2 columns content 2/3 width widget (Row 1).', 'genesischild' ),
		'before_widget' => '<div class="two-thirds homeleft">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-top-2-3',
		'name'        => __( 'Alt Main Content 2-3 combined Top right 66%', 'genesischild' ),
		'description' => __( 'This is the home page top right 2 columns content 2/3 width widget (Row 1).', 'genesischild' ),
		'before_widget' => '<div class="two-thirds homeright">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-bottom-4-5',
		'name'        => __( 'Alt Main Content 4-5 combined Bottom left 66%', 'genesischild' ),
		'description' => __( 'This is the home page bottom left 2 columns content 2/3 width widget (Row 2).', 'genesischild' ),
		'before_widget' => '<div class="two-thirds homeleft">',
		'after_widget' => '</div>',
	) );
	//
	genesis_register_sidebar( array(
		'id'          => 'home-bottom-5-6',
		'name'        => __( 'Alt Main Content 5-6 combined Bottom right 66%', 'genesischild' ),
		'description' => __( 'This is the home page bottom right 2 columns content 2/3 width widget (Row 2).', 'genesischild' ),
		'before_widget' => '<div class="two-thirds homeright">',
		'after_widget' => '</div>',
	) );
	//
}

//Position the PreHeader Area
function genesischild_preheader_widget() {
	echo '<section class="preheadercontainer"><div class="wrap">';
	genesis_widget_area ( 'preheaderleft' );
	genesis_widget_area ( 'preheaderright' );
	echo '</div></section>';
}

//Position the Hero Area
function genesischild_hero_widget() {
	genesis_widget_area ( 'hero', array(
	'before' => '<section class="herocontainer">',
	'after' => '</section>',));
}

//Position the Home Area
function genesischild_homecontent_widget() {
	echo '<section class="home-module-container"><div class="wrap">';
	//Position the Home Area 33%
	genesis_widget_area ( 'home-left-1' );
	//Position the Home Area 33%
	genesis_widget_area ( 'home-middle-2' );
	//Position the Home Area 33%
	genesis_widget_area ( 'home-right-3' );
        //Position the Home Area 33%
	genesis_widget_area ( 'home-left-4' );
	//Position the Home Area 33%
	genesis_widget_area ( 'home-middle-5' );
	//Position the Home Area 33%
	genesis_widget_area ( 'home-right-6' );
	//Position the Home Area 66%
	genesis_widget_area ( 'home-top-1-2' );
	//Position the Home Area 66%
	genesis_widget_area ( 'home-top-2-3' );
	//Position the Home Area 66%
	genesis_widget_area ( 'home-bottom-4-5' );
	//Position the Home Area 66%
	genesis_widget_area ( 'home-bottom-5-6' );
	echo '</div></section>';
}

//Position the Before Content Area
function genesischild_before_entry_widget() {
	if( is_single() ) {
	genesis_widget_area ( 'before-entry' );
	}
}

//Move Primary Navigation to Header Right without wrap
function themeprefix_modify_genesis_do_nav( $nav_output, $nav, $args ) {

	$class = 'menu genesis-nav-menu menu-primary';
	if ( genesis_superfish_enabled() )
		$class .= ' js-superfish';

	$args = array(
		'theme_location' => 'primary',
		'container'      => '',
		'menu_class'     => $class,
		'echo'           => 0,
	);

	$nav = wp_nav_menu( $args );

	//* Do nothing if there is nothing to show
	if ( ! $nav )
		return;

	$nav_markup_open = genesis_markup( array(
		'html5'   => '<nav %s id="primary-nav">',
		'xhtml'   => '<div id="nav">',
		'context' => 'nav-primary',
		'echo'    => false,
	) );

	$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';
	$nav_output = $nav_markup_open . $nav . $nav_markup_close;

	// return the modified result
	 return sprintf( $nav_output, $nav, $args );
}

// Remove Genesis Blog & Archive
function genesis_remove_blog_archive( $templates ) {
	unset( $templates['page_blog.php'] );
	unset( $templates['page_archive.php'] );
	return $templates;
}

//Allow PHP to run in Widgets
function genesis_execute_php_widgets( $html ) {
	if ( strpos( $html, "<" . "?php" ) !==false ) {
	ob_start();
	eval( "?".">".$html );
	$html=ob_get_contents();
	ob_end_clean();
		}
	return $html;
}

//Read More Button For Excerpt
function genesischild_read_more_link() {
	return '... <a href="' . get_permalink() . '" class="more-link" title="Read More">Read More</a>';
}

//Remove Author Name on Post Meta
function genesischild_post_info( $post_info ) {
	if ( !is_page() ) {
	$post_info = 'Posted on [post_date] [post_comments] [post_edit]';
	return $post_info;
	}
}

//Change the comments header
function genesischild_comment_form_defaults( $defaults ) {
	$defaults['title_reply'] = __( 'Leave a Comment' );
	return $defaults;
}

//Remove comment form HTML tags and attributes
function genesischild_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

/*Function for Facebook HTML5 Script needs to go after body - escape all inner double quotes or use alternate single quotes
function likebox_facebook_script () {
echo "";
}*/
