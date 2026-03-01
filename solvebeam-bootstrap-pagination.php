<?php
/**
 * SolveBeam Bootstrap Pagination for WordPress
 *
 * @package SolveBeam\WordPressBootstrapPagination
 * @author SolveBeam
 * @copyright 2026 SolveBeam
 * @license proprietary
 *
 * @wordpress-plugin
 * Plugin Name:       SolveBeam Bootstrap Pagination
 * Plugin URI:        https://www.solvebeam.com/wordpress/plugins/solvebeam-bootstrap-pagination/
 * Description:       Transforms the default WordPress `paginate_links()` output into Bootstrap 5 pagination component markup using the WordPress HTML API.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.2
 * Author:            SolveBeam
 * Author URI:        https://www.solvebeam.com/
 * Text Domain:       solvebeam-bootstrap-pagination
 * Domain Path:       /languages/
 * License:           proprietary
 * License URI:       https://www.solvebeam.com/
 * Update URI:        https://www.solvebeam.com/wordpress/plugins/solvebeam-bootstrap-pagination/
 */

declare(strict_types=1);

namespace SolveBeam\WordPressBootstrapPagination;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload.
 */
$autoload_path = __DIR__ . '/vendor/autoload_packages.php';

if ( file_exists( $autoload_path ) ) {
	require_once $autoload_path;
}

/**
 * Bootstrap.
 */
Plugin::instance();
