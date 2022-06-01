<?php
/**
 * Plugin Name:       Gutenberg Parcel Example
 * Description:       A Gutenberg block to show your pride! This block enables you to type text and style it with the color font Gilbert from Type with Pride.
 * Version:           0.1.0
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gutenpride
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function dynamic_block_example_render( $attributes ) {
	$title = $attributes['title'];
	$author = $attributes['author'];
	$summary = $attributes['summary'];

	return <<<HTML
		<div class="my-book-block">
			<h3>$title</h3>
			<p>$author</p>
			<p>$summary</p>
		</div>
HTML;
}

function dynamic_block_example_init() {
	$index_css_ver = filemtime( plugin_dir_path(__FILE__) . 'build/index.css' );
	$index_js_ver  = filemtime( plugin_dir_path(__FILE__) . 'build/index.js' );

	wp_register_script(
		'dynamic-block-example-js',
		plugins_url('build/index.js', __FILE__),
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor' ],
		$index_js_ver
	);

	wp_register_style(
		'dynamic-block-example-css',
		plugins_url('build/index.css', __FILE__),
		[],
		$index_css_ver
	);

	register_block_type( 'my/book', [

		'attributes' => [
			'title'   => [ 'type' => 'string', 'default' => '' ],
			'author'  => [ 'type' => 'string', 'default' => '' ],
			'summary' => [ 'type' => 'string', 'default' => '' ]
		],
		'editor_script' => 'dynamic-block-example-js',
		'style' => 'dynamic-block-example-css',

		'render_callback' => 'dynamic_block_example_render'
	] );
}
add_action( 'init', 'dynamic_block_example_init' );
