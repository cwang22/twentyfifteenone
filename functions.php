<?php
function one_enqueue_styles() {
	wp_enqueue_style('google-font', '//fonts.googleapis.com/css?family=Noto+Serif+SC');
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'bootstrap-collapse', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.0.8/css/all.css', [], '5.0.8' );
	wp_enqueue_style( 'highlight-css', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css', [], '9.12.0' );
	wp_enqueue_style( 'highlight-css-atom-one-dark', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css', [ 'highlight-css' ], '9.12.0' );
	wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', [ 'jquery' ], '3.3.4', true );
	wp_enqueue_script( 'highlight-js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js', [], '9.12.0', true );
	wp_enqueue_script( 'medium-zoom', '//unpkg.com/medium-zoom@0.4.0/dist/medium-zoom.min.js', [], '0.4.0', true );
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js', [ 'highlight-js', 'medium-zoom' ], '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'one_enqueue_styles' );

function one_dequeue_styles() {
	wp_dequeue_style( 'algolia-instantsearch' );
}

add_action( 'wp_print_styles', 'one_dequeue_styles', 100 );

function one_enqueue_jquery_in_footer( &$scripts ) {
	if ( is_admin() ) {
		return;
	}
	$scripts->registered['jquery']->args         = 1;
	$scripts->registered['jquery-core']->args    = 1;
	$scripts->registered['jquery-migrate']->args = 1;
}

add_action( 'wp_default_scripts', 'one_enqueue_jquery_in_footer', 11 );

function one_spoiler_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		[ 'title' => 'spoiler' ],
		$atts,
		'spoiler'
	);

	$href  = "spoiler-" . substr( md5( $content ), 0, 8 );
	$title = __( $atts['title'], 'twentyfifteenone' );

	return <<<EOD
	<p><a data-toggle="collapse" href="#{$href}" aria-expanded="true" aria-controls="{$href}">{$title}</a></p>
	<div class="collapse spoiler" id="{$href}" aria-expanded="true">{$content}</div>
EOD;
}

add_shortcode( 'spoiler', 'one_spoiler_shortcode' );

