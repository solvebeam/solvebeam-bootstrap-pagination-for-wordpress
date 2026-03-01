# SolveBeam Bootstrap Pagination for WordPress

Transforms the default WordPress `paginate_links()` output into Bootstrap 5 pagination component markup using the WordPress HTML API.

## Description

This plugin uses the WordPress HTML API to transform the default `paginate_links()` HTML output into a Bootstrap 5 compatible pagination component. It ensures that the pagination markup is clean and integrates seamlessly with Bootstrap-based themes.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/solvebeam-bootstrap-pagination` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.

## Development

This plugin is developed with modern PHP standards and WordPress best practices.

### Requirements

- PHP 8.2+
- Composer
- Node.js & npm

### Local Development (wp-env)

You can use `@wordpress/env` to start a local development environment:

```bash
npm run env:start
```

Stop the environment:

```bash
npm run env:stop
```

### Build Instructions

To build the plugin for distribution, run:

```bash
composer build
```

This will run PHPCS, PHPStan, and Psalm before creating a clean distribution archive in the `build/` directory.

## PHP Version Requirement

- Minimum PHP: 8.2

## License

GPL-2.0-or-later

## Links

- https://getbootstrap.com/docs/5.3/components/pagination/
- https://developer.wordpress.org/reference/functions/paginate_links/
- https://developer.wordpress.org/reference/hooks/paginate_links_output/
- https://make.wordpress.org/core/2023/03/07/introducing-the-html-api-in-wordpress-6-2/
- https://developer.wordpress.org/news/2023/09/the-html-api-process-your-tags-not-your-pain/
- https://make.wordpress.org/core/tag/html-api/
