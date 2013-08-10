<?php
global $wpdb;
$valid = true;
$formData = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "myplugin_table" . " WHERE recordID='" . $record . "';");
if ( !$formData ) {
    $valid = false;
    echo '<p class="alert alert-error">This form is invalid. Please check the settings and shortcode attributes</p>';
}
?>

<?php if ( $valid ): ?>
<form class="form-horizontal" action="" method="POST" id="user-form">
    <fieldset>
        <div id="legend">
            <legend class="">Edit Record
                <img src="<?php echo MY_PLUGIN_PATH . '/img/loader.gif'; ?>" alt="Loading..." class="showLoading"/>
            </legend>
        </div>
        <input type="hidden" name="action" value="myplugin_update_record"/>
        <input type="hidden" name="recordID" value="<?php echo $record ?>"/>
        <p class="tips"></p>
        <p>
            <label for="title"><?php _e("Title", 'myplugin'); ?> </label>
            <input type="text" name="title" id="title" value="<?php echo $formData->title; ?>">
        </p>
        <p>
            <label for="description"><?php _e("Description", 'myplugin'); ?> </label>
            <input type="text" name="description" id="description" value="<?php echo $formData->desc; ?>">
        </p>
        <p>
            <label for="value"><?php _e("Value", 'myplugin'); ?> </label>
            <input type="text" name="value" id="value" value="<?php echo $formData->value; ?>">
        </p>
        <p>
            <label><?php _e("Is Enabled", 'myplugin'); ?> </label> <label class="radio">
            <input type="radio" name="isEnabled" value="0" <?php echo ($formData->isEnabled == 0) ? 'checked' : '' ?> > No
        </label> <label class="radio">
            <input type="radio" name="isEnabled" value="1" <?php echo ($formData->isEnabled == 1) ? 'checked' : '' ?>> Yes
        </label>
        </p>
        <p>
            <button type="submit" class="btn btn-success"><?php esc_attr_e('Save Changes') ?></button>
        </p>
    </fieldset>
</form>
<?php endif; ?>