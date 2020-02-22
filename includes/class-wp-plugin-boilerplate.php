<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 */
class Wp_Plugin_Boilerplate {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct() {
        if ( defined( 'WP_PLUGIN_BOILERPLATE_VERSION' ) ) {
            $this->version = WP_PLUGIN_BOILERPLATE_VERSION;
        } else {
            $this->version = '0.0.0';
        }
        $this->plugin_name = 'wp-plugin-boilerplate';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Wp_Plugin_Boilerplate_Loader. Orchestrates the hooks of the plugin.
     * - Wp_Plugin_Boilerplate_i18n. Defines internationalization functionality.
     * - Wp_Plugin_Boilerplate_Admin. Defines all hooks for the admin area.
     * - Wp_Plugin_Boilerplate_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-plugin-boilerplate-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-plugin-boilerplate-i18n.php';

        /**
         * The class responsible for registering all actions that occur accross public and admin areas
         * of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'common/class-wp-plugin-boilerplate-common.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-plugin-boilerplate-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-plugin-boilerplate-public.php';

        $this->loader = new Wp_Plugin_Boilerplate_Loader();
        $this->common = new Wp_Plugin_Boilerplate_Common();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Wp_Plugin_Boilerplate_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     */
    private function set_locale() {

        $plugin_i18n = new Wp_Plugin_Boilerplate_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     */
    private function define_common_hooks() {

        $plugin_common = new Wp_Plugin_Boilerplate_Common( $this->get_plugin_name(), $this->get_version() );
        $plugin_common->register_styles();
        $plugin_common->register_scripts();

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     */
    private function define_admin_hooks() {

        $plugin_admin = new Wp_Plugin_Boilerplate_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     */
    private function define_public_hooks() {

        $plugin_public = new Wp_Plugin_Boilerplate_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     */
    public function get_version() {
        return $this->version;
    }

}
