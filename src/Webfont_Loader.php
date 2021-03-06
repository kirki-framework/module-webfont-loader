<?php
/**
 * WebFont-Loader Module.
 *
 * @see       https://github.com/typekit/webfontloader
 * @package   Kirki
 * @category  Modules
 * @author    Ari Stathopoulos (@aristath)
 * @copyright Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license  https://opensource.org/licenses/MIT
 * @since     3.0.26
 */

namespace Kirki\Module;

use Kirki\Core\Kirki;
use Kirki\URL;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds script for tooltips.
 */
class Webfont_Loader {

	/**
	 * Only load the webfont script if this is true.
	 *
	 * @static
	 * @access public
	 * @since 3.0.26
	 * @var bool
	 */
	public static $load = false;

	/**
	 * The class constructor
	 *
	 * @access public
	 * @since 3.0.26
	 */
	public function __construct() {
		add_action( 'wp_head', [ $this, 'enqueue_scripts' ], 20 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ], 20 );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @access public
	 * @since 3.0.26
	 * @return void
	 */
	public function enqueue_scripts() {
		global $wp_customize;
		if ( self::$load || $wp_customize || is_customize_preview() ) {
			wp_enqueue_script( 'webfont-loader', URL::get_from_path( __DIR__ . '/assets/scripts/vendor-typekit/webfontloader.js' ), [], '3.0.28', true );
		}
	}

	/**
	 * Set the $load property of this object.
	 *
	 * @access public
	 * @since 3.0.35
	 * @param bool $load Set to false to disable loading.
	 * @return void
	 */
	public function set_load( $load ) {
		self::$load = $load;
	}
}
