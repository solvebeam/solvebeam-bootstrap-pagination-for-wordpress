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


namespace SolveBeam\WordPressBootstrapPagination;

use WP_HTML_Tag_Processor;

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
\add_filter(
	'paginate_links_output',
	static function ( string $output, array $args ) : string {
		if ( ! isset( $args['type'] ) ) {
			return $output;
		}

		if ( 'list' !== $args['type'] ) {
			return $output;
		}

		$html_processor = new WP_HTML_Tag_Processor( $output );

		if ( $html_processor->next_tag( [ 'tag_name' => 'ul', 'class_name' => 'page-numbers' ] ) ) {
			$html_processor->add_class( 'pagination' );

			while ( $html_processor->next_tag( [ 'tag_name' => 'li' ] ) ) {
				$li_classes = [];

				$html_processor->set_bookmark( 'li-tag' );

				$html_processor->add_class( 'page-item' );

				if ( $html_processor->next_tag( [ 'class_name' => 'page-numbers' ] ) ) {
					$html_processor->add_class( 'page-link' );

					if ( $html_processor->has_class( 'current' ) ) {
						$li_classes[] = 'active';
					}

					if ( $html_processor->has_class( 'dots' ) ) {
						$li_classes[] = 'disabled';
					}
				}

				if ( \count( $li_classes ) > 0 && $html_processor->seek( 'li-tag' ) ) {
					foreach ( $li_classes as $li_class ) {
						$html_processor->add_class( $li_class );
					}
				}

				$html_processor->release_bookmark( 'li-tag' );
			}

			$output = \sprintf(
				'<nav aria-label="%s">%s</nav>',
				\__( 'Page navigation', 'solvebeam-bootstrap-pagination' ),
				$html_processor->get_updated_html()
			);
		}

		return $output;
	},
	10,
	2
);
