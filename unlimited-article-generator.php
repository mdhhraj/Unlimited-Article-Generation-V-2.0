<?php
/**
 * Plugin Name: Unlimited Article Generation
 * Plugin URI: https://wpdeveloper.holeiholo.com
 * Description: Automatically generates and publishes AI-powered articles with SEO-optimized meta data and images.
 * Version: 2.0
 * Author: Hasibul Hasan Rajib
 * Author URI: https://hasibulhasan.holeiholo.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: unlimited-article-generator
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/ai-generator.php';
require_once plugin_dir_path(__FILE__) . 'includes/post-creator.php';

// Enqueue styles & Bootstrap
function uag_enqueue_admin_assets($hook) {
    if ($hook !== 'toplevel_page_unlimited-article-generator') {
        return;
    }
    wp_enqueue_style('uag-admin-css', plugin_dir_url(__FILE__) . 'assets/styles.css');
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'uag_enqueue_admin_assets');
?>
