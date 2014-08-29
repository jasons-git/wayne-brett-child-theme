<?php

/************************************************
* @package WayneBrettMetroChildTheme
* @authors  Nate Lewis & Jason Lewis
* @license GPL-2.0+
* @link    http://practicalit.info/
************************************************/
// original author - NeilGee
// original authors URI - http://coolestguidesontheplanet.com/

// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//Add Hero Widget Just to Front Page
add_action( 'genesis_after_header','genesischild_hero_widget', 5 );
add_action( 'genesis_after_header','genesischild_homecontent_widget');


//Run Custom Genesis with no inner content
/**
 * Remove Inner Home Page Content on a Genesis Theme
 *
 * @package   Genesis Custom Front Page - No Inner Content
 * @author    Neil Gee
 * @link      http://coolestguidesontheplanet.com/
 * @copyright (c)2014, Neil Gee
 */

cgp_genesis_no_content();

function cgp_genesis_no_content() {
	cgp_genesis_header();
	cgp_genesis_footer();
}

//Customised Genesis Header
function cgp_genesis_header() {
	do_action( 'genesis_doctype' );
	do_action( 'genesis_title' );
	do_action( 'genesis_meta' );

	wp_head(); //* we need this for plugins
	?>
	</head>
	<?php
	genesis_markup( array(
		'html5'   => '<body %s>',
		'xhtml'   => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),
		'context' => 'body',
	) );
	do_action( 'genesis_before' );

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="wrap">',
		'context' => 'site-container',
	) );

	do_action( 'genesis_before_header' );
	do_action( 'genesis_header' );
	do_action( 'genesis_after_header' );

	//genesis_markup( array(
		//'html5'   => '<div %s>',
		//'xhtml'   => '<div id="inner">',
		//'context' => 'site-inner',
	//) );
	//genesis_structural_wrap( 'site-inner' );
}

//Customised Genesis Footer
function cgp_genesis_footer() {
	//genesis_structural_wrap( 'site-inner', 'close' );
	//echo '</div>'; //* end .site-inner or #inner

	do_action( 'genesis_before_footer' );
	do_action( 'genesis_footer' );
	do_action( 'genesis_after_footer' );

	echo '</div>'; //* end .site-container or #wrap

	do_action( 'genesis_after' );
	wp_footer(); //* we need this for plugins
	?>
	</body>
	</html>
<?php
	}


//genesis();
