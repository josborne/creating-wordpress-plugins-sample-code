<?php
$options = get_option('myplugin_options');
?>
<div class="wrap">
    <h2><?php echo __('My Plugin Settings', 'myplugin'); ?></h2>
    <div id="updateDiv"><p><strong id="updateMessage"></strong></p></div>
    <form action="" method="post" id="settings-form">
        <fieldset>
            <div id="legend">
                <legend class="legend"><?php echo __('Update Settings', 'myplugin'); ?>
                    <img src="<?php echo MY_PLUGIN_PATH . '/img/loader.gif'; ?>" alt="Loading..." class="showLoading"/>
                </legend>
            </div>
            <p class="tips"></p>
            <input type="hidden" name="action" value="myplugin_update_settings"/>
            <p>
                <label for="option1"><?php _e("Option 1", 'myplugin'); ?> </label>
                <input type="text" name="option1" id="option1" value="<?php echo $options['option1']; ?>">
            </p>
            <p>
                <label><?php _e("Option 2", 'myplugin'); ?> </label> <label class="radio">
                <input type="radio" name="option2" id="option2A" value="a" <?php echo ($options['option2'] == 'a') ? 'checked' : '' ?> > Choice A
            </label> <label class="radio">
                <input type="radio" name="option2" id="option2B" value="b" <?php echo ($options['option2'] == 'b') ? 'checked' : '' ?>> Choice B
            </label>
            </p>
            <p>
                <label for="option3"><?php _e("Option 3", 'myplugin'); ?></label> <select id="option3" name="option3">
                <option value="usd" <?php echo ($options['option3'] == 'usd') ? 'selected="selected"' : '' ?>>United States Dollar</option>
                <option value="cad" <?php echo ($options['option3'] == 'cad') ? 'selected="selected"' : '' ?>>Canadian Dollar</option>
                <option value="gbp" <?php echo ($options['option3'] == 'gbp') ? 'selected="selected"' : '' ?>>British Pound</option>
            </select>
            </p>
            <p>
                <button type="submit" class="btn btn-success"><?php esc_attr_e('Save Changes') ?></button>
            </p>
        </fieldset>
    </form>
</div>
