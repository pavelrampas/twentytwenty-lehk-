<?php

function my_wp_enqueue_scripts() {
    wp_enqueue_style( 'twentytwenty-light', get_theme_file_uri( '/style.css' ) );

	// dequeue styles
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'twentytwenty-print-style' );
	wp_dequeue_style( 'twentytwenty-style' );

	// dequeue scripts
	wp_dequeue_script( 'twentytwenty-js' );
	wp_dequeue_script( 'twentytwenty-block-editor-script' );
	wp_dequeue_script( 'twentytwenty-customize' );
	wp_dequeue_script( 'twentytwenty-color-calculations' );
	wp_dequeue_script( 'twentytwenty-customize-controls' );
	wp_dequeue_script( 'twentytwenty-customize-preview' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_dequeue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_wp_enqueue_scripts', 11 );

/**
 * Disable embeds and other inline scripts.
 */
function disable_embeds_code_init() {
	if ( ! is_admin() ) {
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'wp_head', 'twentytwenty_no_js_class' );
		remove_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );
	}
}
add_action( 'init', 'disable_embeds_code_init', 11 );

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'embed_head', 'print_emoji_detection_script' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis', 11 );
