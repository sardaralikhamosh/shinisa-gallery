<?php
function rig_random_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'ids' => '',
        'columns' => 3,
        'size' => 'medium',
        'link' => 'file',
        'count' => -1 // -1 means show all
    ), $atts);
    
    if (empty($atts['ids'])) {
        return '';
    }
    
    $image_ids = explode(',', $atts['ids']);
    
    // Shuffle the array for randomness
    shuffle($image_ids);
    
    // Limit the number of images if count is set
    if ($atts['count'] > 0 && $atts['count'] < count($image_ids)) {
        $image_ids = array_slice($image_ids, 0, $atts['count']);
    }
    
    $output = '<div class="rig-gallery rig-random-gallery columns-' . esc_attr($atts['columns']) . '">';
    
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
add_shortcode('rig_random_gallery', 'rig_random_gallery_shortcode');