<?php
function portfolio_add_custom_box() {
    add_meta_box(
        'portfolio_link_box',
        'Odkaz na hotový projekt',
        'portfolio_link_box_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'portfolio_add_custom_box');

function portfolio_link_box_callback($post) {
    wp_nonce_field('portfolio_link_save_meta_box_data', 'portfolio_link_meta_box_nonce');
    $value = get_post_meta($post->ID, 'project_link', true);
    ?>
    <p>
        <label for="project_link_field">Vložte plný odkaz na projekt:</label><br>
        <input type="url" id="project_link_field" name="project_link_field"
               value="<?php echo esc_attr($value); ?>" style="width:100%;" />
    </p>
    <?php
}

function portfolio_save_meta_box_data($post_id) {

    if (!isset($_POST['portfolio_link_meta_box_nonce'])) return;
    if (!wp_verify_nonce($_POST['portfolio_link_meta_box_nonce'], 'portfolio_link_save_meta_box_data')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['project_link_field'])) {
        update_post_meta(
            $post_id,
            'project_link',
            sanitize_url($_POST['project_link_field'])
        );
    }
}
add_action('save_post', 'portfolio_save_meta_box_data');
