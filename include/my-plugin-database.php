<?php

//required for dbDelta()
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

function myplugin_setup_db()
{
    global $wpdb;
    $table = $wpdb->prefix . 'myplugin_table';

    $sql = "CREATE TABLE " . $table . " (
        recordID INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        desc TEXT NOT NULL,
        isEnabled TINYINT(1),
        value INT NOT NULL,
        UNIQUE KEY recordID (recordID)
        );";

    //database write/update
    dbDelta($sql);
}

function myplugin_get_all_records()
{
    global $wpdb;
    return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "myplugin_table;");
}

function myplugin_get_record($id)
{
    global $wpdb;
    return $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "myplugin_table WHERE recordID=" . $id . ";");
}

function myplugin_insert_record($title, $desc, $isEnabled, $value)
{
    $data = array(
        'title' => $title,
        'desc' => $desc,
        'isEnabled' => $isEnabled,
        'value' => $value
    );

    global $wpdb;
    $rows_affected = $wpdb->insert($wpdb->prefix . 'myplugin_table', $data);
    if ( $rows_affected ) {
        return $wpdb->insert_id;
    } else return -1;
}

function myplugin_update_record($id, $title, $desc, $isEnabled, $value)
{
    $data = array(
        'title' => $title,
        'desc' => $desc,
        'isEnabled' => $isEnabled,
        'value' => $value
    );

    global $wpdb;
    $rows_affected = $wpdb->update($wpdb->prefix . 'myplugin_table', $data, array('recordID' => $id));
    return $rows_affected;
}

function myplugin_delete_record($id)
{
    global $wpdb;
    $rows_affected = $wpdb->delete($wpdb->prefix . 'myplugin_table', array('recordID' => $id));
    return $rows_affected;
}