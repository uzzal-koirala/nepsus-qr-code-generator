<?php
/**
 * Plugin Name: Nepsus QR Code Generator
 * Plugin URI: https://github.com/uzzal-koirala/nepsus-qr-code-generator
 * Description: A lightweight QR code generator plugin that allows users to generate QR codes anywhere on their site using a simple shortcode.
 * Version: 1.0.0
 * Author: Nepsus Tech
 * Author URI: https://github.com/uzzal-koirala
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: nepsus-qr-code-generator
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/* ======================================================
   ENQUEUE ASSETS (ONLY WHEN SHORTCODE EXISTS)
   ====================================================== */
function nepsus_qr_enqueue_assets() {

    // QR core library (must load FIRST)
    wp_enqueue_script(
        'nepsus-qrcode-lib',
        plugin_dir_url(__FILE__) . 'assets/js/qrcode.min.js',
        array(),
        '1.0.0',
        true
    );

    // Your custom JS (depends on QR library)
    wp_enqueue_script(
        'nepsus-qr-script',
        plugin_dir_url(__FILE__) . 'assets/js/qr-generator.js',
        array('nepsus-qrcode-lib'),
        '1.0.0',
        true
    );

    // CSS
    wp_enqueue_style(
        'nepsus-qr-style',
        plugin_dir_url(__FILE__) . 'assets/css/qr-generator.css',
        array(),
        '1.0.0'
    );

}
add_action('wp_enqueue_scripts', 'nepsus_qr_enqueue_assets');

/* ======================================================
   SHORTCODE: [nepsus_qr_generator]
   ====================================================== */
function nepsus_qr_shortcode() {
    ob_start();
    ?>

    <div class="nepsus-qr-wrapper">
        <div class="qr-box">

            <h2>QR Code Generator</h2>

            <input
                type="text"
                id="qr-input"
                placeholder="Enter URL or text"
                autocomplete="off"
            >

            <button
                type="button"
                class="qr-btn"
                onclick="generateNepsusQR()"
            >
                Generate QR Code
            </button>

            <div id="qr-output"></div>

            <a
                id="download-btn"
                class="download-btn"
                href="#"
            >
                Download QR
            </a>

            <button
                type="button"
                id="clear-btn"
                class="clear-btn"
                onclick="clearNepsusQR()"
            >
                Clear
            </button>

        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('nepsus_qr_generator', 'nepsus_qr_shortcode');