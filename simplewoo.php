<?php
/**
 * simplewoo.php
 *
 * Copyright (c) 2011,2017 Antonio Blanco http://www.ablancodev.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Antonio Blanco
 * @package simplewoo
 * @since simplewoo 1.0.0
 *
 * Plugin Name: Simplewoo
 * Plugin URI: http://www.ablancodev.com
 * Description: Simple Woocommerce
 * Version: 1.0.0
 * Author: ablancodev
 * Author URI: http://www.ablancodev.com
 * Text Domain: simplewoo
 * Domain Path: /languages
 * License: GPLv3
 */
if (! defined ( 'SIMPLEWOO_CORE_DIR' )) {
	define ( 'SIMPLEWOO_CORE_DIR', WP_PLUGIN_DIR . '/simplewoo' );
}
define ( 'SIMPLEWOO_FILE', __FILE__ );

define ( 'SIMPLEWOO_PLUGIN_URL', plugin_dir_url ( SIMPLEWOO_FILE ) );

define ( 'SIMPLEWOO_PLUGIN_DOMAIN', 'simplewoo' );

class Simplewoo_Plugin {


	public static function init() {
		add_action ( 'init', array (
				__CLASS__,
				'wp_init' 
		) );
		
	}
	public static function wp_init() {
		load_plugin_textdomain ( 'simplewoo', null, 'simplewoo/languages' );

		require_once 'core/class-simplewoo-cpt.php';
		require_once 'core/class-simplewoo-metabox.php';
		
	}

}
Simplewoo_Plugin::init();
