<?php

/**
 * Plugin Name: ROI Calculator Widget
 * Description: A form-widget for Elementor to calculate ROI. 
 * Version: 1.0.0
 * Author: andersjson
 * Text Domain: roi-calculator-widget
 */

if (!defined('ABSPATH')) exit();

include_once(plugin_dir_path( __FILE__ ) . '/includes/db.php');

/**
 * Elementor Extension main CLass
 * @since 1.0.0
 */
final class ROI_Calculator_Widget
{
    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    // Minimum PHP Version
    const MINIMUM_PHP_VERSION = '7.0';

    // Instance
    private static $_instance = null;

    /**
     * SIngletone Instance Method
     * @since 1.0.0
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Construct Method
     * @since 1.0.0
     */
    public function __construct()
    {
        // Call Constants Method
        $this->define_constants();
        add_action('wp_enqueue_scripts', [$this, 'scripts_styles']);
        //    add_action( 'init', [ $this, 'i18n' ] );
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Define Plugin Constants
     * @since 1.0.0
     */
    public function define_constants()
    {
        define('ROI_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));
        define('ROI_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
    }

    /**
     * Load Scripts & Styles
     * @since 1.0.0
     */
    public function scripts_styles()
    {
        wp_register_style('roi-calc-style', ROI_PLUGIN_URL . 'docs/styles.min.css', [], rand(), 'all');
        wp_register_script('roi-calc-script', ROI_PLUGIN_URL . 'docs/bundled.min.js', ['jquery'], rand(), true);

        wp_localize_script('roi-calc-script', 'roi_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        wp_enqueue_style('roi-calc-style');
        wp_enqueue_script('roi-calc-script');
    }

    /**
     * Load Text Domain
     * @since 1.0.0
     */
    //    public function i18n() {
    //       load_plugin_textdomain( 'roi-calculator-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    //    }

    /**
     * Initialize the plugin
     * @since 1.0.0
     */
    public function init()
    {  
        // Check if the ELementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        if (!version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        //Ladda CSS till back-end
        //function priskalkyl_back_scripts(){
        //    wp_enqueue_media();
        //    wp_register_style('priskalkyl_back_style', plugins_url('./css/backend_style.css', __FILE__));
        //    wp_enqueue_style('priskalkyl_back_style');
        //
        //    wp_register_script('priskalkyl_back_script', plugins_url('./js/backend_script.js', __FILE__), array('jquery'), '1.0');
        //    wp_enqueue_script('priskalkyl_back_script');
        //
        //    wp_register_style('google_fonts_admin', 'https://fonts.googleapis.com/css?family=Catamaran:500,700&display=swap|Exo+2:500,700&display=swap');
        //    wp_enqueue_style( 'google_fonts_admin');
        //}
        
        //Ladda CSS JS till back-end när admin-scripts laddas
        
        //add_action('admin_enqueue_scripts', 'priskalkyl_back_scripts');

        //Skapar meny i wp-admin för att komma åt admin-gränssnitt och registrerar settings i options
        function roi_calculator_create_menu(){
            add_menu_page('Roi Calculator', 'Roi Calculator', 'administrator', __FILE__, 'roi_settings_page', 'dashicons-money-alt', 20);

        }
        //Lägg till i menyn när admin_menu körs
        add_action('admin_menu', 'roi_calculator_create_menu');

        //Funktion för att visa admin-gränssnittet
        function roi_settings_page(){
            ?>
            <h1>Hello from Roi-admin!</h1>
            <?php
        }

        
        // Insert data in sql-db via ajax
        function insert_user_data()
        {
            // nonce check for an extra layer of security, the function will exit if it fails
            if ( !wp_verify_nonce( $_REQUEST['nonce'], "roi_nonce")) {
                exit("Security-issue");
            }
            
            $tz = 'Europe/Stockholm';
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone($tz));
            $dt->setTimestamp($timestamp);

            $time = $dt->format('Y-m-d H:i:s');
            $firstname = htmlentities($_POST["formdata"]["firstname"]);
            $lastname = htmlentities($_POST["formdata"]["lastname"]);
            $email = htmlentities($_POST["formdata"]["email"]);
            $phone = htmlentities($_POST["formdata"]["phone"]);

            
            global $wpdb;
            $table_name = $wpdb->prefix . "roi_formsubscribers";

            $wpdb->insert(
                $table_name, // Tabell att spara i
                array('time' => $time, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone), // Data att spara i databasen
                array('%s', '%s', '%s', '%s', '%s') //  %d = int, %s = string, %f = float
            );

            die();
        }

        //Init Ajax-functions
        add_action('wp_ajax_nopriv_insert_user_data', 'insert_user_data');
        add_action('wp_ajax_insert_user_data', 'insert_user_data');

        //Init widgets
        add_action('elementor/init', [$this, 'init_category']);
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
    }

    /**
     * Init Widgets
     * @since 1.0.0
     */
    public function init_widgets()
    {
        require_once ROI_PLUGIN_PATH . '/widgets/roi-calculator.php';
        //more widgets
    }

    /**
     * Init Category Section
     * @since 1.0.0
     */
    public function init_category()
    {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'andersjson-elementor',
            [
                'title' => 'andersjson Custom Widgets'
            ],
            1
        );
    }


    /**
     * Admin Notice
     * Warning when the site doesn't have Elementor installed or activated
     * @since 1.0.0
     */
    public function admin_notice_missing_main_plugin()
    {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated', 'roi-calculator-widget'),
            '<strong>' . esc_html__('ROI Calculator Widget', 'roi-calculator-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'roi-calculator-widget') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin Notice
     * Warning when the site doesn't have a minimum required Elementor version.
     * @since 1.0.0
     */
    public function admin_notice_minimum_elementor_version()
    {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater', 'roi-calculator-widget'),
            '<strong>' . esc_html__('ROI Calculator Widget', 'roi-calculator-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'roi-calculator-widget') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin Notice
     * Warning when the site doesn't have a minimum required PHP version.
     * @since 1.0.0
     */
    public function admin_notice_minimum_php_version()
    {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater', 'roi-calculator-widget'),
            '<strong>' . esc_html__('ROI Calculator Widget', 'roi-calculator-widget') . '</strong>',
            '<strong>' . esc_html__('PHP', 'roi-calculator-widget') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
    }
}

ROI_Calculator_Widget::instance();
