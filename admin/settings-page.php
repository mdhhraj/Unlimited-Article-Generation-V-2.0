<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add menu page
function uag_admin_menu() {
    add_menu_page(
        'Unlimited Article Generator',
        'AI Article Generator',
        'manage_options',
        'unlimited-article-generator',
        'uag_admin_settings_page',
        'dashicons-admin-generic',
        20
    );
}
add_action('admin_menu', 'uag_admin_menu');

// Settings Page
function uag_admin_settings_page() {
    ?>
    <div class="wrap">
        <h1>Unlimited Article Generator</h1>
        <form method="post" action="">
            <?php wp_nonce_field('uag_generate_nonce', 'uag_nonce'); ?>
            
            <label for="post_count">Number of Posts:</label>
            <input type="number" name="post_count" id="post_count" value="10" min="1" max="50" required>
            <br><br>

            <label for="category">Select Category:</label>
            <select name="category" id="category">
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                }
                ?>
            </select>
            <br><br>

            <input type="submit" name="generate_posts" value="Generate Posts" class="button button-primary">
        </form>
    </div>
    <?php

    if (isset($_POST['generate_posts'])) {
        if (!isset($_POST['uag_nonce']) || !wp_verify_nonce($_POST['uag_nonce'], 'uag_generate_nonce')) {
            wp_die('Security check failed.');
        }

        $post_count = intval($_POST['post_count']);
        $category_id = intval($_POST['category']);

        uag_generate_bulk_posts($post_count, $category_id);
    }
}
?>
