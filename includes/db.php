<?php

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

?>