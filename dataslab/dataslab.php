<?php
/*
   Plugin Name: Data Slab
   Plugin URI: https://viveksingh.com
   description: Data Slab help you to create tables of User Data very conveniently.
   Version: 1.0.0
   Author: Vivek Singh
   Author URI: https://viveksingh.com/
*/


// Defining constants used in the plugin.
define( 'PLUGIN_URL', plugin_dir_url( __FILE__) );
define( 'PLUGIN_PATH',  __DIR__ );
define( 'DATASLAB_VERSION', '1.0.0' );

// Create a new table
function dataslab_table()
{

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $tablename = $wpdb->prefix . "dataslab";

    $sql = "CREATE TABLE $tablename (
  id mediumint(11) NOT NULL AUTO_INCREMENT,
  name varchar(80) NOT NULL,
  username varchar(80) NOT NULL,
  email varchar(80) NOT NULL,
  phone varchar(80) NOT NULL,
  PRIMARY KEY  (id)
  ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'dataslab_table');


// Including assets for admin
function plugin_admin_assets_include() {
    // adding stylesheet
    wp_enqueue_style( 'dataslab', PLUGIN_URL . 'assets/css/admin-style.css', false );

    // adding script
    wp_enqueue_script( 'dataslab', PLUGIN_URL . 'assets/js/admin-script.js', array( 'jquery' ), DATASLAB_VERSION, true );

    // Adding variable for use in js
    wp_localize_script(
        'dataslab',
        'dataslab',
        array(
            'ajax_url'          => admin_url( 'admin-ajax.php' ),
            'plugin_version'    => DATASLAB_VERSION,
            'loading_html'      => '<div class="dataslab-loading"><img src="'. PLUGIN_URL . 'assets/img/loading.gif"></div>'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'plugin_admin_assets_include' );


// Adding assets for public.
function plugin_public_assets_include() {
    // adding stylesheet
    wp_enqueue_style( 'dataslab', PLUGIN_URL . 'assets/css/public-style.css', false );
}
add_action( 'wp_enqueue_scripts', 'plugin_public_assets_include' );


// Add menu
function dataslab_menu()
{

    add_menu_page("Data Slab", "Data Slab", "manage_options", "myplugin", "displayList", PLUGIN_URL . 'assets/img/icon3.svg');
    add_submenu_page("myplugin", "All Entries", "All entries", "manage_options", "allentries", "displayList");
    add_submenu_page("myplugin", "Add new Entry", "Add new Entry", "manage_options", "addnewentry", "addEntry");
}
add_action("admin_menu", "dataslab_menu");

function displayList()
{
    include "displaylist.php";
}

function addEntry()
{
    include "addentry.php";
}


// Handling ajax update request
add_action( 'wp_ajax_dataslab_update_user', 'update_user_data' );
// add_action( 'wp_ajax_nopriv_', '' );

function update_user_data() {
    include( PLUGIN_PATH . '/includes/update_user_data.php' );
}
 
// Creating shortcode for displaying all entries.
add_shortcode( 'dataslab_all_entries', 'shortcode_display_entry' );
function shortcode_display_entry() {
    ob_start();
    include( PLUGIN_PATH . '/includes/shortcode_display_entry.php' );
    $html = ob_get_clean();
    return $html;
}