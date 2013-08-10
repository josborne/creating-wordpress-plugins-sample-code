<?php

//Setup hooks and functions for admin menu
add_action('admin_init', 'myplugin_admin_init');
add_action('admin_menu', 'myplugin_menu_pages');

function myplugin_admin_init()
{
    wp_register_script('myplugin-js', MY_PLUGIN_PATH . '/js/myplugin-admin.js');
    wp_register_style('myplugin-css', MY_PLUGIN_PATH . '/css/myplugin-admin.css');
}

function myplugin_menu_pages()
{
    // Add the top-level admin menu
    $page_title = 'My Plugin Settings';
    $menu_title = 'My Plugin';
    $capability = 'manage_options';
    $menu_slug = 'myplugin-settings';
    $function = 'myplugin_settings';
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);

    // Add submenu page with same slug as parent to ensure no duplicates
    $sub_menu_title = 'Settings';
    $menu_hook = add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);
    //this ensures script/styles only loaded for this plugin admin pages
    add_action('admin_print_scripts-' . $menu_hook, 'myplugin_admin_scripts');

    $submenu_page_title = 'My Plugin Page 1';
    $submenu_title = 'Page 1';
    $submenu_slug = 'myplugin-page1';
    $submenu_function = 'myplugin_page1';
    $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
    add_action('admin_print_scripts-' . $menu_hook, 'myplugin_admin_scripts');

    $submenu_page_title = 'My Plugin Page 2';
    $submenu_title = 'Page 2';
    $submenu_slug = 'myplugin-page2';
    $submenu_function = 'myplugin_page2';
    $menu_hook = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
    add_action('admin_print_scripts-' . $menu_hook, 'myplugin_admin_scripts');
}

function myplugin_admin_scripts()
{
    wp_enqueue_script('myplugin-js');
    wp_localize_script('myplugin-js', 'admin_ajaxurl', admin_url('admin-ajax.php'));
    wp_enqueue_style('myplugin-css');
}

function myplugin_settings()
{
    if ( !current_user_can('manage_options') ) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    include MY_PLUGIN_DIR . '/pages/myplugin_admin_page.php';
}

function myplugin_page1()
{
    if ( !current_user_can('manage_options') ) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    include MY_PLUGIN_DIR . '/pages/myplugin_admin_page_1.php';
}

function myplugin_page2()
{
    if ( !current_user_can('manage_options') ) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    include MY_PLUGIN_DIR . '/pages/myplugin_admin_page_2.php';
}