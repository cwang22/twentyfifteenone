<?php
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap-collapse', get_stylesheet_directory_uri().'/css/bootstrap.css' );
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
    wp_enqueue_script( 'run_prettify-js', '//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js', array(), '20160518', true );
    wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', true);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_add_prettify_pre_class( $content ) {
    return str_replace( '<pre>', '<pre class="prettyprint">', $content );
}
add_filter( 'the_content', 'theme_add_prettify_pre_class' );

function spoiler_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => 'spoiler',
		), $atts, 'spoiler' );
    $href ="spoiler-".substr(md5($content), 0, 8);
	return '<p><a data-toggle="collapse" href="#'.$href.'" aria-expanded="true" aria-controls="'.$href.'">'.__($atts['title'],'twentyfifteenone').'</a></p>
			<div class="collapse spoiler" id="'.$href.'" aria-expanded="true">'.$content.'</div>';
}
add_shortcode( 'spoiler', 'spoiler_shortcode' );
?>
