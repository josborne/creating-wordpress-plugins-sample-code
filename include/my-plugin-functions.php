<?php

add_action('wp_print_scripts', 'myplugin_load_js');
function myplugin_load_js()
{
    wp_enqueue_script('myplugin-user-js', MY_PLUGIN_PATH . '/js/myplugin.js', array('jquery'));
    wp_localize_script('myplugin-user-js', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_print_styles', 'myplugin_load_css');
function myplugin_load_css()
{
    wp_enqueue_style('myplugin-user-css', MY_PLUGIN_PATH . '/css/myplugin.css');
}

add_action('wp_ajax_myplugin_update_settings', 'myplugin_update_settings');
function myplugin_update_settings()
{
    $option1 = $_POST['option1'];
    $option2= $_POST['option2'];
    $option3 = $_POST['option3'];

    // Save the options
    $options = get_option('myplugin_options');
    $options['option1'] = $option1;
    $options['option2'] = $option2;
    $options['option3'] = $option3;
    update_option('myplugin_options', $options);

    //the correct way to post JSON data back from Wordpress
    header("Content-Type: application/json");
    echo json_encode(array('success' => true));
    exit;
}

add_action('wp_ajax_myplugin_update_record', 'myplugin_user_update_record');
add_action('wp_ajax_nopriv_myplugin_update_record', 'myplugin_user_update_record');
function myplugin_user_update_record()
{
    $id = $_POST['recordID'];
    $title = $_POST['title'];
    $desc= $_POST['description'];
    $value = $_POST['value'];
    $isEnabled = $_POST['isEnabled'];

    $rows_affected = myplugin_update_record($id, $title, $desc, $isEnabled, $value);
    $result = array('success' => true);
    if ($rows_affected === 0)
        $result = array('success' => false, 'msg' => 'Failed to update data');

    header("Content-Type: application/json");
    echo json_encode($result);
    exit;
}
