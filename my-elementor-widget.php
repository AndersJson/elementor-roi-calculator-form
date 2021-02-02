<?php

/**
 * Plugin Name: ROI Calculator Widget
 * Description: A form-widget for Elementor to calculate ROI. 
 * Version: 1.0.0
 * Author: andersjson
 * Text Domain: roi-calculator-widget
 */

if (!defined('ABSPATH')) exit();

global $roi_db_version;
$roi_db_version = '1.0';

    /* Skapa tabell i SQL-db för ROI formsubscribes */
    function roi_calculator_create_db() {
        global $wpdb;
        global $roi_db_version;

        $table_name = $wpdb->prefix . "roi_formsubscribers";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                `id` int NOT NULL AUTO_INCREMENT,
                `time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                `firstname` varchar(255) CHARACTER SET utf8 NOT NULL,
                `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
                `email` varchar(255) CHARACTER SET utf8 NOT NULL,
                `phone` varchar(255) CHARACTER SET utf8,
                PRIMARY KEY (`id`)
            ) $charset_collate; ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
        
        add_option( 'roi_db_version', $roi_db_version );

        //Kolla om ny version av db finns
        $installed_ver = get_option( "roi_db_version" );

        if ( $installed_ver != $roi_db_version ) {

            $table_name = $wpdb->prefix . "roi_formsubscribers";

            $sql = "CREATE TABLE $table_name (
                `id` int NOT NULL AUTO_INCREMENT,
                `time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                `firstname` varchar(255) CHARACTER SET utf8 NOT NULL,
                `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
                `email` varchar(255) CHARACTER SET utf8 NOT NULL,
                `phone` varchar(255) CHARACTER SET utf8,
                PRIMARY KEY (`id`)
            );";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            update_option( "roi_db_version", $roi_db_version );
        }
    }

    /* Kör funktion för att skapa databas när plugin aktiveras. */
    register_activation_hook(__FILE__, 'roi_calculator_create_db');

//Kör update-check i plugins_loaded -hook
function roi_update_db_check() {
    global $roi_db_version;
    
    if ( get_site_option( 'roi_db_version' ) != $roi_db_version ) {
        roi_calculator_create_db();
    }
}

