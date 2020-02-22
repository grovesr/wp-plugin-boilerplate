<?php
/*
 Plugin Name:       Wp Plugin Boilerplate
 Plugin URI:        https://example.com/plugins/the-basics/
 Description:       Handle the basics with this plugin.
 Version:           0.0.0
 Requires at least: 5.3
 Requires PHP:      7.2
 Author:            Rob Groves
 Author URI:        https://author.example.com/
 License:           GPL v2 or later
 License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain:       wp-plugin-boilerplate
 Domain Path:       /languages
 License:     GPL2

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_PLUGIN_BOILERPLATE_VERSION', '0.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-plugin-boilerplate-activator.php
 */
function activate_wp_plugin_boilerplate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-activator.php';
    Wp_Plugin_Boilerplate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-plugin-boilerplate-deactivator.php
 */
function deactivate_wp_plugin_boilerplate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-deactivator.php';
    Wp_Plugin_Boilerplate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_plugin_boilerplate' );
register_deactivation_hook( __FILE__, 'deactivate_wp_plugin_boilerplate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_wp_plugin_boilerplate() {

    $plugin = new Wp_Plugin_Boilerplate();
    $plugin->run();

}
run_wp_plugin_boilerplate();
