<?php
/**
 * Plugin
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   GPL-2.0-or-later
 * @package   SolveBeam\WordPressBootstrapPagination
 */

declare(strict_types=1);

namespace SolveBeam\WordPressBootstrapPagination;

use WP_HTML_Tag_Processor;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Instance.
	 */
	private static ?self $instance = null;

	/**
	 * Construct plugin.
	 */
	private function __construct() {
		$this->register_hooks();
	}

	/**
	 * Return instance of this class.
	 */
	public static function instance(): self {
		return self::$instance ??= new self();
	}

	/**
	 * Register hooks.
	 */
	private function register_hooks(): void {
		\add_filter( 'paginate_links_output', $this->paginate_links_output( ... ), 10, 2 );
	}

	/**
	 * Filter `paginate_links()` output.
	 *
	 * @param string                $output The HTML output of `paginate_links()`.
	 * @param array<string, string> $args   The arguments passed to `paginate_links()`.
	 * @return string The filtered HTML output.
	 */
	private function paginate_links_output( string $output, array $args ): string {
		if ( ! isset( $args['type'] ) ) {
			return $output;
		}

		if ( 'list' !== $args['type'] ) {
			return $output;
		}

		$html_processor = new WP_HTML_Tag_Processor( $output );

		if ( $html_processor->next_tag(
			[
				'tag_name'   => 'ul',
				'class_name' => 'page-numbers',
			]
		) ) {
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
	}
}
