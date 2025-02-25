<?php
if (!defined('ABSPATH')) exit;

function ai_fetch_image($keyword) {
    $unsplash_api_key = get_option('unsplash_access_key', '');

    if (!$unsplash_api_key) {
        return "https://via.placeholder.com/800x600"; // Default fallback image
    }

    $response = wp_remote_get("https://api.unsplash.com/photos/random?query=" . urlencode($keyword) . "&client_id=" . $unsplash_api_key);

    if (is_wp_error($response)) {
        return "https://via.placeholder.com/800x600"; // Fallback if Unsplash fails
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($body['urls']['regular'])) {
        return esc_url($body['urls']['regular']);
    }

    return "https://via.placeholder.com/800x600"; // Fallback image
}
?>
