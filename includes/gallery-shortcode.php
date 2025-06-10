<?php
function rig_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'ids' => '',
        'columns' => 3,
        'size' => 'medium',
        'link' => 'file'
    ), $atts);
    
    if (empty($atts['ids'])) {
        return '';
    }
    
    $image_ids = explode(',', $atts['ids']);
    $output = '<div class="rig-gallery rig-standard-gallery columns-' . esc_attr($atts['columns']) . '">';
    
    foreach ($image_ids as $id) {
        $image = wp_get_attachment_image_src($id, $atts['size']);
        $full_image = wp_get_attachment_image_src($id, 'full');
        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        
        $output .= '<div class="rig-gallery-item">';
        if ($atts['link'] === 'file') {
            $output .= '<a href="' . esc_url($full_image[0]) . '" data-lightbox="rig-gallery">';
        }
        $output .= '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr($alt) . '">';
        if ($atts['link'] === 'file') {
            $output .= '</a>';
        }
        $output .= '</div>';
    }
    
    $output .= '</div>';
    return $output;
}
add_shortcode('rig_gallery', 'rig_gallery_shortcode');