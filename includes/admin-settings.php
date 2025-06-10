<?php
// Add settings page
function rig_add_admin_menu() {
    add_options_page(
        'Random Image Gallery Settings',
        'Random Image Gallery',
        'manage_options',
        'random-image-gallery',
        'rig_options_page'
    );
}
add_action('admin_menu', 'rig_add_admin_menu');

// Register settings
function rig_settings_init() {
    register_setting('rig_plugin', 'rig_settings');
    
    add_settings_section(
        'rig_plugin_section',
        __('Gallery Settings', 'random-image-gallery'),
        'rig_settings_section_callback',
        'rig_plugin'
    );
    
    add_settings_field(
        'rig_default_columns',
        __('Default Columns', 'random-image-gallery'),
        'rig_default_columns_render',
        'rig_plugin',
        'rig_plugin_section'
    );
    
    add_settings_field(
        'rig_default_size',
        __('Default Image Size', 'random-image-gallery'),
        'rig_default_size_render',
        'rig_plugin',
        'rig_plugin_section'
    );
}
add_action('admin_init', 'rig_settings_init');

// Settings fields
function rig_default_columns_render() {
    $options = get_option('rig_settings');
    ?>
    <select name="rig_settings[default_columns]">
        <option value="1" <?php selected($options['default_columns'], 1); ?>>1</option>
        <option value="2" <?php selected($options['default_columns'], 2); ?>>2</option>
        <option value="3" <?php selected($options['default_columns'], 3); ?>>3</option>
        <option value="4" <?php selected($options['default_columns'], 4); ?>>4</option>
        <option value="5" <?php selected($options['default_columns'], 5); ?>>5</option>
        <option value="6" <?php selected($options['default_columns'], 6); ?>>6</option>
    </select>
    <?php
}

function rig_default_size_render() {
    $options = get_option('rig_settings');
    $sizes = get_intermediate_image_sizes();
    ?>
    <select name="rig_settings[default_size]">
        <?php foreach ($sizes as $size): ?>
            <option value="<?php echo $size; ?>" <?php selected($options['default_size'], $size); ?>><?php echo $size; ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}

function rig_settings_section_callback() {
    echo __('Configure default settings for the Random Image Gallery plugin.', 'random-image-gallery');
}

// Options page
function rig_options_page() {
    ?>
    <div class="wrap">
        <h1>Random Image Gallery Settings</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('rig_plugin');
            do_settings_sections('rig_plugin');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}