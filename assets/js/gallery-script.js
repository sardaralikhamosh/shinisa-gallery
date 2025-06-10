jQuery(document).ready(function($) {
    // Lightbox functionality
    $('.rig-gallery a[data-lightbox="rig-gallery"]').on('click', function(e) {
        e.preventDefault();
        
        // You can integrate with an existing lightbox library here
        // For example, if using Magnific Popup:
        // $.magnificPopup.open({
        //     items: {
        //         src: $(this).attr('href')
        //     },
        //     type: 'image'
        // });
        
        // Simple fallback
        window.open($(this).attr('href'), '_blank');
    });
});