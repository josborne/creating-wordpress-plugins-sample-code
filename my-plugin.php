<?php
/*
Plugin Name: My Example Plugin
Plugin URI: http://example.com/my-plugin
Description: A plugin example from Creating Wordpress Plugins: A Step by Step Guide
Author: Jamie Osborne
Version: 1.0
Author URI: http://jamieos.com
*/

//defines
if ( !defined('MY_PLUGIN_NAME') )
    define('MY_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if ( !defined('MY_PLUGIN_PATH') )
    define ('MY_PLUGIN_PATH', WP_PLUGIN_URL . '/' . end(explode(DIRECTORY_SEPARATOR, dirname(__FILE__))));

if ( !defined('MY_PLUGIN_DIR') )
    define('MY_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MY_PLUGIN_NAME);

if ( !defined('MY_PLUGIN_VERSION_KEY') )
    define('MY_PLUGIN_VERSION_KEY', 'myplugin_version');

if ( !defined('MY_PLUGIN_VERSION_NUM') )
    define('MY_PLUGIN_VERSION_NUM', '1.0.0');

//includes
include 'include/my-plugin-database.php';
include 'include/my-plugin-functions.php';
include 'include/my-plugin-admin.php';

//activation hooks
register_activation_hook(__FILE__, 'myplugin_setup_db');
if ( get_option('myplugin_options') == '' ) {
    register_activation_hook(__FILE__, 'myplugin_defaults');
}

function myplugin_defaults()
{
    $arr = array(
        'option1' => 'default1',
        'option2' => 'default2',
        'option3' => 'default3',
    );

    update_option('myplugin_options', $arr);
}

add_shortcode('myplugin_form', 'myplugin_user_form');
function myplugin_user_form($atts)
{
    extract(shortcode_atts(array(
        'record' => -1,
    ), $atts));

    include  'pages/myplugin_user_form.php';
}