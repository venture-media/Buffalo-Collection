<?php
/**
 * -----------------------------
 * 03 Shortcodes
 * -----------------------------
 */



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Allow shortcodes in menu item titles
add_filter( 'wp_nav_menu_items', function( $items, $args ) {
    return do_shortcode( $items );
}, 10, 2 );



function vv_last_updated_shortcode( $atts ) {
    global $post;

    $atts = shortcode_atts( array(
        'format'       => get_option( 'date_format' ),
        'label'        => '',
        'show_time'    => 'false',
        'hide_if_same' => 'false',
        'class'        => 'last-updated-date', // default CSS class
    ), $atts, 'last_updated' );

    $post_id = ( is_object( $post ) && isset( $post->ID ) ) ? $post->ID : get_the_ID();
    if ( ! $post_id ) {
        return '';
    }

    $format = $atts['format'];
    if ( strtolower( $atts['show_time'] ) === 'true' ) {
        $format = $format . ' ' . get_option( 'time_format' );
    }

    $modified  = get_the_modified_date( $format, $post_id );
    $published = get_the_date( $format, $post_id );

    if ( strtolower( $atts['hide_if_same'] ) === 'true' && $modified === $published ) {
        return '';
    }

    $output = esc_html( $atts['label'] . $modified );

    return '<span class="' . esc_attr( $atts['class'] ) . '">' . $output . '</span>';
}
add_shortcode( 'last_updated', 'vv_last_updated_shortcode' );
