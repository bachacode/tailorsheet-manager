jQuery(document).ready(function($) {
    var $accordionWrapper = $('.tm-accordion-wrapper');
    var firstOpened = $accordionWrapper.data('first-opened');

    // Hide all accordion content panels initially.
    $accordionWrapper.find('.tm-accordion-content-wrapper').hide();

    // If first item should be open, open it.
    if ( firstOpened === 'yes' ) {
        $accordionWrapper.find('.tm-accordion-item:first')
            .addClass('active')
            .find('.tm-accordion-content-wrapper')
            .show();
    }

    // Handle click events on the accordion heading wrapper.
    $('.tm-accordion-heading-wrapper').on('click', function() {
        var $currentItem = $(this).closest('.tm-accordion-item');

        // Only allow one active item at a time.
        if (!$currentItem.hasClass('active')) {
            // Close any currently active item.
            $('.tm-accordion-item.active')
                .removeClass('active')
                .find('.tm-accordion-content-wrapper')
                .slideUp();

            // Open the clicked item.
            $currentItem
                .addClass('active')
                .find('.tm-accordion-content-wrapper')
                .slideDown(function() {
                    
                });
        }
        else {
            $currentItem
                .removeClass('active')
                .find('.tm-accordion-content-wrapper')
                .slideUp(function() {
                    
                });
        }
    });
});
