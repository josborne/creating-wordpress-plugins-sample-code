<?php
$records = myplugin_get_all_records();
?>
<div class="wrap">
    <h2><?php echo __('My Plugin Records', 'myplugin'); ?></h2>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Is Enabled</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($records as $row): ?>
        <tr>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->desc; ?></td>
            <td><?php echo $row->isEnabled; ?></td>
            <td><?php echo $row->value; ?></td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>