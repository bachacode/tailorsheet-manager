jQuery(document).ready(function($) {
    // Initially hide all accordion content panels.
    $('.tm-accordion-content-wrapper').hide();

    // Check if the localized variable is set and if the first item should be opened.
    if (typeof tmAccordionData !== 'undefined' && tmAccordionData.faq_first_opened === "yes") {
        $('.tm-accordion-item:first')
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
