<?php
function custom_svg_favicon() {
    echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/favicon.svg" type="image/svg+xml">';
}
add_action('wp_head', 'custom_svg_favicon');
