<?php
if (!defined('ABSPATH')) {
    exit;
}

// Generate and Publish Bulk Posts
function uag_generate_bulk_posts($post_count, $category_id) {
    $category = get_cat_name($category_id);

    for ($i = 0; $i < $post_count; $i++) {
        $title = uag_generate_random_title($category);
        $content = uag_generate_article_content($title, $category);
        $meta_title = uag_generate_meta_title($title);
        $meta_description = uag_generate_meta_description($title);
        $image_url = uag_fetch_image($category);

        $post_data = array(
            'post_title'    => wp_strip_all_tags($title),
            'post_content'  => "<img src='$image_url' alt='" . esc_attr($category) . "'><p>$content</p>",
            'post_status'   => 'publish',
            'post_category' => array($category_id),
            'post_type'     => 'post',
            'meta_input'    => array(
                'meta_title'       => $meta_title,
                'meta_description' => $meta_description
            )
        );

        wp_insert_post($post_data);
    }

    echo '<div class="updated"><p><strong>' . esc_html($post_count) . ' posts created successfully!</strong></p></div>';
}
?>