add_action( 'plugins_loaded', 'roi_update_db_check' );


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
        wp_register_style('roi-calc-style', ROI_PLUGIN_URL . 'docs/appstyles.min.css', [], rand(), 'all');
        wp_register_script('roi-calc-script', ROI_PLUGIN_URL . 'docs/app.min.js', ['jquery'], rand(), true);

        wp_localize_script('roi-calc-script', 'roi_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        wp_enqueue_style('roi-calc-style');
        wp_enqueue_script('roi-calc-script');
    }


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
        function roi_calculator_admin_scripts($hook){ 

            if ( 'toplevel_page_roi-elementor-widget/my-elementor-widget' != $hook ) {
                return;
            }
            
            wp_enqueue_media();
            wp_register_style('roi-calc-admin-style', ROI_PLUGIN_URL . 'docs/adminstyles.min.css', [], rand(), 'all');
            wp_register_script('roi-calc-admin-script', ROI_PLUGIN_URL . 'docs/admin.min.js', ['jquery'], rand(), true);

            wp_localize_script('roi-calc-admin-script', 'roi_admin_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
            wp_enqueue_style('roi-calc-admin-style');
            wp_enqueue_script('roi-calc-admin-script');
        }
        
        //Ladda CSS JS till back-end när admin-scripts laddas        
        add_action('admin_enqueue_scripts', 'roi_calculator_admin_scripts');

        //Skapar meny i wp-admin för att komma åt admin-gränssnitt och registrerar settings i options
        function roi_calculator_create_menu(){
            add_menu_page('Roi Calculator', 'Roi Calculator', 'administrator', __FILE__, 'roi_settings_page', 'dashicons-money-alt', 20);

        }
        //Lägg till i menyn när admin_menu körs
        add_action('admin_menu', 'roi_calculator_create_menu');

        //Funktion för att visa admin-gränssnittet
        function roi_settings_page(){
            if ( ! defined( 'ABSPATH' ) ) {
                exit;
            }

            if ( is_admin() && is_user_logged_in() ){ 
            ?>
                <div class="roi-admin-header">
                <div class="roi-admin-header__title">
                    <h1>ROI-Calculator</h1>
                    <div class="roi-admin-header__description">
                        <p class="roi-admin-header__subtitle">Listing data from users who has submitted the ROI-calculator.</p>
                        <p class="roi-admin-header__timezone">(Time of the submitted form is in local Europe/Stockholm-timezone)</p>
                    </div>
                </div>
                <div class="roi-admin-header__tools">
                    <div class="roi-admin-header__show">
                        <div class="roi-admin-header__display">
                            <span>Showing posts:</span>
                            <span class="roi-admin-header__count">
                                <span id="roi-showing-count">0</span> / 
                                <span id="roi-total-count">0</span>
                            </span>
                        </div>
                        <span class="roi-admin-header__button" id="roi-show-all">Show all</span>
                        <div class="roi-admin-header__filter">
                            <label class="roi-flex roi-flex-center">
                                <input type="checkbox" id="roi-filter-unique" name="filter-unique" value="filter-unique" />
                                <span class="roi-admin-header__checkbox-text">Filter by unique email</span>
                            </label>
                        </div>
                    </div>
                    <div class="roi-admin-header__controls roi-hidden" id="roi-admin-controls">
                        <span class="roi-admin-header__button">Mail selected (<span id="roi-mail-count"></span>)</span>
                        <span class="roi-admin-header__button">Delete selected (<span id="roi-delete-count"></span>)</span>
                    </div>
                </div>
                    
                </div>
                <div class="roi-admin-wrapper">
                    <div class="roi-admin-inner-wrapper">
                    <!--
                    <div class="roi-admin-loading">
                        <div class="roi-admin-loading__icon">

                        </div>
                    </div>
                    -->
                        <div class="roi-admin-table" id="roi-table">
                    <?php
                        echo '<div class="roi-admin-table__row">';
                        echo '<div class="roi-admin-table__check-cell"><label><input type="checkbox" id="checkbox-select-all" class="checkbox__input--select-all" name="selected-all" value="selected-all" /><span class="checkbox__icon"><svg class="checkbox__checkmark"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-check', dirname(__FILE__) ) ) . '"></use></svg></span></label></div><div class="roi-admin-table__cell"><h3>Time</h3></div><div class="roi-admin-table__cell"><h3>Firstname</h3></div><div class="roi-admin-table__cell"><h3>Lastname</h3></div><div class="roi-admin-table__cell"><h3>Email</h3></div><div class="roi-admin-table__cell"><h3>Phone</h3></div><div class="roi-admin-table__options-cell"></div>';
                        echo '</div>';
                        
                    ?>
                        </div>
                        <div class="roi-admin-footer">
                            <div class="show-more" id="roi-show-more">
                                <span class="show-more__text">Show more</span>
                                <?php
                                echo '<span class="show-more__iconwrapper"><svg class="show-more__icon"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-chevron-thin-down', dirname(__FILE__) ) ) . '"></use></svg></span>';
                                ?>
                            </div> 
                        </div>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <p>You need to login...</p>
                <?php
            }
            
        }


        // Get data in admin Ajax
        function get_user_data(){           
            
            // Initialize
            if ( isset($_POST['init']) &&  $_POST['init'] == 'yes'){
                global $wpdb;
                $table = $wpdb->prefix . "roi_formsubscribers";

                $output['count'] = stripslashes_deep($wpdb->get_var("SELECT COUNT(*) FROM $table ORDER BY time DESC LIMIT 10"));
                $output['output'] = ''; 
                $subscribers = $wpdb->get_results("SELECT * FROM $table ORDER BY time DESC LIMIT 10");
                
                foreach ( $subscribers as $subscriber ) {                    
                    $output['output'] .= '<div class="roi-admin-table__row"  data-id="' . $subscriber->id .'">';
                    $output['output'] .= '<label class="roi-admin-table__row--label"><div class="roi-admin-table__check-cell"><input type="checkbox" id="checkbox-' . $subscriber->id . '" class="checkbox__input" name="selected-' . $subscriber->id .'" value="' . $subscriber->id .'" /><span class="checkbox__icon"><svg class="checkbox__checkmark"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-check', dirname(__FILE__) ) ) . '"></use></svg></span></div><div class="roi-admin-table__cell"><p>' . $subscriber->time . '</p></div><div class="roi-admin-table__cell"><p>' . $subscriber->firstname . '</p></div><div class="roi-admin-table__cell"><p>' . $subscriber->lastname . '</p></div><div class="roi-admin-table__cell"><p>' . $subscriber->email . '</p></div><div class="roi-admin-table__cell"><p>' . $subscriber->phone . '</p></div></label><div class="roi-admin-table__options-cell"><span class="roi-options__iconwrapper"><svg class="roi-options__icon roi-icon-phone" data-phone="' . $subscriber->phone . '"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-phone', dirname(__FILE__) ) ) . '"></use></svg></span><span class="roi-options__iconwrapper"><svg class="roi-options__icon roi-icon-mail" data-mail="' . $subscriber->email . '"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-mail', dirname(__FILE__) ) ) . '"></use></svg></span><span class="roi-options__iconwrapper" id="roi-delete"><svg class="roi-options__icon" data-id="' . $subscriber->id . '"><use xlink:href="' . esc_url( plugins_url( 'roi-elementor-widget/app/adminsprite.svg#icon-trash', dirname(__FILE__) ) ) . '"></use></svg></span></div>';
                    $output['output'] .= '</div>';                                    
                }

                $output['subscribers'] = $subscribers;
                $output['last'] = end($subscribers);     
                
                echo json_encode($output);
                die();
            
            } else if ( $_POST['unique'] == 'yes'){
                $output["message"] = "unique";
                echo json_encode($output);

                die();

            }else if ( $_POST['unique'] == 'no'){
                $output["message"] = "All";
                echo json_encode($output);

                die();
            } 
            
        }
        
        
        // Insert data in sql-db via ajax
        function insert_user_data()
        {
            // nonce check for an extra layer of security, the function will exit if it fails
            if ( !wp_verify_nonce( $_REQUEST['nonce'], "roi_nonce")) {
                exit("Security-issue");
            }

            if ($_POST['formdata']['firstname'] == "" || 
                $_POST['formdata']['lastname'] == "" ||
                $_POST['formdata']['email'] == "" ||
                $_POST['formdata']['phone'] == "" ||
                !isset($_POST['formdata']['firstname']) || 
                !isset($_POST['formdata']['lastname']) ||
                !isset($_POST['formdata']['email']) ||
                !isset($_POST['formdata']['phone'])
            ){
                exit("Invalid data");
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
        //Admin Ajax
        add_action('wp_ajax_get_user_data', 'get_user_data');

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
